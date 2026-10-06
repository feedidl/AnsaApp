<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Support\Terbilang;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Generator Kontrak PDF (PKS).
 * Tidak menyimpan data ke database — hanya menyusun & mengirim file PDF.
 */
class ContractController extends Controller
{
    public const SCHEME_BUY_OUT = 'buy_out';
    public const SCHEME_SUBSCRIPTION = 'subscription';

    /**
     * Form data kontrak. Dapat di-prefill dari hasil simulasi Estimator (query string).
     */
    public function create(Request $request)
    {
        $d = config('pricing.defaults');
        $settings = Setting::pluck('value', 'key')->toArray();

        $scheme = $request->query('scheme') === self::SCHEME_BUY_OUT ? self::SCHEME_BUY_OUT : self::SCHEME_SUBSCRIPTION;
        $num = fn (string $key) => (int) $request->query($key, $d[$key]);

        $upfront = $num('upfront_cost');
        $minMonths = max(1, $num('min_contract_months'));
        $start = Carbon::today();

        $prefill = [
            'contract_number' => sprintf('PKS/ANSA/%s/%s/%s', $start->format('Y'), $start->format('m'), strtoupper(Str::random(4))),
            'contract_date' => $start->toDateString(),
            'contract_city' => '',
            'project_name' => '',

            'first_company' => $settings['company_name'] ?? 'AnsaApp',
            'first_pic_name' => '',
            'first_pic_position' => 'Direktur',
            'first_address' => $settings['company_address'] ?? '',
            'first_contact' => trim(($settings['company_email'] ?? '') . ' / ' . ($settings['company_phone'] ?? ''), ' /'),

            'second_company' => '',
            'second_pic_name' => '',
            'second_pic_position' => '',
            'second_address' => '',
            'second_contact' => '',

            'scheme' => $scheme,
            'upfront_cost' => $upfront,
            'down_payment' => (int) round($upfront * $d['down_payment_percent'] / 100),
            'annual_fee' => $num('annual_fee'),
            'warranty_months' => $num('warranty_months'),
            'setup_fee' => $num('setup_fee'),
            'monthly_fee' => $num('monthly_fee'),
            'min_contract_months' => $minMonths,
            'maintenance_quota_hours' => $num('maintenance_quota_hours'),
            'penalty_percent' => $num('penalty_percent'),
            'payment_due_day' => $d['payment_due_day'],
            'start_date' => $start->toDateString(),
            'end_date' => $start->copy()->addMonths($scheme === self::SCHEME_SUBSCRIPTION ? $minMonths : 12)->subDay()->toDateString(),
            'sla' => $request->has('sla') ? array_values(array_filter((array) $request->query('sla'))) : array_keys(config('pricing.sla_features')),
        ];

        return view('admin.contracts.form', [
            'prefill' => $prefill,
            'slaFeatures' => config('pricing.sla_features'),
        ]);
    }

