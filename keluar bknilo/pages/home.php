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
  <script>
    function roundToTwo(num) {
      return +(Math.round(num + "e+2") + "e-2");
    }

    function jumlah() {
      var lebar = document.forms['form1']['lebar'].value;
      var berat = document.forms['form1']['gramasi'].value;
      var netto = document.forms['form1']['qty'].value;
      var x, yard;
      x = ((parseInt(lebar)) * parseInt(berat)) / 43.056;
      x1 = (1000 / x);
      yard = x1 * parseFloat(netto);
      document.form1.qty2.value = roundToTwo(yard).toFixed(2);

    }
  </script>
</head>

<body>
  <?php
    function nourut()
    {
      include("../koneksi.php");
      $format = date("ymd");
      $sql = mysqli_query($con, "SELECT nokk FROM tbl_adm WHERE substr(nokk,1,6) like '%" . $format . "%' ORDER BY nokk DESC LIMIT 1 ") or die(mysqli_error());
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

    if ($idkk != "") {
      date_default_timezone_set('Asia/Jakarta');
      $qry1 = mysqli_query($con, "SELECT * FROM tbl_adm WHERE nokk='$idkk' and status='2'  ORDER BY id DESC LIMIT 1");
      $rw1 = mysqli_fetch_array($qry1);
      $rc1 = mysqli_num_rows($qry1);

      $qry = mysqli_query($con, "SELECT * FROM tbl_adm WHERE nokk='$idkk' and status='1' and ISNULL(tgl_out) ORDER BY id DESC LIMIT 1");
      $rw = mysqli_fetch_array($qry);
      $rc = mysqli_num_rows($qry);
      if ($rc > 0) {
      } else {
        echo "<script>alert('Sudah Keluar $rw1[tgl_out] ke $rw1[tujuan]' );</script>";
      }
    }
    //

  ?>

  <?php
    if (isset($_POST['btnSimpan'])) {
      $shift = $_POST['shift'];
      $shift1 = $_POST['shift2'];
      $note = str_replace("'", "''", $_POST['catatan']);
      $tujuan = $_POST['tujuan'];
      $tglout = $_POST['tgl_proses_k'] . " " . $_POST['proses_out'];
      
      $simpanSql = "UPDATE tbl_adm SET
                      `shift_out`='$shift',
                      `shift1_out`='$shift1',
                      `catatan`='$note',
                      `tujuan`='$tujuan',
                      `tgl_update`=now(),
                      `status`='2',
                      `tgl_out`='$tglout'
                  WHERE `id`='$_POST[id]'";
      mysqli_query($con, $simpanSql) or die("Gagal Ubah" . mysqli_error());

      // Refresh form
      echo "<meta http-equiv='refresh' content='0; url=?idkk=$idkk&status=Data Sudah DiUbah'>";
    }
  ?>
  <form id="form1" name="form1" method="post" action="">
    <table width="100%" border="0">
      <tr>
        <td colspan="6" scope="row">
          <h1>Input Data Kartu Kerja Keluar</h1>
        </td>
      </tr>
      <tr>
        <th colspan="6" scope="row">
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
						<option value="KKLama" <?php if($_GET['typekk'] == "KKLama"){ echo "SELECTED"; }?>>KK Lama</option>
						<option value="NOW" <?php if($_GET['typekk'] == "NOW"){ echo "SELECTED"; } ?>>KK NOW</option> -->
					</select=>
				</td>
				<td>
				</td>
				<td width="1%"></td>
				<td width="45%">
				</td>
			</tr> 
      <tr>
				<td width="11%" scope="row">
					<h4>Nokk</h4>
				</td>
				<td width="1%">:</td>
				<td width="28%">
					<input name="nokk" type="text" id="nokk" size="17" onchange="window.location='?typekk='+document.getElementById(`typekk`).value+'&idkk='+this.value" value="<?php echo $_GET['idkk']; ?>" />
					<input type="hidden" value="<?php echo $rw['id']; ?>" name="id" />

					<?php if($_GET['typekk'] == 'NOW') { ?>
						<select style="width: 40%" name="demand" id="demand" onchange='getData_ITXVIEWKK()' required>
								<?php
									if($_GET['idkk']) :
										$qry_demand = db2_exec($conn_db2, "SELECT * FROM ITXVIEWKK WHERE PRODUCTIONORDERCODE LIKE '%$idkk%' AND DEAMAND LIKE '%$nomordemand%'");
								?>
								<option value="" disabled selected>Pilih Nomor Demand</option>
								<?php while ($r_demand = db2_fetch_assoc($qry_demand)) {  ?>
									<option value="<?= $r_demand['DEAMAND']; ?>" <?php if($_GET['demand'] == $r_demand['DEAMAND']){ echo "SELECTED"; } ?>><?= $r_demand['DEAMAND']; ?></option>
								<?php } ?>
								<?php else : ?>
								<option value="" disabled selected>Masukan Nomor Production Order</option>
								<?php endif; ?>
						</select>
					<?php } ?>
				</td>
				<td width="14%">
					<h4>Group Shift</h4>
				</td>
				<td width="1%">:</td>
				<td width="45%">
					<select name="shift" id="shift" required>
						<option value="">Pilih</option>
						<option value="A" <?php if ($rw['shift'] == "A") {
												echo "selected";
											} ?>>A</option>
						<option value="B" <?php if ($rw['shift'] == "B") {
												echo "selected";
											} ?>>B</option>
						<option value="C" <?php if ($rw['shift'] == "C") {
												echo "selected";
											} ?>>C</option>
					</select>
				</td>
			</tr>
      <tr>
        <td scope="row">
          <h4>Langganan/Buyer</h4>
        </td>
        <td>:</td>
        <td><input name="buyer" type="text" id="buyer" size="45" value="<?php if ($cek > 0) {
                                                                          echo $ssr1['partnername'] . "/" . $ssr2['partnername'];
                                                                        } else {
                                                                          echo $rw['langganan'];
                                                                        } ?>" /></td>
        <td><strong>Shift</strong></td>
        <td>:</td>
        <td><select name="shift2" id="shift2" required="required">
            <option value="">Pilih</option>
            <option value="Pagi">Pagi</option>
            <option value="Siang">Siang</option>
            <option value="Malam">Malam</option>
          </select></td>
      </tr>
      <tr>
        <td scope="row">
          <h4>No. Order</h4>
        </td>
        <td>:</td>
        <td><input type="text" name="no_order" id="no_order" value="<?php if ($cek > 0) {
                                                                      echo $ssr['documentno'];
                                                                    } else {
                                                                      echo $rw['no_order'];
                                                                    } ?>" />
        </td>
        <td><strong>Tujuan</strong></td>
        <td>:</td>
        <td><select name="tujuan" id="tujuan" required="required">
            <option value="">Pilih</option>
            <?php $qry1 = mysqli_query($con, "SELECT tujuan FROM tbl_tujuan ORDER BY id ASC");
            while ($r = mysqli_fetch_array($qry1)) {
            ?>
              <option value="<?php echo $r['tujuan']; ?>" <?php if ($rw['tujuan'] == $r['tujuan']) {
                                                            echo "selected";
                                                          } ?>><?php echo $r['tujuan']; ?></option>
            <?php } ?>
          </select>
          <input type="button" name="btnproses" id="btnproses" value="..." onclick="window.open('pages/data-tujuan.php','MyWindow','height=400,width=650');" />
        </td>
      </tr>
      <tr>
        <td valign="top" scope="row">
          <h4>Jenis Kain</h4>
        </td>
        <td valign="top">:</td>
        <td><textarea name="jenis_kain" cols="35" id="jenis_kain"><?php if ($cek > 0) {
                                                                    echo $ssr['productcode'] . " / " . $ssr['description'];
                                                                  } else {
                                                                    echo $rw['jenis_kain'];
                                                                  } ?></textarea></td>
        <td valign="top">
          <h4>Catatan</h4>
        </td>
        <td valign="top">:</td>
        <td valign="top"><textarea name="catatan" cols="35" id="catatan"><?php echo $rw['catatan']; ?></textarea></td>
      </tr>
      <tr>
        <td scope="row"><strong>Hanger/Item</strong></td>
        <td>:</td>
        <td><input type="text" name="no_item" id="no_item" value="<?php if ($cek > 0) {
                                                                    echo $ssr['productcode'];
                                                                  } else {
                                                                    echo $rw['no_item'];
                                                                  } ?>" /></td>
        <td width="14%"><strong>Lebar X Gramasi</strong></td>
        <td width="1%">:</td>
        <td><input name="lebar" type="text" id="lebar" size="6" value="<?php if ($cek > 0) {
                                                                          echo $ssr['cuttablewidth'];
                                                                        } else {
                                                                          echo $rw['lebar'];
                                                                        } ?>" placeholder="0" />
          &quot; X
          <input name="gramasi" type="text" id="gramasi" size="6" value="<?php if ($cek > 0) {
                                                                            echo $ssr['weight'];
                                                                          } else {
                                                                            echo $rw['gramasi'];
                                                                          } ?>" placeholder="0" />
        </td>
      </tr>
      <tr>
        <td scope="row"><strong>No Warna</strong></td>
        <td>:</td>
        <td><input name="no_warna" type="text" id="no_warna" size="35" value="<?php if ($cek > 0) {
                                                                                echo $ssr['colorno'];
                                                                              } else {
                                                                                echo $rw['no_warna'];
                                                                              } ?>" /></td>
        <td width="14%"><strong>Berat</strong></td>
        <td width="1%">:</td>
        <td><input name="qty" type="text" id="qty" size="8" value="<?php if ($cLot > 0) {
                                                                      echo $sLot['Weight'];
                                                                    } else {
                                                                      echo $rw['qty'];
                                                                    } ?>" placeholder="0.00" />
          <strong>Kg</strong>
        </td>
      </tr>
      <tr>
        <td scope="row">
          <h4>Warna</h4>
        </td>
        <td>:</td>
        <td><input name="warna" type="text" id="warna" size="35" value="<?php if ($cek > 0) {
                                                                          echo $ssr['color'];
                                                                        } else {
                                                                          echo $rw['warna'];
                                                                        } ?>" /></td>
        <td><strong>Panjang</strong></td>
        <td>:</td>
        <td><input name="qty2" type="text" id="qty2" size="8" value="<?php echo $rw['panjang']; ?>" placeholder="0.00" onFocus="jumlah();" />
          <strong>Yard</strong>
        </td>
      </tr>
      <tr>
        <td scope="row">
          <h4>Lot</h4>
        </td>
        <td>:</td>
        <td><input name="lot" type="text" id="lot" size="7" value="<?php if ($cLot > 0) {
                                                                      echo $rowLot['TotalLot'] . "-" . $nomorLot;
                                                                    } else {
                                                                      echo $rw['lot'];
                                                                    } ?>" /></td>
        <td>
          <h4>Jam / Tgl Keluar</h4>
        </td>
        <td>:</td>
        <td><input name="proses_out" type="text" id="proses_out" placeholder="00:00" pattern="[0-9]{2}:[0-9]{2}$" title=" e.g 14:25 " onkeyup="
  var time = this.value;
  if (time.match(/^\d{2}$/) !== null) {
     this.value = time + ':';
  } else if (time.match(/^\d{2}\:\d{2}$/) !== null) {
     this.value = time + '';
  }" value="<?php echo $rw['jam_out'] ?>" size="5" maxlength="5" required />
          <input name="tgl_proses_k" type="text" id="tgl_proses_k" placeholder="0000-00-00" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_k);return false;" value="<?php echo $rw['tgl_proses_out']; ?>" size="10" required />
          <a href="javascript:void(0)" onclick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tgl_proses_k);return false;"><img src="../calender/calender.jpeg" alt="" name="popcal" width="30" height="25" id="popcal3" style="border:none" align="absmiddle" border="0" /></a>
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
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="6" scope="row"><input type="submit" name="btnSimpan" id="btnSimpan" value="Simpan" class="art-button" />
          <input type="button" name="batal" id="batal" value="Batal" onclick="window.location.href='index.php'" class="art-button" />
          <input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='../index.php'" class="art-button" />
        </td>
      </tr>
    </table>
  </form>
</body>

</html>