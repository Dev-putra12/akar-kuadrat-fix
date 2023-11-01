<?php
include 'koneksi.php';
session_start();
// Cek apakah pengguna sudah login dengan sesi nim
if (isset($_SESSION['nim'])) {
    // Pengguna telah login, tampilkan halaman index
} else {
    // Pengguna belum login, mungkin perlu dialihkan ke halaman login
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Akar Kuadrat</title>
    <link href="tailwind.css" rel="stylesheet">
    <script src="function.js"></script>
</head>

<body>
    <!-- header -->
    <?php include('header.php') ?>
    <!-- batas header -->
    <!-- tailwind -->
    <section class="dark:bg-gray-900 h-screen">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                Kalkulator Akar Kuadrat </h1>
            <!-- form -->
            <form method="post">
                <div class="mb-6">
                    <label for="nilai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukan Nilai:</label>
                    <input id="nilai" name="nilai" onkeypress="return hanyaAngka(event)" min="0.1" step="0.1" placeholder="Hanya Masukan Angka" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                </div>
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="hitungAkar()">Hitung Akar Kuadrat</button>
                <button type="button" class="mb-10 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="hitungSql()">Hitung PL/SQL</button>
            </form>
            <!-- end form -->

            <!-- hasil -->
            <label for="hasil" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hasil</label>
            <label for="hasil" class="block mb-10 p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">Tampilkan
                nilai hasil</label>
            <!-- end hasil -->
            <!-- tables -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-50">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Input Number
                            </th>
                            <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                Result
                                <!-- ini gatau apa -->
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Input Date
                            </th>
                        </tr>
                    </thead>
                    <?php
                    // ambil data berdasarkan session yang login
                    $nim = $_SESSION['nim'];
                    $result = mysqli_query($connect, "SELECT * FROM squareroot WHERE nim='$nim'");
                    $query = "SELECT id,input_number,result,created_at FROM squareroot WHERE nim ='$nim'";
                    $user = mysqli_query($connect, $query);
                    $row = mysqli_fetch_array($user);
                    ?>
                    <tbody>

                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                <?= $row['id'] ?>
                            </th>
                            <td class="px-6 py-4">
                                <?= $row['input_number'] ?>
                            </td>
                            <td id="hasil-akar-kuadrat" class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                <?= $row['result'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $row['created_at'] ?>
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
            <!-- end tables -->
        </div>
    </section>
</body>

</html>