<?php
require $_SERVER['DOCUMENT_ROOT'] . '/laundry/db_connection.php';
$pelangganResult = $conn->query("SELECT id, nama FROM tbl_pelanggan");
$mesinCuciResult = $conn->query("SELECT id, nama, harga_per_15_menit FROM tbl_mesincuci");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggalTransaksi'];
    $waktuMulai = $_POST['waktuMulai'];
    $waktuSelesai = $_POST['waktuSelesai'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $id_mesinCuci = $_POST['id_mesinCuci'];

    if (!empty($tanggal) && !empty($waktuMulai) && !empty($waktuSelesai) && !empty($id_pelanggan) && !empty($id_mesinCuci)) {


        $query = "SELECT harga_per_15_menit FROM tbl_mesincuci WHERE id = '$id_mesinCuci'";
        $result = $conn->query($query);

        if ($result && $row = $result->fetch_assoc()) {
            $hargaPer15Menit = $row['harga_per_15_menit'];

            $start = strtotime($waktuMulai);
            $end = strtotime($waktuSelesai);

            if ($end > $start) {
                $durasiMenit = ($end - $start) / 60; 
                $interval15Menit = ceil($durasiMenit / 15); 
                $total = $interval15Menit * $hargaPer15Menit;
                
                $sql = "INSERT INTO tbl_transaksi (tanggalTransaksi, waktuMulai, waktuSelesai, id_pelanggan, id_mesinCuci, total)
                        VALUES ('$tanggal', '$waktuMulai', '$waktuSelesai', '$id_pelanggan', '$id_mesinCuci', '$total')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location.href='transaksi.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<script>alert('Waktu selesai harus lebih besar dari waktu mulai');</script>";
            }
        } else {
            echo "<script>alert('Harga mesin cuci tidak ditemukan');</script>";
        }
    } else {
        echo "<script>alert('Semua field harus diisi!');</script>";
    }
}

$conn->close();
?>
    

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        form {
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            /* Beri jarak ke atas jika diperlukan */
        }

        .button-laporan {
            background-color: #0000FF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .button-laporan:hover {
            background-color: #6495ED;
        }
    </style>
</head>

<body>
    <h1>Pencatatan Transaksi</h1>
    <form method="POST" action="transaksi.php">
        <label for="transactionDate">Tanggal Transaksi:</label>
        <input type="date" name="tanggalTransaksi" id="transactionDate" required>

        <label for="startTime">Waktu Mulai:</label>
        <input type="time" name="waktuMulai" id="startTime" required>

        <label for="endTime">Waktu Selesai:</label>
        <input type="time" name="waktuSelesai" id="endTime" required>

        <label for="customerName">Nama Pelanggan:</label>
        <select name="id_pelanggan" id="customerName" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php while ($row = $pelangganResult->fetch_assoc()) { ?>
                <option value="<?= $row['id'] ?>">
                    <?= $row['nama'] ?>
                </option>
            <?php } ?>
        </select>

        <label for="machine">Mesin Cuci:</label>
        <select name="id_mesinCuci" id="machine" required>
            <option value="">-- Pilih Mesin Cuci --</option>
            <?php while ($row = $mesinCuciResult->fetch_assoc()) { ?>
                <option value="<?= $row['id'] ?>">
                    <?= $row['nama'] ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit">Tambah Transaksi</button>
    </form>

    <div class="button-container">
        <a href="/laundry/LaporanTransaksi/laporanTransaksi.php" class="button-laporan">Lihat Laporan</a>
    </div>

</body>

</html>