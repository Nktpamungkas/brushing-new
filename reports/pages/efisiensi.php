<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Laporan Efisiensi Harian Brushing</title>
  <link rel="stylesheet" type="text/css" href="../css/datatable.css" />
  <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" />
  <script src="../js/jquery.js" type="text/javascript"></script>
  <script src="../js/jquery.dataTables.js" type="text/javascript"></script>
  <script>
    function confirmDelete(url) {
      if (confirm("Yakin Hapus data ini?")) {
        window.location.href = url;
      } else {
        false;
      }
    }
    $(document).ready(function() {
      $('#datatables').dataTable({
        "sScrollY": "300px",
        "sScrollX": "100%",
        "bScrollCollapse": true,
        "bPaginate": false,
        "bJQueryUI": true
      });
    })
  </script>
</head>

<body>
  <?php
  ini_set("error_reporting", 1);
  session_start();
  include("../../koneksi.php");
  ?>

    <?php
    if ($_POST['awal'] != "") {
      $tglawal = $_POST['awal'];
      $tglakhir = $_POST['akhir'];
      $jns = $_POST['jns'];
      $mc = $_POST['no_mesin'];
      $nmesin = $_POST['nama_mesin'];
	  $opr = $_POST['acc_kain'];	
    } else {
      $tglawal = $_GET['tgl1'];
      $tglakhir = $_GET['tgl2'];
      $jns = $_GET['jns'];
      $mc = $_GET['no_mesin'];
      $nmesin = $_GET['nama_mesin'];
    }
    if ($_POST['shift'] != "") {
      $shft = $_POST['shift'];
    } else {
      $shft = $_GET['shift'];
    }
    if ($tglakhir != "" and $tglawal != "") {
      $tgl = " DATE_FORMAT(a.`tgl_update`,'%Y-%m-%d') BETWEEN '$tglawal' AND '$tglakhir' ";
    } else {
      $tgl = " ";
    }
    if ($shft == "ALL") {
      $shift = " ";
    } else {
      $shift = " AND a.`shift`='$shft' ";
    }
    if ($nmesin != "ALL") {
      $mesin = " AND a.`nama_mesin`='$nmesin'";
    } else {
      $mesin = " ";
    }
    if ($mc != "ALL") {
      $nomesin = " AND a.`no_mesin`='$mc'";
    } else if ($mc == "ALL") {
      $nomesin = " ";
    } else {
      $nomesin = " ";
    }
	if ($opr == "ALL") {
      $wopr = " ";
    } else {
      $wopr = " AND a.`acc_staff`='$opr' ";
    }
    ?>
    <input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='index.php?p=home5'" class="art-button" />
    <input type="button" name="button" id="button" value="Cetak Ke Excel" onClick="window.location.href='pages/efisiensi-excel.php?tglawal=<?php echo $tglawal; ?>&amp;tglakhir=<?php echo $tglakhir; ?>&amp;mesin=<?php echo $_POST['nama_mesin']; ?>&amp;no_mesin=<?php echo $_POST['no_mesin']; ?>&amp;shift=<?php echo $shft; ?>&amp;opr=<?php echo $opr; ?>'" class="art-button" />
    <br />
    <strong><br />
    </strong>
    <form id="form1" name="form1" method="post" action="">
      <strong> Periode: <?php echo $tglawal; ?> s/d <?php echo $tglakhir; ?></strong><br />
      <strong>Shift: <?php echo $shft; ?> <br />Mesin: <?php echo $nmesin; ?></strong><br />
      <strong>No Mesin: <?php echo $mc; ?></strong>
      <table width="100%" border="1" id="datatables" class="display">
        <thead>
          <tr style="border:1px solid;">
            <th rowspan="2" style="border:1px solid;vertical-align:middle;"><div align="center"><strong> <font size="-2">TGL</font> </strong></div></th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">NO MC</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">LANGGANAN / BUYER</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">NO ORDER</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">JENIS KAIN</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">WARNA</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">LOT</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">ROLL</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">QTY</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">PROSES</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">KETERANGAN</font>
                </strong></div>
            </th>
            <th colspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">JAM PROSES</font>
                </strong></div>
            </th>
            <th colspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">STOP MESIN</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">TOTAL STOP</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">KODE STOP</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;"><div align="center"><strong><font size="-2">LEBAR</font></strong></div></th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;"><div align="center"><strong> <font size="-2">GRAMASI</font></strong></div></th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;"><div align="center"><strong><font size="-2">SPEED</font></strong></div></th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;"><div align="center"><strong><font size="-2">OPERATOR</font></strong></div></th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;"><div align="center"><strong><font size="-2">YD/KG</font></strong></div></th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;"><div align="center"><strong><font size="-2">YD/LOT</font></strong></div></th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;"><div align="center"><strong> <font size="-2">WAKTU PROSES STD (MENIT)</font></strong></div></th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;"><div align="center"><strong> <font size="-2">WAKTU PROSES ACTUAL (MENIT)</font></strong></div></th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;"><div align="center"><strong> <font size="-2">EFISIENSI (%)</font></strong></div></th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">SHIFT</font>
                </strong></div>
            </th>
          </tr>
          <tr style="border:1px solid;">
            <th style="border:1px solid;">
              <div align="center"><strong>
                  <font size="-2">IN</font>
                </strong></div>
            </th>
            <th style="border:1px solid;">
              <div align="center"><strong>
                  <font size="-2">OUT</font>
                </strong></div>
            </th>
            <th style="border:1px solid;">
              <div align="center"><strong>
                  <font size="-2">JAM</font>
                </strong></div>
            </th>
            <th style="border:1px solid;">
              <div align="center"><strong>
                  <font size="-2">S/D</font>
                </strong></div>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php

          $sql = mysqli_query($con, "SELECT *,a.`id` as `idp`,(1000 /((lebar * gramasi)/ 43.056)) as `yd_kg`,
	(1000 /((lebar * gramasi)/ 43.056))* qty as `yd_lot`,
	((1000 /((lebar * gramasi)/ 43.056))* qty)/speed  as `waktu_proses` FROM `tbl_produksi` a
                                      WHERE " . $tgl . $shift . $mesin . $nomesin . $wopr . " ORDER BY a.`no_mesin` ASC ");
          $no = 1;
          $c = 0;
          while ($rowd = mysqli_fetch_array($sql)) {
            $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
          ?>

            <tr bgcolor="<?php echo $bgcolor; ?>" style="border:1px solid;">
              <td style="border:1px solid;"><div align="center"> <font size="-2"><?php echo $rowd['tgl_update']; ?></font> </div></td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2"><?php echo $rowd['no_mesin']; ?></font>
                </div>
              </td>
              <td style="border:1px solid;">
                <font size="-2"><b title="<?php echo $rowd['langganan']; ?>"><?php echo substr($rowd['langganan'], 0, 20) . ".."; ?></b></font>
              </td>
              <td style="border:1px solid;">
                <font size="-2"><?php echo $rowd['no_order']; ?></font>
              </td>
              <td style="border:1px solid;">
                <font size="-2"><b title="<?php echo $rowd['jenis_kain']; ?>"><?php echo substr($rowd['jenis_kain'], 0, 20) . ".."; ?></b></font>
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
                <font size="-2"><?php echo $rowd['proses']; ?></font>
              </td>
              <td style="border:1px solid;">
                <font size="-2"><?php echo $rowd['ket']; ?></font>
              </td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2"><?php echo $rowd['jam_in']; ?></font>
                </div>
              </td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2"><?php echo $rowd['jam_out']; ?></font>
                </div>
              </td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2"><?php echo $rowd['stop_l']; ?></font>
                </div>
              </td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2"><?php echo $rowd['stop_r']; ?></font>
                </div>
              </td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2">
                    <?php
                    date_default_timezone_set('Asia/Jakarta');
                    $time1 = strtotime($rowd['tgl_stop_l'] . " " . $rowd['stop_l']);
                    $time2 = strtotime($rowd['tgl_stop_r'] . " " . $rowd['stop_r']);
                    $diff  = $time2 - $time1;

                    $jam   = floor($diff / (60 * 60));
                    $menit = $diff - $jam * (60 * 60);
                    echo  $jam .  ' jam ' . floor($menit / 60) . ' menit';
                    ?></font>
                </div>
              </td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2"><?php echo $rowd['kd_stop']; ?></font>
                </div>
              </td>
              <td style="border:1px solid;"><div align="center"> <font size="-2"><?php echo $rowd['lebar']; ?></font></div></td>
              <td style="border:1px solid;"><div align="center"> <font size="-2"><?php echo $rowd['gramasi']; ?></font></div></td>
              <td style="border:1px solid;"><div align="center"> <font size="-2"><?php echo $rowd['speed']; ?></font></div></td>
              <td style="border:1px solid;"><div align="center"> <font size="-2"><?php echo $rowd['acc_staff']; ?></font></div></td>
              <td style="border:1px solid;"><div align="center"> <font size="-2"><?php echo round($rowd['yd_kg'],2); ?></font></div></td>
              <td style="border:1px solid;"><div align="center"> <font size="-2"><?php echo round($rowd['yd_lot'],2); ?></font></div></td>
              <td style="border:1px solid;"><div align="center"> <font size="-2"><?php echo round($rowd['waktu_proses'],2); ?></font></div></td>
              <td style="border:1px solid;"><div align="center"> <font size="-2">
                <?php
                    date_default_timezone_set('Asia/Jakarta');
                    $ptime1 = strtotime($rowd['tgl_proses_in'] . " " . $rowd['jam_in']);
                    $ptime2 = strtotime($rowd['tgl_proses_out'] . " " . $rowd['jam_out']);
                    $pdiff  = $ptime2 - $ptime1;

                    $pjam   = floor($pdiff / (60 * 60));
                    $pmenit = $pdiff - $pjam * (60 * 60);
                    echo  $pjam * (60 * 60);
                    ?>
              </font> </div></td>
              <td style="border:1px solid;"><div align="center"> <font size="-2"><?php if ($rowd['waktu_proses']>0){echo round((($pjam * (60 * 60))/round($rowd['waktu_proses'],2))*100,2);}else{ echo "0";} ?></font> </div></td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2"><?php echo $rowd['shift']; ?></font>
                </div>
              </td>
            </tr>
          <?php

            $no++;
          } ?>
        </tbody>
        <tfoot>
          <tr style="border:1px solid;">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr style="border:1px solid;">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><strong>Total</strong></td>
            <td><strong><?php echo $totcones; ?></strong></td>
            <td><strong><?php echo $totqty; ?></strong></td>
            <td>&nbsp;</td>
            <td><strong><?php echo $totberat; ?></strong></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </tfoot>
      </table>

    </form>
  
</body>

</html>