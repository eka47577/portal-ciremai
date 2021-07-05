<script>
    function openCenteredWindow(url) {
        var width = 1000;
        var height = 500;
        var left = parseInt((screen.availWidth / 2) - (width / 2));
        var top = parseInt((screen.availHeight / 2) - (height / 2));
        var windowFeatures = "width=" + width + ",height=" + height +
            ",status,resizable,left=" + left + ",top=" + top +
            ",screenX=" + left + ",screenY=" + top + ",scrollbars";
        mywindow = window.open(url, "subWind", windowFeatures);
    }
    $(document).ready(function() {
        $("[name='bulan']").change(function() {
            var bln = $(this).val();
            var url = "<?php echo site_url('laporan/sensusharian'); ?>/" + bln;
            window.location = url;
            return false;
        });
        $("[name='ruangan'], [name='bulan']").change(function() {
            var bln = $("[name='bulan']").val();
            var ruangan = $("[name='ruangan']").val();
            var url = "<?php echo site_url('laporan/sensusharian'); ?>/" + ruangan + "/" + bln;
            window.location = url;
            return false;
        });
        $(".print").click(function() {
            var bln = $("[name='bulan']").val();
            var ruangan = $("[name='ruangan']").val();
            var url = "<?php echo site_url('laporan/cetaksensus_harian'); ?>/" + ruangan + "/" + bln;
            openCenteredWindow(url);
            // alert(url);
            return false;
        });
        $(".excel").click(function() {
            var bln = $("[name='bulan']").val();
            var ruangan = $("[name='ruangan']").val();
            var url = "<?php echo site_url('laporan/excelsensus_harian'); ?>/" + ruangan + "/" + bln;
            window.location = url;
            // alert(url);
            return false;
        });
    });
