<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak Baru</title>
</head>
<body style="margin: 0; padding: 0; background-color: #0f172a; font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif; color: #e2e8f0; line-height: 1.6;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #0b1120; padding: 30px 15px;">
        <tr>
            <td align="center">
                <!-- Main Container Card -->
                <table role="presentation" width="100%" style="max-width: 600px; background-color: #1e293b; border-radius: 16px; border: 1px solid #334155; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.4);" cellspacing="0" cellpadding="0" border="0">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #0d9488 0%, #0284c7 100%); padding: 24px 30px; text-align: left;">
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td>
                                        <h1 style="margin: 0; color: #ffffff; font-size: 20px; font-weight: 800; letter-spacing: -0.5px;">
                                            ANSA<span style="color: #99f6e4;">APP</span>
                                        </h1>
                                        <p style="margin: 4px 0 0 0; color: #ccfbf1; font-size: 12px; letter-spacing: 0.5px; text-transform: uppercase;">
                                            Notifikasi Pesan Masuk Portfolio
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 28px 30px;">
                            <p style="margin: 0 0 20px 0; font-size: 15px; color: #f1f5f9;">
                                Halo Admin, Anda menerima pesan baru dari pengunjung website portfolio <strong>AnsaApp</strong>:
                            </p>

                            <!-- Detail Card -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #0f172a; border-radius: 12px; border: 1px solid #334155; margin-bottom: 22px;">
                                <tr>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #1e293b; font-size: 13px; color: #94a3b8; width: 32%;">
                                        Nama Pengirim
                                    </td>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #1e293b; font-size: 14px; font-weight: 600; color: #f8fafc;">
                                        {{ $contact->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #1e293b; font-size: 13px; color: #94a3b8;">
                                        Email
                                    </td>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #1e293b; font-size: 14px; font-weight: 600; color: #38bdf8;">
                                        <a href="mailto:{{ $contact->email }}" style="color: #38bdf8; text-decoration: none;">
                                            {{ $contact->email }}
                                        </a>
                                    </td>
                                </tr>
                                @if(!empty($contact->phone))
                                <tr>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #1e293b; font-size: 13px; color: #94a3b8;">
                                        Telepon / WA
                                    </td>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #1e293b; font-size: 14px; font-weight: 600; color: #34d399;">
                                        {{ $contact->phone }}
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #1e293b; font-size: 13px; color: #94a3b8;">
                                        Subjek
                                    </td>
                                    <td style="padding: 14px 18px; border-bottom: 1px solid #1e293b; font-size: 14px; font-weight: 600; color: #f8fafc;">
                                        {{ $contact->subject }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 14px 18px; font-size: 13px; color: #94a3b8;">
                                        Waktu Kirim
                                    </td>
                                    <td style="padding: 14px 18px; font-size: 13px; color: #cbd5e1;">
                                        {{ ($contact->created_at ?? now())->format('d F Y, H:i') }} WIB
                                    </td>
                                </tr>
                            </table>

                            <!-- Message Box -->
                            <div style="margin-bottom: 25px;">
                                <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; margin-bottom: 8px;">
                                    Isi Pesan:
                                </div>
                                <div style="background-color: #0f172a; border-left: 4px solid #14b8a6; padding: 16px 18px; border-radius: 6px; font-size: 14px; color: #f1f5f9; line-height: 1.7; word-break: break-word;">
                                    {!! nl2br(e($contact->message)) !!}
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 10px;">
                                <tr>
                                    <td align="center">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <td style="border-radius: 8px; background-color: #0d9488; text-align: center;">
                                                    <a href="mailto:{{ $contact->email }}?subject=Re:%20{{ rawurlencode($contact->subject) }}" 
                                                       style="background-color: #0d9488; border: 1px solid #0d9488; border-radius: 8px; color: #ffffff; display: inline-block; font-size: 13px; font-weight: 600; padding: 11px 22px; text-decoration: none;">
                                                        Balas via Email &rarr;
                                                    </a>
                                                </td>
                                                @if(!empty($contact->phone))
                                                @php
                                                    $cleanPhone = preg_replace('/[^0-9]/', '', $contact->phone);
                                                    if (str_starts_with($cleanPhone, '0')) {
                                                        $cleanPhone = '62' . substr($cleanPhone, 1);
                                                    }
                                                @endphp
                                                <td style="width: 10px;"></td>
                                                <td style="border-radius: 8px; background-color: #059669; text-align: center;">
                                                    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank"
                                                       style="background-color: #059669; border: 1px solid #059669; border-radius: 8px; color: #ffffff; display: inline-block; font-size: 13px; font-weight: 600; padding: 11px 22px; text-decoration: none;">
                                                        Chat WhatsApp &rarr;
                                                    </a>
                                                </td>
                                                @endif
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #0b1120; padding: 18px 30px; text-align: center; border-top: 1px solid #334155;">
                            <p style="margin: 0; font-size: 11px; color: #64748b;">
                                Email ini dikirim otomatis oleh sistem kontak website AnsaApp.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
