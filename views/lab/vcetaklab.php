
<!DOCTYPE html>

<html>
<link rel="stylesheet" href="<?php echo base_url();?>css/print.css">
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
	<script>
		$(document).ready(function(){
			getttd();
            getttd1();
			window.print();
		});

		function getttd(){
			var ttd = "<?php echo site_url('ttddokter/getttddokterlab/'.$q->id_dokter);?>";
            $('.ttd_qrcode').qrcode({width: 80,height: 80, text:ttd});
		}
        function getttd1(){
			var ttd = "<?php echo site_url('ttddokter/getttdanalys/'.$q1->row()->analys);?>";
            $('.ttd_qrcode_analys').qrcode({width: 80,height: 80, text:ttd});
		}
	</script>
<body>
<table width = "100%" align="right" border ="0" rules="rows" >
	<tr>
		<td>
			<table  width="100%" align="right" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2">
						<strong>LABORATORIUM KLINIK</strong>
					</td>
					<td width="25%">
						<strong>PASIEN RAWAT JALAN </strong>
					</td>
					<td>:&nbsp;<?php echo $q->polik ?></td>
				</tr>

				<tr>
					<td colspan="2">RUMAH SAKIT CIREMAI</td>
					<td>No.Register </td>
					<td width="25%">:&nbsp;<?php echo $no_reg ?></td>
				</tr>
				<tr>
					<td colspan="2">JL. KESAMBI NO. 237 - CIREBON Telp. (0231) 238335</td>
					<td>Tgl.Cetak </td>
					<td width="25%">:&nbsp; <?php echo date("d/m/Y");?> Jam : <?php echo date("H:i:s"); ?></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td><strong>Telp.</strong></td>
					<td width="25%"><strong>:&nbsp;<?php echo $q->telpon; ?></strong></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td>
		<table width="100%" align="right">
		<tr>

				<td align ="center" width="25%"><font size="4"><strong> HASIL PEMERIKSAAN LABORATORIUM  <?php echo "<div style='float:right'>".$q->no_antrian."</div>"; ?></strong></font></td>


			</tr>
		</table>
	</td></tr>
	<?php
				$t1 = new DateTime('today');
				$t2 = new DateTime($q->tgl_lahir);
				$y  = $t1->diff($t2)->y;
				$m  = $t1->diff($t2)->m;
				$d  = $t1->diff($t2)->d;

			?>
	<tr>
		<td>

			<table width="100%" align="right"border="0" cellpadding="0" cellspacing="0" style="table-layout: fixed;">
			<tr>
				<td>NAMA PASIEN <span style="float: right;">:</span> </td>
				<td width="25%"><?php echo $q->nama_pasien ?></td>
				<td>NO REKMED <span style="float: right;">:</span></td>
				<td width="25%"><?php echo $q->no_rekmed ?></td>
			</tr>
			<tr>
				<td>JENIS KELAMIN <span style="float: right;">:</span></td>
				<td width="25%"><?php echo $q->jk ?></td>
				<td>GOL PASIEN <span style="float: right;">:</span></td>
				<td width="25%"><?php echo $q->golpas ?></td>
			</tr>
			<tr>
				<td width="25%">UMUR <span style="float: right;">:</span></td>
				<td width="25%"><?php echo ("$y tahun $m bulan $d hari") ?></td>
				<td>ALAMAT<span style="float: right;">:</span></td>
				<td width="25%" style=" border-bottom:1px solid #fff; border-left:1px solid #fff; border-top:1px solid transparent; text-overflow:ellipsis; overflow:hidden; white-space:nowrap; color: black;"><?php echo $q->alamat ?></td>
			</tr>

		</table>
		</font>
		</td>
	</tr>
	<tr>
		<td>
			<table cellspacing="2" cellpadding="1"  width="100%" align="right"border="0">
				<thead>
					<th align="center"><strong>No. <hr style="margin-bottom: 1px; margin-top: 3px"></strong></th>
					<th align="left"><strong>Jenis Pemeriksaan <hr style="margin-bottom: 1px; margin-top: 3px"></strong></th>
					<th align="left"><strong>Hasil <hr style="margin-bottom: 1px; margin-top: 3px"></strong></th>
					<th align="left"><strong>Nilai Rujukan <hr style="margin-bottom: 1px; margin-top: 3px"></strong></th>
				</thead>

				<tbody>
					<?php
						$sdata="";
						$i=1;$n=1;
						$judul = "";
						$namaanalys = "";
						$nama_tindakan= "";
            $header = "";
				        foreach ($q1->result() as $row){
				        	$merah = "";
				        	$hasil = (float)$row->hasil;
				        	if ($row->min_kritis!=""){
				        		if ($hasil<=$row->min_kritis)
				        			$merah = "red";
				        	}
				        	if ($row->max_kritis!=""){
				        		if ($hasil>=$row->max_kritis)
				        			$merah = "red";
				        	}
				        	if ($row->kode=="N008"){
				        		if (strtolower($row->hasil)!=strtolower($row->normal))
				        			$merah = "red";
				        		else
				        			$merah = "";
				        	}
				        	$namaanalys = (isset($analys[$row->analys]) ? $analys[$row->analys] : "");
				        	if ($row->jenis_kelamin=="L") {
							    $rujukan = $row->pria;
							} else {
							    $rujukan = $row->wanita;
							}
							if ($judul!=$row->judul){
								$i = 1;
								echo "<tr>";
								echo "<td align='center'>".$n++."</td>";
								echo "<td colspan='3'>".$row->judul."</td>";
								// echo "<td colspan='3'>".$judul."</td>";
								echo "<tr>";
								$judul = $row->judul;
							}
              if (isset($h[$row->kode_tindakan])){
                if ($header!=$h[$row->kode_tindakan]){
                  echo "<tr>";
  								echo "<td align='center'>&nbsp;</td>";
  								echo "<td colspan='3'>".$h[$row->kode_tindakan]."</td>";
  								echo "<tr>";
                }
              }
							echo "<tr>";
							echo "<td>&nbsp;</td>";
							echo "<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$row->nama."</td>";
							echo "<td align='left'><label class='text-".$merah."'>".$row->hasil."&nbsp;".$row->satuan."</label></td>";
							echo "<td align='left'>".$rujukan."</td>";
							echo "</tr>";
					        $i++;
                  $header = $h[$row->kode_tindakan];

				    }
				    ?>
				</tbody>
			</table>
		</td>

	</tr>
