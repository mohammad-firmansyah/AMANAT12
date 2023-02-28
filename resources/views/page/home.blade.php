@extends('template.master')
@section('title', $title ?? '')
@section('nama', $nama ?? '')
@section('jabatan', $jabatan ?? '')

@section('breadcump')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Pages</a></li>
    <li class="breadcrumb-item active">Starter Page</li>
</ol>

<head>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Roboto', sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        .select {
            position: relative;
            min-width: 200px;
        }

        .select svg {
            position: absolute;
            right: 12px;
            top: calc(50% - 3px);
            width: 10px;
            height: 6px;
            stroke-width: 2px;
            stroke: #9098a9;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
            pointer-events: none;
        }

        .select select {
            -webkit-appearance: none;
            padding: 7px 40px 7px 12px;
            width: 100%;
            border: 1px solid #e8eaed;
            border-radius: 5px;
            background: #fff;
            box-shadow: 0 1px 3px -2px #9098a9;
            cursor: pointer;
            font-family: inherit;
            font-size: 16px;
            transition: all 150ms ease;
        }

        .select select:required:invalid {
            color: #5a667f;
        }

        .select select option {
            color: #223254;
        }

        .select select option[value=""][disabled] {
            display: none;
        }

        .select select:focus {
            outline: none;
            border-color: #07f;
            box-shadow: 0 0 0 2px rgba(0, 119, 255, 0.2);
        }

        .select select:hover+svg {
            stroke: #07f;
        }

        .sprites {
            position: absolute;
            width: 0;
            height: 0;
            pointer-events: none;
            user-select: none;
        }
    </style>
</head>
@endsection

@section('content')
<center>
    <h3>Selamat Datang,<br>{{$nama}}</h3>
</center>
<p>Tipe Aset</p>
<hr>
<div class="row">
    @foreach($aset_tipe as $key => $value)
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="widget-chart-two-content media-body">
                        <p class="text-muted mb-0">Tipe Aset</p>
                        <h3 id="totalTimbangPosisiEst" class="mb-0">{{Str::title($value->aset_tipe_desc)}}</h3>
                    </div>
                    <p id="trukPosisiEstimasi" style="font-size:38px; color:orange">{{$jumlah_aset_tipe[$key]}}</p>&nbsp;&nbsp;
                    <strong>
                        <p style="font-size:15px; color:orange">Aset</p>
                    </strong>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


<hr>
<p>Jenis Aset</p>
<hr>

<div class="row">
    @foreach($aset_jenis as $key => $value)
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="widget-chart-two-content media-body">
                        <p class="text-muted mb-0">Jenis Aset</p>
                        <h3 id="totalTimbangPosisiEst" class="mb-0">{{Str::title($value->aset_jenis_desc)}}</h3>
                    </div>
                    <p id="trukPosisiEstimasi" style="font-size:38px; color:orange">{{$jumlah_aset_jenis[$key]}}</p>&nbsp;&nbsp;
                    <strong>
                        <p style="font-size:15px; color:orange">Aset</p>
                    </strong>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<hr>
<p>Aset Kondisi</p>
<hr>

<div class="row">
    @foreach($aset_kondisi as $key => $value)
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="widget-chart-two-content media-body">
                        <p class="text-muted mb-0">Aset Kondisi</p>
                        <h3 id="totalTimbangPosisiEst" class="mb-0">{{Str::title($value->aset_kondisi_desc)}}</h3>
                    </div>
                    <p id="trukPosisiEstimasi" style="font-size:38px; color:orange">{{$jumlah_aset_kondisi[$key]}}</p>&nbsp;&nbsp;
                    <strong>
                        <p style="font-size:15px; color:orange">Aset</p>
                    </strong>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- end row -->

<hr>
<p>Aset Kode</p>
<hr>

<div class="row">
    @foreach($aset_kode as $key => $value)
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="widget-chart-two-content media-body">
                        <p class="text-muted mb-0">Aset Kode</p>
                        <h3 id="totalTimbangPosisiEst" class="mb-0">{{Str::title($value->aset_desc)}}</h3>
                    </div>
                    <p id="trukPosisiEstimasi" style="font-size:38px; color:orange">{{$jumlah_aset_kode[$key]}}</p>&nbsp;&nbsp;
                    <strong>
                        <p style="font-size:15px; color:orange">Aset</p>
                    </strong>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- end row -->


<hr>
<p>Status Posisi</p>
<hr>

<div class="row">
    @foreach($status_posisi as $key => $value)
    <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="widget-chart-two-content media-body">
                        <p class="text-muted mb-0">Status Posisi</p>
                        <h3 id="totalTimbangPosisiEst" class="mb-0">{{Str::title($value->sp_desc)}}</h3>
                    </div>
                    <p id="trukPosisiEstimasi" style="font-size:38px; color:orange">{{$jumlah_sp[$key]}}</p>&nbsp;&nbsp;
                    <strong>
                        <p style="font-size:15px; color:orange">Aset</p>
                    </strong>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- end row -->


@endsection

@section('pluginJS')
<!-- flot-charts js -->
<script src="{{ asset('assets/libs/flot-charts/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/libs/flot-charts/jquery.flot.time.js') }}"></script>
<script src="{{ asset('assets/libs/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('assets/libs/flot-charts/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('assets/libs/flot-charts/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets/libs/flot-charts/jquery.flot.crosshair.js') }}"></script>
<script src="{{ asset('assets/libs/flot.curvedlines/curvedLines.js') }}"></script>
<script src="{{ asset('assets/libs/flot-axislabels/jquery.flot.axislabels.js') }}"></script>

<!-- KNOB JS -->
<script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

<!-- Dashboard init js-->
<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

@endsection