<?php
ini_set("error_reporting", 1);
session_start();
include ("../../koneksi.php");
$sql = mysqli_query($con, "SELECT * FROM tbl_splb where NO_KARTU_KERJA = '$_GET[kk]'");
$data = mysqli_fetch_array($sql);
?>
<link rel="stylesheet" href="../bootstrap/xeditable/css/bootstrap-editable.css">
<table class="table table-bordered" id="splb">
	<thead>
		<tr>
			<th colspan="16" style="text-align:center">FW-14-BRS-12/00</th>
		</tr>
		<tr>
			<th colspan="16" style="background-color: #4CAF50;">SETTING PERBEDAAN LOT BRUSHING</th>
		</tr>
	</thead>
	<tr class="baris">
		<td style="width: 180px;" data-no="1">No. KK & DEMAND</td>
		<td class="bg-warning" data-no="2" colspan="8">
			<?php echo $_GET['kk'] ?>&nbsp;/&nbsp;<?php echo $data['DEAMAND'] ?>
		</td>
		<td data-no="10" colspan="7" style="text-align: center;">SPV/ASST/LDR</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1">LANGGANAN</td>
		<td class="bg-warning" data-no="2" colspan="8"><?php echo $data['LANGGANAN'] ?></td>
		<td style="text-align:center;" data-no="10" colspan="7" class="bg-warning"><?php echo $data['TANGGAL_01'] ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1">ORDER</td>
		<td class="bg-warning" data-no="2" colspan="8"><?php echo $data['ORDER'] ?></td>
		<td data-no="10" colspan="7" rowspan="6"><?php echo $data['NOTE'] ?></textarea></td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1">JENIS KAIN</td>
		<td class="bg-warning" data-no="2" colspan="8"><?php echo $data['JENIS_KAIN'] ?></td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1">WARNA</td>
		<td class="bg-warning" data-no="2" colspan="8"><?php echo $data['WARNA'] ?></td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1">L X G PERMINTAAN</td>
		<td class="bg-warning" data-no="2" colspan="8"><?php echo $data['L_PERMINTAAN'] ?> X
			<?php echo $data['G_PERMINTAAN'] ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1">L X G AKTUAL</td>
		<td class="bg-warning" data-no="2" colspan="8">
			<a href="javascript:void(0)" class="bg-danger" data-name="L_AKTUAL"><?php echo $data['L_AKTUAL'] ?></a>
			X
			<a href="javascript:void(0)" class="bg-danger" data-name="G_AKTUAL"><?php echo $data['G_AKTUAL'] ?></a>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1">LOT</td>
		<td class="bg-warning" data-no="2" colspan="8"><?php echo $data['LOT'] ?></td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1">NO. HANGER</td>
		<td class="bg-warning" data-no="2" colspan="8"><?php echo $data['NO_HANGER'] ?></td>
		<td class="bg-danger" data-name="NAMA_TTD" data-no="2" colspan="7" style="text-align:center;">
			<?php echo $data['NAMA_TTD'] ?>
		</td>

	</tr>
	<tr class="baris">
		<td data-no="1" colspan="9" rowspan="2" style="text-align: center;font-size: 15px; font-weight: bold;">QUALITY
		</td>
		<td data-no="1" colspan="6" style="text-align:center;">OK</td>
		<td colspan="1" style="text-align: center;" class="bg-danger" data-no="2" data-name="OK">
			<?php echo $data['OK'] ?>
		</td>

	</tr>
	<tr>
		<td data-no="1" colspan="6" style="text-align:center;">NOT OK</td>
		<td colspan="1" style="text-align:center" data-no="2" class="bg-danger" data-name="NOT_OK">
			<?php echo $data['NOT_OK'] ?>
		</td>
	</tr>

	<tr>
		<td colspan="2" data-no="1" style="text-align: center;font-size: 15px; font-weight: bold;">GARUK</td>
		<td colspan="1" style="text-align:center" data-no="2" class="bg-danger" data-name="GARUK">
			<?php echo $data['GARUK'] ?>
		</td>
		<td colspan="14"></td>
	</tr>

	<tr class="baris">
		<td colspan="2"> BAGIAN KAIN</td>
		<td class="bg-danger" data-no="2" data-name="BAG_KAIN_01" style="text-align: center;">
			<?php echo $data['BAG_KAIN_01'] ?>
		</td>
		<td class="bg-danger" data-no="3" data-name="BAG_KAIN_02" style="text-align: center;">
			<?php echo $data['BAG_KAIN_02'] ?>
		</td>
		<td class="bg-danger" data-no="4" data-name="BAG_KAIN_03" style="text-align: center;">
			<?php echo $data['BAG_KAIN_03'] ?>
		</td>
		<td class="bg-danger" data-no="5" data-name="BAG_KAIN_04" style="text-align: center;">
			<?php echo $data['BAG_KAIN_04'] ?>
		</td>
		<td class="bg-danger" data-no="6" data-name="BAG_KAIN_05" style="text-align: center;">
			<?php echo $data['BAG_KAIN_05'] ?>
		</td>
		<td class="bg-danger" data-no="7" data-name="BAG_KAIN_06" style="text-align: center;">
			<?php echo $data['BAG_KAIN_06'] ?>
		</td>
		<td class="bg-danger" data-no="8" data-name="BAG_KAIN_07" style="text-align: center;">
			<?php echo $data['BAG_KAIN_07'] ?>
		</td>
		<td class="bg-danger" data-no="9" data-name="BAG_KAIN_08" style="text-align: center;">
			<?php echo $data['BAG_KAIN_08'] ?>
		</td>
		<td class="bg-danger" data-no="10" data-name="BAG_KAIN_09" style="text-align: center;">
			<?php echo $data['BAG_KAIN_09'] ?>
		</td>
		<td class="bg-danger" data-no="11" data-name="BAG_KAIN_10" style="text-align: center;">
			<?php echo $data['BAG_KAIN_10'] ?>
		</td>
		<td class="bg-danger" data-no="12" data-name="BAG_KAIN_11" style="text-align: center;">
			<?php echo $data['BAG_KAIN_11'] ?>
		</td>
		<td class="bg-danger" data-no="13" data-name="BAG_KAIN_12" style="text-align: center;">
			<?php echo $data['BAG_KAIN_12'] ?>
		</td>
		<td class="bg-danger" data-no="14" data-name="BAG_KAIN_13" style="text-align: center;">
			<?php echo $data['BAG_KAIN_13'] ?>
		</td>
		<td class="bg-danger" data-no="15" data-name="BAG_KAIN_14" style="text-align: center;">
			<?php echo $data['BAG_KAIN_14'] ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="1" rowspan="2">COUNTER PILE</td>
		<td data-no="1" colspan="1">1</td>
		<td class="bg-danger" data-no="1" data-name="COUNTER_PILE1" style="text-align: center;">
			<?php echo $data['COUNTER_PILE1']; ?>
		</td>
		<td class="bg-danger" data-no="2" data-name="COUNTER_PILE2" style="text-align: center;">
			<?php echo $data['COUNTER_PILE2']; ?>
		</td>
		<td class="bg-danger" data-no="3" data-name="COUNTER_PILE3" style="text-align: center;">
			<?php echo $data['COUNTER_PILE3']; ?>
		</td>
		<td class="bg-danger" data-no="4" data-name="COUNTER_PILE4" style="text-align: center;">
			<?php echo $data['COUNTER_PILE4']; ?>
		</td>
		<td class="bg-danger" data-no="5" data-name="COUNTER_PILE5" style="text-align: center;">
			<?php echo $data['COUNTER_PILE5']; ?>
		</td>
		<td class="bg-danger" data-no="6" data-name="COUNTER_PILE6" style="text-align: center;">
			<?php echo $data['COUNTER_PILE6']; ?>
		</td>
		<td class="bg-danger" data-no="7" data-name="COUNTER_PILE7" style="text-align: center;">
			<?php echo $data['COUNTER_PILE7']; ?>
		</td>
		<td class="bg-danger" data-no="8" data-name="COUNTER_PILE8" style="text-align: center;">
			<?php echo $data['COUNTER_PILE8']; ?>
		</td>
		<td class="bg-danger" data-no="9" data-name="COUNTER_PILE9" style="text-align: center;">
			<?php echo $data['COUNTER_PILE9']; ?>
		</td>
		<td class="bg-danger" data-no="10" data-name="COUNTER_PILE10" style="text-align: center;">
			<?php echo $data['COUNTER_PILE10']; ?>
		</td>
		<td class="bg-danger" data-no="11" data-name="COUNTER_PILE11" style="text-align: center;">
			<?php echo $data['COUNTER_PILE11']; ?>
		</td>
		<td class="bg-danger" data-no="12" data-name="COUNTER_PILE12" style="text-align: center;">
			<?php echo $data['COUNTER_PILE12']; ?>
		</td>
		<td class="bg-danger" data-no="13" data-name="COUNTER_PILE13" style="text-align: center;">
			<?php echo $data['COUNTER_PILE13']; ?>
		</td>
		<td class="bg-danger" data-no="14" data-name="COUNTER_PILE14" style="text-align: center;">
			<?php echo $data['COUNTER_PILE14']; ?>
		</td>
	</tr>
	</tr>
	<tr class="baris">
		<td data-no="1" colspan="1">2</td>
		<td class="bg-danger" data-no="1" data-name="COUNTER_PILE15" style="text-align: center;">
			<?php echo $data['COUNTER_PILE15']; ?>
		</td>
		<td class="bg-danger" data-no="2" data-name="COUNTER_PILE16" style="text-align: center;">
			<?php echo $data['COUNTER_PILE16']; ?>
		</td>
		<td class="bg-danger" data-no="3" data-name="COUNTER_PILE17" style="text-align: center;">
			<?php echo $data['COUNTER_PILE17']; ?>
		</td>
		<td class="bg-danger" data-no="4" data-name="COUNTER_PILE18" style="text-align: center;">
			<?php echo $data['COUNTER_PILE18']; ?>
		</td>
		<td class="bg-danger" data-no="5" data-name="COUNTER_PILE19" style="text-align: center;">
			<?php echo $data['COUNTER_PILE19']; ?>
		</td>
		<td class="bg-danger" data-no="6" data-name="COUNTER_PILE20" style="text-align: center;">
			<?php echo $data['COUNTER_PILE20']; ?>
		</td>
		<td class="bg-danger" data-no="7" data-name="COUNTER_PILE21" style="text-align: center;">
			<?php echo $data['COUNTER_PILE21']; ?>
		</td>
		<td class="bg-danger" data-no="8" data-name="COUNTER_PILE22" style="text-align: center;">
			<?php echo $data['COUNTER_PILE22']; ?>
		</td>
		<td class="bg-danger" data-no="9" data-name="COUNTER_PILE23" style="text-align: center;">
			<?php echo $data['COUNTER_PILE23']; ?>
		</td>
		<td class="bg-danger" data-no="10" data-name="COUNTER_PILE24" style="text-align: center;">
			<?php echo $data['COUNTER_PILE24']; ?>
		</td>
		<td class="bg-danger" data-no="11" data-name="COUNTER_PILE25" style="text-align: center;">
			<?php echo $data['COUNTER_PILE25']; ?>
		</td>
		<td class="bg-danger" data-no="12" data-name="COUNTER_PILE26" style="text-align: center;">
			<?php echo $data['COUNTER_PILE26']; ?>
		</td>
		<td class="bg-danger" data-no="13" data-name="COUNTER_PILE27" style="text-align: center;">
			<?php echo $data['COUNTER_PILE27']; ?>
		</td>
		<td class="bg-danger" data-no="14" data-name="COUNTER_PILE28" style="text-align: center;">
			<?php echo $data['COUNTER_PILE28']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="1" rowspan="2">PILE</td>
		<td data-no="1" colspan="1">1</td>
		<td class="bg-danger" data-no="1" data-name="PILE1" style="text-align: center;"><?php echo $data['PILE1']; ?>
		</td>
		<td class="bg-danger" data-no="2" data-name="PILE2" style="text-align: center;"><?php echo $data['PILE2']; ?>
		</td>
		<td class="bg-danger" data-no="3" data-name="PILE3" style="text-align: center;"><?php echo $data['PILE3']; ?>
		</td>
		<td class="bg-danger" data-no="4" data-name="PILE4" style="text-align: center;"><?php echo $data['PILE4']; ?>
		</td>
		<td class="bg-danger" data-no="5" data-name="PILE5" style="text-align: center;"><?php echo $data['PILE5']; ?>
		</td>
		<td class="bg-danger" data-no="6" data-name="PILE6" style="text-align: center;"><?php echo $data['PILE6']; ?>
		</td>
		<td class="bg-danger" data-no="7" data-name="PILE7" style="text-align: center;"><?php echo $data['PILE7']; ?>
		</td>
		<td class="bg-danger" data-no="8" data-name="PILE8" style="text-align: center;"><?php echo $data['PILE8']; ?>
		</td>
		<td class="bg-danger" data-no="9" data-name="PILE9" style="text-align: center;"><?php echo $data['PILE9']; ?>
		</td>
		<td class="bg-danger" data-no="10" data-name="PILE10" style="text-align: center;"><?php echo $data['PILE10']; ?>
		</td>
		<td class="bg-danger" data-no="11" data-name="PILE11" style="text-align: center;"><?php echo $data['PILE11']; ?>
		</td>
		<td class="bg-danger" data-no="12" data-name="PILE12" style="text-align: center;"><?php echo $data['PILE12']; ?>
		</td>
		<td class="bg-danger" data-no="13" data-name="PILE13" style="text-align: center;"><?php echo $data['PILE13']; ?>
		</td>
		<td class="bg-danger" data-no="14" data-name="PILE14" style="text-align: center;"><?php echo $data['PILE14']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td data-no="1" colspan="1">2</td>
		<td class="bg-danger" data-no="15" data-name="PILE15" style="text-align: center;"><?php echo $data['PILE15']; ?>
		</td>
		<td class="bg-danger" data-no="16" data-name="PILE16" style="text-align: center;"><?php echo $data['PILE16']; ?>
		</td>
		<td class="bg-danger" data-no="17" data-name="PILE17" style="text-align: center;"><?php echo $data['PILE17']; ?>
		</td>
		<td class="bg-danger" data-no="18" data-name="PILE18" style="text-align: center;"><?php echo $data['PILE18']; ?>
		</td>
		<td class="bg-danger" data-no="19" data-name="PILE19" style="text-align: center;"><?php echo $data['PILE19']; ?>
		</td>
		<td class="bg-danger" data-no="20" data-name="PILE20" style="text-align: center;"><?php echo $data['PILE20']; ?>
		</td>
		<td class="bg-danger" data-no="21" data-name="PILE21" style="text-align: center;"><?php echo $data['PILE21']; ?>
		</td>
		<td class="bg-danger" data-no="22" data-name="PILE22" style="text-align: center;"><?php echo $data['PILE22']; ?>
		</td>
		<td class="bg-danger" data-no="23" data-name="PILE23" style="text-align: center;"><?php echo $data['PILE23']; ?>
		</td>
		<td class="bg-danger" data-no="24" data-name="PILE24" style="text-align: center;"><?php echo $data['PILE24']; ?>
		</td>
		<td class="bg-danger" data-no="25" data-name="PILE25" style="text-align: center;"><?php echo $data['PILE25']; ?>
		</td>
		<td class="bg-danger" data-no="26" data-name="PILE26" style="text-align: center;"><?php echo $data['PILE26']; ?>
		</td>
		<td class="bg-danger" data-no="27" data-name="PILE27" style="text-align: center;"><?php echo $data['PILE27']; ?>
		</td>
		<td class="bg-danger" data-no="28" data-name="PILE28" style="text-align: center;"><?php echo $data['PILE28']; ?>
		</td>

	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="1" rowspan="2">DRUM</td>
		<td data-no="1" colspan="1">1</td>
		<td class="bg-danger" data-no="2" data-name="DRUM_01" style="text-align: center;"><?php echo $data['DRUM_01'] ?>
		</td>
		<td class="bg-danger" data-no="3" data-name="DRUM_02" style="text-align: center;"><?php echo $data['DRUM_02'] ?>
		</td>
		<td class="bg-danger" data-no="4" data-name="DRUM_03" style="text-align: center;"><?php echo $data['DRUM_03'] ?>
		</td>
		<td class="bg-danger" data-no="5" data-name="DRUM_04" style="text-align: center;"><?php echo $data['DRUM_04'] ?>
		</td>
		<td class="bg-danger" data-no="6" data-name="DRUM_05" style="text-align: center;"><?php echo $data['DRUM_05'] ?>
		</td>
		<td class="bg-danger" data-no="7" data-name="DRUM_06" style="text-align: center;"><?php echo $data['DRUM_06'] ?>
		</td>
		<td class="bg-danger" data-no="8" data-name="DRUM_07" style="text-align: center;"><?php echo $data['DRUM_07'] ?>
		</td>
		<td class="bg-danger" data-no="9" data-name="DRUM_08" style="text-align: center;"><?php echo $data['DRUM_08'] ?>
		</td>
		<td class="bg-danger" data-no="10" data-name="DRUM_09" style="text-align: center;">
			<?php echo $data['DRUM_09'] ?>
		</td>
		<td class="bg-danger" data-no="11" data-name="DRUM_10" style="text-align: center;">
			<?php echo $data['DRUM_10'] ?>
		</td>
		<td class="bg-danger" data-no="12" data-name="DRUM_11" style="text-align: center;">
			<?php echo $data['DRUM_11'] ?>
		</td>
		<td class="bg-danger" data-no="13" data-name="DRUM_12" style="text-align: center;">
			<?php echo $data['DRUM_12'] ?>
		</td>
		<td class="bg-danger" data-no="14" data-name="DRUM_13" style="text-align: center;">
			<?php echo $data['DRUM_13'] ?>
		</td>
		<td class="bg-danger" data-no="15" data-name="DRUM_14" style="text-align: center;">
			<?php echo $data['DRUM_14'] ?>
		</td>
	</tr>
	<tr class="baris">
		<td data-no="1" colspan="1">2</td>
		<td class="bg-danger" data-no="15" data-name="DRUM_15" style="text-align: center;">
			<?php echo $data['DRUM_15'] ?>
		</td>
		<td class="bg-danger" data-no="16" data-name="DRUM_16" style="text-align: center;">
			<?php echo $data['DRUM_16'] ?>
		</td>
		<td class="bg-danger" data-no="17" data-name="DRUM_17" style="text-align: center;">
			<?php echo $data['DRUM_17'] ?>
		</td>
		<td class="bg-danger" data-no="18" data-name="DRUM_18" style="text-align: center;">
			<?php echo $data['DRUM_18'] ?>
		</td>
		<td class="bg-danger" data-no="19" data-name="DRUM_19" style="text-align: center;">
			<?php echo $data['DRUM_19'] ?>
		</td>
		<td class="bg-danger" data-no="20" data-name="DRUM_20" style="text-align: center;">
			<?php echo $data['DRUM_20'] ?>
		</td>
		<td class="bg-danger" data-no="21" data-name="DRUM_21" style="text-align: center;">
			<?php echo $data['DRUM_21'] ?>
		</td>
		<td class="bg-danger" data-no="22" data-name="DRUM_22" style="text-align: center;">
			<?php echo $data['DRUM_22'] ?>
		</td>
		<td class="bg-danger" data-no="23" data-name="DRUM_23" style="text-align: center;">
			<?php echo $data['DRUM_23'] ?>
		</td>
		<td class="bg-danger" data-no="24" data-name="DRUM_24" style="text-align: center;">
			<?php echo $data['DRUM_24'] ?>
		</td>
		<td class="bg-danger" data-no="25" data-name="DRUM_25" style="text-align: center;">
			<?php echo $data['DRUM_25'] ?>
		</td>
		<td class="bg-danger" data-no="26" data-name="DRUM_26" style="text-align: center;">
			<?php echo $data['DRUM_26'] ?>
		</td>
		<td class="bg-danger" data-no="27" data-name="DRUM_27" style="text-align: center;">
			<?php echo $data['DRUM_27'] ?>
		</td>
		<td class="bg-danger" data-no="28" data-name="DRUM_28" style="text-align: center;">
			<?php echo $data['DRUM_28'] ?>
		</td>

	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="1" rowspan="2">TENSION DEPAN</td>
		<td data-no="1" colspan="1">1</td>
		<td class="bg-danger" data-no="1" data-name="TENSIONDEPAN1" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN1']; ?>
		</td>
		<td class="bg-danger" data-no="2" data-name="TENSIONDEPAN2" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN2']; ?>
		</td>
		<td class="bg-danger" data-no="3" data-name="TENSIONDEPAN3" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN3']; ?>
		</td>
		<td class="bg-danger" data-no="4" data-name="TENSIONDEPAN4" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN4']; ?>
		</td>
		<td class="bg-danger" data-no="5" data-name="TENSIONDEPAN5" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN5']; ?>
		</td>
		<td class="bg-danger" data-no="6" data-name="TENSIONDEPAN6" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN6']; ?>
		</td>
		<td class="bg-danger" data-no="7" data-name="TENSIONDEPAN7" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN7']; ?>
		</td>
		<td class="bg-danger" data-no="8" data-name="TENSIONDEPAN8" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN8']; ?>
		</td>
		<td class="bg-danger" data-no="9" data-name="TENSIONDEPAN9" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN9']; ?>
		</td>
		<td class="bg-danger" data-no="10" data-name="TENSIONDEPAN10" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN10']; ?>
		</td>
		<td class="bg-danger" data-no="11" data-name="TENSIONDEPAN11" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN11']; ?>
		</td>
		<td class="bg-danger" data-no="12" data-name="TENSIONDEPAN12" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN12']; ?>
		</td>
		<td class="bg-danger" data-no="13" data-name="TENSIONDEPAN13" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN13']; ?>
		</td>
		<td class="bg-danger" data-no="14" data-name="TENSIONDEPAN14" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN14']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td data-no="1" colspan="1">2</td>
		<td class="bg-danger" data-no="1" data-name="TENSIONDEPAN15" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN15']; ?>
		</td>
		<td class="bg-danger" data-no="2" data-name="TENSIONDEPAN16" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN16']; ?>
		</td>
		<td class="bg-danger" data-no="3" data-name="TENSIONDEPAN17" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN17']; ?>
		</td>
		<td class="bg-danger" data-no="4" data-name="TENSIONDEPAN18" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN18']; ?>
		</td>
		<td class="bg-danger" data-no="5" data-name="TENSIONDEPAN19" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN19']; ?>
		</td>
		<td class="bg-danger" data-no="6" data-name="TENSIONDEPAN20" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN20']; ?>
		</td>
		<td class="bg-danger" data-no="7" data-name="TENSIONDEPAN21" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN21']; ?>
		</td>
		<td class="bg-danger" data-no="8" data-name="TENSIONDEPAN22" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN22']; ?>
		</td>
		<td class="bg-danger" data-no="9" data-name="TENSIONDEPAN23" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN23']; ?>
		</td>
		<td class="bg-danger" data-no="10" data-name="TENSIONDEPAN24" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN24']; ?>
		</td>
		<td class="bg-danger" data-no="11" data-name="TENSIONDEPAN25" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN25']; ?>
		</td>
		<td class="bg-danger" data-no="12" data-name="TENSIONDEPAN26" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN26']; ?>
		</td>
		<td class="bg-danger" data-no="13" data-name="TENSIONDEPAN27" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN27']; ?>
		</td>
		<td class="bg-danger" data-no="14" data-name="TENSIONDEPAN28" style="text-align: center;">
			<?php echo $data['TENSIONDEPAN28']; ?>
		</td>

	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="1" rowspan="2">TENSION BELAKANG</td>
		<td data-no="1" colspan="1">1</td>
		<td class="bg-danger" data-no="1" data-name="TENSIONBELAKANG1" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG1']; ?>
		</td>
		<td class="bg-danger" data-no="2" data-name="TENSIONBELAKANG2" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG2']; ?>
		</td>
		<td class="bg-danger" data-no="3" data-name="TENSIONBELAKANG3" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG3']; ?>
		</td>
		<td class="bg-danger" data-no="4" data-name="TENSIONBELAKANG4" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG4']; ?>
		</td>
		<td class="bg-danger" data-no="5" data-name="TENSIONBELAKANG5" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG5']; ?>
		</td>
		<td class="bg-danger" data-no="6" data-name="TENSIONBELAKANG6" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG6']; ?>
		</td>
		<td class="bg-danger" data-no="7" data-name="TENSIONBELAKANG7" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG7']; ?>
		</td>
		<td class="bg-danger" data-no="8" data-name="TENSIONBELAKANG8" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG8']; ?>
		</td>
		<td class="bg-danger" data-no="9" data-name="TENSIONBELAKANG9" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG9']; ?>
		</td>
		<td class="bg-danger" data-no="10" data-name="TENSIONBELAKANG10" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG10']; ?>
		</td>
		<td class="bg-danger" data-no="11" data-name="TENSIONBELAKANG11" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG11']; ?>
		</td>
		<td class="bg-danger" data-no="12" data-name="TENSIONBELAKANG12" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG12']; ?>
		</td>
		<td class="bg-danger" data-no="13" data-name="TENSIONBELAKANG13" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG13']; ?>
		</td>
		<td class="bg-danger" data-no="14" data-name="TENSIONBELAKANG14" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG14']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td data-no="1" colspan="1">2</td>
		<td class="bg-danger" data-no="15" data-name="TENSIONBELAKANG15" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG15']; ?>
		</td>
		<td class="bg-danger" data-no="16" data-name="TENSIONBELAKANG16" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG16']; ?>
		</td>
		<td class="bg-danger" data-no="17" data-name="TENSIONBELAKANG17" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG17']; ?>
		</td>
		<td class="bg-danger" data-no="18" data-name="TENSIONBELAKANG18" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG18']; ?>
		</td>
		<td class="bg-danger" data-no="19" data-name="TENSIONBELAKANG19" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG19']; ?>
		</td>
		<td class="bg-danger" data-no="20" data-name="TENSIONBELAKANG20" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG20']; ?>
		</td>
		<td class="bg-danger" data-no="21" data-name="TENSIONBELAKANG21" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG21']; ?>
		</td>
		<td class="bg-danger" data-no="22" data-name="TENSIONBELAKANG22" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG22']; ?>
		</td>
		<td class="bg-danger" data-no="23" data-name="TENSIONBELAKANG23" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG23']; ?>
		</td>
		<td class="bg-danger" data-no="24" data-name="TENSIONBELAKANG24" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG24']; ?>
		</td>
		<td class="bg-danger" data-no="25" data-name="TENSIONBELAKANG25" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG25']; ?>
		</td>
		<td class="bg-danger" data-no="26" data-name="TENSIONBELAKANG26" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG26']; ?>
		</td>
		<td class="bg-danger" data-no="27" data-name="TENSIONBELAKANG27" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG27']; ?>
		</td>
		<td class="bg-danger" data-no="28" data-name="TENSIONBELAKANG28" style="text-align: center;">
			<?php echo $data['TENSIONBELAKANG28']; ?>
		</td>

	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="1" rowspan="2">TENSION KELUAR</td>
		<td data-no="1" colspan="1">1</td>
		<td class="bg-danger" data-no="1" data-name="TENSIONKELUAR1" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR1']; ?>
		</td>
		<td class="bg-danger" data-no="2" data-name="TENSIONKELUAR2" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR2']; ?>
		</td>
		<td class="bg-danger" data-no="3" data-name="TENSIONKELUAR3" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR3']; ?>
		</td>
		<td class="bg-danger" data-no="4" data-name="TENSIONKELUAR4" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR4']; ?>
		</td>
		<td class="bg-danger" data-no="5" data-name="TENSIONKELUAR5" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR5']; ?>
		</td>
		<td class="bg-danger" data-no="6" data-name="TENSIONKELUAR6" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR6']; ?>
		</td>
		<td class="bg-danger" data-no="7" data-name="TENSIONKELUAR7" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR7']; ?>
		</td>
		<td class="bg-danger" data-no="8" data-name="TENSIONKELUAR8" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR8']; ?>
		</td>
		<td class="bg-danger" data-no="9" data-name="TENSIONKELUAR9" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR9']; ?>
		</td>
		<td class="bg-danger" data-no="10" data-name="TENSIONKELUAR10" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR10']; ?>
		</td>
		<td class="bg-danger" data-no="11" data-name="TENSIONKELUAR11" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR11']; ?>
		</td>
		<td class="bg-danger" data-no="12" data-name="TENSIONKELUAR12" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR12']; ?>
		</td>
		<td class="bg-danger" data-no="13" data-name="TENSIONKELUAR13" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR13']; ?>
		</td>
		<td class="bg-danger" data-no="14" data-name="TENSIONKELUAR14" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR14']; ?>
		</td>
	</tr>

	<tr class="baris">
		<td data-no="1" colspan="1">2</td>
		<td class="bg-danger" data-no="1" data-name="TENSIONKELUAR15" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR15']; ?>
		</td>
		<td class="bg-danger" data-no="2" data-name="TENSIONKELUAR16" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR16']; ?>
		</td>
		<td class="bg-danger" data-no="3" data-name="TENSIONKELUAR17" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR17']; ?>
		</td>
		<td class="bg-danger" data-no="4" data-name="TENSIONKELUAR18" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR18']; ?>
		</td>
		<td class="bg-danger" data-no="5" data-name="TENSIONKELUAR19" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR19']; ?>
		</td>
		<td class="bg-danger" data-no="6" data-name="TENSIONKELUAR20" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR20']; ?>
		</td>
		<td class="bg-danger" data-no="7" data-name="TENSIONKELUAR21" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR21']; ?>
		</td>
		<td class="bg-danger" data-no="8" data-name="TENSIONKELUAR22" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR22']; ?>
		</td>
		<td class="bg-danger" data-no="9" data-name="TENSIONKELUAR23" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR23']; ?>
		</td>
		<td class="bg-danger" data-no="10" data-name="TENSIONKELUAR24" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR24']; ?>
		</td>
		<td class="bg-danger" data-no="11" data-name="TENSIONKELUAR25" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR25']; ?>
		</td>
		<td class="bg-danger" data-no="12" data-name="TENSIONKELUAR26" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR26']; ?>
		</td>
		<td class="bg-danger" data-no="13" data-name="TENSIONKELUAR27" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR27']; ?>
		</td>
		<td class="bg-danger" data-no="14" data-name="TENSIONKELUAR28" style="text-align: center;">
			<?php echo $data['TENSIONKELUAR28']; ?>
		</td>

	</tr>
	<tr>
		<td colspan="2" style="text-align: center;font-size: 15px; font-weight: bold;" data-no="1">POTONG BULU
		</td>
		<td class="bg-danger" colspan="2" data-no="2" data-name="POTONGBULU1" style="text-align: center;">
			<?php echo $data['POTONGBULU1']; ?>
		</td>
		<td class="bg-danger" colspan="2" data-no="3" data-name="POTONGBULU2" style="text-align: center;">
			<?php echo $data['POTONGBULU2']; ?>
		</td>
		<td colspan="4" style="text-align: center;font-size: 15px; font-weight: bold;">PEACHSKIN
		</td>
		<td colspan="3" class="bg-danger" style="text-align: center"data-name="PEACHSKIN_B"><?php echo $data['PEACHSKIN_B']; ?></td>
		<td colspan="3" class="bg-danger" style="text-align: center"data-name="PEACHSKIN_F"><?php echo $data['PEACHSKIN_F']; ?></td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">BAGIAN</td>
		<td style="width: 100px; text-align: center;" data-no="1" colspan="2">B</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="2">F</td>
		<td colspan="4"> BAGIAN KAIN </td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="3">B</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="3">F</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">SPEED M/MNT</td>
		<td class="bg-danger" style="width: 100px;text-align: center;" data-no="1" colspan="2" data-name="SPEEDM/MNT_B">
			<?php echo $data['SPEEDM/MNT_B']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align: center;" data-no="1" colspan="2" data-name="SPEEDM/MNT_F">
			<?php echo $data['SPEEDM/MNT_F']; ?>
		</td>
		<td colspan="4">% PILE BRUSH</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="3" data-name="%PILEBRUSH_B">
			<?php echo $data['%PILEBRUSH_B']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="3" data-name="%PILEBRUSH_F">
			<?php echo $data['%PILEBRUSH_F']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">JARAK PISAU</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="2" data-name="JARAKPISAU_B">
			<?php echo $data['JARAKPISAU_B']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="2" data-name="JARAKPISAU_F">
			<?php echo $data['JARAKPISAU_F']; ?>
		</td>
		<td colspan="4">% COUNTERPILE BRUSH</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="3"
			data-name="%COUNTERPILEBRUSH_B">
			<?php echo $data['%COUNTERPILEBRUSH_B']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="3"
			data-name="%COUNTERPILEBRUSH_F">
			<?php echo $data['%COUNTERPILEBRUSH_F']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="font-size: 15px; font-weight: bold;" data-no="1" colspan="2">
			SISIR</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="2">B</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="2">F</td>
		<td colspan="4">SIKAT BELAKANG</td>
		<td class="bg-danger" style="width: 100px;text-align: center;" data-no="1" colspan="3"
			data-name="SIKATBELAKANG_B">
			<?php echo $data['SIKATBELAKANG_B']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align: center;" data-no="1" colspan="3"
			data-name="SIKATBELAKANG_F">
			<?php echo $data['SIKATBELAKANG_F']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">SPEED MESIN</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="2" data-name="SPEEDMESIN_B">
			<?php echo $data['SPEEDMESIN_B']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="2" data-name="SPEEDMESIN_F">
			<?php echo $data['SPEEDMESIN_F']; ?>
		</td>
		<td colspan="4">TENSION MASUK</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="3" data-name="TENSIONMASUK_B">
			<?php echo $data['TENSIONMASUK_B']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="3" data-name="TENSIONMASUK_F">
			<?php echo $data['TENSIONMASUK_F']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">SPEED JARUM</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="2" data-name="SPEEDJARUM_B">
			<?php echo $data['SPEEDJARUM_B']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="2" data-name="SPEEDJARUM_F">
			<?php echo $data['SPEEDJARUM_F']; ?>
		</td>
		<td colspan="4">TENSION TENGAH</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="3"
			data-name="TENSIONTENGAH_B">
			<?php echo $data['TENSIONTENGAH_B']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="3"
			data-name="TENSIONTENGAH_F">
			<?php echo $data['TENSIONTENGAH_F']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">SPEED DRUM</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="2" data-name="SPEEDDRUM_B">
			<?php echo $data['SPEEDDRUM_B']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="2" data-name="SPEEDDRUM_F">
			<?php echo $data['SPEEDDRUM_F']; ?>
		</td>
		<td colspan="4">SPEED KAIN</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="3" data-name="SPEEDKAIN_B">
			<?php echo $data['SPEEDKAIN_B']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="3" data-name="SPEEDKAIN_F">
			<?php echo $data['SPEEDKAIN_F']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">SPEED TARIKAN KAIN</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="2"
			data-name="SPEEDTARIKANKAIN_B">
			<?php echo $data['SPEEDTARIKANKAIN_B']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="2"
			data-name="SPEEDTARIKANKAIN_F">
			<?php echo $data['SPEEDTARIKANKAIN_F']; ?>
		</td>
		<td colspan="4">SPEED DRUM</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="3"
			data-name="PEACHSKINSPEEDDRUM_B">
			<?php echo $data['PEACHSKINSPEEDDRUM_B']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="3"
			data-name="PEACHSKINSPEEDDRUM_F">
			<?php echo $data['PEACHSKINSPEEDDRUM_F']; ?>
		</td>
	</tr>

	<tr class="baris">
		<td style="font-size: 15px; font-weight: bold;" data-no="1" colspan="2">ANTI PILLING</td>
		<td class="bg-danger" data-no="1" colspan="4" data-name="ANTIPILLING" style="text-align:center">
			<?php echo $data['ANTIPILLING']; ?>
		</td>
		<td data-no="1" colspan="3" rowspan="2">TENSION BELAKANG</td>
		<td data-no="1" colspan="1" style="width: 10px;">1</td>
		<td class="bg-danger" data-no="1" colspan="3" data-name="TENSIONBELAKANG_B" style="text-align:center">
			<?php echo $data['TENSIONBELAKANG_B']; ?>
		</td>
		<td class="bg-danger" data-no="1" colspan="3" data-name="TENSIONBELAKANG_F" style="text-align:center">
			<?php echo $data['TENSIONBELAKANG_F']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">MIST PRAY</td>
		<td class="bg-danger" data-no="1" colspan="4" data-name="MISTPRAY" style="text-align:center">
			<?php echo $data['MISTPRAY']; ?>
		</td>
		<td data-no="1" colspan="1" style="width: 10px;">2</td>
		<td class="bg-danger" data-no="1" colspan="3" data-name="TENSIONBELAKANG2_B" style="text-align:center">
			<?php echo $data['TENSIONBELAKANG2_B']; ?>
		</td>
		<td class="bg-danger" data-no="1" colspan="3" data-name="TENSIONBELAKANG2_F" style="text-align:center">
			<?php echo $data['TENSIONBELAKANG2_F']; ?>
		</td>
	</tr>

	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">STEAM</td>
		<td class="bg-danger" data-no="2" colspan="4" data-name="STEAM" style="text-align:center">
			<?php echo $data['STEAM']; ?>
		</td>
		<td data-no="3" colspan="10" style="font-size: 15px; font-weight: bold;text-align:center;">
			POLISHING</td>

	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">OVEN</td>
		<td style="width: 100px;text-align:center" class="bg-danger" data-no="1" colspan="4" data-name="OVEN">
			<?php echo $data['OVEN']; ?>
		</td>
		<td colspan="4" style="text-align: left;">BAGIAN KAIN</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="3">B</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="3">F</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">PENDINGIN</td>
		<td colspan="4" class="bg-danger" data-name="PENDINGIN" style="width: 100px;text-align: center;">
			<?php echo $data['PENDINGIN']; ?>
		</td>
		<td colspan="4" style="text-align: left;">SUHU FRONT ROLLER</td>
		<td colspan="3" class="bg-danger" data-name="SUHUFRONTROLLER_B" style="text-align:center">
			<?php echo $data['SUHUFRONTROLLER_B']; ?>
		</td>
		<td colspan="3" class="bg-danger" data-name="SUHUFRONTROLLER_F" style="text-align:center">
			<?php echo $data['SUHUFRONTROLLER_F']; ?>
		</td>

	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">SUHU</td>
		<td colspan="4" class="bg-danger" style="text-align: center;" data-name="SUHU">
			<?php echo $data['SUHU']; ?>
		</td>
		<td colspan="4" style="text-align: left;">SUHU BACK ROLLER</td>
		<td colspan="3" class="bg-danger" data-name="SUHUBACKROLLER_B" style="text-align: center;">
			<?php echo $data['SUHUBACKROLLER_B']; ?>
		</td>
		<td colspan="3" class="bg-danger" data-name="SUHUBACKROLLER_F" style="text-align: center;">
			<?php echo $data['SUHUBACKROLLER_F']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="font-size: 15px; font-weight: bold;" data-no="1" colspan="2">WET SUEDING</td>
		<td colspan="4" class="bg-danger" data-name="WETSUEDING" style="text-align: center;">
			<?php echo $data['WETSUEDING']; ?>
		</td>
		<td colspan="4" style="text-align: left;">SPEED BACK ROLLER</td>
		<td colspan="3" class="bg-danger" data-name="SPEEDBACKROLLER_B" style="text-align: center;">
			<?php echo $data['SPEEDBACKROLLER_B']; ?>
		</td>
		<td colspan="3" class="bg-danger" data-name="SPEEDBACKROLLER_F" style="text-align: center;">
			<?php echo $data['SPEEDBACKROLLER_F']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">BAGIAN</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="2">B</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="2">F</td>
		<td colspan="4" style="text-align: left;">GAP 1</td>
		<td class="bg-danger" style="width: 100px;text-align:center" data-no="1" colspan="3" data-name="GAP_01">
			<?php echo $data['GAP_01']; ?>
		</td>
		<td class="bg-danger" style="width: 100px;text-align: center;" data-no="1" colspan="3" data-name="GAP_02">
			<?php echo $data['GAP_02']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 1</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="2" class="bg-danger"
			data-name="SUEDEROLLER1_B">
			<?php echo $data['SUEDEROLLER1_B']; ?>
		</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="2" class="bg-danger"
			data-name="SUEDEROLLER1_F">
			<?php echo $data['SUEDEROLLER1_F']; ?>
		</td>
		<td colspan="4" style="text-align: left;">GAP 2</td>
		<td colspan="3" class="bg-danger" data-name="GAP_03" style="text-align: center;"><?php echo $data['GAP_03']; ?>
		</td>
		<td colspan="3" class="bg-danger" data-name="GAP_04" style="text-align: center;"><?php echo $data['GAP_04']; ?></td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 2</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="2" class="bg-danger"
			data-name="SUEDEROLLER2_B">
			<?php echo $data['SUEDEROLLER2_B']; ?>
		</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="2" class="bg-danger"
			data-name="SUEDEROLLER2_F">
			<?php echo $data['SUEDEROLLER2_F']; ?>
		</td>
		<td colspan="4" style="text-align: left;">TENSION 1</td>
		<td colspan="3" class="bg-danger" data-name="TENSION1_B" style="text-align: center;">
			<?php echo $data['TENSION1_B']; ?>
		</td>
		<td colspan="3" class="bg-danger" data-name="TENSION1_F" style="text-align: center;">
			<?php echo $data['TENSION1_F']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 3</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="2" class="bg-danger"
			data-name="SUEDEROLLER3_B">
			<?php echo $data['SUEDEROLLER3_B']; ?>
		</td>
		<td style="width: 100px;text-align: center;" data-no="1" colspan="2" class="bg-danger"
			data-name="SUEDEROLLER3_F">
			<?php echo $data['SUEDEROLLER3_F']; ?>
		</td>
		<td colspan="4" style="text-align: left;">TENSION 2</td>
		<td colspan="3" class="bg-danger" data-name="TENSION2_B" style="text-align: center;">
			<?php echo $data['TENSION2_B']; ?>
		</td>
		<td colspan="3" class="bg-danger" data-name="TENSION2_F" style="text-align: center;">
			<?php echo $data['TENSION2_F']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 4</td>
		<td style="width: 100px;text-align: center;" class="bg-danger" data-no="1" colspan="2"
			data-name="SUEDEROLLER4_B">
			<?php echo $data['SUEDEROLLER4_B']; ?>
		</td>
		<td style="width: 100px;text-align: center;" class="bg-danger" data-no="1" colspan="2"
			data-name="SUEDEROLLER4_F">
			<?php echo $data['SUEDEROLLER4_F']; ?>
		</td>
		<td colspan="10" rowspan="2" style="font-size: 15px; font-weight: bold;text-align: center;">
			AIRO</td>
	</tr>

	<tr class="baris">
		<td colspan="2" style="width: 180px;">SUEDE ROLLER 1 (S/B)</td>
		<td style="width: 100px;text-align: center;" class="bg-danger" data-no="1" colspan="2"
			data-name="SUEDEROLLER1(S/B)_B">
			<?php echo $data['SUEDEROLLER1(S/B)_B']; ?>
		</td>
		<td style="width: 100px;text-align: center;" class="bg-danger" data-no="1" colspan="2"
			data-name="SUEDEROLLER1(S/B)_F">
			<?php echo $data['SUEDEROLLER1(S/B)_F']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 2 (S/B)</td>
		<td colspan="2" class="bg-danger" data-name="SUEDEROLLER2(S/B)_B" style="text-align: center;">
			<?php echo $data['SUEDEROLLER2(S/B)_B']; ?>
		</td>
		<td colspan="2" class="bg-danger" data-name="SUEDEROLLER2(S/B)_F" style="text-align: center;">
			<?php echo $data['SUEDEROLLER2(S/B)_F']; ?>
		</td>
		<td colspan="4" style="text-align: left;">NO MESIN</td>
		<td colspan="6" class="bg-danger" data-name="NOMESIN" style="text-align: center;">
			<?php echo $data['NOMESIN']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 3 (S/B)</td>
		<td colspan="2" class="bg-danger" data-name="SUEDEROLLER3(S/B)_B" style="text-align: center;">
			<?php echo $data['SUEDEROLLER3(S/B)_B']; ?>
		</td>
		<td colspan="2" class="bg-danger" data-name="SUEDEROLLER3(S/B)_F" style="text-align: center;">
			<?php echo $data['SUEDEROLLER3(S/B)_F']; ?>
		</td>
		<td colspan="4" style="text-align: left;">SPEED ROLL</td>
		<td colspan="6" class="bg-danger" data-name="SPEEDROLL" style="text-align: center;">
			<?php echo $data['SPEEDROLL']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 4 (S/B)</td>
		<td colspan="2" class="bg-danger" data-name="SUEDEROLLER4(S/B)_B" style="text-align: center;">
			<?php echo $data['SUEDEROLLER4(S/B)_B']; ?>
		</td>
		<td colspan="2" class="bg-danger" data-name="SUEDEROLLER4(S/B)_F" style="text-align: center;">
			<?php echo $data['SUEDEROLLER4(S/B)_F']; ?>
		</td>
		<td colspan="4" style="text-align: left;">VENTILATOR</td>
		<td colspan="6" class="bg-danger" data-name="VENTILATOR" style="text-align: center;">
			<?php echo $data['VENTILATOR']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">TENSION POTENSIONER (N)</td>
		<td colspan="2" class="bg-danger" data-name="TENSIONPOTENSIONER(N)_B" style="text-align: center;">
			<?php echo $data['TENSIONPOTENSIONER(N)_B']; ?>
		</td>
		<td colspan="2" class="bg-danger" data-name="TENSIONPOTENSIONER(N)_F" style="text-align: center;">
			<?php echo $data['TENSIONPOTENSIONER(N)_F']; ?>
		</td>
		<td colspan="4" style="text-align: left;">SUHU OVEN</td>
		<td colspan="6" class="bg-danger" data-name="SUHUOVEN" style="text-align: center;">
			<?php echo $data['SUHUOVEN']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">TENSION FEEDING ROLLER (N)</td>
		<td colspan="2" class="bg-danger" data-name="TENSIONFEEDINGROLLER(N)_B" style="text-align: center;">
			<?php echo $data['TENSIONFEEDINGROLLER(N)_B']; ?>
		</td>
		<td colspan="2" class="bg-danger" data-name="TENSIONFEEDINGROLLER(N)_F" style="text-align: center;">
			<?php echo $data['TENSIONFEEDINGROLLER(N)_F']; ?>
		</td>
		<td colspan="4" style="text-align: left;">WAKTU OVEN</td>
		<td colspan="6" class="bg-danger" data-name="WAKTUOVEN" style="text-align: center;">
			<?php echo $data['WAKTUOVEN']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">PENETRATOR 01 (%)</td>
		<td colspan="2" class="bg-danger" data-name="PENETRATOR01(%)_B" style="text-align: center;">
			<?php echo $data['PENETRATOR01(%)_B']; ?>
		</td>
		<td colspan="2" class="bg-danger" data-name="PENETRATOR01(%)_F" style="text-align: center;">
			<?php echo $data['PENETRATOR01(%)_F']; ?>
		</td>
		<td colspan="4" style="text-align: left;">PENDINGIN</td>
		<td colspan="6" class="bg-danger" data-name="AIROPENDINGIN" style="text-align: center;">
			<?php echo $data['AIROPENDINGIN']; ?>
		</td>
	</tr>
	<tr class="baris">
		<td style="width: 180px;" data-no="1" colspan="2">PENETRATOR 02 (%)</td>
		<td colspan="2" class="bg-danger" data-name="PENETRATOR02(%)_B" style="text-align: center;">
			<?php echo $data['PENETRATOR02(%)_B']; ?>
		</td>
		<td colspan="2" class="bg-danger" data-name="PENETRATOR02(%)_F" style="text-align: center;">
			<?php echo $data['PENETRATOR02(%)_F']; ?>
		</td>
		<td colspan="4" style="text-align: left;">WAKTU PENDINGIN</td>
		<td colspan="6" class="bg-danger" data-name="WAKTUPENDINGIN" style="text-align: center;">
			<?php echo $data['WAKTUPENDINGIN']; ?>
		</td>
	</tr>

	</tbody>
</table>
<script src="../bootstrap/xeditable/js/bootstrap-editable.min.js"></script>
<script>
	$(document).ready(function () {
		$('#splb').editable({
			container: 'body',
			selector: 'td.bg-danger',
			pk: `<?php echo $data['ID'] ?>`,
			url: 'update.php',
			title: `EDIT SPLB`,
			// validate: function(value) {
			//     if ($.trim(value) == '') {
			//         return 'This field is required';
			//     }
			// },
			success: function (response, newValue) {
				if (response.kode == '404') {
					alert('Error Hubung DIT !')
				}
			}
		});
		$('#splb').editable({
			container: 'body',
			selector: 'td a.bg-danger',
			pk: `<?php echo $data['ID'] ?>`,
			url: 'update.php',
			title: `EDIT SPLB`,
			// validate: function(value) {
			//     if ($.trim(value) == '') {
			//         return 'This field is required';
			//     }
			// },
			success: function (response, newValue) {
				if (response.kode == '404') {
					alert('Error Hubung DIT !')
				}
			}
		});
	})
</script>