<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Laporan Produksi Harian Brushing</title>
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
    $(document).ready(function () {
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
  include ("../../koneksi.php");
  if ($_POST['jns'] == "Produksi Brushing" or $_GET['jns'] == "Produksi Brushing") {
    ?>

    <?php
    if ($_POST['awal'] != "") {
      $tglawal = $_POST['awal'];
      $tglakhir = $_POST['akhir'];
      $jamawal = $_POST['jam_awal'].":00";
      $jamakhir = $_POST['jam_akhir'].":00";
      $jns = $_POST['jns'];
      $mc = $_POST['no_mesin'];
      $nmesin = $_POST['nama_mesin'];
    } else {
      $tglawal = $_GET['tgl1'];
      $tglakhir = $_GET['tgl2'];
      $jamawal = $_GET['jam1'].":00";
      $jamakhir = $_GET['jam2'].":00";
      $jns = $_GET['jns'];
      $mc = $_GET['no_mesin'];
      $nmesin = $_GET['nama_mesin'];
    }
    if ($_POST['shift'] != "") {
      $shft = $_POST['shift'];
    } else {
      $shft = $_GET['shift'];
    }
    //    if ($tglakhir != "" and $tglawal != "") {
//      $tgl = " DATE_FORMAT(a.`tgl_update`,'%Y-%m-%d') BETWEEN '$tglawal' AND '$tglakhir' ";
//    } else {
//      $tgl = " ";
//    }
    if ($tglakhir != "" and $tglawal != "" and $jamakhir != "" and $jamawal != "") {
      $tgl = " DATE_FORMAT(a.`tgl_buat`,'%Y-%m-%d %H:%i:%s') BETWEEN '$tglawal $jamawal' AND '$tglakhir $jamakhir' ";
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

    ?>
    <input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='index.php'"
      class="art-button" />
    <input type="button" name="button3" id="button3" value="Cetak"
      onclick="window.open('pages/reports-cetak.php?tglawal=<?php echo $tglawal; ?>&amp;jamawal=<?php echo $jamawal; ?>&amp;tglakhir=<?php echo $tglakhir; ?>&amp;jamakhir=<?php echo $jamakhir; ?>&amp;mesin=<?php echo $_POST['nama_mesin']; ?>&amp;no_mesin=<?php echo $_POST['no_mesin']; ?>&amp;shift=<?php echo $shft; ?>', '_blank')"
      class="art-button" />
    <input type="button" name="button" id="button" value="Cetak Ke Excel"
      onClick="window.location.href='pages/reports-excel.php?tglawal=<?php echo $tglawal; ?>&amp;jamawal=<?php echo $jamawal; ?>&amp;tglakhir=<?php echo $tglakhir; ?>&amp;jamakhir=<?php echo $jamakhir; ?>&amp;mesin=<?php echo $_POST['nama_mesin']; ?>&amp;no_mesin=<?php echo $_POST['no_mesin']; ?>&amp;shift=<?php echo $shft; ?>'"
      class="art-button" />
    <br />
    <strong><br />
    </strong>
    <form id="form1" name="form1" method="post" action="">
      <strong> Periode1: <?php echo $tglawal . " " . $jamawal; ?> s/d
        <?php echo $tglakhir . " " . $jamakhir; ?></strong><br />
      <strong>Shift: <?php echo $shft; ?> <br />Mesin: <?php echo $nmesin; ?></strong><br />
      <strong>No Mesin: <?php echo $mc; ?></strong>
      <table width="100%" border="1" id="datatables" class="display">
        <thead>
          <tr style="border:1px solid;">
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">AKSI</font>
                </strong></div>
            </th>
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
                  <font size="-2">DEMAND</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">HANGER</font>
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
                  <font size="-2">STOP MESIN 1</font>
                </strong></div>
            </th>
            <th colspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">STOP MESIN 2</font>
                </strong></div>
            </th>
            <th colspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">STOP MESIN 3</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">TOTAL STOP 1</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">TOTAL STOP 2</font>
                </strong></div>
            </th>
            <th rowspan="2" style="border:1px solid;vertical-align:middle;">
              <div align="center"><strong>
                  <font size="-2">TOTAL STOP 3</font>
                </strong></div>
            </th>

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

          $sql = mysqli_query($con, "SELECT *,a.`id` as `idp` FROM `tbl_produksi` a
                                      WHERE " . $tgl . $shift . $mesin . $nomesin . " ORDER BY a.`no_mesin` ASC ");
          $no = 1;
          $c = 0;
          while ($rowd = mysqli_fetch_array($sql)) {
            $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
            ?>

            <tr bgcolor="<?php echo $bgcolor; ?>" style="border:1px solid;">

              <td style="border:1px solid;"><input type="button" name="hapus" id="hapus" value="Hapus"
                  onClick="confirmDelete('?p=hapus-report&id=<?php echo $rowd['idp']; ?>&tgl1=<?php echo $tglawal; ?>&tgl2=<?php echo $tglakhir; ?>&shift=<?php echo $shft; ?>&jns=Produksi Brushing&nama_mesin=<?php echo $rowd['nama_mesin']; ?>&no_mesin=<?php echo $rowd['no_mesin']; ?>');" />
                <input type="button" name="ubah" id="ubah" value="Ubah"
                  onclick="window.location.href='../data-brushing/index.php?typekk=NOW&id=<?php echo $rowd['idp']; ?>';" />
              </td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2"><?php echo $rowd['no_mesin']; ?></font>
                </div>
              </td>
              <td style="border:1px solid;">
                <font size="-2"><b
                    title="<?php echo $rowd['langganan']; ?>"><?php echo substr($rowd['langganan'], 0, 20) . ".."; ?></b>
                </font>
              </td>
              <td style="border:1px solid;">
                <font size="-2"><?php echo $rowd['no_order']; ?></font>
              </td>
              <td style="border:1px solid;">
                <font size="-2"><?php echo $rowd['nodemand']; ?></font>
              </td>
              <td style="border:1px solid;">
                <font size="-2"><?php echo $rowd['no_item']; ?></font>
              </td>
              <td style="border:1px solid;">
                <font size="-2"><b
                    title="<?php echo $rowd['jenis_kain']; ?>"><?php echo substr($rowd['jenis_kain'], 0, 20) . ".."; ?></b>
                </font>
              </td>
              <td style="border:1px solid;">
                <font size="-2"><b
                    title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['warna'], 0, 10) . ".."; ?></b>
                </font>
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
                  <font size="-2"><?php echo $rowd['stop_2']; ?></font>
                </div>
              </td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2"><?php echo $rowd['stop_r_2']; ?></font>
                </div>
              </td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2"><?php echo $rowd['stop_3']; ?></font>
                </div>
              </td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2"><?php echo $rowd['stop_r_3']; ?></font>
                </div>
              </td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2">
                    <?php
                    date_default_timezone_set('Asia/Jakarta');
                    $time1 = strtotime($rowd['tgl_stop_l'] . " " . $rowd['stop_l']);
                    $time2 = strtotime($rowd['tgl_stop_r'] . " " . $rowd['stop_r']);
                    $diff = $time2 - $time1;

                    $jam = floor($diff / (60 * 60));
                    $menit = $diff - $jam * (60 * 60);
                    echo $jam . ' jam ' . floor($menit / 60) . ' menit';
                    ?>
                  </font>
                </div>
              </td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2">
                    <?php
                    date_default_timezone_set('Asia/Jakarta');
                    $time1 = strtotime($rowd['tgl_stop_2'] . " " . $rowd['stop_2']);
                    $time2 = strtotime($rowd['tgl_stop_r_2'] . " " . $rowd['stop_r_2']);
                    $diff = $time2 - $time1;

                    $jam = floor($diff / (60 * 60));
                    $menit = $diff - $jam * (60 * 60);
                    echo $jam . ' jam ' . floor($menit / 60) . ' menit';
                    ?>
                  </font>
                </div>
              </td>
              <td style="border:1px solid;">
                <div align="center">
                  <font size="-2">
                    <?php
                    date_default_timezone_set('Asia/Jakarta');
                    $time1 = strtotime($rowd['tgl_stop_3'] . " " . $rowd['stop_3']);
                    $time2 = strtotime($rowd['tgl_stop_r_3'] . " " . $rowd['stop_r_3']);
                    $diff = $time2 - $time1;

                    $jam = floor($diff / (60 * 60));
                    $menit = $diff - $jam * (60 * 60);
                    echo $jam . ' jam ' . floor($menit / 60) . ' menit';
                    ?>
                  </font>
                </div>
              </td>


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
          </tr>
          <tr style="border:1px solid;">
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
          </tr>
        </tfoot>
      </table>

    </form>
  <?php } else if ($_POST['jns'] == "Rincian Proses") {

    if ($_POST['awal'] != "" and $_POST['jam_awal']) {
      $tglawal = $_POST['awal'];
      $jamawal = $_POST['jam_awal'];
      $tglakhir = $_POST['akhir'];
      $jamakhir = $_POST['jam_akhir'];
    } else {
      $tglawal = $_GET['tgl1'];
      $jamawal = $_GET['jam1'];
      $tglakhir = $_GET['tgl2'];
      $jamakhir = $_GET['jam2'];
    }
    if ($_POST['shift'] != "") {
      $shft = $_POST['shift'];
    } else {
      $shft = $_GET['shift'];
    }
    //    if ($tglakhir != "" and $tglawal != "") {
//      $tgl = " DATE_FORMAT(`tgl_buat`,'%Y-%m-%d %H:%i') BETWEEN '$tglawal $jamawal' AND '$tglakhir $jamakhir' ";
//    } else {
//      $tgl = " ";
//    }
    if ($tglakhir != "" and $tglawal != "" and $jamakhir != "" and $jamawal != "") {
      $tgl = " DATE_FORMAT(`tgl_buat`,'%Y-%m-%d %H:%i') BETWEEN '$tglawal $jamawal' AND '$tglakhir $jamakhir' ";
    } else {
      $tgl = " ";
    }
    if ($shft == "ALL") {
      $shift = " ";
    } else {
      $shift = " AND `shift`='$shft' ";
    }
    ?>
      <input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='index.php'"
        class="art-button" />
      <input type="button" name="button4" id="button4" value="Cetak"
        onclick="window.open('pages/rincian-cetak.php?tglawal=<?php echo $tglawal; ?>&amp;jamawal=<?php echo $jamawal; ?>&amp;tglakhir=<?php echo $tglakhir; ?>&amp;jamakhir=<?php echo $jamakhir; ?>&amp;shift=<?php echo $shft; ?>', '_blank')"
        class="art-button" />
      <input type="button" name="button4" id="button5" value="Cetak Ke Excel"
        onclick="window.location.href='pages/rincian-excel.php?tglawal=<?php echo $tglawal; ?>&amp;jamawal=<?php echo $jamawal; ?>&amp;tglakhir=<?php echo $tglakhir; ?>&amp;jamakhir=<?php echo $jamakhir; ?>&amp;shift=<?php echo $shft; ?>'"
        class="art-button" />
      <br />
      <br />
      <strong> Periode: <?php echo $tglawal . " " . $jamawal; ?> s/d
      <?php echo $tglakhir . " " . $jamakhir; ?></strong><br />
      <strong>Shift: <?php echo $shft; ?></strong>
      <table width="100%" border="0">
        <tr style="border:1px solid;">
          <td rowspan="3" valign="middle" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>No.</strong></div>
          </td>
          <td rowspan="3" valign="middle" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Proses</strong></div>
          </td>
          <td rowspan="3" valign="middle" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Keterangan</strong></div>
          </td>
          <td colspan="11" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>ALL BUYER</strong></div>
          </td>
          <td colspan="11" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>BUYER ADIDAS</strong></div>
          </td>
        </tr>
        <tr style="border:1px solid;">
          <td colspan="4" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Quantity &gt; 200 Kg</strong></div>
          </td>
          <td colspan="4" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Quantity &lt; 200 Kg</strong></div>
          </td>
          <td colspan="3" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Total</strong></div>
          </td>
          <td colspan="4" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Quantity &gt; 200 Kg</strong></div>
          </td>
          <td colspan="4" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Quantity &lt; 200 Kg</strong></div>
          </td>
          <td colspan="3" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Total</strong></div>
          </td>
        </tr>
        <tr style="border:1px solid;">
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
        </tr>
        <?php

        $sqlR = mysqli_query($con, "SELECT
	proses,perbaikan,
	sum(IF(rb_rl = 'R.B' and qty > 200, 1, 0)) AS 'RB',
  	sum(IF(rb_rl = 'R.B' and qty > 200, qty, 0)) AS 'qtyRB',
	sum(IF(rb_rl = 'R.L' and qty > 200, 1, 0)) AS 'RL',
	sum(IF(rb_rl = 'R.L' and qty > 200, qty, 0)) AS 'qtyRL',
  	sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200, 1, 0)) AS 'RB1',
  	sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200, qty, 0)) AS 'qtyRB1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200, 1, 0)) AS 'RL1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200, qty, 0)) AS 'qtyRL1',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0, 1, 0)) AS 'RBadidas',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0, qty, 0)) AS 'qtyRBadidas',
	sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0, 1, 0)) AS 'RLadidas',
  	sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0, qty, 0)) AS 'qtyRLadidas',
  	sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0, 1, 0)) AS 'RBadidas1',
  	sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0, qty, 0)) AS 'qtyRBadidas1',
  	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0, 1, 0)) AS 'RLadidas1',
  	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0, qty, 0)) AS 'qtyRLadidas1'
