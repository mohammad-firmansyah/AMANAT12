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
  box-shadow: 0 0 0 2px rgba(0,119,255,0.2);
}
.select select:hover + svg {
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
<center><h3>Selamat Datang,<br>{{$nama}}</h3></center>
@if($jabatan == "ADMIN KEBUN" || $jabatan == "MANAJER")
<p>Rekap Administrasi TMA Tebu - Kebun {{$nama_kebun->unit_nama}}</p>
@else
<p>Rekap Administrasi TMA Tebu
<label class="select" for="slct">
    <select  name="kebun"  id="updatePage">
    <option value="" selected disabled> -- Pilih Kebun -- </option>
         <option value="false" style="position:relative;width:100px;background:#ddffdd;overflow:hidden;">Semua Kebun</option>
         <option value='5'>Kalitelepak</option>
         <option value='6'>Mumbul</option>
         <option value='12'>Kaliselogiri</option>
         <option value='28'>Sumber Tengah</option>
         <option value='13'>Sungai Lembu</option>
    </select>
    <svg>
    <use xlink:href="#select-arrow-down"></use>
  </svg>
</label>
<!-- SVG Sprites-->
<svg class="sprites">
  <symbol id="select-arrow-down" viewbox="0 0 10 6">
    <polyline points="1 1 5 5 9 1"></polyline>
  </symbol>
</svg>
</p>
@endif
<hr>
<div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Mandor</p>
                            <h3 class="mb-0" id="totalm">Est. {{$totalm}} Ton</h3>
                        </div>
                        <p id="mantruk" style="font-size:38px; color:orange">{{$mantruk}}</p>&nbsp;&nbsp;
                        <strong><p style="font-size:15px; color:orange">Truk</p></strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">SPTA</p>
                            <h3 id="spta" class="mb-0">Est. {{$totalsp}} Ton</h3>
                        </div>
                        <p id="sptatruk" style="font-size:38px; color:blue">{{$sptatruk}}</p>&nbsp;&nbsp;
                        <strong><p style="font-size:15px; color:blue">Truk</p></strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Askep Pertama</p>
                            <h3 id="askep1" class="mb-0">Est. {{$totalaskep1}} Ton</h3>
                        </div>
                        <p id="askep1truk" style="font-size:38px; color:purple">{{$askep1truk}}</p>&nbsp;&nbsp;
                        <strong><p style="font-size:15px; color:purple">Truk</p></strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Berangkat PG</p>
                            <h3 id="otwpg" class="mb-0">Est. {{$totalotwpg}} Ton</h3>
                        </div>
                        <p id="trukberangkatpg" style="font-size:38px; color:#03fc03">{{$otwpgtruk}}</p>&nbsp;&nbsp;
                        <strong><p style="font-size:15px; color:#03fc03">Truk</p></strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Petugas PG</p>
                            <h3 id="totalaccpg" class="mb-0">Est. {{$totalaccpg}} Ton</h3>
                        </div>
                        <p id="accpgtruk" style="font-size:38px; color:#03fc2c">{{$accpgtruk}}</p>&nbsp;&nbsp;
                        <strong><p style="font-size:15px; color:#03fc2c">Truk</p></strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Askep Final</p>
                            <h3 id="totalAskep2" class="mb-0">Netto. {{$totalAskep2}} Ton</h3>
                        </div>
                        <p id="askep2Truk" style="font-size:38px; color:#fcdf03">{{$askep2Truk}}</p>&nbsp;&nbsp;
                        <strong><p style="font-size:15px; color:#fcdf03">Truk</p></strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Manajer</p>
                            <h3 id="totalManajer" class="mb-0">Netto. {{$totalManajer}} Ton</h3>
                        </div>
                        <p id="manajerTruk" style="font-size:38px; color:#02008c">{{$manajerTruk}}</p>&nbsp;&nbsp;
                        <strong><p style="font-size:15px; color:#02008c">Truk</p></strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Kasi (Belum Bayar)</p>
                            <h3 id="totalKasi" class="mb-0">Netto. {{$totalKasi}} Ton</h3>
                        </div>
                        <p id="kasiTruk" style="font-size:38px; color:#02021a">{{$kasiTruk}}</p>&nbsp;&nbsp;
                        <strong><p style="font-size:15px; color:#02021a">Truk</p></strong>
                    </div>
                </div>
            </div>
        </div>
          <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Kasi (Sudah Bayar Penebang)</p>
                            <h3 id="totalKasiByr" class="mb-0">Netto. {{$totalKasiByr}} Ton</h3>
                        </div>
                        <p id="kasiByrTruk" style="font-size:38px; color:#3e62f0">{{$kasiByrTruk}}</p>&nbsp;&nbsp;
                        <strong><p style="font-size:15px; color:#3e62f0">Truk</p></strong>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <hr>
    <p>Rekap Posisi Truk TMA Tebu</p>
    <hr>
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Estimasi</p>
                            <h3 id="totalTimbangPosisiEst" class="mb-0">Est. {{$totalTimbangPosisiEst}} Ton</h3>
                        </div>
                        <p id="trukPosisiEstimasi" style="font-size:38px; color:orange">{{$trukPosisiEstimasi}}</p>&nbsp;&nbsp;
                        <strong><p style="font-size:15px; color:orange">Truk</p></strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Masuk PG</p>
                            <h3 id="totalTimbangPosisiPG" class="mb-0">Est. {{$totalTimbangPosisiPG}} Ton</h3>
                        </div>
                        <p id="trukPosisiMasukPG" style="font-size:38px; color:blue">{{$trukPosisiMasukPG}}</p>&nbsp;&nbsp;
                        <strong><p style="font-size:15px; color:blue">Truk</p></strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="widget-chart-two-content media-body">
                            <p class="text-muted mb-0">Realisasi</p>
                            <h3 id="totalTimbangPosisiReal" class="mb-0">Netto. {{$totalTimbangPosisiReal}} Ton</h3>
                        </div>
                        <p id="trukPosisiRealisasi" style="font-size:38px; color:purple">{{$trukPosisiRealisasi}}</p>&nbsp;&nbsp;
                        <strong><p style="font-size:15px; color:purple">Truk</p></strong>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <hr>

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

    <script>

        $('#updatePage').on('change', function() {
            var id_kebun = $(this).val();
            

        $.ajax({
            url: "{{route ('homeKebun') }}",
            data: {
                kebun:id_kebun
            },
            type: 'post',
            dataType: 'JSON',
            success: function(data) {

    
                console.log(data)
                $('#totalm').html("Est. "+data.mandor+" Ton");
                $('#mantruk').html(data.mantruk);
                $('#spta').html("Est. "+data.spta+" Ton");
                $('#sptatruk').html(data.sptatruk);
                $('#askep1').html("Est. "+data.askep1+" Ton");
                $('#askep1truk').html(data.askep1truk);
                $('#trukberangkatpg').html(data.trukberangkatpg);
                $('#otwpg').html("Est. "+data.otwpg+" Ton");
                $('#totalaccpg').html("Est. "+data.accpg+" Ton");
                $('#accpgtruk').html(data.trukaccpg);
                $('#totalAskep2').html("Netto. "+data.totalAskep2+" Ton");
                $('#askep2Truk').html(data.trukAskep2);
                $('#totalManajer').html("Netto. "+data.totalManajer+" Ton");
                $('#manajerTruk').html(data.trukManajer);
                $('#totalKasi').html("Netto. "+data.totalKasi+" Ton");
                $('#kasiTruk').html(data.trukKasi);
                $('#totalKasiByr').html("Netto. "+data.totalKasiByr+" Ton");
                $('#kasiByrTruk').html(data.trukKasiByr);

                $('#totalTimbangPosisiEst').html("Est. "+data.totalEstimasi+" Ton");
                $('#trukPosisiEstimasi').html(data.trukPosisiEstimasi);

                $('#totalTimbangPosisiPG').html("Est. "+data.totalMasukPG+" Ton");
                $('#trukPosisiMasukPG').html(data.trukPosisiMasukPG);

                $('#totalTimbangPosisiReal').html("Netto. "+data.totalPosisiReal+" Ton");
                $('#trukPosisiRealisasi').html(data.trukPosisiRealisasi);



                
            },
            error: function(xhr, status) {
                alert("Sorry, there was a problem!");
            },
        });
    });
    </script>
@endsection
