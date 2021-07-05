<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Rekap_LabInap".date('YmdHis').".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
    <div class="table-responsive">
        <h4 align="center">LAPORAN PEMERIKSAAN LABOLATORIUM KLINIK</h4>
        <div align="center">Periode Tanggal : <?php echo $tgl1."-".$tgl2?></div>
        <?php 
            if ($tindakan != "all") {
                $pemeriksaan = $t2->nama_tindakan;
            }else{
                $pemeriksaan = "";
            }
        ?>
        Pemeriksaan : <?php echo $pemeriksaan; ?>
        <br>
        <table cellspacing="2" cellpadding="2" border="1" rules="rows">
            <thead>
                <tr class='bg-navy'>
                    <th class="text-center" style="vertical-align: middle" rowspan="2">No.</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="2">Tindakan</th>
                    <th class="text-center" style="vertical-align: middle" colspan="4">Gol. Pasien</th>
                    <th class="text-center" style="vertical-align: middle" rowspan="2">Jumlah</th>
                </tr>
                <tr class='bg-navy'>
                    <th class="text-center">Baru</th>
                    <th class="text-center">Lama</th>
                    <th class="text-center">Reguler</th>
                    <th class="text-center">Eksekutif</th>
                    <th class="text-center" width="5%">D</th>
                    <th class="text-center" width="5%">U</th>
                    <th class="text-center">BPJS</th>
                    <th class="text-center">PRSH</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    $hide = "";
                    $dinas = $umum = $bpjs = $prsh = 0;
                    foreach($t->result() as $data){
                        if ($tindakan!="all"){
                            if ($tindakan==$data->kode_tindakan){
                                $hide = "";
                            } else {
                                $hide = "class='hide'";
                            }
                        } else {
                            $jml = isset($p["tindakan"][$data->kode_tindakan]) ? $p["tindakan"][$data->kode_tindakan] : 0;
                            if ($jml>0){
                                $hide = "class='bg-blue text-bold'";
                            } else {
                                $hide = "";
                            }
                        }
                        echo "<tr ".$hide." tindakan='".$data->kode_tindakan."' nama_tindakan='".$data->nama_tindakan."'>";
                        echo "<td class='text-right'>".($i++)."</td>";
                        echo "<td>".$data->nama_tindakan."</td>";
                        echo "<td class='text-right'>".(isset($p["DINAS"][$data->kode_tindakan]) ? $p["DINAS"][$data->kode_tindakan] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($p["UMUM"][$data->kode_tindakan]) ? $p["UMUM"][$data->kode_tindakan] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($p["BPJS"][$data->kode_tindakan]) ? $p["BPJS"][$data->kode_tindakan] : 0)."</td>";
                        echo "<td class='text-right'>".(isset($p["PRSH"][$data->kode_tindakan]) ? $p["PRSH"][$data->kode_tindakan] : 0)."</td>";
                        $jumlah = (isset($p["DINAS"][$data->kode_tindakan]) ? $p["DINAS"][$data->kode_tindakan] : 0)+
                                  (isset($p["UMUM"][$data->kode_tindakan]) ? $p["UMUM"][$data->kode_tindakan] : 0)+
                                  (isset($p["BPJS"][$data->kode_tindakan]) ? $p["BPJS"][$data->kode_tindakan] : 0)+
                                  (isset($p["PRSH"][$data->kode_tindakan]) ? $p["PRSH"][$data->kode_tindakan] : 0);
                        $dinas += (isset($p["DINAS"][$data->kode_tindakan]) ? $p["DINAS"][$data->kode_tindakan] : 0);
                        $umum += (isset($p["UMUM"][$data->kode_tindakan]) ? $p["UMUM"][$data->kode_tindakan] : 0);
                        $bpjs += (isset($p["BPJS"][$data->kode_tindakan]) ? $p["BPJS"][$data->kode_tindakan] : 0);
                        $prsh += (isset($p["PRSH"][$data->kode_tindakan]) ? $p["PRSH"][$data->kode_tindakan] : 0);
                        echo "<td class='text-right'>".$jumlah."</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
            <tfoot>
                <tr class='bg-navy'>
                    <th colspan="2">Jumlah Pasien</th>
                    <th class="text-right"><?php echo $dinas;?></th>
                    <th class="text-right"><?php echo $umum;?></th>
                    <th class="text-right"><?php echo $bpjs;?></th>
                    <th class="text-right"><?php echo $prsh;?></th>
                    <th class="text-right"><?php echo ($dinas+$umum+$bpjs+$prsh);?></th>
                </tr>

            </tfoot>
        </table>
        <div align="right"> Penanggung Jawab</div>
        <br>
        <br>
        <br>
        <div align="right"> Dr, Rosni Faika, M.Kes Sp.PK</div>
    </div>
        
    


<style type="text/css">
    .modal-dialog{
        width:80%;
    }
        html, body {
        display: block;
        font-family: "sans-serif";
        width: 15cm;
         /*height: 13cm;*/
    }
    
    @page{
        width: 15cm; 
        /*height: 13cm;*/
    }
</style>