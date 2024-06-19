<?php
ini_set("error_reporting", 1);
session_start();
include ("../../koneksi.php");
$sql = mysqli_query($con, "SELECT * FROM tbl_splb where NO_KARTU_KERJA = '$_GET[kk]'");
$data = mysqli_fetch_array($sql);
?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style>
    @page {
        size: A4;
        margin: 5px 5px 5px 5px;
        font-size: 3.5pt !important;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    }

    @media print {
        @page {
            /* size: A4; */
            margin: 5px 5px 5px 5px;
            font-size: 3.5pt !important;
        }

        html,
        body {
            /* height: 290mm;
            width: 200mm; */
            background: #FFF;
            overflow: visible;
        }

        /* body {
            padding-top: 15mm;
        } */

        .table-ttd {
            border-collapse: collapse;
            width: 100%;
            font-size: 3.5pt !important;
        }
    }

    .table-ttd {
        border-collapse: collapse;
        width: 100%;
        font-size: 3.5pt !important;
    }

    .table-ttd tr,
    .table-ttd tr td {
        border: 0.5px solid black;
        padding: 1px 0.5px 1px 0.5px;
        font-size: 3.5pt !important;
    }

    .table-ttd>thead>tr>th {
        padding: 1px 1px 1px 1px;
    }

    .rotation {
        transform: rotate(-90deg);
        /* Legacy vendor prefixes that you probably don't need... */
        /* Safari */
        -webkit-transform: rotate(-90deg);
        /* Firefox */
        -moz-transform: rotate(-90deg);
        /* IE */
        -ms-transform: rotate(-90deg);
        /* Opera */
        -o-transform: rotate(-90deg);
        /* Internet Explorer */
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
    }
</style>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SETTING PERBEDAAN LOT BRUSHING</title>
</head>
<link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">

<body>
    <table class="table-ttd" style="width: 70mm; margin-left:10px; margin-top: 10px;">
        <thead>
            <tr>
                <th colspan="16" style="text-align:center">FW-14-BRS-12/00</th>
            </tr>
            <tr>
                <th colspan="15" style="background-color: #4CAF50; text-align: center;">SETTING PERBEDAAN LOT BRUSHING
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">No. KK</td>
                <td class="bg-warning" data-no="2" colspan="8">
                    <?php echo $_GET['kk'] ?>&nbsp;/&nbsp;<?php echo $data['DEAMAND'] ?>
                </td>
                <td data-no="10" colspan="6" style="text-align: center;">SPV/ASST/LDR</td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">LANGGANAN</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['LANGGANAN'] ?></td>
                <td data-no="10" colspan="6" class="bg-warning" style="text-align: center;">
                    <?php echo $data['TANGGAL_01'] ?>
                </td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">ORDER</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['ORDER'] ?></td>
                <td data-no="10" colspan="6" rowspan="6" style="vertical-align: top;">
                    <?php echo $data['NOTE'] ?></textarea>
                </td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">JENIS KAIN</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['JENIS_KAIN'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">WARNA</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['WARNA'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">L X G PERMINTAAN</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['L_PERMINTAAN'] ?> X
                    <?php echo $data['G_PERMINTAAN'] ?>
                </td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">L X G AKTUAL</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['L_AKTUAL'] ?> X
                    <?php echo $data['G_AKTUAL'] ?>
                </td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">LOT</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['LOT'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">NO. HANGER</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['NO_HANGER'] ?></td>
                <td class="bg-warning" data-no="2" colspan="3" style="text-align:center;">
                    <?php echo $data['NAMA_TTD'] ?>
                </td>
            </tr>
            <tr class="baris">
                <td data-no="1" colspan="10" rowspan="2" style="text-align: center;font-size: 15px; font-weight: bold;">
                    QUALITY
                </td>
                <td colspan="1" style="text-align: center;" data-no="1">OK</td>
                <td colspan="1" style="text-align: center;" class="bg-danger" data-no="2" data-name="OK">
                    <?php echo $data['OK'] ?>
                </td>

            </tr>
            <tr class="baris">
                <td colspan="1" style="text-align:center" data-no="1">NOT OK</td>
                <td colspan="1" style="text-align:center" data-no="2" class="bg-danger" data-name="NOT_OK">
                    <?php echo $data['NOT_OK'] ?>
                </td>
            </tr>


        </tbody>
    </table>
</body>
<script src="../../bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
    window.print();

    window.onkeyup = function (event) {
        if (event.keyCode == 27) {
            window.close();
        }
    }
</script>