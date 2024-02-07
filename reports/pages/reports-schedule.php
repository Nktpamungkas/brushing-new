<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan IN-OUT Kartu Kerja Finishing</title>
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

        function confirmEdit(url) {
            if (confirm("Ubah data ini?")) {
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
        include("../koneksi.php");
    ?>
    <?php if ($_POST['jenis'] == "Kartu IN" or $_GET['jenis'] == "Kartu IN") { ?>
        <?php
            if ($_POST['awal'] != "") {
                $tglawal = $_POST['awal'];
                $tglakhir = $_POST['akhir'];
                $jns = $_POST['jenis'];
            } else {
                $tglawal = $_GET['tgl1'];
                $tglakhir = $_GET['tgl2'];
                $jns = $_GET['jenis'];
            }
            if ($_POST['shift'] != "") {
                $shft = $_POST['shift'];
            } else {
                $shft = $_GET['shift'];
            }
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
        <input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='index.php'" class="art-button" />
        <input type="hidden" name="button3" id="button3" value="Cetak" onclick="window.open('pages/reports-adm-cetak.php?tglawal=<?php echo $tglawal; ?>&amp;tglakhir=<?php echo $tglakhir; ?>&amp;shift=<?php echo $shft; ?>', '_blank')" class="art-button" />
        <input type="button" name="button" id="button" value="Cetak Ke Excel" onClick="window.location.href='pages/reports-adm-excel-schedule.php?tgl1=<?php echo $tglawal; ?>&amp;tgl2=<?php echo $tglakhir; ?>&amp;shift=<?php echo $shft; ?>&amp;jenis=<?php echo $jns; ?>'" class="art-button" />
        <br />
        <strong><br />
        </strong>
        <form id="form1" name="form1" method="post" action="">
            <strong> Periode: <?php echo $tglawal; ?> s/d <?php echo $tglakhir; ?></strong><br />
            <strong>Shift: <?php echo $shft; ?></strong>
            <strong><br />
                Kartu Kerja IN</strong>
            <table width="100%" border="1" id="datatables" class="display">
                <thead>
                    <tr>
                        <th width="7%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">TGL MASUK</font>
                                </strong></div>
                        </th>
                        <th width="7%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JAM MASUK</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">GROUP SHIFT</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">SHIFT</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">NOKK</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">NO DEMAND</font>
                                </strong></div>
                        </th>
                        <th width="8%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">LANGGANAN</font>
                                </strong></div>
                        </th>
                        <th width="8%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">BUYER</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">ORDER</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">HANGER</font>
                                </strong></div>
                        </th>
                        <th width="7%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JENIS KAIN</font>
                                </strong></div>
                        </th>
                        <th width="7%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">NO WARNA</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">WARNA</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">LOT</font>
                                </strong></div>
                        </th>
                        <th width="3%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">ROLL</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">QTY (Kg)</font>
                                </strong></div>
                        </th>
                        <th width="6%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">QTY (yard)</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">PROSES</font>
                                </strong></div>
                        </th>
                        <th width="9%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JENIS KK</font>
                                </strong></div>
                        </th>
                        <th width="9%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">Nama Mesin</font>
                                </strong></div>
                        </th>
                        <th width="9%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">AKSI</font>
                                </strong></div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = mysqli_query($con, "SELECT 
                                                        *,`id` as `idp`,
                                                        SUBSTR(langganan, LOCATE('/', langganan)+1)	AS buyer
                                                    FROM
                                                        `tbl_adm`
                                                    WHERE
                                                        `status`='1' AND " . $tgl . $shift . " ORDER BY `tgl_in` ASC ");
                        if ($hal > 0) {
                            $no = $hal + 1;
                        } else {
                            $no = 1;
                        }

                        $c = 0;
                        while ($rowd = mysqli_fetch_array($sql)) {
                            $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
                    ?>
                        <tr>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo date('Y-m-d', strtotime($rowd['tgl_in'])); ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo date('H:i', strtotime($rowd['tgl_in'])); ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['shift']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['shift1']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['nokk']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['nodemand']; ?></font>
                                </div>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['langganan']; ?>"><?php echo substr($rowd['langganan'], 0, 20) . ".."; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><b title="<?= $rowd['buyer']; ?>"><?= $rowd['buyer']; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><?php echo $rowd['no_order']; ?></font>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['no_item']; ?></font>
                                </div>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['jenis_kain']; ?>"><?php echo substr($rowd['jenis_kain'], 0, 20) . ".."; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['no_warna'], 0, 10) . ".."; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['warna'], 0, 10) . ".."; ?></b></font>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['lot']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['rol']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['qty']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['panjang']; ?></font>
                                </div>
                            </td>
                            <td>
                                <font size="-2"><?php echo $rowd['proses']; ?></font>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['kondisi_kain']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2">
                                        <?php
                                            $q_namamesin = mysqli_query($con, "SELECT * FROM tbl_namamesin WHERE id='$rowd[nama_mesin]'");
                                            $row_namamesin = mysqli_fetch_assoc($q_namamesin);

                                            echo $row_namamesin['nama_mesin'].'-'.$row_namamesin['no_mesin'];
                                        ?>
                                    </font>
                                </div>
                            </td>
                            <td>
                                <input type="button" name="hapus" id="hapus" value="Hapus" onClick="confirmDelete('?p=hapus-report-adm&id=<?php echo $rowd['idp']; ?>&tgl1=<?php echo $tglawal; ?>&tgl2=<?php echo $tglakhir; ?>&shift=<?php echo $shft; ?>&jenis=Kartu IN');" />
                                <input type="button" name="ubah2" id="ubah2" value="ubah" onclick="confirmEdit('?p=edit-report-schedule&id=<?= $rowd['idp']; ?>')" />
                            </td>
                        </tr>
                    <?php
                        $totqty = $totqty + $rowd['rol'];
                        $totberat = $totberat + $rowd['qty'];
                        $totyard = $totyard + $rowd['panjang'];
                        $no++;
                    } ?>
                </tbody>
                <tfoot>
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
                        <td bgcolor="#99FF99"><strong>Total</strong></td>
                        <td bgcolor="#99FF99"><strong><?php echo $totqty; ?></strong></td>
                        <td bgcolor="#99FF99"><strong><?php echo $totberat; ?></strong></td>
                        <td bgcolor="#99FF99"><strong><?php echo $totyard; ?></strong></td>
                        <td bgcolor="#99FF99">&nbsp;</td>
                        <td bgcolor="#99FF99">&nbsp;</td>
                        <td bgcolor="#99FF99">&nbsp;</td>
                    </tr>
                </tfoot>
            </table>
        </form>
    <?php } else if ($_POST['jenis'] == "Kartu OUT" or $_GET['jenis'] == "Kartu OUT") { ?>
        <?php
            if ($_POST['awal'] != "") {
                $tglawal = $_POST['awal'];
                $tglakhir = $_POST['akhir'];
                $jns = $_POST['jenis'];
            } else {
                $tglawal = $_GET['tgl1'];
                $tglakhir = $_GET['tgl2'];
                $jns = $_GET['jenis'];
            }
            if ($_POST['shift'] != "") {
                $shft = $_POST['shift'];
            } else {
                $shft = $_GET['shift'];
            }
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
        <input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='index.php'" class="art-button" />
        <input type="hidden" name="button3" id="button3" value="Cetak" onclick="window.open('pages/reports-adm-cetak.php?tglawal=<?php echo $tglawal; ?>&amp;tglakhir=<?php echo $tglakhir; ?>&amp;shift=<?php echo $shft; ?>', '_blank')" class="art-button" />
        <input type="button" name="button" id="button" value="Cetak Ke Excel" onClick="window.location.href='pages/reports-adm-excel.php?tgl1=<?php echo $tglawal; ?>&amp;tgl2=<?php echo $tglakhir; ?>&amp;shift=<?php echo $shft; ?>&amp;jenis=<?php echo $jns; ?>'" class="art-button" />
        <br />
        <strong><br />
        </strong>
        <form id="form1" name="form1" method="post" action="">
            <strong> Periode: <?php echo $tglawal; ?> s/d <?php echo $tglakhir; ?></strong><br />
            <strong>Shift: <?php echo $shft; ?></strong>
            <strong><br />
                Kartu Kerja OUT</strong>
            <table width="100%" border="1" id="datatables" class="display">
                <thead>
                    <tr>
                        <th colspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">MASUK</font>
                                </strong></div>
                        </th>
                        <th colspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">KELUAR</font>
                                </strong></div>
                        </th>
                        <th colspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">MASUK</font>
                                </strong></div>
                        </th>
                        <th colspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">KELUAR</font>
                                </strong></div>
                        </th>
                        <th width="3%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">NOKK</font>
                                </strong></div>
                        </th>
                        <th width="3%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">NO DEMAND</font>
                                </strong></div>
                        </th>
                        <th width="6%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">LANGGANAN</font>
                                </strong></div>
                        </th>
                        <th width="6%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">BUYER</font>
                                </strong></div>
                        </th>
                        <th width="3%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">ORDER</font>
                                </strong></div>
                        </th>
                        <th width="4%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">HANGER</font>
                                </strong></div>
                        </th>
                        <th width="4%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JENIS KAIN</font>
                                </strong></div>
                        </th>
                        <th width="4%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">NO WARNA</font>
                                </strong></div>
                        </th>
                        <th width="3%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">WARNA</font>
                                </strong></div>
                        </th>
                        <th width="3%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">LOT</font>
                                </strong></div>
                        </th>
                        <th width="3%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">ROLL</font>
                                </strong></div>
                        </th>
                        <th colspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">QTY</font>
                                </strong></div>
                        </th>
                        <th colspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">TOTAL</font>
                                </strong></div>
                        </th>
                        <th width="9%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JENIS KK</font>
                                </strong></div>
                        </th>
                        <th width="9%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">PROSES DEPT. BERIKUTNYA</font>
                                </strong></div>
                        </th>
                        <th width="9%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">AKSI</font>
                                </strong></div>
                        </th>
                    </tr>
                    <tr>
                        <th width="4%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">TGL</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JAM</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">TGL</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JAM</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">GROUP SHIFT</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">SHIFT</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">GROUP SHIFT</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">SHIFT</font>
                                </strong></div>
                        </th>
                        <th width="3%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2"> (Kg)</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2"> (yard)</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JAM</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">HARI</font>
                                </strong></div>
                        </th>
                    </tr>
                </thead>
                <tbody>
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
                        <tr>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo date('Y-m-d', strtotime($rowd['tgl_in'])); ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo date('H:i', strtotime($rowd['tgl_in'])); ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo date('Y-m-d', strtotime($rowd['tgl_out'])); ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo date('H:i', strtotime($rowd['tgl_out'])); ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['shift']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['shift1']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['shift_out']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['shift1_out']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['nokk']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['nodemand']; ?></font>
                                </div>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['langganan']; ?>"><?php echo substr($rowd['langganan'], 0, 20) . ".."; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><b title="<?= $rowd['buyer']; ?>"><?= $rowd['buyer']; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><?php echo $rowd['no_order']; ?></font>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['no_item']; ?></font>
                                </div>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['jenis_kain']; ?>"><?php echo substr($rowd['jenis_kain'], 0, 20) . ".."; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['no_warna'], 0, 10) . ".."; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['warna'], 0, 10) . ".."; ?></b></font>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['lot']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['rol']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['qty']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['panjang']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center"><?php
                                                    $awal  = strtotime($rowd['tgl_in']);
                                                    $akhir = strtotime($rowd['tgl_out']);
                                                    $diff  = ($akhir - $awal);

                                                    $jam   = floor($diff / (60 * 60));
                                                    $menit = $diff - $jam * (60 * 60);
                                                    $tjam = round($diff / (60 * 60), 2);
                                                    $hari   = round($tjam / 24, 2);
                                                    ?><font size="-2" <?php if ($jam < 0) { ?> color="#E91013" <?php } ?>><?php echo $jam .  'H,' . floor($menit / 60) . 'M'; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $hari; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['kondisi_kain']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['tujuan']; ?></font>
                                </div>
                            </td>
                            <td><input type="button" name="hapus" id="hapus" value="Hapus" onClick="confirmDelete('?p=hapus-report-adm&id=<?php echo $rowd['idp']; ?>&tgl1=<?php echo $tglawal; ?>&tgl2=<?php echo $tglakhir; ?>&shift=<?php echo $shft; ?>&jenis=Kartu OUT');" />
                                <input type="button" name="ubah" id="ubah" value="ubah" onclick="confirmEdit('?p=edit-report&amp;id=<?php echo $rowd['idp']; ?>&amp;tgl1=<?php echo $tglawal; ?>&amp;tgl2=<?php echo $tglakhir; ?>&amp;shift=<?php echo $shft; ?>&amp;jenis=Kartu OUT');" />
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
                </tbody>
                <tfoot>
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
                        <td bgcolor="#99FF99"><strong>Total</strong></td>
                        <td bgcolor="#99FF99"><strong><?php echo $totqty; ?></strong></td>
                        <td bgcolor="#99FF99"><strong><?php echo $totberat; ?></strong></td>
                        <td bgcolor="#99FF99"><strong><?php echo $totyard; ?></strong></td>
                        <td bgcolor="#99FF99">
                            <?php $jam1   = floor($totjam / (60 * 60));
                            $menit1 = $totjam - $jam1 * (60 * 60);
                            echo $jam1 .  'H,' . floor($menit1 / 60) . 'M'; ?></td>
                        <td bgcolor="#99FF99"><strong><?php echo $tothari; ?></strong></td>
                        <td bgcolor="#99FF99">&nbsp;</td>
                        <td bgcolor="#99FF99">&nbsp;</td>
                        <td bgcolor="#99FF99">&nbsp;</td>
                    </tr>
                </tfoot>
            </table>
        </form>
    <?php } else if ($_POST['jenis'] == "Detail Kartu IN" or $_GET['jenis'] == "Detail Kartu IN") { ?>
        <?php
        if ($_POST['awal'] != "") {
            $tglawal = $_POST['awal'];
            $tglakhir = $_POST['akhir'];
            $jns = $_POST['jenis'];
        } else {
            $tglawal = $_GET['tgl1'];
            $tglakhir = $_GET['tgl2'];
            $jns = $_GET['jenis'];
        }
        if ($_POST['shift'] != "") {
            $shft = $_POST['shift'];
        } else {
            $shft = $_GET['shift'];
        }
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
        <input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='index.php'" class="art-button" />
        <input type="hidden" name="button3" id="button3" value="Cetak" onclick="window.open('pages/reports-adm-cetak.php?tglawal=<?php echo $tglawal; ?>&amp;tglakhir=<?php echo $tglakhir; ?>&amp;shift=<?php echo $shft; ?>', '_blank')" class="art-button" />
        <input type="button" name="button" id="button" value="Cetak Ke Excel" onClick="window.location.href='pages/reports-adm-excel.php?tgl1=<?php echo $tglawal; ?>&amp;tgl2=<?php echo $tglakhir; ?>&amp;shift=<?php echo $shft; ?>&amp;jenis=<?php echo $jns; ?>'" class="art-button" />
        <br />
        <strong><br />
        </strong>
        <form id="form1" name="form1" method="post" action="">
            <strong> Periode: <?php echo $tglawal; ?> s/d <?php echo $tglakhir; ?></strong><br />
            <strong>Shift: <?php echo $shft; ?></strong>
            <strong><br />
                Detail Kartu Kerja IN</strong>
            <table width="100%" border="1" id="datatables" class="display">
                <thead>
                    <tr>
                        <th width="7%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">TGL MASUK</font>
                                </strong></div>
                        </th>
                        <th width="7%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JAM MASUK</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">GROUP SHIFT</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">SHIFT</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">NOKK</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">NO DEMAND</font>
                                </strong></div>
                        </th>
                        <th width="8%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">LANGGANAN</font>
                                </strong></div>
                        </th>
                        <th width="8%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">BUYER</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">ORDER</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">HANGER</font>
                                </strong></div>
                        </th>
                        <th width="7%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JENIS KAIN</font>
                                </strong></div>
                        </th>
                        <th width="7%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">NO WARNA</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">WARNA</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">LOT</font>
                                </strong></div>
                        </th>
                        <th width="3%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">ROLL</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">QTY (Kg)</font>
                                </strong></div>
                        </th>
                        <th width="6%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">QTY (yard)</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">PROSES</font>
                                </strong></div>
                        </th>
                        <th width="9%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JENIS KK</font>
                                </strong></div>
                        </th>
                        <th width="9%" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">STATUS</font>
                                </strong></div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = mysqli_query($con, " SELECT 
                                          *,`id` as `idp`,
                                          SUBSTR(langganan, LOCATE('/', langganan)+1)	AS buyer
                                        FROM
                                          `tbl_adm`
                                        WHERE
                                          (`status`='1' OR `status`='2') AND " . $tgl . $shift . " ORDER BY `tgl_in` ASC ");
                    if ($hal > 0) {
                        $no = $hal + 1;
                    } else {
                        $no = 1;
                    }

                    $c = 0;
                    while ($rowd = mysqli_fetch_array($sql)) {
                        $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
                    ?>
                        <tr>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo date('Y-m-d', strtotime($rowd['tgl_in'])); ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo date('H:i', strtotime($rowd['tgl_in'])); ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['shift']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['shift1']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['nokk']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['nodemand']; ?></font>
                                </div>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['langganan']; ?>"><?php echo substr($rowd['langganan'], 0, 20) . ".."; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><b title="<?= $rowd['buyer']; ?>"><?= $rowd['buyer']; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><?php echo $rowd['no_order']; ?></font>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['no_item']; ?></font>
                                </div>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['jenis_kain']; ?>"><?php echo substr($rowd['jenis_kain'], 0, 20) . ".."; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['no_warna'], 0, 10) . ".."; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['warna'], 0, 10) . ".."; ?></b></font>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['lot']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['rol']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['qty']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['panjang']; ?></font>
                                </div>
                            </td>
                            <td>
                                <font size="-2"><?php echo $rowd['proses']; ?></font>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['kondisi_kain']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php if ($rowd['status'] == "2") {
                                                        echo "<font color='red'>Kartu Sudah Keluar Ke " . $rowd['tujuan'] . "</font>";
                                                    } ?></font>
                                </div>
                            </td>
                        </tr>
                    <?php
                        $totqty = $totqty + $rowd['rol'];
                        $totberat = $totberat + $rowd['qty'];
                        $totyard = $totyard + $rowd['panjang'];
                        $no++;
                    } ?>
                </tbody>
                <tfoot>
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
                        <td bgcolor="#99FF99"><strong>Total</strong></td>
                        <td bgcolor="#99FF99"><strong><?php echo $totqty; ?></strong></td>
                        <td bgcolor="#99FF99"><strong><?php echo $totberat; ?></strong></td>
                        <td bgcolor="#99FF99"><strong><?php echo $totyard; ?></strong></td>
                        <td bgcolor="#99FF99">&nbsp;</td>
                        <td bgcolor="#99FF99">&nbsp;</td>
                        <td bgcolor="#99FF99">&nbsp;</td>
                    </tr>
                </tfoot>
            </table>
        </form>

    <?php } else {

        if ($_POST['awal'] != "") {
            $tglawal = $_POST['awal'];
            $tglakhir = $_POST['akhir'];
            $jns = $_POST['jenis'];
        } else {
            $tglawal = $_GET['tgl1'];
            $tglakhir = $_GET['tgl2'];
            $jns = $_GET['jenis'];
        }
        if ($_POST['shift'] != "") {
            $shft = $_POST['shift'];
        } else {
            $shft = $_GET['shift'];
        }
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
        if ($jns != "") {
            $jkk = " AND `kondisi_kain`='$jns' ";
        } else {
            $jkk = "";
        }
    ?>
        <input type="button" name="button2" id="button2" value="Kembali" onclick="window.location.href='index.php'" class="art-button" />
        <input type="hidden" name="button3" id="button3" value="Cetak" onclick="window.open('pages/reports-adm-cetak.php?tglawal=<?php echo $tglawal; ?>&amp;tglakhir=<?php echo $tglakhir; ?>&amp;shift=<?php echo $shft; ?>', '_blank')" class="art-button" />
        <input type="button" name="button" id="button" value="Cetak Ke Excel" onClick="window.location.href='pages/reports-adm-excel.php?tgl1=<?php echo $tglawal; ?>&amp;tgl2=<?php echo $tglakhir; ?>&amp;shift=<?php echo $shft; ?>&amp;jenis=<?php echo $jns; ?>'" class="art-button" />
        <br />
        <strong><br />
        </strong>
        <form id="form1" name="form1" method="post" action="">
            <strong> Periode: <?php echo $tglawal; ?> s/d <?php echo $tglakhir; ?></strong><br />
            <strong>Shift: <?php echo $shft; ?></strong>
            <strong><br />
                Kartu Kerja <?php echo $jns; ?></strong>
            <table width="100%" border="1" id="datatables" class="display">
                <thead>
                    <tr>
                        <th colspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">MASUK</font>
                                </strong></div>
                        </th>
                        <th colspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">KELUAR</font>
                                </strong></div>
                        </th>
                        <th colspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">MASUK</font>
                                </strong></div>
                        </th>
                        <th colspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">KELUAR</font>
                                </strong></div>
                        </th>
                        <th width="3%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">NOKK</font>
                                </strong></div>
                        </th>
                        <th width="3%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">NO DEMAND</font>
                                </strong></div>
                        </th>
                        <th width="6%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">LANGGANAN</font>
                                </strong></div>
                        </th>
                        <th width="6%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">BUYER</font>
                                </strong></div>
                        </th>
                        <th width="3%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">ORDER</font>
                                </strong></div>
                        </th>
                        <th width="4%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">HANGER</font>
                                </strong></div>
                        </th>
                        <th width="4%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JENIS KAIN</font>
                                </strong></div>
                        </th>
                        <th width="4%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">NO WARNA</font>
                                </strong></div>
                        </th>
                        <th width="3%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">WARNA</font>
                                </strong></div>
                        </th>
                        <th width="3%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">LOT</font>
                                </strong></div>
                        </th>
                        <th width="3%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">ROLL</font>
                                </strong></div>
                        </th>
                        <th colspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">QTY</font>
                                </strong></div>
                        </th>
                        <th colspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">TOTAL</font>
                                </strong></div>
                        </th>
                        <th width="9%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JENIS KK</font>
                                </strong></div>
                        </th>
                        <th width="9%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">PROSES DEPT. BERIKUTNYA</font>
                                </strong></div>
                        </th>
                        <th width="9%" rowspan="2" style="border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">AKSI</font>
                                </strong></div>
                        </th>
                    </tr>
                    <tr>
                        <th width="4%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">TGL</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JAM</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">TGL</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JAM</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">GROUP SHIFT</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">SHIFT</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">GROUP SHIFT</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">SHIFT</font>
                                </strong></div>
                        </th>
                        <th width="3%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2"> (Kg)</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2"> (yard)</font>
                                </strong></div>
                        </th>
                        <th width="4%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">JAM</font>
                                </strong></div>
                        </th>
                        <th width="5%" style="border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;">
                            <div align="center"><strong>
                                    <font size="-2">HARI</font>
                                </strong></div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = mysqli_query($con, " SELECT 
                                          *,`id` as `idp`,DATEDIFF(tgl_out,tgl_in) as 'Hari', TIMEDIFF(tgl_out,tgl_in) as 'Jam',
                                          SUBSTR(langganan, LOCATE('/', langganan)+1)	AS buyer
                                        FROM
                                          `tbl_adm`
                                        WHERE
                                          `status`='2' AND " . $tgl . $shift . $jkk . " ORDER BY `tgl_in` ASC ");
                    $no = 1;
                    $c = 0;
                    while ($rowd = mysqli_fetch_array($sql)) {
                        $bgcolor = ($c++ & 1) ? '#33CCFF' : '#FFCC99';
                    ?>
                        <tr>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo date('Y-m-d', strtotime($rowd['tgl_in'])); ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo date('H:i', strtotime($rowd['tgl_in'])); ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo date('Y-m-d', strtotime($rowd['tgl_out'])); ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo date('H:i', strtotime($rowd['tgl_out'])); ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['shift']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['shift1']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['shift_out']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['shift1_out']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['nokk']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['nodemand']; ?></font>
                                </div>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['langganan']; ?>"><?php echo substr($rowd['langganan'], 0, 20) . ".."; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><b title="<?= $rowd['buyer']; ?>"><?= $rowd['buyer']; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><?php echo $rowd['no_order']; ?></font>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['no_item']; ?></font>
                                </div>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['jenis_kain']; ?>"><?php echo substr($rowd['jenis_kain'], 0, 20) . ".."; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['no_warna'], 0, 10) . ".."; ?></b></font>
                            </td>
                            <td>
                                <font size="-2"><b title="<?php echo $rowd['warna']; ?>"><?php echo substr($rowd['warna'], 0, 10) . ".."; ?></b></font>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['lot']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['rol']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['qty']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['panjang']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center"><?php
                                                    $awal  = strtotime($rowd['tgl_in']);
                                                    $akhir = strtotime($rowd['tgl_out']);
                                                    $diff  = ($akhir - $awal);

                                                    $jam   = floor($diff / (60 * 60));
                                                    $menit = $diff - $jam * (60 * 60);
                                                    $tjam = round($diff / (60 * 60), 2);
                                                    $hari   = round($tjam / 24, 2);
                                                    ?><font size="-2" <?php if ($jam < 0) { ?> color="#E91013" <?php } ?>><?php echo $jam .  'H,' . floor($menit / 60) . 'M'; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $hari; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['kondisi_kain']; ?></font>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <font size="-2"><?php echo $rowd['tujuan']; ?></font>
                                </div>
                            </td>
                            <td><input type="button" name="hapus" id="hapus" value="Hapus" onClick="confirmDelete('?p=hapus-report-adm&id=<?php echo $rowd['idp']; ?>&tgl1=<?php echo $tglawal; ?>&tgl2=<?php echo $tglakhir; ?>&shift=<?php echo $shft; ?>&jenis=Kartu OUT');" />
                                <input type="button" name="ubah" id="ubah" value="ubah" onclick="confirmEdit('?p=edit-report&amp;id=<?php echo $rowd['idp']; ?>&amp;tgl1=<?php echo $tglawal; ?>&amp;tgl2=<?php echo $tglakhir; ?>&amp;shift=<?php echo $shft; ?>&amp;jenis=Kartu OUT');" />
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
                </tbody>
                <tfoot>
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
                        <td bgcolor="#99FF99"><strong>Total</strong></td>
                        <td bgcolor="#99FF99"><strong><?php echo $totqty; ?></strong></td>
                        <td bgcolor="#99FF99"><strong><?php echo $totberat; ?></strong></td>
                        <td bgcolor="#99FF99"><strong><?php echo $totyard; ?></strong></td>
                        <td bgcolor="#99FF99">
                            <?php $jam1   = floor($totjam / (60 * 60));
                            $menit1 = $totjam - $jam1 * (60 * 60);
                            echo $jam1 .  'H,' . floor($menit1 / 60) . 'M'; ?></td>
                        <td bgcolor="#99FF99"><strong><?php echo $tothari; ?></strong></td>
                        <td bgcolor="#99FF99">&nbsp;</td>
                        <td bgcolor="#99FF99">&nbsp;</td>
                        <td bgcolor="#99FF99">&nbsp;</td>
                    </tr>
                </tfoot>
            </table>
        </form>
    <?php } ?>

</body>

</html>