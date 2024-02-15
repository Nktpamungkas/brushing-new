<?php
    ini_set("error_reporting", 1);
    session_start();
    include_once("../koneksi.php");
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
		
		if($_GET['typekk'] == "KKLama"){
			// if ($idkk != "") {
			// 	date_default_timezone_set('Asia/Jakarta');
			// 	$qry = mysqli_query($con,"SELECT * FROM tbl_adm WHERE nokk='$idkk' and status='1' and ISNULL(tgl_out) ORDER BY id DESC LIMIT 1");
			// 	$rw = mysqli_fetch_array($qry);
			// 	$rc = mysqli_num_rows($qry);
			// 	$tglsvr = sqlsrv_query($conn,"select CONVERT(VARCHAR(10),GETDATE(),105) AS  tgk");
			// 	$sr = sqlsrv_fetch_array($tglsvr);

			// 	$sqlLot = sqlsrv_query($conn,"SELECT
			// 										x.*,dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight,
			// 										dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount
			// 									FROM( SELECT
			// 												so.CustomerID, so.BuyerID, 
			// 												sod.ID as SODID, sod.ProductID, sod.UnitID, sod.WeightUnitID, 
			// 												pcb.ID as PCBID,pcb.UnitID as BatchUnitID,
			// 												pcblp.DepartmentID,pcb.PCID,pcb.LotNo,pcb.ChildLevel,pcb.RootID
			// 											FROM
			// 												SalesOrders so INNER JOIN
			// 												JobOrders jo ON jo.SOID=so.ID INNER JOIN
			// 												SODetails sod ON so.ID = sod.SOID INNER JOIN
			// 												SODetailsAdditional soda ON sod.ID = soda.SODID LEFT JOIN
			// 												ProcessControlJO pcjo ON sod.ID = pcjo.SODID LEFT JOIN
			// 												ProcessControlBatches pcb ON pcjo.PCID = pcb.PCID LEFT JOIN
			// 												ProcessControlBatchesLastPosition pcblp ON pcb.ID = pcblp.PCBID LEFT JOIN
			// 												ProcessFlowProcessNo pfpn ON pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID AND pfpn.MachineType = 24 LEFT JOIN
			// 												ProcessFlowDetailsNote pfdn ON pfpn.EntryType = pfdn.EntryType AND pfpn.ID = pfdn.ParentID
			// 											WHERE pcb.DocumentNo='$idkk' AND pcb.Gross<>'0'
			// 												GROUP BY
			// 													so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
			// 													sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
			// 													soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,
			// 													pcb.ID, pcb.DocumentNo, pcb.Gross,
			// 													pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
			// 													pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
			// 												) x INNER JOIN
			// 												ProductMaster pm ON x.ProductID = pm.ID LEFT JOIN
			// 												Departments dep ON x.DepartmentID  = dep.ID LEFT JOIN
			// 												Departments pdep ON dep.RootID = pdep.ID LEFT JOIN				
			// 												Partners cust ON x.CustomerID = cust.ID LEFT JOIN
			// 												Partners buy ON x.BuyerID = buy.ID LEFT JOIN
			// 												UnitDescription udq ON x.UnitID = udq.ID LEFT JOIN
			// 												UnitDescription udw ON x.WeightUnitID = udw.ID LEFT JOIN
			// 												UnitDescription udb ON x.BatchUnitID = udb.ID
			// 											ORDER BY
			// 												x.SODID, x.PCBID ", array(), array( "Scrollable" => 'static' ));
			// 	$sLot = sqlsrv_fetch_array($sqlLot);
			// 	$cLot = sqlsrv_num_rows($sqlLot);
			// 	$child = $sLot['ChildLevel'];

			// 	if ($child > 0) {
			// 		$sqlgetparent = sqlsrv_query($conn,"select ID,LotNo from ProcessControlBatches where ID='$sLot[RootID]' and ChildLevel='0'");
			// 		$rowgp = sqlsrv_fetch_array($sqlgetparent);

			// 		//$nomLot=substr("$row2[LotNo]",0,1);
			// 		$nomLot = $rowgp['LotNo'];
			// 		$nomorLot = "$nomLot/K$sLot[ChildLevel]&nbsp;";
			// 	} else {
			// 		$nomorLot = $sLot['LotNo'];
			// 	}

			// 	$sqlLot1 = "Select count(*) as TotalLot From ProcessControlBatches where PCID='$sLot[PCID]' and RootID='0' and LotNo < '1000'";
			// 	$qryLot1 = sqlsrv_query($conn,$sqlLot1) or die('A error occured : ');
			// 	$rowLot = sqlsrv_fetch_array($qryLot1);

			// 	$sqls = sqlsrv_query($conn,"select processcontrolJO.SODID,salesorders.ponumber,processcontrol.productid,salesorders.customerid,joborders.documentno,
			// 								salesorders.buyerid,processcontrolbatches.lotno,productcode,productmaster.color,colorno,description,weight,cuttablewidth from Joborders 
			// 								left join processcontrolJO on processcontrolJO.joid = Joborders.id
			// 								left join salesorders on soid= salesorders.id
			// 								left join processcontrol on processcontrolJO.pcid = processcontrol.id
			// 								left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
			// 								left join productmaster on productmaster.id= processcontrol.productid
			// 								left join productpartner on productpartner.productid= processcontrol.productid
			// 								where processcontrolbatches.documentno='$idkk'", array(), array( "Scrollable" => 'static' ));
			// 	$ssr = sqlsrv_fetch_array($sqls);
			// 	$cek = sqlsrv_num_rows($sqls);
			// 	$lgn1 = sqlsrv_query($conn,"select partnername from partners where id='$ssr[customerid]'");
			// 	$ssr1 = sqlsrv_fetch_array($lgn1);
			// 	$lgn2 = sqlsrv_query($conn,"select partnername from partners where id='$ssr[buyerid]'");
			// 	$ssr2 = sqlsrv_fetch_array($lgn2);
			// }
		}elseif ($_GET['typekk'] == "NOW") {
			if ($idkk != "") {
				include_once("../now.php");
				$qry = mysqli_query($con,"SELECT * FROM tbl_adm WHERE nokk='$idkk' and nodemand = '$_GET[demand]' and status='1' and ISNULL(tgl_out) ORDER BY id DESC LIMIT 1");
				$rw = mysqli_fetch_array($qry);
			}
		}
	?>

	<?php
		 if (isset($_POST['ubah'])) {
            $id = $_GET['id'];
            mysqli_query($con, "UPDATE tbl_adm SET nama_mesin = '$_POST[nama_mesin]' WHERE id='$id'");
			// Refresh form
			echo "<meta http-equiv='refresh' content='0; url=?p=edit-report-schedule&id=$id&status=Data Sudah DiUbah'>";
		}
	?>
	<form id="form1" name="form1" method="post" action="">
        <?php
            $q_tbladm   = mysqli_query($con, "SELECT * FROM tbl_adm WHERE id = '$_GET[id]'");
            $row_tbladm = mysqli_fetch_assoc($q_tbladm);
        ?>
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
					<input name="nokk" type="text" id="nokk" size="17" value="<?= $row_tbladm['nokk'] ?>" disabled>
                    <input name="demand" id="demand" type="text" placeholder="Nomor Demand" value="<?= $row_tbladm['nodemand'] ?>" disabled>
				</td>
				<td width="14%">
					<h4>Group Shift</h4>
				</td>
				<td width="1%">:</td>
				<td width="45%">
					<select name="shift" id="shift" disabled>
						<option value="">Pilih</option>
						<option value="A" <?php if ($row_tbladm['shift'] == "A") { echo "selected"; } ?>>A</option>
						<option value="B" <?php if ($row_tbladm['shift'] == "B") { echo "selected"; } ?>>B</option>
						<option value="C" <?php if ($row_tbladm['shift'] == "C") { echo "selected"; } ?>>C</option>
					</select>
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>Langganan/Buyer</h4>
				</td>
				<td>:</td>
				<td>
					<input name="buyer" type="text" id="buyer" size="45" value="<?= $row_tbladm['langganan'] ?>" disabled>
				</td>
				<td><strong>Shift</strong></td>
				<td>:</td>
				<td>
                    <select name="shift2" id="shift2" disabled>
						<option value="">Pilih</option>
						<option value="Pagi" <?php if ($row_tbladm['shift1'] == "Pagi") { echo "selected";} ?>>Pagi</option>
						<option value="Siang" <?php if ($row_tbladm['shift1'] == "Siang") { echo "selected"; } ?>>Siang</option>
						<option value="Malam" <?php if ($row_tbladm['shift1'] == "Malam") { echo "selected"; } ?>>Malam</option>
					</select>
                </td>
			</tr>
			<tr>
				<td scope="row">
					<h4>No. Order</h4>
				</td>
				<td>:</td>
				<td>
					<input type="text" name="no_order" id="no_order" value="<?= $row_tbladm['no_order'] ?>" disabled>
				</td>
				<td>
					<h4>Proses</h4>
				</td>
				<td>:</td>
				<td><select name="proses" id="proses" disabled>
						<option value="">Pilih</option>
						<?php $qry1 = mysqli_query($con,"SELECT proses,jns FROM tbl_proses ORDER BY id ASC");
						while ($r = mysqli_fetch_array($qry1)) {
						?>
							<option value="<?php echo $r['proses'] . " (" . $r['jns'] . ")"; ?>" <?php if ($row_tbladm['proses'] == $r['proses'] . " (" . $r['jns'] . ")") {
																									echo "SELECTED";
																								} ?>><?php echo $r['proses'] . " (" . $r['jns'] . ")"; ?></option>
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
					<textarea name="jenis_kain" cols="35" id="jenis_kain" disabled><?= $row_tbladm['jenis_kain'] ?></textarea>
				</td>
				<td valign="top">
					<h4>Catatan</h4>
				</td>
				<td valign="top">:</td>
				<td valign="top"><textarea name="catatan" cols="35" id="catatan" disabled><?= $row_tbladm['catatan']; ?></textarea></td>
			</tr>
			<tr>
				<td scope="row"><strong>Hanger/Item</strong></td>
				<td>:</td>
				<td>
					<input type="text" name="no_item" id="no_item" value="<?= $row_tbladm['no_item']; ?>" />
				</td>
				<td width="14%"><strong>Lebar X Gramasi</strong></td>
				<td width="1%">:</td>
				<td>
					<input name="lebar" type="text" id="lebar" size="6" value="<?= $row_tbladm['lebar']; ?>" placeholder="0" disabled>
					&quot; X
					<input name="gramasi" type="text" id="gramasi" size="6" value="<?= $row_tbladm['gramasi']; ?>" placeholder="0" disabled>
				</td>
			</tr>
			<tr>
				<td scope="row"><strong>No Warna</strong></td>
				<td>:</td>
				<td>
					<input name="no_warna" type="text" id="no_warna" size="35" value="<?= $row_tbladm['no_warna']; ?>" disabled>
				</td>
				<td width="14%"><strong>Berat</strong></td>
				<td width="1%">:</td>
				<td>
					<input name="qty" type="text" id="qty" size="8" value="<?= $row_tbladm['qty']; ?>" placeholder="0.00" disabled>
					<strong>Kg</strong>
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>Warna</h4>
				</td>
				<td>:</td>
				<td>
					<input name="warna" type="text" id="warna" size="35" value="<?= $row_tbladm['warna']; ?>" disabled>
				</td>
				<td><strong>Panjang</strong></td>
				<td>:</td>
				<td>
                    <input name="qty2" type="text" id="qty2" size="8" value="<?= $row_tbladm['panjang']; ?>" placeholder="0.00" disabled>
					<strong>Yard</strong>
				</td>
			</tr>
			<tr>
				<td scope="row">
					<h4>Lot</h4>
				</td>
				<td>:</td>
				<td><input name="lot" type="text" id="lot" size="7" value="<?= $row_tbladm['lot']; ?>" disabled></td>
				<td>
					<h4>Jenis Kartu Kerja</h4>
				</td>
				<td>:</td>
				<td>
                    <select name="kondisi" id="kondisi" disabled>
						<option value="">Pilih</option>
						<?php $qry1 = mysqli_query($con,"SELECT jenis FROM tbl_jenis_kartu ORDER BY id ASC");
						while ($r = mysqli_fetch_array($qry1)) {
						?>
							<option value="<?php echo $r['jenis']; ?>" <?php if ($row_tbladm['kondisi_kain'] == $r['jenis']) {
																			echo "selected";
																		} ?>><?php echo $r['jenis']; ?></option>
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
				<td><input name="rol" type="text" id="rol" size="3" placeholder="0" pattern="[0-9]{1,}" value="<?= $row_tbladm['rol']; ?>" /></td>
				<td><strong>Jam / Tgl Masuk</strong></td>
				<td>:</td>
				<td>
					<input name="proses_in" type="text" value="<?= $row_tbladm['tgl_in']; ?>" size="20" maxlength="5" disabled>
				</td>
			</tr>
            <tr>
                <td scope="row">Nama Mesin</td>
                <td>:</td>
                <td>
                    <select name="nama_mesin">
                        <option value="" selected disabled>Pilih Nama Mesin</option>
                        <?php
                            $q_namamesin    = mysqli_query($con, "SELECT * FROM tbl_namamesin ORDER BY id ASC");
                        ?>
                        <?php while($row_namamesin  = mysqli_fetch_array($q_namamesin)) : ?>
                            <option value="<?= $row_namamesin['id'] ?>" <?php if($row_tbladm['nama_mesin'] == $row_namamesin['id']){ echo "SELECTED"; } ?>>
                                <?= $row_namamesin['nama_mesin']; ?> - <?= $row_namamesin['no_mesin']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </td>
            </tr>
			<tr>
				<td colspan="6" scope="row"><input type="submit" name="ubah" value="Ubah" class="art-button">
					<input type="button" name="batal" id="batal" value="Batal" onclick="window.location.href='index.php'" class="art-button" />
					<input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='../index.php'" class="art-button" />
				</td>
			</tr>
		</table>
	</form>
</body>

</html>