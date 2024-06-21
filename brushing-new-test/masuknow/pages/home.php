<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
// include("../../koneksi.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Home</title>
	<script>
		function roundToTwo(num) {
			return +(Math.round(num + "e+2") + "e-2");
		}
		function jumlah() {
			var lebar = document.forms['form1']['lebar'].value;
			var berat = document.forms['form1']['gramasi'].value;
			var netto = document.forms['form1']['qty'].value;
			var x, yard;
			x = ((parseInt(lebar)) * parseInt(berat)) / 43.056;
			x1 = (1000 / x);
			yard = x1 * parseFloat(netto);
			document.form1.qty2.value = roundToTwo(yard).toFixed(2);

		}
	</script>
</head>

<body>
	<?php
		function nourut()
		{
			include("../koneksi.php");
			$format = date("ymd");
			$sql = mysqli_query($con,"SELECT nokk FROM tbl_adm WHERE substr(nokk,1,6) like '%" . $format . "%' ORDER BY nokk DESC LIMIT 1 ") or die(mysqli_error());
			$d = mysqli_num_rows($sql);
			if ($d > 0) {
				$r = mysqli_fetch_array($sql);
				$d = $r['nokk'];
				$str = substr($d, 6, 2);
				$Urut = (int)$str;
			} else {
				$Urut = 0;
			}
			$Urut = $Urut + 1;
			$Nol = "";
			$nilai = 2 - strlen($Urut);
			for ($i = 1; $i <= $nilai; $i++) {
				$Nol = $Nol . "0";
			}
			$nipbr = $format . $Nol . $Urut;
			return $nipbr;
		}
		$nou = nourut();
		if ($_REQUEST['kk'] != '') {
			$idkk = "";
		} else {
			$idkk = $_GET['idkk'];
		}

		if ($idkk != "") {
			date_default_timezone_set('Asia/Jakarta');
			$qrykk = db2_exec($conn_db2,"SELECT
											i.DEAMAND,i.BONORDER,ip.LANGGANAN,ip.BUYER,
											round(ir.USERPRIMARYQUANTITY) AS berat,
											round(in2.USERSECONDARYQUANTITY) AS panjang_yd,
											i.SUBCODE01,i.SUBCODE02,i.SUBCODE03,i.SUBCODE04,i.SUBCODE05,i.SUBCODE06,i.SUBCODE07,i.SUBCODE08,
											TRIM(i.SUBCODE01) || ' - ' || TRIM(i.SUBCODE02) || ' / ' || TRIM(i.ITEMDESCRIPTION)  || ' | ' || TRIM(i.SUBCODE03) || ' / ' ||TRIM(i.SUBCODE04) || ' / ' ||TRIM(i.SUBCODE05) || ' / ' ||
											TRIM(i.SUBCODE06) || ' / ' || TRIM(i.SUBCODE07) || ' / ' || TRIM(i.SUBCODE08) AS JENIS_KAIN,
											CASE
												-- WARNA DARI PRINTING 
												WHEN trim(i.ITEMTYPEAFICODE) = 'KFF' AND NOT trim(i.SUBCODE07) = '-' AND NOT trim(i.SUBCODE08) = '-' THEN DESIGNCOMPONENT.VARIANTCODE
												-- WARNA DARI BON RESEP 
												WHEN trim(i.ITEMTYPEAFICODE) = 'KFF' AND trim(i.SUBCODE07) = '-' AND trim(i.SUBCODE08) = '-' THEN TRIM(i.SUBCODE03) || '/' || TRIM(i.SUBCODE05)
												-- WARNA DARI FLAT KNIT
												WHEN trim(i.ITEMTYPEAFICODE) <> 'KFF' AND trim(i.SUBCODE07) IS NULL AND trim(i.SUBCODE08) IS NULL THEN USERGENERICGROUP.CODE
												ELSE '-'
											END AS NO_WARNA,
											CASE
												-- WARNA DARI PRINTING 
												WHEN trim(i.ITEMTYPEAFICODE) = 'KFF' AND NOT trim(i.SUBCODE07) = '-' AND NOT trim(i.SUBCODE08) = '-' THEN DESIGNCOMPONENT.SHORTDESCRIPTION
												-- WARNA DARI BON RESEP 
												WHEN trim(i.ITEMTYPEAFICODE) = 'KFF' AND trim(i.SUBCODE07) = '-' AND trim(i.SUBCODE08) = '-' THEN ITXVIEW_INV_RESEPCOLOR.LONGDESCRIPTION
												-- WARNA DARI FLAT KNIT
												WHEN trim(i.ITEMTYPEAFICODE) <> 'KFF' AND trim(i.SUBCODE07) IS NULL AND trim(i.SUBCODE08) IS NULL THEN USERGENERICGROUP.LONGDESCRIPTION
												ELSE '-'
											END AS WARNA,
											CASE
												WHEN i2.LONGDESCRIPTION IS NULL THEN TRIM(i.SUBCODE02) || '' || TRIM(i.SUBCODE03)
												ELSE i2.LONGDESCRIPTION
											END AS NO_HANGER
										FROM
											ITXVIEWKK i 
										LEFT JOIN ITXVIEW_PELANGGAN ip ON ip.CODE = i.BONORDER
										LEFT JOIN ITXVIEW_RESERVATION ir ON ir.ORDERCODE = i.DEAMAND 
										LEFT JOIN ITXVIEW_NETTO in2 ON in2.CODE = i.DEAMAND AND in2.SALESORDERLINESALESORDERCODE = i.BONORDER
										LEFT JOIN DESIGN DESIGN ON DESIGN.SUBCODE01 = i.SUBCODE07
										LEFT JOIN DESIGNCOMPONENT DESIGNCOMPONENT ON DESIGNCOMPONENT.VARIANTCODE = i.SUBCODE08 AND DESIGNCOMPONENT.DESIGNNUMBERID = DESIGN.NUMBERID
										LEFT JOIN ITXVIEW_INV_RESEPCOLOR ITXVIEW_INV_RESEPCOLOR ON ITXVIEW_INV_RESEPCOLOR.ARTIKEL = i.SUBCODE03 AND ITXVIEW_INV_RESEPCOLOR.NO_WARNA = i.SUBCODE05
										LEFT JOIN USERGENERICGROUP USERGENERICGROUP ON i.SUBCODE05 = USERGENERICGROUP.CODE 
										LEFT JOIN ITXVIEWORDERITEMLINKACTIVE i2 ON i2.ORDPRNCUSTOMERSUPPLIERCODE = i.ORDPRNCUSTOMERSUPPLIERCODE AND i2.ITEMTYPEAFICODE 
																			AND i2.SUBCODE01 = i.SUBCODE01 AND i2.SUBCODE01 = i.SUBCODE02 
																			AND i2.SUBCODE01 = i.SUBCODE03 AND i2.SUBCODE01 = i.SUBCODE04 
																			AND i2.SUBCODE01 = i.SUBCODE05 AND i2.SUBCODE01 = i.SUBCODE06 
																			AND i2.SUBCODE01 = i.SUBCODE07 AND i2.SUBCODE01 = i.SUBCODE08 
																			AND i2.SUBCODE01 = i.SUBCODE09 AND i2.SUBCODE01 = i.SUBCODE10
										WHERE
											i.PRODUCTIONORDERCODE LIKE '%$idkk%' 
										GROUP BY
											i.DEAMAND,i.BONORDER,i.ITEMDESCRIPTION,i.SUBCODE01,i.SUBCODE02,i.SUBCODE03,i.SUBCODE04,i.SUBCODE05,i.SUBCODE06,i.SUBCODE07,i.SUBCODE08,ip.LANGGANAN,ip.BUYER,ir.USERPRIMARYQUANTITY,in2.USERSECONDARYQUANTITY,USERGENERICGROUP.LONGDESCRIPTION,DESIGNCOMPONENT.SHORTDESCRIPTION,ITXVIEW_INV_RESEPCOLOR.LONGDESCRIPTION,i.ITEMTYPEAFICODE,USERGENERICGROUP.CODE,DESIGNCOMPONENT.VARIANTCODE,i2.LONGDESCRIPTION");
			$rw_kk = db2_fetch_assoc($qrykk);

			$s1 = $rw_kk['SUBCODE01']; $s2 = $rw_kk['SUBCODE02']; $s3 = $rw_kk['SUBCODE03']; $s4 = $rw_kk['SUBCODE04'];
			$s5 = $rw_kk['SUBCODE05']; $s6 = $rw_kk['SUBCODE06']; $s7 = $rw_kk['SUBCODE07']; $s8 = $rw_kk['SUBCODE08'];
			$qry_lebar = db2_exec($conn_db2,"SELECT ADSTORAGE.NAMENAME,ADSTORAGE.VALUEDECIMAL AS LEBAR,PRODUCT.SUBCODE01,
													PRODUCT.SUBCODE02,PRODUCT.SUBCODE03,PRODUCT.SUBCODE04,PRODUCT.SUBCODE05,
													PRODUCT.SUBCODE06,PRODUCT.SUBCODE07,PRODUCT.SUBCODE08 
											FROM DB2ADMIN.ADSTORAGE ADSTORAGE 
											RIGHT OUTER JOIN DB2ADMIN.PRODUCT PRODUCT ON ADSTORAGE.UNIQUEID=PRODUCT.ABSUNIQUEID
											WHERE ADSTORAGE.NAMENAME = 'Width'
											AND PRODUCT.SUBCODE01 = '$s1'
											AND	PRODUCT.SUBCODE02 = '$s2'
											AND	PRODUCT.SUBCODE03 = '$s3'
											AND	PRODUCT.SUBCODE04 = '$s4'
											AND	PRODUCT.SUBCODE05 = '$s5'
											AND	PRODUCT.SUBCODE06 = '$s6'
											AND	PRODUCT.SUBCODE07 = '$s7'
											AND	PRODUCT.SUBCODE08 = '$s8'");
			$rw_lebar = db2_fetch_assoc($qry_lebar);

			$qry_gramasi = db2_exec($conn_db2,"SELECT ADSTORAGE.NAMENAME,ADSTORAGE.VALUEDECIMAL AS GRAMASI,PRODUCT.SUBCODE01,
													PRODUCT.SUBCODE02,PRODUCT.SUBCODE03,PRODUCT.SUBCODE04,PRODUCT.SUBCODE05,
													PRODUCT.SUBCODE06,PRODUCT.SUBCODE07,PRODUCT.SUBCODE08 
											FROM DB2ADMIN.ADSTORAGE ADSTORAGE 
											RIGHT OUTER JOIN DB2ADMIN.PRODUCT PRODUCT ON ADSTORAGE.UNIQUEID=PRODUCT.ABSUNIQUEID
											WHERE ADSTORAGE.NAMENAME = 'GSM'
											AND PRODUCT.SUBCODE01 = '$s1'
											AND	PRODUCT.SUBCODE02 = '$s2'
											AND	PRODUCT.SUBCODE03 = '$s3'
											AND	PRODUCT.SUBCODE04 = '$s4'
											AND	PRODUCT.SUBCODE05 = '$s5'
											AND	PRODUCT.SUBCODE06 = '$s6'
											AND	PRODUCT.SUBCODE07 = '$s7'
											AND	PRODUCT.SUBCODE08 = '$s8'");
			$rw_gramasi = db2_fetch_assoc($qry_gramasi);

		}
	?>

	<?php
		if (isset($_POST['btnSimpan']) and $_POST['proses'] != $rw['proses']) {
			if ($_POST['nokk'] != "") {
				$nokk = $_POST['nokk'];
				$idkk = $_POST['nokk'];
			} else {
				$nokk = $nou;
				$idkk = $nou;
			}
			$shift = $_POST['shift'];
			$shift1 = $_POST['shift2'];
			$langganan = $_POST['buyer'];
			$order = $_POST['no_order'];
			$jenis_kain = str_replace("'", "''", $_POST['jenis_kain']);
			$noitem = $_POST['no_item'];
			$nowarna = $_POST['no_warna'];
			$warna = str_replace("'", "''", $_POST['warna']);
			$note = str_replace("'", "''", $_POST['catatan']);
			$lot = $_POST['lot'];
			$qty = $_POST['qty'];
			$rol = $_POST['rol'];
			$yard = $_POST['qty2'];
			$lebar = $_POST['lebar'];
			$gramasi = $_POST['gramasi'];
			$proses = $_POST['proses'];
			$kondisi = $_POST['kondisi'];
			$tglin = $_POST['tgl_proses_m'] . " " . $_POST['proses_in'];
			$simpanSql = "INSERT INTO tbl_adm SET 
										`nokk`			='$nokk',
										`shift`			='$shift',
										`shift1`		='$shift1',
										`langganan`		='$langganan',
										`no_order`		='$order',
										`jenis_kain`	='$jenis_kain',
										`warna`			='$warna',
										`no_warna`		='$nowarna',
										`no_item`		='$noitem',
										`lebar`			='$lebar',
										`gramasi`		='$gramasi',
										`lot`			='$lot',
										`rol`			='$rol',
										`qty`			='$qty',
										`panjang`		='$yard',
										`proses`		='$proses',
										`catatan`		='$note',
										`kondisi_kain`	='$kondisi',
										`tgl_buat`		=now(),
										`tgl_update`	now(),
										`tgl_in`		='$tglin'
										";
			mysqli_query($con,$simpanSql) or die("Gagal Simpan" . mysqli_error());

			// Refresh form
			echo "<meta http-equiv='refresh' content='0; url=?idkk=$idkk&status=Data Sudah DiSimpan'>";
		} else if (isset($_POST['btnSimpan']) and $_POST['proses'] == $rw['proses']) {
			$shift = $_POST['shift'];
			$shift1 = $_POST['shift2'];
			$langganan = $_POST['buyer'];
			$order = $_POST['no_order'];
			$jenis_kain = str_replace("'", "''", $_POST['jenis_kain']);
			$noitem = $_POST['no_item'];
			$nowarna = $_POST['no_warna'];
			$warna = str_replace("'", "''", $_POST['warna']);
			$note = str_replace("'", "''", $_POST['catatan']);
			$lot = $_POST['lot'];
			$qty = $_POST['qty'];
			$rol = $_POST['rol'];
			$yard = $_POST['qty2'];
			$lebar = $_POST['lebar'];
			$gramasi = $_POST['gramasi'];
			$proses = $_POST['proses'];
			$kondisi = $_POST['kondisi'];
			$tglin = $_POST['tgl_proses_m'] . " " . $_POST['proses_in'];
			$simpanSql = "UPDATE tbl_adm SET
									`shift`			='$shift',
									`shift1`		='$shift1',
									`langganan`		='$langganan',
									`no_order`		='$order',
									`jenis_kain`	='$jenis_kain',
									`warna`			='$warna',
									`no_warna`		='$nowarna',
									`no_item`		='$noitem',
									`lebar`			='$lebar',
									`gramasi`		='$gramasi',
									`lot`			='$lot',
									`rol`			='$rol',
									`qty`			='$qty',
									`panjang`		='$yard',
									`proses`		='$proses',
									`catatan`		='$note',
									`kondisi_kain`	='$kondisi',
									`tgl_update`	=now(),
									`tgl_in`		='$tglin'
			WHERE `id`='$_POST[id]'";
				mysqli_query($con,$simpanSql) or die("Gagal Ubah" . mysqli_error());

				// Refresh form
				echo "<meta http-equiv='refresh' content='0; url=?idkk=$idkk&status=Data Sudah DiUbah'>";
		}
	?>
	<form id="form1" name="form1" method="post" action="">
		<table width="100%" border="0">
			<tr>
				<td colspan="6" scope="row">
					<h1>Input Data Kartu Kerja Masuk</h1>
				</td>
			</tr>
			<tr>
				<th colspan="6" scope="row">
					<font color="#FF0000"><?php echo $_GET['status']; ?></font>
				</th>
			</tr>
			<tr>
				<td width="11%" scope="row">
					<h4>Nokk</h4>
				</td>
				<td width="1%">:</td>
				<td width="28%">
					<input name="nokk" type="text" id="nokk" size="17" onchange="window.location='?idkk='+this.value" value="<?php echo $_GET['idkk']; ?>" />
					<input type="hidden" value="" name="id" />
				</td>
				<td width="14%">
					<h4>Group Shift</h4>
				</td>
				<td width="1%">:</td>
				<td width="45%">
					<select name="shift" id="shift" required>
						<option value="">Pilih</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="C">C</option>
					</select>
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>Langganan/Buyer</h4>
				</td>
				<td>:</td>
				<td><input name="buyer" type="text" id="buyer" size="45" value="<?= $rw_kk['LANGGANAN'].'/'.$rw_kk['BUYER']; ?>"></td>
				<td><strong>Shift</strong></td>
				<td>:</td>
				<td>
					<select name="shift2" id="shift2" required="required">
						<option value="">Pilih</option>
						<option value="Pagi">Pagi</option>
						<option value="Siang">Siang</option>
						<option value="Malam">Malam</option>
					</select>
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>No. Order</h4>
				</td>
				<td>:</td>
				<td>
					<input type="text" name="no_order" id="no_order" value="<?= $rw_kk['BONORDER']; ?>">
				</td>
				<td>
					<h4>Proses</h4>
				</td>
				<td>:</td>
				<td>
					<select name="proses" id="proses" required>
						<option value="">Pilih</option>
						<?php $qry1 = mysqli_query($con,"SELECT proses,jns FROM tbl_proses ORDER BY id ASC");
						while ($r = mysqli_fetch_array($qry1)) {
						?>
							<option value="<?php echo $r['proses'] . " (" . $r['jns'] . ")"; ?>"><?php echo $r['proses'] . " (" . $r['jns'] . ")"; ?></option>
						<?php } ?>
					</select>
					<input type="button" name="btnproses" id="btnproses" value="..." onclick="window.open('pages/data-proses.php','MyWindow','height=400,width=650');" />
				</td>
			</tr>
			<tr>
				<td valign="top" scope="row">
					<h4>Jenis Kain</h4>
				</td>
				<td valign="top">:</td>
				<td>
					<textarea name="jenis_kain" cols="35" id="jenis_kain"><?= $rw_kk['JENIS_KAIN']; ?></textarea>
				</td>
				<td valign="top">
					<h4>Catatan</h4>
				</td>
				<td valign="top">:</td>
				<td valign="top">
					<textarea name="catatan" cols="35" id="catatan"></textarea>
				</td>
			</tr>
			<tr>
				<td scope="row"><strong>Hanger/Item</strong></td>
				<td>:</td>
				<td>
					<input type="text" name="no_item" id="no_item" value="">
				</td>
				<td width="14%"><strong>Lebar X Gramasi</strong></td>
				<td width="1%">:</td>
				<td>
					<input name="lebar" type="text" id="lebar" size="6" value="<?= $rw_lebar['LEBAR']; ?>" placeholder="0" />
					&quot; X
					<input name="gramasi" type="text" id="gramasi" size="6" value="<?= $rw_gramasi['GRAMASI']; ?>" placeholder="0" />
				</td>
			</tr>
			<tr>
				<td scope="row"><strong>No Warna</strong></td>
				<td>:</td>
				<td>
					<input name="no_warna" type="text" id="no_warna" size="35" value="<?= $rw_kk['NO_WARNA']; ?>">
				</td>
				<td width="14%"><strong>Berat</strong></td>
				<td width="1%">:</td>
				<td>
					<input name="qty" type="text" id="qty" size="8" value="" placeholder="0.00" >
					<strong>Kg</strong>
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>Warna</h4>
				</td>
				<td>:</td>
				<td>
					<input name="warna" type="text" id="warna" size="35" value="<?= $rw_kk['WARNA']; ?>">
				</td>
				<td><strong>Panjang</strong></td>
				<td>:</td>
				<td>
					<input name="qty2" type="text" id="qty2" size="8" value="" placeholder="0.00" onFocus="jumlah();" />
					<strong>Yard</strong>
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>Lot</h4>
				</td>
				<td>:</td>
				<td>
					<input name="lot" type="text" id="lot" size="7" value="">
				</td>
				<td>
					<h4>Jenis Kartu Kerja</h4>
				</td>
				<td>:</td>
				<td>
					<select name="kondisi" id="kondisi" required="required">
						<option value="">Pilih</option>
						<?php $qry1 = mysqli_query($con,"SELECT jenis FROM tbl_jenis_kartu ORDER BY id ASC");
						while ($r = mysqli_fetch_array($qry1)) {
						?>
							<option value="<?php echo $r['jenis']; ?>"><?php echo $r['jenis']; ?></option>
						<?php } ?>
					</select>
					<input type="button" name="btnproses2" id="btnproses2" value="..." onclick="window.open('pages/data-jenis-kk.php','MyWindow','height=400,width=650');" />
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>Roll</h4>
				</td>
				<td>:</td>
				<td>
					<input name="rol" type="text" id="rol" size="3" placeholder="0" pattern="[0-9]{1,}" value="">
				</td>
				<td><strong>Jam / Tgl Masuk</strong></td>
				<td>:</td>
				<td>
					<input name="proses_in" type="text" id="proses_in" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25" 
					onkeyup="
					var time = this.value;
					if (time.match(/^\d{2}$/) !== null) {
						this.value = time + ':';
					} else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
						this.value = time + '';
					}" value="" size="5" maxlength="5" required />
					<input name="tgl_proses_m" type="text" id="tgl_proses_m" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_m);return false;" size="10" placeholder="0000-00-00" value="" required />
					<a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_m);return false;">
					<img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal2" style="border:none" align="absmiddle" border="0" /></a>
				</td>
			</tr>
			<tr>
				<td colspan="6" scope="row"><input type="submit" name="btnSimpan" id="btnSimpan" value="Simpan" class="art-button" />
					<input type="button" name="batal" id="batal" value="Batal" onclick="window.location.href='index.php'" class="art-button" />
					<input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='../index.php'" class="art-button" />
				</td>
			</tr>
		</table>
	</form>
</body>

</html>