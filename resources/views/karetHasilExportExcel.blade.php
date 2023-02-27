    
    @foreach($dataTahunTanams as $dataTahunTanam)   
    <table style="border-collapse:collapse;border-spacing:0;">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Kebun</td>
                <td>:</td>
                <td>{{ $dataTahunTanam->data_kebun_nama }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Afdeling</td>
                <td>:</td>
                <td>{{ $dataTahunTanam->data_afdeling_nama }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Tgl/Bln/Tahun</td>
                <td>:</td>
                <td>{{ $dataTahunTanam->data_pabrik_global_tanggal }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Tahun Tanam</td>
                <td>:</td>
                <td>{{ $dataTahunTanam->data_tahun_tanam_tahun . $dataTahunTanam->tahun_tanam_label }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Blok/Hanca</td>
                <td>:</td>
                <!-- <td>value</td>  -->
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Mandor Sadap</td>
                <td>:</td>
                <td>{{ $dataTahunTanam->data_mandor_nama }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td rowspan="3">No</td>
                <td rowspan="3">Nama KTP</td>
                <td colspan="8">Penerimaan Lateks Basah (Ltr)</td>
                <td colspan="3">KKK (%)</td>
                <td colspan="3">Kering (Kg)</td>
                <td rowspan="3">Jumlah</td>
                <td colspan="3">Upah</td>
                <td rowspan="3">Jumlah</td>
            </tr>
            <tr>
                <td colspan="4">Afdeling</td>
                <td colspan="4">Pabrik</td>
                <td rowspan="2">KKB</td>
                <td rowspan="2">Pabrik</td>
                <td rowspan="2">KKK Per Penyadap</td>
                <td rowspan="2">Super</td>
                <td rowspan="2">Pra</td>
                <td rowspan="2">Lump</td>
                <td>Super</td>
                <td>Pra</td>
                <td>Lump</td> 
            </tr>
            <tr>
                <td>Super</td>
                <td>Pra</td>
                <td>Lump</td>
                <td>Jml</td>
                <td>Super</td>
                <td>Pra</td>
                <td>Lump</td>
                <td>Jml</td>
                <td>4500</td>
                <td>4500</td>
                <td>3200</td> 
            </tr>
            {{-- for each data --}} 
            <?php $no = 1 ?> 
            <?php $sum_table_hasil_lateks = 0 ?> 
            <?php $sum_table_hasil_pra = 0 ?> 
            <?php $sum_table_hasil_lump = 0 ?>
            <?php $sum_table_hasil_kkb = 0 ?>
            <?php $sum_table_hasil_k3_perpenyadap = 0 ?>

            <?php $sum_kering_super = 0 ?>

            <?php $kering_pra = 0 ?>
            <?php $kering_lump = 0 ?>

            <?php $sumJumlahAfdeling = 0 ?> 
            <?php $sumJumlahKering = 0 ?> 
            <?php $sumK3Super = 0 ?> 
            @foreach($hasils as $hasilArr)   
            @foreach($hasilArr as $hasil)   
            @if ($dataTahunTanam->id_data_pabrik_global != $hasil->id_data_pabrik_global)
                @continue; 
            @endif 
            <tr style="border: 1px black solid;">
                <td class="tbl">{{ $no++}}</td>
                <td class="kol-name">{{ $hasil->data_penyadap_nama }}</td>

                <?php $sum_table_hasil_lateks += $hasil->table_hasil_lateks ?> 
                <td class="tbl">{{ $hasil->table_hasil_lateks }}</td>

                <?php $sum_table_hasil_pra += $hasil->table_hasil_pra ?> 
                <td class="tbl">{{ $hasil->table_hasil_pra }}</td>

                <?php $sum_table_hasil_lump += $hasil->table_hasil_lump ?> 
                <td class="tbl">{{ $hasil->table_hasil_lump }}</td> 

                <?php $sumJumlahAfdeling += $hasil->table_hasil_lateks + $hasil->table_hasil_pra + $hasil->table_hasil_lump ?> 
                <td class="tbl">{{ ($hasil->table_hasil_lateks + $hasil->table_hasil_pra + $hasil->table_hasil_lump) }}</td>
                <td class="tbl">-</td>
                <td class="tbl">-</td>
                <td class="tbl">-</td>
                <td class="tbl">-</td>
                
                <?php $sum_table_hasil_kkb += $hasil->table_hasil_kkb ?> 
                <td class="tbl">{{ $hasil->table_hasil_kkb }}</td>

                <?php $sumK3Super += $dataTahunTanam->data_pabrik_global_k3_super ?> 
                <td class="tbl">{{ $dataTahunTanam->data_pabrik_global_k3_super }}</td> 

                <?php $sum_table_hasil_k3_perpenyadap += $hasil->table_hasil_k3_perpenyadap ?> 
                <td class="tbl">{{ $hasil->table_hasil_k3_perpenyadap }}</td>  

                <?php $sum_kering_super += ($hasil->table_hasil_k3_perpenyadap * $dataTahunTanam->data_pabrik_global_lateks_super) ?> 
                <td class="tbl">{{ $hasil->table_hasil_k3_perpenyadap * $dataTahunTanam->data_pabrik_global_lateks_super }}</</td>
                
                <?php $kering_pra += ($hasil->table_hasil_pra * 18/100) ?> 
                <td class="tbl">{{ $hasil->table_hasil_pra ? ($hasil->table_hasil_pra * 18/100) : "-" }}</td>

                <?php $kering_lump += ($hasil->sum_table_hasil_lump * 40/100) ?> 
                <td class="tbl">{{ $hasil->sum_table_hasil_lump ? ($hasil->sum_table_hasil_lump * 40/100) : "-" }}</td>

                <?php $sumJumlahKering += 
                    (($hasil->table_hasil_k3_perpenyadap * $dataTahunTanam->data_pabrik_global_lateks_super)
                    + ($hasil->table_hasil_pra * 18/100)
                    + ($hasil->sum_table_hasil_lump * 40/100))
                 ?> 
                <td class="tbl">{{ (
                    ($hasil->table_hasil_k3_perpenyadap * $dataTahunTanam->data_pabrik_global_lateks_super)
                    + ($hasil->table_hasil_pra * 18/100)
                    + ($hasil->sum_table_hasil_lump * 40/100)
                    ) 
                    }}</td>
            </tr>
             @endforeach
             @endforeach
            {{-- end for each data --}}
            <tr>
                <td colspan="2" class="tbl">Jumlah</td> 
                <td class="tbl">{{ $sum_table_hasil_lateks }}</td>
                <td class="tbl">{{ $sum_table_hasil_pra }}</td>
                <td class="tbl">{{ $sum_table_hasil_lump }}</td>
                <td class="tbl">{{ $sumJumlahAfdeling }}</td>
                <td class="tbl">-</td>
                <td class="tbl">-</td>
                <td class="tbl">-</td>
                <td class="tbl">-</td>
                <td class="tbl">{{ $sum_table_hasil_kkb }}</td>
                <td class="tbl">{{ $sumK3Super }}</td>
                <td class="tbl">{{ $sum_table_hasil_k3_perpenyadap }}</td>

                <td class="tbl">{{ $sum_kering_super }}</td>
                <td class="tbl">{{ $kering_pra ? $kering_pra : "-"  }}</td>
                <td class="tbl">{{ $kering_lump ? $kering_lump : "-"  }}</td>
                <td class="tbl">{{ $sumJumlahKering ? $sumJumlahKering : "-"  }}</td>
            </tr>
            <tr>
                <td>Selisih</td> 
            </tr>
            <tr>
                <td class="bagian-selisih">1.</td>
                <td>HKO</td>
                <td>{{ $dataTahunTanam->data_pabrik_global_hko }}</td> 
            </tr>
            <tr>
                <td class="bagian-selisih">2.</td>
                <td>LITER SUPER</td>
                <td>{{ $dataTahunTanam->data_pabrik_global_lateks_super }}</td> 
            </tr>
            <tr>
                <td class="bagian-selisih">3.</td>
                <td>K3 SUPER</td>
                <td>{{ $dataTahunTanam->data_pabrik_global_k3_super }}</td> 
            </tr>
            <tr>
                <td class="bagian-selisih">4.</td>
                <td>LITER PRA</td>
                <td>{{ $dataTahunTanam->data_pabrik_global_liter_pra }}</td> 
            </tr>
            <tr>
                <td class="bagian-selisih">5.</td>
                <td>K3 PRA</td>
                <td>{{ $dataTahunTanam->data_pabrik_global_k3_pra }}</td> 
            </tr>
            <tr>
                <td class="bagian-selisih">6.</td>
                <td>LUMP BASAH</td>
                <td>{{ $dataTahunTanam->data_pabrik_global_lump_basah }}</td> 
            </tr>
            <tr>
                <td class="bagian-selisih">7.</td>
                <td>SHEET</td>
                <td>{{ $dataTahunTanam->data_pabrik_global_sheet }}</td> 
            </tr>
            <tr>
                <td class="bagian-selisih">8.</td>
                <td>PRA</td>
                <td>{{ $dataTahunTanam->data_pabrik_global_pra }}</td> 
            </tr>
            <tr>
                <td class="bagian-selisih">9.</td>
                <td>LUMP KERING</td>
                <td>{{ $dataTahunTanam->data_pabrik_global_lump_kering }}</td> 
            </tr>
            <tr>
                <td class="bagian-selisih">10.</td>
                <td>TOTAL</td>
                <td>{{ $dataTahunTanam->data_pabrik_global_total }}</td> 
            </tr>
            <tr>
                <td class="bagian-selisih">11.</td>
                <td>KET</td>
                <td>{{ $dataTahunTanam->data_pabrik_global_keterangan }}</td> 
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Mandor Sadap</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Petugas KKB</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Mengetahui/Menyetujui,</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Asisten Afdeling</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>{{ $dataTahunTanam->data_mandor_nama }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    @endforeach
