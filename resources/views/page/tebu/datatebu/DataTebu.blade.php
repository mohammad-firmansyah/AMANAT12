
@extends('template.master')
@section('title', $title ?? '')
@section('nama', $nama ?? '')
@section('jabatan', $jabatan ?? '')

@section('pluginCSS')
    <!-- third party css -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <meta name="_token" content="{{csrf_token()}}" />
    <!-- third party css end -->
@endsection

@section('breadcump')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{!! url('/') !!}">Home</a></li>
        <li class="breadcrumb-item active"></li>
    </ol>
@endsection

@section('content')
<style>
        .info{
            display: none;
        }
        .icon:hover ~ .info{
            display: block;
        }
        #load {
        display:none;
        }

        /* #loader{
            display:none;
        } */
    </style>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Data </h4><br>
                        <p class="sub-header"></p>
                        @if($jabatan == "ADMIN KEBUN")
                        <p class="card-text">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modal_tambah" data-backdrop="static"><i class="fa fa-plus mr-1"></i> Tambah Data</button>
                        <span class="card-text ml-1">
                            <button type="button" id="selected_bayar" disabled onclick="Bayar()" class="btn btn-warning waves-effect waves-light"><i class="fa fa-exclamation-circle"></i> Tandai Sudah Bayar</button>
                        </span>
                        </p>
                        
                        <br>
                        @endif
                        @if($jabatan == "KASI")
                        <p class="card-text">
                        <span class="card-text ml-1">
                            <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modal_import" data-backdrop="static"><i class="fa fa-plus mr-1"></i> Import Excel</button>
                        </span>
                        </p>
                        @endif
                    
                    <div class="grupExport mb-3">
                        <span class="card-text">
                            <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modal_export_excel" data-backdrop="static"><i class="fa fa-exclamation-circle"></i> Export Excel</button>
                        </span>
                        
                        <span class="card-text ml-1">
                            <button type="button" class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#modal_export_pdf" data-backdrop="static"><i class="fa fa-exclamation-circle"></i> Export PDF</button>
                        </span>
                    </div>

                    <table id="table" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr style="text-align: center;">
                            @if($jabatan == "ADMIN KEBUN")
                            <th></th>
                            @endif
                            <th></th>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Nopol</th>
                                <th>Afdeling</th>
                                <th>Status Bayar Kebun</th>
                                <th>Timbang / Kebun</th>
                                <th>Status Tanam</th>
                                <th>Petak Tebang</th>
                                <th>Tebang Muat</th>
                                <th>Foto Truk</th>
                                <th>No SPTA</th>
                                <th>Foto SPTA</th>
                                <th>Hasil Timbang</th>
                                <th>Nota Timbang</th>
                                <th>Foto Timbang</th>
                                <th>PG Tujuan</th>
                                <th>H.Grab Vendor</th>
                                <th>H.Grab Mandiri</th>
                                <th>H.Manual</th>
                                <th>Berita Acara</th>
                                <th>Sumber Dana</th>
                                <th>Tarif Penyesuaian</th>
                                <th>Renteng</th>
                                <th>PTA</th>
                                <th>Ket Revisi</th>
                                <th>posisi data</th>
                                @if($jabatan != "DAUM" && $jabatan != "TANAMAN" && $jabatan!= "KASI" && $jabatan != "MANAJER" && $jabatan != "Admin" )
                                <th>Action</th>
                                @else
                                <th></th>
                                @endif
                                @if($jabatan == "ADMIN KEBUN" )
                                <th>Lapor</th>
                                @else
                                <th></th>
                                @endif
                            </tr>               
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end row 1233-->
    <div id="modal_tambah" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_tambah" method="post" enctype="multipart/form-data" action="{!! url('tebu/datatebu/store') !!}"> 
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Tambah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambah_nopol" class="control-label">Nopol</label>
                                    <input type="text" class="form-control" id="tambah_nopol" name="nopol" placeholder="Nopol" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambah_spta" class="control-label">SPTA</label>
                                    <input type="text" class="form-control" id="tambah_spta" name="nomor_spta" placeholder="Nomor SPTA" required>
                                </div>
                            </div>
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_afdeling" class="control-label">Kebun / Afdeling</label>
                                    <select class="form-control select2" id="tambah_afdeling" name="afdeling" required>
                                    <option value="" selected disabled> -- Pilih kebun / afdeling -- </option>
                                        @foreach ($data_afdel as $key => $value)
                                            <option value="{{ $value->afdel_id}}" > {{$value->nama_afdeling}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="petak">
                                <div class="form-group">
                                    <label for="tambah_petak" class="control-label">Petak Tebang</label>
                                    <select class="form-control select2" id="tambah_petak" name="petak" required>
                                    <option value="" selected disabled> -- Pilih Petak Tebang -- </option>
                                    <!-- @foreach ($data_petak as $key => $value)
                                            <option value="{{ $value->petak_tebu_id}}"> {{ $value->petak_tanam }} - {{$value->zonasi}} - {{$value->status}}</option>
                                        @endforeach -->
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambah_truk" class="control-label">Timbang Kebun / Estimasi</label>
                                    <select class="form-control select2" id="tambah_truk" name="truk" required>
                                    <option value="" selected disabled> -- Pilih Truk -- </option>
                                        @foreach ($timbangkeb as $key => $value)
                                            <option value="{{ $value->timbangkeb_id}}" > {{ $value->nama_truk }} -{{ $value->estimasi_berat}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambah_tebmuat" class="control-label">Tebang Muat</label>
                                    <select class="form-control select2" id="tambah_tebmuat" name="tebmuat" required>
                                    <option value="" selected disabled> -- Pilih Tebang Muat -- </option>
                                        @foreach ($tebmuat as $key => $value)
                                            <option value="{{ $value->tebang_id}}" > {{ $value->tebang_muat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
     
                            <div class="col-md-6">
                                <div class="form-group" >
                                    <label for="tambah_tebmuataskep" class="control-label">Grabber</label>
                                    <select class="form-control select2" id="tambah_tebmuataskep" name="tebmuataskep" required>
                                    <option value="" selected disabled> -- Pilih Grabber -- </option>
                                    </select>
                                </div>
                            </div>
            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambah_pta" class="control-label">PTA</label>
                                    <select class="form-control select2" id="tambah_pta" name="pta" required>
                                    <option value="" selected disabled> -- Pilih PTA -- </option>
                                        <!-- @foreach ($data_pta as $key => $value)
                                            <option value="{{ $value->pta_id}}" > {{ $value->nama_pta }}</option>
                                        @endforeach -->
                                    </select>
                                </div>
                            </div>
                    
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_renteng" class="control-label">Renteng</label>
                                    <select class="form-control select2" id="tambah_renteng" name="renteng" required>
                                    <option value="" selected disabled> -- Pilih Renteng -- </option>
                                        @foreach ($data_renteng as $key => $value)
                                            <option value="{{ $value->renteng_id}}" > {{ $value->nama_renteng }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                       
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="tambah_foto" class="control-label">Foto SPTA</label>
                                    <input type="file" class="form-control" id="tambah_foto" name="foto" placeholder="foto" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tgl_spta" class="control-label">Tanggal SPTA</label>
                                        <input type="text" class="form-control" id="tgl_spta" onfocus="this.value=''" name="tgl_spta" placeholder="Tanggal SPTA" required>
                                    </div>
                                </div>
                            

                            <p>Input Realisasi?</p>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control select2" id="tambah_pta" name="pilihan_realisasi" onchange="document.getElementById('realisasi').style.display = (this.value==1)?'':'none';">
                                    <option value=2 selected disabled> -Pilih- </option>
                                            <option value=1 > Ya</option>
                                            <option value=2 > Tidak</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div id="realisasi" style="display: none" >
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tambah_realisasi" class="control-label">Realisasi Timbang</label>
                                        <input type="number" class="form-control" id="tambah_realisasi" name="realisasi" placeholder="(Ton)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tambah_notatimbang" class="control-label">Nota Timbang</label>
                                        <input type="number" class="form-control" id="tambah_notatimbang" name="nota_timbang" placeholder="Nota Timbang">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                        <label for="tambah_tanggal" class="control-label">Tanggal Timbang</label>
                                        <input type="text" class="form-control" id="datepicker_r" onfocus="this.value=''" name="tanggal_timbang" placeholder="Tanggal Timbang">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="tambah_foto_nota" class="control-label">Foto Nota Timbang</label>
                                    <input type="file" class="form-control" id="tambah_foto_nota" name="foto_timbang" placeholder="foto">
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- sorting data export excel -->
    <div id="modal_export_excel" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_export" method="post" action="{{ route('exportExcel') }}" >
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Export Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                     <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pilih_posisi" class="control-label">Posisi</label>
                                    <select class="form-control select2" id="pilih_posisi" name="posisi_id[]" multiple>
                                        <option disabled> -- Pilih Posisi -- </option>
                                        @foreach ($posisi as $key => $value)
                                            <option value="{{ $value->posisi_id}}" > {{ $value->ket_posisi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @if($jabatan == "ADMIN KEBUN" || $jabatan == "MANAJER" )
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_kebun" class="control-label">Kebun</label>
                                <select class="form-control select2" id="pilih_kebun" name="kebun_id[]" >
                                    <option value="" selected disabled> -- Pilih Kebun -- </option>
                                    @foreach ($data_kebun as $key => $value)
                                        <option value="{{ $value->unit_id}}" selected > {{ $value->unit_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($jabatan != "ADMIN KEBUN" && $jabatan != "MANAJER" )
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_kebun" class="control-label">Kebun</label>
                                <select class="form-control select2" id="pilih_kebun" name="kebun_id[]" multiple>
                                    <option disabled> -- Pilih Kebun -- </option>
                                    @foreach ($data_kebun as $key => $value)
                                        <option value="{{ $value->unit_id}}" > {{ $value->unit_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_afdeling" class="control-label">Afdeling</label>
                                <select class="form-control select2" id="pilih_afdeling" name="afdel_id[]" multiple>
                                    <option disabled> -- Pilih Afdeling -- </option>
                                    @foreach ($data_afdel as $key => $value)
                                        <option value="{{ $value->afdel_id}}" > {{ $value->nama_afdeling }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_status" class="control-label">Status</label>
                                <select class="form-control select2" id="pilih_status" name="status_tanam[]" multiple>
                                    <option disabled> -- Pilih Status -- </option>
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $value}}" > {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_status_bayar" class="control-label">Status Bayar Kebun</label>
                                <select class="form-control select2" id="pilih_status_bayar" name="bayar[]" multiple>
                                    <option disabled> -- Pilih Status -- </option>
                                    <option value=1>Sudah Bayar</option>
                                    <option value=0>Belum Bayar</option> 
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_sumdana" class="control-label">Sumber Dana</label>
                                <select class="form-control select2" id="pilih_sumdana" name="sumdana[]" multiple>
                                    <option disabled> -- Pilih Status -- </option>
                                        <option value="IP PEN" >IP PEN</option>
                                        <option value="NON IP PEN" >NON IP PEN</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <p style="font-size:10px">Klik Kolom Untuk Menghapus Value</p>
                                <label for="filter_date" class="control-label">Pilih Tanggal</label>
                               <p><input type="text" id="from_datepicker" name="start_date"  onfocus="this.value=''" placeholder="Tanggal Awal"> sampai <input type="text" id="to_datepicker"  onfocus="this.value=''" name="end_date" placeholder="Tanggal Akhir" ></p>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_tanggal" class="control-label">Pilih Jenis Tanggal</label>
                                <select class="form-control select2" id="pilih_tanggal" name="pilihan_tanggal" >
                                    <option selected disabled> -- Pilih Tanggal -- </option>
                                    <option value=1>Tanggal SPTA</option>
                                    <option value=2>Tanggal Timbang</option> 
                                    <option value=3>Tanggal SPTA dan Timbang</option> 
                                </select>
                            </div>
                        </div>
                        </div>

                        
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light" >Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- end row -->
    <!-- sorting data export pdf -->
    <div id="modal_export_pdf" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_export_pdf" method="post" action="{{ route('exportPDF') }}" target="_blank">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Export Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="pilih_posisi_p" class="control-label">Posisi</label>
                                    <select class="form-control select2" id="pilih_posisi_p" name="posisi_id[]" multiple>
                                        <option disabled> -- Pilih Posisi -- </option>
                                        @foreach ($posisi as $key => $value)
                                            <option value="{{ $value->posisi_id}}" > {{ $value->ket_posisi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_afdeling_p" class="control-label">Afdeling</label>
                                <select class="form-control select2" id="pilih_afdeling_p" name="afdel_id[]" multiple>
                                    <option disabled> -- Pilih Afdeling -- </option>
                                    @foreach ($data_afdel as $key => $value)
                                        <option value="{{ $value->afdel_id}}" > {{ $value->nama_afdeling }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @if($jabatan == "ADMIN KEBUN" || $jabatan == "MANAJER" )
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_kebun_p" class="control-label">Kebun</label>
                                <select class="form-control select2" id="pilih_kebun_p" name="kebun_id[]" >
                                    <option value="" selected disabled> -- Pilih Kebun -- </option>
                                    @foreach ($data_kebun as $key => $value)
                                        <option value="{{ $value->unit_id}}" selected> {{ $value->unit_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($jabatan != "ADMIN KEBUN" && $jabatan != "MANAJER" )
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_kebun_p" class="control-label">Kebun</label>
                                <select class="form-control select2" id="pilih_kebun_p" name="kebun_id[]" multiple >
                                    <option disabled> -- Pilih Kebun -- </option>
                                    @foreach ($data_kebun as $key => $value)
                                        <option value="{{ $value->unit_id}}"> {{ $value->unit_nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_status" class="control-label">Status</label>
                                <select class="form-control select2" id="pilih_status_p" name="status_tanam[]" multiple>
                                    <option disabled> -- Pilih Status -- </option>
                                    @foreach ($status as $key => $value)
                                        <option value="{{ $value}}" > {{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_status_bayar_p" class="control-label">Status Bayar Kebun</label>
                                <select class="form-control select2" id="pilih_status_bayar_p" name="bayar[]" multiple>
                                    <option disabled> -- Pilih Status -- </option>
                                    <option value=1>Sudah Bayar</option>
                                    <option value=0>Belum Bayar</option> 
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_sumdana_p" class="control-label">Sumber Dana</label>
                                <select class="form-control select2" id="pilih_sumdana_p" name="sumdana[]" multiple>
                                    <option disabled> -- Pilih Status -- </option>
                                        <option value="IP PEN" >IP PEN</option>
                                        <option value="NON IP PEN" >NON IP PEN</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <p style="font-size:10px">Klik Kolom Untuk Menghapus Value</p>
                                <label for="filter_date" class="control-label">Pilih Tanggal</label>
                               <p><input type="text" id="from_datepicker_p" name="start_date"  onfocus="this.value=''" placeholder="Tanggal Awal"> sampai <input type="text" id="to_datepicker_p"  onfocus="this.value=''" name="end_date" placeholder="Tanggal Akhir" ></p>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                    <div class="col-md-12">
                            <div class="form-group">
                                <label for="pilih_tanggal" class="control-label">Pilih Jenis Tanggal</label>
                                <select class="form-control select2" id="pilih_tanggal" name="pilihan_tanggal" >
                                    <option selected disabled> -- Pilih Tanggal -- </option>
                                    <option value=1>Tanggal SPTA</option>
                                    <option value=2>Tanggal Timbang</option> 
                                    <option value=3>Tanggal SPTA dan Timbang</option> 
                                </select>
                            </div>
                        </div>
                        </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light third">Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- laporrr -->
<div id="modal_lapor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_lapor" method="post" action="{!! url('tebu/lapor/foto/tma') !!}" >
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Lapor Foto</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" id="lapor_id" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_lapor" class="control-label">Keterangan Laporan</label>
                                    <input type="text" class="form-control" id="ubah_lapor" name="ket_foto_salah" placeholder="Keterangan" >
                                </div>
                            </div>
                        </div>  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light" >Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
<!-- modal import  -->
    <div id="modal_import" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Multi Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="close_modal">×</button>
                    </div>
                    <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-margin">
                                <label for="excel_import" class="control-label">Import Excel</label>
                                <input type="file" class="form-control" id="excel_import" name="excel" placeholder="excel import" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"required>
                            </div>
                        </div>
                    </div>

                    <div class="row" >
                        <div class="col-md-4">
                            <div class="form-group no-margin">
                                <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal"      data-target="#modal_check" id="impor">Check Data</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group no-margin">
                            <a><button type="button" class="btn btn-warning waves-effect waves-light" onclick="window.open('https://drive.google.com/file/d/1RIeDoZMLGY6vKKL0dRvPwlDWs8gw1VRZ/view?usp=sharing','_blank')">Template Data</button></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-light waves-effect" data-dismiss="modal" id="close_modal">Close</button> -->
                        <button type="submit" class="btn btn-info waves-effect waves-light" id="impor_excel" id="close_modal">Simpan</button>
                    </div>
            </div>
        </div>
</div>
    

        <!-- modal check -->
    <div id="modal_check" class="modal1 fade"  role="dialog" aria-labelledby="MyModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
            <form id="modal_check"> 
                    <div class="modal-header">
                        <h4 class="modal-title">Data Tertera</h4>
                    </div>
                    <div class="modal-body p-4">
                    <!-- <div id="loader"><img src="https://i.gifer.com/ZZ5H.gif"></div> -->
                        <div id="loader"><img src="https://i.ibb.co/tYXL9Cx/cartoon.gif"></div>
                    <div id="load">
                    <div class="row">
                         <div class="col-md-6">
                         <label for="datatertera_belum" class="control-label">Pengajuan KASI</label>
                            <div class="form-group" >
                                <div style="width: 200px;max-height: 400px;overflow-y:scroll;overflow-x:hidden">
                                   <table border="1">
                                        <thead>
                                            <tr>
                                                <th>Nomor SPTA</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datatertera_belum" >
                                        </tbody>   
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <label for="datatertera_sudah" class="control-label">Sudah Bayar Kasi</label>
                            <div class="form-group" >
                                <div style="width: 200px;max-height: 400px;overflow-y:scroll;overflow-x:hidden">
                                   <table border="1">
                                        <thead>
                                            <tr>
                                                <th>Nomor SPTA</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datatertera_sudah" >
                                        </tbody>   
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>  
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- 
6-13-12 -->



   

    

@endsection

@section('pluginJS')
    <!-- third party js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Buttons js -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>

    <!-- Responsive js -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatables init -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <!-- datepicker -->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

@endsection

@section('customJS')
    <script type="text/javascript">


        var tabel;

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
            $('#pilih_posisi').select2({dropdownParent: $("#modal_export_excel")});
            $('#pilih_posisi').select2({width: '100%'});
            $('#pilih_afdeling').select2({dropdownParent: $("#modal_export_excel")});
            $('#pilih_afdeling').select2({width: '100%'});
            $('#pilih_kebun').select2({dropdownParent: $("#modal_export_excel")});
            $('#pilih_kebun').select2({width: '100%'}); 
            $('#pilih_status').select2({dropdownParent: $("#modal_export_excel")}); 
            $('#pilih_status').select2({width: '100%'}); 
            $('#pilih_status_bayar').select2({dropdownParent: $("#modal_export_excel")}); 
            $('#pilih_status_bayar').select2({width: '100%'}); 
            $('#pilih_sumdana').select2({dropdownParent: $("#modal_export_excel")}); 
            $('#pilih_sumdana').select2({width: '100%'}); 
            $('#pilih_posisi_p').select2({dropdownParent: $("#modal_export_pdf")});
            $('#pilih_afdeling_p').select2({dropdownParent: $("#modal_export_pdf")});
            $('#pilih_kebun_p').select2({dropdownParent: $("#modal_export_pdf")}); 
            $('#pilih_status_p').select2({dropdownParent: $("#modal_export_pdf")});
            $('#pilih_status_bayar_p').select2({dropdownParent: $("#modal_export_pdf")}); 
            $('#pilih_sumdana_p').select2({dropdownParent: $("#modal_export_pdf")}); 
            $('#tambah_afdeling_p').select2({dropdownParent: $("#modal_tambah") });
            $('#pilih_posisi_p').select2({width: '100%'});
            $('#pilih_afdeling_p').select2({width: '100%'});
            $('#pilih_kebun_p').select2({width: '100%'}); 
            $('#pilih_status_p').select2({width: '100%'}); 
            $('#pilih_status_bayar_p').select2({width: '100%'}); 
            $('#tambah_afdeling').select2({width: '100%'});
            $('#tambah_afdeling').on('select2:select', function (e) {
                var data = e.params.data;
                console.log(data);
                $.post( '{{ url('tebu/data/spinnerpetaktebang') }}', {"afdel_id":data.id})
                    .done(function( data ) {
                        let petak = [];
                        $('#tambah_petak').empty();
                        for(let a of data.petaktebang)petak.push({id:a.petak_tebu_id,text:a.petak_tanam+'  -  '+a.zonasi+'  -  '+a.status})
                        $('#tambah_petak').select2({ data: petak })
                        console.log( "Data Loaded: ", data );
                });
                $.post( '{{ url('tebu/data/getpta/web') }}', {"afdel_id":data.id})
                    .done(function( data ) {
                        let pta = [];
                        $('#tambah_pta').empty();
                        for(let a of data.dataPTA)pta.push({id:a.pta_id,text:a.nama_pta})
                        $('#tambah_pta').select2({ data: pta })
                        console.log( "Data Loaded: ", data );
                });

            });
            $('#tambah_tebmuataskep').select2({dropdownParent: $("#modal_tambah")});
            $('#tambah_tebmuat').select2({dropdownParent: $("#modal_tambah")});
            $('#tambah_tebmuat').select2({width: '100%'});
            $("#tambah_tebmuat").on('select2:select', function(){
                let tebmuatID = $(this).val();
                if (tebmuatID == 1) {
                     let datagrab = [
                        {
                            id:0,
                            text: '-- Pilih Graber -- ',
                            disabled:"disabled",
                            selected:"selected"
                        },
                        {
                            id: 'Graber Kebun',
                            text: 'Graber Kebun'
                        },
                        {
                            id: 'Graber Vendor',
                            text: 'Graber Vendor'
                        }
                    ];
                    $('#tambah_tebmuataskep').empty();
                    $("#tambah_tebmuataskep").select2({
                        data: datagrab
                    });
                } else {
                    let datagrab = [
                        {
                            id: 'Manual',
                            text: 'Manual'
                        }
                    ];
                    $('#tambah_tebmuataskep').empty();
                    $("#tambah_tebmuataskep").select2({
                        data: datagrab
                    });
                }
            });

            
            // $('#tambah_pta').select2({dropdownParent: $("#modal_tambah")});
            $('#tambah_renteng').select2({dropdownParent: $("#modal_tambah")});
            $('#tambah_renteng').select2({width: '100%'});

            


            tabel = $('#table').DataTable({
                processing: false,
                serverSide: true,
                // ajax: '{{ url('tebu/datatebu/get', [$data1['unit_id']]) }}',
                // ajax: '{{ url('tebu/datatebu/get') }}',
                ajax : {
                    'url' : '{{ url('tebu/datatebu/get') }}',
                    'type' : 'post',
                    'data' : {_token: "{{csrf_token()}}"}
                },
                order: [],
                columns: [
                    {"defaultContent": "", orderable: false, searchable: false},
                    @if($jabatan != "DAUM" && $jabatan != "TANAMAN" && $jabatan!= "KASI" && $jabatan != "MANAJER" && $jabatan != "Admin" )
                    { data: 'checkbox', "render": function ( data, type, row ) 
                        {
                            if (row.bayar_checked === 0 ) {
                                return `<input type="checkbox" class="select" value="${row.tma_id}">`;
                            }else{
                                return ` <input type="checkbox" class="select" value="${row.tma_id}" disabled>`;
                            }

                        
                        },
                        searchable: false,sortable: false,
                    },
                    @endif
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'user_nama', name : 'user.user_nama'},
                    { data: 'nopol', name : 'nopol'},
                    { data: 'kebun_afdeling', name : 'kebun_afdeling'},
                    { data: 'bayar_checked', "render":function (data,type,row){
                        if (data === 1){
                            return `<div style="background-color: #cfc ; padding: 7px; solid green;">Sudah Bayar</div>`;
                        }else{
                            return  `<div style="background-color: #ffda6b ; padding: 7px; solid yellow;">Belum Bayar</div>`;
                        }
                    }},
                    { data: 'nama_truk', name: 'master_timbangkebun.nama_truk' },
                    { data: 'statustanam_id', name: 'statustanam_id' },
                    { data: 'petak_tanam', name: 'master_petaktebang_tebu.petak_tanam' },
                    { data: 'tebang_muat', name: 'master_tebangmuat.tebang_muat' },
                    { data: 'foto', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="fototruk(${row.tma_id})">foto truk</button>`;
                        },
                        searchable: false
                    },
                    { data: 'nomor_spta', name: 'nomor_spta' },
                    { data: 'foto_spta', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="fotospta('${row.tma_id}')">foto SPTA</button>`;
                        },
                        searchable: false
                    },
                    { data: 'hasil_timbang', name: 'hasil_timbang' },
                    { data: 'nota_timbang', name: 'nota_timbang' },
                    { data: 'foto_timbang', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="fototimbang('${row.tma_id}')">foto Nota Timbang</button>`;
                        },
                        searchable: false
                    },
                    { data: 'pg_tujuan', name: 'pg_tujuan' },
                    { data: 'hrg_grab_vendor', name: 'hrg_grab_vendor' },
                    { data: 'hrg_grab_mandiri', name: 'hrg_grab_mandiri' },
                    { data: 'hrg_manual', name: 'hrg_manual' },
                    { data: 'berita_acara', name: 'berita_acara' },
                    { data: 'sumber_dana', name: 'sumber_dana' },
                    { data: 'tarif_penyesuaian', name: 'tarif_penyesuaian' },
                    { data: 'nama_renteng', name: 'master_rentengtebang.nama_renteng' },
                    { data: 'nama_pta', name: 'master_pta.nama_pta' },
                    { data: 'ket_revisi', name: 'ket_revisi' },
                    { data: 'ket_posisi', name: 'master_posisi.ket_posisi' },
                    @if($jabatan != "DAUM" && $jabatan != "TANAMAN" && $jabatan!= "KASI" && $jabatan != "MANAJER" && $jabatan != "Admin" )
                    { data: 'posisi_id', 'render':function(data,type,row){
                    
                        if (data === 1 || data === 16){
                            return  `<button type="button" class="btn btn-danger waves-effect waves-light btn-sm" onclick="ubahStatus(${row.tma_id}, ${data})">Hapus Data</button>`;
                        }else {
                                return `<button type="button" class="btn btn-danger waves-effect waves-light btn-sm" onclick="ubahStatus(${row.tma_id}, ${data})" disabled>Hapus Data</button>`;
                            }
                    }},
                    @endif
                    @if($jabatan == "ADMIN KEBUN")
                    { data: 'is_foto_salah', 'render':function(data,type,row){
                    
                    if (data === 0){
                        return  `<button type="button" class="btn btn-danger waves-effect waves-light btn-sm" onclick='lapor(${JSON.stringify(row)})'>Lapor Foto</button>`;
                    }else {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick='lapor(${JSON.stringify(row)})' disabled>Terlapor</button>`;
                        }
                    },
                    orderable: false,
                    searchable: false
                    }
                    @endif
                ]
            });
        });

        $('#close_modal').on("click", function(){
            $('#modal_check').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        });

        function lapor(row) {
            $('#lapor_id').val(row.tma_id);
            $('#modal_lapor').modal({backdrop: 'static', show: true});
        }


        

        // $('#loadingDiv').hide().ajaxStart( function() {
        // $(this).show();  // show Loading Div
        // } ).ajaxStop ( function(){
        // $(this).hide(); // hide loading div
        // });

        // $(window).on('load', function(){
        
        // });
        // $('#impor').on("click", function(){
            
        //     $("#datatertera_sudah").empty()
        //     $("#datatertera_belum").empty()
        // });

        
        $('#impor').on("click", function(){
            let file = $('#excel_import').prop('files')[0];
            console.log(file)
            let form_data = new FormData();
            form_data.append('excel', file);
            console.log(form_data);
            var waitTimeUntilFadeOut = 2000 ;
            $("#loader").show();
            $("#load").hide();
            $("#datatertera_sudah").empty()
            $("#datatertera_belum").empty()
            //alert(form_data);
            $.ajax({
                url: '{{ url('tebu/import/excel') }}',
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                data: form_data,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $("#datatertera_sudah").empty()
                    $("#datatertera_belum").empty()
                    for (const key in data) {
                        // if (Object.hasOwnProperty.call(data, key)) {
                        //     const element = object[key];
                            
                        // }
                        console.log(data[key].posisi_id);
                        if(data[key].posisi_id === 15){
                            $("#datatertera_sudah").append(`
                            <tr>
                                <td>${data[key].nomor_spta}</td>
                                <td>${data[key].ket_pos}</td>
                            </tr>
                        `)
                        }
                        if(data[key].posisi_id === 14){
                            $("#datatertera_belum").append(`
                            <tr>
                                <td>${data[key].nomor_spta}</td>
                                <td>${data[key].ket_pos}</td>
                            </tr>
                        `)
                        }
                        // if(data[key].posisi_id === 15){
                        //     $("#datatertera_belum").append(`
                        //     <tr>
                        //         <td style="background-color: #cfc ; padding: 7px; solid green;">${data[key].nomor_spta}</td>
                        //         <td style="background-color: #cfc ; padding: 7px; solid green;">${data[key].ket_pos}</td>
                        //     </tr>
                        // `)
                        // }
                    }
                    $('#loader').fadeOut ('slow', function() {
                        $('#load').fadeIn ('slow');
                    });
                    
                }
                
            });
        });

   
                    
        

        $('#impor_excel').on("click", function(){
            let file = $('#excel_import').prop('files')[0];
            console.log(file)
            let form_data = new FormData();
            form_data.append('excel', file);
            console.log(form_data);
            //alert(form_data);
            $.ajax({
                url: '{{ url('tebu/import/excel/update') }}',
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                data: form_data,
                dataType: 'JSON',
                beforeSend: function() {
                    $(this).find(':submit').prop('disabled', true);
                },
                complete:function() {
                    $(this).find(':submit').prop('disabled', false);
                },
                success: function (data) {
                    tabel.ajax.reload();
                    if (data.success) {
                        $("#modal_import").modal('hide');
                        $('#modal_check').modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        Swal.fire({ title: "Ubah Data!", text: "Ubah Data Berhasil.", type: "success" })
                    } else {
                        Swal.fire({ title: "Error", text: data.message, type: "error" });
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    Swal.fire({ title: "Error", text: "Ubah Data Gagal", type: "error" });
                }
                
            });
        });

        
        document.getElementById("tambah_realisasi").onkeypress = function(e) {
            var chr = String.fromCharCode(e.which);
            if (",\"".indexOf(chr) >= 0)
                return false;
        };


        // Checkbox Function
        let yangDicheck = 0;

        
        $("#select_all").on('click',function(){
            var isChecked = $("#select_all").prop('checked')
           $(".select").prop('checked',isChecked)
           $("#selected_bayar").prop('disabled',!isChecked)
        })

        $("#table").on('click','.select',function(){
            if($(this).prop('checked')!=true){
                $("#select_all").prop('checked',false)
            }
            
            let semua_checkbox = $("#table .select:checked")
            let button_non_aktif_status = (semua_checkbox.length>0)
            $("#selected_bayar").prop('disabled',!button_non_aktif_status)
        })

        function Bayar(){
            let checkbox_terpilih = $("#table .select:checked")
            let semua_id = []
            $.each(checkbox_terpilih,function(index,elm){
                semua_id.push(elm.value)
            })
            Swal.fire({
                    title: 'Yakin Untuk Ubah Status?',
                    text: "Status Data Yang Anda Pilih Akan Menjadi Sudah Bayar  ",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Kirim !'
                    }).then((result) => {
                        console.log(result);
                    if (result.value) {
                        $.ajax({
                                url: '{{url('tebu/datatebu/sudahbayar')}}',
                                method : 'post',
                                data:{id_bayar:semua_id},
                                success:function(res){
                                    Swal.fire(
                                        'Approved!',
                                        'Your data has been approved.',
                                        'success'
                                    ).then(function(){ 
                                        location.reload();
                                        });
                                    table.ajax.reload(null,false)
                                }
                            })
                    }
                    });
        }


        function ubahStatus(id, status) {
            Swal.fire({
                title: "Yakin Untuk Hapus Data?",
                text: "Data Yang Anda Pilih Akan Di Hapus ",
                type: "warning",
                showCancelButton: true,
                cancelButtonText: "Tidak",
                confirmButtonText: "Iya",
                confirmButtonClass: "btn btn-success width-xs ml-2 mt-2",
                cancelButtonClass: "btn btn-danger width-xs mt-2",
                buttonsStyling: false,
                reverseButtons: true,
                allowOutsideClick: false,
                preConfirm: () => {
                    return new Promise(function (resolve) {
                        $.ajax({
                            url: `{!! url('tebu/datatebu/hapus') !!}/${id}`,
                            type: 'put',
                            data: {'status': status},
                            dataType: 'json',
                            success: function (data) {
                                console.log(data);
                                if (data.success) {
                                    tabel.ajax.reload();
                                    resolve("success");
                                } else {
                                    resolve("failure");
                                }
                            },
                            error: function (xhr, status, error) {
                                resolve("error");
                            },
                        });
                    })
                },
            }).then(function (result) {
                if (result.value) {
                    result.value == "success" ? Swal.fire({ title: "Terhapus!", text: "Menghapus Data Berhasil.", type: "success" })
                        : Swal.fire({ title: "Error", text: "Hapus Data Gagal", type: "error" });
                } else {
                    result.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Batal", text: "Hapus Data Batal", type: "error" });
                }
            });
        }


        // $("#select_all").on('click',function(){
        //     var isChecked = $("#select_all").prop('checked')
        //    $(".select").prop('checked',isChecked)
        //    $("#selected_hapus").prop('disabled',!isChecked)

        // })

        // $("#table").on('click','.select',function(){
        //     if($(this).prop('checked')!=true){
        //         $("#select_all").prop('checked',false)
        //     }

        //     $("#table .select:checked").empty()
        //     let semua_checkbox = $("#table .select:checked")
        //     let button_non_aktif_status = (semua_checkbox.length>0 && $(this).attr( "allow-del") == '1')
        //     $("#selected_hapus").prop('disabled',!button_non_aktif_status)
        //     console.log(button_non_aktif_status)
        // })

        // function Hapus(){
        //     let checkbox_terpilih = $("#table .select:checked")
        //     let semua_id = []
        //     $.each(checkbox_terpilih,function(index,elm){
        //         semua_id.push(elm.value)
        //     })
        //     Swal.fire({
        //             title: 'Yakin Untuk Hapus Data?',
        //             text: "Data Yang Anda Pilih Akan Di Hapus ",
        //             type: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: 'Ya'
        //             }).then((result) => {
        //                 console.log(result);
        //             if (result.value) {
        //                 $.ajax({
        //                         url: '{{url('tebu/datatebu/hapus')}}',
        //                         method : 'post',
        //                         data:{id_hapus:semua_id},
        //                         success:function(res){
        //                             Swal.fire(
        //                                 'Approved!',
        //                                 'Your data has been deleted.',
        //                                 'success'
        //                             ).then(function(){ 
        //                                 location.reload();
        //                                 });
        //                             table.ajax.reload(null,false)
        //                         }
        //                     })
        //             }
        //             });
        // }

        $('#modal_tambah').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        })

        


        function real(a)
        {
            if(a==1)
                document.getElementById("real").style.display="none";
            else
                document.getElementById("real").style.display="block";
        }


        $( function() {
        $( "#from_datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#to_datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#from_datepicker" ).attr("autocomplete", "off");
        $("#to_datepicker").attr("autocomplete", "off");
        });

        $( function() {
        $( "#from_datepicker_spta" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#to_datepicker_spta" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#from_datepicker_spta" ).attr("autocomplete", "off");
        $("#to_datepicker_spta").attr("autocomplete", "off");
        });
        
        $( function() {
        $( "#from_datepicker_notim" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#to_datepicker_notim" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#from_datepicker_notim" ).attr("autocomplete", "off");
        $("#to_datepicker_notim").attr("autocomplete", "off");
        });
        
        

        $( function() {
        $( "#from_datepicker_spta_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#to_datepicker_spta_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#from_datepicker_spta_p" ).attr("autocomplete", "off");
        $("#to_datepicker_spta_p").attr("autocomplete", "off");
        });

        $( function() {
        $( "#from_datepicker_notim_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#to_datepicker_notim_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#from_datepicker_notim_p" ).attr("autocomplete", "off");
        $("#to_datepicker_notim_p").attr("autocomplete", "off");
        });


        $( function() {
        $( "#from_datepicker_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#to_datepicker_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#from_datepicker_p" ).attr("autocomplete", "off");
        $("#to_datepicker_p").attr("autocomplete", "off");
        });



        $( function() {
        $( "#datepicker_r" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $("#datepicker_r").attr("autocomplete", "off");
        });

        $( function() {
        $("#tgl_spta").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#tgl_spta").attr("autocomplete", "off");
        });

      


        


        

        document.querySelector(".third").addEventListener('click', function(){
        Swal.fire("Data Yang Anda Input Sedang Diproses", "Perlu Diperhatikan Export PDF Akan Memakan Waktu Lebih Lama Dikarenakan Data Yang Sangat Banyak", "success");
        });
        
        
        function fototruk(foto) {
            let urlFoto = '/foto/truk/'+foto
            $('#modal_tampak').modal('show');
            $.ajax({url: urlFoto})
            .done(function( data ) {
                let htmlForImage = "";
                for (const item of data.images) {   
                    htmlForImage+=`<image class='img-fluid' src='${item}'>`
                }
                Swal.fire({
                    title: 'Foto Truk',
                    width: 800,
                    html: htmlForImage,
                })
            });
        }


        function fotospta(foto_spta) {
            $('#modal_tampak').modal('show');
            $.ajax({url: `{{ URL::to('/foto/spta') }}/${foto_spta}`,})
            .done(function( data ) {
                let htmlForImage = "";
                for (const item of data.images) {   
                    htmlForImage+=`<image class='img-fluid' src='${item}'>`
                }
                Swal.fire({
                    title: 'Foto Spta',
                    width: 800,
                    html: htmlForImage,
                })
            });
        }


        function fototimbang(foto_timbang) {
            $('#modal_tampak').modal('show');
            $.ajax({url: `{{ URL::to('foto/timbang') }}/${foto_timbang}`,})
            .done(function( data ) {
                let htmlForImage = "";
                for (const item of data.images) {   
                    htmlForImage+=`<image class='img-fluid' src='${item}'>`
                }
                Swal.fire({
                    title: 'Foto Timbang',
                    width: 800,
                    html: htmlForImage,
                })
            });
        }

        

        

        $('#form_tambah').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url:$(this).attr("action"),
                data:new FormData(this),
                type:$(this).attr("method"),
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $(this).find(':submit').prop('disabled', true);
                },
                complete:function() {
                    $(this).find(':submit').prop('disabled', false);
                },
                success:function(data) {
                    tabel.ajax.reload();
                    console.log('success:', data);
                    if (data.success) {
                        $("#modal_tambah").modal('hide');
                        Swal.fire({ title: "Tambah Data!", text: "Tambah Data Berhasil.", type: "success" });
                    } else {
                        Swal.fire({ title: "Error", text: data.message, type: "error" });
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    Swal.fire({ title: "Error", text: "Data Tidak Berhasil Ditambah", type: "error" });
                }
            });
        });

        $('#form_lapor').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url:$(this).attr("action"),
                data:new FormData(this),
                type:$(this).attr("method"),
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $(this).find(':submit').prop('disabled', true);
                },
                complete:function() {
                    $(this).find(':submit').prop('disabled', false);
                },
                success:function(data) {
                    tabel.ajax.reload();
                    if (data.success) {
                        $("#modal_lapor").modal('hide');
                        Swal.fire({ title: "Ubah Data!", text: "Ubah Data Berhasil.", type: "success" });
                    } else {
                        Swal.fire({ title: "Error", text: "Ubah Data Gagal", type: "error" });
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    Swal.fire({ title: "Error", text: "Ubah Data Gagal", type: "error" });
                }
            });
        });

    </script>

    </script>

@endsection


<!-- 09/11/2022 baruu-->