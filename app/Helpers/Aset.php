<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class Aset
{

    public static function toUmurEkonomis($month): string
    {
    
        $tahun = 0;
        while ($month > 11) {
        $month -= 12;
        $tahun++;
        }
        
        $result = $tahun . " tahun " . $month . " bulan";
        
        if ($month < 0) { $result="0 tahun " . "0 bulan" ; } 
        return $result; 
    }

    public static function toRupiah(int $angka): string{ 
        $hasil_rupiah="Rp " . number_format($angka,2,',','.'); 
        return $hasil_rupiah; 
    }
}