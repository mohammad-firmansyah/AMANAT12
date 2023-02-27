
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
    </style>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Data </h4><br>
                        <p class="sub-header"></p>
                    
                    <div class="grupExport mb-3">
                        <span class="card-text">
                            <button type="button" id="selected" disabled onclick="Approve()" class="btn btn-success waves-effect waves-light" ><i class="fa fa-check-circle"></i> Approve</button>
                        </span>
                        
                        <span class="card-text ml-1">
                            <button type="button" id="selected_reject" disabled class="btn btn-danger waves-effect waves-light " data-toggle="modal" data-target="#modal_reject" ><i class="fa fa-times"></i> Reject</button>
                        </span>
                    </div>


                    <table id="table" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr style="text-align: center;">
                            <th></th>
                            <th><input type="checkbox" id="select_all"></th>
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
                                <th>Action</th>
                            </tr>               
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end row 1233-->
    <div id="modal_tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_tambah" method="post" enctype="multipart/form-data" action="{!! url('tebu/adminedit/datatebu/edit') !!}"> 
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                    <input type="hidden" id="tambah_id" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambah_nopol" class="control-label">Nopol</label>
                                    <input type="text" class="form-control" id="tambah_nopol" name="nopol" placeholder="Nopol" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambah_spta" class="control-label">SPTA</label>
                                    <input type="text" class="form-control" id="tambah_spta" name="nomor_spta" placeholder="Nomor SPTA" >
                                </div>
                            </div>
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_afdeling" class="control-label">Kebun / Afdeling</label>
                                    <select class="form-control select2" id="tambah_afdeling" name="afdeling" >
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
                                    <select class="form-control select2" id="tambah_petak" name="petak" >
                                    <option value="" selected disabled> -- Pilih Petak Tebang -- </option>
                                    @foreach ($data_petak as $key => $value)
                                            <option value="{{ $value->petak_tebu_id}}"> {{ $value->petak_tanam }} - {{$value->zonasi}} - {{$value->status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambah_truk" class="control-label">Timbang Kebun / Estimasi</label>
                                    <select class="form-control select2" id="tambah_truk" name="truk" >
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
                                    <select class="form-control select2" id="tambah_tebmuat" name="tebmuat" >
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
                                    <option value="Graber Kebun" disabled>Grabber Kebun</option>
                                    <option value="Graber Vendor" disabled>Grabber Vendor</option>
                                    <option value="Manual" disabled>Manual</option>
                                    </select>
                                </div>
                            </div>
            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambah_pta" class="control-label">PTA</label>
                                    <select class="form-control select2" id="tambah_pta" name="pta" >
                                    <option value="" selected disabled> -- Pilih PTA -- </option>
                                        @foreach ($data_pta as $key => $value)
                                            <option value="{{ $value->pta_id}}" > {{ $value->nama_pta }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_renteng" class="control-label">Renteng</label>
                                    <select class="form-control select2" id="tambah_renteng" name="renteng" >
                                    <option value="" selected disabled> -- Pilih Renteng -- </option>
                                        @foreach ($data_renteng as $key => $value)
                                            <option value="{{ $value->renteng_id}}" > {{ $value->nama_renteng }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                       
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tambah_sumdana" class="control-label">Sumber Dana</label>
                                    <select class="form-control select2" id="tambah_sumdana" name="sumber_dana" >
                                    <option value="" selected disabled> -- Pilih Sumber Dana-- </option>
                                       <option value="IP PEN" >IP PEN</option>
                                       <option value="NON IP PEN">NON IP PEN</option>
                                    </select>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group no-margin">
                                    <label for="tambah_foto" class="control-label">Foto SPTA</label>
                                    <input type="file" class="form-control" id="tambah_foto" name="foto" placeholder="foto" >
                                </div>
                            </div>
                        </div>
                        
                        <p>	&nbsp;&nbsp;Edit Tarif Penyesuaian Angkut?</p>
                    
                        <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control select2" id="tambah_" onchange="document.getElementById('penyesuaian').style.display = (this.value==1)?'':'none';">
                                    <option value=2 selected disabled> -Pilih- </option>
                                            <option value=1 > Ya</option>
                                            <option value=2 > Tidak</option>
                                    </select>
                                </div>
                            </div>


                            <div id="penyesuaian" style="display: none" >
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tambah_tarifpenye" class="control-label" id="tambah_tarifpenye_text">Tarif Penyesuaian</label>
                                            <input type="text" class="form-control" id="tambah_tarifpenye" name="tarif_penyesuaian" placeholder="tarif penyesuaian">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group no-margin">
                                            <label for="tambah_BA" class="control-label" id="tambah_BA_text">Upload BA</label>
                                            <input type="file" class="form-control" id="tambah_BA" name="tambah_ba" placeholder="BA" >
                                        </div>
                                    </div>
                            </div>

                            <p>&nbsp;&nbsp;Edit Tarif Penyesuaian Tebang Muat?</p>
                    
                        <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control select2" id="tambah_teb" onchange="document.getElementById('tebmuat_penyesuaian').style.display = (this.value==1)?'':'none';">
                                    <option value=2 selected disabled> -Pilih- </option>
                                            <option value=1 > Ya</option>
                                            <option value=2 > Tidak</option>
                                    </select>
                                </div>
                            </div>


                            <div id="tebmuat_penyesuaian" style="display: none" >
                            <!-- <div id="grabber" style="display: none" > -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tambah_tarifpenyeteb" class="control-label" id="tambah_tarifpenyeteb_text">Tarif Penyesuaian Tebang</label>
                                            <input type="text" class="form-control" id="tambah_tarifpenyeteb" name="tarif_penyesuaian_tebang" placeholder="tarif penyesuaian Tebang">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tambah_tarifpenyeGrab" class="control-label" id="tambah_tarifpenyeGrab_text">Tarif Penyesuaian Grabber</label>
                                            <input type="text" class="form-control" id="tambah_tarifpenyeGrab" name="tarif_penyesuaian_grab" placeholder="tarif penyesuaian Grabber">
                                        </div>
                                    </div>
                            <!-- </div> -->
                            <!-- <div id="manual" style="display: none" > -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tambah_tarifpenyeMan" class="control-label" id="tambah_tarifpenyeMan_text">Tarif Penyesuaian Manual</label>
                                            <input type="text" class="form-control" id="tambah_tarifpenyeMan" name="tarif_penyesuaian_manual" placeholder="tarif penyesuaian Manual">
                                        </div>
                                    </div>
                            <!-- </div> -->
                            </div>
                    

                            <p>&nbsp;&nbsp;Input Realisasi?</p>
                            <div class="row">
                                <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control select2" id="tambah_23" name="pilihan_realisasi"
                                        onchange="document.getElementById('realisasi').style.display = (this.value==1)?'':'none';">
                                        <option value=2 selected disabled> -Pilih- </option>
                                        <option value=1> Ya</option>
                                        <option value=2> Tidak</option>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div id="realisasi" class="row" style="display: none">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tambah_realisasi" class="control-label">Realisasi Timbang</label>
                                        <input type="number" class="form-control" id="tambah_realisasi" name="realisasi"
                                            placeholder="(Ton)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tambah_notatimbang" class="control-label">Nota Timbang</label>
                                        <input type="number" class="form-control" id="tambah_notatimbang"
                                            name="nota_timbang" placeholder="Nota Timbang">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tambah_tanggal" class="control-label">Tanggal Timbang</label>
                                        <input type="text" class="form-control" id="datepicker_r" onfocus="this.value=''"
                                            name="tanggal_timbang" placeholder="Tanggal Timbang" data-provide='datepicker'
                                            data-date-container='#modal_tambah'>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group no-margin">
                                        <label for="tambah_foto_nota" class="control-label">Foto Nota Timbang</label>
                                        <input type="file" class="form-control" id="tambah_foto_nota" name="foto_timbang"
                                            placeholder="foto">
                                    </div>
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

    <!-- form edit jika data sudah terbayar -->
    
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
                    @if($jabatan == "ADMIN KEBUN")
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
                    @if($jabatan != "ADMIN KEBUN")
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
                                <p style="font-size:10px">Klik Kolom Untuk Menghapus Value</p>
                                <label for="filter_date" class="control-label">Filter By Date</label>
                               <p><input type="text" id="from_datepicker" name="start_date"  onfocus="this.value=''" placeholder="first date"> to <input type="text" id="to_datepicker"  onfocus="this.value=''" name="end_date" placeholder="last date" ></p>
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
    <div id="modal_reject" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- <form id="reject"> -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Reject Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ket_revisi1" class="control-label">Keterangan revisi</label>
                                    <input type="text" class="form-control" id="ket_revisi1" name="revisi" placeholder="Ket_Revisi" required>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info waves-effect waves-light" onclick="Reject()">Simpan</button>
                    </div>
                </div>
                <!-- </form> -->
            </div>
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
            $('#pilih_afdeling').select2({dropdownParent: $("#modal_export_excel")});
            $('#pilih_kebun').select2({dropdownParent: $("#modal_export_excel")}); 
            $('#pilih_status').select2({dropdownParent: $("#modal_export_excel")}); 
            $('#pilih_posisi_p').select2({dropdownParent: $("#modal_export_pdf")});
            $('#pilih_afdeling_p').select2({dropdownParent: $("#modal_export_pdf")});
            $('#pilih_kebun_p').select2({dropdownParent: $("#modal_export_pdf")}); 
            $('#pilih_status_p').select2({dropdownParent: $("#modal_export_pdf")});
            $('#tambah_afdeling').select2({dropdownParent: $("#modal_tambah")});
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
                            id:0,
                            text: '-- Pilih Graber -- ',
                            disabled:"disabled",
                            selected:"selected"
                        },
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

            $('#tambah_afdeling').select2({width: '100%'});
            $('#tambah_tebmuat').select2({width: '100%'});
            $("#tambah_petak").select2({dropdownParent: $("#modal_tambah")})
            $('#tambah_petak').select2({width: '100%'});
            $('#tambah_truk').select2({dropdownParent: $("#modal_tambah")})
            $('#tambah_truk').select2({width: '100%'});
            $('#tambah_pta').select2({dropdownParent: $("#modal_tambah")})
            $('#tambah_pta').select2({width: '100%'});
            $('#tambah_tebmuataskep').select2({width: '100%'});
            // $('#tambah_pta').select2({dropdownParent: $("#modal_tambah")});
            $('#tambah_renteng').select2({dropdownParent: $("#modal_tambah")});
            $('#tambah_renteng').select2({width: '100%'});
            
            tabel = $('#table').DataTable({
                processing: false,
                serverSide: true,
                // ajax: '{{ url('tebu/datatebu/get', [$data1['unit_id']]) }}',
                // ajax: '{{ url('tebu/datatebu/get') }}',
                ajax : {
                    'url' : '{{ url('approve/datatebu/get') }}',
                    'type' : 'post',
                     async:true,
                    'data' : {_token: "{{csrf_token()}}"}
                },
                order: [],
                columns: [
                    {"defaultContent": "", orderable: false, searchable: false},
                    { data: 'checkbox', "render": function ( data, type, row ) 
                        {
                            return `<input type="checkbox" class="select" value="${row.tma_id}">`;
                        },
                        searchable: false,sortable: false,
                    },
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
                    { data: 'data_tmatebu', "render": function ( data, type, row ) 
                        {
                                return `<button type="button" class="btn btn-warning waves-effect waves-light btn-sm" onclick='ubah(${JSON.stringify(row)})'> <i class="fa fa-pen mr-1"></i> <span>Ubah Data</span></button>`;
                        },
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        let yangDicheck = 0;

        //approve manajer

        $("#select_all").on('click',function(){
            var isChecked = $("#select_all").prop('checked')
           $(".select").prop('checked',isChecked)
           $("#selected").prop('disabled',!isChecked)
        })

        $("#table").on('click','.select',function(){
            if($(this).prop('checked')!=true){
                $("#select_all").prop('checked',false)
            }

            let semua_checkbox = $("#table .select:checked")
            let button_non_aktif_status = (semua_checkbox.length>0)
            $("#selected").prop('disabled',!button_non_aktif_status)
        })

        ///s

        //reject manajer

        $("#select_all").on('click',function(){
            var isChecked = $("#select_all").prop('checked')
           $(".select").prop('checked',isChecked)
           $("#selected_reject").prop('disabled',!isChecked)
        })

        $("#table").on('click','.select',function(){
            if($(this).prop('checked')!=true){
                $("#select_all").prop('checked',false)
            }

            let semua_checkbox = $("#table .select:checked")
            let button_non_aktif_status = (semua_checkbox.length>0)
            $("#selected_reject").prop('disabled',!button_non_aktif_status)
        })

        $('#modal_tambah').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        })

        ///

        function Approve(){
            let checkbox_terpilih = $("#table .select:checked")
            let semua_id = []
            $.each(checkbox_terpilih,function(index,elm){
                semua_id.push(elm.value)
            })
            Swal.fire({
                    title: 'Yakin Untuk Approve Data?',
                    text: "Data Yang Anda Pilih Akan Di Approve ",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Kirim !'
                    }).then((result) => {
                        console.log(result);
                    if (result.value) {
                        $.ajax({
                                url: '{{url('manajer/datatebu/approve')}}',
                                method : 'post',
                                data:{id_approve:semua_id},
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
        
        function Reject(){
            let checkbox_terpilih = $("#table .select:checked")
            let semua_id = []
            $.each(checkbox_terpilih,function(index,elm){
                semua_id.push(elm.value)
            })
            Swal.fire({
                    title: 'Yakin Untuk Reject Data?',
                    text: "Data Yang Anda Pilih Akan Di Reject",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Kirim !'
                    }).then((result) => {
                        console.log(result);
                    if (result.value) {
                        $.ajax({
                                url: '{{url('manajer/datatebu/reject')}}',
                                method : 'post',
                                data:{id_reject:semua_id,revisi:$('#ket_revisi1').val()},
                                success:function(res){
                                    Swal.fire(
                                        'Sended!',
                                        'Your data has been Rejected!',
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

        $( function() {
        $( "#from_datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#to_datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#from_datepicker" ).attr("autocomplete", "off");
        $("#to_datepicker").attr("autocomplete", "off");
        });

        $( function() {
        $( "#from_datepicker_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#to_datepicker_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#from_datepicker_p" ).attr("autocomplete", "off");
        $("#to_datepicker_p").attr("autocomplete", "off");
        });

        $(function () {
            $("#datepicker_r").datepicker({ dateFormat: 'yy-mm-dd',container:'#modal_tambah' });
            $("#datepicker_r").attr("autocomplete", "off");
            $("#datepicker_r").click(()=>{
              setTimeout(() => {
                $('#ui-datepicker-div').css('top', `${window.innerHeight/2}px`);
              }, 100);
            })
        });

        // document.querySelector(".third").addEventListener('click', function(){
        //     swal({
        //     title: "Reject Data Success", 
        //     text: "Data Yang Anda Pilih Berhasil Di Reject", 
        //     type: "warning"})
        //     });


        
        
        function fototruk(foto_approve) {
            let urlFoto = '/foto/truk/'+foto_approve
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


        function fotospta(foto_spta_approve) {
            $('#modal_tampak').modal('show');
            $.ajax({url: `{{ URL::to('/foto/spta') }}/${foto_spta_approve}`,})
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


        function fototimbang(foto_timbang_approve) {
            $('#modal_tampak').modal('show');
            $.ajax({url: `{{ URL::to('foto/timbang') }}/${foto_timbang_approve}`,})
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
             $('#tambah_tebmuataskep').change(function() {
            alert($(this).val());
        });


        $(document).ready(function(){
            $('#tambah_tebmuataskep').on('change', function() {
                if ( this.value == "Graber Vendor") {
                    $("#tambah_tarifpenyeteb_text , #tambah_tarifpenyeteb").show();
                    $("#tambah_tarifpenyeGrab_text , #tambah_tarifpenyeGrab").show();
                    $("#tambah_tarifpenyeMan_text , #tambah_tarifpenyeMan").hide();
                } if(this.value == "Graber Kebun") {
                    $("#tambah_tarifpenyeteb_text , #tambah_tarifpenyeteb").show();
                    $("#tambah_tarifpenyeGrab_text , #tambah_tarifpenyeGrab").hide();
                    $("#tambah_tarifpenyeMan_text , #tambah_tarifpenyeMan").hide();
                } if(this.value == "Manual"){
                    $("#tambah_tarifpenyeteb_text , #tambah_tarifpenyeteb").hide();
                    $("#tambah_tarifpenyeGrab_text , #tambah_tarifpenyeGrab").hide();
                    $("#tambah_tarifpenyeMan_text , #tambah_tarifpenyeMan").show();
                }
            }).trigger('change'); 
        });


        function ubah(row) {
           $('#tambah_id').val(row.tma_id);
            // $('#tambah_afdeling').find(":selected").text(row.afdel_id);
            $("#tambah_afdeling").val(row.afdel_id).change();
            $("#tambah_petak").val(row.petak_id).change();
            $('#tambah_pta').val(row.pta_id).change();
            $('#tambah_renteng').val(row.renteng_id).change();
            $('#tambah_sumdana').val(row.sumber_dana).change();
            $('#tambah_truk').val(row.timbangkeb_id).change();
            $('#tambah_tebmuat').val(row.tebang_id).change();
            $('#tambah_tebmuataskep').val(row.tebmuat_askep).change();
            $('#tambah_spta').prop('placeholder',row.nomor_spta);
            $('#tambah_nopol').prop('placeholder',row.nopol);
            if (row.bayar_checked == 1){
                $('#tambah_').attr("disabled","disabled");
                $('#tambah_tarifpenye_text').hide();
                $('#tambah_BA_text').hide();
                $('#tambah_tarifpenye').hide();
                $('#tambah_BA').hide();
            }else{
                $('#tambah_').attr("disabled",false);
                $('#tambah_tarifpenye_text').show();
                $('#tambah_BA_text').show();
                $('#tambah_tarifpenye').show();
                $('#tambah_BA').show();
            }
            if( row.hrg_grab_vendor == null && row.hrg_grab_mandiri == null && row.hrg_manual == null || row.bayar_checked == 1){
                $('#tambah_teb').attr('disabled',true);
                $('#tambah_tarifpenyeteb_text').hide();
                $('#tambah_tarifpenyeteb').hide();
                $('#tambah_tarifpenyeGrab_text').hide();
                $('#tambah_tarifpenyeGrab').hide();
                $('#tambah_tarifpenyeMan_text').hide();
                $('#tambah_tarifpenyeMan').hide();
            }else{
                $('#tambah_teb').attr('disabled',false);
            }
        //     $(document).ready(function(){
        //     $('#tambah_tebmuataskep').on('change', function() {
        //         if ( row.tebmuat_askep == "Graber Vendor") {
        //             $("#tambah_tarifpenyeteb_text , #tambah_tarifpenyeteb").show();
        //             $("#tambah_tarifpenyeGrab_text , #tambah_tarifpenyeGrab").show();
        //             $("#tambah_tarifpenyeMan_text , #tambah_tarifpenyeMan").hide();
        //         } if(row.tebmuat_askep == "Graber Kebun") {
        //             $("#tambah_tarifpenyeteb_text , #tambah_tarifpenyeteb").show();
        //             $("#tambah_tarifpenyeGrab_text , #tambah_tarifpenyeGrab").hide();
        //             $("#tambah_tarifpenyeMan_text , #tambah_tarifpenyeMan").hide();
        //         } if(row.tebmuat_askep == "Manual"){
        //             $("#tambah_tarifpenyeteb_text , #tambah_tarifpenyeteb").hide();
        //             $("#tambah_tarifpenyeGrab_text , #tambah_tarifpenyeGrab").hide();
        //             $("#tambah_tarifpenyeMan_text , #tambah_tarifpenyeMan").show();
        //         }
        //     }).trigger('change'); 
        // });

            $('#modal_tambah').modal({backdrop: 'static', show: true});
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
                    if (data.success) {
                        $("#modal_tambah").modal('hide');
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
@endsection

