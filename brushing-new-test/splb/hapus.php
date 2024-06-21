<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");

if ($_POST['id']) {
    $sql = mysqli_query($con,"DELETE FROM tbl_splb WHERE `ID` = '$_POST[id]'");
    if ($sql) {
        $data = array(
            'kode' => 200
        );
    } else {
        $data = array(
            'kode' => 404
        );
    }
}

echo json_encode($data);
