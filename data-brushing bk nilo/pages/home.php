<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Home</title>
</head>
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
  function getData_ITXVIEWKK() {
    // var _nodemand = document.getElementById("nodemand").value;
    var _noprodorder = document.getElementById("nokk").value;

    // if(_noprodorder == ""){

    // }else{
    $.get("../api_ITXVIEWKK.php?noprod=" + _noprodorder, function(item) {
      document.getElementById("buyer").value = item.PELANGGAN + '/' + item.BUYER;
      document.getElementById("no_order").value = item.PROJECTCODE;
      document.getElementById("jenis_kain").value = item.ITEMDESCRIPTION;
      document.getElementById("warna").value = item.WARNA;
      document.getElementById("qty").value = item.QTY_ORDER;
    });
    // }
  };
</script>

<body>
  <?php
  function nourut()
  {
    include("../koneksi.php");
    $format = date("ymd");
    $sql = mysqli_query($con, "SELECT nokk FROM tbl_produksi WHERE substr(nokk,1,6) like '%" . $format . "%' ORDER BY nokk DESC LIMIT 1 ") or die(mysqli_error());
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

  if ($_GET['typekk'] == "KKLama") {
    if ($_GET['id'] != "") {
      $idk = $_GET['id'];
    } else {
      $idk = $_POST['id'];
    }
    $qry = mysqli_query($con, "SELECT * FROM tbl_produksi WHERE id='$idk' ORDER BY id DESC LIMIT 1");
    $rw = mysqli_fetch_array($qry);
    if ($idkk != "") {
      date_default_timezone_set('Asia/Jakarta');
      $rc = mysqli_num_rows($qry);
      $tglsvr = sqlsrv_query($conn, "select CONVERT(VARCHAR(10),GETDATE(),105) AS  tgk");
      $sr = sqlsrv_fetch_array($tglsvr);

      $sqlLot = sqlsrv_query($conn, " SELECT
              x.*,dbo.fn_StockMovementDetails_GetTotalWeightPCC(0, x.PCBID) as Weight,
              dbo.fn_StockMovementDetails_GetTotalRollPCC(0, x.PCBID) as RollCount
            FROM( SELECT
              so.CustomerID, so.BuyerID, 
              sod.ID as SODID, sod.ProductID, sod.UnitID, sod.WeightUnitID, 
              pcb.ID as PCBID,pcb.UnitID as BatchUnitID,
              pcblp.DepartmentID,pcb.PCID,pcb.LotNo,pcb.ChildLevel,pcb.RootID
            FROM
              SalesOrders so INNER JOIN
              JobOrders jo ON jo.SOID=so.ID INNER JOIN
              SODetails sod ON so.ID = sod.SOID INNER JOIN
              SODetailsAdditional soda ON sod.ID = soda.SODID LEFT JOIN
              ProcessControlJO pcjo ON sod.ID = pcjo.SODID LEFT JOIN
              ProcessControlBatches pcb ON pcjo.PCID = pcb.PCID LEFT JOIN
              ProcessControlBatchesLastPosition pcblp ON pcb.ID = pcblp.PCBID LEFT JOIN
              ProcessFlowProcessNo pfpn ON pfpn.EntryType = 2 and pcb.ID = pfpn.ParentID AND pfpn.MachineType = 24 LEFT JOIN
              ProcessFlowDetailsNote pfdn ON pfpn.EntryType = pfdn.EntryType AND pfpn.ID = pfdn.ParentID
            WHERE pcb.DocumentNo='$idkk' AND pcb.Gross<>'0'
              GROUP BY
                so.SONumber, so.SODate, so.CustomerID, so.BuyerID, so.PONumber, so.PODate,jo.DocumentNo,
                sod.ID, sod.ProductID, sod.Quantity, sod.UnitID, sod.Weight, sod.WeightUnitID,
                soda.RefNo,pcb.DocumentNo,pcb.Dated,sod.RequiredDate,
                pcb.ID, pcb.DocumentNo, pcb.Gross,
                pcb.Quantity, pcb.UnitID, pcb.ScheduledDate, pcb.ProductionScheduledDate,
                pcblp.DepartmentID,pcb.LotNo,pcb.PCID,pcb.ChildLevel,pcb.RootID
              ) x INNER JOIN
              ProductMaster pm ON x.ProductID = pm.ID LEFT JOIN
              Departments dep ON x.DepartmentID  = dep.ID LEFT JOIN
              Departments pdep ON dep.RootID = pdep.ID LEFT JOIN				
              Partners cust ON x.CustomerID = cust.ID LEFT JOIN
              Partners buy ON x.BuyerID = buy.ID LEFT JOIN
              UnitDescription udq ON x.UnitID = udq.ID LEFT JOIN
              UnitDescription udw ON x.WeightUnitID = udw.ID LEFT JOIN
              UnitDescription udb ON x.BatchUnitID = udb.ID
            ORDER BY
              x.SODID, x.PCBID ", array(), array("Scrollable" => 'static'));
      $sLot = sqlsrv_fetch_array($sqlLot);
      $cLot = sqlsrv_num_rows($sqlLot);
      $child = $sLot['ChildLevel'];

      if ($child > 0) {
        $sqlgetparent = sqlsrv_query($conn, "select ID,LotNo from ProcessControlBatches where ID='$sLot[RootID]' and ChildLevel='0'");
        $rowgp = sqlsrv_fetch_array($sqlgetparent);

        //$nomLot=substr("$row2[LotNo]",0,1);
        $nomLot = $rowgp['LotNo'];
        $nomorLot = "$nomLot/K$sLot[ChildLevel]";
      } else {
        $nomorLot = $sLot['LotNo'];
      }

      $sqlLot1 = "Select count(*) as TotalLot From ProcessControlBatches where PCID='$sLot[PCID]' and RootID='0' and LotNo < '1000'";
      $qryLot1 = sqlsrv_query($conn, $sqlLot1) or die('A error occured : ');
      $rowLot = sqlsrv_fetch_array($qryLot1);

      $sqls = sqlsrv_query($conn, "select processcontrolJO.SODID,salesorders.ponumber,processcontrol.productid,salesorders.customerid,joborders.documentno,
                                      salesorders.buyerid,processcontrolbatches.lotno,productcode,productmaster.color,colorno,description,weight,cuttablewidth from Joborders 
                                      left join processcontrolJO on processcontrolJO.joid = Joborders.id
                                      left join salesorders on soid= salesorders.id
                                      left join processcontrol on processcontrolJO.pcid = processcontrol.id
                                      left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
                                      left join productmaster on productmaster.id= processcontrol.productid
                                      left join productpartner on productpartner.productid= processcontrol.productid
                                      where processcontrolbatches.documentno='$idkk'", array(), array("Scrollable" => 'static'));
      $ssr = sqlsrv_fetch_array($sqls);
      $cek = sqlsrv_num_rows($sqls);
      $lgn1 = sqlsrv_query($conn, "select partnername from partners where id='$ssr[customerid]'");
      $ssr1 = sqlsrv_fetch_array($lgn1);
      $lgn2 = sqlsrv_query($conn, "select partnername from partners where id='$ssr[buyerid]'");
      $ssr2 = sqlsrv_fetch_array($lgn2);
    }
  } elseif ($_GET['typekk'] == "NOW") {
    if ($_GET['id'] != "") {
      $idk = $_GET['id'];
    } else {
      $idk = $_POST['id'];
    }
    $qry = mysqli_query($con, "SELECT * FROM tbl_produksi WHERE id='$idk' ORDER BY id DESC LIMIT 1");
    $rw = mysqli_fetch_array($qry);
    if ($idkk != "") {
      if ($_GET['demand'] != "") {
        $nomordemand = $_GET['demand'];
        $anddemand = "AND i.DEAMAND LIKE '%$nomordemand%'";
      } else {
        $anddemand = "";
      }
      $kk = "SELECT
							*
						FROM
							ITXVIEWKK i 
						WHERE
							i.PRODUCTIONORDERCODE LIKE '%$idkk%' $anddemand";
      $qrykk = db2_exec($conn_db2, $kk);
      $rw_kk = db2_fetch_assoc($qrykk);
    }
  }
  ?>

  <?php
  if (isset($_POST['btnSimpan']) and $_GET['id'] == "") {
    if ($_POST['nokk'] != "") {
      $nokk = $_POST['nokk'];
      $idkk = $_POST['nokk'];
    } else {
      $nokk = $nou;
      $idkk = $nou;
    }
    $nodemand = $_POST['demand'];
    $shift = $_POST['shift'];
    $shift1 = $_POST['shift2'];
    $langganan = $_POST['buyer'];
    $order = $_POST['no_order'];
    $jenis_kain = str_replace("'", "", $_POST['jenis_kain']);
    $warna = str_replace("'", "", $_POST['warna']);
    $lot = $_POST['lot'];
    $qty = $_POST['qty'];
    $rol = $_POST['rol'];
    $mesin = $_POST['no_mesin'];
    $nmmesin = $_POST['nama_mesin'];
    $proses = $_POST['proses'];
    $jam_in = $_POST['proses_in'];
    $jam_out = $_POST['proses_out'];
    $proses_jam = $_POST['proses_jam'];
    $proses_menit = $_POST['proses_menit'];
    $tgl_proses_in = $_POST['tgl_proses_m'];
    $tgl_proses_out = $_POST['tgl_proses_k'];
    $mulai = $_POST['stop_mulai'];
    $selesai = $_POST['stop_selesai'];
    $stop_jam = $_POST['stop_jam'];
    $stop_menit = $_POST['stop_menit'];
    $tgl_stop_m = $_POST['tgl_stop_m'];
    $tgl_stop_s = $_POST['tgl_stop_s'];
    $kd = $_POST['kd_stop'];
    $tgl = $_POST['tgl'];
    $acc_kain = str_replace("'", "", $_POST['acc_kain']);
    $ket = str_replace("'", "", $_POST['ket']);
    $simpanSql = "INSERT INTO tbl_produksi SET 
                                              `nokk`='$nokk',
                                              `nodemand` = $nodemand,
                                              `shift`='$shift',
                                              `shift1`='$shift1',
                                              `no_mesin`='$mesin',
                                              `nama_mesin`='$nmmesin',
                                              `langganan`='$langganan',
                                              `no_order`='$order',
                                              `jenis_kain`='$jenis_kain',
                                              `warna`='$warna',
                                              `lot`='$lot',
                                              `rol`='$rol',
                                              `qty`='$qty',
                                              `proses`='$proses',
                                              `jam_in`='$jam_in',
                                              `jam_out`='$jam_out',
                                              `tgl_proses_in`='$tgl_proses_in',
                                              `tgl_proses_out`='$tgl_proses_out',
                                              `stop_l`='$mulai',
                                              `stop_r`='$selesai',
                                              `tgl_stop_l`='$tgl_stop_m',
                                              `tgl_stop_r`='$tgl_stop_s',
                                              `kd_stop`='$kd',
                                              `tgl_buat`=now(),
                                              `acc_staff`='$acc_kain',
                                              `ket`='$ket',
                                              `tgl_update`='$tgl'
                                              ";
    mysqli_query($con, $simpanSql) or die("Gagal Simpan" . mysqli_error());

    // Refresh form
    echo "<meta http-equiv='refresh' content='0; url=?idkk=$idkk&status=Data Sudah DiSimpan'>";
  } else if (isset($_POST['btnSimpan']) and $_GET['id'] != "") {
    $nodemand = $_POST['demand'];
    $langganan = $_POST['buyer'];
    $order = $_POST['no_order'];
    $jenis_kain = str_replace("'", "", $_POST['jenis_kain']);
    $warna = str_replace("'", "", $_POST['warna']);
    $lot = $_POST['lot'];
    $qty = $_POST['qty'];
    $rol = $_POST['rol'];
    $mesin = $_POST['no_mesin'];
    $nmmesin = $_POST['nama_mesin'];
    $proses = $_POST['proses'];
    $shift = $_POST['shift'];
    $shift1 = $_POST['shift2'];
    $jam_in = $_POST['proses_in'];
    $jam_out = $_POST['proses_out'];
    $proses_jam = $_POST['proses_jam'];
    $proses_menit = $_POST['proses_menit'];
    $tgl_proses_in = $_POST['tgl_proses_m'];
    $tgl_proses_out = $_POST['tgl_proses_k'];
    $mulai = $_POST['stop_mulai'];
    $selesai = $_POST['stop_selesai'];
    $stop_jam = $_POST['stop_jam'];
    $stop_menit = $_POST['stop_menit'];
    $tgl_stop_m = $_POST['tgl_stop_m'];
    $tgl_stop_s = $_POST['tgl_stop_s'];
    $kd = $_POST['kd_stop'];
    $tgl = $_POST['tgl'];
    $acc_kain = str_replace("'", "", $_POST['acc_kain']);
    $ket = str_replace("'", "", $_POST['ket']);
    $simpanSql = "UPDATE tbl_produksi SET 
                            `nodemand` = $nodemand,
                            `shift`='$shift',
                            `shift1`='$shift1',
                            `no_mesin`='$mesin',
                            `nama_mesin`='$nmmesin',
                            `langganan`='$langganan',
                            `no_order`='$order',
                            `jenis_kain`='$jenis_kain',
                            `warna`='$warna',
                            `lot`='$lot',
                            `rol`='$rol',
                            `qty`='$qty',
                            `proses`='$proses',
                            `jam_in`='$jam_in',
                            `jam_out`='$jam_out',
                            `tgl_proses_in`='$tgl_proses_in',
                            `tgl_proses_out`='$tgl_proses_out',
                            `stop_l`='$mulai',
                            `stop_r`='$selesai',
                            `tgl_stop_l`='$tgl_stop_m',
                            `tgl_stop_r`='$tgl_stop_s',
                            `kd_stop`='$kd',
                            `acc_staff`='$acc_kain',
                            `tgl_update`='$tgl',
                            `ket`='$ket'
                            WHERE `id`='$_POST[id]'";
    mysqli_query($con, $simpanSql) or die("Gagal Ubah" . mysqli_error());
    $idk = $_POST['id'];
    // Refresh form
    echo "<meta http-equiv='refresh' content='0; url=?id=$idk&status=Data Sudah DiUbah'>";
  }
  ?>
  <form id="form1" name="form1" method="post" action="">
    <table width="100%" border="0">
      <tr>
        <td colspan="8" scope="row">
          <h1>Input Data Produksi Harian Brushing</h1>
        </td>
      </tr>
      <tr>
        <th colspan="8" scope="row">
          <font color="#FF0000"><?php echo $_GET['status']; ?></font>
        </th>
      </tr>
      <tr>
        <td scope="row">
          <h4>Pilih Asal Kartu Kerja</h4>
        </td>
        <td width="1%">:</td>
        <td>
          <select style="width: 40%" id="typekk" name="typekk" onchange="window.location='?typekk='+this.value" required>
            <option value="" disabled selected>-Pilih Tipe Kartu Kerja-</option>
            <option value="KKLama" <?php if ($_GET['typekk'] == "KKLama") {
                                      echo "SELECTED";
                                    } ?>>KK Lama</option>
            <option value="NOW" <?php if ($_GET['typekk'] == "NOW") {
                                  echo "SELECTED";
                                } ?>>KK NOW</option> -->
            </select=>
        </td>
      </tr>
      <tr>
        <td width="10%" scope="row">
          <h4>Nokk</h4>
        </td>
        <td width="1%">:</td>
        <td width="30%">
          <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id" />
          <?php if($_GET['id']) : ?>
              <input name="nokk" type="text" id="nokk" size="17" value="<?= $rw['nokk']; ?>">
              <input name="demand" type="text" id="demand" size="17" value="<?= $rw['nodemand']; ?>">

          <?php else : ?>
            <input name="nokk" type="text" id="nokk" size="17" onchange="window.location='?typekk='+document.getElementById(`typekk`).value+'&idkk='+this.value" value="<?php echo $_GET['idkk']; ?>" />

            <?php if ($_GET['typekk'] == 'NOW') { ?>
              <select style="width: 40%" name="demand" id="demand" onchange='getData_ITXVIEWKK()' required>
                <?php
                if ($_GET['idkk']) :
                  $qry_demand = db2_exec($conn_db2, "SELECT * FROM ITXVIEWKK WHERE PRODUCTIONORDERCODE LIKE '%$idkk%' AND DEAMAND LIKE '%$nomordemand%'");
                ?>
                  <option value="" disabled selected>Pilih Nomor Demand</option>
                  <?php while ($r_demand = db2_fetch_assoc($qry_demand)) {  ?>
                    <option value="<?= $r_demand['DEAMAND']; ?>" <?php if ($_GET['demand'] == $r_demand['DEAMAND']) {
                                                                    echo "SELECTED";
                                                                  } ?>><?= $r_demand['DEAMAND']; ?></option>
                  <?php } ?>
                <?php else : ?>
                  <option value="" disabled selected>Masukan Nomor Production Order</option>
                <?php endif; ?>
              </select>
            <?php } ?>
          <?php endif; ?>
        </td>
        <td width="8%">
          <h4>Group Shift</h4>
        </td>
        <td width="1%">:</td>
        <td width="3%">
          <select name="shift" id="shift" required>
            <option value="">Pilih</option>
            <option value="A" <?php if ($rw['shift'] == "A") {
                                echo "SELECTED";
                              } ?>>A</option>
            <option value="B" <?php if ($rw['shift'] == "B") {
                                echo "SELECTED";
                              } ?>>B</option>
            <option value="C" <?php if ($rw['shift'] == "C") {
                                echo "SELECTED";
                              } ?>>C</option>
          </select>
        </td>
        <td width="4%"><strong>Shift</strong></td>
        <td width="33%">:
          <select name="shift2" id="shift2" required="required">
            <option value="">Pilih</option>
            <option value="Pagi" <?php if ($rw['shift1'] == "Pagi") {
                                    echo "SELECTED";
                                  } ?>>Pagi</option>
            <option value="Siang" <?php if ($rw['shift1'] == "Siang") {
                                    echo "SELECTED";
                                  } ?>>Siang</option>
            <option value="Malam" <?php if ($rw['shift1'] == "Malam") {
                                    echo "SELECTED";
                                  } ?>>Malam</option>
          </select>
        </td>
      </tr>
      <tr>
        <td scope="row">
          <h4>Langganan/Buyer</h4>
        </td>
        <td>:</td>
        <td>
          <?php if ($cek > 0) {
            $langganan_buyer =  $ssr1['partnername'] . "/" . $ssr2['partnername'];
          } else {
            $langganan_buyer =  $rw['langganan'];
          } ?>
          <input name="buyer" type="text" id="buyer" size="45" value="<?= $langganan_buyer; ?>" />
        </td>
        <td>
          <h4>Tgl Brushing</h4>
        </td>
        <td>:</td>
        <td colspan="3"><input name="tgl" type="text" id="tgl" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl);return false;" size="10" placeholder="0000-00-00" required="required" value="<?php echo $rw['tgl_update']; ?>" />
          <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal" style="border:none" align="absmiddle" border="0" /></a>
        </td>
      </tr>
      <tr>
        <td scope="row">
          <h4>No. Order</h4>
        </td>
        <td>:</td>
        <td>
          <?php if ($cek > 0) {
            $no_order =  $ssr['documentno'];
          } else {
            $no_order =  $rw['no_order'];
          } ?>
          <input type="text" name="no_order" id="no_order" value="<?= $no_order; ?>" />
        </td>
        <td>
          <h4>Proses</h4>
        </td>
        <td>:</td>
        <td colspan="3"><select name="proses" id="proses">
            <option value="">Pilih</option>
            <?php $qry1 = mysqli_query($con, "SELECT proses,jns FROM tbl_proses ORDER BY id ASC");
            while ($r = mysqli_fetch_array($qry1)) {
            ?>
              <option value="<?php echo $r['proses'] . " (" . $r['jns'] . ")"; ?>" <?php if ($rw['proses'] == $r['proses'] . " (" . $r['jns'] . ")") {
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
          <?php if ($cek > 0) {
            $jk = $ssr['productcode'] . " / " . $ssr['description'];
          } else {
            $jk = $rw['jenis_kain'];
          } ?>
          <textarea name="jenis_kain" cols="35" id="jenis_kain"><?= $jk; ?></textarea>
        </td>
        <td valign="top">
          <h4>Keterangan</h4>
        </td>
        <td valign="top">:</td>
        <td colspan="3" valign="top"><textarea name="ket" cols="35" id="ket"><?php echo $rw['ket']; ?></textarea></td>
      </tr>
      <tr>
        <td scope="row">
          <h4>Warna</h4>
        </td>
        <td>:</td>
        <td>
          <?php if ($cek > 0) {
            $nama_warna = $ssr['color'];
          } else {
            $nama_warna = $rw['warna'];
          } ?>
          <input name="warna" type="text" id="warna" size="35" value="<?= $nama_warna; ?>" />
        </td>
        <td width="8%"><strong>Quantity</strong></td>
        <td width="1%">:</td>
        <td colspan="3">
          <?php if ($cLot > 0) {
            $berat = $sLot['Weight'];
          } else {
            $berat = $rw['qty'];
          } ?>
          <input name="qty" type="text" id="qty" size="5" value="<?= $berat; ?>" placeholder="0.00" />
        </td>
      </tr>
      <tr>
        <td scope="row">
          <h4>Lot</h4>
        </td>
        <td>:</td>
        <td><input name="lot" type="text" id="lot" size="5" value="<?php if ($cLot > 0) {
                                                                      echo $rowLot['TotalLot'] . "-" . $nomorLot;
                                                                    } else {
                                                                      echo $rw['lot'];
                                                                    } ?>" /></td>
        <td>
          <h4>Nama Mesin</h4>
        </td>
        <td>:</td>
        <td colspan="3"><select name="nama_mesin" id="nama_mesin" onchange="myFunction();" required="required">
            <option value="">Pilih</option>
            <?php $qry1 = mysqli_query($con, "SELECT nama FROM tbl_mesin ORDER BY nama ASC");
            while ($r = mysqli_fetch_array($qry1)) {
            ?>
              <option value="<?php echo $r['nama']; ?>" <?php if ($rw['nama_mesin'] == $r['nama']) {
                                                          echo "SELECTED";
                                                        } ?>><?php echo $r['nama']; ?></option>
            <?php } ?>
          </select>
          <input type="button" name="btnmesin2" id="btnmesin2" value="..." onclick="window.open('pages/mesin.php','MyWindow','height=400,width=650');" />
        </td>
      </tr>
      <tr>
        <td scope="row">
          <h4>Roll</h4>
        </td>
        <td>:</td>
        <td><input name="rol" type="text" id="rol" size="3" placeholder="0" pattern="[0-9]{1,}" value="<?php if ($cLot > 0) {
                                                                                                          echo $sLot['RollCount'];
                                                                                                        } else {
                                                                                                          echo $rw['rol'];
                                                                                                        } ?>" /></td>
        <td><strong>No. Mesin</strong></td>
        <td>:</td>
        <td colspan="3"><select name="no_mesin" id="no_mesin" onchange="myFunction();" required="required">
            <option value="">Pilih</option>
            <?php $qry1 = mysqli_query($con, "SELECT no_mesin FROM tbl_no_mesin ORDER BY no_mesin ASC");
            while ($r = mysqli_fetch_array($qry1)) {
            ?>
              <option value="<?php echo $r['no_mesin']; ?>" <?php if ($rw['no_mesin'] == $r['no_mesin']) {
                                                              echo "SELECTED";
                                                            } ?>><?php echo $r['no_mesin']; ?></option>
            <?php } ?>
          </select>
          <input type="button" name="btnmesin" id="btnmesin" value="..." onclick="window.open('pages/data-mesin.php','MyWindow','height=400,width=650');" />
        </td>
      </tr>
      <tr>
        <td scope="row">
          <h4>Proses In</h4>
        </td>
        <td>:</td>
        <td>
          <input name="proses_in" type="text" id="proses_in" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25" onkeyup="
            var time = this.value;
            if (time.match(/^\d{2}$/) !== null) {
              this.value = time + ':';
            } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
              this.value = time + '';
            }" value="<?php echo $rw['jam_in'] ?>" size="5" maxlength="5" />
          <input name="tgl_proses_m" type="text" id="tgl_proses_m" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_m);return false;" size="10" placeholder="0000-00-00" value="<?php echo $rw['tgl_proses_in']; ?>" />
          <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_m);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal2" style="border:none" align="absmiddle" border="0" /></a>
        </td>
        <td>
          <h4>Proses Out</h4>
        </td>
        <td>:</td>
        <td colspan="3">
          <input name="proses_out" type="text" id="proses_out" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
            var time = this.value;
            if (time.match(/^\d{2}$/) !== null) {
              this.value = time + ':';
            } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
              this.value = time + '';
            }" value="<?php echo $rw['jam_out'] ?>" size="5" maxlength="5" />
          <input name="tgl_proses_k" type="text" id="tgl_proses_k" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_k);return false;" value="<?php echo $rw['tgl_proses_out']; ?>" size="10" />
          <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_k);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal3" style="border:none" align="absmiddle" border="0" /></a>
        </td>
      </tr>
      <tr>
        <td scope="row">
          <h4>Mulai Stop Mesin</h4>
        </td>
        <td>:</td>
        <td>
          <input name="stop_mulai" type="text" id="stop_mulai" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
            var time = this.value;
            if (time.match(/^\d{2}$/) !== null) {
              this.value = time + ':';
            } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
              this.value = time + '';
            }" value="<?php echo $rw['stop_l'] ?>" size="5" maxlength="5" />
          <input name="tgl_stop_m" type="text" id="tgl_stop_m" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m);return false;" value="<?php echo $rw['tgl_stop_l']; ?>" size="10" />
          <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal4" style="border:none" align="absmiddle" border="0" /></a>
        </td>
        <td>
          <h4>Selesai Stop Mesin</h4>
        </td>
        <td>:</td>
        <td colspan="3">
          <input name="stop_selesai" type="text" id="stop_selesai" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
            var time = this.value;
            if (time.match(/^\d{2}$/) !== null) {
              this.value = time + ':';
            } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
              this.value = time + '';
            }" value="<?php echo $rw['stop_r'] ?>" size="5" maxlength="5" />
          <input name="tgl_stop_s" type="text" id="tgl_stop_s" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s);return false;" value="<?php echo $rw['tgl_stop_r']; ?>" size="10" />
          <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal5" style="border:none" align="absmiddle" border="0" /></a>
        </td>
      </tr>
      <tr>
        <td scope="row">
          <h4>Kode Stop</h4>
        </td>
        <td>:</td>
        <td><select name="kd_stop" id="kd_stop">
            <option value="">Pilih</option>
            <?php $qry1 = mysqli_query($con, "SELECT kode FROM tbl_stop_mesin ORDER BY id ASC");
            while ($r = mysqli_fetch_array($qry1)) {
            ?>
              <option value="<?php echo $r['kode']; ?>" <?php if ($rw['kd_stop'] == $r['kode']) {
                                                          echo "SELECTED";
                                                        } ?>><?php echo $r['kode']; ?></option>
            <?php } ?>
          </select>
          <input type="button" name="btnstop" id="btnstop" value="..." onclick="window.open('pages/data-stop.php','MyWindow','height=400,width=650');" />
        </td>
        <td>
          <h4>Operator</h4>
        </td>
        <td>:</td>
        <td colspan="3"><select name="acc_kain" id="acc_kain">
            <option value="">Pilih</option>
            <?php $qryacc = mysqli_query($con, "SELECT nama FROM tbl_staff ORDER BY id ASC");
            while ($racc = mysqli_fetch_array($qryacc)) {
            ?>
              <option value="<?php echo $racc['nama']; ?>" <?php if ($racc['nama'] == $rw['acc_staff']) {
                                                              echo "SELECTED";
                                                            } ?>><?php echo $racc['nama']; ?></option>
            <?php } ?>
          </select>
          <input type="button" name="btnacc" id="btnacc" value="..." onclick="window.open('pages/data-acc.php','MyWindow','height=400,width=650');" />
        </td>
      </tr>
      <tr>
        <td colspan="8" scope="row"><input type="submit" name="btnSimpan" id="btnSimpan" value="Simpan" class="art-button" />
          <input type="button" name="batal" id="batal" value="Batal" onclick="window.location.href='index.php'" class="art-button" />
          <input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='../index.php'" class="art-button" />
          <?php if ($_GET['idkk'] != "") { ?>
            <a href="pages/iden_produk.php?idkk=<?php if ($_GET['id'] != "") {
                                                  echo $rw['nokk'];
                                                } else {
                                                  echo $_GET['idkk'];
                                                } ?>" target="_blank" class="art-button">Cetak Identifikasi Produk</a>
          <?php } ?>
        </td>
      </tr>
    </table>
  </form>
</body>

</html>