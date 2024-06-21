<?php
ini_set("error_reporting", 1);
session_start();
include("../koneksi.php");
if ($_POST['pk']) {
    $name = $_POST['name'];
    $value = $_POST['value'];
    $sql = mysqli_query($con,"UPDATE tbl_splb SET `$name` = '$value' WHERE `ID` = '$_POST[pk]'");
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
