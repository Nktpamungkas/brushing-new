<?php
ini_set("error_reporting", 1);
session_start();
include("../../koneksi.php");
$sql = mysqli_query($con,"SELECT * FROM tbl_splb where NO_KARTU_KERJA = '$_GET[kk]'");
$data = mysqli_fetch_array($sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                <th colspan="15" style="background-color: #4CAF50; text-align: center;">SETTING PERBEDAAN LOT BRUSHING</th>
            </tr>
        </thead>
        <tbody>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">No. KK</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $_GET['kk'] ?></td>
                <td data-no="10" colspan="6" style="text-align: center;">SPV/ASST/LDR</td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">LANGGANAN</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['LANGGANAN'] ?></td>
                <td data-no="10" colspan="6" class="bg-warning" style="text-align: center;"><?php echo $data['TANGGAL_01'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">ORDER</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['ORDER'] ?></td>
                <td data-no="10" colspan="6" rowspan="7" style="vertical-align: top;"><?php echo $data['NOTE'] ?></textarea></td>
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
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['L_PERMINTAAN'] ?> X <?php echo $data['G_PERMINTAAN'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">L X G AKTUAL</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['L_AKTUAL'] ?> X <?php echo $data['G_AKTUAL'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">LOT</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['LOT'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">NO. HANGER</td>
                <td class="bg-warning" data-no="2" colspan="8"><?php echo $data['NO_HANGER'] ?></td>
            </tr>
            <tr class="baris">
                <td data-no="1" colspan="9">RAISING</td>
                <td data-no="10" colspan="6" class="bg-danger" style="text-align: center;"><?php echo $data['NAMA_TTD'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">NO. MESIN</td>
                <td style="text-align: center;" data-no="2">1</td>
                <td style="text-align: center;" data-no="3">2</td>
                <td style="text-align: center;" data-no="4">3</td>
                <td style="text-align: center;" data-no="5">4</td>
                <td style="text-align: center;" data-no="6">5</td>
                <td style="text-align: center;" data-no="7">6</td>
                <td style="text-align: center;" data-no="8">7</td>
                <td style="text-align: center;" data-no="9">8</td>
                <td style="text-align: center;" data-no="10">9</td>
                <td style="text-align: center;" data-no="11">10</td>
                <td style="text-align: center;" data-no="12">11</td>
                <td style="text-align: center;" data-no="13">12</td>
                <td style="text-align: center;" data-no="14">13</td>
                <td style="text-align: center;" data-no="15">14</td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">BAG. KAIN</td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="2"><?php echo $data['BAG_KAIN_01'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="3"><?php echo $data['BAG_KAIN_02'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="4"><?php echo $data['BAG_KAIN_03'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="5"><?php echo $data['BAG_KAIN_04'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="6"><?php echo $data['BAG_KAIN_05'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="7"><?php echo $data['BAG_KAIN_06'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="8"><?php echo $data['BAG_KAIN_07'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="9"><?php echo $data['BAG_KAIN_08'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="10"><?php echo $data['BAG_KAIN_09'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="11"><?php echo $data['BAG_KAIN_10'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="12"><?php echo $data['BAG_KAIN_11'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="13"><?php echo $data['BAG_KAIN_12'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="14"><?php echo $data['BAG_KAIN_13'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="15"><?php echo $data['BAG_KAIN_14'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1"><small>JAR GARUK/S-D EFFECT</small></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="2"><?php echo $data['JAR_GARUK_01'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="3"><?php echo $data['JAR_GARUK_02'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="4"><?php echo $data['JAR_GARUK_03'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="5"><?php echo $data['JAR_GARUK_04'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="6"><?php echo $data['JAR_GARUK_05'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="7"><?php echo $data['JAR_GARUK_06'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="8"><?php echo $data['JAR_GARUK_07'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="9"><?php echo $data['JAR_GARUK_08'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="10"><?php echo $data['JAR_GARUK_09'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="11"><?php echo $data['JAR_GARUK_10'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="12"><?php echo $data['JAR_GARUK_11'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="13"><?php echo $data['JAR_GARUK_12'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="14"><?php echo $data['JAR_GARUK_13'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="15"><?php echo $data['JAR_GARUK_14'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">DRUM</td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="2"><?php echo $data['DRUM_01'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="3"><?php echo $data['DRUM_02'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="4"><?php echo $data['DRUM_03'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="5"><?php echo $data['DRUM_04'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="6"><?php echo $data['DRUM_05'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="7"><?php echo $data['DRUM_06'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="8"><?php echo $data['DRUM_07'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="9"><?php echo $data['DRUM_08'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="10"><?php echo $data['DRUM_09'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="11"><?php echo $data['DRUM_10'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="12"><?php echo $data['DRUM_11'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="13"><?php echo $data['DRUM_12'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="14"><?php echo $data['DRUM_13'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="15"><?php echo $data['DRUM_14'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">JAR SISIR/I-D EFFECT</td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="2"><?php echo $data['JAR_SISIR_01'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="3"><?php echo $data['JAR_SISIR_02'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="4"><?php echo $data['JAR_SISIR_03'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="5"><?php echo $data['JAR_SISIR_04'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="6"><?php echo $data['JAR_SISIR_05'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="7"><?php echo $data['JAR_SISIR_06'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="8"><?php echo $data['JAR_SISIR_07'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="9"><?php echo $data['JAR_SISIR_08'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="10"><?php echo $data['JAR_SISIR_09'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="13"><?php echo $data['JAR_SISIR_10'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="11"><?php echo $data['JAR_SISIR_11'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="12"><?php echo $data['JAR_SISIR_12'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="14"><?php echo $data['JAR_SISIR_13'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="15"><?php echo $data['JAR_SISIR_14'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">SPEED M/MNT</td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="2"><?php echo $data['SPEED01'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="3"><?php echo $data['SPEED02'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="4"><?php echo $data['SPEED03'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="5"><?php echo $data['SPEED04'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="6"><?php echo $data['SPEED05'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="7"><?php echo $data['SPEED06'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="8"><?php echo $data['SPEED07'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="9"><?php echo $data['SPEED08'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="10"><?php echo $data['SPEED09'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="11"><?php echo $data['SPEED10'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="12"><?php echo $data['SPEED11'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="13"><?php echo $data['SPEED12'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="14"><?php echo $data['SPEED13'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="15"><?php echo $data['SPEED14'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">TENSION 1</td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="2"><?php echo $data['TENSION1_01'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="3"><?php echo $data['TENSION1_02'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="4"><?php echo $data['TENSION1_03'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="5"><?php echo $data['TENSION1_04'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="6"><?php echo $data['TENSION1_05'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="7"><?php echo $data['TENSION1_06'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="8"><?php echo $data['TENSION1_07'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="9"><?php echo $data['TENSION1_08'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="10"><?php echo $data['TENSION1_09'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="11"><?php echo $data['TENSION1_10'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="12"><?php echo $data['TENSION1_11'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="13"><?php echo $data['TENSION1_12'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="14"><?php echo $data['TENSION1_13'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="15"><?php echo $data['TENSION1_14'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">TENSION 2</td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="2"><?php echo $data['TENSION2_01'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="3"><?php echo $data['TENSION2_02'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="4"><?php echo $data['TENSION2_03'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="5"><?php echo $data['TENSION2_04'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="6"><?php echo $data['TENSION2_05'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="7"><?php echo $data['TENSION2_06'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="8"><?php echo $data['TENSION2_07'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="9"><?php echo $data['TENSION2_08'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="10"><?php echo $data['TENSION2_09'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="11"><?php echo $data['TENSION2_10'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="12"><?php echo $data['TENSION2_11'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="13"><?php echo $data['TENSION2_12'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="14"><?php echo $data['TENSION2_13'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="15"><?php echo $data['TENSION2_14'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">TENSION 3</td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="2"><?php echo $data['TENSION3_01'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="3"><?php echo $data['TENSION3_02'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="4"><?php echo $data['TENSION3_03'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="5"><?php echo $data['TENSION3_04'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="6"><?php echo $data['TENSION3_05'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="7"><?php echo $data['TENSION3_06'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="8"><?php echo $data['TENSION3_07'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="9"><?php echo $data['TENSION3_08'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="10"><?php echo $data['TENSION3_09'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="11"><?php echo $data['TENSION3_10'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="12"><?php echo $data['TENSION3_11'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="13"><?php echo $data['TENSION3_12'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="14"><?php echo $data['TENSION3_13'] ?></td>
                <td class="bg-danger" style="text-align:center; width: 5.2mm;" data-no="15"><?php echo $data['TENSION3_14'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">SHEARING</td>
                <td style="text-align: center;" data-no="2" colspan="2" class="bg-danger"><?php echo $data['SHEARING_1'] ?></td>
                <td style="text-align: center;" data-no="4" colspan="2" class="bg-danger"><?php echo $data['SHEARING_2'] ?></td>
                <td style="text-align: center;" data-no="6" colspan="3">TUMBLE DRY</td>
                <td style="text-align: center;" data-no="9" colspan="3">COMBING 01</td>
                <td style="text-align: center;" data-no="12" colspan="2">B</td>
                <td style="text-align: center;" data-no="14" colspan="2">F</td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">BAGIAN</td>
                <td style="text-align: center;" data-no="2" colspan="2">B</td>
                <td style="text-align: center;" data-no="4" colspan="2">F</td>
                <td class="bg-danger" style="text-align: center;" data-no="6" colspan="3"><?php echo $data['TUMBLEDRY'] ?></td>
                <td style="text-align: center;" data-no="9" colspan="3">SPEED KAIN M/MNT</td>
                <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><?php echo $data['SPEED_KAIN_B'] ?></td>
                <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><?php echo $data['SPEED_KAIN_F'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">SPEED M/MNT</td>
                <td class="bg-danger" style="text-align: center;" data-no="2" colspan="2"><?php echo $data['SPEED_M_MNT_B'] ?></td>
                <td class="bg-danger" style="text-align: center;" data-no="4" colspan="2"><?php echo $data['SPEED_M_MNT_F'] ?></td>
                <td style="text-align: center;" data-no="6" colspan="3">AIRO</td>
                <td style="text-align: center;" data-no="9" colspan="3">SPEED JARUM</td>
                <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><?php echo $data['SPEED_JARUM_B'] ?></td>
                <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><?php echo $data['SPEED_JARUM_B'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">JARAK PISAU</td>
                <td class="bg-danger" style="text-align: center;" data-no="2" colspan="2"><?php echo $data['JARAK_PISAU_B'] ?></td>
                <td class="bg-danger" style="text-align: center;" data-no="4" colspan="2"><?php echo $data['JARAK_PISAU_F'] ?></td>
                <td class="bg-danger" style="text-align: center;" data-no="6" colspan="3"><?php echo $data['AIRO'] ?></td>
                <td style="text-align: center;" data-no="9" colspan="3">SPEED DRUM</td>
                <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><?php echo $data['SPEED_DRM_B'] ?></td>
                <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><?php echo $data['SPEED_DRM_F'] ?></td>
            </tr>
            <tr class="baris">
                <td data-no="1" colspan="2">SUEDING 01/02</td>
                <td data-no="3" colspan="5">BACK DRAG ROLL</td>
                <td class="bg-danger" style="text-align: center;" data-no="4"><?php echo $data['BLACK_DRAGROLL'] ?></td>
                <td style="text-align: center;" data-no="9" colspan="3"><small style="font-weight: bold;">SPEED TRKN KAIN</small></td>
                <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><?php echo $data['SPEED_TARIKAN_KAIN_B'] ?></td>
                <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><?php echo $data['SPEED_TARIKAN_KAIN_F'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">% PILE BRUSH</td>
                <td class="bg-danger" style="text-align: center;" data-no="2"><?php echo $data['PILE_BRUSH'] ?></td>
                <td data-no="3" colspan="5">PLAITER TENSION</td>
                <td class="bg-danger" style="text-align: center;" data-no="4"><?php echo $data['PLAITER_TENSION'] ?></td>
                <td style="text-align: center; font-weight: bold;" data-no="9" colspan="3">COMBING 02</td>
                <td style="text-align: center;" data-no="12" colspan="2">B</td>
                <td style="text-align: center;" data-no="14" colspan="2">F</td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">% COUNTERPILE BRUSH</td>
                <td class="bg-danger" style="text-align: center;" data-no="2"><?php echo $data['COUNTERPILE_BRUSH'] ?></td>
                <td data-no="3" colspan="5">% REDUCED SUEDING</td>
                <td class="bg-danger" style="text-align: center;" data-no="4"><?php echo $data['REDUCED_SUEDING'] ?></td>
                <td style="text-align: center;" data-no="9" colspan="3">JAR GARUK</td>
                <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><?php echo $data['JAR_GARUK_B'] ?></td>
                <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><?php echo $data['JAR_GARUK_F'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">% DELIVERY BRUSH</td>
                <td class="bg-danger" style="text-align: center;" data-no="2"><?php echo $data['DELIVERY_BRUSH'] ?></td>
                <td data-no="3" colspan="5">SPEED KAIN</td>
                <td class="bg-danger" style="text-align: center;" data-no="4"><?php echo $data['SPEED_KAIN'] ?></td>
                <td style="text-align: center;" data-no="9" colspan="3">DRUM</td>
                <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><?php echo $data['DRUM_B'] ?></td>
                <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><?php echo $data['DRUM_F'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">TAKER IN TENSION</td>
                <td class="bg-danger" style="text-align: center;" data-no="2"><?php echo $data['TAKER_IN_TENSION'] ?></td>
                <td data-no="3" colspan="5">SPEED DRUM</td>
                <td class="bg-danger" style="text-align: center;" data-no="4"><?php echo $data['SPEED_DRUM'] ?></td>
                <td style="text-align: center;" data-no="9" colspan="3">JAR SISIR</td>
                <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><?php echo $data['JAR_SISIR_B'] ?></td>
                <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><?php echo $data['JAR_SISIR_F'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">FRONT DRUM TENSION</td>
                <td class="bg-danger" style="text-align: center;" data-no="2"><?php echo $data['FRONT_DRUM_TENSION'] ?></td>
                <td data-no="3" colspan="5">SPEED TOTATION</td>
                <td class="bg-danger" style="text-align: center;" data-no="4"><?php echo $data['SPEED_TOTATION'] ?></td>
                <td style="text-align: center;" data-no="9" colspan="3">SPEED M/MNT</td>
                <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><?php echo $data['SPEED_B'] ?></td>
                <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><?php echo $data['SPEED_F'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">REAR DRUM TENSION</td>
                <td class="bg-danger" style="text-align: center;" data-no="2"><?php echo $data['REAR_DRUM_TENSION'] ?></td>
                <td data-no="3" colspan="5">LOAD CELLS CONTROL</td>
                <td class="bg-danger" style="text-align: center;" data-no="4"><?php echo $data['LOAD_CELLS_CTRL'] ?></td>
                <td style="text-align: center;" data-no="9" colspan="3">TENSION</td>
                <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"><?php echo $data['TENSION_B'] ?></td>
                <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><?php echo $data['TENSION_F'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">POLISHING</td>
                <td data-no="2" colspan="6"></td>
                <td style="text-align: center;" data-no="9" colspan="3">SPEED M/MNT</td>
                <td class="bg-danger" style="text-align: center;" data-no="11"><?php echo $data['SPEED_POLISHING'] ?></td>
                <td data-no="12" colspan="4"></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">SUHU ROLLER °C</td>
                <td data-no="2">F</td>
                <td class="bg-danger" style="text-align: center;" data-no="3" colspan="2"><?php echo $data['SUHU_ROLLER_F'] ?></td>
                <td data-no="5">B</td>
                <td class="bg-danger" style="text-align: center;" data-no="6" colspan="2"><?php echo $data['SUHU_ROLLER_B'] ?></td>
                <td data-no="8" colspan="2">GAP</td>
                <td data-no="10">1</td>
                <td class="bg-danger" style="text-align: center;" data-no="11" colspan="2"><?php echo $data['GAP_01'] ?></td>
                <td data-no="13">2</td>
                <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><?php echo $data['GAP_02'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">SPEED ROLLER</td>
                <td data-no="2">F</td>
                <td class="bg-danger" style="text-align: center;" data-no="3" colspan="2"><?php echo $data['SPEED_RLR_F'] ?></td>
                <td data-no="5">B</td>
                <td class="bg-danger" style="text-align: center;" data-no="6" colspan="2"><?php echo $data['SPEED_RLR_B'] ?></td>
                <td data-no="8" colspan="2">TENSION</td>
                <td data-no="10">1</td>
                <td class="bg-danger" style="text-align: center;" data-no="11" colspan="2" <?php echo $data['TENSION_01'] ?>></td>
                <td data-no="13">2</td>
                <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"><?php echo $data['TENSION_02'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">SUEDING 03</td>
                <td data-no="2" colspan="3">SPEED KAIN M/MNT</td>
                <td class="bg-danger" style="text-align: center;" data-no="5" colspan="2"><?php echo $data['SUEDING_03_SPEED'] ?></td>
                <td data-no="7" colspan="3" style="text-align: center;">TEK REGULATOR</td>
                <td class="bg-danger" style="text-align: center;" data-no="8" colspan="2"><?php echo $data['TEK_REGULATOR'] ?></td>
                <td data-no="10" colspan="2">&nbsp;</td>
                <td data-no="12" colspan="2" rowspan="2" style="text-align: center; vertical-align: middle;">QUALITY</td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">TEKANAN KAIN</td>
                <td data-no="2">1</td>
                <td class="bg-danger" style="text-align: center;" data-no="3"><?php echo $data['TEKANAN_KAIN_01'] ?></td>
                <td data-no="4">2</td>
                <td class="bg-danger" style="text-align: center;" data-no="5"><?php echo $data['TEKANAN_KAIN_02'] ?></td>
                <td data-no="6">3</td>
                <td class="bg-danger" style="text-align: center;" data-no="7"><?php echo $data['TEKANAN_KAIN_03'] ?></td>
                <td data-no="8">4</td>
                <td class="bg-danger" style="text-align: center;" data-no="9"><?php echo $data['TEKANAN_KAIN_04'] ?></td>
                <td data-no="10">5</td>
                <td class="bg-danger" style="text-align: center;" data-no="11"><?php echo $data['TEKANAN_KAIN_05'] ?></td>
                <td data-no="12">6</td>
                <td class="bg-danger" style="text-align: center;" data-no="13"><?php echo $data['TEKANAN_KAIN_06'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">SPEED SIKAT</td>
                <td data-no="2">1</td>
                <td class="bg-danger" style="text-align: center;" data-no="3"><?php echo $data['SPEED_SIKAT_01'] ?></td>
                <td data-no="4">2</td>
                <td class="bg-danger" style="text-align: center;" data-no="5"><?php echo $data['SPEED_SIKAT_02'] ?></td>
                <td data-no="6">3</td>
                <td class="bg-danger" style="text-align: center;" data-no="7"><?php echo $data['SPEED_SIKAT_03'] ?></td>
                <td data-no="8">4</td>
                <td class="bg-danger" style="text-align: center;" data-no="9"><?php echo $data['SPEED_SIKAT_04'] ?></td>
                <td data-no="10">5</td>
                <td class="bg-danger" style="text-align: center;" data-no="11"><?php echo $data['SPEED_SIKAT_05'] ?></td>
                <td data-no="12">6</td>
                <td class="bg-danger" style="text-align: center;" data-no="13"><?php echo $data['SPEED_SIKAT_06'] ?></td>
                <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2" rowspan="4" style="text-align: center; vertical-align: middle;"><?php echo $data['QUALITY'] ?></td>
            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">SUEDING 04</td>
                <td data-no="2" colspan="3">SPEED KAIN M/MNT</td>
                <td data-no="5" colspan="2"><?php echo $data['SUEDING_04_SPEED'] ?></td>
                <td data-no="7" colspan="3">TEK REAGULATOR</td>
                <td data-no="9" colspan="2" style="text-align:center"><?php echo $data['TANGGAL_02'] ?></td>
                <td data-no="12" colspan="2">&nbsp;</td>

            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">TEKANAN KAIN</td>
                <td data-no="2">1</td>
                <td class="bg-danger" style="text-align: center;" data-no="3"><?php echo $data['TEKANAN04_01'] ?></td>
                <td data-no="4">2</td>
                <td class="bg-danger" style="text-align: center;" data-no="5"><?php echo $data['TEKANAN04_02'] ?></td>
                <td data-no="6">3</td>
                <td class="bg-danger" style="text-align: center;" data-no="7"><?php echo $data['TEKANAN04_03'] ?></td>
                <td data-no="8">4</td>
                <td class="bg-danger" style="text-align: center;" data-no="9"><?php echo $data['TEKANAN04_04'] ?></td>
                <td data-no="10">5</td>
                <td class="bg-danger" style="text-align: center;" data-no="11"><?php echo $data['TEKANAN04_05'] ?></td>
                <td data-no="12">6</td>
                <td class="bg-danger" style="text-align: center;" data-no="13"><?php echo $data['TEKANAN04_06'] ?></td>

            </tr>
            <tr class="baris">
                <td style="width: 22mm" data-no="1">SPEED SIKAT</td>
                <td data-no="2">1</td>
                <td class="bg-danger" style="text-align: center;" data-no="3"><?php echo $data['SIKAT04_01'] ?></td>
                <td data-no="4">2</td>
                <td class="bg-danger" style="text-align: center;" data-no="5"><?php echo $data['SIKAT04_02'] ?></td>
                <td data-no="6">3</td>
                <td class="bg-danger" style="text-align: center;" data-no="7"><?php echo $data['SIKAT04_03'] ?></td>
                <td data-no="8">4</td>
                <td class="bg-danger" style="text-align: center;" data-no="9"><?php echo $data['SIKAT04_04'] ?></td>
                <td data-no="10">5</td>
                <td class="bg-danger" style="text-align: center;" data-no="11"><?php echo $data['SIKAT04_05'] ?></td>
                <td data-no="12">6</td>
                <td class="bg-danger" style="text-align: center;" data-no="13"><?php echo $data['SIKAT04_06'] ?></td>
            </tr>
        </tbody>
    </table>
</body>
<script src="../../bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
    window.print();

    window.onkeyup = function(event) {
        if (event.keyCode == 27) {
            window.close();
        }
    }
</script>