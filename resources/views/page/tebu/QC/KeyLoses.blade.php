<div class="table-responsive">
<table class="table table-sm  table-hover table-bordered table-striped">
    <tr>
        <th>Nama</th>
        <th>Afdeling</th>
        <th>Petak Tebang</th>
        <th>Status Tanam</th>
        <th>Nama PTA</th>
        <th>Nama Renteng</th>
        <th>Foto Tunggak</th>
        <th>Foto Pucukan</th>
        <th>Berat Tunggak (Kg)</th>
        <th>Berat Pucukan (Kg)</th>
        <th>Foto Brondolan</th>
        <th>Panjang Juring (m/Ha)</th>
        <th>Luas Sample (m2)</th>
        <th>Berat Brondolan (Kg)</th>
        <th>Potensi Loses (Ton/Ha)</th>
        <th>Posisi</th>
    </tr>
    @foreach($result as $key=> $value)
    <tr>
        <td>{{$value->user_username}}</td>
        <td>{{$value->kebun_afdeling}}</td>
        <td>{{$value->petak_tanam}}</td>
        <td>{{$value->status_tanam}}</td>
        <td>{{$value->nama_pta}}</td>
        <td>{{$value->nama_renteng}}</td>
        <td><button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="FotoTunggak({{$value->loses_id}})">Foto Tunggak</button></td>
        <td><button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="FotoPucukan({{$value->loses_id}})">Foto Pucukan</button></td>
        <td>{{$value->berat_tunggak}}</td>
        <td>{{$value->berat_pucukan}}</td>
        <td><button type="button" class="btn btn-success waves-effect waves-light btn-sm" onclick="FotoBrondolan({{$value->loses_id}})">Foto Brondolan</td>
        <td>{{$value->panjang_juring}}</td>
        <td>{{$value->luas_sample}}</td>
        <td>{{$value->berat_brondolan}}</td>
        <td>{{$value->potensi_loses}}</td>
        <td>{{$value->ket_posisi}}</td>
    </tr>
    @endforeach
</table>
</div>