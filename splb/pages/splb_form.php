<?php
ini_set("error_reporting", 1);
session_start();
include ("../../koneksi.php");

?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SETTING PERBEDAAN LOT BRUSHING</title>
</head>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
<style>
	.table {
		border: 0.5px solid #000000;
	}

	.table-bordered>thead>tr>th,
	.table-bordered>tbody>tr>th,
	.table-bordered>tfoot>tr>th,
	.table-bordered>thead>tr>td,
	.table-bordered>tbody>tr>td,
	.table-bordered>tfoot>tr>td {
		border: 0.5px solid #000000;
		vertical-align: middle;
	}

	textarea.form-control,
	input.form-control {
		border: 0px;
	}

	select.input-xs,
	textarea.input-xs,
	input.input-xs {
		height: 23px;
		padding: 2px 5px;
		font-size: 12px;
		line-height: 1.5;
		border-radius: 3px;
		text-align: center;
	}
</style>
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
	function getData_ITXVIEWKK() {
		var _noprodorder = document.getElementById("NO_KARTU_KERJA").value;

		$.get("../api_ITXVIEWKK.php?noprod=" + _noprodorder, function (item) {
			document.getElementById("LANGGANAN").value = item.PELANGGAN + '/' + item.BUYER;
			document.getElementById("ORDER").value = item.PROJECTCODE;
			document.getElementById("JENIS_KAIN").value = item.ITEMDESCRIPTION;
			document.getElementById("L_PERMINTAAN").value = item.LEBAR;
			document.getElementById("G_PERMINTAAN").value = item.GRAMASI;
			document.getElementById("NO_HANGER").value = item.NO_HANGER;
			document.getElementById("WARNA").value = item.WARNA;
			document.getElementById("DEAMAND").value = item.DEAMAND;
		});
	};
</script>

<?php
if ($_POST['kk'] == '') {
	$idkk = "";
} else {
	$idkk = $_POST['kk'];
}

$query = mysqli_query($con, "SELECT * from tbl_splb where `NO_KARTU_KERJA` = $_POST[kk]");
$count = mysqli_num_rows($query);
if ($count > 0) {
	echo "<script>alert('KK yang anda input sudah exist !'); window.history.go(-1)</script>";
}

if ($idkk != "") {
	date_default_timezone_set('Asia/Jakarta');
	$qry = mysqli_query($con, "SELECT * FROM tbl_adm WHERE nokk='$idkk' and status='1' and ISNULL(tgl_out) ORDER BY id DESC LIMIT 1");
	$rw = mysqli_fetch_array($qry);
	$rc = mysqli_num_rows($qry);
	// $tglsvr = sqlsrv_query($conn, "select CONVERT(VARCHAR(10),GETDATE(),105) AS  tgk", array(), array("Scrollable" => 'static'));
	// $sr = sqlsrv_fetch_array($tglsvr);

	// $sqlLot = sqlsrv_query($conn, " SELECT
	//     x.*,dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight,
	//     dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount
	//     FROM( SELECT
	//       so.CustomerID, so.BuyerID, 
	//       sod.ID as SODID, sod.ProductID, sod.UnitID, sod.WeightUnitID, 
	//       pcb.ID as PCBID,pcb.UnitID as BatchUnitID,
	//       pcblp.DepartmentID,pcb.PCID,pcb.LotNo,pcb.ChildLevel,pcb.RootID
	//     FROM
	//       SalesOrders so INNER JOIN
	//       JobOrders jo ON jo.SOID=so.ID INNER JOIN
	//       SODetails sod ON so.ID = sod.SOID INNER JOIN
	//       SODetailsAdditional soda ON sod.ID = soda.SODID LEFT JOIN
	//       ProcessControlJO pcjo ON sod.ID = pcjo.SODID LEFT JOIN
	//       ProcessControlBatches pcb ON pcjo.PCID = pcb.PCID LEFT JOIN
	//       ProcessControlBatchesLastPosition pcblp ON pcb.ID = pcblp.PCBID LEFT JOIN
	//       ProcessFlowProcessNo pfpn ON pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID AND pfpn.MachineType = 24 LEFT JOIN
	//       ProcessFlowDetailsNote pfdn ON pfpn.EntryType = pfdn.EntryType AND pfpn.ID = pfdn.ParentID
	//     WHERE pcb.DocumentNo='$idkk' AND pcb.Gross<>'0'
	//       GROUP BY
	//         so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
	//         sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
	//         soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,
	//         pcb.ID, pcb.DocumentNo, pcb.Gross,
	//         pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
	//         pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
	//       ) x INNER JOIN
	//       ProductMaster pm ON x.ProductID = pm.ID LEFT JOIN
	//       Departments dep ON x.DepartmentID  = dep.ID LEFT JOIN
	//       Departments pdep ON dep.RootID = pdep.ID LEFT JOIN				
	//       Partners cust ON x.CustomerID = cust.ID LEFT JOIN
	//       Partners buy ON x.BuyerID = buy.ID LEFT JOIN
	//       UnitDescription udq ON x.UnitID = udq.ID LEFT JOIN
	//       UnitDescription udw ON x.WeightUnitID = udw.ID LEFT JOIN
	//       UnitDescription udb ON x.BatchUnitID = udb.ID
	//     ORDER BY
	//       x.SODID, x.PCBID ", array(), array("Scrollable" => 'static'));
	// $sLot = sqlsrv_fetch_array($sqlLot);
	// $cLot = sqlsrv_num_rows($sqlLot);
	// $child = $sLot['ChildLevel'];

	// if ($child > 0) {
	//   $sqlgetparent = sqlsrv_query($conn, "select ID,LotNo from ProcessControlBatches where ID='$sLot[RootID]' and ChildLevel='0'");
	//   $rowgp = sqlsrv_fetch_array($sqlgetparent);

	//   //$nomLot=substr("$row2[LotNo]",0,1);
	//   $nomLot = $rowgp['LotNo'];
	//   $nomorLot = "$nomLot/K$sLot[ChildLevel]&nbsp;";
	// } else {
	//   $nomorLot = $sLot['LotNo'];
	// }

	// $sqlLot1 = "Select count(*) as TotalLot From ProcessControlBatches where PCID='$sLot[PCID]' and RootID='0' and LotNo < '1000'";
	// $qryLot1 = sqlsrv_query($conn, $sqlLot1) or die('A error occured : ');
	// $rowLot = sqlsrv_fetch_array($qryLot1);

	// $sqls = sqlsrv_query($conn, "select processcontrolJO.SODID,salesorders.ponumber,processcontrol.productid,salesorders.customerid,joborders.documentno,
	//     salesorders.buyerid,processcontrolbatches.lotno,productcode,productmaster.color,colorno, hangerno,description,weight,cuttablewidth from Joborders 
	//     left join processcontrolJO on processcontrolJO.joid = Joborders.id
	//     left join salesorders on soid= salesorders.id
	//     left join processcontrol on processcontrolJO.pcid = processcontrol.id
	//     left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
	//     left join productmaster on productmaster.id= processcontrol.productid
	//     left join productpartner on productpartner.productid= processcontrol.productid
	//     where processcontrolbatches.documentno='$idkk'", array(), array("Scrollable" => 'static'));
	// $ssr = sqlsrv_fetch_array($sqls);
	// $cek = sqlsrv_num_rows($sqls);
	// $lgn1 = sqlsrv_query($conn, "select partnername from partners where id='$ssr[customerid]'");
	// $ssr1 = sqlsrv_fetch_array($lgn1);
	// $lgn2 = sqlsrv_query($conn, "select partnername from partners where id='$ssr[buyerid]'");
	// $ssr2 = sqlsrv_fetch_array($lgn2);
}

