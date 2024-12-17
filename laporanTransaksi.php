<?php
require $_SERVER['DOCUMENT_ROOT'] . '/laundry/db_connection.php';


$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

$sql = "SELECT t.tanggalTransaksi, t.waktuMulai, t.waktuSelesai, p.nama AS pelanggan, m.nama AS mesinCuci, t.total
        FROM tbl_transaksi t
        JOIN tbl_pelanggan p ON t.id_pelanggan = p.id
        JOIN tbl_mesincuci m ON t.id_mesinCuci = m.id
        WHERE 1=1";

if (!empty($startDate) && !empty($endDate)) {
    $sql .= " AND t.tanggalTransaksi BETWEEN ? AND ?";
} else {
    $sql .= " AND t.tanggalTransaksi IS NOT NULL";
}

$stmt = $conn->prepare($sql);

if (!empty($startDate) && !empty($endDate)) {
    $stmt->bind_param("ss", $startDate, $endDate);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 400px;
            margin: 0 auto;
        }

        form label {
            font-weight: bold;
        }

        form input,
        form button {
            padding: 8px;
            font-size: 16px;
        }

        form button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <h1>Laporan Transaksi</h1>

    <!-- Form Pencarian Tanggal -->
    <form method="GET" action="laporanTransaksi.php">
        <label for="startDate">Dari Tanggal:</label>
        <input type="date" name="startDate" id="startDate" value="<?php echo htmlspecialchars($startDate); ?>">

        <label for="endDate">Sampai Tanggal:</label>
        <input type="date" name="endDate" id="endDate" value="<?php echo htmlspecialchars($endDate); ?>">

        <button type="submit">Cari</button>
    </form>

    <!-- Tabel Transaksi -->
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Nama Pelanggan</th>
                <th>Nama Mesin Cuci</th>
                <th>Total Biaya (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['tanggalTransaksi']); ?></td>
                        <td><?php echo htmlspecialchars($row['waktuMulai']); ?></td>
                        <td><?php echo htmlspecialchars($row['waktuSelesai']); ?></td>
                        <td><?php echo htmlspecialchars($row['pelanggan']); ?></td>
                        <td><?php echo htmlspecialchars($row['mesinCuci']); ?></td>
                        <td><?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Data tidak ditemukan untuk kriteria ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>

<?php $conn->close(); ?>
