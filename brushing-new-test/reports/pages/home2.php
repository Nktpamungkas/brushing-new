<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Laporan Produksi Brushing</title>
  <script>
    function ganti() {

      var lprn = document.forms['form1']['jns'].value;
      if (lprn == "Produksi Brushing") {
        window.location.href = "?p=home";
      }
      if (lprn == "Adm Brushing") {
        window.location.href = "?p=home3";
      }
      if (lprn == "Rangkuman Produksi") {
        window.location.href = "?p=home4";
      }
      if (lprn == "Efisiensi") {
        window.location.href = "?p=home5";
      }
      if (lprn == "Schedule") {
        window.location.href = "?p=home6";
      }
    }
  </script>
</head>

<body>
  <form id="form1" name="form1" method="post" action="pages/stoppage-cetak.php" target="_blank">
    <table width="470" border="0">
      <tr>
        <td colspan="3">
          <div align="center"><strong>LAPORAN PRODUKSI BRUSHING</strong></div>
          </div>
          <?php
          $user_name = $_SESSION['username'];
          date_default_timezone_set('Asia/Jakarta');
          $tgl = date("Y-M-d h:i:s A");
          echo $tgl; ?><br />
        </td>
      </tr>
      <tr>
        <td><strong>Jenis Laporan</strong></td>
        <td>:</td>
        <td><label for="jns"></label>
          <select name="jns" id="jns" onchange="ganti();">
            <option value="Produksi Brushing">Produksi Brushing</option>
            <option value="Rangkuman Produksi">Rangkuman Produksi</option>
            <option value="Stoppage Mesin" selected>Stoppage Mesin</option>
            <option value="Adm Brushing">Adm Brushing</option>
            <option value="Efisiensi">Efisiensi</option>
            <option value="Schedule">Schedule</option> 
          </select>
        </td>
      </tr>
      <tr valign="middle">
        <td width="127"><strong>Tanggal Awal</strong></td>
        <td width="3">:</td>
        <td width="280"><input name="awal" type="text" id="awal" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;" size="14" required="required" /><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.awal);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
      </tr>
      <tr>

        <td><strong>Tanggal Akhir</strong></td>
        <td>:</td>
        <td width="280"><input name="akhir" type="text" id="akhir" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;" size="14" required="required" /><a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.akhir);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal" style="border:none" align="absmiddle" border="0" /></a></td>
      </tr>
      <tr>
        <td><strong>Mesin</strong></td>
        <td>:</td>
        <td><select name="nama_mesin" id="nama_mesin" onchange="myFunction();" required>
            <option value="">Pilih</option>
            <?php $qry1 = mysqli_query($con, "SELECT nama FROM tbl_mesin ORDER BY nama ASC");
            while ($r = mysqli_fetch_array($qry1)) {
            ?>
              <option value="<?php echo $r['nama']; ?>"><?php echo $r['nama']; ?></option>
            <?php } ?>
          </select></td>
      </tr>
      <tr>
        <td><strong>No Mesin</strong></td>
        <td>:</td>
        <td><select name="no_mesin" id="no_mesin" onchange="myFunction();" required="required">
            <option value="">Pilih</option>
            <?php $qry1 = mysqli_query($con, "SELECT no_mesin FROM tbl_no_mesin ORDER BY no_mesin ASC");
            while ($r = mysqli_fetch_array($qry1)) {
            ?>
              <option value="<?php echo $r['no_mesin']; ?>"><?php echo $r['no_mesin']; ?></option>
            <?php } ?>
          </select></td>
      </tr>
      <tr>
        <td><strong>Group Shift</strong></td>
        <td>:</td>
        <td><label for="shift"></label>
          <select name="shift" id="shift">
            <option value="ALL">ALL</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
          </select>
        </td>
      </tr>
      <tr>
        <td colspan="3"><input type="submit" name="button" id="button" value="Lihat Data" class="art-button" /> <input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='../index.php'" class="art-button" /></td>
      </tr>
    </table>
  </form>
</body>

</html>