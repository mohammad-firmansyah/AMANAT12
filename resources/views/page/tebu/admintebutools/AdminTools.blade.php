
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
<p>Tools Reset TMA Tebu</p>
@if(Session::get('success') == 'true')
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong class="font-family-secondary"> Berhasil ubah data !</strong> data yang diubah sebanyak  {{Session::get('total')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@elseif(Session::get('success') == 'false')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong class="font-family-secondary">Gagal ubah data !</strong> Coba cek lagi
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<hr>
<form id="admin_tools" method="post" action="{{ route('Reset') }}">
    @csrf
    <p>
        Pilih Tipe Reset :
        <select  class="form-control select2" id="pilih_tipe" style="width:250px" name="tipe">
            <option value="" selected disabled> -- Pilih Tipe -- </option>
            <option value='1'>Range Waktu</option>
            <option value='2'>Nomor SPTA</option>
        </select>
    </p>
    <div class="modal-body p-4">
        <div class="row" id="NoSPTA" style="display:none">
                <div class="col-md-12">
                    <div class="form-group" style="float:left;">
                        <label for="nospta" class="control-label">Nomor SPTA</label>
                        <textarea type="text" class="form-control" id="nospta" onfocus="this.value=''" name="nospta" placeholder="Nomor SPTA" ></textarea>
                    </div>
                </div>
        </div>


        <div class="row" id="Waktu" style="display:none"> 
            <div class="col-md-12">
                <div class="form-group" style="float:left;">
                <label for="filter_date" class="control-label">Pilih Tanggal</label>
                <p><input type="text" class="form-control" style="width:250px;float:left;" id="from_datepicker" name="start_date"  onfocus="this.value=''" placeholder="Tanggal Awal"> &nbsp; sampai &nbsp;<input type="text"  class="form-control"  id="to_datepicker"  style="width:250px;float:right;" onfocus="this.value=''" name="end_date" placeholder="Tanggal Akhir" ></p>
                </div>
            </div>
        </div>

        <div class="row" id="Unit" style="display:none">
        <div class="col-md-12">
                <div class="form-group" style="float:left;">
                <label for="Kebun" class="control-label">Pilih Kebun</label>
                <select  class="form-control select2" id="pilih_kebun" name="unit_kebun[]" multiple >
                    <option value='5'>Kalitelepak</option>
                    <option value='6'>Mumbul</option>
                    <option value='12'>Kaliselogiri</option>
                    <option value='28'>Sumber Tengah</option>
                    <option value='13'>Sungai Lembu</option>
                </select>
                </div>
            </div>
        </div>

        <p style="font-size:10px">Kosongi Kolom Jika Tidak Ada Perubahan</p>

        <div class="row" id="Kebun" style="display:none">
            <div class="col-md-12">
                <div class="form-group" style="float:left;">
                    <label for="grab_kebun" class="control-label">Harga Graber Kebun</label>
                    <input type="number" class="form-control" id="grab_kebun" onfocus="this.value=''" name="harga_kebun" placeholder="Harga Graber Kebun" >
                </div>
            </div>
        </div>

        <div class="row" id="Vendor" style="display:none">
            <div class="col-md-12">
                <div class="form-group" style="float:left;">
                    <label for="grab_vendor" class="control-label">Harga Graber Vendor</label>
                    <input type="number" class="form-control" id="grab_vendor" onfocus="this.value=''" name="harga_vendor" placeholder="Harga Graber Vendor" >
                </div>
            </div>
        </div>

        <div class="row" id="Manual" style="display:none">
            <div class="col-md-12">
                <div class="form-group" style="float:left;">
                    <label for="manual" class="control-label">Harga Manual</label>
                    <input type="number" class="form-control" id="manual" onfocus="this.value=''" name="tarif_manual" placeholder="Harga Manual" >
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="simpan" class="btn btn-info waves-effect waves-light">Simpan</button>
    </div>
    
</form>

                    





   

    

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


        $('#pilih_kebun').select2({dropdownParent: $("#admin_tools")});
        $('#pilih_kebun').select2({allowClear: true});

        $(document).ready(function(){
            $('#pilih_tipe').on('change', function() {
            if ( this.value == '1')
            {
                $("#Waktu").show();
                $("#NoSPTA").hide();
                $("#Vendor").show();
                $("#Kebun").show();
                $("#Manual").show();
                $("#Unit").show();
                $("#pilih_kebun").val('').trigger('change');
                $("#nospta").val('').trigger('change');
                $("#from_datepicker").val('').trigger('change');
                $("#to_datepicker").val('').trigger('change');
                $("#grab_kebun").val('').trigger('change');
                $("#grab_vendor").val('').trigger('change');
                $("#manual").val('').trigger('change');
            }
            else
            {
                $("#NoSPTA").show();
                $("#Waktu").hide();
                $("#Vendor").show();
                $("#Kebun").show();
                $("#Manual").show();
                $("#Unit").hide();
                $("#pilih_kebun").val('').trigger('change');
                $("#nospta").val('').trigger('change');
                $("#from_datepicker").val('').trigger('change');
                $("#to_datepicker").val('').trigger('change');
                $("#grab_kebun").val('').trigger('change');
                $("#grab_vendor").val('').trigger('change');
                $("#manual").val('').trigger('change');
            }
            });
        });

        $( function() {
        $( "#from_datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#to_datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#from_datepicker" ).attr("autocomplete", "off");
        $("#to_datepicker").attr("autocomplete", "off");
        });

        $("#simpan").on('click', function(){
            //console.log($('#nospta').val());
            if (confirm("Sudah Yakin ?")) {
                $("#admin_tools").submit();
                
            } else {
                alert("Periksa");
            }
            //$("#admin_tools").submit();
        })

    //     var tabel;

    //     $(document).ready(function() {
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //                 }
    //             });
    //         $('#pilih_posisi').select2({dropdownParent: $("#modal_export_excel")});
    //         $('#pilih_posisi').select2({width: '100%'});
    //         $('#pilih_afdeling').select2({dropdownParent: $("#modal_export_excel")});
    //         $('#pilih_afdeling').select2({width: '100%'});
    //         $('#pilih_kebun').select2({dropdownParent: $("#modal_export_excel")});
    //         $('#pilih_kebun').select2({width: '100%'}); 
    //         $('#pilih_status').select2({dropdownParent: $("#modal_export_excel")}); 
    //         $('#pilih_status').select2({width: '100%'}); 
    //         $('#pilih_status_bayar').select2({dropdownParent: $("#modal_export_excel")}); 
    //         $('#pilih_status_bayar').select2({width: '100%'}); 
    //         $('#pilih_sumdana').select2({dropdownParent: $("#modal_export_excel")}); 
    //         $('#pilih_sumdana').select2({width: '100%'}); 
    //         $('#pilih_posisi_p').select2({dropdownParent: $("#modal_export_pdf")});
    //         $('#pilih_afdeling_p').select2({dropdownParent: $("#modal_export_pdf")});
    //         $('#pilih_kebun_p').select2({dropdownParent: $("#modal_export_pdf")}); 
    //         $('#pilih_status_p').select2({dropdownParent: $("#modal_export_pdf")});
    //         $('#pilih_status_bayar_p').select2({dropdownParent: $("#modal_export_pdf")}); 
    //         $('#pilih_sumdana_p').select2({dropdownParent: $("#modal_export_pdf")}); 
    //         $('#tambah_afdeling_p').select2({dropdownParent: $("#modal_tambah") });
    //         $('#pilih_posisi_p').select2({width: '100%'});
    //         $('#pilih_afdeling_p').select2({width: '100%'});
    //         $('#pilih_kebun_p').select2({width: '100%'}); 
    //         $('#pilih_status_p').select2({width: '100%'}); 
    //         $('#pilih_status_bayar_p').select2({width: '100%'}); 
    //         $('#tambah_afdeling').select2({width: '100%'});
    //         $('#tambah_afdeling').on('select2:select', function (e) {
    //             var data = e.params.data;
    //             console.log(data);
    //             $.post( '{{ url('tebu/data/spinnerpetaktebang') }}', {"afdel_id":data.id})
    //                 .done(function( data ) {
    //                     let petak = [];
    //                     $('#tambah_petak').empty();
    //                     for(let a of data.petaktebang)petak.push({id:a.petak_tebu_id,text:a.petak_tanam+'  -  '+a.zonasi+'  -  '+a.status})
    //                     $('#tambah_petak').select2({ data: petak })
    //                     console.log( "Data Loaded: ", data );
    //             });
    //             $.post( '{{ url('tebu/data/getpta/web') }}', {"afdel_id":data.id})
    //                 .done(function( data ) {
    //                     let pta = [];
    //                     $('#tambah_pta').empty();
    //                     for(let a of data.dataPTA)pta.push({id:a.pta_id,text:a.nama_pta})
    //                     $('#tambah_pta').select2({ data: pta })
    //                     console.log( "Data Loaded: ", data );
    //             });

    //         });
    //         $('#tambah_tebmuataskep').select2({dropdownParent: $("#modal_tambah")});
    //         $('#tambah_tebmuat').select2({dropdownParent: $("#modal_tambah")});
    //         $('#tambah_tebmuat').select2({width: '100%'});
    //         $("#tambah_tebmuat").on('select2:select', function(){
    //             let tebmuatID = $(this).val();
    //             if (tebmuatID == 1) {
    //                  let datagrab = [
    //                     {
    //                         id:0,
    //                         text: '-- Pilih Graber -- ',
    //                         disabled:"disabled",
    //                         selected:"selected"
    //                     },
    //                     {
    //                         id: 'Graber Kebun',
    //                         text: 'Graber Kebun'
    //                     },
    //                     {
    //                         id: 'Graber Vendor',
    //                         text: 'Graber Vendor'
    //                     }
    //                 ];
    //                 $('#tambah_tebmuataskep').empty();
    //                 $("#tambah_tebmuataskep").select2({
    //                     data: datagrab
    //                 });
    //             } else {
    //                 let datagrab = [
    //                     {
    //                         id: 'Manual',
    //                         text: 'Manual'
    //                     }
    //                 ];
    //                 $('#tambah_tebmuataskep').empty();
    //                 $("#tambah_tebmuataskep").select2({
    //                     data: datagrab
    //                 });
    //             }
    //         });

            
    //         // $('#tambah_pta').select2({dropdownParent: $("#modal_tambah")});
    //         $('#tambah_renteng').select2({dropdownParent: $("#modal_tambah")});
    //         $('#tambah_renteng').select2({width: '100%'});

            


    //         tabel = $('#table').DataTable({
    //             processing: false,
    //             serverSide: true,
    //             // ajax: '{{ url('tebu/datatebu/get', [$data1['unit_id']]) }}',
    //             // ajax: '{{ url('tebu/datatebu/get') }}',
    //             ajax : {
    //                 'url' : '{{ url('tebu/datatebu/get') }}',
    //                 'type' : 'post',
    //                 'data' : {_token: "{{csrf_token()}}"}
    //             },
    //             order: [],
    //             columns: [
    //                 {"defaultContent": "", orderable: false, searchable: false},
    //                 @if($jabatan != "DAUM" && $jabatan != "TANAMAN" && $jabatan!= "KASI" && $jabatan != "MANAJER" && $jabatan != "Admin" )
    //                 { data: 'checkbox', "render": function ( data, type, row ) 
    //                     {
    //                         if (row.bayar_checked === 0 ) {
    //                             return `<input type="checkbox" class="select" value="${row.tma_id}">`;
    //                         }else{
    //                             return ` <input type="checkbox" class="select" value="${row.tma_id}" disabled>`;
    //                         }

                        
    //                     },
    //                     searchable: false,sortable: false,
    //                 },
    //                 @endif
    //                 { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
    //                 { data: 'user_nama', name : 'user.user_nama'},
    //                 { data: 'nopol', name : 'nopol'},
    //                 { data: 'kebun_afdeling', name : 'kebun_afdeling'},
    //                 { data: 'bayar_checked', "render":function (data,type,row){
    //                     if (data === 1){
    //                         return `<div style="background-color: #cfc ; padding: 7px; solid green;">Sudah Bayar</div>`;
    //                     }else{
    //                         return  `<div style="background-color: #ffda6b ; padding: 7px; solid yellow;">Belum Bayar</div>`;
    //                     }
    //                 }},
    //                 { data: 'nama_truk', name: 'master_timbangkebun.nama_truk' },
    //                 { data: 'statustanam_id', name: 'statustanam_id' },
    //                 { data: 'petak_tanam', name: 'master_petaktebang_tebu.petak_tanam' },
    //                 { data: 'tebang_muat', name: 'master_tebangmuat.tebang_muat' },
    //                 { data: 'foto', "render": function ( data, type, row ) 
    //                     {
    //                         return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="fototruk(${row.tma_id})">foto truk</button>`;
    //                     },
    //                     searchable: false
    //                 },
    //                 { data: 'nomor_spta', name: 'nomor_spta' },
    //                 { data: 'foto_spta', "render": function ( data, type, row ) 
    //                     {
    //                         return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="fotospta('${row.tma_id}')">foto SPTA</button>`;
    //                     },
    //                     searchable: false
    //                 },
    //                 { data: 'hasil_timbang', name: 'hasil_timbang' },
    //                 { data: 'nota_timbang', name: 'nota_timbang' },
    //                 { data: 'foto_timbang', "render": function ( data, type, row ) 
    //                     {
    //                         return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="fototimbang('${row.tma_id}')">foto Nota Timbang</button>`;
    //                     },
    //                     searchable: false
    //                 },
    //                 { data: 'pg_tujuan', name: 'pg_tujuan' },
    //                 { data: 'hrg_grab_vendor', name: 'hrg_grab_vendor' },
    //                 { data: 'hrg_grab_mandiri', name: 'hrg_grab_mandiri' },
    //                 { data: 'hrg_manual', name: 'hrg_manual' },
    //                 { data: 'berita_acara', name: 'berita_acara' },
    //                 { data: 'sumber_dana', name: 'sumber_dana' },
    //                 { data: 'tarif_penyesuaian', name: 'tarif_penyesuaian' },
    //                 { data: 'nama_renteng', name: 'master_rentengtebang.nama_renteng' },
    //                 { data: 'nama_pta', name: 'master_pta.nama_pta' },
    //                 { data: 'ket_revisi', name: 'ket_revisi' },
    //                 { data: 'ket_posisi', name: 'master_posisi.ket_posisi' },
    //                 @if($jabatan != "DAUM" && $jabatan != "TANAMAN" && $jabatan!= "KASI" && $jabatan != "MANAJER" && $jabatan != "Admin" )
    //                 { data: 'posisi_id', 'render':function(data,type,row){
                    
    //                     if (data === 1 || data === 16){
    //                         return  `<button type="button" class="btn btn-danger waves-effect waves-light btn-sm" onclick="ubahStatus(${row.tma_id}, ${data})">Hapus Data</button>`;
    //                     }else {
    //                             return `<button type="button" class="btn btn-danger waves-effect waves-light btn-sm" onclick="ubahStatus(${row.tma_id}, ${data})" disabled>Hapus Data</button>`;
    //                         }
    //                 }},
    //                 @endif
    //                 @if($jabatan == "ADMIN KEBUN")
    //                 { data: 'is_foto_salah', 'render':function(data,type,row){
                    
    //                 if (data === 0){
    //                     return  `<button type="button" class="btn btn-danger waves-effect waves-light btn-sm" onclick='lapor(${JSON.stringify(row)})'>Lapor Foto</button>`;
    //                 }else {
    //                         return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick='lapor(${JSON.stringify(row)})' disabled>Terlapor</button>`;
    //                     }
    //                 },
    //                 orderable: false,
    //                 searchable: false
    //                 }
    //                 @endif
    //             ]
    //         });
    //     });

    //     $('#close_modal').on("click", function(){
    //         $('#modal_check').modal('hide');
    //         $('body').removeClass('modal-open');
    //         $('.modal-backdrop').remove();
    //     });

    //     function lapor(row) {
    //         $('#lapor_id').val(row.tma_id);
    //         $('#modal_lapor').modal({backdrop: 'static', show: true});
    //     }


        

    //     // $('#loadingDiv').hide().ajaxStart( function() {
    //     // $(this).show();  // show Loading Div
    //     // } ).ajaxStop ( function(){
    //     // $(this).hide(); // hide loading div
    //     // });

    //     // $(window).on('load', function(){
        
    //     // });
    //     // $('#impor').on("click", function(){
            
    //     //     $("#datatertera_sudah").empty()
    //     //     $("#datatertera_belum").empty()
    //     // });

        
    //     $('#impor').on("click", function(){
    //         let file = $('#excel_import').prop('files')[0];
    //         console.log(file)
    //         let form_data = new FormData();
    //         form_data.append('excel', file);
    //         console.log(form_data);
    //         var waitTimeUntilFadeOut = 2000 ;
    //         $("#loader").show();
    //         $("#load").hide();
    //         $("#datatertera_sudah").empty()
    //         $("#datatertera_belum").empty()
    //         //alert(form_data);
    //         $.ajax({
    //             url: '{{ url('tebu/import/excel') }}',
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //             type: 'POST',
    //             data: form_data,
    //             dataType: 'JSON',
    //             success: function (data) {
    //                 console.log(data);
    //                 $("#datatertera_sudah").empty()
    //                 $("#datatertera_belum").empty()
    //                 for (const key in data) {
    //                     // if (Object.hasOwnProperty.call(data, key)) {
    //                     //     const element = object[key];
                            
    //                     // }
    //                     console.log(data[key].posisi_id);
    //                     if(data[key].posisi_id === 15){
    //                         $("#datatertera_sudah").append(`
    //                         <tr>
    //                             <td>${data[key].nomor_spta}</td>
    //                             <td>${data[key].ket_pos}</td>
    //                         </tr>
    //                     `)
    //                     }
    //                     if(data[key].posisi_id === 14){
    //                         $("#datatertera_belum").append(`
    //                         <tr>
    //                             <td>${data[key].nomor_spta}</td>
    //                             <td>${data[key].ket_pos}</td>
    //                         </tr>
    //                     `)
    //                     }
    //                     // if(data[key].posisi_id === 15){
    //                     //     $("#datatertera_belum").append(`
    //                     //     <tr>
    //                     //         <td style="background-color: #cfc ; padding: 7px; solid green;">${data[key].nomor_spta}</td>
    //                     //         <td style="background-color: #cfc ; padding: 7px; solid green;">${data[key].ket_pos}</td>
    //                     //     </tr>
    //                     // `)
    //                     // }
    //                 }
    //                 $('#loader').fadeOut ('slow', function() {
    //                     $('#load').fadeIn ('slow');
    //                 });
                    
    //             }
                
    //         });
    //     });

   
                    
        

    //     $('#impor_excel').on("click", function(){
    //         let file = $('#excel_import').prop('files')[0];
    //         console.log(file)
    //         let form_data = new FormData();
    //         form_data.append('excel', file);
    //         console.log(form_data);
    //         //alert(form_data);
    //         $.ajax({
    //             url: '{{ url('tebu/import/excel/update') }}',
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //             type: 'POST',
    //             data: form_data,
    //             dataType: 'JSON',
    //             beforeSend: function() {
    //                 $(this).find(':submit').prop('disabled', true);
    //             },
    //             complete:function() {
    //                 $(this).find(':submit').prop('disabled', false);
    //             },
    //             success: function (data) {
    //                 tabel.ajax.reload();
    //                 if (data.success) {
    //                     $("#modal_import").modal('hide');
    //                     $('#modal_check').modal('hide');
    //                     $('body').removeClass('modal-open');
    //                     $('.modal-backdrop').remove();
    //                     Swal.fire({ title: "Ubah Data!", text: "Ubah Data Berhasil.", type: "success" })
    //                 } else {
    //                     Swal.fire({ title: "Error", text: data.message, type: "error" });
    //                 }
    //             },
    //             error: function (data) {
    //                 console.log('Error:', data);
    //                 Swal.fire({ title: "Error", text: "Ubah Data Gagal", type: "error" });
    //             }
                
    //         });
    //     });

        
    //     document.getElementById("tambah_realisasi").onkeypress = function(e) {
    //         var chr = String.fromCharCode(e.which);
    //         if (",\"".indexOf(chr) >= 0)
    //             return false;
    //     };


    //     // Checkbox Function
    //     let yangDicheck = 0;

        
    //     $("#select_all").on('click',function(){
    //         var isChecked = $("#select_all").prop('checked')
    //        $(".select").prop('checked',isChecked)
    //        $("#selected_bayar").prop('disabled',!isChecked)
    //     })

    //     $("#table").on('click','.select',function(){
    //         if($(this).prop('checked')!=true){
    //             $("#select_all").prop('checked',false)
    //         }
            
    //         let semua_checkbox = $("#table .select:checked")
    //         let button_non_aktif_status = (semua_checkbox.length>0)
    //         $("#selected_bayar").prop('disabled',!button_non_aktif_status)
    //     })

    //     function Bayar(){
    //         let checkbox_terpilih = $("#table .select:checked")
    //         let semua_id = []
    //         $.each(checkbox_terpilih,function(index,elm){
    //             semua_id.push(elm.value)
    //         })
    //         Swal.fire({
    //                 title: 'Yakin Untuk Ubah Status?',
    //                 text: "Status Data Yang Anda Pilih Akan Menjadi Sudah Bayar  ",
    //                 type: 'warning',
    //                 showCancelButton: true,
    //                 confirmButtonColor: '#3085d6',
    //                 cancelButtonColor: '#d33',
    //                 confirmButtonText: 'Kirim !'
    //                 }).then((result) => {
    //                     console.log(result);
    //                 if (result.value) {
    //                     $.ajax({
    //                             url: '{{url('tebu/datatebu/sudahbayar')}}',
    //                             method : 'post',
    //                             data:{id_bayar:semua_id},
    //                             success:function(res){
    //                                 Swal.fire(
    //                                     'Approved!',
    //                                     'Your data has been approved.',
    //                                     'success'
    //                                 ).then(function(){ 
    //                                     location.reload();
    //                                     });
    //                                 table.ajax.reload(null,false)
    //                             }
    //                         })
    //                 }
    //                 });
    //     }


    //     function ubahStatus(id, status) {
    //         Swal.fire({
    //             title: "Yakin Untuk Hapus Data?",
    //             text: "Data Yang Anda Pilih Akan Di Hapus ",
    //             type: "warning",
    //             showCancelButton: true,
    //             cancelButtonText: "Tidak",
    //             confirmButtonText: "Iya",
    //             confirmButtonClass: "btn btn-success width-xs ml-2 mt-2",
    //             cancelButtonClass: "btn btn-danger width-xs mt-2",
    //             buttonsStyling: false,
    //             reverseButtons: true,
    //             allowOutsideClick: false,
    //             preConfirm: () => {
    //                 return new Promise(function (resolve) {
    //                     $.ajax({
    //                         url: `{!! url('tebu/datatebu/hapus') !!}/${id}`,
    //                         type: 'put',
    //                         data: {'status': status},
    //                         dataType: 'json',
    //                         success: function (data) {
    //                             console.log(data);
    //                             if (data.success) {
    //                                 tabel.ajax.reload();
    //                                 resolve("success");
    //                             } else {
    //                                 resolve("failure");
    //                             }
    //                         },
    //                         error: function (xhr, status, error) {
    //                             resolve("error");
    //                         },
    //                     });
    //                 })
    //             },
    //         }).then(function (result) {
    //             if (result.value) {
    //                 result.value == "success" ? Swal.fire({ title: "Terhapus!", text: "Menghapus Data Berhasil.", type: "success" })
    //                     : Swal.fire({ title: "Error", text: "Hapus Data Gagal", type: "error" });
    //             } else {
    //                 result.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Batal", text: "Hapus Data Batal", type: "error" });
    //             }
    //         });
    //     }


    //     // $("#select_all").on('click',function(){
    //     //     var isChecked = $("#select_all").prop('checked')
    //     //    $(".select").prop('checked',isChecked)
    //     //    $("#selected_hapus").prop('disabled',!isChecked)

    //     // })

    //     // $("#table").on('click','.select',function(){
    //     //     if($(this).prop('checked')!=true){
    //     //         $("#select_all").prop('checked',false)
    //     //     }

    //     //     $("#table .select:checked").empty()
    //     //     let semua_checkbox = $("#table .select:checked")
    //     //     let button_non_aktif_status = (semua_checkbox.length>0 && $(this).attr( "allow-del") == '1')
    //     //     $("#selected_hapus").prop('disabled',!button_non_aktif_status)
    //     //     console.log(button_non_aktif_status)
    //     // })

    //     // function Hapus(){
    //     //     let checkbox_terpilih = $("#table .select:checked")
    //     //     let semua_id = []
    //     //     $.each(checkbox_terpilih,function(index,elm){
    //     //         semua_id.push(elm.value)
    //     //     })
    //     //     Swal.fire({
    //     //             title: 'Yakin Untuk Hapus Data?',
    //     //             text: "Data Yang Anda Pilih Akan Di Hapus ",
    //     //             type: 'warning',
    //     //             showCancelButton: true,
    //     //             confirmButtonColor: '#3085d6',
    //     //             cancelButtonColor: '#d33',
    //     //             confirmButtonText: 'Ya'
    //     //             }).then((result) => {
    //     //                 console.log(result);
    //     //             if (result.value) {
    //     //                 $.ajax({
    //     //                         url: '{{url('tebu/datatebu/hapus')}}',
    //     //                         method : 'post',
    //     //                         data:{id_hapus:semua_id},
    //     //                         success:function(res){
    //     //                             Swal.fire(
    //     //                                 'Approved!',
    //     //                                 'Your data has been deleted.',
    //     //                                 'success'
    //     //                             ).then(function(){ 
    //     //                                 location.reload();
    //     //                                 });
    //     //                             table.ajax.reload(null,false)
    //     //                         }
    //     //                     })
    //     //             }
    //     //             });
    //     // }

    //     $('#modal_tambah').on('hidden.bs.modal', function () {
    //         $(this).find('form').trigger('reset');
    //     })

        


    //     function real(a)
    //     {
    //         if(a==1)
    //             document.getElementById("real").style.display="none";
    //         else
    //             document.getElementById("real").style.display="block";
    //     }


    //     $( function() {
    //     $( "#from_datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     $( "#to_datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     $( "#from_datepicker" ).attr("autocomplete", "off");
    //     $("#to_datepicker").attr("autocomplete", "off");
    //     });

    //     $( function() {
    //     $( "#from_datepicker_spta" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     $( "#to_datepicker_spta" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     $( "#from_datepicker_spta" ).attr("autocomplete", "off");
    //     $("#to_datepicker_spta").attr("autocomplete", "off");
    //     });
        
    //     $( function() {
    //     $( "#from_datepicker_notim" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     $( "#to_datepicker_notim" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     $( "#from_datepicker_notim" ).attr("autocomplete", "off");
    //     $("#to_datepicker_notim").attr("autocomplete", "off");
    //     });
        
        

    //     $( function() {
    //     $( "#from_datepicker_spta_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     $( "#to_datepicker_spta_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     $( "#from_datepicker_spta_p" ).attr("autocomplete", "off");
    //     $("#to_datepicker_spta_p").attr("autocomplete", "off");
    //     });

    //     $( function() {
    //     $( "#from_datepicker_notim_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     $( "#to_datepicker_notim_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     $( "#from_datepicker_notim_p" ).attr("autocomplete", "off");
    //     $("#to_datepicker_notim_p").attr("autocomplete", "off");
    //     });


    //     $( function() {
    //     $( "#from_datepicker_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     $( "#to_datepicker_p" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     $( "#from_datepicker_p" ).attr("autocomplete", "off");
    //     $("#to_datepicker_p").attr("autocomplete", "off");
    //     });



    //     $( function() {
    //     $( "#datepicker_r" ).datepicker({ dateFormat: 'yy-mm-dd' });
    //     $("#datepicker_r").attr("autocomplete", "off");
    //     });

    //     $( function() {
    //     $("#tgl_spta").datepicker({ dateFormat: 'yy-mm-dd' });
    //     $("#tgl_spta").attr("autocomplete", "off");
    //     });

      


        


        

    //     document.querySelector(".third").addEventListener('click', function(){
    //     Swal.fire("Data Yang Anda Input Sedang Diproses", "Perlu Diperhatikan Export PDF Akan Memakan Waktu Lebih Lama Dikarenakan Data Yang Sangat Banyak", "success");
    //     });
        
        
    //     function fototruk(foto) {
    //         let urlFoto = '/foto/truk/'+foto
    //         $('#modal_tampak').modal('show');
    //         $.ajax({url: urlFoto})
    //         .done(function( data ) {
    //             let htmlForImage = "";
    //             for (const item of data.images) {   
    //                 htmlForImage+=`<image class='img-fluid' src='${item}'>`
    //             }
    //             Swal.fire({
    //                 title: 'Foto Truk',
    //                 width: 800,
    //                 html: htmlForImage,
    //             })
    //         });
    //     }


    //     function fotospta(foto_spta) {
    //         $('#modal_tampak').modal('show');
    //         $.ajax({url: `{{ URL::to('/foto/spta') }}/${foto_spta}`,})
    //         .done(function( data ) {
    //             let htmlForImage = "";
    //             for (const item of data.images) {   
    //                 htmlForImage+=`<image class='img-fluid' src='${item}'>`
    //             }
    //             Swal.fire({
    //                 title: 'Foto Spta',
    //                 width: 800,
    //                 html: htmlForImage,
    //             })
    //         });
    //     }


    //     function fototimbang(foto_timbang) {
    //         $('#modal_tampak').modal('show');
    //         $.ajax({url: `{{ URL::to('foto/timbang') }}/${foto_timbang}`,})
    //         .done(function( data ) {
    //             let htmlForImage = "";
    //             for (const item of data.images) {   
    //                 htmlForImage+=`<image class='img-fluid' src='${item}'>`
    //             }
    //             Swal.fire({
    //                 title: 'Foto Timbang',
    //                 width: 800,
    //                 html: htmlForImage,
    //             })
    //         });
    //     }

        

        

    //     $('#form_tambah').submit(function(event) {
    //         event.preventDefault();
    //         $.ajax({
    //             url:$(this).attr("action"),
    //             data:new FormData(this),
    //             type:$(this).attr("method"),
    //             dataType: 'json',
    //             processData: false,
    //             contentType: false,
    //             beforeSend: function() {
    //                 $(this).find(':submit').prop('disabled', true);
    //             },
    //             complete:function() {
    //                 $(this).find(':submit').prop('disabled', false);
    //             },
    //             success:function(data) {
    //                 tabel.ajax.reload();
    //                 console.log('success:', data);
    //                 if (data.success) {
    //                     $("#modal_tambah").modal('hide');
    //                     Swal.fire({ title: "Tambah Data!", text: "Tambah Data Berhasil.", type: "success" });
    //                 } else {
    //                     Swal.fire({ title: "Error", text: data.message, type: "error" });
    //                 }
    //             },
    //             error: function (data) {
    //                 console.log('Error:', data);
    //                 Swal.fire({ title: "Error", text: "Data Tidak Berhasil Ditambah", type: "error" });
    //             }
    //         });
    //     });

    //     $('#form_lapor').submit(function(event) {
    //         event.preventDefault();
    //         $.ajax({
    //             url:$(this).attr("action"),
    //             data:new FormData(this),
    //             type:$(this).attr("method"),
    //             dataType: 'json',
    //             processData: false,
    //             contentType: false,
    //             beforeSend: function() {
    //                 $(this).find(':submit').prop('disabled', true);
    //             },
    //             complete:function() {
    //                 $(this).find(':submit').prop('disabled', false);
    //             },
    //             success:function(data) {
    //                 tabel.ajax.reload();
    //                 if (data.success) {
    //                     $("#modal_lapor").modal('hide');
    //                     Swal.fire({ title: "Ubah Data!", text: "Ubah Data Berhasil.", type: "success" });
    //                 } else {
    //                     Swal.fire({ title: "Error", text: "Ubah Data Gagal", type: "error" });
    //                 }
    //             },
    //             error: function (data) {
    //                 console.log('Error:', data);
    //                 Swal.fire({ title: "Error", text: "Ubah Data Gagal", type: "error" });
    //             }
    //         });
    //     });

    // </script>

    </script>

@endsection


<!-- 09/11/2022 baruu-->