FROM
	tbl_produksi
WHERE
	" . $tgl . $shift . "
GROUP BY
	proses,perbaikan ORDER BY proses ASC ");
        $c = 1;
        $no = 1;
        while ($rowR = mysqli_fetch_array($sqlR)) {
          $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
          ?>
          <tr style="border:1px solid;" bgcolor="<?php echo $bgcolor; ?>">
            <td style="border:1px solid;">
              <div align="center"><strong><?php echo $no; ?></strong></div>
            </td>
            <td style="border:1px solid;"><?php echo $rowR['proses']; ?></td>
            <td style="border:1px solid;"><?php echo $rowR['perbaikan']; ?></td>
            <td style="border:1px solid;">
              <div align="center"><?php echo $rowR['RB']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="right"><?php echo $rowR['qtyRB']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="center"><?php echo $rowR['RL']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="right"><?php echo $rowR['qtyRL']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="center"><?php echo $rowR['RB1']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="right"><?php echo $rowR['qtyRB1']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="center"><?php echo $rowR['RL1']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="right"><?php echo $rowR['qtyRL1']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="center"><strong><?php echo $trb = $rowR['RB'] + $rowR['RB1']; ?></strong></div>
            </td>
            <td style="border:1px solid;">
              <div align="center"><strong><?php echo $trl = $rowR['RL'] + $rowR['RL1']; ?></strong></div>
            </td>
            <td style="border:1px solid;">
              <div align="right">
                <strong><?php echo $tqt = $rowR['qtyRL'] + $rowR['qtyRL1'] + $rowR['qtyRB'] + $rowR['qtyRB1']; ?></strong>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center"><?php echo $rowR['RBadidas']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="right"><?php echo $rowR['qtyRBadidas']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="center"><?php echo $rowR['RLadidas']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="right"><?php echo $rowR['qtyRLadidas']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="center"><?php echo $rowR['RBadidas1']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="right"><?php echo $rowR['qtyRBadidas1']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="center"><?php echo $rowR['RLadidas1']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="right"><?php echo $rowR['qtyRLadidas1']; ?></div>
            </td>
            <td style="border:1px solid;">
              <div align="center"><strong><?php echo $trbadidas = $rowR['RBadidas'] + $rowR['RBadidas1']; ?></strong>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="center"><strong><?php echo $trladidas = $rowR['RLadidas'] + $rowR['RLadidas1']; ?></strong>
              </div>
            </td>
            <td style="border:1px solid;">
              <div align="right">
                <strong><?php echo $tqtadidas = $rowR['qtyRLadidas'] + $rowR['qtyRLadidas1'] + $rowR['qtyRBadidas'] + $rowR['qtyRBadidas1']; ?></strong>
              </div>
            </td>
          </tr>
          <?php

          $totRB = $totRB + $rowR['RB'];
          $totRL = $totRL + $rowR['RL'];
          $totqtyRB = $totqtyRB + $rowR['qtyRB'];
          $totqtyRL = $totqtyRL + $rowR['qtyRL'];
          $totRB1 = $totRB1 + $rowR['RB1'];
          $totRL1 = $totRL1 + $rowR['RL1'];
          $totqtyRB1 = $totqtyRB1 + $rowR['qtyRB1'];
          $totqtyRL1 = $totqtyRL1 + $rowR['qtyRL1'];
          $trbrl = $totRB + $totRL;
          $tqtyrbrl = $totqtyRB + $totqtyRL;
          $trbrl1 = $totRB1 + $totRL1;
          $tqtyrbrl1 = $totqtyRB1 + $totqtyRL1;
          $totRBadidas = $totRBadidas + $rowR['RBadidas'];
          $totRLadidas = $totRLadidas + $rowR['RLadidas'];
          $totqtyRBadidas = $totqtyRBadidas + $rowR['qtyRBadidas'];
          $totqtyRLadidas = $totqtyRLadidas + $rowR['qtyRLadidas'];
          $totRBadidas1 = $totRBadidas1 + $rowR['RBadidas1'];
          $totRLadidas1 = $totRLadidas1 + $rowR['RLadidas1'];
          $totqtyRBadidas1 = $totqtyRBadidas1 + $rowR['qtyRBadidas1'];
          $totqtyRLadidas1 = $totqtyRLadidas1 + $rowR['qtyRLadidas1'];
          $trbrladidas = $totRBadidas + $totRLadidas;
          $tqtyrbrladidas = $totqtyRBadidas + $totqtyRLadidas;
          $trbrladidas1 = $totRBadidas1 + $totRLadidas1;
          $tqtyrbrladidas1 = $totqtyRBadidas1 + $totqtyRLadidas1;

          $no++;
        } ?>
        <tr style="border:1px solid;">
          <td bgcolor="#99FF99" style="border:1px solid;">&nbsp;</td>
          <td bgcolor="#99FF99" style="border:1px solid;"><strong>Subtotal</strong></td>
          <td bgcolor="#99FF99" style="border:1px solid;">&nbsp;</td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong><?php echo $totRB; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="right"><strong><?php echo $totqtyRB; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong><?php echo $totRL; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="right"><strong><?php echo $totqtyRL; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong><?php echo $totRB1; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="right"><strong><?php echo $totqtyRB1; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong><?php echo $totRL1; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="right"><strong><?php echo $totqtyRL1; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong><?php echo $totalrb = $totRB + $totRB1; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong><?php echo $totalrl = $totRL + $totRL1; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="right">
              <strong><?php echo $totalqt = $totqtyRB + $totqtyRB1 + $totqtyRL + $totqtyRL1; ?></strong>
            </div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong><?php echo $totRBadidas; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="right"><strong><?php echo $totqtyRBadidas; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong><?php echo $totRLadidas; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="right"><strong><?php echo $totqtyRLadidas; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong><?php echo $totRBadidas1; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="right"><strong><?php echo $totqtyRBadidas1; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong><?php echo $totRLadidas1; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="right"><strong><?php echo $totqtyRLadidas1; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong><?php echo $totalrbadidas = $totRBadidas + $totRBadidas1; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong><?php echo $totalrladidas = $totRLadidas + $totRLadidas1; ?></strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="right">
              <strong><?php echo $totalqtyadidas = $totqtyRBadidas + $totqtyRLadidas + $totqtyRBadidas1 + $totqtyRLadidas1; ?></strong>
            </div>
          </td>
        </tr>
      </table>
      <table width="100%" border="0">
        <tr style="border:1px solid;">
          <td rowspan="3" valign="middle" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>No.</strong></div>
          </td>
          <td rowspan="3" valign="middle" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Kestabilan Resep</strong></div>
          </td>
          <td colspan="11" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>ALL BUYER</strong></div>
          </td>
          <td colspan="11" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>BUYER ADIDAS</strong></div>
          </td>
        </tr>
        <tr style="border:1px solid;">
          <td colspan="4" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Quantity &gt; 200 Kg</strong></div>
          </td>
          <td colspan="4" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Quantity &lt; 200 Kg</strong></div>
          </td>
          <td colspan="3" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Total</strong></div>
          </td>
          <td colspan="4" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Quantity &gt; 200 Kg</strong></div>
          </td>
          <td colspan="4" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Quantity &lt; 200 Kg</strong></div>
          </td>
          <td colspan="3" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Total</strong></div>
          </td>
        </tr>
        <tr style="border:1px solid;">
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Qty</strong></div>
          </td>
        </tr>
        <?php
        $sqlx = mysqli_query($con, "SELECT k_r,
	sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RB',
  sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RL',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RB1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RL1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL1',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas',
	sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas',
  sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas1'
FROM
	tbl_produksi
WHERE
	" . $tgl . $shift . " and k_r=''
GROUP BY
	k_r");
        $rx = mysqli_fetch_array($sqlx);
        $sql0x = mysqli_query($con, "SELECT k_r,
	sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RB',
  sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RL',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RB1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RL1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL1',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas',
	sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas',
  sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas1'
FROM
	tbl_produksi
WHERE
	" . $tgl . $shift . " and k_r='0x'
GROUP BY
	k_r");
        $r0x = mysqli_fetch_array($sql0x);
        $sql1x = mysqli_query($con, "SELECT k_r,
	sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RB',
  sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RL',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RB1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RL1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL1',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas',
	sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas',
  sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas1'
FROM
	tbl_produksi
WHERE
	" . $tgl . $shift . " and k_r='1x'
GROUP BY
	k_r");
        $r1x = mysqli_fetch_array($sql1x);
        $sql2x = mysqli_query($con, "SELECT k_r,
	sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RB',
  sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RL',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RB1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RL1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL1',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas',
	sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas',
  sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas1'
FROM
	tbl_produksi
WHERE
	" . $tgl . $shift . " and k_r='2x'
GROUP BY
	k_r");
        $r2x = mysqli_fetch_array($sql2x);
        $sql3x = mysqli_query($con, "SELECT k_r,
	sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RB',
  sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RL',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RB1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RL1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL1',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas',
	sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas',
  sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas1'
FROM
	tbl_produksi
WHERE
	" . $tgl . $shift . " and k_r='3x'
GROUP BY
	k_r");
        $r3x = mysqli_fetch_array($sql3x);
        $sql4x = mysqli_query($con, "SELECT k_r,
	sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RB',
  sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RL',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RB1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RL1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL1',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas',
	sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas',
  sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas1'
FROM
	tbl_produksi
WHERE
	" . $tgl . $shift . " and k_r='4x'
GROUP BY
	k_r");
        $r4x = mysqli_fetch_array($sql4x);
        $sql5x = mysqli_query($con, "SELECT k_r,
	sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RB',
  sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RL',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RB1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RL1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL1',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas',
	sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas',
  sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas1'
FROM
	tbl_produksi
WHERE
	" . $tgl . $shift . " and k_r='5x'
GROUP BY
	k_r");
        $r5x = mysqli_fetch_array($sql5x);
        $sql6x = mysqli_query($con, "SELECT k_r,
	sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RB',
  sum(IF(rb_rl = 'R.B' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', 1, 0)) AS 'RL',
	sum(IF(rb_rl = 'R.L' and qty > 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RB1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRB1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', 1, 0)) AS 'RL1',
	sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and proses='Celup Greige', qty, 0)) AS 'qtyRL1',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas',
	sum(IF(rb_rl = 'R.B' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas',
	sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas',
  sum(IF(rb_rl = 'R.L' and qty > 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RBadidas1',
  sum(IF(rb_rl = 'R.B' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRBadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', 1, 0)) AS 'RLadidas1',
  sum(IF(rb_rl = 'R.L' and qty > 0 and qty < 200 and LOCATE('ADIDAS',langganan) >0 and proses='Celup Greige', qty, 0)) AS 'qtyRLadidas1'
FROM
	tbl_produksi
WHERE
	" . $tgl . $shift . " and (k_r='6x' or k_r='8x' or k_r='9x')
GROUP BY
	k_r");
        $r6x = mysqli_fetch_array($sql6x);
        ?>
        <tr bgcolor="#FFCC99" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>1</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">-</div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($rx > 0) {
              echo $rx['RB'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($rx > 0) {
              echo $rx['qtyRB'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($rx > 0) {
              echo $rx['RL'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($rx > 0) {
              echo $rx['qtyRL'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($rx > 0) {
              echo $rx['RB1'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($rx > 0) {
              echo $rx['qtyRB1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($rx > 0) {
              echo $rx['RL1'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($rx > 0) {
              echo $rx['qtyRL1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($rx > 0) {
                echo $tkr_RB = $rx['RB'] + $rx['RB1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($rx > 0) {
                echo $tkrRL = $rx['RL'] + $rx['RL1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($rx > 0) {
                echo $tkrqty = $rx['qtyRB'] + $rx['qtyRB1'] + $rx['qtyRL'] + $rx['qtyRL1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($rx > 0) {
              echo $rx['RBadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($rx > 0) {
              echo $rx['qtyRBadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($rx > 0) {
              echo $rx['RLadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($rx > 0) {
              echo $rx['qtyRLadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($rx > 0) {
              echo $rx['RBadidas1'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($rx > 0) {
              echo $rx['qtyRBadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($rx > 0) {
              echo $rx['RLadidas1'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($rx > 0) {
              echo $rx['qtyRLadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($rx > 0) {
                echo $tkrRBadidas = $rx['RBadidas'] + $rx['RBadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($rx > 0) {
                echo $tkrRLadidas = $rx['RLadidas'] + $rx['RLadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($rx > 0) {
                echo $tkrqtyadidas = $rx['qtyRBadidas'] + $rx['qtyRBadidas1'] + $rx['qtyRLadidas'] + $rx['qtyRLadidas1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
        </tr>
        <tr bgcolor="#33CCFF" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>2</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right"><strong>0x</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r0x > 0) {
              echo $r0x['RB'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r0x > 0) {
              echo $r0x['qtyRB'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r0x > 0) {
              echo $r0x['RL'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r0x > 0) {
              echo $r0x['qtyRL'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r0x > 0) {
              echo $r0x['RB1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r0x > 0) {
              echo $r0x['qtyRB1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r0x > 0) {
              echo $r0x['RL1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r0x > 0) {
              echo $r0x['qtyRL1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r0x > 0) {
                echo $tkrRB = $r0x['RB'] + $r0x['RB1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r0x > 0) {
                echo $tkrRL = $r0x['RL'] + $r0x['RL1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r0x > 0) {
                echo $tkrqty = $r0x['qtyRB'] + $r0x['qtyRB1'] + $r0x['qtyRL'] + $r0x['qtyRL1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r0x > 0) {
              echo $r0x['RBadidas'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r0x > 0) {
              echo $r0x['qtyRBadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r0x > 0) {
              echo $r0x['RLadidas'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r0x > 0) {
              echo $r0x['qtyRLadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r0x > 0) {
              echo $r0x['RBadidas1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r0x > 0) {
              echo $r0x['qtyRBadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r0x > 0) {
              echo $r0x['RLadidas1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r0x > 0) {
              echo $r0x['qtyRLadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r0x > 0) {
                echo $tkrRBadidas = $r0x['RBadidas'] + $r0x['RBadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r0x > 0) {
                echo $tkrRLadidas = $r0x['RLadidas'] + $r0x['RLadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r0x > 0) {
                echo $tkrqtyadidas = $r0x['qtyRBadidas'] + $r0x['qtyRBadidas1'] + $r0x['qtyRLadidas'] + $r0x['qtyRLadidas1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
        </tr>
        <tr bgcolor="#FFCC99" style="border:1px solid;">
          <td bgcolor="#FFCC99" style="border:1px solid;">
            <div align="center"><strong>3</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right"><strong>1x</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r1x > 0) {
              echo $r1x['RB'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r1x > 0) {
              echo $r1x['qtyRB'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r1x > 0) {
              echo $r1x['RL'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r1x > 0) {
              echo $r1x['qtyRL'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r1x > 0) {
              echo $r1x['RB1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r1x > 0) {
              echo $r1x['qtyRB1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r1x > 0) {
              echo $r1x['RL1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r1x > 0) {
              echo $r1x['qtyRL1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r1x > 0) {
                echo $tkrRB = $r1x['RB'] + $r1x['RB1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r1x > 0) {
                echo $tkrRL = $r1x['RL'] + $r1x['RL1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r1x > 0) {
                echo $tkrqty = $r1x['qtyRB'] + $r1x['qtyRB1'] + $r1x['qtyRL'] + $r1x['qtyRL1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r1x > 0) {
              echo $r1x['RBadidas'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r1x > 0) {
              echo $r1x['qtyRBadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r1x > 0) {
              echo $r1x['RLadidas'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r1x > 0) {
              echo $r1x['qtyRLadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r1x > 0) {
              echo $r1x['RBadidas1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r1x > 0) {
              echo $r1x['qtyRBadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r1x > 0) {
              echo $r1x['RLadidas1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r1x > 0) {
              echo $r1x['qtyRLadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r1x > 0) {
                echo $tkrRBadidas = $r1x['RBadidas'] + $r1x['RBadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r1x > 0) {
                echo $tkrRLadidas = $r1x['RLadidas'] + $r1x['RLadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r1x > 0) {
                echo $tkrqtyadidas = $r1x['qtyRBadidas'] + $r1x['qtyRBadidas1'] + $r1x['qtyRLadidas'] + $r1x['qtyRLadidas1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
        </tr>
        <tr bgcolor="#33CCFF" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>4</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right"><strong>2x</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r2x > 0) {
              echo $r2x['RB'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r2x > 0) {
              echo $r2x['qtyRB'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r2x > 0) {
              echo $r2x['RL'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r2x > 0) {
              echo $r2x['qtyRL'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r2x > 0) {
              echo $r2x['RB1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r2x > 0) {
              echo $r2x['qtyRB1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r2x > 0) {
              echo $r2x['RL1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r2x > 0) {
              echo $r2x['qtyRL1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r2x > 0) {
                echo $tkrRB = $r2x['RB'] + $r2x['RB1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r2x > 0) {
                echo $tkrRL = $r2x['RL'] + $r2x['RL1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r2x > 0) {
                echo $tkrqty = $r2x['qtyRB'] + $r2x['qtyRB1'] + $r2x['qtyRL'] + $r2x['qtyRL1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r2x > 0) {
              echo $r2x['RBadidas'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r2x > 0) {
              echo $r2x['qtyRBadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r2x > 0) {
              echo $r2x['RLadidas'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r2x > 0) {
              echo $r2x['qtyRLadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r2x > 0) {
              echo $r2x['RBadidas1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r2x > 0) {
              echo $r2x['qtyRBadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r2x > 0) {
              echo $r2x['RLadidas1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r2x > 0) {
              echo $r2x['qtyRLadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r2x > 0) {
                echo $tkrRBadidas = $r2x['RBadidas'] + $r2x['RBadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r2x > 0) {
                echo $tkrRLadidas = $r2x['RLadidas'] + $r2x['RLadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r2x > 0) {
                echo $tkrqtyadidas = $r2x['qtyRBadidas'] + $r2x['qtyRBadidas1'] + $r2x['qtyRLadidas'] + $r2x['qtyRLadidas1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
        </tr>
        <tr bgcolor="#FFCC99" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>5</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right"><strong>3x</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r3x > 0) {
              echo $r3x['RB'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r3x > 0) {
              echo $r3x['qtyRB'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r3x > 0) {
              echo $r3x['RL'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r3x > 0) {
              echo $r3x['qtyRL'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r3x > 0) {
              echo $r3x['RB1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r3x > 0) {
              echo $r3x['qtyRB1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r3x > 0) {
              echo $r3x['RL1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r3x > 0) {
              echo $r3x['qtyRL1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r3x > 0) {
                echo $tkrRB = $r3x['RB'] + $r3x['RB1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r3x > 0) {
                echo $tkrRL = $r3x['RL'] + $r3x['RL1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r3x > 0) {
                echo $tkrqty = $r3x['qtyRB'] + $r3x['qtyRB1'] + $r3x['qtyRL'] + $r3x['qtyRL1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r3x > 0) {
              echo $r3x['RBadidas'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r3x > 0) {
              echo $r3x['qtyRBadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r3x > 0) {
              echo $r3x['RLadidas'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r3x > 0) {
              echo $r3x['qtyRLadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r3x > 0) {
              echo $r3x['RBadidas1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r3x > 0) {
              echo $r3x['qtyRBadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r3x > 0) {
              echo $r3x['RLadidas1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r3x > 0) {
              echo $r3x['qtyRLadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r3x > 0) {
                echo $tkrRBadidas = $r3x['RBadidas'] + $r3x['RBadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r3x > 0) {
                echo $tkrRLadidas = $r3x['RLadidas'] + $r3x['RLadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r3x > 0) {
                echo $tkrqtyadidas = $r3x['qtyRBadidas'] + $r3x['qtyRBadidas1'] + $r3x['qtyRLadidas'] + $r3x['qtyRLadidas1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
        </tr>
        <tr bgcolor="#33CCFF" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>6</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right"><strong>4x</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r4x > 0) {
              echo $r4x['RB'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r4x > 0) {
              echo $r4x['qtyRB'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r4x > 0) {
              echo $r4x['RL'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r4x > 0) {
              echo $r4x['qtyRL'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r4x > 0) {
              echo $r4x['RB1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r4x > 0) {
              echo $r4x['qtyRB1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r4x > 0) {
              echo $r4x['RL1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r4x > 0) {
              echo $r4x['qtyRL1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r4x > 0) {
                echo $tkrRB = $r4x['RB'] + $r4x['RB1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r4x > 0) {
                echo $tkrRL = $r4x['RL'] + $r4x['RL1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r4x > 0) {
                echo $tkrqty = $r4x['qtyRB'] + $r4x['qtyRB1'] + $r4x['qtyRL'] + $r4x['qtyRL1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r4x > 0) {
              echo $r4x['RBadidas'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r4x > 0) {
              echo $r4x['qtyRBadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r4x > 0) {
              echo $r4x['RLadidas'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r4x > 0) {
              echo $r4x['qtyRLadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r4x > 0) {
              echo $r4x['RBadidas1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r4x > 0) {
              echo $r4x['qtyRBadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r4x > 0) {
              echo $r4x['RLadidas1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r4x > 0) {
              echo $r4x['qtyRLadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r4x > 0) {
                echo $tkrRBadidas = $r4x['RBadidas'] + $r4x['RBadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r4x > 0) {
                echo $tkrRLadidas = $r4x['RLadidas'] + $r4x['RLadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r4x > 0) {
                echo $tkrqtyadidas = $r4x['qtyRBadidas'] + $r4x['qtyRBadidas1'] + $r4x['qtyRLadidas'] + $r4x['qtyRLadidas1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
        </tr>
        <tr bgcolor="#FFCC99" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>7</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right"><strong>5x</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r5x > 0) {
              echo $r5x['RB'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r5x > 0) {
              echo $r5x['qtyRB'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r5x > 0) {
              echo $r5x['RL'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r5x > 0) {
              echo $r5x['qtyRL'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r5x > 0) {
              echo $r5x['RB1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r5x > 0) {
              echo $r5x['qtyRB1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r5x > 0) {
              echo $r5x['RL1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r5x > 0) {
              echo $r5x['qtyRL1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r5x > 0) {
                echo $tkrRB = $r5x['RB'] + $r5x['RB1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r5x > 0) {
                echo $tkrRL = $r5x['RL'] + $r5x['RL1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r5x > 0) {
                echo $tkrqty = $r5x['qtyRB'] + $r5x['qtyRB1'] + $r5x['qtyRL'] + $r5x['qtyRL1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r5x > 0) {
              echo $r5x['RBadidas'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r5x > 0) {
              echo $r5x['qtyRBadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r5x > 0) {
              echo $r5x['RLadidas'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r5x > 0) {
              echo $r5x['qtyRLadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r5x > 0) {
              echo $r5x['RBadidas1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r5x > 0) {
              echo $r5x['qtyRBadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><?php if ($r5x > 0) {
              echo $r5x['RLadidas1'];
            } else {
              echo "0";
            } ?></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r5x > 0) {
              echo $r5x['qtyRLadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r5x > 0) {
                echo $tkrRBadidas = $r5x['RBadidas'] + $r5x['RBadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r5x > 0) {
                echo $tkrRLadidas = $r5x['RLadidas'] + $r5x['RLadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r5x > 0) {
                echo $tkrqtyadidas = $r5x['qtyRBadidas'] + $r5x['qtyRBadidas1'] + $r5x['qtyRLadidas'] + $r5x['qtyRLadidas1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
        </tr>
        <tr bgcolor="#33CCFF" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>8</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right"><strong>&gt;5x</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r6x > 0) {
              echo $r6x['RB'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r6x > 0) {
              echo $r6x['qtyRB'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r6x > 0) {
              echo $r6x['RL'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r6x > 0) {
              echo $r6x['qtyRL'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r6x > 0) {
              echo $r6x['RB1'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r6x > 0) {
              echo $r6x['qtyRB1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r6x > 0) {
              echo $r6x['RL1'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r6x > 0) {
              echo $r6x['qtyRL1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r6x > 0) {
                echo $tkrRB = $r6x['RB'] + $r6x['RB1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r6x > 0) {
                echo $tkrRL = $r6x['RL'] + $r6x['RL1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r6x > 0) {
                echo $tkrqty = $r6x['qtyRB'] + $r6x['qtyRB1'] + $r6x['qtyRL'] + $r6x['qtyRL1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r6x > 0) {
              echo $r6x['RBadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r6x > 0) {
              echo $r6x['qtyRBadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r6x > 0) {
              echo $r6x['RLadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r6x > 0) {
              echo $r6x['qtyRLadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r6x > 0) {
              echo $r6x['RBadidas1'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r6x > 0) {
              echo $r6x['qtyRBadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r6x > 0) {
              echo $r6x['RLadidas1'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r6x > 0) {
              echo $r6x['qtyRLadidas1'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r6x > 0) {
                echo $tkrRBadidas = $r6x['RBadidas'] + $r6x['RBadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong>
              <?php if ($r6x > 0) {
                echo $tkrRLadidas = $r6x['RLadidas'] + $r6x['RLadidas1'];
              } else {
                echo "0";
              } ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong>
              <?php if ($r6x > 0) {
                echo $tkrqtyadidas = $r6x['qtyRBadidas'] + $r6x['qtyRBadidas1'] + $r6x['qtyRLadidas'] + $r6x['qtyRLadidas1'];
              } else {
                echo "0.00";
              } ?>
              </strong>
            </div>
          </td>
        </tr>
        <tr bgcolor="#99FF99" style="border:1px solid;">
          <td style="border:1px solid;">&nbsp;</td>
          <td style="border:1px solid;"><strong>Subtotal</strong></td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $trb = $rx['RB'] + $r0x['RB'] + $r1x['RB'] + $r2x['RB'] + $r3x['RB'] + $r4x['RB'] + $r5x['RB'] + $r6x['RB']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong><?php echo $tqrb = $rx['qtyRB'] + $r0x['qtyRB'] + $r1x['qtyRB'] + $r2x['qtyRB'] + $r3x['qtyRB'] + $r4x['qtyRB'] + $r5x['qtyRB'] + $r6x['qtyRB']; ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $trl = $rx['RL'] + $r0x['RL'] + $r1x['RL'] + $r2x['RL'] + $r3x['RL'] + $r4x['RL'] + $r5x['RL'] + $r6x['RL']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong><?php echo $tqrl = $rx['qtyRL'] + $r0x['qtyRL'] + $r1x['qtyRL'] + $r2x['qtyRL'] + $r3x['qtyRL'] + $r4x['qtyRL'] + $r5x['qtyRL'] + $r6x['qtyRL']; ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $trb1 = $rx['RB1'] + $r0x['RB1'] + $r1x['RB1'] + $r2x['RB1'] + $r3x['RB1'] + $r4x['RB1'] + $r5x['RB1'] + $r6x['RB1']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong><?php echo $tqrb1 = $rx['qtyRB1'] + $r0x['qtyRB1'] + $r1x['qtyRB1'] + $r2x['qtyRB1'] + $r3x['qtyRB1'] + $r4x['qtyRB1'] + $r5x['qtyRB1'] + $r6x['qtyRB1']; ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $trl1 = $rx['RL1'] + $r0x['RL1'] + $r1x['RL1'] + $r2x['RL1'] + $r3x['RL1'] + $r4x['RL1'] + $r5x['RL1'] + $r6x['RL1']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong><?php echo $tqrl1 = $rx['qtyRL1'] + $r0x['qtyRL1'] + $r1x['qtyRL1'] + $r2x['qtyRL1'] + $r3x['qtyRL1'] + $r4x['qtyRL1'] + $r5x['qtyRL1'] + $r6x['qtyRL1']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><strong><?php echo $torb1 = $trb + $trb1; ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><strong><?php echo $torl1 = $trl + $trl1; ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right"> <strong><?php echo $toq = $tqrb + $tqrl + $tqrb1 + $tqrl1; ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $trbadidas = $rx['RBadidas'] + $r0x['RBadidas'] + $r1x['RBadidas'] + $r2x['RBadidas'] + $r3x['RBadidas'] + $r4x['RBadidas'] + $r5x['RBadidas'] + $r6x['RBadidas']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong><?php echo $tqrbadidas = $rx['qtyRBadidas'] + $r0x['qtyRBadidas'] + $r1x['qtyRBadidas'] + $r2x['qtyRBadidas'] + $r3x['qtyRBadidas'] + $r4x['qtyRBadidas'] + $r5x['qtyRBadidas'] + $r6x['qtyRBadidas']; ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $trladidas = $rx['RLadidas'] + $r0x['RLadidas'] + $r1x['RLadidas'] + $r2x['RLadidas'] + $r3x['RLadidas'] + $r4x['RLadidas'] + $r5x['RLadidas'] + $r6x['RLadidas']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong><?php echo $tqrladidas = $rx['qtyRLadidas'] + $r0x['qtyRLadidas'] + $r1x['qtyRLadidas'] + $r2x['qtyRLadidas'] + $r3x['qtyRLadidas'] + $r4x['qtyRLadidas'] + $r5x['qtyRLadidas'] + $r6x['qtyRLadidas']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $trbadidas1 = $rx['RBadidas1'] + $r0x['RBadidas1'] + $r1x['RBadidas1'] + $r2x['RBadidas1'] + $r3x['RBadidas1'] + $r4x['RBadidas1'] + $r5x['RBadidas1'] + $r6x['RBadidas1']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong><?php echo $tqrbadidas1 = $rx['qtyRBadidas1'] + $r0x['qtyRBadidas1'] + $r1x['qtyRBadidas1'] + $r2x['qtyRBadidas1'] + $r3x['qtyRBadidas1'] + $r4x['qtyRBadidas1'] + $r5x['qtyRBadidas1'] + $r6x['qtyRBadidas1']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $trladidas1 = $rx['RLadidas1'] + $r0x['RLadidas1'] + $r1x['RLadidas1'] + $r2x['RLadidas1'] + $r3x['RLadidas1'] + $r4x['RLadidas1'] + $r5x['RLadidas1'] + $r6x['RLadidas1']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong><?php echo $tqrladidas1 = $rx['qtyRLadidas1'] + $r0x['qtyRLadidas1'] + $r1x['qtyRLadidas1'] + $r2x['qtyRLadidas1'] + $r3x['qtyRLadidas1'] + $r4x['qtyRLadidas1'] + $r5x['qtyRLadidas1'] + $r6x['qtyRLadidas1']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><strong><?php echo $torbadidas1 = $trbadidas + $trbadidas1; ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><strong><?php echo $torladidas1 = $trladidas + $trladidas1; ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong><?php echo $toqadidas = $tqrbadidas + $tqrladidas + $tqrbadidas1 + $tqrladidas1; ?></strong>
            </div>
          </td>
        </tr>
      </table>
      <table width="100%" border="0">
        <tr style="border:1px solid;">
          <td rowspan="3" valign="middle" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>No.</strong></div>
          </td>
          <td rowspan="3" valign="middle" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>L:R / Capacity</strong></div>
          </td>
          <td colspan="6" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>ALL BUYER</strong></div>
          </td>
          <td colspan="6" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>BUYER ADIDAS</strong></div>
          </td>
        </tr>
        <tr style="border:1px solid;">
          <td colspan="6" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>AVERAGE PER CAPACITY</strong></div>
          </td>
          <td colspan="6" bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>AVERAGE PER CAPACITY</strong></div>
          </td>
        </tr>
        <tr style="border:1px solid;">
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Pemakaian Air</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Quantity</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>% Loading</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>L:R</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.B</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>R.L</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Pemakaian Air</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>Quantity</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>% Loading</strong></div>
          </td>
          <td bgcolor="#99FF99" style="border:1px solid;">
            <div align="center"><strong>L:R</strong></div>
          </td>
        </tr>
        <?php
        $sql0 = mysqli_query($con, "SELECT
  ROUND(AVG(a.air)) as 'air',
	ROUND(AVG(a.qty),2) AS 'qty',
  ROUND(AVG((a.qty/b.kapasitas)*100),2) as `loading`,
  ROUND(AVG(a.air/a.qty),2) as `l_r`,
  ROUND(AVG(IF(a.rb_rl = 'R.B', 1, 0))) AS 'RB',
  ROUND(AVG(IF(a.rb_rl = 'R.L', 1, 0))) AS 'RL',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.qty, 0)),2) AS 'qtyadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air, 0))) AS 'airadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.B' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RBadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.L' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RLadidas',
  ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, (a.qty/b.kapasitas)*100, 0)),2) AS 'loadingadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air/a.qty, 0)),2) AS 'l_rairadidas'
FROM
	tbl_produksi a
LEFT JOIN tbl_mesin b ON a.no_mesin=b.no_mesin
WHERE
	" . $tgl . $shift . " AND b.kapasitas > '0' and b.kapasitas <= '50' AND a.qty > 0");
        $r0 = mysqli_fetch_array($sql0);
        $sql50 = mysqli_query($con, "SELECT
  ROUND(AVG(a.air)) as 'air',
	ROUND(AVG(a.qty),2) AS 'qty',
  ROUND(AVG((a.qty/b.kapasitas)*100),2) as `loading`,
  ROUND(AVG(a.air/a.qty),2) as `l_r`,
  ROUND(AVG(IF(a.rb_rl = 'R.B', 1, 0))) AS 'RB',
  ROUND(AVG(IF(a.rb_rl = 'R.L', 1, 0))) AS 'RL',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.qty, 0)),2) AS 'qtyadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air, 0))) AS 'airadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.B' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RBadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.L' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RLadidas',
  ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, (a.qty/b.kapasitas)*100, 0)),2) AS 'loadingadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air/a.qty, 0)),2) AS 'l_rairadidas'
FROM
	tbl_produksi a
LEFT JOIN tbl_mesin b ON a.no_mesin=b.no_mesin
WHERE
	" . $tgl . $shift . " AND b.kapasitas > '50' and b.kapasitas <= '100' AND a.qty > 0");
        $r50 = mysqli_fetch_array($sql50);
        $sql100 = mysqli_query($con, "SELECT
  ROUND(AVG(a.air)) as 'air',
	ROUND(AVG(a.qty),2) AS 'qty',
  ROUND(AVG((a.qty/b.kapasitas)*100),2) as `loading`,
  ROUND(AVG(a.air/a.qty),2) as `l_r`,
  ROUND(AVG(IF(a.rb_rl = 'R.B', 1, 0))) AS 'RB',
  ROUND(AVG(IF(a.rb_rl = 'R.L', 1, 0))) AS 'RL',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.qty, 0)),2) AS 'qtyadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air, 0))) AS 'airadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.B' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RBadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.L' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RLadidas',
  ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, (a.qty/b.kapasitas)*100, 0)),2) AS 'loadingadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air/a.qty, 0)),2) AS 'l_rairadidas'
FROM
	tbl_produksi a
LEFT JOIN tbl_mesin b ON a.no_mesin=b.no_mesin
WHERE
	" . $tgl . $shift . " AND b.kapasitas > '100' and b.kapasitas <= '200' AND a.qty > 0");
        $r100 = mysqli_fetch_array($sql100);
        $sql200 = mysqli_query($con, "SELECT
  ROUND(AVG(a.air)) as 'air',
	ROUND(AVG(a.qty),2) AS 'qty',
  ROUND(AVG((a.qty/b.kapasitas)*100),2) as `loading`,
  ROUND(AVG(a.air/a.qty),2) as `l_r`,
  ROUND(AVG(IF(a.rb_rl = 'R.B', 1, 0))) AS 'RB',
  ROUND(AVG(IF(a.rb_rl = 'R.L', 1, 0))) AS 'RL',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.qty, 0)),2) AS 'qtyadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air, 0))) AS 'airadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.B' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RBadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.L' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RLadidas',
  ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, (a.qty/b.kapasitas)*100, 0)),2) AS 'loadingadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air/a.qty, 0)),2) AS 'l_rairadidas'
FROM
	tbl_produksi a
LEFT JOIN tbl_mesin b ON a.no_mesin=b.no_mesin
WHERE
	" . $tgl . $shift . " AND b.kapasitas > '200' and b.kapasitas <= '400' AND a.qty > 0");
        $r200 = mysqli_fetch_array($sql200);
        $sql400 = mysqli_query($con, "SELECT
  ROUND(AVG(a.air)) as 'air',
	ROUND(AVG(a.qty),2) AS 'qty',
  ROUND(AVG((a.qty/b.kapasitas)*100),2) as `loading`,
  ROUND(AVG(a.air/a.qty),2) as `l_r`,
  ROUND(AVG(IF(a.rb_rl = 'R.B', 1, 0))) AS 'RB',
  ROUND(AVG(IF(a.rb_rl = 'R.L', 1, 0))) AS 'RL',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.qty, 0)),2) AS 'qtyadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air, 0))) AS 'airadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.B' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RBadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.L' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RLadidas',
  ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, (a.qty/b.kapasitas)*100, 0)),2) AS 'loadingadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air/a.qty, 0)),2) AS 'l_rairadidas'
FROM
	tbl_produksi a
LEFT JOIN tbl_mesin b ON a.no_mesin=b.no_mesin
WHERE
	" . $tgl . $shift . " AND b.kapasitas > '400' and b.kapasitas <= '600' AND a.qty > 0");
        $r400 = mysqli_fetch_array($sql400);
        $sql600 = mysqli_query($con, "SELECT
  ROUND(AVG(a.air)) as 'air',
	ROUND(AVG(a.qty),2) AS 'qty',
  ROUND(AVG((a.qty/b.kapasitas)*100),2) as `loading`,
  ROUND(AVG(a.air/a.qty),2) as `l_r`,
  ROUND(AVG(IF(a.rb_rl = 'R.B', 1, 0))) AS 'RB',
  ROUND(AVG(IF(a.rb_rl = 'R.L', 1, 0))) AS 'RL',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.qty, 0)),2) AS 'qtyadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air, 0))) AS 'airadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.B' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RBadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.L' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RLadidas',
  ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, (a.qty/b.kapasitas)*100, 0)),2) AS 'loadingadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air/a.qty, 0)),2) AS 'l_rairadidas'
FROM
	tbl_produksi a
LEFT JOIN tbl_mesin b ON a.no_mesin=b.no_mesin
WHERE
	" . $tgl . $shift . " AND b.kapasitas > '600' and b.kapasitas <= '800' AND a.qty > 0");
        $r600 = mysqli_fetch_array($sql600);
        $sql800 = mysqli_query($con, "SELECT
  ROUND(AVG(a.air)) as 'air',
	ROUND(AVG(a.qty),2) AS 'qty',
  ROUND(AVG((a.qty/b.kapasitas)*100),2) as `loading`,
  ROUND(AVG(a.air/a.qty),2) as `l_r`,
  ROUND(AVG(IF(a.rb_rl = 'R.B', 1, 0))) AS 'RB',
  ROUND(AVG(IF(a.rb_rl = 'R.L', 1, 0))) AS 'RL',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.qty, 0)),2) AS 'qtyadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air, 0))) AS 'airadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.B' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RBadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.L' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RLadidas',
  ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, (a.qty/b.kapasitas)*100, 0)),2) AS 'loadingadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air/a.qty, 0)),2) AS 'l_rairadidas'
FROM
	tbl_produksi a
LEFT JOIN tbl_mesin b ON a.no_mesin=b.no_mesin
WHERE
	" . $tgl . $shift . " AND b.kapasitas > '800' and b.kapasitas <= '1000' AND a.qty > 0");
        $r800 = mysqli_fetch_array($sql800);
        $sql1000 = mysqli_query($con, "SELECT
  ROUND(AVG(a.air)) as 'air',
	ROUND(AVG(a.qty),2) AS 'qty',
  ROUND(AVG((a.qty/b.kapasitas)*100),2) as `loading`,
  ROUND(AVG(a.air/a.qty),2) as `l_r`,
  ROUND(AVG(IF(a.rb_rl = 'R.B', 1, 0))) AS 'RB',
  ROUND(AVG(IF(a.rb_rl = 'R.L', 1, 0))) AS 'RL',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.qty, 0)),2) AS 'qtyadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air, 0))) AS 'airadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.B' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RBadidas',
  ROUND(AVG(IF(a.rb_rl = 'R.L' and LOCATE('ADIDAS',a.langganan) >0, 1, 0))) AS 'RLadidas',
  ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, (a.qty/b.kapasitas)*100, 0)),2) AS 'loadingadidas',
	ROUND(AVG(IF(LOCATE('ADIDAS',a.langganan) >0, a.air/a.qty, 0)),2) AS 'l_rairadidas'
FROM
	tbl_produksi a
LEFT JOIN tbl_mesin b ON a.no_mesin=b.no_mesin
WHERE
	" . $tgl . $shift . " AND b.kapasitas > '1000' and b.kapasitas <= '1200' AND a.qty > 0 ");
        $r1000 = mysqli_fetch_array($sql1000);
        $rw100 = mysqli_num_rows($sql1000);

        ?>
        <tr bgcolor="#33CCFF" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>1</strong></div>
          </td>
          <td bgcolor="#33CCFF" style="border:1px solid;">
            <div align="right"><strong>0-50 Kg</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r0 > 0) {
              echo $r0['RB'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r0 > 0) {
              echo $r0['RL'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r0 > 0) {
              echo $r0['air'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r0 > 0) {
              echo $r0['qty'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r0 > 0) {
              echo $r0['loading'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r0 > 0 and $r0['qty'] > 0) {
              echo $l_r0 = round($r0['air'] / $r0['qty'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r0 > 0) {
              echo $r0['RBadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r0 > 0) {
              echo $r0['RLadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r0 > 0) {
              echo $r0['airadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r0 > 0) {
              echo $r0['qtyadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r0 > 0) {
              echo $r0['loadingadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r0 > 0 and $r0['qtyadidas'] > 0) {
              echo $l_radidas0 = round($r0['airadidas'] / $r0['qtyadidas'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
        </tr>
        <tr bgcolor="#FFCC99" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>2</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <div align="right"><strong>&gt; 50-100 Kg</strong></div>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r50 > 0) {
              echo $r50['RB'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r50 > 0) {
              echo $r50['RL'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r50 > 0) {
              echo $r50['air'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r50 > 0) {
              echo $r50['qty'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r50 > 0) {
              echo $r50['loading'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r50 > 0 and $r50['qty'] > 0) {
              echo $l_r50 = round($r50['air'] / $r50['qty'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r50 > 0) {
              echo $r50['RBadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r50 > 0) {
              echo $r50['RLadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r50 > 0) {
              echo $r50['airadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r50 > 0) {
              echo $r50['qtyadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r50 > 0) {
              echo $r50['loadingadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r50 > 0 and $r50['qtyadidas'] > 0) {
              echo $l_radidas50 = round($r50['airadidas'] / $r50['qtyadidas'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
        </tr>
        <tr bgcolor="#33CCFF" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>3</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <div align="right"><strong>&gt; 100-200 Kg</strong></div>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r100 > 0) {
              echo $r100['RB'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r100 > 0) {
              echo $r100['RL'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r100 > 0) {
              echo $r100['air'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r100 > 0) {
              echo $r100['qty'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r100 > 0) {
              echo $r100['loading'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r100 > 0 and $r100['qty'] > 0) {
              echo $l_r100 = round($r100['air'] / $r100['qty'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r100 > 0) {
              echo $r100['RBadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r100 > 0) {
              echo $r100['RLadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r100 > 0) {
              echo $r100['airadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r100 > 0) {
              echo $r100['qtyadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r100 > 0) {
              echo $r100['loadingadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r100 > 0 and $r100['qtyadidas'] > 0) {
              echo $l_radidas100 = round($r100['airadidas'] / $r100['qtyadidas'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
        </tr>
        <tr bgcolor="#FFCC99" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>4</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <div align="right"><strong>&gt; 200-400 Kg</strong></div>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r200 > 0) {
              echo $r200['RB'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r200 > 0) {
              echo $r200['RL'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r200 > 0) {
              echo $r200['air'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r200 > 0) {
              echo $r200['qty'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r200 > 0) {
              echo $r200['loading'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r200 > 0 and $r200['qty'] > 0) {
              echo $l_r200 = round($r200['air'] / $r200['qty'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r200 > 0) {
              echo $r200['RBadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r200 > 0) {
              echo $r200['RLadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r200 > 0) {
              echo $r200['airadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r200 > 0) {
              echo $r200['qtyadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r200 > 0) {
              echo $r200['loadingadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r200 > 0 and $r200['qtyadidas'] > 0) {
              echo $l_radidas200 = round($r200['airadidas'] / $r200['qtyadidas'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
        </tr>
        <tr bgcolor="#33CCFF" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>5</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <div align="right"><strong>&gt; 400-600 Kg</strong></div>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r400 > 0) {
              echo $r400['RB'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r400 > 0) {
              echo $r400['RL'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r400 > 0) {
              echo $r400['air'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r400 > 0) {
              echo $r400['qty'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r400 > 0) {
              echo $r400['loading'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r400 > 0 and $r400['qty'] > 0) {
              echo $l_r400 = round($r400['air'] / $r400['qty'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r400 > 0) {
              echo $r400['RBadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r400 > 0) {
              echo $r400['RLadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r400 > 0) {
              echo $r400['airadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r400 > 0) {
              echo $r400['qtyadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r400 > 0) {
              echo $r400['loadingadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r400 > 0 and $r400['qtyadidas'] > 0) {
              echo $l_radidas400 = round($r400['airadidas'] / $r400['qtyadidas'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
        </tr>
        <tr bgcolor="#FFCC99" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>6</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <div align="right"><strong>&gt; 600-800 Kg</strong></div>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r600 > 0) {
              echo $r600['RB'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r600 > 0) {
              echo $r600['RL'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r600 > 0) {
              echo $r600['air'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r600 > 0) {
              echo $r600['qty'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r600 > 0) {
              echo $r600['loading'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r600 > 0 and $r600['qty'] > 0) {
              echo $l_r600 = round($r600['air'] / $r600['qty'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r600 > 0) {
              echo $r600['RBadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r600 > 0) {
              echo $r600['RLadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r600 > 0) {
              echo $r600['airadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r600 > 0) {
              echo $r600['qtyadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r600 > 0) {
              echo $r600['loadingadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r600 > 0 and $r600['qtyadidas'] > 0) {
              echo $l_radidas600 = round($r600['airadidas'] / $r600['qtyadidas'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
        </tr>
        <tr bgcolor="#33CCFF" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>7</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <div align="right"><strong>&gt; 800-1000 Kg</strong></div>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r800 > 0) {
              echo $r800['RB'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r800 > 0) {
              echo $r800['RL'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r800 > 0) {
              echo $r800['air'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r800 > 0) {
              echo $r800['qty'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r800 > 0) {
              echo round($r800['loading'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r800 > 0 and $r800['qty'] > 0) {
              echo $l_r800 = round($r800['air'] / $r800['qty'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r800 > 0) {
              echo $r800['RBadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r800 > 0) {
              echo $r800['RLadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r800 > 0) {
              echo $r800['airadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r800 > 0) {
              echo $r800['qtyadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r800 > 0) {
              echo $r800['loadingadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r800 > 0 and $r800['qtyadidas'] > 0) {
              echo $l_radidas800 = round($r800['airadidas'] / $r800['qtyadidas'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
        </tr>
        <tr bgcolor="#FFCC99" style="border:1px solid;">
          <td style="border:1px solid;">
            <div align="center"><strong>8</strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <div align="right"><strong>&gt; 1000-1200 Kg</strong></div>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($rw100 > 0 and $r1000['RB'] > 0) {
              echo $r1000['RB'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r1000 > 0 and $r1000['RL'] > 0) {
              echo $r1000['RL'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r1000 > 0 and $r1000['air']) {
              echo $r1000['air'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td bgcolor="#FFCC99" style="border:1px solid;">
            <div align="right">
            <?php if ($r1000 > 0 and $r1000['qty'] > 0) {
              echo $r1000['qty'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r1000 > 0 and $r1000['loading'] > 0) {
              echo $r1000['loading'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r1000 > 0 and $r1000['qty'] > 0) {
              echo $l_r1000 = round($r1000['air'] / $r1000['qty'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r1000 > 0 and $r1000['RBadidas'] > 0) {
              echo $r1000['RBadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r1000 > 0 and $r1000['RLadidas'] > 0) {
              echo $r1000['RLadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r1000 > 0 and $r1000['airadidas'] > 0) {
              echo $r1000['airadidas'];
            } else {
              echo "0";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
            <?php if ($r1000 > 0 and $r1000['qtyadidas'] > 0) {
              echo $r1000['qtyadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r1000 > 0 and $r1000['loadingadidas'] > 0) {
              echo $r1000['loadingadidas'];
            } else {
              echo "0.00";
            } ?>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
            <?php if ($r1000 > 0 and $r1000['qtyadidas'] > 0) {
              echo $l_radidas1000 = round($r1000['airadidas'] / $r1000['qtyadidas'], 2);
            } else {
              echo "0";
            } ?>
            </div>
          </td>
        </tr>
        <tr bgcolor="#99FF99" style="border:1px solid;">
          <td style="border:1px solid;">&nbsp;</td>
          <td style="border:1px solid;"><strong>Total</strong></td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $ttlRB = $r0['RB'] + $r50['RB'] + $r100['RB'] + $r200['RB'] + $r400['RB'] + $r600['RB'] + $r800['RB'] + $r1000['RB']; ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $ttlRL = $r0['RL'] + $r50['RL'] + $r100['RL'] + $r200['RL'] + $r400['RL'] + $r600['RL'] + $r800['RL'] + $r1000['RL']; ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong><?php echo $ttlair = $r0['air'] + $r50['air'] + $r100['air'] + $r200['air'] + $r400['air'] + $r600['air'] + $r800['air'] + $r1000['air']; ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong><?php echo $ttlqty = $r0['qty'] + $r50['qty'] + $r100['qty'] + $r200['qty'] + $r400['qty'] + $r600['qty'] + $r800['qty'] + $r1000['qty']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $ttlloading = $r0['loading'] + $r50['loading'] + $r100['loading'] + $r200['loading'] + $r400['loading'] + $r600['loading'] + $r800['loading'] + $r1000['loading']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $ttll_r = $l_r0 + $l_r50 + $l_r100 + $l_r200 + $l_r400 + $l_r600 + $l_r800 + $l_r1000; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $ttlRBadidas = $r0['RBadidas'] + $r50['RBadidas'] + $r100['RBadidas'] + $r200['RBadidas'] + $r400['RBadidas'] + $r600['RBadidas'] + $r800['RBadidas'] + $r1000['RBadidas']; ?>
              </strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $ttlRLadidas = $r0['RLadidas'] + $r50['RLadidas'] + $r100['RLadidas'] + $r200['RLadidas'] + $r400['RLadidas'] + $r600['RLadidas'] + $r800['RLadidas'] + $r1000['RLadidas']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong><?php echo $ttlairadidas = $r0['air'] + $r50['airadidas'] + $r100['airadidas'] + $r200['airadidas'] + $r400['airadidas'] + $r600['airadidas'] + $r800['airadidas'] + $r1000['airadidas']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="right">
              <strong><?php echo $ttlqtyadidas = $r0['qtyadidas'] + $r50['qtyadidas'] + $r100['qtyadidas'] + $r200['qtyadidas'] + $r400['qtyadidas'] + $r600['qtyadidas'] + $r800['qtyadidas'] + $r1000['qtyadidas']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $ttlloadingadidas = $r0['loading'] + $r50['loadingadidas'] + $r100['loadingadidas'] + $r200['loadingadidas'] + $r400['loadingadidas'] + $r600['loadingadidas'] + $r800['loadingadidas'] + $r1000['loadingadidas']; ?></strong>
            </div>
          </td>
          <td style="border:1px solid;">
            <div align="center">
              <strong><?php echo $ttll_radidas = $l_radidas0 + $l_radidas50 + $l_radidas100 + $l_radidas200 + $l_radidas400 + $l_radidas600 + $l_radidas800 + $l_radidas1000; ?></strong>
            </div>
          </td>
        </tr>
        <tr bgcolor="#99FF99" style="border:1px solid;">
          <td style="border:1px solid;">&nbsp;</td>
          <td style="border:1px solid;"><strong>Rata-Rata</strong></td>
          <td style="border:1px solid;">
            <div align="center"><strong><?php echo round($ttlRB / 8, 2); ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><strong><?php echo round($ttlRL / 8, 2); ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right"><strong><?php echo round($ttlair / 8); ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right"><strong><?php echo round($ttlqty / 8, 2); ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><strong><?php echo round($ttlloading / 8, 2); ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><strong><?php echo round($ttll_r / 8, 2); ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><strong><?php echo round($ttlRBadidas / 8, 2); ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><strong><?php echo round($ttlRLadidas / 8, 2); ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right"><strong><?php echo round($ttlairadidas / 8); ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="right"><strong><?php echo round($ttlqtyadidas / 8, 2); ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><strong><?php echo round($ttlloadingadidas / 8, 2); ?></strong></div>
          </td>
          <td style="border:1px solid;">
            <div align="center"><strong><?php echo round($ttll_radidas / 8, 2); ?></strong></div>
          </td>
        </tr>
      </table>
      <table width="100%" border="0">
        <tr>
          <td align="left" valign="top">
            <table width="100%" border="0">
              <tr style="border:1px solid;">
                <td rowspan="3" valign="middle" bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>No.</strong></div>
                </td>
                <td rowspan="3" valign="middle" bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Energy</strong></div>
                </td>
                <td colspan="2" bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>ALL BUYER</strong></div>
                </td>
                <td colspan="2" bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>BUYER ADIDAS</strong></div>
                </td>
              </tr>
              <tr style="border:1px solid;">
                <td colspan="2" bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Average</strong></div>
                </td>
                <td colspan="2" bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Average</strong></div>
                </td>
              </tr>
              <tr style="border:1px solid;">
                <td bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Lama Proses</strong></div>
                </td>
                <td bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Menit</strong></div>
                </td>
                <td bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Lama Proses</strong></div>
                </td>
                <td bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Menit</strong></div>
                </td>
              </tr>
              <?php
              $sqlenergi = mysqli_query($con, "SELECT
	energi,
	STR_TO_date(CONCAT(tgl_proses_in, ' ', jam_in),'%Y-%m-%d %H:%i') AS jamin,
	STR_TO_date(CONCAT(tgl_proses_out, ' ', jam_out),'%Y-%m-%d %H:%i') AS jamout,
  AVG(DISTINCT TIMESTAMPDIFF(MINUTE,
  STR_TO_date(CONCAT(tgl_proses_in, ' ', jam_in),'%Y-%m-%d %H:%i'),
  STR_TO_date(CONCAT(tgl_proses_out, ' ', jam_out),'%Y-%m-%d %H:%i'))) as `lama`,
  AVG(IF(LOCATE('ADIDAS',langganan) >0, TIMESTAMPDIFF(MINUTE,
  STR_TO_date(CONCAT(tgl_proses_in, ' ', jam_in),'%Y-%m-%d %H:%i'),
  STR_TO_date(CONCAT(tgl_proses_out, ' ', jam_out),'%Y-%m-%d %H:%i')), 0)) as `lamaadidas`
FROM
	tbl_produksi
WHERE 
" . $tgl . $shift . " AND not energi ='' AND not ISNULL(energi) AND not ISNULL(jam_in) AND not ISNULL(jam_out)
AND not jam_in='' AND not jam_out='' and not ISNULL(tgl_proses_in) and not ISNULL(tgl_proses_out) 
AND not tgl_proses_in='' AND not tgl_proses_out=''
GROUP BY energi ORDER BY energi ASC");
              $c = 1;
              $n = 1;
              while ($rng = mysqli_fetch_array($sqlenergi)) {
                $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
                ?>
                <tr style="border:1px solid;" bgcolor="<?php echo $bgcolor; ?>">
                  <td style="border:1px solid;">
                    <div align="center"><strong><?php echo $n; ?></strong></div>
                  </td>
                  <td style="border:1px solid;">
                    <div align="right"><strong><?php echo $rng['energi']; ?></strong></div>
                  </td>
                  <td style="border:1px solid;">
                    <div align="right">
                    <?php $jam = floor(round($rng['lama']) / 60);
                    $menit = round($rng['lama']) % 60;
                    echo $jam . " Jam " . $menit . " Menit"; ?>
                    </div>
                  </td>
                  <td style="border:1px solid;">
                    <div align="right"><?php echo round($rng['lama']); ?></div>
                  </td>
                  <td style="border:1px solid;">
                    <div align="right">
                    <?php $jamadidas = floor(round($rng['lamaadidas']) / 60);
                    $menitadidas = round($rng['lamaadidas']) % 60;
                    echo $jamadidas . " Jam " . $menitadidas . " Menit"; ?>
                    </div>
                  </td>
                  <td style="border:1px solid;">
                    <div align="right"><?php echo round($rng['lamaadidas']); ?></div>
                  </td>
                </tr>
                <?php
                $ttlLamaE = $ttlLamaE + $rng['lama'];
                $Ejam = floor(round($ttlLamaE) / 60);
                $Emenit = round($ttlLamaE) % 60;
                $ttlLamaEadidas = $ttlLamaEadidas + $rng['lamaadidas'];
                $Ejamadidas = floor(round($ttlLamaEadidas) / 60);
                $Emenitadidas = round($ttlLamaEadidas) % 60;
                $ttlLamaEr = $ttlLamaE / $n;
                $ttlLamaEradidas = $ttlLamaEadidas / $n;
                $Ejamr = floor(round($ttlLamaEr) / 60);
                $Emenitr = round($ttlLamaEr) % 60;
                $Ejamradidas = floor(round($ttlLamaEradidas) / 60);
                $Emenitradidas = round($ttlLamaEradidas) % 60;
                $n++;
              } ?>
              <tr bgcolor="#99FF99" style="border:1px solid;">
                <td style="border:1px solid;">&nbsp;</td>
                <td style="border:1px solid;"><strong>Total</strong></td>
                <td style="border:1px solid;">
                  <div align="right"><strong><?php echo $Ejam . " Jam " . $Emenit . " Menit"; ?></strong>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right"><strong><?php echo round($ttlLamaE); ?></strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                    <strong><?php echo $Ejamadidas . " Jam " . $Emenitadidas . " Menit"; ?></strong>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right"><strong><?php echo round($ttlLamaEadidas); ?></strong></div>
                </td>
              </tr>
              <tr bgcolor="#99FF99" style="border:1px solid;">
                <td style="border:1px solid;">&nbsp;</td>
                <td style="border:1px solid;"><strong>Rata-Rata</strong></td>
                <td style="border:1px solid;">
                  <div align="right"><strong><?php echo $Ejamr . " Jam " . $Emenitr . " Menit"; ?></strong>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right"><strong><?php echo round($ttlLamaEr); ?></strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                    <strong><?php echo $Ejamradidas . " Jam " . $Emenitradidas . " Menit"; ?></strong>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right"><strong><?php echo round($ttlLamaEradidas); ?></strong></div>
                </td>
              </tr>
            </table>
          </td>
          <td align="left" valign="top">
            <table width="100%" border="0">
              <tr style="border:1px solid;">
                <td rowspan="3" valign="middle" bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>No.</strong></div>
                </td>
                <td rowspan="3" valign="middle" bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Machine Utilization</strong></div>
                </td>
                <td colspan="2" bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>ALL BUYER</strong></div>
                </td>
                <td colspan="2" bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>BUYER ADIDAS</strong></div>
                </td>
              </tr>
              <tr style="border:1px solid;">
                <td colspan="2" bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Average</strong></div>
                </td>
                <td colspan="2" bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Average</strong></div>
                </td>
              </tr>
              <tr style="border:1px solid;">
                <td bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Lama Stop</strong></div>
                </td>
                <td bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Menit</strong></div>
                </td>
                <td bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Lama Stop</strong></div>
                </td>
                <td bgcolor="#99FF99" style="border:1px solid;">
                  <div align="center"><strong>Menit</strong></div>
                </td>
              </tr>
              <?php
              $sqlSM = mysqli_query($con, "SELECT
	kd_stop,
	STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i') AS mulai,
	STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i') AS selesai,
  AVG(DISTINCT TIMESTAMPDIFF(MINUTE,
  STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i'),
  STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i'))) as `lama`,
  AVG(IF(LOCATE('ADIDAS',langganan) >0, TIMESTAMPDIFF(MINUTE,
  STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i'),
  STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i')), 0)) as `lamaadidas`
FROM
	tbl_produksi
WHERE 
" . $tgl . $shift . " AND not kd_stop ='' AND not ISNULL(kd_stop) AND not ISNULL(stop_l) AND not ISNULL(stop_r)
AND not stop_l='' AND not stop_r='' and not ISNULL(tgl_stop_l) and not ISNULL(tgl_stop_r) 
AND not tgl_stop_l='' AND not tgl_stop_r='' AND (kd_stop='PT' or kd_stop='PM')
GROUP BY kd_stop ORDER BY kd_stop ASC ");
              $rSM = mysqli_fetch_array($sqlSM);

              $sqlCO = mysqli_query($con, "SELECT
	kd_stop,
	STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i') AS mulai,
	STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i') AS selesai,
  AVG(DISTINCT TIMESTAMPDIFF(MINUTE,
  STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i'),
  STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i'))) as `lama`,
  AVG(IF(LOCATE('ADIDAS',langganan) >0, TIMESTAMPDIFF(MINUTE,
  STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i'),
  STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i')), 0)) as `lamaadidas`
FROM
	tbl_produksi
WHERE 
" . $tgl . $shift . " AND not kd_stop ='' AND not ISNULL(kd_stop) AND not ISNULL(stop_l) AND not ISNULL(stop_r)
AND not stop_l='' AND not stop_r='' and not ISNULL(tgl_stop_l) and not ISNULL(tgl_stop_r) 
AND not tgl_stop_l='' AND not tgl_stop_r='' AND (kd_stop='PA')
GROUP BY kd_stop ORDER BY kd_stop ASC ");
              $rCO = mysqli_fetch_array($sqlCO);
              $sqlBD = mysqli_query($con, "SELECT
	kd_stop,
	STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i') AS mulai,
	STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i') AS selesai,
  AVG(DISTINCT TIMESTAMPDIFF(MINUTE,
  STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i'),
  STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i'))) as `lama`,
  AVG(IF(LOCATE('ADIDAS',langganan) >0, TIMESTAMPDIFF(MINUTE,
  STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i'),
  STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i')), 0)) as `lamaadidas`
FROM
	tbl_produksi
WHERE 
" . $tgl . $shift . " AND not kd_stop ='' AND not ISNULL(kd_stop) AND not ISNULL(stop_l) AND not ISNULL(stop_r)
AND not stop_l='' AND not stop_r='' and not ISNULL(tgl_stop_l) and not ISNULL(tgl_stop_r) 
AND not tgl_stop_l='' AND not tgl_stop_r='' AND (kd_stop='LM' or kd_stop='KM' or kd_stop='GT')
GROUP BY kd_stop ORDER BY kd_stop ASC ");
              $rBD = mysqli_fetch_array($sqlBD);
              $sqlQC = mysqli_query($con, "SELECT
	kd_stop,
	STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i') AS mulai,
	STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i') AS selesai,
  AVG(DISTINCT TIMESTAMPDIFF(MINUTE,
  STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i'),
  STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i'))) as `lama`,
  AVG(IF(LOCATE('ADIDAS',langganan) >0, TIMESTAMPDIFF(MINUTE,
  STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i'),
  STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i')), 0)) as `lamaadidas`
FROM
	tbl_produksi
WHERE 
" . $tgl . $shift . " AND not kd_stop ='' AND not ISNULL(kd_stop) AND not ISNULL(stop_l) AND not ISNULL(stop_r)
AND not stop_l='' AND not stop_r='' and not ISNULL(tgl_stop_l) and not ISNULL(tgl_stop_r) 
AND not tgl_stop_l='' AND not tgl_stop_r='' AND (kd_stop='AP')
GROUP BY kd_stop ORDER BY kd_stop ASC ");
              $rQC = mysqli_fetch_array($sqlQC);
              $sqlPL = mysqli_query($con, "SELECT
	kd_stop,
	STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i') AS mulai,
	STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i') AS selesai,
  AVG(DISTINCT TIMESTAMPDIFF(MINUTE,
  STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i'),
  STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i'))) as `lama`,
  AVG(IF(LOCATE('ADIDAS',langganan) >0, TIMESTAMPDIFF(MINUTE,
  STR_TO_date(CONCAT(tgl_stop_l, ' ', stop_l),'%Y-%m-%d %H:%i'),
  STR_TO_date(CONCAT(tgl_stop_r, ' ', stop_r),'%Y-%m-%d %H:%i')), 0)) as `lamaadidas`
FROM
	tbl_produksi
WHERE 
" . $tgl . $shift . " AND not kd_stop ='' AND not ISNULL(kd_stop) AND not ISNULL(stop_l) AND not ISNULL(stop_r)
AND not stop_l='' AND not stop_r='' and not ISNULL(tgl_stop_l) and not ISNULL(tgl_stop_r) 
AND not tgl_stop_l='' AND not tgl_stop_r='' AND (kd_stop='KO' or kd_stop='TG')
GROUP BY kd_stop ORDER BY kd_stop ASC ");
              $rPL = mysqli_fetch_array($sqlPL);
              ?>
              <tr bgcolor="#33CCFF" style="border:1px solid;">
                <td style="border:1px solid;">
                  <div align="center"><strong>1</strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="center"><strong>Schedule Maintenance</strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php $jam = floor(round($rSM['lama']) / 60);
                  $menit = round($rSM['lama']) % 60;
                  echo $jam . " Jam " . $menit . " Menit"; ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php if ($rSM > 0) {
                    echo round($rSM['lama']);
                  } else {
                    echo "0";
                  } ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php $jam = floor(round($rSM['lamaadidas']) / 60);
                  $menit = round($rSM['lamaadidas']) % 60;
                  echo $jam . " Jam " . $menit . " Menit"; ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php if ($rSM > 0) {
                    echo round($rSM['lamaadidas']);
                  } else {
                    echo "0";
                  } ?>
                  </div>
                </td>
              </tr>
              <tr bgcolor="#FFCC99" style="border:1px solid;">
                <td style="border:1px solid;">
                  <div align="center"><strong>2</strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="center"><strong>Change Over</strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php $jam = floor(round($rCO['lama']) / 60);
                  $menit = round($rCO['lama']) % 60;
                  echo $jam . " Jam " . $menit . " Menit"; ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php if ($rCO > 0) {
                    echo round($rCO['lama']);
                  } else {
                    echo "0";
                  } ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php $jam = floor(round($rCO['lamaadidas']) / 60);
                  $menit = round($rCO['lamaadidas']) % 60;
                  echo $jam . " Jam " . $menit . " Menit"; ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php if ($rCO > 0) {
                    echo round($rCO['lamaadidas']);
                  } else {
                    echo "0";
                  } ?>
                  </div>
                </td>
              </tr>
              <tr bgcolor="#33CCFF" style="border:1px solid;">
                <td style="border:1px solid;">
                  <div align="center"><strong>3</strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="center"><strong>Breakdown</strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php $jam = floor(round($rBD['lama']) / 60);
                  $menit = round($rBD['lama']) % 60;
                  echo $jam . " Jam " . $menit . " Menit"; ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php if ($rBD > 0) {
                    echo round($rBD['lama']);
                  } else {
                    echo "0";
                  } ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php $jam = floor(round($rBD['lamaadidas']) / 60);
                  $menit = round($rBD['lamaadidas']) % 60;
                  echo $jam . " Jam " . $menit . " Menit"; ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php if ($rBD > 0) {
                    echo round($rBD['lamaadidas']);
                  } else {
                    echo "0";
                  } ?>
                  </div>
                </td>
              </tr>
              <tr bgcolor="#FFCC99" style="border:1px solid;">
                <td style="border:1px solid;">
                  <div align="center"><strong>4</strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="center"><strong>Operating Level</strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php $jam = floor(round($rOL['lama']) / 60);
                  $menit = round($rOL['lama']) % 60;
                  echo $jam . " Jam " . $menit . " Menit"; ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php if ($rOL > 0) {
                    echo round($rOL['lama']);
                  } else {
                    echo "0";
                  } ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php $jam = floor(round($rOL['lamaadidas']) / 60);
                  $menit = round($rOL['lamaadidas']) % 60;
                  echo $jam . " Jam " . $menit . " Menit"; ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php if ($rOL > 0) {
                    echo round($rOL['lamaadidas']);
                  } else {
                    echo "0";
                  } ?>
                  </div>
                </td>
              </tr>
              <tr bgcolor="#33CCFF" style="border:1px solid;">
                <td style="border:1px solid;">
                  <div align="center"><strong>5</strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="center"><strong>QC Check</strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php $jam = floor(round($rQC['lama']) / 60);
                  $menit = round($rQC['lama']) % 60;
                  echo $jam . " Jam " . $menit . " Menit"; ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php if ($rSM > 0) {
                    echo round($rQC['lama']);
                  } else {
                    echo "0";
                  } ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php $jam = floor(round($rQC['lamaadidas']) / 60);
                  $menit = round($rQC['lamaadidas']) % 60;
                  echo $jam . " Jam " . $menit . " Menit"; ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php if ($rSM > 0) {
                    echo round($rQC['lamaadidas']);
                  } else {
                    echo "0";
                  } ?>
                  </div>
                </td>
              </tr>
              <tr bgcolor="#FFCC99" style="border:1px solid;">
                <td style="border:1px solid;">
                  <div align="center"><strong>6</strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="center"><strong>Planning</strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php $jam = floor(round($rPL['lama']) / 60);
                  $menit = round($rPL['lama']) % 60;
                  echo $jam . " Jam " . $menit . " Menit"; ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php if ($rPL > 0) {
                    echo round($rPL['lama']);
                  } else {
                    echo "0";
                  } ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php $jam = floor(round($rPL['lamaadidas']) / 60);
                  $menit = round($rPL['lamaadidas']) % 60;
                  echo $jam . " Jam " . $menit . " Menit"; ?>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                  <?php if ($rPL > 0) {
                    echo round($rPL['lamaadidas']);
                  } else {
                    echo "0";
                  } ?>
                  </div>
                </td>
              </tr>

              <tr bgcolor="#99FF99" style="border:1px solid;">
                <td style="border:1px solid;">&nbsp;</td>
                <td style="border:1px solid;"><strong>Total</strong></td>
                <td style="border:1px solid;">
                  <div align="right">
                    <strong>
                    <?php $ttljam = floor(round($rSM['lama'] + $rCO['lama'] + $rBD['lama'] + $rOL['lama'] + $rQC['lama'] + $rPL['lama']) / 60);
                    $ttlmenit = round($rSM['lama'] + $rCO['lama'] + $rBD['lama'] + $rOL['lama'] + $rQC['lama'] + $rPL['lama']) % 60;
                    echo $ttljam . " Jam " . $ttlmenit . " Menit"; ?>
                    </strong>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                    <strong><?php echo $ttlMenit = round($rSM['lama'] + $rCO['lama'] + $rBD['lama'] + $rOL['lama'] + $rQC['lama'] + $rPL['lama']); ?>
                    </strong>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                    <strong>
                    <?php $ttljamadidas = floor(round($rSM['lamaadidas'] + $rCO['lamaadidas'] + $rBD['lamaadidas'] + $rOL['lamaadidas'] + $rQC['lamaadidas'] + $rPL['lamaadidas']) / 60);
                    $ttlmenitadidas = round($rSM['lamaadidas'] + $rCO['lamaadidas'] + $rBD['lamaadidas'] + $rOL['lamaadidas'] + $rQC['lamaadidas'] + $rPL['lamaadidas']) % 60;
                    echo $ttljamadidas . " Jam " . $ttlmenitadidas . " Menit"; ?>
                    </strong>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                    <strong><?php echo $ttlMadidas = $rSM['lamaadidas'] + $rCO['lamaadidas'] + $rBD['lamaadidas'] + $rOL['lamaadidas'] + $rQC['lamaadidas'] + $rPL['lamaadidas']; ?>
                    </strong>
                  </div>
                </td>
              </tr>
              <tr bgcolor="#99FF99" style="border:1px solid;">
                <td style="border:1px solid;">&nbsp;</td>
                <td style="border:1px solid;"><strong>Rata-Rata</strong></td>
                <td style="border:1px solid;">
                  <div align="right">
                    <strong>
                    <?php $ttljamr = floor((round($rSM['lama'] + $rCO['lama'] + $rBD['lama'] + $rOL['lama'] + $rQC['lama'] + $rPL['lama']) / 6) / 60);
                    $ttlmenitr = round(($rSM['lama'] + $rCO['lama'] + $rBD['lama'] + $rOL['lama'] + $rQC['lama'] + $rPL['lama']) / 6) % 60;
                    echo $ttljamr . " Jam " . $ttlmenitr . " Menit"; ?>
                    </strong>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right"><strong><?php echo round($ttlMenit / 6); ?></strong></div>
                </td>
                <td style="border:1px solid;">
                  <div align="right">
                    <strong>
                    <?php $ttljamadidasr = floor((round($rSM['lamaadidas'] + $rCO['lamaadidas'] + $rBD['lamaadidas'] + $rOL['lamaadidas'] + $rQC['lamaadidas'] + $rPL['lamaadidas']) / 6) / 60);
                    $ttlmenitadidasr = round(($rSM['lamaadidas'] + $rCO['lamaadidas'] + $rBD['lamaadidas'] + $rOL['lamaadidas'] + $rQC['lamaadidas'] + $rPL['lamaadidas']) / 6) % 60;
                    echo $ttljamadidasr . " Jam " . $ttlmenitadidasr . " Menit"; ?>
                    </strong>
                  </div>
                </td>
                <td style="border:1px solid;">
                  <div align="right"><strong><?php echo round($ttlmadidas / 6); ?></strong></div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>


  <?php } ?>

</body>

</html>