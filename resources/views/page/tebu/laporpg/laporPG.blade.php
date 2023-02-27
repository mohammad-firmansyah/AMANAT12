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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title"> Data Laporan PG </h4>
                        <p class="sub-header"></p>
                        <hr>


                        

                    <table id="table" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr style="text-align: center;">
                                <th>No</th>
                                <th>Kebun</th>
                                <th>Foto Nota</th>
                                <th>Tanggal Timbang</th>
                                <th>Nota Timbang</th>
                                <th>Realisasi</th>
                                <th>No SPTA</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>               
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end row -->
    <div id="modal_tambah" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_tambah" method="post" enctype="multipart/form-data" action="{!! url('tebu/laporpg/store') !!}"> 
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Tambah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                    <input type="hidden" id="tambah_id" name="id">
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
                                        <input type="text" class="form-control" id="tgl_spta" onfocus="this.value=''" name="tgl_spta" placeholder="Tanggal SPTA" data-provide='datepicker' data-date-container='#modal_tambah' required>
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
                                        <input type="text" class="form-control" id="datepicker_r" onfocus="this.value=''" name="tanggal_timbang" placeholder="Tanggal Timbang" data-provide='datepicker' data-date-container='#modal_tambah'>
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
            // $('#pilih_posisi').select2({dropdownParent: $("#modal_export_excel")});
            // $('#pilih_afdeling').select2({dropdownParent: $("#modal_export_excel")});
            // $('#pilih_kebun').select2({dropdownParent: $("#modal_export_excel")}); 
            // $('#pilih_status').select2({dropdownParent: $("#modal_export_excel")}); 
            // $('#pilih_posisi_p').select2({dropdownParent: $("#modal_export_pdf")});
            // $('#pilih_afdeling_p').select2({dropdownParent: $("#modal_export_pdf")});
            // $('#pilih_kebun_p').select2({dropdownParent: $("#modal_export_pdf")}); 
            // $('#pilih_status_p').select2({dropdownParent: $("#modal_export_pdf")});
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
            $('#tambah_afdeling').select2({width: '100%'});
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
                    'url' : '{{ url('tebu/laporpg/get/') }}',
                    'type' : 'post',
                    'data' : {_token: "{{csrf_token()}}"}
                },
                order: [],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'unit_nama', name : 'unit.unit_nama'},
                    { data: 'foto', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="fotopg(${row.id})">foto PG</button>`;
                        },
                        searchable: false
                    },
                    { data: 'tanggal_timbang', name : 'tanggal_timbang'},
                    { data: 'nomor_nota_timbang', name : 'nomor_nota_timbang'},
                    { data: 'realisasi', name : 'realisasi'},
                    { data: 'spta_pg', name : 'spta_pg'},
                    { data: 'isDone', "render":function (data,type,row){
                        if (data === 1){
                            return  `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="ubahStatusProses(${row.id}, ${data})" disabled>Sudah Diproses</button>`;
                            // return `<div style="background-color: #cfc ; padding: 7px; solid green;">Sudah Diproses</div>`;
                        }else{
                            return  `<button type="button" class="btn btn-danger waves-effect waves-light btn-sm" onclick="ubahStatusProses(${row.id}, ${data})">Belum Diproses</button>`;
                            // return  `<div style="background-color: #f7c8c8 ; padding: 7px; solid red;">Belum Diproses</div>`;
                        }
                    }},
                    { data: 'keterangan', name: 'keterangan' },
                    { data: 'isDone', "render": function ( data, type, row ) 
                        {
                            if( data == 0){
                                return `<button type="button" class="btn btn-warning waves-effect waves-light btn-sm" onclick='ubah(${JSON.stringify(row)})'> <i class="fa fa-pen mr-1"></i> <span>+ Tambah Data</span></button>`;
                            }else{
                                return `<button type="button" class="btn btn-warning waves-effect waves-light btn-sm" onclick='ubah(${JSON.stringify(row)})' disabled> <i class="fa fa-pen mr-1"></i> <span>+ Tambah Data</span></button>`;
                            }
                            
                        },
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });


        // function real(a)
        // {
        //     if(a==1)
        //         document.getElementById("real").style.display="none";
        //     else
        //         document.getElementById("real").style.display="block";
        // }




        $( function() {
        $( "#datepicker_r" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $("#datepicker_r").attr("autocomplete", "off");
        });

        $( function() {
        $("#tgl_spta").datepicker({ dateFormat: 'yy-mm-dd' });
        $("#tgl_spta").attr("autocomplete", "off");
        });




        document.getElementById("tambah_realisasi").onkeypress = function(e) {
            var chr = String.fromCharCode(e.which);
            if (",\"".indexOf(chr) >= 0)
                return false;
        };


        function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
        }
        
        function fotopg(fotopg) {
            let urlFoto = '/foto/pg/'+fotopg
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

        function ubah(row) {
            $('#tambah_id').val(row.id);
            $('#tambah_spta').val(row.spta_pg)
            // $('#tambah_afdeling').find(":selected").text(row.afdel_id);
            // $("#tambah_afdeling").val(row.afdel_id).change();
            // $("#tambah_petak").val(row.petak_id).change();
            // $("#tambah_pta").val(row.pta_id).change();
            // $('#tambah_renteng').val(row.renteng_id).change();
            // $('#tambah_sumdana').val(row.sumber_dana).change();
            // $('#tambah_truk').val(row.timbangkeb_id).change();
            // $('#tambah_tebmuat').val(row.tebang_id).change();
            // $('#tambah_tebmuataskep').val(row.tebmuat_askep).change();
            // $('#tambah_spta').prop('placeholder',row.nomor_spta);
            // $('#tambah_nopol').prop('placeholder',row.nopol);
            $('#modal_tambah').modal({backdrop: 'static', show: true});
        }
        
        $( function() {
        $( "#datepicker_real" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $("#datepicker_real").attr("autocomplete", "off");
        });

        function ubahStatusProses(id) {
            Swal.fire({
                title: "Yakin Untuk Ubah Status?",
                text: "Data Yang Anda Pilih Akan Ubah Statusnya",
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
                            url: `{!! url('tebu/laporpg/') !!}/${id}`,
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
                    result.value == "success" ? Swal.fire({ title: "Changed!", text: "Status Data Berhasil Berubah.", type: "success" })
                        : Swal.fire({ title: "Error", text: "Status Data Gagal Berubah", type: "error" });
                } else {
                    result.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Batal", text: "Status Data Batal Berubah", type: "error" });
                }
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
                        Swal.fire({ title: "Tambah Data!", text: "Tambah Data Berhasil.", type: "success" }).then(function(){ 
                                        location.reload();
                                        });
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

    </script>
@endsection