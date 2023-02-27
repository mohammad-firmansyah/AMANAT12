@extends('template.master')
@section('title', $title ?? '')
@section('nama', $nama ?? '')
@section('jabatan', $jabatan ?? '')

@section('pluginCSS')
    <!-- third party css -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css') }}" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet') }}" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet') }}" type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet') }}" type="text/css" />
    <link href="{{ asset('assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css') }}" />
    <link href="{{ asset('assets/libs/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->    
@endsection

@section('breadcump')
    <ol class="breadcrumb">
        <li class="breadcrumb-item active"><a href="#">Pembalikan</a></li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Input Pembalikan</h4>
                    <p class="text-muted font-13 mb-4"></p>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputState" class="col-form-label">Pembalikan</label>
                            <select id="inputState" class="form-control">
                                <option>Manual</option>
                                <option selected>Otomatis</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputCity" class="col-form-label">Waktu Pembalikan</label>
                            <input type="text" class="form-control" id="inputCity" value="13:00 - 15:00">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputCity" class="col-form-label">Hari Ke</label>
                            <input type="text" class="form-control" id="inputCity" value="2">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState" class="col-form-label">Kebun</label>
                            <select id="inputState" class="form-control">
                                <option>Semua Kebun</option>
                                <option>Kalisanen</option>
                            </select>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </center>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Table Pembalikan</h4>
                    <p class="text-muted font-13 mb-4"></p>

                    <table id="basic-datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Kebun</th>
                                <th>Ruang</th>
                                <th>Pembalikan</th>
                                <th>Waktu Pembalikan</th>
                                <th>Hari Ke</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="2">1</td>
                                <td rowspan="2">Kalisanen</td>
                                <td>Ruang 1</td>
                                <td>
                                    <select id="inputState" class="form-control">
                                        <option>Manual</option>
                                        <option selected>Otomatis</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" value="13:00 - 15:00"></td>
                                <td><input type="text" class="form-control" value="2"></td>
                                <td><button type="button" class="btn btn-success waves-light waves-effect">Simpan</button></td>
                            </tr>
                            <tr>
                                <td>Ruang 2</td>
                                <td>
                                    <select id="inputState" class="form-control">
                                        <option>Manual</option>
                                        <option selected>Otomatis</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" value="13:00 - 15:00"></td>
                                <td><input type="text" class="form-control" value="2"></td>
                                <td><button type="button" class="btn btn-success waves-light waves-effect">Simpan</button></td>
                            </tr>
                            <tr>
                                <td rowspan="2">2</td>
                                <td rowspan="2">Pasewaran</td>
                                <td>Ruang 1</td>
                                <td>
                                    <select id="inputState" class="form-control">
                                        <option selected>Manual</option>
                                        <option>Otomatis</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" value="-" disabled></td>
                                <td><input type="text" class="form-control" value="-" disabled></td>
                                <td><button type="button" class="btn btn-success waves-light waves-effect">Simpan</button></td>
                            </tr>
                            <tr>
                                <td>Ruang 2</td>
                                <td>
                                    <select id="inputState" class="form-control">
                                        <option>Manual</option>
                                        <option selected>Otomatis</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" value="08:00 - 10:00"></td>
                                <td><input type="text" class="form-control" value="2"></td>
                                <td><button type="button" class="btn btn-success waves-light waves-effect">Simpan</button></td>
                            </tr>
                            <tr>
                                <td rowspan="3">3</td>
                                <td rowspan="3">Jatirono</td>
                                <td>Ruang 1</td>
                                <td>
                                    <select id="inputState" class="form-control">
                                        <option>Manual</option>
                                        <option selected>Otomatis</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" value="09:00 - 11:00"></td>
                                <td><input type="text" class="form-control" value="2"></td>
                                <td><button type="button" class="btn btn-success waves-light waves-effect">Simpan</button></td>
                            </tr>
                            <tr>
                                <td>Ruang 2</td>
                                <td>
                                    <select id="inputState" class="form-control">
                                        <option selected>Manual</option>
                                        <option>Otomatis</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" value="-" disabled></td>
                                <td><input type="text" class="form-control" value="-" disabled></td>
                                <td><button type="button" class="btn btn-success waves-light waves-effect">Simpan</button></td>
                            </tr>
                            <tr>
                                <td>Ruang 3</td>
                                <td>
                                    <select id="inputState" class="form-control">
                                        <option selected>Manual</option>
                                        <option>Otomatis</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" value="-" disabled></td>
                                <td><input type="text" class="form-control" value="-" disabled></td>
                                <td><button type="button" class="btn btn-success waves-light waves-effect">Simpan</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end row -->
@endsection

@section('pluginJS')
    <!-- third party js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

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
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

    <!-- Responsive js -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatables init -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection
