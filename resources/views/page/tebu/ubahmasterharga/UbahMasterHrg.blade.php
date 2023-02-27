@extends('template.master')
@section('title', $title ?? '')
@section('nama', $nama ?? '')
@section('jabatan', $jabatan ?? '')

@section('pluginCSS')
<!-- third party css -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title"> Edit Data </h4>
                <p class="sub-header"></p>
                <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modal_tambah" data-backdrop="static"><i class="fa fa-plus mr-1"></i> Tambah Data</button>
                <span class="card-text ml-1">   
                <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Data Ini Sangat Berdampak Pada Kelancaran TMA TEBU, HARAP BERHATI-HATI!">INFO !</button></span>
                <hr>
                
                <br>
                
                <table id="table" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr style="text-align: center;">
                            <th>No</th>
                            <th>Kebun Baru</th>
                            <th>Kebun Lama</th>
                            <th>Tarif Graber Vendor</th>
                            <th>Tarif Tebang</th>
                            <th>Tarif Tebang Manual</th>
                            <th>Status</th>
                            <th>Action</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div> <!-- end row -->
<div id="modal_tambah" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_tambah" method="post" enctype="multipart/form-data" action="{!! url('master/harga/store') !!}"> 
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Tambah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_kebunB" class="control-label">Kebun Baru</label>
                                    <select class="form-control select2" id="tambah_kebunB" name="kebun_baru" required>
                                    <option value="" selected disabled> -- Pilih kebun -- </option>
                                        @foreach ($kebun_baru as $key => $value)
                                            <option value="{{ $value->unit_id}}" selected> {{$value->unit_nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_kebunL" class="control-label">Kebun Lama</label>
                                    <select class="form-control select2" id="tambah_kebunL" name="kebun_lama" required>
                                    <option value="" selected disabled> -- Pilih kebun -- </option>
                                        @foreach ($kebun_lama as $key => $value)
                                            <option value="{{ $value->kebun_lama}}" > {{$value->unit_nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_grab_ven" class="control-label">Tarif Graber Vendor</label>
                                    <input type="number" class="form-control" id="tambah_grab_ven" name="grab_vendor" placeholder="Tarif Graber Vendor" required>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="tambah_grab_ven_s">
                                        <label class="custom-control-label" for="tambah_grab_ven_s">Ambil Harga Sebelumnya</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_tebang" class="control-label">Tarif Tebang</label>
                                    <input type="number" class="form-control" id="tambah_tebang" name="harga_tebang" placeholder="Tarif Tebang" required>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="tambah_tebang_s">
                                        <label class="custom-control-label" for="tambah_tebang_s">Ambil Harga Sebelumnya</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_manual" class="control-label">Tarif Manual</label>
                                    <input type="number" class="form-control" id="tambah_manual" name="tarif_manual" placeholder="Tarif Manual" required>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="tambah_manual_s">
                                        <label class="custom-control-label" for="tambah_manual_s">Ambil Harga Sebelumnya</label>
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

    <!-- ubah data -->

    <div id="modal_ubah" class="modal fade"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_ubah" method="post" enctype="multipart/form-data" action="{!! url('master/harga/edit') !!}"> 
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Modal ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                    <input type="hidden" id="ubah_id" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_kebunB" class="control-label">Kebun Baru</label>
                                    <select class="form-control select2" id="ubah_kebunB" name="kebun_baru" disabled>
                                    <option value="" selected disabled> -- Pilih kebun -- </option>
                                        @foreach ($kebun_baru as $key => $value)
                                            <option value="{{ $value->unit_id}}" selected> {{$value->unit_nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_kebunL" class="control-label">Kebun Lama</label>
                                    <select class="form-control select2" id="ubah_kebunL" name="kebun_lama" disabled>
                                    <option value="" selected disabled> -- Pilih kebun -- </option>
                                        @foreach ($kebun_lama as $key => $value)
                                            <option value="{{ $value->kebun_lama}}"> {{$value->unit_nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_grab_ven" class="control-label">Tarif Graber Vendor</label>
                                    <input type="number" class="form-control" id="ubah_grab_ven" name="grab_vendor" placeholder="Tarif Graber Vendor">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_tebang" class="control-label">Tarif Tebang</label>
                                    <input type="number" class="form-control" id="ubah_tebang" name="harga_tebang" placeholder="Tarif Tebang">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_manual" class="control-label">Tarif Manual</label>
                                    <input type="number" class="form-control" id="ubah_manual" name="tarif_manual" placeholder="Tarif Manual">
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

        $(document).ready(function () {
            // var selectKebunLama = $('#tambah_kebunL');
            // selectKebunLama.select2();

            // selectKebunLama.on("select2:select", function(e){console.log("dddd")})

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $('#tambah_kebunL').select2({width: '100%'});
            $('#tambah_kebunL').on('select2:select', function (e) {
                var data = e.params.data;
                console.log(data);
                $.post( '{{ url('master/harga/aktif') }}', {"id":data.id})
                    .done(function( data ) {
                        let h_tebang = [];
                        $('#tambah_tebang').empty();
                        $('#tambah_grab_ven').empty();
                        $('#tambah_manual').empty();
                        var tebang = data.data_aktif.harga_tebang;
                        var vendor = data.data_aktif.harga_graber_vendor;
                        var manual = data.data_aktif.tarif_tebmuat_manual
                        // $('#tambah_tebang').val( tebang )
                        // $('#tambah_grab_ven').val(vendor)
                        // $('#tambah_manual').val(manual)
                        console.log(tebang)
                        console.log($('#tambah_tebang_s')[0].checked)
                        if($('#tambah_tebang_s')[0].checked){
                            $('#tambah_tebang').val( tebang )
                        } else {
                            $('#tambah_tebang').val(0)
                        }

                        if($('#tambah_grab_ven_s')[0].checked){
                            $('#tambah_grab_ven').val(vendor)
                        } else {
                            $('#tambah_grab_ven').val(0)
                        }

                        if($('#tambah_manual_s')[0].checked){
                            $('#tambah_manual').val(vendor)
                        } else {
                            $('#tambah_manual').val(0)
                        }

                        $('#tambah_tebang_s').change(function() {
                        if (this.checked) {
                            $('#tambah_tebang').val( tebang )
                        } else {
                            $('#tambah_tebang').val(0)
                        }
                        });
                        $('#tambah_grab_ven_s').change(function() {
                            if (this.checked) {
                                $('#tambah_grab_ven').val(vendor)
                            } else {
                                $('#tambah_grab_ven').val(0)
                            }
                        });
                        $('#tambah_manual_s').change(function() {
                            if (this.checked) {
                                $('#tambah_manual').val(manual)
                            } else {
                                $('#tambah_manual').val(0)
                            }
                        });
                        console.log( "Data Loaded: ", data.data_aktif );
                });
            });

           


            tabel = $('#table').DataTable({
                processing: false,
                serverSide: true,
             
                ajax: {
                    'url': '{{ url('master/harga/datatebu/get/') }}',
                'type': 'post',
                'data': { _token: "{{csrf_token()}}" }
            },
                order: [],
                columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'baru', name: 'baru' },
                { data: 'lama', name: 'lama' },
                { data: 'harga_graber_vendor', name: 'harga_graber_vendor' },
                { data: 'harga_tebang', name: 'harga_tebang' },
                { data: 'tarif_tebmuat_manual', name: 'tarif_tebmuat_manual' },
                { data: 'status_hrg', 'render':function(data,type,row){  
                    if (data === 1){
                        return  `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="ubahStatus(${row.harga_id}, ${data})" disabled>Aktif</button>`;
                    }else {
                            return `<button type="button" class="btn btn-danger waves-effect waves-light btn-sm" onclick="ubahStatus(${row.harga_id}, ${data})">Tidak Aktif</button>`;
                        }
                }},
                {
                    data: 'harga_id', "render": function (data, type, row) {
                        return `<button type="button" class="btn btn-warning waves-effect waves-light btn-sm" onclick='ubah(${JSON.stringify(row)})'> <i class="fa fa-pen mr-1"></i> <span>Ubah Data</span></button>`;
                    },
                    orderable: false,
                    searchable: false
                },
            ]
            });
        });


        



        // document.getElementById("tambah_realisasi").onkeypress = function (e) {
        //     var chr = String.fromCharCode(e.which);
        //     if (",\"".indexOf(chr) >= 0)
        //         return false;
        // };

        // $('#tambah_grab_ven').prop('placeholder','0');
        // $('#tambah_tebang').prop('placeholder','0');
        // $('#tambah_manual').prop('placeholder','0');

        

        $('#modal_tambah').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        })

        $('#modal_ubah').on('hidden.bs.modal', function () {
            $(this).find('form').trigger('reset');
        })


        function ubahStatus(id) {
            Swal.fire({
                title: "Yakin Untuk Aktifkan Data?",
                text: "Data Yang Anda Pilih Akan Di Aktifkan ",
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
                            url: `{!! url('master/harga/status/') !!}/${id}`,
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
                    result.value == "success" ? Swal.fire({ title: "Activated!", text: "Mengaktifkan Data Berhasil.", type: "success" })
                        : Swal.fire({ title: "Error", text: "Mengaktifkan Data Gagal", type: "error" });
                } else {
                    result.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Batal", text: "Mengaktifkan Data Batal", type: "error" });
                }
            });
        }



        function ubah(row) {
            $('#ubah_id').val(row.harga_id);
            $('#ubah_kebunB').val(row.kebun_baru);
            $('#ubah_kebunL').val(row.kebun_lama);
            $('#ubah_grab_ven').prop('placeholder',row.harga_graber_vendor);
            $('#ubah_tebang').prop('placeholder',row.harga_tebang);
            $('#ubah_manual').prop('placeholder',row.tarif_tebmuat_manual);
            $('#modal_ubah').modal({ backdrop: 'static', show: true });
        }



        $('#form_ubah').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                data: new FormData(this),
                type: $(this).attr("method"),
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $(this).find(':submit').prop('disabled', true);
                },
                complete: function () {
                    $(this).find(':submit').prop('disabled', false);
                },
                success: function (data) {
                    tabel.ajax.reload();
                    if (data.success) {
                        $("#modal_ubah").modal('hide');
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


        $('#form_tambah').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                data: new FormData(this),
                type: $(this).attr("method"),
                dataType: 'json',
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $(this).find(':submit').prop('disabled', true);
                },
                complete: function () {
                    $(this).find(':submit').prop('disabled', false);
                },
                success: function (data) {
                    tabel.ajax.reload();
                    if (data.success) {
                        $("#modal_tambah").modal('hide');
                        Swal.fire({ title: "Tambah Data!", text: "Tambah Data Berhasil.", type: "success" }).then(function () {
                            location.reload();
                        });;
                    } else {
                        Swal.fire({ title: "Error", text: data.message, type: "error" });
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    Swal.fire({ title: "Error", text: "Tambah Data Gagal", type: "error" });
                }
            });
        });

    </script>
    @endsection