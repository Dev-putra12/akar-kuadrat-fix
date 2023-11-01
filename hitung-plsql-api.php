<?php
session_start();
// Simpan data nilai dan session nim ke dalam database
$nim = $_SESSION['nim'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));
    $nilai = $data->nilai;

    // Lakukan penyimpanan ke database sesuai dengan kebutuhan Anda
    // Misalnya, menggunakan PDO untuk mengakses database MySQL
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=hiko3370_akar_kuadrat", "hiko3370_root", "Blackcnz1@");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Panggil stored procedure untuk menghitung akar kuadrat
        $stmt = $pdo->prepare("CALL calculateSquareRoot(:nim, :input_number, @result)");
        $stmt->bindParam(':nim', $nim, PDO::PARAM_STR);
        $stmt->bindParam(':input_number', $nilai, PDO::PARAM_STR);
        $stmt->execute();

        // Ambil hasil perhitungan dari variabel @result
        $stmt = $pdo->query("SELECT @result AS result");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $akar_kuadrat = $row['result'];

        // Kembalikan hasil perhitungan ke client
        $response = [
            'status' => 'success',
            'result' => $akar_kuadrat
        ];
        echo json_encode($response);
    } catch (PDOException $e) {
        $response = ['status' => 'error', 'message' => $e->getMessage()];
        echo json_encode($response);
    }
}
