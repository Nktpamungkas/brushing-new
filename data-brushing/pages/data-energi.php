<?php
ini_set("error_reporting", 1);
session_start();
include("../../koneksi.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Data Energi</title>
</head>

<body>
  <?php
  if (isset($_POST['btnHapus'])) {
    $hapusSql = "DELETE FROM tbl_energi WHERE id='$_POST[id]'";
    mysql_query($hapusSql) or die("Gagal hapus" . mysql_error());

    // Refresh form
    echo "<meta http-equiv='refresh' content='0; url=data-energi.php?status=Data Sudah DiHapus'>";
  }
  if (isset($_POST['btnSimpan'])) {
    $kode = $_POST[kode];
    $ket = str_replace("'", "", $_POST[ket]);
    $simpanSql = "INSERT INTO tbl_energi SET 
	`kode`='$kode',
	`ket`='$ket'";
    mysql_query($simpanSql) or die("Gagal Simpan" . mysql_error());

    // Refresh form
    echo "<meta http-equiv='refresh' content='0; url=data-energi.php?status=Data Sudah DiSimpan'>";
  }
  if (isset($_POST['btnUbah'])) {
    $kode = $_POST[kode];
    $ket = str_replace("'", "", $_POST[ket]);
    $simpanSql = "UPDATE tbl_energi SET 
	`kode`='$kode',
	`ket`='$ket'
	WHERE `id`='$_POST[id]'";
    mysql_query($simpanSql) or die("Gagal Ubah" . mysql_error());

    // Refresh form
    echo "<meta http-equiv='refresh' content='0; url=data-energi.php?status=Data Sudah DiUbah'>";
  }
  ?>
  <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
    <table width="100%" border="0">
      <tr>
        <th colspan="3" scope="row">Input Data Energi</th>
      </tr>
      <tr>
        <td colspan="3" align="center" scope="row">
          <font color="#FF0000"><?php echo $_GET['status']; ?></font>
        </td>
      </tr>
      <?php $qtampil = mysql_query("SELECT * FROM tbl_energi WHERE kode='$_GET[kode]' LIMIT 1");
      $rt = mysql_fetch_array($qtampil);
      $rc = mysql_num_rows($qtampil);
      ?>
      <tr>
        <td width="21%" scope="row">Kode</td>
        <td width="1%">:</td>
        <td width="78%"><label for="kode"></label>
          <input type="text" name="kode" id="kode" onchange="window.location='data-energi.php?kode='+this.value" value="<?php echo $_GET[kode]; ?>" required="required" />
          <input type="hidden" name="id" value="<?php echo $rt[id]; ?>" />
        </td>
      </tr>
      <tr>
        <td valign="top" scope="row">Keterangan</td>
        <td valign="top">:</td>
        <td><label for="ket"></label>
          <textarea name="ket" cols="45" rows="3" id="ket"><?php echo $rt[ket]; ?></textarea>
        </td>
      </tr>
      <tr>
        <th colspan="3" scope="row"><?php if ($rc == 0) { ?><input type="submit" name="btnSimpan" id="btnSimpan" value="Simpan" /><?php } else { ?>
            <input type="submit" name="btnUbah" id="btnUbah" value="Ubah" />
            <input type="submit" name="btnHapus" id="btnHapus" value="Hapus" /><?php } ?>
          <input type="button" name="tutup" id="tutup" value="Tutup" onclick="window.close();" />
        </th>
      </tr>
    </table>
    <h3>Data Detail Energi</h3>
    <table width="100%" border="0">
      <tr bgcolor="#0099CC">
        <th scope="row">No</th>
        <th bgcolor="#0099CC">Kode</th>
        <th>Keterangan</th>
      </tr>
      <?php
      $qry = mysql_query("SELECT * FROM tbl_energi ORDER BY id ASC");
      $no = 1;
      while ($r = mysql_fetch_array($qry)) {
        $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99'; ?>
        <tr bgcolor="<?php echo $bgcolor; ?>">
          <td align="center" scope="row"><?php echo $no; ?></td>
          <td align="center"><?php echo $r[kode]; ?></td>
          <td><?php echo $r[ket]; ?></td>
        </tr>
      <?php $no++;
      } ?>
      <tr bgcolor="#0099CC">
        <td scope="row">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>

  </form>
</body>

</html>