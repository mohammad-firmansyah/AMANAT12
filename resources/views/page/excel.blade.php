<?php
// dd($jabatan);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Excel</title>
</head>
    <style>
        /* bodyyyasd {
            margin: 5%;
            border: 2px solid black;
        } */

        .wrapper{
            padding: 0px;
            height: 100vh;
        }

        table, td, th{
            border: 1px solid black;
            border-collapse: collapse;
        }

        td, th {
            padding: 5px;
        }

    </style>
     
<body>
@php
    $total_h = 0;
    $total_tebmuat = 0;
    $total_tarif = 0;
    $date = date('Y/m/d - H:i:s')
@endphp
    <div class="wrapper">
        <table style="width : 100%"> 
            <thead>
            <tr>
                <td colspan="26">Export Tanggal : {{$date}}</td>
                </tr>  
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">No SPTA</th>
                    <th rowspan="2">Tanggal SPTA</th>
                    <th rowspan="2">Nopol</th>
                    <th colspan="3">Kebun</th>
                    <th rowspan="2">Jenis Kendaraan</th>
                    <th colspan="4">Timbang (Ton)</th>
                    <th colspan="2">Tebang Muat Grabber</th>
                    <th rowspan="2">Tebang Manual (Rp)</th>
                    <th rowspan="2">Total Tebang Muat</th>
                    <th rowspan="2">Tebang Muat</th>
                    <th rowspan="2">PTA </th>
                    <th rowspan="2">Renteng Tebang</th>
                    <th colspan="4">Angkut</th>
                    <th rowspan="2">Sumber Dana</th>
                    <th rowspan="2">Status Posisi</th>
                    <th rowspan="2">Status Bayar Kebun</th>
                </tr>
                <tr>
                    {{-- Kebun --}}
                    <th>Nama Kebun</th>
                    <th>Afdeling</th>
                    <th>Petak Tebang</th>

                    {{-- Timbang --}}
                    <th>Estimasi</th>
                    <th>Realisasi</th>
                    <th>Tanggal Timbang Realisasi</th>
                    <th>Nota Timbang</th>

                    {{-- Tebang Muat --}}
                    <th>Grabber Vendor (Rp)</th>
                    <th>Upah Tebang (Rp)</th>

                    {{-- Angkut --}}
                    <th>Zonasi</th>
                    <th>Tarif</th>
                    <th>Tarif Penyesuaian</th>
                    <th>Harga Total</th>
                </tr>

            </thead>
            <tbody>
            @foreach ($data->data as $key => $value)
                    {{-- disini value dari datanya ditaruh--}}
                <tr>
                    <td class="cell">{{ $key+1 }}</td>
                    <td class="cell">{{ $value->nomor_spta}}</td>
                    <td class="cell">{{ $value->tgl_spta}}</td>
                    <td class="cell">{{ $value->nopol}}</td>

                    {{-- Kebun --}}
                    <td class="cell">{{ $value->unit_nama}}</td>
                    <td class="cell">{{ $value->nama_afdeling}}</td>
                    <td class="cell">{{ $value->petak_tanam}}</td>

                    <td class="cell">{{ $value->nama_truk}}</td>

                    {{-- Timbang --}}
                    <td class="cell">{{ $value->estimasi_berat }}</td>
                    <td class="cell">{{ $value->hasil_timbang}}</td>
                    <td class="cell">{{ $value->tanggal_timbang}}</td>
                    <td class="cell">{{ $value->nota_timbang}}</td>

                    {{-- Tebang Muat --}}
                    <td class="cell">{{ intval($value->hrg_grab_vendor * $value->hasil_timbang) }}</td>
                    <td class="cell">{{ $value->hrg_grab_mandiri * 10 * $value->hasil_timbang}}</td>
                    <td class="cell">{{ $value->hrg_manual * 10 * $value->hasil_timbang }}</td>
                    <td class="cell">{{ $value->hrg_total }}</td>
                    <td class="cell">{{ $value->tebmuat_askep }}</td>
                    <td class="cell">{{ $value->nama_pta }}</td>
                    <td class="cell">{{ $value->nama_renteng }}</td>

                    {{-- Angkut --}}
                    <td class="cell">{{ $value->zonasi }}</td>
                    <td class="cell">{{ $value->tarif}}</td>
                    <td class="cell">{{ $value->tarif_penyesuaian }}</td>
                    @if($value->tarif_penyesuaian == 0 || $value->tarif_penyesuaian == null)
                    <td class="cell">{{ intval($value->tarif * $value->hasil_timbang) }}</td>
                    @else
                    <td class="cell">{{ intval($value->tarif_penyesuaian * $value->hasil_timbang) }}</td>
                    @endif

                    <td class="cell">{{ $value->sumber_dana }}</td>
                    <td class="cell">{{ $value->ket_posisi }}</td>
                    @if( $value->bayar_checked ==  1)
                        <td class="cell">Sudah Bayar</td>
                    @else
                        <td class="cell">Belum Bayar</td>
                    @endif
                </tr>

                @php
                    $total_h += $value->hasil_timbang;
                    $total_tebmuat += $value->hrg_total;
                    $total_tarif += ($value->tarif * $value->hasil_timbang);
                @endphp

                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Total </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $total_h }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$total_tebmuat}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$total_tarif}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                
            </tbody>
        </table>
    </div>
</body>
