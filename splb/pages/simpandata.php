<?php
// Pastikan koneksi ke database sudah diatur
include ("../koneksi.php");

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpen'])) {
	// Inisialisasi variabel untuk menampung kolom dan nilai
	$columns = [];
	$values = [];

	// Loop untuk mengumpulkan setiap field dan nilainya dari $_POST
	foreach ($_POST as $key => $value) {
		// Escape nilai untuk mencegah SQL Injection
		$escaped_value = mysqli_real_escape_string($con, $value);
		// Hindari field 'simpen' karena ini adalah tombol submit
		if ($key != 'simpen') {
			// Tambahkan kolom dan nilai ke dalam array
			$columns[] = "`$key`";
			$values[] = "'$escaped_value'";
		}
	}

	// Buat string untuk kolom dan nilai
	$columnsString = implode(", ", $columns);
	$valuesString = implode(", ", $values);

	// Lakukan query INSERT
	$sql = "INSERT INTO tbl_splb ($columnsString) VALUES ($valuesString)";

	if (mysqli_query($con, $sql)) {
		echo "Data berhasil disimpan";
	} else {
		echo "Error: " . mysqli_error($con);
	}
} else {
	echo "Form submission tidak valid";
}
?>