?>

<body onload='getData_ITXVIEWKK()'>
	<div class="container-fluid" style="background-color: white; padding: 20px 0 20px 0;">
		<div class=" col-md-12">
			<form method="POST" action="?p=simpandata">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th colspan="16">FW-14-BRS-12/00</th>
						</tr>
						<tr>
							<th colspan="16">SETTING PERBEDAAN LOT BRUSHING</th>
						</tr>
					</thead>
					<tbody>
						<tr class="baris">
							<td style="width: 180px;" data-no="1">No. KK &
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								DEMAND</td>
							<td class="bg-warning" data-no="2" colspan="8">
								<div class="form-inline text-center">
									<input type="text" class="form-control input-xs" name="NO_KARTU_KERJA"
										id="NO_KARTU_KERJA" value="<?php echo $_POST['kk'] ?>" readonly>/</span>
									<input type="text" class="form-control input-xs" name="DEAMAND" id="DEAMAND"
										value="<?php echo $_POST['DEAMAND'] ?>" style="width: 100%" readonly>
							</td>
							<td data-no="10" colspan="7" style="text-align: center;">SPV/ASST/LDR</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1">LANGGANAN</td>
							<td class="bg-warning" data-no="2" colspan="8"><input type="text"
									class="form-control input-xs" readonly required name="LANGGANAN" id="LANGGANAN"
									value="<?php if ($cek > 0) {
										echo $ssr1['partnername'] . "/" . $ssr2['partnername'];
									} else {
										echo $rw['langganan'];
									} ?>" style="width: 100%;"></td>
							<td data-no="10" colspan="7" class="bg-warning"><input type="text"
									class="form-control input-xs" readonly name="TANGGAL_01" id="TANGGAL_01"
									value="<?php echo date('Y-m-d') ?>" style="width: 100%;"></td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1">ORDER</td>
							<td class="bg-warning" data-no="2" colspan="8"><input type="text"
									class="form-control input-xs" readonly name="ORDER" id="ORDER" value="<?php if ($cek > 0) {
										echo $ssr['documentno'];
									} else {
										echo $rw['no_order'];
									} ?>" style="width: 100%;"></td>
							<td data-no="10" colspan="7" rowspan="6"><textarea name="NOTE" id="NOTE"
									placeholder="-CATATAN-" style="height: 100%;" class="form-control"
									rows="9"></textarea></td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1">JENIS KAIN</td>
							<td class="bg-warning" data-no="2" colspan="8"><input type="text"
									class="form-control input-xs" readonly name="JENIS_KAIN" id="JENIS_KAIN" value="<?php if ($cek > 0) {
										echo $ssr['productcode'] . " / " . $ssr['description'];
									} else {
										echo $rw['jenis_kain'];
									} ?>" style="width: 100%;"></td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1">WARNA</td>
							<td class="bg-warning" data-no="2" colspan="8"><input type="text"
									class="form-control input-xs" name="WARNA" id="WARNA" readonly value="<?php if ($cek > 0) {
										echo $ssr['color'];
									} else {
										echo $rw['no_warna'];
									} ?>" style="width: 100%;"></td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1">L X G PERMINTAAN</td>
							<td class="bg-warning" data-no="2" colspan="8">
								<div class="form-inline text-center">
									<input name="L_PERMINTAAN" type="text" id="L_PERMINTAAN" readonly
										class="form-control input-xs" value="<?php if ($cek > 0) {
											echo $ssr['cuttablewidth'];
										} else {
											echo $rw['lebar'];
										} ?>" placeholder="0" /> &nbsp; X &nbsp;
									<input name="G_PERMINTAAN" type="text" id="G_PERMINTAAN" readonly
										class="form-control input-xs" value="<?php if ($cek > 0) {
											echo $ssr['weight'];
										} else {
											echo $rw['gramasi'];
										} ?>" placeholder="0" />
								</div>
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1">L X G AKTUAL</td>
							<td class="bg-warning" data-no="2" colspan="8">
								<div class="form-inline text-center">
									<input name="L_AKTUAL" type="text" id="L_AKTUAL" class="form-control input-xs"
										placeholder="LEBAR AKTUAL" /> &nbsp; X &nbsp;
									<input name="G_AKTUAL" type="text" id="G_AKTUAL" class="form-control input-xs"
										placeholder="GRAMASI AKTUAL" />
								</div>
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1">LOT</td>
							<td class="bg-warning" data-no="2" colspan="8"><input type="text"
									class="form-control input-xs" readonly name="LOT" id="LOT" value="<?php if ($cLot > 0) {
										echo $rowLot['TotalLot'] . "-" . $nomorLot;
									} else {
										echo $rw['lot'];
									} ?>" style="width: 100%;"></td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1">NO. HANGER</td>
							<td class="bg-warning" data-no="2" colspan="8"><input type="text"
									class="form-control input-xs" name="NO_HANGER" id="NO_HANGER" readonly value="<?php if ($cek > 0) {
										echo $ssr['hangerno'];
									} else {
										echo $rw['no_item'];
									} ?>" style="width: 100%;"></td>
							<td class="bg-warning" data-no="2" colspan="7" style="text-align:center;"><input type="text"
									class="form-control input-xs" name="NAMA_TTD" id="NAMA_TTD">
								<?php echo $data['NAMA_TTD'] ?>
							</td>

						</tr>
						<tr class="baris">
							<td data-no="1" colspan="9" rowspan="2"
								style="text-align: center;font-size: 15px; font-weight: bold;">
								QUALITY
							</td>
							<td colspan="6" class="bg-danger" style="text-align:center;">OK</td>
							<td data-no="10" class="bg-danger" style="text-align:center;"><input type="text"
									class="form-control input-xs" name="OK" id="OK" placeholder="-OK-"
									style="width: 100%"></td>

						</tr>
						<tr>
							<td data-no="10" colspan="6" class="bg-danger" style="text-align:center;">NOT OK</td>
							<td data-no="10" class="bg-danger" style="text-align:center;"><input type="text"
									class="form-control input-xs" name="NOT_OK" id="NOT_OK" placeholder="-NOT_OK-"
									style="width: 100%"></td>
						</tr>

						<tr>
							<td colspan="2" style="text-align: center;font-size: 15px; font-weight: bold;">GARUK</td>
							<td class="bg-danger" colspan="1"><input type="text" class="form-control input-xs"
									name="GARUK" id="GARUK" placeholder="-GARUK1-" style="width: 100%"></td>
							</td>
							<td colspan="14"></td>
						</tr>

						<tr class="baris">
							<td colspan="2"> BAGIAN KAIN</td>
							<td class="bg-danger" data-no="2"><input type="text" class="form-control input-xs"
									name="BAG_KAIN_01" id="BAG_KAIN_01" placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs"
									name="BAG_KAIN_02" id="BAG_KAIN_02" placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs"
									name="BAG_KAIN_03" id="BAG_KAIN_03" placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs"
									name="BAG_KAIN_04" id="BAG_KAIN_04" placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="6"><input type="text" class="form-control input-xs"
									name="BAG_KAIN_05" id="BAG_KAIN_05" placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs"
									name="BAG_KAIN_06" id="BAG_KAIN_06" placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="8"><input type="text" class="form-control input-xs"
									name="BAG_KAIN_07" id="BAG_KAIN_07" placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="8"><input type="text" class="form-control input-xs"
									name="BAG_KAIN_08" id="BAG_KAIN_08" placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="10">
								<input type="text" class="form-control input-xs" name="BAG_KAIN_09" id="BAG_KAIN_09"
									placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="11">
								<input type="text" class="form-control input-xs" name="BAG_KAIN_10" id="BAG_KAIN_10"
									placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="12">
								<input type="text" class="form-control input-xs" name="BAG_KAIN_11" id="BAG_KAIN_11"
									placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="13">
								<input type="text" class="form-control input-xs" name="SIKAT04_05" id="SIKAT04_05"
									placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="14">
								<input type="text" class="form-control input-xs" name="BAG_KAIN_13" id="BAG_KAIN_13"
									placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="15">
								<input type="text" class="form-control input-xs" name="BAG_KAIN_14" id="BAG_KAIN_14"
									placeholder="-BAGIKAIN-" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="1" rowspan="2">COUNTER PILE</td>
							<td data-no="1" colspan="1">1</td>
							<td class="bg-danger" data-no="1"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE1" id="COUNTER_PILE1" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="2"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE2" id="COUNTER_PILE2" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE3" id="COUNTER_PILE3" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE4" id="COUNTER_PILE4" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE5" id="COUNTER_PILE5" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="6"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE6" id="COUNTER_PILE6" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE7" id="COUNTER_PILE7" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="8"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE8" id="COUNTER_PILE8" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE9" id="COUNTER_PILE9" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="10"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE10" id="COUNTER_PILE10" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE11" id="COUNTER_PILE11" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="12"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE12" id="COUNTER_PILE12" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE13" id="COUNTER_PILE13" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="14"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE14" id="COUNTER_PILE14" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
						</tr>
						</tr>
						<tr class="baris">
							<td data-no="1" colspan="1">2</td>
							<td class="bg-danger" data-no="15"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE15" id="COUNTER_PILE15" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="16"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE16" id="COUNTER_PILE16" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="17"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE17" id="COUNTER_PILE17" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="18"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE18" id="COUNTER_PILE18" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="19"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE19" id="COUNTER_PILE19" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="20"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE20" id="COUNTER_PILE20" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="21"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE21" id="COUNTER_PILE21" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="22"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE22" id="COUNTER_PILE22" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="23"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE23" id="COUNTER_PILE23" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="24"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE24" id="COUNTER_PILE24" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="25"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE25" id="COUNTER_PILE25" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="26"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE26" id="COUNTER_PILE26" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="27"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE27" id="COUNTER_PILE27" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="28"><input type="text" class="form-control input-xs"
									name="COUNTER_PILE28" id="COUNTER_PILE28" placeholder="-COUNTER PILE-"
									style="width: 100%"></td>

						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="1" rowspan="2">PILE</td>
							<td data-no="1" colspan="1">1</td>
							<td class="bg-danger" data-no="1"><input type="text" class="form-control input-xs"
									name="PILE1" id="PILE1" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="2"><input type="text" class="form-control input-xs"
									name="PILE2" id="PILE2" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs"
									name="PILE3" id="PILE3" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs"
									name="PILE4" id="PILE4" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs"
									name="PILE5" id="PILE5" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="6"><input type="text" class="form-control input-xs"
									name="PILE6" id="PILE6" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs"
									name="PILE7" id="PILE7" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="8"><input type="text" class="form-control input-xs"
									name="PILE8" id="PILE8" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs"
									name="PILE9" id="PILE9" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="10"><input type="text" class="form-control input-xs"
									name="PILE10" id="PILE10" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs"
									name="PILE11" id="PILE11" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="12"><input type="text" class="form-control input-xs"
									name="PILE12" id="PILE12" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs"
									name="PILE13" id="PILE13" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="14"><input type="text" class="form-control input-xs"
									name="PILE14" id="PILE14" placeholder="-PILE-" style="width: 100%"></td>
						</tr>
						<tr class="baris">
							<td data-no="1" colspan="1">2</td>
							<td class="bg-danger" data-no="15"><input type="text" class="form-control input-xs"
									name="PILE15" id="PILE15" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="16"><input type="text" class="form-control input-xs"
									name="PILE16" id="PILE16" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="17"><input type="text" class="form-control input-xs"
									name="PILE17" id="PILE17" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="18"><input type="text" class="form-control input-xs"
									name="PILE18" id="PILE18" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="19"><input type="text" class="form-control input-xs"
									name="PILE19" id="PILE19" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="20"><input type="text" class="form-control input-xs"
									name="PILE20" id="PILE20" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="21"><input type="text" class="form-control input-xs"
									name="PILE21" id="PILE21" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="22"><input type="text" class="form-control input-xs"
									name="PILE22" id="PILE22" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="23"><input type="text" class="form-control input-xs"
									name="PILE23" id="PILE23" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="24"><input type="text" class="form-control input-xs"
									name="PILE24" id="PILE24" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="25"><input type="text" class="form-control input-xs"
									name="PILE25" id="PILE25" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="26"><input type="text" class="form-control input-xs"
									name="PILE26" id="PILE26" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="27"><input type="text" class="form-control input-xs"
									name="PILE27" id="PILE27" placeholder="-PILE-" style="width: 100%"></td>
							<td class="bg-danger" data-no="28"><input type="text" class="form-control input-xs"
									name="PILE28" id="PILE28" placeholder="-PILE-" style="width: 100%"></td>

						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="1" rowspan="2">DRUM</td>
							<td data-no="1" colspan="1">1</td>
							<td class="bg-danger" data-no="2"><input type="text" class="form-control input-xs"
									name="DRUM_01" id="DRUM_01" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs"
									name="DRUM_02" id="DRUM_02" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs"
									name="DRUM_03" id="DRUM_03" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs"
									name="DRUM_04" id="DRUM_04" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="6"><input type="text" class="form-control input-xs"
									name="DRUM_05" id="DRUM_05" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs"
									name="DRUM_06" id="DRUM_06" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="8"><input type="text" class="form-control input-xs"
									name="DRUM_07" id="DRUM_07" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs"
									name="DRUM_08" id="DRUM_08" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="10"><input type="text" class="form-control input-xs"
									name="DRUM_09" id="DRUM_09" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs"
									name="DRUM_10" id="DRUM_10" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="12"><input type="text" class="form-control input-xs"
									name="DRUM_11" id="DRUM_11" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs"
									name="DRUM_12" id="DRUM_12" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="14"><input type="text" class="form-control input-xs"
									name="DRUM_13" id="DRUM_13" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="15"><input type="text" class="form-control input-xs"
									name="DRUM_14" id="DRUM_14" placeholder="-DRUM-" style="width: 100%"></td>
						</tr>
						<tr class="baris">
							<td data-no="1" colspan="1">2</td>
							<td class="bg-danger" data-no="15"><input type="text" class="form-control input-xs"
									name="DRUM_15" id="DRUM_15" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="16"><input type="text" class="form-control input-xs"
									name="DRUM_16" id="DRUM_16" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="17"><input type="text" class="form-control input-xs"
									name="DRUM_17" id="DRUM_17" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="18"><input type="text" class="form-control input-xs"
									name="DRUM_18" id="DRUM_18" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="19"><input type="text" class="form-control input-xs"
									name="DRUM_19" id="DRUM_19" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="20"><input type="text" class="form-control input-xs"
									name="DRUM_20" id="DRUM_20" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="21"><input type="text" class="form-control input-xs"
									name="DRUM_21" id="DRUM_21" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="22"><input type="text" class="form-control input-xs"
									name="DRUM_22" id="DRUM_22" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="23"><input type="text" class="form-control input-xs"
									name="DRUM_23" id="DRUM_23" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="24"><input type="text" class="form-control input-xs"
									name="DRUM_24" id="DRUM_24" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="25"><input type="text" class="form-control input-xs"
									name="DRUM_25" id="DRUM_25" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="26"><input type="text" class="form-control input-xs"
									name="DRUM_26" id="DRUM_26" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="27"><input type="text" class="form-control input-xs"
									name="DRUM_27" id="DRUM_27" placeholder="-DRUM-" style="width: 100%"></td>
							<td class="bg-danger" data-no="28"><input type="text" class="form-control input-xs"
									name="DRUM_28" id="DRUM_28" placeholder="-DRUM-" style="width: 100%"></td>

						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="1" rowspan="2">TENSION DEPAN</td>
							<td data-no="1" colspan="1">1</td>
							<td class="bg-danger" data-no="1"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN1" id="TENSIONDEPAN1" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="2"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN2" id="TENSIONDEPAN2" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN3" id="TENSIONDEPAN3" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN4" id="TENSIONDEPAN4" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN5" id="TENSIONDEPAN5" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="6"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN6" id="TENSIONDEPAN6" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN7" id="TENSIONDEPAN7" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="8"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN8" id="TENSIONDEPAN8" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN9" id="TENSIONDEPAN9" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="10"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN10" id="TENSIONDEPAN10" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN11" id="TENSIONDEPAN11" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="12"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN12" id="TENSIONDEPAN12" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN13" id="TENSIONDEPAN13" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="14"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN14" id="TENSIONDEPAN14" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
						</tr>

						<tr class="baris">
							<td data-no="1" colspan="1">2</td>
							<td class="bg-danger" data-no="15"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN15" id="TENSIONDEPAN15" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="16"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN16" id="TENSIONDEPAN16" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="17"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN17" id="TENSIONDEPAN17" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="18"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN18" id="TENSIONDEPAN18" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="19"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN19" id="TENSIONDEPAN19" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="20"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN20" id="TENSIONDEPAN20" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="21"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN21" id="TENSIONDEPAN21" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="22"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN22" id="TENSIONDEPAN22" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="23"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN23" id="TENSIONDEPAN23" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="24"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN24" id="TENSIONDEPAN24" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="25"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN25" id="TENSIONDEPAN25" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="26"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN26" id="TENSIONDEPAN26" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="27"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN27" id="TENSIONDEPAN27" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="28"><input type="text" class="form-control input-xs"
									name="TENSIONDEPAN28" id="TENSIONDEPAN28" placeholder="-TENSION DEPAN-"
									style="width: 100%"></td>

						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="1" rowspan="2">TENSION BELAKANG</td>
							<td data-no="1" colspan="1">1</td>
							<td class="bg-danger" data-no="1"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG1" id="TENSIONBELAKANG1" placeholder="TENSIONBELAKANG1"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="2"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG2" id="TENSIONBELAKANG2" placeholder="TENSIONBELAKANG2"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG3" id="TENSIONBELAKANG3" placeholder="TENSIONBELAKANG3"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG4" id="TENSIONBELAKANG4" placeholder="TENSIONBELAKANG4"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG5" id="TENSIONBELAKANG5" placeholder="TENSIONBELAKANG5"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="6"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG6" id="TENSIONBELAKANG6" placeholder="TENSIONBELAKANG6"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG7" id="TENSIONBELAKANG7" placeholder="TENSIONBELAKANG7"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="8"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG8" id="TENSIONBELAKANG8" placeholder="TENSIONBELAKANG8"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG9" id="TENSIONBELAKANG9" placeholder="TENSIONBELAKANG9"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="10"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG10" id="TENSIONBELAKANG10" placeholder="TENSIONBELAKANG10"
									style="width: 100%">
							</td>
							<td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG11" id="TENSIONBELAKANG11" placeholder="TENSIONBELAKANG11"
									style="width: 100%">
							</td>
							<td class="bg-danger" data-no="12"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG12" id="TENSIONBELAKANG12" placeholder="TENSIONBELAKANG12"
									style="width: 100%">
							</td>
							<td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG13" id="TENSIONBELAKANG13" placeholder="TENSIONBELAKANG13"
									style="width: 100%">
							</td>
							<td class="bg-danger" data-no="14"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG14" id="TENSIONBELAKANG14" placeholder="TENSIONBELAKANG14"
									style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td data-no="1" colspan="1">2</td>
							<td class="bg-danger" data-no="15"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG15" id="TENSIONBELAKANG15" placeholder="TENSIONBELAKANG15"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="16"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG16" id="TENSIONBELAKANG16" placeholder="TENSIONBELAKANG16"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="17"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG17" id="TENSIONBELAKANG17" placeholder="TENSIONBELAKANG17"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="18"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG18" id="TENSIONBELAKANG18" placeholder="TENSIONBELAKANG18"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="19"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG19" id="TENSIONBELAKANG19" placeholder="TENSIONBELAKANG19"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="20"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG20" id="TENSIONBELAKANG20" placeholder="TENSIONBELAKANG20"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="21"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG21" id="TENSIONBELAKANG21" placeholder="TENSIONBELAKANG21"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="22"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG22" id="TENSIONBELAKANG22" placeholder="TENSIONBELAKANG22"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="23"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG23" id="TENSIONBELAKANG23" placeholder="TENSIONBELAKANG23"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="24"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG24" id="TENSIONBELAKANG24" placeholder="TENSIONBELAKANG24"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="25"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG25" id="TENSIONBELAKANG25" placeholder="TENSIONBELAKANG25"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="26"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG26" id="TENSIONBELAKANG26" placeholder="TENSIONBELAKANG26"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="27"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG27" id="TENSIONBELAKANG27" placeholder="TENSIONBELAKANG27"
									style="width: 100%"></td>
							<td class="bg-danger" data-no="28"><input type="text" class="form-control input-xs"
									name="TENSIONBELAKANG28" id="TENSIONBELAKANG28" placeholder="TENSIONBELAKANG28"
									style="width: 100%"></td>

						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="1" rowspan="2">TENSION KELUAR</td>
							<td data-no="1" colspan="1">1</td>
							<td class="bg-danger" data-no="1">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR1"
									id="TENSIONKELUAR1" placeholder="TENSIONKELUAR1" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="2">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR2"
									id="TENSIONKELUAR2" placeholder="TENSIONKELUAR2" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="3">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR3"
									id="TENSIONKELUAR3" placeholder="TENSIONKELUAR3" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="4">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR4"
									id="TENSIONKELUAR4" placeholder="TENSIONKELUAR4" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="5">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR5"
									id="TENSIONKELUAR5" placeholder="TENSIONKELUAR5" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="6">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR6"
									id="TENSIONKELUAR6" placeholder="TENSIONKELUAR6" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="7">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR7"
									id="TENSIONKELUAR7" placeholder="TENSIONKELUAR7" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="8">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR8"
									id="TENSIONKELUAR8" placeholder="TENSIONKELUAR8" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="9">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR9"
									id="TENSIONKELUAR9" placeholder="TENSIONKELUAR9" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="10">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR10"
									id="TENSIONKELUAR10" placeholder="TENSIONKELUAR10" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="11">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR11"
									id="TENSIONKELUAR11" placeholder="TENSIONKELUAR11" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="12">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR12"
									id="TENSIONKELUAR12" placeholder="TENSIONKELUAR12" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="13">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR13"
									id="TENSIONKELUAR13" placeholder="TENSIONKELUAR13" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="14">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR14"
									id="TENSIONKELUAR14" placeholder="TENSIONKELUAR14" style="width: 100%">
							</td>
						</tr>


						<tr class="baris">
							<td data-no="1" colspan="1">2</td>
							<td class="bg-danger" data-no="15">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR15"
									id="TENSIONKELUAR15" placeholder="TENSIONKELUAR15" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="16">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR16"
									id="TENSIONKELUAR16" placeholder="TENSIONKELUAR16" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="17">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR17"
									id="TENSIONKELUAR17" placeholder="TENSIONKELUAR17" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="18">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR18"
									id="TENSIONKELUAR18" placeholder="TENSIONKELUAR18" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="19">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR19"
									id="TENSIONKELUAR19" placeholder="TENSIONKELUAR19" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="20">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR20"
									id="TENSIONKELUAR20" placeholder="TENSIONKELUAR20" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="21">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR21"
									id="TENSIONKELUAR21" placeholder="TENSIONKELUAR21" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="22">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR22"
									id="TENSIONKELUAR22" placeholder="TENSIONKELUAR22" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="23">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR23"
									id="TENSIONKELUAR23" placeholder="TENSIONKELUAR23" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="24">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR24"
									id="TENSIONKELUAR24" placeholder="TENSIONKELUAR24" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="25">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR25"
									id="TENSIONKELUAR25" placeholder="TENSIONKELUAR25" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="26">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR26"
									id="TENSIONKELUAR26" placeholder="TENSIONKELUAR26" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="27">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR27"
									id="TENSIONKELUAR27" placeholder="TENSIONKELUAR27" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="28">
								<input type="text" class="form-control input-xs" name="TENSIONKELUAR28"
									id="TENSIONKELUAR28" placeholder="TENSIONKELUAR28" style="width: 100%">
							</td>

						</tr>
						<tr>
							<td colspan="2" style="text-align: center;font-size: 15px; font-weight: bold;" data-no="1">
								POTONG BULU
							</td>
							<td class="bg-danger" colspan="2" data-no="2">
								<input type="text" class="form-control input-xs" name="POTONGBULU1" id="POTONGBULU1"
									placeholder="POTONGBULU1" style="width: 100%">
							</td>
							<td class="bg-danger" colspan="2" data-no="3">
								<input type="text" class="form-control input-xs" name="POTONGBULU2" id="POTONGBULU2"
									placeholder="POTONGBULU2" style="width: 100%">
							</td>
							<td colspan="4" style="text-align: center;font-size: 15px; font-weight: bold;">PEACHSKIN
							</td>
							<td colspan="3" class="bg-danger" style="text-align: center" name="PEACHSKIN_B"
								id="PEACHSKIN_B"><input type="text" class="form-control input-xs" name="PEACHSKIN_B"
									id="PEACHSKIN_B" placeholder="PEACHSKIN_B" style="width: 100%">
							</td>
							<td colspan="3" class="bg-danger" style="text-align: center" name="PEACHSKIN_F"
								id="PEACHSKIN_F"><input type="text" class="form-control input-xs" name="PEACHSKIN_F"
									id="PEACHSKIN_F" placeholder="PEACHSKIN_F" style="width: 100%">
							</td>
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
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SPEEDM/MNT_B" id="SPEEDM/MNT_B"
									placeholder="SPEEDM/MNT_B" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SPEEDM/MNT_F" id="SPEEDM/MNT_F"
									placeholder="SPEEDM/MNT_F" style="width: 100%">
							</td>
							<td colspan="4">% PILE BRUSH</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<!-- Ganti dengan nilai data statis atau sesuai kebutuhan -->
								<input type="text" class="form-control input-xs" name="%PILEBRUSH_B" id="%PILEBRUSH_B"
									placeholder="%PILEBRUSH_B" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<!-- Ganti dengan nilai data statis atau sesuai kebutuhan -->
								<input type="text" class="form-control input-xs" name="%PILEBRUSH_F" id="%PILEBRUSH_F"
									placeholder="%PILEBRUSH_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">JARAK PISAU</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="2">
								<!-- Ganti dengan nilai data statis atau sesuai kebutuhan -->
								<input type="text" class="form-control input-xs" name="JARAKPISAU_B" id="JARAKPISAU_B"
									placeholder="JARAKPISAU_B" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="2">
								<!-- Ganti dengan nilai data statis atau sesuai kebutuhan -->
								<input type="text" class="form-control input-xs" name="JARAKPISAU_F" id="JARAKPISAU_F"
									placeholder="JARAKPISAU_F" style="width: 100%">
							</td>
							<td colspan="4">% COUNTERPILE BRUSH</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<!-- Ganti dengan nilai data statis atau sesuai kebutuhan -->
								<input type="text" class="form-control input-xs" name="%COUNTERPILEBRUSH_B"
									id="%COUNTERPILEBRUSH_B" placeholder="%COUNTERPILEBRUSH_B" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<!-- Ganti dengan nilai data statis atau sesuai kebutuhan -->
								<input type="text" class="form-control input-xs" name="%COUNTERPILEBRUSH_F"
									id="%COUNTERPILEBRUSH_F" placeholder="%COUNTERPILEBRUSH_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="font-size: 15px; font-weight: bold;" data-no="1" colspan="2">
								SISIR</td>
							<td style="width: 100px;text-align: center;" data-no="1" colspan="2">B</td>
							<td style="width: 100px;text-align: center;" data-no="1" colspan="2">F</td>
							<td colspan="4">SIKAT BELAKANG</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="SIKATBELAKANG_B"
									id="SIKATBELAKANG_B" placeholder="SIKATBELAKANG_B" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="SIKATBELAKANG_F"
									id="SIKATBELAKANG_F" placeholder="SIKATBELAKANG_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">SPEED MESIN</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SPEEDMESIN_B" id="SPEEDMESIN_B"
									placeholder="SPEEDMESIN_B" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SPEEDMESIN_F" id="SPEEDMESIN_F"
									placeholder="SPEEDMESIN_F" style="width: 100%">
							</td>
							<td colspan="4">TENSION MASUK</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="TENSIONMASUK_B"
									id="TENSIONMASUK_B" placeholder="TENSIONMASUK_B" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="TENSIONMASUK_F"
									id="TENSIONMASUK_F" placeholder="TENSIONMASUK_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">SPEED JARUM</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SPEEDJARUM_B" id="SPEEDJARUM_B"
									placeholder="SPEEDJARUM_B" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SPEEDJARUM_F" id="SPEEDJARUM_F"
									placeholder="SPEEDJARUM_F" style="width: 100%">
							</td>
							<td colspan="4">TENSION TENGAH</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="TENSIONTENGAH_B"
									id="TENSIONTENGAH_B" placeholder="TENSIONTENGAH_B" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="TENSIONTENGAH_F"
									id="TENSIONTENGAH_F" placeholder="TENSIONTENGAH_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">SPEED DRUM</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SPEEDDRUM_B" id="SPEEDDRUM_B"
									placeholder="SPEEDDRUM_B" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SPEEDDRUM_F" id="SPEEDDRUM_F"
									placeholder="SPEEDDRUM_F" style="width: 100%">
							</td>
							<td colspan="4">SPEED KAIN</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="SPEEDKAIN_B" id="SPEEDKAIN_B"
									placeholder="SPEEDKAIN_B" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="SPEEDKAIN_F" id="SPEEDKAIN_F"
									placeholder="SPEEDKAIN_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">SPEED TARIKAN KAIN</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SPEEDTARIKANKAIN_B"
									id="SPEEDTARIKANKAIN_B" placeholder="SPEEDTARIKANKAIN_B" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SPEEDTARIKANKAIN_F"
									id="SPEEDTARIKANKAIN_F" placeholder="SPEEDTARIKANKAIN_F" style="width: 100%">
							</td>
							<td colspan="4">PEACHSKIN SPEED DRUM</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="PEACHSKINSPEEDDRUM_B"
									id="PEACHSKINSPEEDDRUM_B" placeholder="PEACHSKINSPEEDDRUM_B" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="PEACHSKINSPEEDDRUM_F"
									id="PEACHSKINSPEEDDRUM_F" placeholder="PEACHSKINSPEEDDRUM_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="font-size: 15px; font-weight: bold;" data-no="1" colspan="2">ANTI PILLING</td>
							<td class="bg-danger" data-no="1" colspan="4">
								<input type="text" class="form-control input-xs" name="ANTIPILLING" id="ANTIPILLING"
									placeholder="ANTIPILLING" style="width: 100%">
							</td>
							<td data-no="1" colspan="2" rowspan="2">TENSION BELAKANG</td>
							<td data-no="1" colspan="2" style="text-align:center;">1</td>
							<td class="bg-danger" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="TENSIONBELAKANG_B"
									id="TENSIONBELAKANG_B" placeholder="TENSIONBELAKANG_B" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="TENSIONBELAKANG_F"
									id="TENSIONBELAKANG_F" placeholder="TENSIONBELAKANG_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">MIST PRAY</td>
							<td class="bg-danger" data-no="1" colspan="4"><input type="text"
									class="form-control input-xs" name="MISTPRAY" id="MISTPRAY" placeholder="MISTPRAY"
									style="width: 100%"></td>
							<td data-no="1" colspan="2" style="text-align:center; width: 10px;">2</td>
							<td class="bg-danger" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="TENSIONBELAKANG2_B"
									id="TENSIONBELAKANG2_B" placeholder="TENSIONBELAKANG2_B" style="width: 100%">
							</td>
							<td class="bg-danger" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="TENSIONBELAKANG2_F"
									id="TENSIONBELAKANG2_F" placeholder="TENSIONBELAKANG2_F" style="width: 100%">
							</td>
						</tr>

						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">STEAM</td>
							<td class="bg-danger" data-no="2" colspan="4">
								<input type="text" class="form-control input-xs" name="STEAM" id="STEAM"
									placeholder="STEAM" style="width: 100%">
							</td>
							<td data-no="3" colspan="10" style="font-size: 15px; font-weight: bold;text-align:center;">
								POLISHING
							</td>
						</tr>

						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">OVEN</td>
							<td style="width: 100px;" class="bg-danger" data-no="1" colspan="4">
								<input type="text" class="form-control input-xs" name="OVEN" id="OVEN"
									placeholder="OVEN" style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">BAGIAN KAIN</td>
							<td style="width: 100px;text-align: center;" data-no="1" colspan="3">B</td>
							<td style="width: 100px;text-align: center;" data-no="1" colspan="3">F</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">PENDINGIN</td>
							<td colspan="4" class="bg-danger">
								<input type="text" class="form-control input-xs" name="PENDINGIN" id="PENDINGIN"
									placeholder="PENDINGIN" style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">SUHU FRONT ROLLER</td>
							<td colspan="3" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUHUFRONTROLLER_B"
									id="SUHUFRONTROLLER_B" placeholder="SUHUFRONTROLLER_B" style="width: 100%">
							</td>
							<td colspan="3" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUHUFRONTROLLER_F"
									id="SUHUFRONTROLLER_F" placeholder="SUHUFRONTROLLER_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">SUHU</td>
							<td colspan="4" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUHU" id="SUHU"
									placeholder="SUHU" style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">SUHU BACK ROLLER</td>
							<td colspan="3" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUHUBACKROLLER_B"
									id="SUHUBACKROLLER_B" placeholder="SUHUBACKROLLER_B" style="width: 100%">
							</td>
							<td colspan="3" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUHUBACKROLLER_F"
									id="SUHUBACKROLLER_F" placeholder="SUHUBACKROLLER_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="font-size: 15px; font-weight: bold;" data-no="1" colspan="2">WET SUEDING</td>
							<td colspan="4" class="bg-danger">
								<input type="text" class="form-control input-xs" name="WETSUEDING" id="WETSUEDING"
									placeholder="WETSUEDING" style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">SPEED BACK ROLLER</td>
							<td colspan="3" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SPEEDBACKROLLER_B"
									id="SPEEDBACKROLLER_B" placeholder="SPEEDBACKROLLER_B" style="width: 100%">
							</td>
							<td colspan="3" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SPEEDBACKROLLER_F"
									id="SPEEDBACKROLLER_F" placeholder="SPEEDBACKROLLER_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">BAGIAN</td>
							<td style="width: 100px;text-align: center;" data-no="1" colspan="2">B</td>
							<td style="width: 100px;text-align: center;" data-no="1" colspan="2">F</td>
							<td colspan="4" style="text-align: left;">GAP 1</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="GAP_01" id="GAP_01"
									placeholder="GAP_01" style="width: 100%">
							</td>
							<td class="bg-danger" style="width: 100px;" data-no="1" colspan="3">
								<input type="text" class="form-control input-xs" name="GAP_02" id="GAP_02"
									placeholder="GAP_02" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 1</td>
							<td style="width: 100px;" data-no="1" colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER1_B"
									id="SUEDEROLLER1_B" placeholder="SUEDEROLLER1_B" style="width: 100%">
							</td>
							<td style="width: 100px;" data-no="1" colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER1_F"
									id="SUEDEROLLER1_F" placeholder="SUEDEROLLER1_F" style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">GAP 2</td>
							<td colspan="3" class="bg-danger">
								<input type="text" class="form-control input-xs" name="GAP_03" id="GAP_03"
									placeholder="GAP_03" style="width: 100%">
							</td>
							<td colspan="3" class="bg-danger">
								<input type="text" class="form-control input-xs" name="GAP_04" id="GAP_04"
									placeholder="GAP_04" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 2</td>
							<td style="width: 100px;" data-no="1" colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER2_B"
									id="SUEDEROLLER2_B" placeholder="SUEDEROLLER2_B" style="width: 100%">
							</td>
							<td style="width: 100px;" data-no="1" colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER2_F"
									id="SUEDEROLLER2_F" placeholder="SUEDEROLLER2_F" style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">TENSION 1</td>
							<td colspan="3" class="bg-danger">
								<input type="text" class="form-control input-xs" name="TENSION1_B" id="TENSION1_B"
									placeholder="TENSION1_B" style="width: 100%">
							</td>
							<td colspan="3" class="bg-danger">
								<input type="text" class="form-control input-xs" name="TENSION1_F" id="TENSION1_F"
									placeholder="TENSION1_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 3</td>
							<td style="width: 100px;" data-no="1" colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER3_B"
									id="SUEDEROLLER3_B" placeholder="SUEDEROLLER3_B" style="width: 100%">
							</td>
							<td style="width: 100px;" data-no="1" colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER3_F"
									id="SUEDEROLLER3_F" placeholder="SUEDEROLLER3_F" style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">TENSION 2</td>
							<td colspan="3" class="bg-danger">
								<input type="text" class="form-control input-xs" name="TENSION2_B" id="TENSION2_B"
									placeholder="TENSION2_B" style="width: 100%">
							</td>
							<td colspan="3" class="bg-danger">
								<input type="text" class="form-control input-xs" name="TENSION2_F" id="TENSION2_F"
									placeholder="TENSION2_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 4 (S/B)</td>
							<td style="width: 100px;" class="bg-danger" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER4_B"
									id="SUEDEROLLER4_B" placeholder="SUEDEROLLER4_B" style="width: 100%">
							</td>
							<td style="width: 100px;" class="bg-danger" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER4_F"
									id="SUEDEROLLER4_F" placeholder="SUEDEROLLER4_F" style="width: 100%">
							</td>
							<td colspan="10" rowspan="2" style="font-size: 15px; font-weight: bold;text-align: center;">
								AIRO
							</td>
						</tr>

						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 1 (S/B)</td>
							<td style="width: 100px;" class="bg-danger" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER1(S/B)_B"
									id="SUEDEROLLER1(S/B)_B" placeholder="SUEDEROLLER1(S/B)_B" style="width: 100%">
							</td>
							<td style="width: 100px;" class="bg-danger" data-no="1" colspan="2">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER1(S/B)_F"
									id="SUEDEROLLER1(S/B)_F" placeholder="SUEDEROLLER1(S/B)_F" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 2 (S/B)</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER2(S/B)_B"
									id="SUEDEROLLER2(S/B)_B" placeholder="SUEDEROLLER2(S/B)_B" style="width: 100%">
							</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER2(S/B)_F"
									id="SUEDEROLLER2(S/B)_F" placeholder="SUEDEROLLER2(S/B)_F" style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">NO MESIN</td>
							<td colspan="6" class="bg-danger">
								<input type="text" class="form-control input-xs" name="NOMESIN" id="NOMESIN"
									placeholder="NOMESIN" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 3 (S/B)</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER3(S/B)_B"
									id="SUEDEROLLER3(S/B)_B" placeholder="SUEDEROLLER3(S/B)_B" style="width: 100%">
							</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER3(S/B)_F"
									id="SUEDEROLLER3(S/B)_F" placeholder="SUEDEROLLER3(S/B)_F" style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">SPEED ROLL</td>
							<td colspan="6" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SPEEDROLL" id="SPEEDROLL"
									placeholder="SPEEDROLL" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">SUEDE ROLLER 4 (S/B)</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER4(S/B)_B"
									id="SUEDEROLLER4(S/B)_B" placeholder="SUEDEROLLER4(S/B)_B" style="width: 100%">
							</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUEDEROLLER4(S/B)_F"
									id="SUEDEROLLER4(S/B)_F" placeholder="SUEDEROLLER4(S/B)_F" style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">VENTILATOR</td>
							<td colspan="6" class="bg-danger">
								<input type="text" class="form-control input-xs" name="VENTILATOR" id="VENTILATOR"
									placeholder="VENTILATOR" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">TENSION POTENSIONER (N)</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="TENSIONPOTENSIONER(N)_B"
									id="TENSIONPOTENSIONER(N)_B" placeholder="TENSIONPOTENSIONER(N)_B"
									style="width: 100%">
							</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="TENSIONPOTENSIONER(N)_F"
									id="TENSIONPOTENSIONER(N)_F" placeholder="TENSIONPOTENSIONER(N)_F"
									style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">SUHU OVEN</td>
							<td colspan="6" class="bg-danger">
								<input type="text" class="form-control input-xs" name="SUHUOVEN" id="SUHUOVEN"
									placeholder="SUHUOVEN" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">TENSION FEEDING ROLLER (N)</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="TENSIONFEEDINGROLLER(N)_B"
									id="TENSIONFEEDINGROLLER(N)_B" placeholder="TENSIONFEEDINGROLLER(N)_B"
									style="width: 100%">
							</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="TENSIONFEEDINGROLLER(N)_F"
									id="TENSIONFEEDINGROLLER(N)_F" placeholder="TENSIONFEEDINGROLLER(N)_F"
									style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">WAKTU OVEN</td>
							<td colspan="6" class="bg-danger">
								<input type="text" class="form-control input-xs" name="WAKTUOVEN" id="WAKTUOVEN"
									placeholder="WAKTUOVEN" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">PENETRATOR 01 (%)</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="PENETRATOR01(%)_B"
									id="PENETRATOR01(%)_B" placeholder="PENETRATOR01(%)_B" style="width: 100%">
							</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="PENETRATOR01(%)_F"
									id="PENETRATOR01(%)_F" placeholder="PENETRATOR01(%)_F" style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">PENDINGIN</td>
							<td colspan="6" class="bg-danger">
								<input type="text" class="form-control input-xs" name="AIROPENDINGIN" id="AIROPENDINGIN"
									placeholder="AIROPENDINGIN" style="width: 100%">
							</td>
						</tr>
						<tr class="baris">
							<td style="width: 180px;" data-no="1" colspan="2">PENETRATOR 02 (%)</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="PENETRATOR02(%)_B"
									id="PENETRATOR02(%)_B" placeholder="PENETRATOR02(%)_B" style="width: 100%">
							</td>
							<td colspan="2" class="bg-danger">
								<input type="text" class="form-control input-xs" name="PENETRATOR02(%)_F"
									id="PENETRATOR02(%)_F" placeholder="PENETRATOR02(%)_F" style="width: 100%">
							</td>
							<td colspan="4" style="text-align: left;">WAKTU PENDINGIN</td>
							<td colspan="6" class="bg-danger">
								<input type="text" class="form-control input-xs" name="WAKTUPENDINGIN"
									id="WAKTUPENDINGIN" placeholder="WAKTUPENDINGIN" style="width: 100%">
							</td>
						</tr>
					</tbody>
				</table>
				<div class="modal-footer">
					<a href="index.php" class="btn pull-left btn-danger" data-dismiss="modal">CANCEL</a>
					<button type="submit" value="save" name="simpen" class="btn pull-left btn-info">SAVE SPLB</button>
				</div>
			</form>
		</div>
	</div>
	</table>
</body>

<script src="../bootstrap/js/bootstrap.js"></script>

</html>