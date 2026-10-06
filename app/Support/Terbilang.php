<?php

namespace App\Support;

/**
 * Mengubah angka menjadi teks terbilang Bahasa Indonesia.
 * Contoh: 15000000 -> "lima belas juta".
 */
class Terbilang
{
    private const WORDS = [
        '', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam',
        'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas',
    ];

    public static function make(int|float $number): string
    {
        $number = (int) abs($number);

        if ($number === 0) {
            return 'nol';
        }

        return trim(preg_replace('/\s+/', ' ', self::convert($number)));
    }

    public static function rupiah(int|float $number): string
    {
        return ucwords(self::make($number)) . ' Rupiah';
    }

    private static function convert(int $n): string
    {
        if ($n < 12) {
            return self::WORDS[$n];
        }
        if ($n < 20) {
            return self::convert($n - 10) . ' belas';
        }
        if ($n < 100) {
            return self::convert(intdiv($n, 10)) . ' puluh ' . self::convert($n % 10);
        }
        if ($n < 200) {
            return 'seratus ' . self::convert($n - 100);
        }
        if ($n < 1000) {
            return self::convert(intdiv($n, 100)) . ' ratus ' . self::convert($n % 100);
        }
        if ($n < 2000) {
            return 'seribu ' . self::convert($n - 1000);
        }
        if ($n < 1_000_000) {
            return self::convert(intdiv($n, 1000)) . ' ribu ' . self::convert($n % 1000);
        }
        if ($n < 1_000_000_000) {
            return self::convert(intdiv($n, 1_000_000)) . ' juta ' . self::convert($n % 1_000_000);
        }
        if ($n < 1_000_000_000_000) {
            return self::convert(intdiv($n, 1_000_000_000)) . ' miliar ' . self::convert($n % 1_000_000_000);
        }

        return self::convert(intdiv($n, 1_000_000_000_000)) . ' triliun ' . self::convert($n % 1_000_000_000_000);
    }
}
