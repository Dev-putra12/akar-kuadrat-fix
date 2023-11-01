<?php
// koneksi
include "koneksi.php";
// menambah data
$Nama = $_POST['nama'];
$Nim = $_POST['nim'];

// mengeksekusi perintah SQL untuk memasukkan data ke dalam tabel 'user'
$query = "INSERT INTO user (nama, nim) VALUES ('$Nama', '$Nim')";
$data = mysqli_query($connect, $query);

// Periksa apakah data telah berhasil dimasukkan
if ($data) {
    // Redirect ke halaman login.php jika registrasi berhasil
    header('Location: login.php');
} else {
    // Tampilkan pesan kesalahan jika registrasi gagal
    echo "Registrasi gagal. Silakan coba lagi.";
}

echo $data;
