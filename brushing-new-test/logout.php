<?php
session_start();
include "koneksi.php";
session_destroy();
ob_end_clean();
echo "<script> window.location='index.php'; </script>";
