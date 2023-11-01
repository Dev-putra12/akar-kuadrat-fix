<?php
session_start();
// Simpan data nilai dan session nim ke dalam database
$nim = $_SESSION['nim'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"));
    $nilai = $data->nilai;
    // Hitung akar kuadrat
    $akar_kuadrat = sqrt($nilai);
    // Lakukan penyimpanan ke database sesuai dengan kebutuhan Anda
    // Misalnya, menggunakan PDO untuk mengakses database MySQL
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=hiko3370_akar_kuadrat", "hiko3370_root", "Blackcnz1@");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO squareroot (nim, input_number, result) VALUES (:nim, :input_number, :result)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(':nim' => $nim, ':input_number' => $nilai, ':result' => $akar_kuadrat));

        // Kembalikan hasil perhitungan ke client
        $response = [
            'status' => 'success',
            'result' => $akar_kuadrat
        ];
        echo json_encode($response);
    } catch (PDOException $e) {
        $response = array("success" => false, "error" => $e->getMessage());
        echo json_encode($response);
    }
}
