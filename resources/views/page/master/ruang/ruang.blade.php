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
    <!-- third party css end -->
@endsection

@section('breadcump')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{!! url('/') !!}">Home</a></li>
        <li class="breadcrumb-item active">{{ $title }}</li>
    </ol>
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Data {{ $title }}</h4><br>
                    {{-- <p class="sub-header"></p> --}}
                    <p class="card-text">
                        <button type="button" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#modal_tambah" data-backdrop="static"><i class="fa fa-plus mr-1"></i> Tambah Data</button>
                    </p>

                    <table id="table" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr style="text-align: center;">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Tipe</th>
                                <th>Unit</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

    <div id="modal_tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_tambah" method="post" action="{!! url('master/ruang/store') !!}">
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Tambah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_nama" class="control-label">Nama</label>
                                    <input type="text" class="form-control" id="tambah_nama" name="nama" placeholder="Nama Ruang" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_tipe" class="control-label">Tipe Ruang</label>
                                    <select class="form-control select2" id="tambah_tipe" name="tipe" required>
                                        <option value="" selected disabled> -- Pilih Tipe Ruang -- </option>
                                        @foreach ($tipe as $key => $value)
                                            <option value="{{ $value->ruang_tipe_id}}" > {{ $value->ruang_tipe_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tambah_unit" class="control-label">Unit</label>
                                    <select class="form-control select2" id="tambah_unit" name="unit" required>
                                        <option value="" selected disabled> -- Pilih Unit -- </option>
                                        @foreach ($unit as $key => $value)
                                            <option value="{{ $value->unit_id}}" > {{ $value->unit_tipe_nama." ".$value->unit_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="tambah_keterangan" class="control-label">Keterangan</label>
                                    <textarea class="form-control" id="tambah_keterangan" name="keterangan" placeholder="Keterangan"></textarea>
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
    </div><!-- /.modal -->

    <div id="modal_ubah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form_ubah" method="post" action="{!! url('master/ruang/update') !!}" >
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Ubah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body p-4">
                        <input type="hidden" id="ubah_id" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_nama" class="control-label">Nama</label>
                                    <input type="text" class="form-control" id="ubah_nama" name="nama" placeholder="Nama Ruang" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_tipe" class="control-label">Tipe Ruang</label>
                                    <select class="form-control select2" id="ubah_tipe" name="tipe" required>
                                        <option value="" selected disabled> -- Pilih Tipe Ruang -- </option>
                                        @foreach ($tipe as $key => $value)
                                            <option value="{{ $value->ruang_tipe_id}}" > {{ $value->ruang_tipe_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ubah_unit" class="control-label">Unit</label>
                                    <select class="form-control select2" id="ubah_unit" name="unit" required>
                                        <option value="" selected disabled> -- Pilih Unit -- </option>
                                        @foreach ($unit as $key => $value)
                                            <option value="{{ $value->unit_id}}" > {{ $value->unit_tipe_nama." ".$value->unit_nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group no-margin">
                                    <label for="ubah_keterangan" class="control-label">Keterangan</label>
                                    <textarea class="form-control" id="ubah_keterangan" name="keterangan" placeholder="Keterangan"></textarea>
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
    </div><!-- /.modal -->

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
@endsection

@section('customJS')
    <script type="text/javascript">

        var tabel;

        $(document).ready(function() {

            $('#tambah_tipe').select2({dropdownParent: $("#modal_tambah")});
            $('#tambah_unit').select2({dropdownParent: $("#modal_tambah")});

            tabel = $('#table').DataTable({
                processing: false,
                serverSide: true,
                ajax: '{!! url('master/ruang/get') !!}',
                order: [],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'ruang_nama', name: 'ruang_nama' },
                    { data: 'ruang_tipe_nama', name: 'ruang_tipe.ruang_tipe_nama' },
                    { data: 'unit_nama', name: 'unit.unit_nama', "render": function ( data, type, row ) 
                        {
                            return row.unit_tipe_nama+" "+row.unit_nama;
                        }
                    },
                    { data: 'ruang_keterangan', name: 'ruang_keterangan' },
                    { data: 'ruang_status', "render": function ( data, type, row ) 
                        {
                            if (data == 1) {
                                return `<button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="ubahStatus(${row.ruang_id}, ${data})">Aktif</button>`;
                            } else {
                                return `<button type="button" class="btn btn-danger waves-effect waves-light btn-sm" onclick="ubahStatus(${row.ruang_id}, ${data})">Tidak Aktif</button>`;
                            }
                        },
                        searchable: false
                    },
                    { data: 'ruang_status', "render": function ( data, type, row ) 
                        {
                            return `<button type="button" class="btn btn-warning waves-effect waves-light btn-sm" onclick='ubah(${JSON.stringify(row)})'> <i class="fa fa-pen mr-1"></i> <span>Ubah Data</span></button>`;
                        },
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        function ubah(row) {
            $('#ubah_id').val(row.ruang_id);
            $('#ubah_nama').val(row.ruang_nama);
            $('#ubah_keterangan').val(row.ruang_keterangan);
            $('#ubah_tipe').val(row.ruang_tipe_id);
            $('#ubah_unit').val(row.unit_id);
            $('#ubah_tipe').select2({dropdownParent: $("#modal_ubah")}).trigger('change');
            $('#ubah_unit').select2({dropdownParent: $("#modal_ubah")}).trigger('change');
            $('#modal_ubah').modal({backdrop: 'static', show: true});
        }

        function ubahStatus(id, status) {
            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Mengubah Status Menjadi "+(status == 1 ? "Tidak Aktif" : "Aktif"),
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
                            url: `{!! url('master/ruang/status') !!}/${id}`,
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
                    result.value == "success" ? Swal.fire({ title: "Ubah Status!", text: "Ubah Status Berhasil.", type: "success" })
                        : Swal.fire({ title: "Error", text: "Ubah Status Gagal", type: "error" });
                } else {
                    result.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Batal", text: "Ubah Status Batal", type: "error" });
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
                    if (data.success) {
                        $("#modal_tambah").modal('hide');
                        Swal.fire({ title: "Tambah Data!", text: "Tambah Data Berhasil.", type: "success" });
                    } else {
                        Swal.fire({ title: "Error", text: "Tambah Data Gagal", type: "error" });
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    Swal.fire({ title: "Error", text: "Tambah Data Gagal", type: "error" });
                }
            });
        });

        $('#form_ubah').submit(function(event) {
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
                        $("#modal_ubah").modal('hide');
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