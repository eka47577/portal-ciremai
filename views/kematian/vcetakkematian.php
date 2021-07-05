<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/defaultTheme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>js/select2/select2.css">
    <link rel="stylesheet" href="<?php echo base_url();?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="<?php echo base_url();?>js/jquery.js"></script>
    <script src="<?php echo base_url();?>js/jquery.fixedheadertable.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>plugins/bootstrap-typeahead/bootstrap-typeahead.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/select2/select2.js"></script>
    <script src="<?php echo base_url();?>js/jquery-barcode.js"></script>
    <script src="<?php echo base_url();?>js/jquery-qrcode.js"></script>
    <script src="<?php echo base_url();?>js/html2pdf.bundle.js"></script>
    <script src="<?php echo base_url();?>js/html2canvas.js"></script>
    <script src="<?php echo base_url();?>js/jquery.mask.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <link rel="icon" href="<?php echo base_url();?>img/computer.png" type="image/x-icon" />

    <script type="text/javascript" src="<?php echo base_url()?>js/library.js"></script>
  </head>
<script>
    $(document).ready(function(){
        getttd_saksi();
        getttd_pernyataan();
        getttd_prm();
		window.print();
    });

    function getttd_prm(){
        var ttd = "<?php echo site_url('ttddokter/getttdprm/'.$q2->petugas_rm);?>";
        $('.getttd_prm').qrcode({width: 80,height: 80, text:ttd});
    }
    function getttd_saksi(){
        var ttd = "<?php echo site_url('persetujuan/getttd_saksi/'.$no_reg.'/'.$no_pasien);?>";
        $('.getttd_saksi').qrcode({width: 80,height: 80, text:ttd});
    }
    function getttd_pernyataan(){
        var ttd = "<?php echo site_url('persetujuan/getttd_pernyataan/'.$no_reg.'/'.$no_pasien);?>";
        $('.getttd_pernyataan').qrcode({width: 80,height: 80, text:ttd});
    }
