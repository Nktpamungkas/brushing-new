<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
</head>

<body>
<?php
function nourut(){
$format = date("ymd");
$sql=mysql_query("SELECT nokk FROM tbl_produksi WHERE substr(nokk,1,6) like '%".$format."%' ORDER BY nokk DESC LIMIT 1 ") or die (mysql_error());
$d=mysql_num_rows($sql);
if($d>0){
$r=mysql_fetch_array($sql);
$d=$r['nokk'];
$str=substr($d,6,2);
$Urut = (int)$str;
}else{
$Urut = 0;
}
$Urut = $Urut + 1;
$Nol="";
$nilai=2-strlen($Urut);
for ($i=1;$i<=$nilai;$i++){
$Nol= $Nol."0";
}
$nipbr =$format.$Nol.$Urut;
return $nipbr;
}
$nou=nourut();
if($_REQUEST['kk']!='')
    {$idkk="";}else{$idkk=$_GET['idkk'];}
   
   if($idkk!="")   {
    date_default_timezone_set('Asia/Jakarta');
    $qry=mysql_query("SELECT * FROM tbl_produksi WHERE nokk='$idkk' ORDER BY id DESC LIMIT 1");
	$rw=mysql_fetch_array($qry);
	$rc=mysql_num_rows($qry);
    $tglsvr= mssql_query("select CONVERT(VARCHAR(10),GETDATE(),105) AS  tgk",$conn);
    $sr=mssql_fetch_array($tglsvr);
	
	$sqlLot=mssql_query(" SELECT
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
				x.SODID, x.PCBID ",$conn);
	   $sLot=mssql_fetch_array($sqlLot);
	   $cLot=mssql_num_rows($sqlLot);
	   $child=$sLot[ChildLevel];
		
		if($child > 0){
			$sqlgetparent=mssql_query("select ID,LotNo from ProcessControlBatches where ID='$sLot[RootID]' and ChildLevel='0'");
			$rowgp=mssql_fetch_assoc($sqlgetparent);
			
			//$nomLot=substr("$row2[LotNo]",0,1);
			$nomLot=$rowgp[LotNo];
			$nomorLot="$nomLot/K$sLot[ChildLevel]&nbsp;";				
								
		}else{
			$nomorLot=$sLot[LotNo];
				
		}
	   
		$sqlLot1="Select count(*) as TotalLot From ProcessControlBatches where PCID='$sLot[PCID]' and RootID='0' and LotNo < '1000'";
		$qryLot1 = mssql_query($sqlLot1) or die('A error occured : ');							
		$rowLot=mssql_fetch_assoc($qryLot1);	
							
    $sqls=mssql_query("select processcontrolJO.SODID,salesorders.ponumber,processcontrol.productid,salesorders.customerid,joborders.documentno,
    salesorders.buyerid,processcontrolbatches.lotno,productcode,productmaster.color,colorno,description,weight,cuttablewidth from Joborders 
    left join processcontrolJO on processcontrolJO.joid = Joborders.id
    left join salesorders on soid= salesorders.id
    left join processcontrol on processcontrolJO.pcid = processcontrol.id
    left join processcontrolbatches on processcontrolbatches.pcid = processcontrol.id
    left join productmaster on productmaster.id= processcontrol.productid
    left join productpartner on productpartner.productid= processcontrol.productid
    where processcontrolbatches.documentno='$idkk'",$conn);
            $ssr=mssql_fetch_array($sqls);
			$cek=mssql_num_rows($sqls);
            $lgn1=mssql_query("select partnername from partners where id='$ssr[customerid]'",$conn);
            $ssr1=mssql_fetch_array($lgn1);
            $lgn2=mssql_query("select partnername from partners where id='$ssr[buyerid]'",$conn);
            $ssr2=mssql_fetch_array($lgn2);
   }
     //
     
     ?>
     
     <?php

if(isset($_POST['btnSimpan']) and $_POST[proses]!=$rw[proses]){
		if($_POST[nokk]!=""){
		$nokk=$_POST[nokk];
		$idkk=$_POST[nokk];
		}else{$nokk=$nou;$idkk=$nou;}
		$shift=$_POST[shift];
	    $shift1=$_POST[shift2];
		$langganan=$_POST[buyer];
		$order=$_POST[no_order];
		$jenis_kain=str_replace("'","",$_POST[jenis_kain]);
		$warna=str_replace("'","",$_POST[warna]);
		$lot=$_POST[lot];
		$qty=$_POST[qty];
		$rol=$_POST[rol];
		$mesin=$_POST[no_mesin];
		$nmmesin=$_POST[nama_mesin];
		$proses=$_POST[proses];
		$jam_in=$_POST[proses_in];
		$jam_out=$_POST[proses_out];
		$proses_jam=$_POST[proses_jam];
		$proses_menit=$_POST[proses_menit];
		$tgl_proses_in=$_POST[tgl_proses_m];
		$tgl_proses_out=$_POST[tgl_proses_k];
		$mulai=$_POST[stop_mulai];
		$selesai=$_POST[stop_selesai];
		$stop_jam=$_POST[stop_jam];
		$stop_menit=$_POST[stop_menit];
		$tgl_stop_m=$_POST[tgl_stop_m];
		$tgl_stop_s=$_POST[tgl_stop_s];
		$kd=$_POST[kd_stop];
		$tgl=$_POST[tgl];
		$acc_kain=str_replace("'","",$_POST[acc_kain]);	
		$ket=str_replace("'","",$_POST[ket]);
	$simpanSql = "INSERT INTO tbl_produksi SET 
	`nokk`='$nokk',
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
		mysql_query($simpanSql) or die ("Gagal Simpan".mysql_error());
		
		// Refresh form
		echo "<meta http-equiv='refresh' content='0; url=?idkk=$idkk&status=Data Sudah DiSimpan'>";
	}else if(isset($_POST['btnSimpan']) and $_POST[proses]==$rw[proses]){
		$langganan=$_POST[buyer];
		$order=$_POST[no_order];
		$jenis_kain=str_replace("'","",$_POST[jenis_kain]);
		$warna=str_replace("'","",$_POST[warna]);
		$lot=$_POST[lot];
		$qty=$_POST[qty];
		$rol=$_POST[rol];
		$mesin=$_POST[no_mesin];
	    $nmmesin=$_POST[nama_mesin];
		$proses=$_POST[proses];
		$shift=$_POST[shift];
		$shift1=$_POST[shift2];
		$jam_in=$_POST[proses_in];
		$jam_out=$_POST[proses_out];
		$proses_jam=$_POST[proses_jam];
		$proses_menit=$_POST[proses_menit];
		$tgl_proses_in=$_POST[tgl_proses_m];
		$tgl_proses_out=$_POST[tgl_proses_k];
		$mulai=$_POST[stop_mulai];
		$selesai=$_POST[stop_selesai];
		$stop_jam=$_POST[stop_jam];
		$stop_menit=$_POST[stop_menit];
		$tgl_stop_m=$_POST[tgl_stop_m];
		$tgl_stop_s=$_POST[tgl_stop_s];
		$kd=$_POST[kd_stop];
		$tgl=$_POST[tgl];
		$acc_kain=str_replace("'","",$_POST[acc_kain]);
		$ket=str_replace("'","",$_POST[ket]);
	$simpanSql = "UPDATE tbl_produksi SET 
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
		mysql_query($simpanSql) or die ("Gagal Ubah".mysql_error());
		
		// Refresh form
		echo "<meta http-equiv='refresh' content='0; url=?idkk=$idkk&status=Data Sudah DiUbah'>";
	}
	?>
<form id="form1" name="form1" method="post" action="" >
  <table width="100%" border="0">
    <tr>
      <td colspan="8" scope="row"><h1>Input Data Produksi Harian Brushing</h1></td>
    </tr>
    <tr>
      <th colspan="8" scope="row"><font color="#FF0000"><?php echo $_GET['status'];?></font></th>
    </tr>
    <tr>
      <td width="10%" scope="row"><h4>Nokk</h4></td>
      <td width="1%">:</td>
      <td width="30%"><input name="nokk" type="text" id="nokk" size="17" onchange="window.location='?idkk='+this.value" value="<?php echo $_GET[idkk];?>"/><input type="hidden"  value="<?php echo $rw[id];?>" name="id"/></td>
      <td width="8%"><h4>Group Shift</h4></td>
      <td width="1%">:</td>
      <td width="13%"><select name="shift" id="shift" required>
          <option value="">Pilih</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
      </select></td>
      <td width="4%"><strong>Shift</strong></td>
      <td width="33%">:
        <select name="shift2" id="shift2" required="required">
          <option value="">Pilih</option>
          <option value="Pagi">Pagi</option>
          <option value="Siang">Siang</option>
          <option value="Malam">Malam</option>
      </select></td>
    </tr>
    <tr>
      <td scope="row"><h4>Langganan/Buyer</h4></td>
      <td>:</td>
      <td><input name="buyer" type="text" id="buyer" size="45" value="<?php if($cek>0){echo $ssr1['partnername']."/".$ssr2['partnername'];}else{echo $rw[langganan];}?>"/></td>
      <td><h4>Tgl Brushing</h4></td>
      <td>:</td>
      <td colspan="3"><input name="tgl" type="text" id="tgl" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl);return false;" size="10" placeholder="0000-00-00" required="required"/>
        <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
    </tr>
    <tr>
      <td scope="row"><h4>No. Order</h4></td>
      <td>:</td>
      <td><input type="text" name="no_order" id="no_order" value="<?php if($cek>0){echo $ssr['documentno'];}else{echo $rw[no_order];}?>"/>
      </td>
      <td><h4>Proses</h4></td>
      <td>:</td>
      <td colspan="3"><select name="proses" id="proses">
          <option value="">Pilih</option>
          <?php $qry1=mysql_query("SELECT proses,jns FROM tbl_proses ORDER BY id ASC"); 
		while($r=mysql_fetch_array($qry1)){
		?>
          <option value="<?php echo $r[proses]." (".$r[jns].")";?>" <?php if($rw[proses]==$r[proses]." (".$r[jns].")"){echo "SELECTED";}?>><?php echo $r[proses]." (".$r[jns].")";?></option>
          <?php } ?>
        </select>
        <input type="button" name="btnproses" id="btnproses" value="..."  onclick="window.open('pages/data-proses.php','MyWindow','height=400,width=650');"/></td>
    </tr>
    <tr>
      <td valign="top" scope="row"><h4>Jenis Kain</h4></td>
      <td valign="top">:</td>
      <td><textarea name="jenis_kain" cols="35" id="jenis_kain"><?php if($cek>0){echo $ssr['productcode']." / ".$ssr['description'];}else{echo $rw[jenis_kain];}?></textarea></td>
      <td valign="top"><h4>Keterangan</h4></td>
      <td valign="top">:</td>
      <td colspan="3" valign="top"><textarea name="ket" cols="35" id="ket"><?php echo $rw[ket];?></textarea></td>
    </tr>
    <tr>
      <td scope="row"><h4>Warna</h4></td>
      <td>:</td>
      <td><input name="warna" type="text" id="warna" size="35" value="<?php if($cek>0){echo $ssr['color'];}else{echo $rw[warna];}?>"/></td>
      <td width="8%"><strong>Quantity</strong></td>
      <td width="1%">:</td>
      <td colspan="3"><input name="qty" type="text" id="qty" size="5" value="<?php if($cLot>0){echo $sLot[Weight];}else{echo $rw[qty];}?>" placeholder="0.00" /></td>
    </tr>
    <tr>
      <td scope="row"><h4>Lot</h4></td>
      <td>:</td>
      <td><input name="lot" type="text" id="lot" size="5" value="<?php if($cLot>0){echo $rowLot[TotalLot]."-".$nomorLot;}else{echo $rw[lot];}?>"/></td>
      <td><h4>Nama Mesin</h4></td>
      <td>:</td>
      <td colspan="3"><select name="nama_mesin" id="nama_mesin" onchange="myFunction();" required="required">
        <option value="">Pilih</option>
        <?php $qry1=mysql_query("SELECT nama FROM tbl_mesin ORDER BY nama ASC"); 
		while($r=mysql_fetch_array($qry1)){
		?>
        <option value="<?php echo $r[nama];?>" <?php if($rw[nama_mesin]==$r[nama]){echo "SELECTED";}?> ><?php echo $r[nama];?></option>
        <?php } ?>
      </select>
      <input type="button" name="btnmesin2" id="btnmesin2" value="..."  onclick="window.open('pages/mesin.php','MyWindow','height=400,width=650');"/></td>
    </tr>
    <tr>
      <td scope="row"><h4>Roll</h4></td>
      <td>:</td>
      <td><input name="rol" type="text" id="rol" size="3" placeholder="0" pattern="[0-9]{1,}" value="<?php if($cLot>0){echo $sLot[RollCount];}else{ echo $rw[rol];}?>" /></td>
      <td><strong>No. Mesin</strong></td>
      <td>:</td>
      <td colspan="3"><select name="no_mesin" id="no_mesin" onchange="myFunction();" required="required">
        <option value="">Pilih</option>
        <?php $qry1=mysql_query("SELECT no_mesin FROM tbl_no_mesin ORDER BY no_mesin ASC"); 
		while($r=mysql_fetch_array($qry1)){
		?>
        <option value="<?php echo $r[no_mesin];?>" <?php if($rw[no_mesin]==$r[no_mesin]){echo "SELECTED";}?> ><?php echo $r[no_mesin];?></option>
        <?php } ?>
      </select>
      <input type="button" name="btnmesin" id="btnmesin" value="..."  onclick="window.open('pages/data-mesin.php','MyWindow','height=400,width=650');"/></td>
    </tr>
    <tr>
      <td scope="row"><h4>Proses In</h4></td>
      <td>:</td>
      <td><input name="proses_in" type="text" id="proses_in"  placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25" onkeyup="
  var time = this.value;
  if (time.match(/^\d{2}$/) !== null) {
     this.value = time + ':';
  } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
     this.value = time + '';
  }" value="<?php echo $rw[jam_in]?>" size="5" maxlength="5" />
        <input name="tgl_proses_m" type="text" id="tgl_proses_m" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_m);return false;" size="10" placeholder="0000-00-00" value="<?php echo $rw[tgl_proses_in];?>" />
        <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_m);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal2" style="border:none" align="absmiddle" border="0" /></a></td>
      <td><h4>Proses Out</h4></td>
      <td>:</td>
      <td colspan="3"><input name="proses_out" type="text" id="proses_out"  placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
  var time = this.value;
  if (time.match(/^\d{2}$/) !== null) {
     this.value = time + ':';
  } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
     this.value = time + '';
  }" value="<?php echo $rw[jam_out]?>" size="5" maxlength="5" />
        <input name="tgl_proses_k" type="text" id="tgl_proses_k" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_k);return false;" value="<?php echo $rw[tgl_proses_out]; ?>" size="10"/>
        <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_k);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal3" style="border:none" align="absmiddle" border="0" /></a></td>
    </tr>
    <tr>
      <td scope="row"><h4>Mulai Stop Mesin</h4></td>
      <td>:</td>
      <td><input name="stop_mulai" type="text" id="stop_mulai"  placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
  var time = this.value;
  if (time.match(/^\d{2}$/) !== null) {
     this.value = time + ':';
  } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
     this.value = time + '';
  }" value="<?php echo $rw[stop_l]?>" size="5" maxlength="5" />
        <input name="tgl_stop_m" type="text" id="tgl_stop_m" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m);return false;" value="<?php echo $rw[tgl_stop_l];?>" size="10" />
      <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_m);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal4" style="border:none" align="absmiddle" border="0" /></a></td>
      <td><h4>Selesai Stop Mesin</h4></td>
      <td>:</td>
      <td colspan="3"><input name="stop_selesai" type="text" id="stop_selesai"  placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
  var time = this.value;
  if (time.match(/^\d{2}$/) !== null) {
     this.value = time + ':';
  } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
     this.value = time + '';
  }" value="<?php echo $rw[stop_r]?>" size="5" maxlength="5" />
        <input name="tgl_stop_s" type="text" id="tgl_stop_s" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s);return false;" value="<?php echo $rw[tgl_stop_r];?>" size="10"/>
        <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_stop_s);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal5" style="border:none" align="absmiddle" border="0" /></a></td>
    </tr>
    <tr>
      <td scope="row"><h4>Kode Stop</h4></td>
      <td>:</td>
      <td><select name="kd_stop" id="kd_stop">
        <option value="">Pilih</option>
        <?php $qry1=mysql_query("SELECT kode FROM tbl_stop_mesin ORDER BY id ASC"); 
		while($r=mysql_fetch_array($qry1)){
		?>
        <option value="<?php echo $r[kode];?>" <?php if($rw[kd_stop]==$r[kode]){echo "SELECTED";}?>><?php echo $r[kode];?></option>
        <?php } ?>
        </select>
      <input type="button" name="btnstop" id="btnstop" value="..."  onclick="window.open('pages/data-stop.php','MyWindow','height=400,width=650');"/></td>
      <td><h4>Operator</h4></td>
      <td>:</td>
      <td colspan="3"><select name="acc_kain" id="acc_kain">
        <option value="">Pilih</option>
        <?php $qryacc=mysql_query("SELECT nama FROM tbl_staff ORDER BY id ASC"); 
		while($racc=mysql_fetch_array($qryacc)){
		?>
        <option value="<?php echo $racc[nama];?>" <?php if($racc[nama]==$rw[acc_staff]){echo "SELECTED";}?>><?php echo $racc[nama];?></option>
        <?php } ?>
      </select>
      <input type="button" name="btnacc" id="btnacc" value="..."  onclick="window.open('pages/data-acc.php','MyWindow','height=400,width=650');"/></td>
    </tr>
    <tr>
      <td colspan="8" scope="row"><input type="submit" name="btnSimpan" id="btnSimpan" value="Simpan" class="art-button"/>
        <input type="button" name="batal" id="batal" value="Batal" onclick="window.location.href='index.php'" class="art-button"/>
      <input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='../index.php'" class="art-button"/></td>
    </tr>
  </table>
</form>
</body>
</html>