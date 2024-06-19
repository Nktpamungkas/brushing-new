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
      <form method="POST" action="?p=postInputSplb">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th colspan="15">SETTING PERBEDAAN LOT BRUSHING</th>
            </tr>
          </thead>
          <tbody>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">No. KK</td>
              <td class="bg-warning" data-no="2" colspan="8">
                <div class="form-inline text-center">
                  <input type="text" class="form-control input-xs" name="NO_KARTU_KERJA" id="NO_KARTU_KERJA"
                    value="<?php echo $_POST['kk'] ?>" readonly>/</span>
                  <input type="text" class="form-control input-xs" name="DEAMAND" id="DEAMAND"
                    value="<?php echo $_POST['DEAMAND'] ?>" readonly>
                </div>
              </td>
              <td data-no="10" colspan="6" style="text-align: center;">SPV/ASST/LDR</td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">LANGGANAN</td>
              <td class="bg-warning" data-no="2" colspan="8"><input type="text" class="form-control input-xs" readonly
                  required name="LANGGANAN" id="LANGGANAN" value="<?php if ($cek > 0) {
                    echo $ssr1['partnername'] . "/" . $ssr2['partnername'];
                  } else {
                    echo $rw['langganan'];
                  } ?>" style="width: 100%;"></td>
              <td data-no="10" colspan="6" class="bg-warning"><input type="text" class="form-control input-xs" readonly
                  name="TANGGAL_01" id="TANGGAL_01" value="<?php echo date('Y-m-d') ?>" style="width: 100%;"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">ORDER</td>
              <td class="bg-warning" data-no="2" colspan="8"><input type="text" class="form-control input-xs" readonly
                  name="ORDER" id="ORDER" value="<?php if ($cek > 0) {
                    echo $ssr['documentno'];
                  } else {
                    echo $rw['no_order'];
                  } ?>" style="width: 100%;"></td>
              <td data-no="10" colspan="6" rowspan="7"><textarea name="NOTE" id="NOTE" placeholder="-CATATAN-"
                  style="height: 100%;" class="form-control" rows="9"></textarea></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">JENIS KAIN</td>
              <td class="bg-warning" data-no="2" colspan="8"><input type="text" class="form-control input-xs" readonly
                  name="JENIS_KAIN" id="JENIS_KAIN" value="<?php if ($cek > 0) {
                    echo $ssr['productcode'] . " / " . $ssr['description'];
                  } else {
                    echo $rw['jenis_kain'];
                  } ?>" style="width: 100%;"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">WARNA</td>
              <td class="bg-warning" data-no="2" colspan="8"><input type="text" class="form-control input-xs"
                  name="WARNA" id="WARNA" readonly value="<?php if ($cek > 0) {
                    echo $ssr['color'];
                  } else {
                    echo $rw['no_warna'];
                  } ?>" style="width: 100%;"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">L X G PERMINTAAN</td>
              <td class="bg-warning" data-no="2" colspan="8">
                <div class="form-inline text-center">
                  <input name="L_PERMINTAAN" type="text" id="L_PERMINTAAN" readonly class="form-control input-xs" value="<?php if ($cek > 0) {
                    echo $ssr['cuttablewidth'];
                  } else {
                    echo $rw['lebar'];
                  } ?>" placeholder="0" /> &nbsp; X &nbsp;
                  <input name="G_PERMINTAAN" type="text" id="G_PERMINTAAN" readonly class="form-control input-xs" value="<?php if ($cek > 0) {
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
              <td class="bg-warning" data-no="2" colspan="8"><input type="text" class="form-control input-xs" readonly
                  name="LOT" id="LOT" value="<?php if ($cLot > 0) {
                    echo $rowLot['TotalLot'] . "-" . $nomorLot;
                  } else {
                    echo $rw['lot'];
                  } ?>" style="width: 100%;"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">NO. HANGER</td>
              <td class="bg-warning" data-no="2" colspan="8"><input type="text" class="form-control input-xs"
                  name="NO_HANGER" id="NO_HANGER" readonly value="<?php if ($cek > 0) {
                    echo $ssr['hangerno'];
                  } else {
                    echo $rw['no_item'];
                  } ?>" style="width: 100%;"></td>
            </tr>
            <tr class="baris">
              <td data-no="1" colspan="9">RAISING</td>
              <td data-no="10" colspan="6" class="bg-danger"><input type="text" class="form-control input-xs"
                  name="NAMA_TTD" name="NAMA_TTD" required placeholder="-NAMA PIC-" style="width: 100%;"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">NO. MESIN</td>
              <td style="text-align: center;" data-no="2">1</td>
              <td style="text-align: center;" data-no="3">2</td>
              <td style="text-align: center;" data-no="4">3</td>
              <td style="text-align: center;" data-no="5">4</td>
              <td style="text-align: center;" data-no="6">5</td>
              <td style="text-align: center;" data-no="7">6</td>
              <td style="text-align: center;" data-no="8">7</td>
              <td style="text-align: center;" data-no="9">8</td>
              <td style="text-align: center;" data-no="10">9</td>
              <td style="text-align: center;" data-no="11">10</td>
              <td style="text-align: center;" data-no="12">11</td>
              <td style="text-align: center;" data-no="13">12</td>
              <td style="text-align: center;" data-no="14">13</td>
              <td style="text-align: center;" data-no="15">14</td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">BAG. KAIN</td>
              <td class="bg-danger" data-no="2"> <input type="text" class="form-control input-xs" id="BAG_KAIN_01"
                  name="BAG_KAIN_01" placeholder="-BAG KAIN.01-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="3"> <input type="text" class="form-control input-xs" id="BAG_KAIN_02"
                  name="BAG_KAIN_02" placeholder="-BAG KAIN.02-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="4"> <input type="text" class="form-control input-xs" id="BAG_KAIN_03"
                  name="BAG_KAIN_03" placeholder="-BAG KAIN.03-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="5"> <input type="text" class="form-control input-xs" id="BAG_KAIN_04"
                  name="BAG_KAIN_04" placeholder="-BAG KAIN.04-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="6"> <input type="text" class="form-control input-xs" id="BAG_KAIN_05"
                  name="BAG_KAIN_05" placeholder="-BAG KAIN.05-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="7"> <input type="text" class="form-control input-xs" id="BAG_KAIN_06"
                  name="BAG_KAIN_06" placeholder="-BAG KAIN.06-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="8"> <input type="text" class="form-control input-xs" id="BAG_KAIN_07"
                  name="BAG_KAIN_07" placeholder="-BAG KAIN.07-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="9"> <input type="text" class="form-control input-xs" id="BAG_KAIN_08"
                  name="BAG_KAIN_08" placeholder="-BAG KAIN.08-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="10"><input type="text" class="form-control input-xs" id="BAG_KAIN_09"
                  name="BAG_KAIN_09" placeholder="-BAG KAIN.09-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs" id="BAG_KAIN_10"
                  name="BAG_KAIN_10" placeholder="-BAG KAIN.10-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="12"><input type="text" class="form-control input-xs" id="BAG_KAIN_11"
                  name="BAG_KAIN_11" placeholder="-BAG KAIN.11-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs" id="BAG_KAIN_12"
                  name="BAG_KAIN_12" placeholder="-BAG KAIN.12-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="14"><input type="text" class="form-control input-xs" id="BAG_KAIN_13"
                  name="BAG_KAIN_13" placeholder="-BAG KAIN.13-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="15"><input type="text" class="form-control input-xs" id="BAG_KAIN_14"
                  name="BAG_KAIN_14" placeholder="-BAG KAIN.14-" style="width: 100%;"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">JAR GARUK/S-D EFFECT</td>
              <td class="bg-danger" data-no="2"> <input type="text" class="form-control input-xs" id="JAR_GARUK_01"
                  name="JAR_GARUK_01" placeholder="-JR GRK.01-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="3"> <input type="text" class="form-control input-xs" id="JAR_GARUK_02"
                  name="JAR_GARUK_02" placeholder="-JR GRK.02-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="4"> <input type="text" class="form-control input-xs" id="JAR_GARUK_03"
                  name="JAR_GARUK_03" placeholder="-JR GRK.03-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="5"> <input type="text" class="form-control input-xs" id="JAR_GARUK_04"
                  name="JAR_GARUK_04" placeholder="-JR GRK.04-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="6"> <input type="text" class="form-control input-xs" id="JAR_GARUK_05"
                  name="JAR_GARUK_05" placeholder="-JR GRK.05-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="7"> <input type="text" class="form-control input-xs" id="JAR_GARUK_06"
                  name="JAR_GARUK_06" placeholder="-JR GRK.06-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="8"> <input type="text" class="form-control input-xs" id="JAR_GARUK_07"
                  name="JAR_GARUK_07" placeholder="-JR GRK.07-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="9"> <input type="text" class="form-control input-xs" id="JAR_GARUK_08"
                  name="JAR_GARUK_08" placeholder="-JR GRK.08-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="10"> <input type="text" class="form-control input-xs" id="JAR_GARUK_09"
                  name="JAR_GARUK_09" placeholder="-JR GRK.09-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="11"> <input type="text" class="form-control input-xs" id="JAR_GARUK_10"
                  name="JAR_GARUK_10" placeholder="-JR GRK.10-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="12"> <input type="text" class="form-control input-xs" id="JAR_GARUK_11"
                  name="JAR_GARUK_11" placeholder="-JR GRK.11-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="13"> <input type="text" class="form-control input-xs" id="JAR_GARUK_12"
                  name="JAR_GARUK_12" placeholder="-JR GRK.12-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="14"> <input type="text" class="form-control input-xs" id="JAR_GARUK_13"
                  name="JAR_GARUK_13" placeholder="-JR GRK.13-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="15"> <input type="text" class="form-control input-xs" id="JAR_GARUK_14"
                  name="JAR_GARUK_14" placeholder="-JR GRK.14-" style="width: 100%;"> </td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">DRUM</td>
              <td class="bg-danger" data-no="2"><input type="text" class="form-control input-xs" id="DRUM_01"
                  name="DRUM_01" placeholder="-DRUM 01-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs" id="DRUM_02"
                  name="DRUM_02" placeholder="-DRUM 02-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs" id="DRUM_03"
                  name="DRUM_03" placeholder="-DRUM 03-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs" id="DRUM_04"
                  name="DRUM_04" placeholder="-DRUM 04-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="6"><input type="text" class="form-control input-xs" id="DRUM_05"
                  name="DRUM_05" placeholder="-DRUM 05-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs" id="DRUM_06"
                  name="DRUM_06" placeholder="-DRUM 06-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="8"><input type="text" class="form-control input-xs" id="DRUM_07"
                  name="DRUM_07" placeholder="-DRUM 07-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs" id="DRUM_08"
                  name="DRUM_08" placeholder="-DRUM 08-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="10"><input type="text" class="form-control input-xs" id="DRUM_09"
                  name="DRUM_09" placeholder="-DRUM 09-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs" id="DRUM_10"
                  name="DRUM_10" placeholder="-DRUM 10-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="12"><input type="text" class="form-control input-xs" id="DRUM_11"
                  name="DRUM_11" placeholder="-DRUM 11-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs" id="DRUM_12"
                  name="DRUM_12" placeholder="-DRUM 12-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="14"><input type="text" class="form-control input-xs" id="DRUM_13"
                  name="DRUM_13" placeholder="-DRUM 13-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="15"><input type="text" class="form-control input-xs" id="DRUM_14"
                  name="DRUM_14" placeholder="-DRUM 14-" style="width: 100%;"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">JAR SISIR/I-D EFFECT</td>
              <td class="bg-danger" data-no="2"> <input type="text" class="form-control input-xs" id="JAR_SISIR_01"
                  name="JAR_SISIR_01" placeholder="-JR SSR.01-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="3"> <input type="text" class="form-control input-xs" id="JAR_SISIR_02"
                  name="JAR_SISIR_02" placeholder="-JR SSR.02-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="4"> <input type="text" class="form-control input-xs" id="JAR_SISIR_03"
                  name="JAR_SISIR_03" placeholder="-JR SSR.03-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="5"> <input type="text" class="form-control input-xs" id="JAR_SISIR_04"
                  name="JAR_SISIR_04" placeholder="-JR SSR.04-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="6"> <input type="text" class="form-control input-xs" id="JAR_SISIR_05"
                  name="JAR_SISIR_05" placeholder="-JR SSR.05-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="7"> <input type="text" class="form-control input-xs" id="JAR_SISIR_06"
                  name="JAR_SISIR_06" placeholder="-JR SSR.06-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="8"> <input type="text" class="form-control input-xs" id="JAR_SISIR_07"
                  name="JAR_SISIR_07" placeholder="-JR SSR.07-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="9"> <input type="text" class="form-control input-xs" id="JAR_SISIR_08"
                  name="JAR_SISIR_08" placeholder="-JR SSR.08-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="10"> <input type="text" class="form-control input-xs" id="JAR_SISIR_09"
                  name="JAR_SISIR_09" placeholder="-JR SSR.09-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="13"> <input type="text" class="form-control input-xs" id="JAR_SISIR_10"
                  name="JAR_SISIR_10" placeholder="-JR SSR.10-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="11"> <input type="text" class="form-control input-xs" id="JAR_SISIR_11"
                  name="JAR_SISIR_11" placeholder="-JR SSR.11-" style="width: 100%;"></td>
              <td class="bg-danger" data-no="12"> <input type="text" class="form-control input-xs" id="JAR_SISIR_12"
                  name="JAR_SISIR_12" placeholder="-JR SSR.12-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="14"> <input type="text" class="form-control input-xs" id="JAR_SISIR_13"
                  name="JAR_SISIR_13" placeholder="-JR SSR.13-" style="width: 100%;"> </td>
              <td class="bg-danger" data-no="15"> <input type="text" class="form-control input-xs" id="JAR_SISIR_14"
                  name="JAR_SISIR_14" placeholder="-JR SSR.14-" style="width: 100%;"> </td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">SPEED M/MNT</td>
              <td class="bg-danger" data-no="2"><input type="text" class="form-control input-xs" id="SPEED01"
                  name="SPEED01" placeholder="SPEED 01" style="width: 100%;"></td>
              <td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs" id="SPEED02"
                  name="SPEED02" placeholder="SPEED 02" style="width: 100%;"></td>
              <td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs" id="SPEED03"
                  name="SPEED03" placeholder="SPEED 03" style="width: 100%;"></td>
              <td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs" id="SPEED04"
                  name="SPEED04" placeholder="SPEED 04" style="width: 100%;"></td>
              <td class="bg-danger" data-no="6"><input type="text" class="form-control input-xs" id="SPEED05"
                  name="SPEED05" placeholder="SPEED 05" style="width: 100%;"></td>
              <td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs" id="SPEED06"
                  name="SPEED06" placeholder="SPEED 06" style="width: 100%;"></td>
              <td class="bg-danger" data-no="8"><input type="text" class="form-control input-xs" id="SPEED07"
                  name="SPEED07" placeholder="SPEED 07" style="width: 100%;"></td>
              <td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs" id="SPEED08"
                  name="SPEED08" placeholder="SPEED 08" style="width: 100%;"></td>
              <td class="bg-danger" data-no="10"><input type="text" class="form-control input-xs" id="SPEED09"
                  name="SPEED09" placeholder="SPEED 09" style="width: 100%;"></td>
              <td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs" id="SPEED10"
                  name="SPEED10" placeholder="SPEED 10" style="width: 100%;"></td>
              <td class="bg-danger" data-no="12"><input type="text" class="form-control input-xs" id="SPEED11"
                  name="SPEED11" placeholder="SPEED 11" style="width: 100%;"></td>
              <td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs" id="SPEED12"
                  name="SPEED12" placeholder="SPEED 12" style="width: 100%;"></td>
              <td class="bg-danger" data-no="14"><input type="text" class="form-control input-xs" id="SPEED13"
                  name="SPEED13" placeholder="SPEED 13" style="width: 100%;"></td>
              <td class="bg-danger" data-no="15"><input type="text" class="form-control input-xs" id="SPEED14"
                  name="SPEED14" placeholder="SPEED 14" style="width: 100%;"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">TENSION 1</td>
              <td class="bg-danger" data-no="2"><input type="text" class="form-control input-xs" id="TENSION1_01"
                  name="TENSION1_01" placeholder="TENSION-1 01" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs" id="TENSION1_02"
                  name="TENSION1_02" placeholder="TENSION-1 02" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs" id="TENSION1_03"
                  name="TENSION1_03" placeholder="TENSION-1 03" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs" id="TENSION1_04"
                  name="TENSION1_04" placeholder="TENSION-1 04" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="6"><input type="text" class="form-control input-xs" id="TENSION1_05"
                  name="TENSION1_05" placeholder="TENSION-1 05" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs" id="TENSION1_06"
                  name="TENSION1_06" placeholder="TENSION-1 06" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="8"><input type="text" class="form-control input-xs" id="TENSION1_07"
                  name="TENSION1_07" placeholder="TENSION-1 07" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs" id="TENSION1_08"
                  name="TENSION1_08" placeholder="TENSION-1 08" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="10"><input type="text" class="form-control input-xs" id="TENSION1_09"
                  name="TENSION1_09" placeholder="TENSION-1 09" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs" id="TENSION1_10"
                  name="TENSION1_10" placeholder="TENSION-1 10" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="12"><input type="text" class="form-control input-xs" id="TENSION1_11"
                  name="TENSION1_11" placeholder="TENSION-1 11" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs" id="TENSION1_12"
                  name="TENSION1_12" placeholder="TENSION-1 12" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="14"><input type="text" class="form-control input-xs" id="TENSION1_13"
                  name="TENSION1_13" placeholder="TENSION-1 13" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="15"><input type="text" class="form-control input-xs" id="TENSION1_14"
                  name="TENSION1_14" placeholder="TENSION-1 14" style="width: 100%;">
              </td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">TENSION 2</td>
              <td class="bg-danger" data-no="2"><input type="text" class="form-control input-xs" id="TENSION2_01"
                  name="TENSION2_01" placeholder="TENSION-2 01" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs" id="TENSION2_02"
                  name="TENSION2_02" placeholder="TENSION-2 02" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs" id="TENSION2_03"
                  name="TENSION2_03" placeholder="TENSION-2 03" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs" id="TENSION2_04"
                  name="TENSION2_04" placeholder="TENSION-2 04" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="6"><input type="text" class="form-control input-xs" id="TENSION2_05"
                  name="TENSION2_05" placeholder="TENSION-2 05" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs" id="TENSION2_06"
                  name="TENSION2_06" placeholder="TENSION-2 06" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="8"><input type="text" class="form-control input-xs" id="TENSION2_07"
                  name="TENSION2_07" placeholder="TENSION-2 07" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs" id="TENSION2_08"
                  name="TENSION2_08" placeholder="TENSION-2 08" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="10"><input type="text" class="form-control input-xs" id="TENSION2_09"
                  name="TENSION2_09" placeholder="TENSION-2 09" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs" id="TENSION2_10"
                  name="TENSION2_10" placeholder="TENSION-2 10" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="12"><input type="text" class="form-control input-xs" id="TENSION2_11"
                  name="TENSION2_11" placeholder="TENSION-2 11" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs" id="TENSION2_12"
                  name="TENSION2_12" placeholder="TENSION-2 12" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="14"><input type="text" class="form-control input-xs" id="TENSION2_13"
                  name="TENSION2_13" placeholder="TENSION-2 13" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="15"><input type="text" class="form-control input-xs" id="TENSION2_14"
                  name="TENSION2_14" placeholder="TENSION-2 14" style="width: 100%;">
              </td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">TENSION 3</td>
              <td class="bg-danger" data-no="2"><input type="text" class="form-control input-xs" id="TENSION3_01"
                  name="TENSION3_01" placeholder="TENSION-3 01" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs" id="TENSION3_02"
                  name="TENSION3_02" placeholder="TENSION-3 02" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs" id="TENSION3_03"
                  name="TENSION3_03" placeholder="TENSION-3 03" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs" id="TENSION3_04"
                  name="TENSION3_04" placeholder="TENSION-3 04" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="6"><input type="text" class="form-control input-xs" id="TENSION3_05"
                  name="TENSION3_05" placeholder="TENSION-3 05" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs" id="TENSION3_06"
                  name="TENSION3_06" placeholder="TENSION-3 06" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="8"><input type="text" class="form-control input-xs" id="TENSION3_07"
                  name="TENSION3_07" placeholder="TENSION-3 07" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs" id="TENSION3_08"
                  name="TENSION3_08" placeholder="TENSION-3 08" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="10"><input type="text" class="form-control input-xs" id="TENSION3_09"
                  name="TENSION3_09" placeholder="TENSION-3 09" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs" id="TENSION3_10"
                  name="TENSION3_10" placeholder="TENSION-3 10" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="12"><input type="text" class="form-control input-xs" id="TENSION3_11"
                  name="TENSION3_11" placeholder="TENSION-3 11" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs" id="TENSION3_12"
                  name="TENSION3_12" placeholder="TENSION-3 12" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="14"><input type="text" class="form-control input-xs" id="TENSION3_13"
                  name="TENSION3_13" placeholder="TENSION-3 13" style="width: 100%;">
              </td>
              <td class="bg-danger" data-no="15"><input type="text" class="form-control input-xs" id="TENSION3_14"
                  name="TENSION3_14" placeholder="TENSION-3 14" style="width: 100%;">
              </td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">SHEARING</td>
              <td style="text-align: center;" data-no="2" colspan="2" class="bg-danger"><input type="text"
                  class="form-control input-xs" name="SHEARING_1" id="SHEARING_1" placeholder="SHEARING 01"
                  style="width: 100%"></td>
              <td style="text-align: center;" data-no="4" colspan="2" class="bg-danger"><input type="text"
                  class="form-control input-xs" name="SHEARING_2" id="SHEARING_2" placeholder="SHEARING 02"
                  style="width: 100%"></td>
              <td style="text-align: center;" data-no="6" colspan="3">TUMBLE DRY</td>
              <td style="text-align: center;" data-no="9" colspan="3">COMBING 01</td>
              <td style="text-align: center;" data-no="12" colspan="2">B</td>
              <td style="text-align: center;" data-no="14" colspan="2">F</td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">BAGIAN</td>
              <td style="text-align: center;" data-no="2" colspan="2">B</td>
              <td style="text-align: center;" data-no="4" colspan="2">F</td>
              <td class="bg-danger" style="text-align: center;" data-no="6" colspan="3"><input type="text"
                  class="form-control input-xs" name="TUMBLEDRY" id="TUMBLEDRY" placeholder="TUMBLE DRY"
                  style="width: 100%"></td>
              <td style="text-align: center;" data-no="9" colspan="3">SPEED KAIN M/MNT</td>
              <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><input type="text"
                  class="form-control input-xs" name="SPEED_KAIN_B" id="SPEED_KAIN_B" placeholder="SPEED KAIN B"
                  style="width: 100%"></td>
              <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><input type="text"
                  class="form-control input-xs" name="SPEED_KAIN_F" id="SPEED_KAIN_F" placeholder="SPEED KAIN F"
                  style="width: 100%"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">SPEED M/MNT</td>
              <td class="bg-danger" style="text-align: center;" data-no="2" colspan="2"><input type="text"
                  class="form-control input-xs" name="SPEED_M_MNT_B" id="SPEED_M_MNT_B" placeholder="SPEED M/MNT-B"
                  style="width: 100%"></td>
              <td class="bg-danger" style="text-align: center;" data-no="4" colspan="2"><input type="text"
                  class="form-control input-xs" name="SPEED_M_MNT_F" id="SPEED_M_MNT_F" placeholder="SPEED M/MNT-F"
                  style="width: 100%"></td>
              <td style="text-align: center;" data-no="6" colspan="3">AIRO</td>
              <td style="text-align: center;" data-no="9" colspan="3">SPEED JARUM</td>
              <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><input type="text"
                  class="form-control input-xs" name="SPEED_JARUM_B" id="SPEED_JARUM_B" placeholder="SPEED JARUM B"
                  style="width: 100%"></td>
              <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><input type="text"
                  class="form-control input-xs" name="SPEED_JARUM_F" id="SPEED_JARUM_F" placeholder="SPEED JARUM F"
                  style="width: 100%"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">JARAK PISAU</td>
              <td class="bg-danger" style="text-align: center;" data-no="2" colspan="2"><input type="text"
                  class="form-control input-xs" name="JARAK_PISAU_B" id="JARAK_PISAU_B" placeholder="JARAK PISAU B"
                  style="width: 100%"></td>
              <td class="bg-danger" style="text-align: center;" data-no="4" colspan="2"><input type="text"
                  class="form-control input-xs" name="JARAK_PISAU_F" id="JARAK_PISAU_F" placeholder="JARAK_PISAU_F"
                  style="width: 100%"></td>
              <td class="bg-danger" style="text-align: center;" data-no="6" colspan="3"><input type="text"
                  class="form-control input-xs" name="AIRO" id="AIRO" placeholder="AIRO" style="width: 100%"></td>
              <td style="text-align: center;" data-no="9" colspan="3">SPEED DRUM</td>
              <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><input type="text"
                  class="form-control input-xs" name="SPEED_DRM_B" id="JARAK_JARUM_B" placeholder="JARAK JARUM B"
                  style="width: 100%"></td>
              <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><input type="text"
                  class="form-control input-xs" name="SPEED_DRM_F" id="JARAK_JARUM_F" placeholder="JARAK JARUM F"
                  style="width: 100%"></td>
            </tr>
            <tr class="baris">
              <td data-no="1" colspan="2">SUEDING 01/02</td>
              <td data-no="3" colspan="5">BACK DRAG ROLL</td>
              <td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs" name="BLACK_DRAGROLL"
                  id="BLACK_DRAGROLL" placeholder="BLACK_DRAGROLL" style="width: 100%"></td>
              <td style="text-align: center;" data-no="9" colspan="3">SPEED TARIKAN KAIN</td>
              <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><input type="text"
                  class="form-control input-xs" name="SPEED_TARIKAN_KAIN_B" id="SPEED_TARIKAN_KAIN_B"
                  placeholder="SPEED TARIKAN KAIN B" style="width: 100%">
              </td>
              <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><input type="text"
                  class="form-control input-xs" name="SPEED_TARIKAN_KAIN_F" id="SPEED_TARIKAN_KAIN_F"
                  placeholder="SPEED TARIKAN KAIN F" style="width: 100%">
              </td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">% PILE BRUSH</td>
              <td class="bg-danger" style="text-align: center;" data-no="2"><input type="text"
                  class="form-control input-xs" name="PILE_BRUSH" id="PILE_BRUSH" placeholder="-PILE_BRUSH-"
                  style="width: 100%"></td>
              <td data-no="3" colspan="5">PLAITER TENSION</td>
              <td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs" name="PLAITER_TENSION"
                  id="PLAITER_TENSION" placeholder="-PLAITER_TENSION-" style="width: 100%"></td>
              <td style="text-align: center; font-weight: bold;" data-no="9" colspan="3">COMBING 02</td>
              <td style="text-align: center;" data-no="12" colspan="2">B</td>
              <td style="text-align: center;" data-no="14" colspan="2">F</td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">% COUNTERPILE BRUSH</td>
              <td class="bg-danger" style="text-align: center;" data-no="2"><input type="text"
                  class="form-control input-xs" name="COUNTERPILE_BRUSH" id="COUNTERPILE_BRUSH"
                  placeholder="-COUNTERPILE_BRUSH-" style="width: 100%"></td>
              <td data-no="3" colspan="5">% REDUCED SUEDING</td>
              <td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs" name="REDUCED_SUEDING"
                  id="REDUCED_SUEDING" placeholder="-REDUCED_SUEDING-" style="width: 100%"></td>
              <td style="text-align: center;" data-no="9" colspan="3">JAR GARUK</td>
              <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><input type="text"
                  class="form-control input-xs" name="JAR_GARUK_B" id="JAR_GARUK_B" placeholder="-JAR GARUK B-"
                  style="width: 100%"></td>
              <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><input type="text"
                  class="form-control input-xs" name="JAR_GARUK_F" id="JAR_GARUK_F" placeholder="-JAR GARUK F-"
                  style="width: 100%"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">% DELIVERY BRUSH</td>
              <td class="bg-danger" style="text-align: center;" data-no="2"><input type="text"
                  class="form-control input-xs" name="DELIVERY_BRUSH" id="DELIVERY_BRUSH" placeholder="-DELIVERY BRUSH-"
                  style="width: 100%"></td>
              <td data-no="3" colspan="5">SPEED KAIN</td>
              <td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs" name="SPEED_KAIN"
                  id="SPEED_KAIN" placeholder="-SPEED KAIN-" style="width: 100%">
              </td>
              <td style="text-align: center;" data-no="9" colspan="3">DRUM</td>
              <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><input type="text"
                  class="form-control input-xs" name="DRUM_B" id="DRUM_B" placeholder="-DRUM B-" style="width: 100%">
              </td>
              <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><input type="text"
                  class="form-control input-xs" name="DRUM_F" id="DRUM_F" placeholder="-DRUM F-" style="width: 100%">
              </td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">TAKER IN TENSION</td>
              <td class="bg-danger" style="text-align: center;" data-no="2"><input type="text"
                  class="form-control input-xs" name="TAKER_IN_TENSION" id="TAKER_IN_TENSION"
                  placeholder="-TAKER IN TENSION-" style="width: 100%"></td>
              <td data-no="3" colspan="5">SPEED DRUM</td>
              <td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs" name="SPEED_DRUM"
                  id="SPEED_DRUM" placeholder="-SPEED DRUM-" style="width: 100%">
              </td>
              <td style="text-align: center;" data-no="9" colspan="3">JAR SISIR</td>
              <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><input type="text"
                  class="form-control input-xs" name="JAR_SISIR_B" id="JAR_SISIR_B" placeholder="-JAR SISIR B-"
                  style="width: 100%"></td>
              <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><input type="text"
                  class="form-control input-xs" name="JAR_SISIR_F" id="JAR_SISIR_F" placeholder="-JAR SISIR F-"
                  style="width: 100%"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">FRONT DRUM TENSION</td>
              <td class="bg-danger" style="text-align: center;" data-no="2"><input type="text"
                  class="form-control input-xs" name="FRONT_DRUM_TENSION" id="FRONT_DRUM_TENSION"
                  placeholder="-FRONT_DRUM_TENSION-" style="width: 100%"></td>
              <td data-no="3" colspan="5">SPEED TOTATION</td>
              <td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs" name="SPEED_TOTATION"
                  id="SPEED_TOTATION" placeholder="-SPEED TOTATION-" style="width: 100%"></td>
              <td style="text-align: center;" data-no="9" colspan="3">SPEED M/MNT</td>
              <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><input type="text"
                  class="form-control input-xs" name="SPEED_B" id="SPEED_B" placeholder="-SPEED B-" style="width: 100%">
              </td>
              <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><input type="text"
                  class="form-control input-xs" name="SPEED_F" id="SPEED_F" placeholder="-SPEED F-" style="width: 100%">
              </td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">REAR DRUM TENSION</td>
              <td class="bg-danger" style="text-align: center;" data-no="2"><input type="text"
                  class="form-control input-xs" name="REAR_DRUM_TENSION" id="REAR_DRUM_TENSION"
                  placeholder="-REAR_DRUM_TENSION-" style="width: 100%"></td>
              <td data-no="3" colspan="5">LOAD CELLS CONTROL</td>
              <td class="bg-danger" data-no="4"><input type="text" class="form-control input-xs" name="LOAD_CELLS_CTRL"
                  id="LOAD_CELLS_CTRL" placeholder="-LOAD CELLS CTRL-" style="width: 100%"></td>
              <td style="text-align: center;" data-no="9" colspan="3">TENSION</td>
              <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><input type="text"
                  class="form-control input-xs" name="TENSION_B" id="TENSION_B" placeholder="-TENSION B-"
                  style="width: 100%"></td>
              <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><input type="text"
                  class="form-control input-xs" name="TENSION_F" id="TENSION_F" placeholder="-TENSION F-"
                  style="width: 100%"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">POLISHING</td>
              <td data-no="2" colspan="6"></td>
              <td style="text-align: center;" data-no="9" colspan="2">SPEED M/MNT</td>
              <td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs" name="SPEED_POLISHING"
                  id="SPEED_POLISHING" placeholder="-SPEED POLISHING-" style="width: 100%"></td>
              <td data-no="12" colspan="5"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">SUHU ROLLER °C</td>
              <td data-no="2">F</td>
              <td class="bg-danger" data-no="3" colspan="2"><input type="text" class="form-control input-xs"
                  name="SUHU_ROLLER_F" id="SUHU_ROLLER_F" placeholder="-SUHU ROLLER-" style="width: 100%"></td>
              <td data-no="5">B</td>
              <td class="bg-danger" data-no="6" colspan="2"><input type="text" class="form-control input-xs"
                  name="SUHU_ROLLER_B" id="SUHU_ROLLER_B" placeholder="-SUHU ROLLER-" style="width: 100%"></td>
              <td data-no="8" colspan="2">GAP</td>
              <td data-no="10">1</td>
              <td class="bg-danger" data-no="11" colspan="2"><input type="text" class="form-control input-xs"
                  name="GAP_01" id="GAP_01" placeholder="-GAP 01-" style="width: 100%"></td>
              <td data-no="13">2</td>
              <td class="bg-danger" data-no="14" colspan="2"><input type="text" class="form-control input-xs"
                  name="GAP_02" id="GAP_02" placeholder="-GAP 02-" style="width: 100%"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">SPEED ROLLER</td>
              <td data-no="2">F</td>
              <td class="bg-danger" data-no="3" colspan="2"><input type="text" class="form-control input-xs"
                  name="SPEED_RLR_F" id="SPEED_RLR_F" placeholder="-SPEED ROLLER F-" style="width: 100%"></td>
              <td data-no="5">B</td>
              <td class="bg-danger" data-no="6" colspan="2"><input type="text" class="form-control input-xs"
                  name="SPEED_RLR_B" id="SPEED_RLR_B" placeholder="-SPEED ROLLER B-" style="width: 100%"></td>
              <td data-no="8" colspan="2">TENSION</td>
              <td data-no="10">1</td>
              <td class="bg-danger" data-no="11" colspan="2"><input type="text" class="form-control input-xs"
                  name="TENSION_01" id="TENSION_01" placeholder="-TENSION 01-" style="width: 100%"></td>
              <td data-no="13">2</td>
              <td class="bg-danger" data-no="14" colspan="2"><input type="text" class="form-control input-xs"
                  name="TENSION_02" id="TENSION_02" placeholder="-TENSION 02-" style="width: 100%"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">SUEDING 03</td>
              <td data-no="2" colspan="3">SPEED KAIN M/MNT</td>
              <td class="bg-danger" data-no="5" colspan="2"><input type="text" class="form-control input-xs"
                  name="SUEDING_03_SPEED" id="SUEDING_03_SPEED" placeholder="-SUEDING 03-" style="width: 100%"></td>
              <td data-no="7" colspan="3" style="text-align: center;">TEK REGULATOR</td>
              <td class="bg-danger" data-no="8" colspan="2"><input type="text" class="form-control input-xs"
                  name="TEK_REGULATOR" id="TEK_REGULATOR" placeholder="-TEK_REGULATOR-" style="width: 100%"></td>
              <td data-no="10" colspan="2"></td>
              <td data-no="12" colspan="2" rowspan="2" style="text-align: center; vertical-align: middle;">QUALITY</td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">TEKANAN KAIN</td>
              <td data-no="2">1</td>
              <td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs" name="TEKANAN_KAIN_01"
                  id="TEKANAN_KAIN_01" placeholder="-TEKANAN_KAIN-" style="width: 100%"></td>
              <td data-no="4">2</td>
              <td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs" name="TEKANAN_KAIN_02"
                  id="TEKANAN_KAIN_02" placeholder="-TEKANAN_KAIN-" style="width: 100%"></td>
              <td data-no="6">3</td>
              <td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs" name="TEKANAN_KAIN_03"
                  id="TEKANAN_KAIN_03" placeholder="-TEKANAN_KAIN-" style="width: 100%"></td>
              <td data-no="8">4</td>
              <td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs" name="TEKANAN_KAIN_04"
                  id="TEKANAN_KAIN_04" placeholder="-TEKANAN_KAIN-" style="width: 100%"></td>
              <td data-no="10">5</td>
              <td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs" name="TEKANAN_KAIN_05"
                  id="TEKANAN_KAIN_05" placeholder="-TEKANAN_KAIN-" style="width: 100%"></td>
              <td data-no="12">6</td>
              <td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs" name="TEKANAN_KAIN_06"
                  id="TEKANAN_KAIN_06" placeholder="-TEKANAN_KAIN-" style="width: 100%"></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">SPEED SIKAT</td>
              <td data-no="2">1</td>
              <td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs" name="SPEED_SIKAT_01"
                  id="SPEED_SIKAT_01" placeholder="-SPEED_SIKAT-" style="width: 100%"></td>
              <td data-no="4">2</td>
              <td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs" name="SPEED_SIKAT_02"
                  id="SPEED_SIKAT_02" placeholder="-SPEED_SIKAT-" style="width: 100%"></td>
              <td data-no="6">3</td>
              <td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs" name="SPEED_SIKAT_03"
                  id="SPEED_SIKAT_03" placeholder="-SPEED_SIKAT-" style="width: 100%"></td>
              <td data-no="8">4</td>
              <td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs" name="SPEED_SIKAT_04"
                  id="SPEED_SIKAT_04" placeholder="-SPEED_SIKAT-" style="width: 100%"></td>
              <td data-no="10">5</td>
              <td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs" name="SPEED_SIKAT_05"
                  id="SPEED_SIKAT_05" placeholder="-SPEED_SIKAT-" style="width: 100%"></td>
              <td data-no="12">6</td>
              <td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs" name="SPEED_SIKAT_06"
                  id="SPEED_SIKAT_06" placeholder="-SPEED_SIKAT-" style="width: 100%"></td>
              <td class="bg-danger" data-no="14" colspan="2" rowspan="4"
                style="text-align: center; vertical-align: middle;"><textarea name="QUALITY" id="QUALITY"
                  class="form-control input-xs" style="height: 100%;" rows="5"></textarea></td>
            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">SUEDING 04</td>
              <td data-no="2" colspan="3">SPEED KAIN M/MNT</td>
              <td data-no="5" colspan="2"><input type="text" class="form-control input-xs" name="SUEDING_04_SPEED"
                  id="SUEDING_04_SPEED" placeholder="-SPEED_KAIN-" style="width: 100%"></td>
              <td data-no="7" colspan="3">TEK REAGULATOR</td>
              <td data-no="9" colspan="2"><input type="text" class="form-control input-xs" name="TANGGAL_02"
                  id="TANGGAL_02" placeholder="-TANGGAL-" style="width: 100%"></td>
              <td data-no="12" colspan="2"></td>

            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">TEKANAN KAIN</td>
              <td data-no="2">1</td>
              <td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs" name="TEKANAN04_01"
                  id="TEKANAN04_01" placeholder="-TEKANAN KAIN-" style="width: 100%"></td>
              <td data-no="4">2</td>
              <td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs" name="TEKANAN04_02"
                  id="TEKANAN04_02" placeholder="-TEKANAN KAIN-" style="width: 100%"></td>
              <td data-no="6">3</td>
              <td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs" name="TEKANAN04_03"
                  id="TEKANAN04_03" placeholder="-TEKANAN KAIN-" style="width: 100%"></td>
              <td data-no="8">4</td>
              <td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs" name="TEKANAN04_04"
                  id="TEKANAN04_04" placeholder="-TEKANAN KAIN-" style="width: 100%"></td>
              <td data-no="10">5</td>
              <td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs" name="TEKANAN04_05"
                  id="TEKANAN04_05" placeholder="-TEKANAN KAIN-" style="width: 100%"></td>
              <td data-no="12">6</td>
              <td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs" name="TEKANAN04_06"
                  id="TEKANAN04_06" placeholder="-TEKANAN KAIN-" style="width: 100%"></td>

            </tr>
            <tr class="baris">
              <td style="width: 180px;" data-no="1">SPEED SIKAT</td>
              <td data-no="2">1</td>
              <td class="bg-danger" data-no="3"><input type="text" class="form-control input-xs" name="SIKAT04_01"
                  id="SIKAT04_01" placeholder="-SPEED_SIKAT-" style="width: 100%">
              </td>
              <td data-no="4">2</td>
              <td class="bg-danger" data-no="5"><input type="text" class="form-control input-xs" name="SIKAT04_02"
                  id="SIKAT04_02" placeholder="-SPEED_SIKAT-" style="width: 100%">
              </td>
              <td data-no="6">3</td>
              <td class="bg-danger" data-no="7"><input type="text" class="form-control input-xs" name="SIKAT04_03"
                  id="SIKAT04_03" placeholder="-SPEED_SIKAT-" style="width: 100%">
              </td>
              <td data-no="8">4</td>
              <td class="bg-danger" data-no="9"><input type="text" class="form-control input-xs" name="SIKAT04_04"
                  id="SIKAT04_04" placeholder="-SPEED_SIKAT-" style="width: 100%">
              </td>
              <td data-no="10">5</td>
              <td class="bg-danger" data-no="11"><input type="text" class="form-control input-xs" name="SIKAT04_05"
                  id="SIKAT04_05" placeholder="-SPEED_SIKAT-" style="width: 100%">
              </td>
              <td data-no="12">6</td>
              <td class="bg-danger" data-no="13"><input type="text" class="form-control input-xs" name="SIKAT04_06"
                  id="SIKAT04_06" placeholder="-SPEED_SIKAT-" style="width: 100%">
              </td>

            </tr>
          </tbody>
        </table>
        <div class="modal-footer">
          <a href="index.php" class="btn pull-left btn-danger" data-dismiss="modal">CANCEL</a>
          <button type="submit" value="simpen" name="save" class="btn pull-left btn-info">SAVE SPLB</button>
        </div>
      </form>
    </div>
  </div>


  </table>
</body>

<script src="../bootstrap/js/bootstrap.js"></script>

</html>