</script>
<div class="col-xs-12">
    <div class="box box-primary">
        <div class="box-header">
            <div class="form-horizontal row">
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                      <label class="col-md-3 control-label">Bulan</label>
                      <div class="col-md-9">
                          <select class="form-control" name="bulan">
                              <?php
                              $bln = array(
                                  "",
                                  "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember"
                              );
                              foreach ($bln as $key => $value) {
                                  if ($key > 0)
                                      echo "<option value='" . $key . "' " . ($b == $key ? "selected" : "") . ">" . $value . "</option>";
                              }
                              ?>
                          </select>
                      </div>
                      <?php
                      // $b = date("m");
                      $tahun = date("Y");
                      $jml = cal_days_in_month(CAL_GREGORIAN, $b, $tahun);
                      ?>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <div class="form-group">
                      <label class="col-md-3 control-label">Nama Ruangan</label>
                      <div class="col-md-9">
                          <select class="form-control" name="ruangan">
                              <?php
                              echo "<option value='all' " . ($bagian == "all" ? "selected" : "") . ">ALL</option>";
                              echo "<option value='covid' " . ($bagian == "covid" ? "selected" : "") . ">COVID</option>";
                              echo "<option value='08' " . ($bagian == "08" ? "selected" : "") . ">Kelas 3</option>";
                              echo "<option value='07' " . ($bagian == "07" ? "selected" : "") . ">Kelas 2</option>";
                              echo "<option value='06' " . ($bagian == "06" ? "selected" : "") . ">Kelas 1</option>";
                              echo "<option value='vip' " . ($bagian == "vip" ? "selected" : "") . ">VIP</option>";
                              foreach ($r as $kode => $key) {
                                  if ($key->kode_ruangan!="09" && $key->kode_ruangan!="19")
                                  echo "<option value='" . $key->sensus . "' " . ($bagian == $key->sensus ? "selected" : "") . ">" . $key->sensus . "</option>";
                              }
                              ?>
                          </select>
                      </div>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="pull-right">
                  <div class="btn-group">
                      <button type="button" class="print btn btn-sm btn-info"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak</button>
                      <button type="button" class="excel btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Excel</button>
                  </div>
                </div>
            </div>
          </div>
          <div class="box-body">
            <table width="100%" border="0">
                <tr>
                    <td class="text-center" colspan="3">
                      <h3>SENSUS HARIAN</h3><h5>PERIODE : <?php echo $bln[(int)$b]." ".date("Y"); ?></h5>
                    </td>
                </tr>
                <tr>
                    <td class="text-center" colspan="2">&nbsp;</td>
                </tr>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" style="width:2000px">
                    <thead>
                        <tr class="bg-navy">
                            <th style="vertical-align:middle" class="text-center" rowspan="4" width='150'>Tanggal</th>
                            <th style="vertical-align:middle" width="150" class='text-center' rowspan="4">Ruang</th>
                            <th style="vertical-align:middle" class='text-center' colspan="13" rowspan="2">Pasien Lama</th>
                            <th style="vertical-align:middle" class='text-center' colspan="13" rowspan="2">Pasien Baru</th>
                            <th style="vertical-align:middle" class='text-center' colspan="78">Pasien Pulang</th>
                            <th style="vertical-align:middle" width="50" class="text-center" rowspan="4">Jumlah</th>
                        </tr>
                        <tr class="bg-navy">
                          <th style="vertical-align:middle" class='text-center' colspan="13">Persetujuan Dokter</th>
                          <th style="vertical-align:middle" class='text-center' colspan="13">Permintaan Sendiri</th>
                          <th style="vertical-align:middle" class='text-center' colspan="13">Rujukan RS Lain</th>
                          <th style="vertical-align:middle" class='text-center' colspan="13">Meninggal < 48 jam</th>
                          <th style="vertical-align:middle" class='text-center' colspan="13">Meninggal > 48 jam</th>
                          <th style="vertical-align:middle" class='text-center' colspan="13">Lain-lain</th>
                        </tr>
                        <tr class="bg-navy">
                          <th style="vertical-align:middle" class='text-center' colspan="3">AL</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AD</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AU</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PUR</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">U</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PRSH</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">BPJS</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AL</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AD</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AU</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PUR</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">U</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PRSH</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">BPJS</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AL</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AD</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AU</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PUR</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">U</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PRSH</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">BPJS</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AL</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AD</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AU</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PUR</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">U</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PRSH</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">BPJS</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AL</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AD</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AU</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PUR</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">U</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PRSH</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">BPJS</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AL</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AD</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AU</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PUR</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">U</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PRSH</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">BPJS</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AL</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AD</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AU</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PUR</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">U</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PRSH</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">BPJS</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AL</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AD</th>
                          <th style="vertical-align:middle" class='text-center' colspan="3">AU</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PUR</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">U</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">PRSH</th>
                          <th style="vertical-align:middle" class="text-center" rowspan="2">BPJS</th>
                        </tr>
                        <tr class="bg-navy">
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                          <th style="vertical-align:middle" class='text-center'>T</th>
                          <th style="vertical-align:middle" class='text-center'>S</th>
                          <th style="vertical-align:middle" class='text-center'>K</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $i++;
                        for ($d = 1; $d <= $jml; $d++) {
                            echo "<tr id=data>";
                            $bl = substr("00" . $b, -2);
                            $dt = substr("00" . $d, -2);
                            $tanggal = date("Y") . "-" . $bl . "-" . $dt;
                            $tgl = date("d-m-Y", strtotime($tanggal));
                            echo "<td class='text-center'>" . $tgl . "</td>";
                            if ($bagian=="covid")
                              echo "<td class='text-center'>COVID</td>";
                            elseif ($bagian=="08")
                              echo "<td class='text-center'>Kelas 3</td>";
                            elseif ($bagian=="07")
                              echo "<td class='text-center'>Kelas 2</td>";
                            elseif ($bagian=="06")
                              echo "<td class='text-center'>Kelas 1</td>";
                            elseif ($bagian=="vip")
                              echo "<td class='text-center'>VIP</td>";
                            else
                              echo "<td class='text-center'>" . ($bagian == "all" ? "ALL" : $r[$bagian]->nama_ruangan) . "</td>";
                            $lama = array();
                            $baru = array();
                            $pulang = array();
                            $meninggal = array();
                            $totalpulang = 0;
                            $baru[406] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][406]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][406] : 0;
                            $baru[410] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][410]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][410] : 0;
                            $baru[422] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][422]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][422] : 0;
                            $baru[416] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][416]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][416] : 0;
                            $baru[404] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][404]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][404] : 0;
                            $baru[408] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][408]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][408] : 0;
                            $baru[421] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][421]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][421] : 0;
                            $baru[415] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][415]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][415] : 0;
                            $baru[405] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][405]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][405] : 0;
                            $baru[409] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][409]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][409] : 0;
                            $baru[423] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][423]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][423] : 0;
                            $baru[417] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][417]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][417] : 0;
                            $baru[412] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][412]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][412] : 0;
                            $baru[413] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))][413]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))][413] : 0;
                            $baru["DINAS"] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))]["DINAS"]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))]["DINAS"] : 0;
                            $baru["UMUM"] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))]["UMUM"]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))]["UMUM"] : 0;
                            $baru["PERUSAHAAN"] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))]["PERUSAHAAN"]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))]["PERUSAHAAN"] : 0;
                            $baru["BPJS"] = isset($q["baru"][date("Y-m-d", strtotime($tanggal))]["BPJS"]) ? $q["baru"][date("Y-m-d", strtotime($tanggal))]["BPJS"] : 0;
                            foreach ($q["lama"] as $key => $value) {
                                if (date("Y-m-d", strtotime($key)) >= date("Y-m-d", strtotime($tanggal))) {
                                    foreach ($value as $key2 => $value2) {
                                        if ((date("Y-m-d", strtotime($key2)) < date("Y-m-d", strtotime($tanggal)))) {
                                          if (isset($lama[406])) $lama[406] += $value2[406]; else $lama[406] = $value2[406];
                                          if (isset($lama[410])) $lama[410] += $value2[410]; else $lama[410] = $value2[410];
                                          if (isset($lama[422])) $lama[422] += $value2[422]; else $lama[422] = $value2[422];
                                          if (isset($lama[416])) $lama[416] += $value2[416]; else $lama[416] = $value2[416];
                                          if (isset($lama[404])) $lama[404] += $value2[404]; else $lama[404] = $value2[404];
                                          if (isset($lama[408])) $lama[408] += $value2[408]; else $lama[408] = $value2[408];
                                          if (isset($lama[421])) $lama[421] += $value2[421]; else $lama[421] = $value2[421];
                                          if (isset($lama[415])) $lama[415] += $value2[415]; else $lama[415] = $value2[415];
                                          if (isset($lama[405])) $lama[405] += $value2[405]; else $lama[405] = $value2[405];
                                          if (isset($lama[409])) $lama[409] += $value2[409]; else $lama[409] = $value2[409];
                                          if (isset($lama[423])) $lama[423] += $value2[423]; else $lama[423] = $value2[423];
                                          if (isset($lama[417])) $lama[417] += $value2[417]; else $lama[417] = $value2[417];
                                          if (isset($lama[412])) $lama[412] += $value2[412]; else $lama[412] = $value2[412];
                                          if (isset($lama[413])) $lama[413] += $value2[413]; else $lama[413] = $value2[413];
                                          if (isset($lama["DINAS"])) $lama["DINAS"] += $value2["DINAS"]; else $lama["DINAS"] = $value2["DINAS"];
                                          if (isset($lama["UMUM"])) $lama["UMUM"] += $value2["UMUM"]; else $lama["UMUM"] = $value2["UMUM"];
                                          if (isset($lama["PERUSAHAAN"])) $lama["PERUSAHAAN"] += $value2["PERUSAHAAN"]; else $lama["PERUSAHAAN"] = $value2["PERUSAHAAN"];
                                          if (isset($lama["BPJS"])) $lama["BPJS"] += $value2["BPJS"]; else $lama["BPJS"] = $value2["BPJS"];
                                        }
                                    }
                                }
                                if ($key=="kosong"){
                                  foreach ($value as $key2 => $value2) {
                                    if (date("Y-m-d",strtotime($tanggal))==date("Y-m-d") || date("Y-m-d", strtotime($key2)) < date("Y-m-d",strtotime($tanggal))) {
                                      if (date("Y-m-d", strtotime($key2)) < date("Y-m-d", strtotime($tanggal))) {
                                        if (isset($lama[406])) $lama[406] += $value2[406]; else $lama[406] = $value2[406];
                                        if (isset($lama[410])) $lama[410] += $value2[410]; else $lama[410] = $value2[410];
                                        if (isset($lama[422])) $lama[422] += $value2[422]; else $lama[422] = $value2[422];
                                        if (isset($lama[416])) $lama[416] += $value2[416]; else $lama[416] = $value2[416];
                                        if (isset($lama[404])) $lama[404] += $value2[404]; else $lama[404] = $value2[404];
                                        if (isset($lama[408])) $lama[408] += $value2[408]; else $lama[408] = $value2[408];
                                        if (isset($lama[421])) $lama[421] += $value2[421]; else $lama[421] = $value2[421];
                                        if (isset($lama[415])) $lama[415] += $value2[415]; else $lama[415] = $value2[415];
                                        if (isset($lama[405])) $lama[405] += $value2[405]; else $lama[405] = $value2[405];
                                        if (isset($lama[409])) $lama[409] += $value2[409]; else $lama[409] = $value2[409];
                                        if (isset($lama[423])) $lama[423] += $value2[423]; else $lama[423] = $value2[423];
                                        if (isset($lama[417])) $lama[417] += $value2[417]; else $lama[417] = $value2[417];
                                        if (isset($lama[412])) $lama[412] += $value2[412]; else $lama[412] = $value2[412];
                                        if (isset($lama[413])) $lama[413] += $value2[413]; else $lama[413] = $value2[413];
                                        if (isset($lama["DINAS"])) $lama["DINAS"] += $value2["DINAS"]; else $lama["DINAS"] = $value2["DINAS"];
                                        if (isset($lama["UMUM"])) $lama["UMUM"] += $value2["UMUM"]; else $lama["UMUM"] = $value2["UMUM"];
                                        if (isset($lama["PERUSAHAAN"])) $lama["PERUSAHAAN"] += $value2["PERUSAHAAN"]; else $lama["PERUSAHAAN"] = $value2["PERUSAHAAN"];
                                        if (isset($lama["BPJS"])) $lama["BPJS"] += $value2["BPJS"]; else $lama["BPJS"] = $value2["BPJS"];
                                      }
                                    }
                                  }
                                }
                                if (date("Y-m-d") < date("Y-m-d", strtotime($tanggal))) {
                                  $lama[406] = $lama[410] = $lama[416] = $lama[404] = $lama[408] = $lama[415] = $lama[405] = $lama[409] = $lama[417] = $lama[412] = $lama[413] = $lama[421] = $lama[422] = $lama[423] = $lama["UMUM"] = $lama["PERUSAHAAN"] = $lama["BPJS"] = 0;
                                }
                            }
                            foreach ($q["pulang"][$tanggal] as $sp => $val) {
                              foreach ($val as $key => $value) {
                                if (isset($pulang[$sp][$key])) $pulang[$sp][$key] += $value; else $pulang[$sp][$key] = $value;
                                if ($key=="DINAS" || $key=="UMUM" || $key=="PERUSAHAAN" || $key=="BPJS") $totalpulang += $value;
                              }
                            }
                            foreach ($q["meninggal"][$tanggal] as $sp => $val) {
                              foreach ($val as $key => $value) {
                                if (isset($meninggal[$sp][$key])) $meninggal[$sp][$key] += $value; else $meninggal[$sp][$key] = $value;
                              }
                            }
                            echo "<td class='text-center'>" . ($lama[406]=="" ? 0 : $lama[406]) . "</td>";
                            echo "<td class='text-center'>" . ($lama[410]=="" ? 0 : $lama[410]). "</td>";
                            echo "<td class='text-center'>" . (($lama[416]=="" ? 0 : $lama[416]) + ($lama[422]=="" ? 0 : $lama[422])). "</td>";
                            echo "<td class='text-center'>" . ($lama[404]=="" ? 0 : $lama[404]) . "</td>";
                            echo "<td class='text-center'>" . ($lama[408]=="" ? 0 : $lama[408]). "</td>";
                            echo "<td class='text-center'>" . (($lama[415]=="" ? 0 : $lama[415]) + ($lama[421]=="" ? 0 : $lama[421])) . "</td>";
                            echo "<td class='text-center'>" . ($lama[405]=="" ? 0 : $lama[405]) . "</td>";
                            echo "<td class='text-center'>" . ($lama[409]=="" ? 0 : $lama[409]). "</td>";
                            echo "<td class='text-center'>" . (($lama[417]=="" ? 0 : $lama[417]) + ($lama[423]=="" ? 0 : $lama[423])) . "</td>";
                            echo "<td class='text-center'>" . (($lama[412]=="" ? 0 : $lama[412]) + ($lama[413]=="" ? 0 : $lama[413])) . "</td>";
                            echo "<td class='text-center'>" . ($lama["UMUM"]=="" ? 0 : $lama["UMUM"]) . "</td>";
                            echo "<td class='text-center'>" . ($lama["PERUSAHAAN"]=="" ? 0 : $lama["PERUSAHAAN"]) . "</td>";
                            echo "<td class='text-center'>" . ($lama["BPJS"]=="" ? 0 : $lama["BPJS"]) . "</td>";
                            echo "<td class='text-center'>" . $baru[406] . "</td>";
                            echo "<td class='text-center'>" . $baru[410] . "</td>";
                            echo "<td class='text-center'>" . ($baru[416]+$baru[422]) . "</td>";
                            echo "<td class='text-center'>" . $baru[404] . "</td>";
                            echo "<td class='text-center'>" . $baru[408] . "</td>";
                            echo "<td class='text-center'>" . ($baru[415]+$baru[421]) . "</td>";
                            echo "<td class='text-center'>" . $baru[405] . "</td>";
                            echo "<td class='text-center'>" . $baru[409] . "</td>";
                            echo "<td class='text-center'>" . ($baru[417]+$baru[423]) . "</td>";
                            echo "<td class='text-center'>" . ($baru[412]+$baru[413]) . "</td>";
                            echo "<td class='text-center'>" . $baru["UMUM"] . "</td>";
                            echo "<td class='text-center'>" . $baru["PERUSAHAAN"] . "</td>";
                            echo "<td class='text-center'>" . $baru["BPJS"] . "</td>";
                            // $jumlah = $lama[406]+$lama[410]+$lama[416]+$lama[404]+$lama[408]+$lama[415]+$lama[405]+$lama[409]+$lama[417]+$lama[412]+$lama["UMUM"]+$lama["PERUSAHAAN"]+$lama["BPJS"];
                            // $jumlah += $baru[406]+$baru[410]+$baru[416]+$baru[404]+$baru[408]+$baru[415]+$baru[405]+$baru[409]+$baru[417]+$baru[412]+$baru["UMUM"]+$baru["PERUSAHAAN"]+$baru["BPJS"];
                            for ($n=1;$n<=5;$n++) {
                              if ($n==4){
                                echo "<td class='text-center'>" . ($meninggal[4][406]=="" ? 0 : $meninggal[4][406]) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[4][410]=="" ? 0 : $meninggal[4][410]). "</td>";
                                echo "<td class='text-center'>" . (($meninggal[4][416]=="" ? 0 : $meninggal[4][416]) + ($meninggal[4][422]=="" ? 0 : $meninggal[4][422])) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[4][404]=="" ? 0 : $meninggal[4][404]) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[4][408]=="" ? 0 : $meninggal[4][408]) . "</td>";
                                echo "<td class='text-center'>" . (($meninggal[4][415]=="" ? 0 : $meninggal[4][415]) + ($meninggal[4][421]=="" ? 0 : $meninggal[4][421])) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[4][405]=="" ? 0 : $meninggal[4][405]) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[4][409]=="" ? 0 : $meninggal[4][409]) . "</td>";
                                echo "<td class='text-center'>" . (($meninggal[4][417]=="" ? 0 : $meninggal[4][417]) + ($meninggal[4][423]=="" ? 0 : $meninggal[4][423])) . "</td>";
                                echo "<td class='text-center'>" . (($meninggal[4][412]=="" ? 0 : $meninggal[4][412]) + ($meninggal[4][413]=="" ? 0 : $meninggal[4][413]))  . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[4]["UMUM"]=="" ? 0 : $meninggal[4]["UMUM"]) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[4]["PERUSAHAAN"]=="" ? 0 : $meninggal[4]["PERUSAHAAN"]) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[4]["BPJS"]=="" ? 0 : $meninggal[4]["BPJS"]) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[5][406]=="" ? 0 : $meninggal[5][406]) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[5][410]=="" ? 0 : $meninggal[5][410]). "</td>";
                                echo "<td class='text-center'>" . (($meninggal[5][416]=="" ? 0 : $meninggal[5][416]) + ($meninggal[5][422]=="" ? 0 : $meninggal[5][422])) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[5][404]=="" ? 0 : $meninggal[5][404]) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[5][408]=="" ? 0 : $meninggal[5][408]) . "</td>";
                                echo "<td class='text-center'>" . (($meninggal[5][415]=="" ? 0 : $meninggal[5][415]) + ($meninggal[5][421]=="" ? 0 : $meninggal[5][421])) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[5][405]=="" ? 0 : $meninggal[5][405]) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[5][409]=="" ? 0 : $meninggal[5][409]) . "</td>";
                                echo "<td class='text-center'>" . (($meninggal[5][417]=="" ? 0 : $meninggal[5][417]) + ($meninggal[5][423]=="" ? 0 : $meninggal[5][423])) . "</td>";
                                echo "<td class='text-center'>" . (($meninggal[5][412]=="" ? 0 : $meninggal[5][412]) + ($meninggal[5][413]=="" ? 0 : $meninggal[5][413]))  . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[5]["UMUM"]=="" ? 0 : $meninggal[5]["UMUM"]) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[5]["PERUSAHAAN"]=="" ? 0 : $meninggal[5]["PERUSAHAAN"]) . "</td>";
                                echo "<td class='text-center'>" . ($meninggal[5]["BPJS"]=="" ? 0 : $meninggal[5]["BPJS"]) . "</td>";
                              } else {
                                echo "<td class='text-center'>" . ($pulang[$n][406]=="" ? 0 : $pulang[$n][406]) . "</td>";
                                echo "<td class='text-center'>" . ($pulang[$n][410]=="" ? 0 : $pulang[$n][410]). "</td>";
                                echo "<td class='text-center'>" . (($pulang[$n][416]=="" ? 0 : $pulang[$n][416]) + ($pulang[$n][422]=="" ? 0 : $pulang[$n][422])) . "</td>";
                                echo "<td class='text-center'>" . ($pulang[$n][404]=="" ? 0 : $pulang[$n][404]) . "</td>";
                                echo "<td class='text-center'>" . ($pulang[$n][408]=="" ? 0 : $pulang[$n][408]) . "</td>";
                                echo "<td class='text-center'>" . (($pulang[$n][415]=="" ? 0 : $pulang[$n][415]) + ($pulang[$n][421]=="" ? 0 : $pulang[$n][421])) . "</td>";
                                echo "<td class='text-center'>" . ($pulang[$n][405]=="" ? 0 : $pulang[$n][405]) . "</td>";
                                echo "<td class='text-center'>" . ($pulang[$n][409]=="" ? 0 : $pulang[$n][409]) . "</td>";
                                echo "<td class='text-center'>" . (($pulang[$n][417]=="" ? 0 : $pulang[$n][417]) + ($pulang[$n][423]=="" ? 0 : $pulang[$n][423])) . "</td>";
                                echo "<td class='text-center'>" . (($pulang[$n][412]=="" ? 0 : $pulang[$n][412]) + ($pulang[$n][413]=="" ? 0 : $pulang[$n][413]))  . "</td>";
                                echo "<td class='text-center'>" . ($pulang[$n]["UMUM"]=="" ? 0 : $pulang[$n]["UMUM"]) . "</td>";
                                echo "<td class='text-center'>" . ($pulang[$n]["PERUSAHAAN"]=="" ? 0 : $pulang[$n]["PERUSAHAAN"]) . "</td>";
                                echo "<td class='text-center'>" . ($pulang[$n]["BPJS"]=="" ? 0 : $pulang[$n]["BPJS"]) . "</td>";
                              }
                            }
                            if (date("Y-m-d") >= date("Y-m-d", strtotime($tanggal))) {
                              $jumlah = $lama["DINAS"]+$lama["UMUM"]+$lama["PERUSAHAAN"]+$lama["BPJS"];
                              $jumlah += $baru["DINAS"]+$baru["UMUM"]+$baru["PERUSAHAAN"]+$baru["BPJS"];
                              // $jumlah -= $pulang["DINAS"]+$pulang["UMUM"]+$pulang["PERUSAHAAN"]+$pulang["BPJS"];
                              $jumlah -= $totalpulang;
                            } else $jumlah = 0;
                            echo "<td class='text-center'>" . $jumlah . "</td>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
