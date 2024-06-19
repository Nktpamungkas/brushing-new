<?php
// Langkah 1: Pastikan koneksi ke database sudah diatur
include ("koneksi.php");

// Langkah 2: Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Langkah 3: Siapkan array untuk menampung kolom dan nilainya
	$columns = [];
	$values = [];

	// Langkah 4: Iterasi melalui setiap item POST
	foreach ($_POST as $key => $value) {
		// Cek apakah ini bukan tombol submit
		if ($key != 'simpen') {
			// Escape value to prevent SQL injection
			$escaped_value = mysqli_real_escape_string($con, $value);

			// Menambahkan nama kolom ke array tanpa escape
			$columns[] = "`$key`";  // Nama kolom tidak perlu di-escape

			// Menambahkan nilai ke array dengan escape
			$values[] = "'$escaped_value'";
		}
	}

	// Langkah 5: Susun query INSERT jika ada kolom dan nilai yang valid
	if (count($columns) > 0 && count($values) > 0) {
		$columns_list = implode(", ", $columns);
		$values_list = implode(", ", $values);
		$sql = "INSERT INTO tbl_splb ($columns_list) VALUES ($values_list)";

		// Langkah 6: Eksekusi query
		if (mysqli_query($con, $sql)) {
			echo "Data berhasil disimpan";
		} else {
			// Menangani dan menampilkan error lebih detail
			echo "Error: " . mysqli_error($con);
		}
	} else {
		echo "Tidak ada data valid yang dimasukkan.";
	}
}
?>