</table>
<hr>
	<table width="100%" align="right">
		<tr>
			<td width="25%" align="center" style="border-top:1px solid">PENANGGUNG JAWAB <br>
				<br><div class="ttd_qrcode"></div>
			</td>
			<td width="25%" align="center" style="border-top:1px solid">Cirebon,&nbsp; <?php echo date("d-m-Y H:i:s",strtotime($q->trk)); ?>
				<br>&nbsp;&nbsp;PETUGAS LAB<br>
                <div class="ttd_qrcode_analys"></div>
			</td>
		</tr>
		<tr>
				<td></td>
				<td width="25%"> &nbsp;</td>
		</tr>
		<tr>
				<td></td>
				<td width="25%"> &nbsp;</td>
		</tr>
		<tr>
				<td width="25%" align="center"> <?php echo $q->dokter ?>
				<!-- <div class="ttd_qrcode"></div> -->
				</td>
				<td width="25%" align="center">
                    <?php echo $namaanalys; ?></td>
		</tr>
	</table>

<style type="text/css">
	html, body {
        display: block;
        font-family: "sans-serif";
        width: 20cm;
         /*height: 13cm;*/
    }
	.pull-right {
	    float: right;
	}
	.pull-left {
	    float: left;
	}
	th, td{
	    font-family: "sans-serif";
	}
	td {
	    font-size: 13px;
	}
	th {
	    font-size: 13px;
	    font-weight: bold;
	}
	.text-right{
	    align:right;
	}
	hr{
		color: black;
	}
	textarea{
		font-size: 13px;
	}
	@page{
		width: 20cm;
		/*height: 13cm;*/
	}
</style>
</body>
</html>
