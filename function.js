function hanyaAngka(event) {
    var angka = event.which || event.keyCode;
    if ((angka < 48 || angka > 57) && angka !== 46) {
        return false;
    }
    return true;
}

function hitungAkar() {
    // Mengambil nilai dari elemen input dengan id "nilai"
    var nilai = document.getElementById("nilai").value;

    // Mendapatkan session nim (gantilah "sesi_nim" dengan nama session yang sesuai)
    var nim = "<?php echo isset($_SESSION['nim']) ? $_SESSION['nim'] : ''; ?>";

    // Membuat objek permintaan
    var request = new XMLHttpRequest();

    // Mengatur tipe permintaan dan URL endpoint API
    request.open("POST", "/hitung-akar-api.php", true);
    request.setRequestHeader("Content-type", "application/json");

    // Mengirimkan data nilai dan nim ke API
    var data = JSON.stringify({
        "nilai": nilai,
        "nim": nim
    });
    request.send(data);

    // Menggunakan event listener untuk menangkap respons dari API
    request.onreadystatechange = function() {
        if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
            var response = JSON.parse(request.responseText);
            var hasilAkarKuadrat = response.result;
            // Tampilkan hasil akar kuadrat di elemen HTML yang sesuai
            document.getElementById("hasil-akar-kuadrat").innerText = hasilAkarKuadrat;
        }
    };
}

function hitungSql() {
    // Mengambil nilai dari elemen input dengan id "nilai"
    var nilai = document.getElementById("nilai").value;

    // Mendapatkan session nim (gantilah "sesi_nim" dengan nama session yang sesuai)
    var nim = "<?php echo isset($_SESSION['nim']) ? $_SESSION['nim'] : ''; ?>";

    // Membuat objek permintaan
    var request = new XMLHttpRequest();

    // Mengatur tipe permintaan dan URL endpoint API
    request.open("POST", "/hitung-plsql-api.php", true);
    request.setRequestHeader("Content-type", "application/json");

    // Mengirimkan data nilai dan nim ke API
    var data = JSON.stringify({
        "nilai": nilai,
        "nim": nim
    });
    request.send(data);

    // Menggunakan event listener untuk menangkap respons dari API
    request.onreadystatechange = function() {
        if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
            var response = JSON.parse(request.responseText);
            var hasilSql = response.result;
            // Tampilkan hasil penghitungan SQL di elemen HTML yang sesuai
            document.getElementById("hasil-plsql").innerText = hasilSql;
        }
    };
}