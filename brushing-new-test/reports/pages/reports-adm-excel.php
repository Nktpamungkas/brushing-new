<?php
  ini_set("error_reporting", 1);
  header("Content-type: application/octet-stream");
  header("Content-Disposition: attachment; filename=report-adm-" . date($_GET['tgl1']) . ".xls"); //ganti nama sesuai keperluan
  header("Pragma: no-cache");
  header("Expires: 0");
  //disini script laporan anda
?>
<?php
  $con = mysqli_connect("10.0.0.10", "dit", "4dm1n", "db_brushing");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Laporan IN-OUT Kartu Kerja Finishing</title>
</head>

<body>
  <?php if ($_GET['jenis'] == "Kartu IN") { ?>
    <?php
      $tglawal = $_GET['tgl1'];
      $tglakhir = $_GET['tgl2'];
      $jns = $_GET['jenis'];
      $shft = $_GET['shift'];
      if ($tglakhir != "" and $tglawal != "") {
        $tgl = " DATE_FORMAT(`tgl_in`,'%Y-%m-%d') BETWEEN '$tglawal' AND '$tglakhir' ";
      } else {
        $tgl = " ";
      }
      if ($shft == "ALL") {
        $shift = " ";
      } else {
        $shift = " AND `shift1`='$shft' ";
      }
    ?>
    <form id="form1" name="form1" method="post" action="">
      <strong> Periode: <?php echo $tglawal; ?> s/d <?php echo $tglakhir; ?></strong><br />
      <strong>Shift: <?php echo $shft; ?></strong>
      <strong><br />
        Kartu Kerja IN</strong>
      <table width="100%" border="0">
        <tr style="border:1px solid;">
          <td bgcolor="#99FF99" style="border:1px solid; vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">NO.</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">TGL MASUK</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">JAM MASUK</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">GROUP SHIFT</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">SHIFT</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">NOKK</font>
              </strong></div>
          </td>
          <th width="4%" style="border-right: 1px solid;border-left: 1px solid;">
            <div align="center"><strong>
                <font size="-2">NO DEMAND</font>
              </strong></div>
          </th>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">LANGGANAN</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">BUYER</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">ORDER</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">HANGER</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">JENIS KAIN</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">NO WARNA</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">WARNA</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">LOT</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">ROLL</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">QTY (Kg)</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">QTY (yard)</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">PROSES</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">JENIS KK</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">CATATAN</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">Jumlah Gerobak IN</font>
              </strong></div>
          </td>
        </tr>
        <?php
          $sql = mysqli_query($con, " SELECT 
                                    *,`id` as `idp`,
                                    SUBSTR(langganan, LOCATE('/', langganan)+1)	AS buyer
                                  FROM
                                    `tbl_adm`
                                  WHERE
                                    `status`='1' AND " . $tgl . $shift . " ORDER BY `tgl_in` ASC ");
          $no = 1;

          $c = 0;
          while ($rowd = mysqli_fetch_array($sql)) {
            $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
        ?>
          <tr style="border:1px solid;">
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $no; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo date('Y-m-d', strtotime($rowd['tgl_in'])); ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo date('H:i', strtotime($rowd['tgl_in'])); ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['shift']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['shift1']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2">`<?php echo $rowd['nokk']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2">`<?php echo $rowd['nodemand']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><b title="<?php echo $rowd['langganan']; ?>"><?php echo substr($rowd['langganan'], 0, 20) . ".."; ?></b></font>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><b title="<?= $rowd['buyer']; ?>"><?= $rowd['buyer']; ?></b></font>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><?php echo $rowd['no_order']; ?></font>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['no_item']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><b title="<?php echo $rowd['jenis_kain']; ?>"><?php echo substr($rowd['jenis_kain'], 0, 20) . ".."; ?></b></font>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['no_warna'], 0, 10) . ".."; ?></b></font>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['warna'], 0, 10) . ".."; ?></b></font>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['lot']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['rol']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['qty']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['panjang']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><?php echo $rowd['proses']; ?></font>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><?php echo $rowd['kondisi_kain']; ?></font>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><?php echo $rowd['catatan']; ?></font>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><?php echo $rowd['jumlah_gerobak_in']; ?></font>
            </td>
          </tr>
        <?php
          $totqty = $totqty + $rowd['rol'];
          $totberat = $totberat + $rowd['qty'];
          $totyard = $totyard + $rowd['panjang'];
          $no++;
        } ?>
        <tr style="border:1px solid;">
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
        </tr>
        <tr style="border:1px solid;">
          <td colspan="10" bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99"><strong>Total</strong></td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99"><strong><?php echo $totqty; ?></strong></td>
          <td bgcolor="#99FF99"><strong><?php echo $totberat; ?></strong></td>
          <td bgcolor="#99FF99"><strong><?php echo $totyard; ?></strong></td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
        </tr>
      </table>
    </form>
  <?php } else if ($_GET['jenis'] == "Kartu OUT") { ?>
    <?php
      $tglawal = $_GET['tgl1'];
      $tglakhir = $_GET['tgl2'];
      $jns = $_GET['jenis'];
      $shft = $_GET['shift'];
      if ($tglakhir != "" and $tglawal != "") {
        $tgl = " DATE_FORMAT(`tgl_out`,'%Y-%m-%d') BETWEEN '$tglawal' AND '$tglakhir' ";
      } else {
        $tgl = " ";
      }
      if ($shft == "ALL") {
        $shift = " ";
      } else {
        $shift = " AND `shift1_out`='$shft' ";
      }
    ?>
    <form id="form1" name="form1" method="post" action="">
      <strong> Periode: <?php echo $tglawal; ?> s/d <?php echo $tglakhir; ?></strong><br />
      <strong>Shift: <?php echo $shft; ?></strong>
      <strong><br />
        Kartu Kerja OUT</strong>
      <table width="100%" border="0">
        <tr style="border:1px solid;">
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid; vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">NO.</font>
              </strong></div>
          </td>
          <td colspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">MASUK</font>
              </strong></div>
          </td>
          <td colspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">KELUAR</font>
              </strong></div>
          </td>
          <td colspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2"> MASUK</font>
              </strong></div>
          </td>
          <td colspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">KELUAR</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">NOKK</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">NO DEMAND</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">LANGGANAN</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">BUYER</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">ORDER</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">HANGER</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">JENIS KAIN</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">NO WARNA</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">WARNA</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">LOT</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">ROLL</font>
              </strong></div>
          </td>
          <td colspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">QTY</font>
              </strong></div>
          </td>
          <td colspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">TOTAL</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">JENIS KK</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">PROSES</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">CATATAN</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">PROSES DEPT. BERIKUTNYA</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">Jumlah Gerobak OUT</font>
              </strong></div>
          </td>
        </tr>
        <tr style="border:1px solid;">
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">TGL MASUK</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">JAM MASUK</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">TGL KELUAR</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">JAM KELUAR</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">GROUP SHIFT</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">SHIFT</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">GROUP SHIFT</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">SHIFT KELUAR</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">(Kg)</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">(yard)</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2"> JAM</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2"> HARI</font>
              </strong></div>
          </td>
        </tr>
        <?php
          $sql = mysqli_query($con, " SELECT 
                                        *,`id` as `idp`,DATEDIFF(tgl_out,tgl_in) as 'Hari', TIMEDIFF(tgl_out,tgl_in) as 'Jam',
                                        SUBSTR(langganan, LOCATE('/', langganan)+1)	AS buyer 
                                      FROM
                                        `tbl_adm`
                                      WHERE
                                        `status`='2' AND " . $tgl . $shift . " ORDER BY `tgl_in` ASC ");
                                              $no = 1;

          $c = 0;
          while ($rowd = mysqli_fetch_array($sql)) {
            $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
        ?>
        <tr style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo $no; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo date('Y-m-d', strtotime($rowd['tgl_in'])); ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo date('H:i', strtotime($rowd['tgl_in'])); ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo date('Y-m-d', strtotime($rowd['tgl_out'])); ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo date('H:i', strtotime($rowd['tgl_out'])); ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo $rowd['shift']; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo $rowd['shift1']; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo $rowd['shift_out']; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo $rowd['shift1_out']; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2">`<?php echo $rowd['nokk']; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2">`<?php echo $rowd['nodemand']; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <font size="-2"><b title="<?php echo $rowd['langganan']; ?>"><?php echo substr($rowd['langganan'], 0, 20) . ".."; ?></b></font>
          </td>
          <td style="border:1px solid;">
            <font size="-2"><b title="<?= $rowd['buyer']; ?>"><?= $rowd['buyer']; ?></b></font>
          </td>
          <td style="border:1px solid;">
            <font size="-2"><?php echo $rowd['no_order']; ?></font>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo $rowd['no_item']; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <font size="-2"><b title="<?php echo $rowd['jenis_kain']; ?>"><?php echo substr($rowd['jenis_kain'], 0, 20) . ".."; ?></b></font>
          </td>
          <td style="border:1px solid;">
            <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['no_warna'], 0, 10) . ".."; ?></b></font>
          </td>
          <td style="border:1px solid;">
            <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['warna'], 0, 10) . ".."; ?></b></font>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo $rowd['lot']; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo $rowd['rol']; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo $rowd['qty']; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo $rowd['panjang']; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php
                              $awal  = strtotime($rowd['tgl_in']);
                              $akhir = strtotime($rowd['tgl_out']);
                              $diff  = $akhir - $awal;

                              $jam   = floor($diff / (60 * 60));
                              $menit = $diff - $jam * (60 * 60);
                              $tjam   = round($diff / (60 * 60), 2);
                              $hari   = round($tjam / 24, 2);
                              echo '' . $jam .  'H, ' . floor($menit / 60) . 'M'; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo $hari; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <font size="-2"><?php echo $rowd['kondisi_kain']; ?></font>
          </td>
          <td style="border:1px solid;">
            <font size="-2"><?php echo $rowd['proses']; ?></font>
          </td>
          <td style="border:1px solid;">
            <font size="-2"><?php echo $rowd['catatan']; ?></font>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <font size="-2"><?php echo $rowd['tujuan']; ?></font>
            </div>
          </td>
          <td style="border:1px solid;">
            <font size="-2"><?php echo $rowd['jumlah_gerobak_out']; ?></font>
          </td>
        </tr>
        <?php
          $totqty = $totqty + $rowd['rol'];
          $totberat = $totberat + $rowd['qty'];
          $totyard = $totyard + $rowd['panjang'];
          $totjam = $totjam + $diff;
          $tothari = $tothari + $hari;
          $no++;
        } ?>
        <tr style="border:1px solid;">
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
        </tr>
        <tr style="border:1px solid;">
          <td colspan="14" bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99"><strong>Total</strong></td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99"><strong><?php echo $totqty; ?></strong></td>
          <td bgcolor="#99FF99"><strong><?php echo $totberat; ?></strong></td>
          <td bgcolor="#99FF99"><strong><?php echo $totyard; ?></strong></td>
          <td bgcolor="#99FF99"><?php $jam1   = floor($totjam / (60 * 60));
                                $menit1 = $totjam - $jam1 * (60 * 60);
                                echo '' . $jam1 .  'H, ' . floor($menit1 / 60) . 'M'; ?></td>
          <td bgcolor="#99FF99"><strong><?php echo $tothari; ?></strong></td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
        </tr>
      </table>
    </form>
  <?php } else { ?>
    <?php
      $tglawal = $_GET['tgl1'];
      $tglakhir = $_GET['tgl2'];
      $jns = $_GET['jenis'];
      $shft = $_GET['shift'];
      if ($tglakhir != "" and $tglawal != "") {
        $tgl = " DATE_FORMAT(`tgl_in`,'%Y-%m-%d') BETWEEN '$tglawal' AND '$tglakhir' ";
      } else {
        $tgl = " ";
      }
      if ($shft == "ALL") {
        $shift = " ";
      } else {
        $shift = " AND `shift1_out`='$shft' ";
      }
      if ($jns != "") {
        $jkk = " AND `kondisi_kain`='$jns' ";
      } else {
        $jkk = "";
      }
    ?>
    <form id="form1" name="form1" method="post" action="">
      <strong> Periode: <?php echo $tglawal; ?> s/d <?php echo $tglakhir; ?></strong><br />
      <strong>Shift: <?php echo $shft; ?></strong>
      <strong><br />
        <?php //echo $jns; 
        ?>Detail Kartu Kerja IN</strong>
      <table width="100%" border="0">
        <tr style="border:1px solid;">
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid; vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">NO.</font>
              </strong></div>
          </td>
          <td colspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">MASUK</font>
              </strong></div>
          </td>
          <td colspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">KELUAR</font>
              </strong></div>
          </td>
          <td colspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2"> MASUK</font>
              </strong></div>
          </td>
          <td colspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">KELUAR</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">NOKK</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">NO DEMAND</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">LANGGANAN</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">BUYER</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">ORDER</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">HANGER</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">JENIS KAIN</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">NO WARNA</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">WARNA</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">LOT</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">ROLL</font>
              </strong></div>
          </td>
          <td colspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">QTY</font>
              </strong></div>
          </td>
          <td colspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">TOTAL</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">JENIS KK</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">PROSES</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">CATATAN</font>
              </strong></div>
          </td>
          <td rowspan="2" bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">PROSES DEPT. BERIKUTNYA</font>
              </strong></div>
          </td>
        </tr>
        <tr style="border:1px solid;">
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">TGL MASUK</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">JAM MASUK</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">TGL KELUAR</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">JAM KELUAR</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">GROUP SHIFT</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">SHIFT</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">GROUP SHIFT</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">SHIFT KELUAR</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">(Kg)</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2">(yard)</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2"> JAM</font>
              </strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;vertical-align:middle;">
            <div align="center"><strong>
                <font size="-2"> HARI</font>
              </strong></div>
          </td>
        </tr>
        <?php
          $sql = mysqli_query($con, " SELECT 
                                  *,`id` as `idp`,DATEDIFF(tgl_out,tgl_in) as 'Hari', TIMEDIFF(tgl_out,tgl_in) as 'Jam',
                                    SUBSTR(langganan, LOCATE('/', langganan)+1)	AS buyer
                                FROM
                                  `tbl_adm`
                                WHERE
                                  (`status`='1' OR `status`='2') AND " . $tgl . $shift . " ORDER BY `tgl_in` ASC ");
          $no = 1;

          $c = 0;
          while ($rowd = mysqli_fetch_array($sql)) {
            $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
        ?>
          <tr style="border:1px solid;">
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $no; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo date('Y-m-d', strtotime($rowd['tgl_in'])); ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo date('H:i', strtotime($rowd['tgl_in'])); ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php if ($rowd['tgl_out'] != "") {
                                  echo date('Y-m-d', strtotime($rowd['tgl_out']));
                                } ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php if ($rowd['tgl_out'] != "") {
                                  echo date('H:i', strtotime($rowd['tgl_out']));
                                } ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['shift']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['shift1']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['shift_out']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['shift1_out']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2">`<?php echo $rowd['nokk']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2">`<?php echo $rowd['nodemand']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><b title="<?php echo $rowd['langganan']; ?>"><?php echo substr($rowd['langganan'], 0, 20) . ".."; ?></b></font>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><b title="<?= $rowd['buyer']; ?>"><?= $rowd['buyer']; ?></b></font>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><?php echo $rowd['no_order']; ?></font>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['no_item']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><b title="<?php echo $rowd['jenis_kain']; ?>"><?php echo substr($rowd['jenis_kain'], 0, 20) . ".."; ?></b></font>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['no_warna'], 0, 10) . ".."; ?></b></font>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['warna'], 0, 10) . ".."; ?></b></font>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2">'<?php echo $rowd['lot']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['rol']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['qty']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['panjang']; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php
                                $awal  = strtotime($rowd['tgl_in']);
                                $akhir = strtotime($rowd['tgl_out']);
                                $diff  = $akhir - $awal;

                                $jam   = floor($diff / (60 * 60));
                                $menit = $diff - $jam * (60 * 60);
                                $tjam   = round($diff / (60 * 60), 2);
                                $hari   = round($tjam / 24, 2);
                                echo '' . $jam .  'H, ' . floor($menit / 60) . 'M'; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $hari; ?></font>
              </div>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><?php echo $rowd['kondisi_kain']; ?></font>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><?php echo $rowd['proses']; ?></font>
            </td>
            <td style="border:1px solid;">
              <font size="-2"><?php echo $rowd['catatan']; ?></font>
            </td>
            <td style="border:1px solid;">
              <div align="center">
                <font size="-2"><?php echo $rowd['tujuan']; ?></font>
              </div>
            </td>
          </tr>
        <?php
          $totqty = $totqty + $rowd['rol'];
          $totberat = $totberat + $rowd['qty'];
          $totyard = $totyard + $rowd['panjang'];
          $totjam = $totjam + $diff;
          $tothari = $tothari + $hari;
          $no++;
        } ?>
        <tr style="border:1px solid;">
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
        </tr>
        <tr style="border:1px solid;">
          <td colspan="14" bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99"><strong>Total</strong></td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99"><strong><?php echo $totqty; ?></strong></td>
          <td bgcolor="#99FF99"><strong><?php echo $totberat; ?></strong></td>
          <td bgcolor="#99FF99"><strong><?php echo $totyard; ?></strong></td>
          <td bgcolor="#99FF99"><?php $jam1   = floor($totjam / (60 * 60));
                                $menit1 = $totjam - $jam1 * (60 * 60);
                                echo '' . $jam1 .  'H, ' . floor($menit1 / 60) . 'M'; ?></td>
          <td bgcolor="#99FF99"><strong><?php echo $tothari; ?></strong></td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
          <td bgcolor="#99FF99">&nbsp;</td>
        </tr>
      </table>
    </form>
  <?php } ?>

</body>

</html>