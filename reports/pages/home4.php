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
      if (lprn == "Stoppage Mesin") {
        window.location.href = "?p=home2";
      }
      if (lprn == "Adm Brushing") {
        window.location.href = "?p=home3";
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
  <form id="form1" name="form1" method="post" action="?p=reports-adm2">
    <table width="470" border="0">
      <tr>
        <td colspan="3">
          <div align="center"><strong>LAPORAN ADM BRUSHING</strong></div>
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
            <option value="Rangkuman Produksi" selected>Rangkuman Produksi</option>
            <option value="Stoppage Mesin">Stoppage Mesin</option>
            <option value="Adm Brushing">Adm Brushing</option>
            <option value="Efisiensi">Efisiensi</option>
            <option value="Schedule">Schedule</option> 
          </select>
        </td>
      </tr>
      <tr valign="middle">
        <td><strong>Laporan</strong></td>
        <td>:</td>
        <td><select name="jenis" id="jenis">
            <option value="Harian">Harian</option>
            <option value="Bulanan">Bulanan</option>
          </select></td>
      </tr>
      <tr valign="middle">
        <td width="127"><strong>Bulan</strong></td>
        <td width="3">:</td>
        <td width="280"><select name="bln" id="bln">
            <option value="01">Januari</option>
            <option value="02">Febuari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">Sepember</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
          </select>
          <select name="thn" id="thn">
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
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