</script>
    <?php if ($status=="copied") : ?>
    <img src="<?php echo base_url()."/img/watermark.png";?>" class="watermark">
    <?php endif ?>
    <?php
        function tgl($tgl,$tipe){
            $month = array("","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
            $xmonth = array("Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agt","Sep","Okt","Nop","Des");
            $hari = substr($tgl,0,10);
            $jam = substr($tgl,11,5);
            $m = (int)(substr($tgl,5,2));
            $tmp = substr($tgl,8,2)." ".$month[$m]." ".substr($tgl,0,4);
            if ($tipe == 1)
            {
                $tmp = $tmp." - ".$jam;
            }
            elseif ($tipe == 2)
            {
                $tmp = $tmp;
            }
            if (substr($tgl,0,4)=='0000')
            {
                return "";
            }
            else
            {
                return $tmp;
            }
        }


        $t1 = new DateTime("today");
        $t2 = new DateTime($q->tgl_lahir);
        $y  = $t1->diff($t2)->y;
        $m  = $t1->diff($t2)->m;
        $d  = $t1->diff($t2)->d;



        //alif
        // list($year_alif,$month_alif,$day_alif) = explode("-",$q1->tgl_keluar);
        // $year_diff  = $year_alif - $year;
        // $month_diff = $month_alif - $month;
        // $day_diff   = $day_alif - $day;
        // if ($month_diff < 0) {
        //     $year_diff--;
        //     $month_diff *= (-1);
        // }
        // elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
        // if ($day_diff < 0) {
        //     $day_diff *= (-1);
        // }
        $t1 = new DateTime('today');
        $t2 = new DateTime($q->tgl_lahir);
        $y  = $t1->diff($t2)->y;
        $m  = $t1->diff($t2)->m;
        $d  = $t1->diff($t2)->d;
        $umur = $y. " tahun ".$m." bulan ".$d." hari ";
        $pernyataan     = explode(",", $q2->pernyataan);
        $pernyataan0    = $pernyataan[0];
        $pernyataan1    = $pernyataan[1];
        $pernyataan2    = $pernyataan[2];
        $pernyataan3    = $pernyataan[3];
        $pernyataan4    = $pernyataan[4];
    ?>
    <h5>
        <b>RUMAH SAKIT TINGKAT III 03.06.01 CIREMAI<br>
        <u>DETASEMEN KESEHATAN WILAYAH 03.04.03</u>
        </b>
    </h5>
    <br>
    <p>
        <h4 align="center"><b><u>SURAT KETERANGAN KEMATIAN</u></b></h4>
    </p>
    <p align="center">
        <?php $bulan = array("","I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII");?>
        No : <?php echo $q2->nomor_surat ?>/ SKM/ <?php echo $bulan[(int)(date("m",strtotime($q1->tgl_keluar)))]."/ ".date("Y",strtotime($q1->tgl_keluar));?>
    </p>
    <br>
    <br>
    <br>
    <p>
        <b>Yang bertanda tangan di bawah ini :</b>
    </p>
    <table width="100%" class="laporan2">
        <tr>
            <td width="40%"><b>Nama</b></td>
            <td colspan="2">: <?php echo $q3->nama_k ?></td>
        </tr>
        <tr>
            <td><b>Pangkat / Golongan</b></td>
            <td>: <?php echo $q3->pangkat_k ?>  <?php echo $q3->golongan_k ?></td>
            <td><b>NIP</b> : <?php echo $q3->nip_k ?></td>

        </tr>
        <tr>
            <td><b>Jabatan</b></td>
            <td colspan="2">: <?php echo $q3->jabatan_k ?></td>
        </tr>
        <tr>
            <td><b>Kesatuan</b></td>
            <td colspan="2">: <?php echo $q3->kesatuan_k ?></td>
        </tr>
    </table>
    <p>
        <b>Menerangkan bahwa pada :</b>
    </p>
    <table width="100%" class="laporan2">
        <tr>
            <td width="40%"><b>Jam</b></td>
            <td>: <?php echo $q1->jam_keluar ?></td>
        </tr>
        <tr>
            <td width="40%"><b>Tanggal</b></td>
            <td>: <?php echo date("d-m-Y",strtotime($q1->tgl_keluar)) ?></td>
        </tr>
    </table>
    <table width="100%" class="laporan2">
        <tr>
            <td width="40%"><b>Telah meninggal dunia di</b></td>
            <td colspan="2">: RS CIREMAI</td>
        </tr>
        <tr>
            <td><b>Nama</b></td>
            <td colspan="2">: <?php echo $q->nama_pasien; ?></td>
        </tr>
        <tr>
            <td ><b>Umur</b></td>
            <td>: <?php echo $umur ?></td>
            <td><b>Jenis Kelamin</b>: <?php echo ($q->jenis_kelamin=="L" ? "Laki-Laki" : "Perempuan") ?></td>
        </tr>
        <tr>
            <td ><b>Nama Suami / Ayah</b></td>
            <td colspan="2">: <?php echo ($q->nama_pasangan=="" ? "-" : $q->nama_pasangan) ?></td>
        </tr>
        <tr>
            <td ><b>Pangkat / Golongan</b></td>
            <td colspan="2">: <?php echo ($q->nama_pangkat=="" ? "-" : $q->nama_pangkat) ?></td>
        </tr>
        <tr>
            <td ><b>NRP / NIP</b></td>
            <td colspan="2">: <?php echo ($q->nip=="" ? "-" : $q->nip) ?></td>
        </tr>
        <tr>
            <td ><b>Kesatuan</b></td>
            <td colspan="2">: <?php echo ($q->nama_kesatuan=="" ? "-" : $q->nama_kesatuan);?></td>
        </tr>
        <tr>
            <td ><b>Alamat</b></td>
            <td colspan="2">: <?php echo $q->alamat ?></td>
        </tr>
    </table>
    <br>
    <p>
        Demikian surat pernyataan ini dibuat dengan sebenar benarnya tanpa ada paksaan dari pihak manapun dan dapat dipergunakan sebagaimana mestinya.
    </p>
    <p align="right">
        Cirebon, <?php echo  tgl(date("Y-m-d",strtotime($q1->tgl_keluar)),2); ?>
    </p>
    <table class="laporan2" width="100%">
        <tr>
            <td align="right" width="50%">
            </td>
            <td align="right" >
                <b>An. Kepala Rumah Sakit Ciremai<br>Kasub Bidang Keperawatan</b>
            </td>
        </tr>
        <tr>
            <td align="right">

            </td>
            <td align="right">
                <div class="getttd_saksi"> </div>
                <br>
                <?php echo $q3->nama_k."<br>".$q3->pangkat_k." ".$q3->golongan_k." ".$q3->nip_k;  ?>
            </td>
        </tr>
    </table>
<style>
    *{
        padding-left : 5px;
        padding-right: 5px;
    }
    table, td,th{
        font-family: sans-serif;
        /*padding: 0px; margin:0px;*/
        /*font-size: 13px;*/
    }
    /*input.text{
        height:5px;
    }*/
</style>
<style type="text/css">
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 11px;
    }
    .laporan {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 11px;
    }
    .laporan > thead > tr > th,
    .laporan > tbody > tr > th,
    .laporan > tfoot > tr > th,
    .laporan > thead > tr > td,
    .laporan > tbody > tr > td,
    .laporan > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 1px solid #ddd;
    }
    .laporan > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 2px solid #ddd;
    }
    .laporan > caption + thead > tr:first-child > th,
    .laporan > colgroup + thead > tr:first-child > th,
    .laporan > thead:first-child > tr:first-child > th,
    .laporan > caption + thead > tr:first-child > td,
    .laporan > colgroup + thead > tr:first-child > td,
    .laporan > thead:first-child > tr:first-child > td {
        border-top: 0;
    }
    .laporan > tbody + tbody {
        border-top: 2px solid #ddd;
    }
    .laporan td,
    .laporan th {
        background-color: #fff !important;
        border: 1px solid #000 !important;
    }



    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
    }
    .laporan2 {
        border-collapse: collapse !important;
        background-color: transparent;
        width: 100%;
        max-width: 100%;
        margin-bottom: 20px;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
    }
    .laporan2 > thead > tr > th,
    .laporan2 > tbody > tr > th,
    .laporan2 > tfoot > tr > th,
    .laporan2 > thead > tr > td,
    .laporan2 > tbody > tr > td,
    .laporan2 > tfoot > tr > td {
        padding: 8px;
        line-height: 1.42857143;
        vertical-align: top;
        border-top: 0px solid #ddd;
    }
    .laporan2 > thead > tr > th {
        vertical-align: bottom;
        border-bottom: 0px solid #ddd;
    }
    .laporan2 > caption + thead > tr:first-child > th,
    .laporan2 > colgroup + thead > tr:first-child > th,
    .laporan2 > thead:first-child > tr:first-child > th,
    .laporan2 > caption + thead > tr:first-child > td,
    .laporan2 > colgroup + thead > tr:first-child > td,
    .laporan2 > thead:first-child > tr:first-child > td {
        border-top: 0;
    }
    .laporan2 > tbody + tbody {
        border-top: 0px solid #ddd;
    }
    .laporan2 td,
    .laporan2 th {
        border: 0px solid #000 !important;
    }
    .watermark {
        position: absolute;
        top: 300px;
        left:200px;
        z-index:-99;
        opacity: 0.5;
        width: 300px;
    }
</style>
