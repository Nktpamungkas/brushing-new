<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=report-produksi-" . date($_GET['tglawal']) . ".xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
//disini script laporan anda
?>
<?php
$con = mysqli_connect("10.0.0.10", "dit", "4dm1n", "db_brushing");
// $con=mysqli_connect("localhost","root","","db_brushing");
ini_set("error_reporting", 1);
?>

<body>
  <?php

  $tglawal = $_GET['tglawal'];
  $tglakhir = $_GET['tglakhir'];
  $jamawal = $_GET['jamawal'];
  $jamakhir = $_GET['jamakhir'];
  $shft = $_GET['shift'];
  $nmesin = $_GET['mesin'];
  $mc = $_GET['no_mesin'];

  //  if ($tglakhir != "" and $tglawal != ""){
//    $tgl=" DATE_FORMAT(a.`tgl_update`,'%Y-%m-%d') BETWEEN '$tglawal' AND '$tglakhir' ";
//  }else{
//    $tgl=" ";
//  }
  if ($tglakhir != "" and $tglawal != "" and $jamakhir != "" and $jamawal != "") {
    $tgl = " DATE_FORMAT(a.`tgl_buat`,'%Y-%m-%d %H:%i') BETWEEN '$tglawal $jamawal' AND '$tglakhir $jamakhir' ";
  } else {
    $tgl = " ";
  }
  if ($shft == "ALL") {
    $shift = " ";
  } else {
    $shift = " AND a.`shift`='$shft' ";
  }
  if ($nmesin != "") {
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
  <strong>Periode: <?php echo $tglawal . " " . $jamawal; ?> s/d
    <?php echo $tglakhir . " " . $jamakhir; ?></strong><br>
  <strong>Shift: <?php echo $shft; ?> <br>
    Mesin: <?php echo $nmesin; ?> <br>
    No. Mesin: <?php echo $mc; ?></strong><br />
  <table width="100%" border="1">
    <tr>
      <th rowspan="2" bgcolor="#99FF99">NO.</th>
      <th rowspan="2" bgcolor="#99FF99">SHIFT</th>
      <th rowspan="2" bgcolor="#99FF99">NO MESIN</th>
      <th rowspan="2" bgcolor="#99FF99">LANGGANAN</th>
      <th rowspan="2" bgcolor="#99FF99">BUYER</th>
      <th rowspan="2" bgcolor="#99FF99">NO ORDER</th>
      <th rowspan="2" bgcolor="#99FF99">NO DEMAND</th>
      <th rowspan="2" bgcolor="#99FF99">NO HANGER</th>
      <th rowspan="2" bgcolor="#99FF99">JENIS KAIN</th>
      <th rowspan="2" bgcolor="#99FF99">WARNA</th>
      <th rowspan="2" bgcolor="#99FF99">LOT</th>
      <th rowspan="2" bgcolor="#99FF99">ROLL</th>
      <th rowspan="2" bgcolor="#99FF99">QTY</th>
      <th rowspan="2" bgcolor="#99FF99">PROSES</th>
      <th rowspan="2" bgcolor="#99FF99">KETERANGAN</th>
      <th colspan="4" bgcolor="#99FF99">JAM PROSES</th>
      <th rowspan="2" bgcolor="#99FF99">LAMA PROSES</th>
      <th colspan="4" bgcolor="#99FF99">STOP MESIN 1</th>
      <th rowspan="2" bgcolor="#99FF99">LAMA STOP 1</th>
      <th colspan="4" bgcolor="#99FF99">STOP MESIN 2</th>
      <th rowspan="2" bgcolor="#99FF99">LAMA STOP 2</th>
      <th colspan="4" bgcolor="#99FF99">STOP MESIN 3</th>
      <th rowspan="2" bgcolor="#99FF99">LAMA STOP 3</th>
      <th rowspan="2" bgcolor="#99FF99">KODE STOP 1</th>
      <th rowspan="2" bgcolor="#99FF99">KODE STOP 2</th>
      <th rowspan="2" bgcolor="#99FF99">KODE STOP 3</th>
      <th rowspan="2" bgcolor="#99FF99">OPERATOR</th>
      <th rowspan="2" bgcolor="#99FF99">NO GEROBAK</th>
      <th rowspan="2" bgcolor="#99FF99">JENIS KARTU</th>
      <th rowspan="2" bgcolor="#99FF99">JUMLAH GEROBAK</th>
      <th rowspan="2" bgcolor="#99FF99">Total Waktu</th>
      <th rowspan="2" bgcolor="#99FF99">% Efisiensi</th>
    </tr>
    <tr>
      <th bgcolor="#99FF99">TGL</th>
      <th bgcolor="#99FF99">IN</th>
      <th bgcolor="#99FF99">TGL</th>
      <th bgcolor="#99FF99">OUT</th>
      <th bgcolor="#99FF99">TGL</th>
      <th bgcolor="#99FF99">JAM</th>
      <th bgcolor="#99FF99">TGL</th>
      <th bgcolor="#99FF99">S/D</th>
      <th bgcolor="#99FF99">TGL</th>
      <th bgcolor="#99FF99">JAM</th>
      <th bgcolor="#99FF99">TGL</th>
      <th bgcolor="#99FF99">S/D</th>
      <th bgcolor="#99FF99">TGL</th>
      <th bgcolor="#99FF99">JAM</th>
      <th bgcolor="#99FF99">TGL</th>
      <th bgcolor="#99FF99">S/D</th>
    </tr>
    <?php

    // 		$sql=mysqli_query($con," SELECT 
// 	a.*
// FROM
// 	`tbl_produksi` a	
// WHERE
// 	".$tgl.$shift.$mesin.$nomesin." ORDER BY a.`no_mesin` ASC");
    $sql = mysqli_query($con, "SELECT * FROM `tbl_produksi` a WHERE " . $tgl . $shift . $mesin . $nomesin . " ORDER BY a.`no_mesin` ASC");
    $no = 1;
    $totrol = 0;
    $totberat = 0;
    $c = 0;
    while ($rowd = mysqli_fetch_array($sql)) {
      ?>
      <tr valign="top">
        <td><?php echo $no; ?></td>
        <td><?php echo $rowd['shift']; ?></td>
        <td>'<?php echo $rowd['no_mesin']; ?></td>
        <td>
          <?php $pos = strpos($rowd['langganan'], "/");
          if ($pos > 0) {
            $pos1 = $pos;
            echo $result = substr($rowd['langganan'], 0, $pos1);
          } else {
            echo $rowd['langganan'];
          }
          ?>
        </td>
        <td>
          <?php $pos = strpos($rowd['langganan'], "/");
          if ($pos > 0) {
            $pos1 = $pos + 1;
            echo $result1 = substr($rowd['langganan'], $pos1);
          }
          ?>
        </td>
        <td><?php echo $rowd['no_order']; ?></td>
        <td><?php echo $rowd['nodemand']; ?></td>
        <td><?php echo $rowd['no_item']; ?></td>
        <td><?php echo $rowd['jenis_kain']; ?></td>
        <td><?php echo $rowd['warna']; ?></td>
        <td>'<?php echo $rowd['lot']; ?></td>
        <td><?php echo $rowd['rol']; ?></td>
        <td><?php echo $rowd['qty']; ?></td>
        <td><?php echo $rowd['proses']; ?></td>
        <td><?php echo $rowd['ket']; ?></td>
        <td><?php if ($rowd['jam_in'] != "") {
          echo $rowd['tgl_proses_in'];
        } ?></td>
        <td><?php echo $rowd['jam_in']; ?></td>
        <td><?php if ($rowd['jam_out'] != "") {
          echo $rowd['tgl_proses_out'];
        } ?></td>
        <td><?php echo $rowd['jam_out']; ?></td>
        <td><?php
        date_default_timezone_set('Asia/Jakarta');
        $time3 = strtotime($rowd['tgl_proses_in'] . " " . $rowd['jam_in']);
        $time4 = strtotime($rowd['tgl_proses_out'] . " " . $rowd['jam_out']);
        $diff1 = $time4 - $time3;

        $jam1 = floor($diff1 / (60 * 60));
        $menit1 = $diff1 - $jam1 * (60 * 60);
        echo $jam1 . ' jam ' . floor($menit1 / 60) . ' menit';
        ?></td>
        <td><?php if ($rowd['stop_l'] != "") {
          echo $rowd['tgl_stop_l'];
        } ?></td>
        <td><?php echo $rowd['stop_l']; ?></td>
        <td><?php if ($rowd['stop_r'] != "") {
          echo $rowd['tgl_stop_r'];
        } ?></td>
        <td><?php if ($rowd['stop_r'] != "") {
          echo $rowd['stop_r'];
        } ?></td>
        <td><?php
        date_default_timezone_set('Asia/Jakarta');
        $time1 = strtotime($rowd['tgl_stop_l'] . " " . $rowd['stop_l']);
        $time2 = strtotime($rowd['tgl_stop_r'] . " " . $rowd['stop_r']);
        $diff = $time2 - $time1;

        $jam = floor($diff / (60 * 60));
        $menit = $diff - $jam * (60 * 60);
        echo $jam . ' jam ' . floor($menit / 60) . ' menit';
        ?></td>

        <td><?php if ($rowd['stop_2'] != "") {
          echo $rowd['tgl_stop_2'];
        } ?></td>
        <td><?php echo $rowd['stop_2']; ?></td>
        <td><?php if ($rowd['stop_r_2'] != "") {
          echo $rowd['tgl_stop_r_2'];
        } ?></td>
        <td><?php if ($rowd['stop_r_2'] != "") {
          echo $rowd['stop_r_2'];
        } ?></td>
        <td><?php
        date_default_timezone_set('Asia/Jakarta');
        $time1 = strtotime($rowd['tgl_stop_2'] . " " . $rowd['stop_2']);
        $time2 = strtotime($rowd['tgl_stop_r_2'] . " " . $rowd['stop_r_2']);
        $diff = $time2 - $time1;

        $jam = floor($diff / (60 * 60));
        $menit = $diff - $jam * (60 * 60);
        echo $jam . ' jam ' . floor($menit / 60) . ' menit';
        ?></td>

        <td><?php if ($rowd['stop_3'] != "") {
          echo $rowd['tgl_stop_3'];
        } ?></td>
        <td><?php echo $rowd['stop_3']; ?></td>
        <td><?php if ($rowd['stop_r_3'] != "") {
          echo $rowd['tgl_stop_r_3'];
        } ?></td>
        <td><?php if ($rowd['stop_r_3'] != "") {
          echo $rowd['stop_r_3'];
        } ?></td>
        <td><?php
        date_default_timezone_set('Asia/Jakarta');
        $time1 = strtotime($rowd['tgl_stop_3'] . " " . $rowd['stop_3']);
        $time2 = strtotime($rowd['tgl_stop_r_3'] . " " . $rowd['stop_r_3']);
        $diff = $time2 - $time1;

        $jam = floor($diff / (60 * 60));
        $menit = $diff - $jam * (60 * 60);
        echo $jam . ' jam ' . floor($menit / 60) . ' menit';
        ?></td>

        <td><?php echo $rowd['kd_stop']; ?></td>
        <td><?php echo $rowd['kd_stop2']; ?></td>
        <td><?php echo $rowd['kd_stop3']; ?></td>
        <td><?php echo $rowd['acc_staff']; ?></td>
        <td><?php echo $rowd['no_gerobak']; ?></td>
        <td><?php echo $rowd['jenis_kartu']; ?></td>
        <td><?php echo $rowd['jumlah_gerobak']; ?></td>
        <td><?php
        date_default_timezone_set('Asia/Jakarta');
        // Menit Proses
        $time3 = strtotime($rowd['tgl_proses_in'] . " " . $rowd['jam_in']);
        $time4 = strtotime($rowd['tgl_proses_out'] . " " . $rowd['jam_out']);
        $diff1 = $time4 - $time3;
        $menit_proses = floor($diff1 / 60);

        // Menit lama stop 1
        if (!empty($rowd['tgl_stop_l']) && !empty($rowd['stop_l']) && !empty($rowd['tgl_stop_r']) && !empty($rowd['stop_r'])) {
          $time1 = strtotime($rowd['tgl_stop_l'] . " " . $rowd['stop_l']);
          $time2 = strtotime($rowd['tgl_stop_r'] . " " . $rowd['stop_r']);
          $diff_1 = $time2 - $time1;
          $menit_lama_1 = floor($diff_1 / 60);
        } else {
          $menit_lama_2 = 0; // Atur nilai default jika data tidak lengkap
        }

        // Menit lama stop 2
        if (!empty($rowd['tgl_stop_2']) && !empty($rowd['stop_2']) && !empty($rowd['tgl_stop_r_2']) && !empty($rowd['stop_r_2'])) {
          $time5 = strtotime($rowd['tgl_stop_2'] . " " . $rowd['stop_2']);
          $time6 = strtotime($rowd['tgl_stop_r_2'] . " " . $rowd['stop_r_2']);
          $diff_2 = $time6 - $time5;
          $menit_lama_2 = floor($diff_2 / 60);
        } else {
          $menit_lama_2 = 0; // Atur nilai default jika data tidak lengkap
        }

        // Menit lama stop 3
        if (!empty($rowd['tgl_stop_3']) && !empty($rowd['stop_3']) && !empty($rowd['tgl_stop_r_3']) && !empty($rowd['stop_r_3'])) {
          $time7 = strtotime($rowd['tgl_stop_3'] . " " . $rowd['stop_3']);
          $time8 = strtotime($rowd['tgl_stop_r_3'] . " " . $rowd['stop_r_3']);
          $diff_3 = $time8 - $time7;
          $menit_lama_3 = floor($diff_3 / 60);
        } else {
          $menit_lama_3 = 0; // Atur nilai default jika data tidak lengkap
        }

        // Menit Jenis Kartu
        if ($rowd['jenis_kartu'] == "Proses 1 /sd 2 Roll") {
          $menit_jenis_kartu = 15;
        } else if ($rowd['jenis_kartu'] == "Kain Test") {
          $menit_jenis_kartu = 20;
        } else if ($rowd['jenis_kartu'] == "Development Sample") {
          $menit_jenis_kartu = 30;
        } else {
          $menit_jenis_kartu = 0;
        }

        // Menit Jumlah gerobak
        if (!empty($rowd['jumlah_gerobak'])) {
          $jumlah_gerobak = $rowd['jumlah_gerobak'];
          $menit_gerobak = $jumlah_gerobak * 5;
        } else {
          $menit_gerobak = 0;
        }

        $total_menit = $menit_proses + $menit_lama_1 + $menit_lama_2 + $menit_lama_3 + $menit_jenis_kartu + $menit_gerobak;

        echo $total_menit . " Menit";


        ?></td>
        <td><?php
        $efisiensi = ($total_menit / 420) * 100;
        $format_efisiensi = number_format($efisiensi, 2);

        echo $format_efisiensi . " %";


        ?></td>
      </tr>


      <?php
      $totrol += $rowd['rol'];
      $totberat += $rowd['qty'];
      $no++;
    } ?>
    <tr>
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
    <tr>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">Total</td>
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99"><?php echo $totrol; ?></td>
      <td bgcolor="#99FF99"><?php echo $totberat; ?></td>
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
      <td bgcolor="#99FF99">&nbsp;</td>
      <td bgcolor="#99FF99">&nbsp;</td>
    </tr>
    <tr>
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
    <tr>
      <th colspan="3">&nbsp;</th>
      <th colspan="7">DIBUAT OLEH:</th>
      <th colspan="3">DIPERIKSA OLEH:</th>
      <th colspan="29">DIKETAHUI OLEH:</th>
    </tr>
    <tr>
      <td colspan="3">NAMA</td>
      <td colspan="7">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td colspan="29">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">JABATAN</td>
      <td colspan="7">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td colspan="29">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3">TANGGAL</td>
      <td colspan="7">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td colspan="29">&nbsp;</td>
    </tr>
    <tr>
      <td height="60" colspan="3" valign="top">TANDA TANGAN</td>
      <td colspan="7">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td colspan="29">&nbsp;</td>
    </tr>
  </table>
</body>