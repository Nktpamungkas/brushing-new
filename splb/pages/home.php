<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SETTING PERBEDAAN LOT BRUSHING</title>
</head>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">

<style>
    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .table-bordered>thead>tr>th,
    .table-bordered>tbody>tr>th,
    .table-bordered>tfoot>tr>th,
    .table-bordered>thead>tr>td,
    .table-bordered>tbody>tr>td,
    .table-bordered>tfoot>tr>td {
        border: 0.5px solid #000000;

        text-align: center;
        vertical-align: center;
    }

    table>tbody>tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table>tbody>tr:hover {
        background-color: #ddd;
    }

    table>thead>tr>th {
        padding-top: 12px;
        padding-bottom: 12px;
        font-size: 10pt;
        text-align: center;
        vertical-align: middle;
    }

    .dropbtn {
        background-color: #DC3545;
        color: white;
        padding: 5px;
        font-size: 10px;
        border: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* .dropdown-content a:hover {
        background-color: #ddd;
    } */

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }
</style>

<body>
    <div class="container-fluid">
        <div class=" col-md-12">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h4 class="text-center" style="font-weight: bold;">SETTING PERBEDAAN LOT BRUSHING</h4>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#exampleModal"><i class="glyphicon glyphicon-plus-sign"></i> BUAT SPLB </button>
            </div>
        </div>
        <hr class="devider" />
        <div class="row" style="background-color: white; padding: 20px 0 20px 0;">
            <div class="container-fluid">
                <div class="alert alert-success text-center">
                    <strong style="color: black;">PREVIEW DATA</strong>
                </div>
            </div>
            <div class="col-md-4">
                <form action="" method="post">
                    <!-- <div class="col-sm-12"> -->
                        <input type="text" name="no_kk" placeholder="NO KARTU KERJA" value="<?php if (isset($_POST['submit'])){ echo $_POST['no_kk']; } ?>">
                        <button type="submit" name="submit" >Cari data</button>
                    <!-- </div> -->
                </form>
                <table class="table table-bordered" style="width:100%" id="customers">
                    <thead>
                        <tr style="background-color: #ff5e5e;">
                            <th>#</th>
                            <th>NO. KK</th>
                            <th>LANGGANAN</th>
                            <th>ORDER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (isset($_POST['submit'])) {
                                $sql = mysqli_query($con, "SELECT `ID`,`NO_KARTU_KERJA`,`ORDER`, `LANGGANAN` FROM tbl_splb WHERE NO_KARTU_KERJA = '$_POST[no_kk]'");
                            }else{
                                $sql = mysqli_query($con, "SELECT `ID`,`NO_KARTU_KERJA`,`ORDER`, `LANGGANAN` FROM tbl_splb ORDER BY `ID` DESC LIMIT 250");
                            }
                            while ($li = mysqli_fetch_array($sql)) {
                        ?>
                            <tr>
                                <td>
                                    <div class="dropdown">
                                        <button class="dropbtn btn btn-xs btn-danger"><i class="glyphicon glyphicon-tags"></i></button>
                                        <div class="dropdown-content">
                                            <a href="javascript:void(0)" onClick="OpenInNewWindows('pages/print_splb.php?kk=<?php echo $li['NO_KARTU_KERJA'] ?>')" class="btn btn-xs btn-danger print">
                                                <i class="glyphicon glyphicon-print"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-xs btn-warning hapus" data-pk="<?php echo $li['ID']  ?>"><i class="glyphicon glyphicon-trash"></i></a>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo $li['NO_KARTU_KERJA'] ?></td>
                                <td><?php echo $li['LANGGANAN'] ?></td>
                                <td><?php echo $li['ORDER'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-8" id="location_table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="15" style="background-color: #4CAF50;">SETTING PERBEDAAN LOT BRUSHING</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">No. KK</td>
                            <td class="bg-warning" data-no="2" colspan="8"></td>
                            <td data-no="10" colspan="6" style="text-align: center;">SPV/ASST/LDR</td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">LANGGANAN</td>
                            <td class="bg-warning" data-no="2" colspan="8"></td>
                            <td data-no="10" colspan="6" class="bg-warning"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">ORDER</td>
                            <td class="bg-warning" data-no="2" colspan="8"></td>
                            <td data-no="10" colspan="6" rowspan="7"></textarea></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">JENIS KAIN</td>
                            <td class="bg-warning" data-no="2" colspan="8"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">WARNA</td>
                            <td class="bg-warning" data-no="2" colspan="8"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">L X G PERMINTAAN</td>
                            <td class="bg-warning" data-no="2" colspan="8"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">L X G AKTUAL</td>
                            <td class="bg-warning" data-no="2" colspan="8"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">LOT</td>
                            <td class="bg-warning" data-no="2" colspan="8"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">NO. HANGER</td>
                            <td class="bg-warning" data-no="2" colspan="8"></td>
                        </tr>
                        <tr class="baris">
                            <td data-no="1" colspan="9">RAISING</td>
                            <td data-no="10" colspan="6" class="bg-danger"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">NO. MESIN</td>
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
                            <td style="width: 180px;" data-no="1">BAG. KAIN</td>
                            <td class="bg-danger" data-no="2"> </td>
                            <td class="bg-danger" data-no="3"> </td>
                            <td class="bg-danger" data-no="4"> </td>
                            <td class="bg-danger" data-no="5"> </td>
                            <td class="bg-danger" data-no="6"> </td>
                            <td class="bg-danger" data-no="7"> </td>
                            <td class="bg-danger" data-no="8"> </td>
                            <td class="bg-danger" data-no="9"> </td>
                            <td class="bg-danger" data-no="10"></td>
                            <td class="bg-danger" data-no="11"></td>
                            <td class="bg-danger" data-no="12"></td>
                            <td class="bg-danger" data-no="13"></td>
                            <td class="bg-danger" data-no="14"></td>
                            <td class="bg-danger" data-no="15"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">JAR GARUK/S-D EFFECT</td>
                            <td class="bg-danger" data-no="2"> </td>
                            <td class="bg-danger" data-no="3"> </td>
                            <td class="bg-danger" data-no="4"> </td>
                            <td class="bg-danger" data-no="5"> </td>
                            <td class="bg-danger" data-no="6"> </td>
                            <td class="bg-danger" data-no="7"> </td>
                            <td class="bg-danger" data-no="8"> </td>
                            <td class="bg-danger" data-no="9"> </td>
                            <td class="bg-danger" data-no="10"> </td>
                            <td class="bg-danger" data-no="11"> </td>
                            <td class="bg-danger" data-no="12"> </td>
                            <td class="bg-danger" data-no="13"> </td>
                            <td class="bg-danger" data-no="14"> </td>
                            <td class="bg-danger" data-no="15"> </td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">DRUM</td>
                            <td class="bg-danger" data-no="2"></td>
                            <td class="bg-danger" data-no="3"></td>
                            <td class="bg-danger" data-no="4"></td>
                            <td class="bg-danger" data-no="5"></td>
                            <td class="bg-danger" data-no="6"></td>
                            <td class="bg-danger" data-no="7"></td>
                            <td class="bg-danger" data-no="8"></td>
                            <td class="bg-danger" data-no="9"></td>
                            <td class="bg-danger" data-no="10"></td>
                            <td class="bg-danger" data-no="11"></td>
                            <td class="bg-danger" data-no="12"></td>
                            <td class="bg-danger" data-no="13"></td>
                            <td class="bg-danger" data-no="14"></td>
                            <td class="bg-danger" data-no="15"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">JAR SISIR/I-D EFFECT</td>
                            <td class="bg-danger" data-no="2"> </td>
                            <td class="bg-danger" data-no="3"> </td>
                            <td class="bg-danger" data-no="4"> </td>
                            <td class="bg-danger" data-no="5"> </td>
                            <td class="bg-danger" data-no="6"> </td>
                            <td class="bg-danger" data-no="7"> </td>
                            <td class="bg-danger" data-no="8"> </td>
                            <td class="bg-danger" data-no="9"> </td>
                            <td class="bg-danger" data-no="10"> </td>
                            <td class="bg-danger" data-no="13"> </td>
                            <td class="bg-danger" data-no="11"> </td>
                            <td class="bg-danger" data-no="12"> </td>
                            <td class="bg-danger" data-no="14"> </td>
                            <td class="bg-danger" data-no="15"> </td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">SPEED M/MNT</td>
                            <td class="bg-danger" data-no="2"></td>
                            <td class="bg-danger" data-no="3"></td>
                            <td class="bg-danger" data-no="4"></td>
                            <td class="bg-danger" data-no="5"></td>
                            <td class="bg-danger" data-no="6"></td>
                            <td class="bg-danger" data-no="7"></td>
                            <td class="bg-danger" data-no="8"></td>
                            <td class="bg-danger" data-no="9"></td>
                            <td class="bg-danger" data-no="10"></td>
                            <td class="bg-danger" data-no="11"></td>
                            <td class="bg-danger" data-no="12"></td>
                            <td class="bg-danger" data-no="13"></td>
                            <td class="bg-danger" data-no="14"></td>
                            <td class="bg-danger" data-no="15"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">TENSION 1</td>
                            <td class="bg-danger" data-no="2"></td>
                            <td class="bg-danger" data-no="3"></td>
                            <td class="bg-danger" data-no="4"></td>
                            <td class="bg-danger" data-no="5"></td>
                            <td class="bg-danger" data-no="6"></td>
                            <td class="bg-danger" data-no="7"></td>
                            <td class="bg-danger" data-no="8"></td>
                            <td class="bg-danger" data-no="9"></td>
                            <td class="bg-danger" data-no="10"></td>
                            <td class="bg-danger" data-no="11"></td>
                            <td class="bg-danger" data-no="12"></td>
                            <td class="bg-danger" data-no="13"></td>
                            <td class="bg-danger" data-no="14"></td>
                            <td class="bg-danger" data-no="15"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">TENSION 2</td>
                            <td class="bg-danger" data-no="2"></td>
                            <td class="bg-danger" data-no="3"></td>
                            <td class="bg-danger" data-no="4"></td>
                            <td class="bg-danger" data-no="5"></td>
                            <td class="bg-danger" data-no="6"></td>
                            <td class="bg-danger" data-no="7"></td>
                            <td class="bg-danger" data-no="8"></td>
                            <td class="bg-danger" data-no="9"></td>
                            <td class="bg-danger" data-no="10"></td>
                            <td class="bg-danger" data-no="11"></td>
                            <td class="bg-danger" data-no="12"></td>
                            <td class="bg-danger" data-no="13"></td>
                            <td class="bg-danger" data-no="14"></td>
                            <td class="bg-danger" data-no="15"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">TENSION 3</td>
                            <td class="bg-danger" data-no="2"></td>
                            <td class="bg-danger" data-no="3"></td>
                            <td class="bg-danger" data-no="4"></td>
                            <td class="bg-danger" data-no="5"></td>
                            <td class="bg-danger" data-no="6"></td>
                            <td class="bg-danger" data-no="7"></td>
                            <td class="bg-danger" data-no="8"></td>
                            <td class="bg-danger" data-no="9"></td>
                            <td class="bg-danger" data-no="10"></td>
                            <td class="bg-danger" data-no="11"></td>
                            <td class="bg-danger" data-no="12"></td>
                            <td class="bg-danger" data-no="13"></td>
                            <td class="bg-danger" data-no="14"></td>
                            <td class="bg-danger" data-no="15"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">SHEARING</td>
                            <td style="text-align: center;" data-no="2" colspan="2" class="bg-danger"></td>
                            <td style="text-align: center;" data-no="4" colspan="2" class="bg-danger"></td>
                            <td style="text-align: center;" data-no="6" colspan="3">TUMBLE DRY</td>
                            <td style="text-align: center;" data-no="9" colspan="3">COMBING 01</td>
                            <td style="text-align: center;" data-no="12" colspan="2">B</td>
                            <td style="text-align: center;" data-no="14" colspan="2">F</td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">BAGIAN</td>
                            <td style="text-align: center;" data-no="2" colspan="2">B</td>
                            <td style="text-align: center;" data-no="4" colspan="2">F</td>
                            <td class="bg-danger" style="text-align: center;" data-no="6" colspan="3"></td>
                            <td style="text-align: center;" data-no="9" colspan="3">SPEED KAIN M/MNT</td>
                            <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"></td>
                            <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">SPEED M/MNT</td>
                            <td class="bg-danger" style="text-align: center;" data-no="2" colspan="2"></td>
                            <td class="bg-danger" style="text-align: center;" data-no="4" colspan="2"></td>
                            <td style="text-align: center;" data-no="6" colspan="3">AIRO</td>
                            <td style="text-align: center;" data-no="9" colspan="3">SPEED JARUM</td>
                            <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"></td>
                            <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">JARAK PISAU</td>
                            <td class="bg-danger" style="text-align: center;" data-no="2" colspan="2"></td>
                            <td class="bg-danger" style="text-align: center;" data-no="4" colspan="2"></td>
                            <td class="bg-danger" style="text-align: center;" data-no="6" colspan="3"></td>
                            <td style="text-align: center;" data-no="9" colspan="3">SPEED DRUM</td>
                            <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"></td>
                            <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"></td>
                        </tr>
                        <tr class="baris">
                            <td data-no="1" colspan="2">SUEDING 01/02</td>
                            <td data-no="3" colspan="5">BACK DRAG ROLL</td>
                            <td class="bg-danger" data-no="4"></td>
                            <td style="text-align: center;" data-no="9" colspan="3">SPEED TARIKAN KAIN</td>
                            <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"></td>
                            <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">% PILE BRUSH</td>
                            <td class="bg-danger" style="text-align: center;" data-no="2"></td>
                            <td data-no="3" colspan="5">PLAITER TENSION</td>
                            <td class="bg-danger" data-no="4"></td>
                            <td style="text-align: center; font-weight: bold;" data-no="9" colspan="3">COMBING 02</td>
                            <td style="text-align: center;" data-no="12" colspan="2">B</td>
                            <td style="text-align: center;" data-no="14" colspan="2">F</td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">% COUNTERPILE BRUSH</td>
                            <td class="bg-danger" style="text-align: center;" data-no="2"></td>
                            <td data-no="3" colspan="5">% REDUCED SUEDING</td>
                            <td class="bg-danger" data-no="4"></td>
                            <td style="text-align: center;" data-no="9" colspan="3">JAR GARUK</td>
                            <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"></td>
                            <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">% DELIVERY BRUSH</td>
                            <td class="bg-danger" style="text-align: center;" data-no="2"></td>
                            <td data-no="3" colspan="5">SPEED KAIN</td>
                            <td class="bg-danger" data-no="4"></td>
                            <td style="text-align: center;" data-no="9" colspan="3">DRUM</td>
                            <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"></td>
                            <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">TAKER IN TENSION</td>
                            <td class="bg-danger" style="text-align: center;" data-no="2"></td>
                            <td data-no="3" colspan="5">SPEED DRUM</td>
                            <td class="bg-danger" data-no="4"></td>
                            <td style="text-align: center;" data-no="9" colspan="3">JAR SISIR</td>
                            <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"></td>
                            <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">FRONT DRUM TENSION</td>
                            <td class="bg-danger" style="text-align: center;" data-no="2"></td>
                            <td data-no="3" colspan="5">SPEED TOTATION</td>
                            <td class="bg-danger" data-no="4"></td>
                            <td style="text-align: center;" data-no="9" colspan="3">SPEED M/MNT</td>
                            <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"></td>
                            <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">REAR DRUM TENSION</td>
                            <td class="bg-danger" style="text-align: center;" data-no="2"></td>
                            <td data-no="3" colspan="5">LOAD CELLS CONTROL</td>
                            <td class="bg-danger" data-no="4"></td>
                            <td style="text-align: center;" data-no="9" colspan="3">TENSION</td>
                            <td class="bg-danger" style="text-align: center;" data-no="12" colspan="2"></td>
                            <td class="bg-danger" style="text-align: center;" data-no="14" colspan="2"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">POLISHING</td>
                            <td data-no="2" colspan="6"></td>
                            <td style="text-align: center;" data-no="9" colspan="2">SPEED M/MNT</td>
                            <td class="bg-danger" data-no="11"></td>
                            <td data-no="12" colspan="5"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">SUHU ROLLER °C</td>
                            <td data-no="2">F</td>
                            <td class="bg-danger" data-no="3" colspan="2"></td>
                            <td data-no="5">B</td>
                            <td class="bg-danger" data-no="6" colspan="2"></td>
                            <td data-no="8" colspan="2">GAP</td>
                            <td data-no="10">1</td>
                            <td class="bg-danger" data-no="11" colspan="2"></td>
                            <td data-no="13">2</td>
                            <td class="bg-danger" data-no="14" colspan="2"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">SPEED ROLLER</td>
                            <td data-no="2">F</td>
                            <td class="bg-danger" data-no="3" colspan="2"></td>
                            <td data-no="5">B</td>
                            <td class="bg-danger" data-no="6" colspan="2"></td>
                            <td data-no="8" colspan="2">TENSION</td>
                            <td data-no="10">1</td>
                            <td class="bg-danger" data-no="11" colspan="2"></td>
                            <td data-no="13">2</td>
                            <td class="bg-danger" data-no="14" colspan="2"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">SUEDING 03</td>
                            <td data-no="2" colspan="3">SPEED KAIN M/MNT</td>
                            <td class="bg-danger" data-no="5" colspan="2"></td>
                            <td data-no="7" colspan="3" style="text-align: center;">TEK REGULATOR</td>
                            <td class="bg-danger" data-no="8" colspan="2"></td>
                            <td data-no="10" colspan="2"></td>
                            <td data-no="12" colspan="2" rowspan="2" style="text-align: center; vertical-align: middle;">QUALITY</td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">TEKANAN KAIN</td>
                            <td data-no="2">1</td>
                            <td class="bg-danger" data-no="3"></td>
                            <td data-no="4">2</td>
                            <td class="bg-danger" data-no="5"></td>
                            <td data-no="6">3</td>
                            <td class="bg-danger" data-no="7"></td>
                            <td data-no="8">4</td>
                            <td class="bg-danger" data-no="9"></td>
                            <td data-no="10">5</td>
                            <td class="bg-danger" data-no="11"></td>
                            <td data-no="12">6</td>
                            <td class="bg-danger" data-no="13"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">SPEED SIKAT</td>
                            <td data-no="2">1</td>
                            <td class="bg-danger" data-no="3"></td>
                            <td data-no="4">2</td>
                            <td class="bg-danger" data-no="5"></td>
                            <td data-no="6">3</td>
                            <td class="bg-danger" data-no="7"></td>
                            <td data-no="8">4</td>
                            <td class="bg-danger" data-no="9"></td>
                            <td data-no="10">5</td>
                            <td class="bg-danger" data-no="11"></td>
                            <td data-no="12">6</td>
                            <td class="bg-danger" data-no="13"></td>
                            <td class="bg-danger" data-no="14" colspan="2" rowspan="4" style="text-align: center; vertical-align: middle;"></td>
                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">SUEDING 04</td>
                            <td data-no="2" colspan="3">SPEED KAIN M/MNT</td>
                            <td data-no="5" colspan="2"></td>
                            <td data-no="7" colspan="3">TEK REAGULATOR</td>
                            <td data-no="9" colspan="2"></td>
                            <td data-no="12" colspan="2"></td>

                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">TEKANAN KAIN</td>
                            <td data-no="2">1</td>
                            <td class="bg-danger" data-no="3"></td>
                            <td data-no="4">2</td>
                            <td class="bg-danger" data-no="5"></td>
                            <td data-no="6">3</td>
                            <td class="bg-danger" data-no="7"></td>
                            <td data-no="8">4</td>
                            <td class="bg-danger" data-no="9"></td>
                            <td data-no="10">5</td>
                            <td class="bg-danger" data-no="11"></td>
                            <td data-no="12">6</td>
                            <td class="bg-danger" data-no="13"></td>

                        </tr>
                        <tr class="baris">
                            <td style="width: 180px;" data-no="1">SPEED SIKAT</td>
                            <td data-no="2">1</td>
                            <td class="bg-danger" data-no="3"></td>
                            <td data-no="4">2</td>
                            <td class="bg-danger" data-no="5"></td>
                            <td data-no="6">3</td>
                            <td class="bg-danger" data-no="7"></td>
                            <td data-no="8">4</td>
                            <td class="bg-danger" data-no="9"></td>
                            <td data-no="10">5</td>
                            <td class="bg-danger" data-no="11"></td>
                            <td data-no="12">6</td>
                            <td class="bg-danger" data-no="13"></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">NEW SPLB</h4>
            </div>
            <form method="post" action="?p=splb_form">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">No. Kartu Kerja :</label>
                        <input type="number" required class="form-control" name="kk" id="kk" style="width: 100%;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">CREATE NEW</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../js/jquery.dataTables.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
<script>
    function OpenInNewWindows(url_print) {
        window.open(url_print, '', 'width=800, height=600');
    }

    $(document).ready(function() {
        $('#customers').dataTable({
            "pageLength": 40,
            "lengthChange": false
        });

        $(document).on('click', '#customers tbody tr', function() {
            let kk = $(this).find('td:eq(1)').text();

            $.ajax({
                url: "pages/append_detail_table.php",
                type: "GET",
                data: {
                    kk: kk
                },
                success: function(ajaxData) {
                    $('#location_table').empty();
                    $('#location_table').html(ajaxData);
                }
            });
        });

        $(document).on('click', '.hapus', function() {
            let id = $(this).attr('data-pk');

            if (confirm("Apakah anda yakin ingin menghapus Data ini ?") == true) {
                $.ajax({
                    dataType: "json",
                    url: "hapus.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.kode == 200) {
                            location.reload();
                        } else {
                            alert('Error hubungi DIT team !')
                        }
                    }
                });
            } else {
                console.log('cancel!');
            }


        })
    })
</script>

</html>