    /**
     * Susun PDF kontrak lalu tampilkan (preview) atau unduh (download).
     */
    public function generate(Request $request)
    {
        $slaKeys = array_keys(config('pricing.sla_features'));

        $v = $request->validate([
            'action' => 'required|in:preview,download',
            'contract_number' => 'required|string|max:100',
            'contract_date' => 'required|date',
            'contract_city' => 'required|string|max:100',
            'project_name' => 'required|string|max:255',

            'first_company' => 'required|string|max:255',
            'first_pic_name' => 'required|string|max:255',
            'first_pic_position' => 'required|string|max:255',
            'first_address' => 'required|string|max:500',
            'first_contact' => 'required|string|max:255',

            'second_company' => 'required|string|max:255',
            'second_pic_name' => 'required|string|max:255',
            'second_pic_position' => 'required|string|max:255',
            'second_address' => 'required|string|max:500',
            'second_contact' => 'required|string|max:255',

            'scheme' => 'required|in:' . self::SCHEME_BUY_OUT . ',' . self::SCHEME_SUBSCRIPTION,
            'upfront_cost' => 'required_if:scheme,' . self::SCHEME_BUY_OUT . '|nullable|integer|min:0',
            'down_payment' => 'nullable|integer|min:0',
            'annual_fee' => 'nullable|integer|min:0',
            'warranty_months' => 'nullable|integer|min:0|max:60',
            'setup_fee' => 'nullable|integer|min:0',
            'monthly_fee' => 'required_if:scheme,' . self::SCHEME_SUBSCRIPTION . '|nullable|integer|min:0',
            'min_contract_months' => 'required_if:scheme,' . self::SCHEME_SUBSCRIPTION . '|nullable|integer|min:1|max:120',
            'maintenance_quota_hours' => 'nullable|integer|min:0|max:200',
            'penalty_percent' => 'nullable|integer|min:50|max:100',
            'payment_due_day' => 'required|integer|min:1|max:28',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'sla' => 'nullable|array',
            'sla.*' => 'in:' . implode(',', $slaKeys),
        ], [
            'end_date.after' => 'Tanggal berakhir kontrak harus setelah tanggal mulai.',
            'penalty_percent.min' => 'Penalti minimal 50%.',
            'penalty_percent.max' => 'Penalti maksimal 100%.',
        ]);

        $data = $this->buildContractData($v);

        $html = view('pdf.contract', $data)->render();

        $pdf = Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->setOption('isFontSubsettingEnabled', true);
        $dompdf = $pdf->getDomPDF();
        $dompdf->render();

        // Footer otomatis di setiap halaman: nomor kontrak & "Halaman X dari Y"
        $canvas = $dompdf->getCanvas();
        $font = $dompdf->getFontMetrics()->getFont('DejaVu Sans', 'normal');
        $h = $canvas->get_height();
        $gray = [0.42, 0.45, 0.5];
        $canvas->page_text(71, $h - 42, 'No. ' . $data['contract_number'], $font, 7.5, $gray);
        $canvas->page_text(470, $h - 42, 'Halaman {PAGE_NUM} dari {PAGE_COUNT}', $font, 7.5, $gray);

        $filename = 'Kontrak_' . Str::slug($data['second_company'], '_') . '_' . Str::slug(str_replace('/', '-', $data['contract_number'])) . '.pdf';
        $disposition = $v['action'] === 'download' ? 'attachment' : 'inline';

        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => $disposition . '; filename="' . $filename . '"',
        ]);
    }

    /**
     * Normalisasi data + penerapan aturan bisnis (hak cipta, penalti, terbilang).
     */
    private function buildContractData(array $v): array
    {
        $isSub = $v['scheme'] === self::SCHEME_SUBSCRIPTION;
        $fmtDate = fn (string $d) => Carbon::parse($d)->locale('id')->translatedFormat('d F Y');
        $contractDate = Carbon::parse($v['contract_date'])->locale('id');

        $upfront = (int) ($v['upfront_cost'] ?? 0);
        $dp = min((int) ($v['down_payment'] ?? 0), $upfront);
        $monthly = (int) ($v['monthly_fee'] ?? 0);
        $setup = (int) ($v['setup_fee'] ?? 0);
        $annual = (int) ($v['annual_fee'] ?? 0);
        $minMonths = (int) ($v['min_contract_months'] ?? 12);
        $penalty = (int) ($v['penalty_percent'] ?? 50);

        $allSla = config('pricing.sla_features');
        $selectedSla = array_intersect_key($allSla, array_flip($v['sla'] ?? []));

        return array_merge($v, [
            'is_subscription' => $isSub,
            'scheme_label' => $isSub ? 'Sewa Bulanan (Subscription)' : 'Beli Putus (One-Time Purchase)',
            'contract_day' => $contractDate->translatedFormat('l'),
            'contract_date_fmt' => $contractDate->translatedFormat('d F Y'),
            'contract_date_words' => Terbilang::make((int) $contractDate->format('d')),
            'start_date_fmt' => $fmtDate($v['start_date']),
            'end_date_fmt' => $fmtDate($v['end_date']),

            'upfront_cost' => $upfront,
            'down_payment' => $dp,
            'remaining_payment' => $upfront - $dp,
            'annual_fee' => $annual,
            'warranty_months' => (int) ($v['warranty_months'] ?? 0),
            'setup_fee' => $setup,
            'monthly_fee' => $monthly,
            'min_contract_months' => $minMonths,
            'maintenance_quota_hours' => (int) ($v['maintenance_quota_hours'] ?? 0),
            'penalty_percent' => $penalty,

            'sla_selected' => $selectedSla,
            'has_sla_response' => isset($selectedSla['sla_response']),

            'rupiah' => fn (int $n) => 'Rp ' . number_format($n, 0, ',', '.'),
            'terbilang' => fn (int $n) => Terbilang::rupiah($n),
        ]);
    }
}
