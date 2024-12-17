<?php
require $_SERVER['DOCUMENT_ROOT'] . '/laundry/db_connection.php';

// Query untuk mengambil daftar mesin cuci
$sql = "SELECT nama, kapasitas, status, merek, harga_per_15_menit FROM tbl_mesincuci";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mesin Cuci</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e3f2fd;
            margin: 0;
            padding: 20px;
            color: black;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid rgb(0, 0, 0);
        }

        th, td {
            padding: 10px;
            text-align: center;
            background-color: #ffffff;
        }

        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Daftar Mesin Cuci</h1>

    <!-- Tabel Daftar Mesin Cuci -->
    <table>
        <thead>
            <tr>
                <th>Nama Mesin Cuci</th>
                <th>Kapasitas</th>
                <th>Status</th>
                <th>Merek</th>
                <th>Harga (per 15 menit)</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['kapasitas']); ?> Kg</td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                        <td><?php echo htmlspecialchars($row['merek']); ?></td>
                        <td>Rp.<?php echo htmlspecialchars($row['harga_per_15_menit']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Tidak ada data mesin cuci.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
