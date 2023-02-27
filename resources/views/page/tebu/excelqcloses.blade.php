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
    $date = date('Y/m/d - H:i:s');
    $number = 0;
@endphp

    <div class="wrapper">
        <table style="width : 100%">
            <thead>
                <tr>
                    <th colspan="15">Export Tanggal : {{$date}}</th>
                </tr>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">TanggaI<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Input QC</th>
                    <th rowspan="2">Sampel Data</th>
                    <th colspan="4">Data&nbsp;&nbsp;&nbsp;Tebu</th>
                    <th rowspan="2">Berat Tunggak (Kg)</th>
                    <th rowspan="2">Berat Pucukan (Kg)</th>
                    <th rowspan="2">Berat Brondolan (Kg)</th>
                    <th rowspan="2">Panjang Juring (m/Ha)</th>
                    <th rowspan="2">Luas Sample (m2)</th>
                    <th rowspan="2"> Potensi Loses (Ton/Ha)</th>
                    <th rowspan="2">Total Potensi Loses (Ton/Ha)</th>
                    <th rowspan="2">Nama PTA</th>
                    <th rowspan="2">Nama Renteng</th>
                    <th rowspan="2">Status Data</th>
                </tr>
                <tr>
                    <th >Nama Kebun</th>
                    <th >Afdeling</th>
                    <th >Petak Tebang</th>
                    <th >Status Tanam </th>
                </tr>
            </thead>
            <tbody>
            @foreach($data as $key=>$data)
            @php
                $has = $key-1;
                $sam = $key-$has;
            @endphp
                <tr>
                    <td>{{$number+=1}}</td>
                    <td>{{$data->tanggal_waktu}}</td>
                    <td>Data 1 </td>
                    <td>{{$data->unit_nama}}</td>
                    <td>{{$data->nama_afdeling}}</td>
                    <td>{{$data->status_tanam}}</td>
                    <td>{{$data->petak_tanam}}</td>
                    <td>{{$data->berat_tunggak}}</td>
                    <td>{{$data->berat_pucukan}}</td>
                    <td>{{$data->berat_brondolan}}</td>
                    <td>{{$data->panjang_juring}}</td>
                    <td>{{$data->luas_sample}}</td>
                    <td>{{$data->potensi_loses}}</td>
                    <td rowspan="{{ $data->total }}">{{$data->average}}</td>
                    <td>{{$data->nama_pta}}</td>
                    <td>{{$data->nama_renteng}}</td>
                    <td>{{$data->ket_posisi}}</td>
                </tr>
                @foreach($data->child as $ckey=>$cdata)
                <tr>
                    <td>{{$number+=1}}</td>
                    <td>{{$cdata->tanggal_waktu}}</td>
                    <td>Data {{$sam+=1}} </td>
                    <td>{{$cdata->unit_nama}}</td>
                    <td>{{$cdata->nama_afdeling}}</td>
                    <td>{{$cdata->status_tanam}}</td>
                    <td>{{$cdata->petak_tanam}}</td>
                    <td>{{$cdata->berat_tunggak}}</td>
                    <td>{{$cdata->berat_pucukan}}</td>
                    <td>{{$cdata->berat_brondolan}}</td>
                    <td>{{$cdata->panjang_juring}}</td>
                    <td>{{$cdata->luas_sample}}</td>
                    <td>{{$cdata->potensi_loses}}</td>
                    <td>{{$cdata->nama_pta}}</td>
                    <td>{{$cdata->nama_renteng}}</td>
                    <td>{{$cdata->ket_posisi}}</td>
                </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
</body>
