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
@endphp

    <div class="wrapper">
        <table style="width : 100%">
            <thead>
            <tr>
                <td colspan="26">Export Tanggal : {{$date}}</td>
                </tr>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Tanggal Input QC</th>
                    <th rowspan="2">Nopol</th>
                    <th colspan="6">Data Tebu</th>
                    <th rowspan="2">Nama Operator Graber</th>
                    <th colspan="2">Manis</th>
                    <th colspan="6">Bersih&nbsp;&nbsp;&nbsp;dari</th>
                    <th >Segar</th>
                    

                    <th rowspan="2">Status</th>
                    <th rowspan="2">Posisi Data</th>
                    
                </tr>
                <tr>
                    <th >Nama Kebun</th>
                    <th >Afdeling</th>
                    <th >Status Tanam </th>
                    <th >Petak Tebang</th>
                    <th >Varietas</th>
                    <th >Jenis Tebang Muat</th>
                    <th >Brix Pucuk</th>
                    <th >Umur Tebu</th>
                    <th >Daduk</th>
                    <th >Tanah</th>
                    <th >Akar</th>
                    <th >Pucuk</th>
                    <th >Sogolan</th>
                    <th >Benda Lain</th>
                    <th >Lama di Lasahan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($result as $key=>$data)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$data->tanggal_waktu}}</td>
                    <td>{{$data->nopol}}</td>
                    <td>{{$data->unit_nama}}</td>
                    <td>{{$data->nama_afdeling}}</td>
                    <td>{{$data->status_tanam}}</td>
                    <td>{{$data->petak_tanam}}</td>
                    <td>{{$data->varietas}}</td>
                    <td>{{$data->tebang_muat}}</td>
                    <td>{{$data->operator_grabber}}</td>
                    <td>{{$data->brix}}</td>
                    <td>{{$data->umur}}</td>
                    @if($data->daduk == 1)
                    <td>v</td>
                    @else
                    <td>x</td>
                    @endif
                    @if($data->tanah == 1)
                    <td>v</td>
                    @else
                    <td>x</td>
                    @endif
                    @if($data->akar == 1)
                    <td>v</td>
                    @else
                    <td>x</td>
                    @endif
                    @if($data->pucuk == 1)
                    <td>v</td>
                    @else
                    <td>x</td>
                    @endif
                    @if($data->sogolan == 1)
                    <td>v</td>
                    @else
                    <td>x</td>
                    @endif
                    @if($data->benda_lain == 1)
                    <td>v</td>
                    @else
                    <td>x</td>
                    @endif
                    <td>{{$data->waktu_lasahan}}</td>
                    <td>{{$data->status}}</td>
                    <td>{{$data->ket_posisi}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
