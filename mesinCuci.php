<?php
require $_SERVER['DOCUMENT_ROOT'] . '/laundry/db_connection.php';

if (isset($_POST['tambah'])) {
    $nama = trim($_POST['nama']);
    $kapasitas = trim($_POST['kapasitas']);
    $status = trim($_POST['status']);
    $merek = trim($_POST['merek']);
    $harga = trim($_POST['harga']);

    // Validasi input tidak boleh kosong
    if (!empty($nama) && !empty($kapasitas) && !empty($status) && !empty($merek) && !empty($harga)) {
        $sql = "INSERT INTO tbl_mesincuci (nama, kapasitas, status, merek, harga_per_15_menit)
                VALUES ('$nama', '$kapasitas', '$status', '$merek', '$harga')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Data berhasil ditambahkan'); window.location.href='mesinCuci.php';</script>";
        }
    } else {
        echo "<script>alert('Semua field harus diisi untuk menambahkan data!');</script>";
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM tbl_mesincuci WHERE id = $delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='mesinCuci.php';</script>";
    }
}

if (isset($_POST['update'])) {
    $id = trim($_POST['edit_id']);
    $nama = trim($_POST['edit_nama']);
    $kapasitas = trim($_POST['edit_kapasitas']);
    $status = trim($_POST['edit_status']);
    $merek = trim($_POST['edit_merek']);
    $harga = trim($_POST['edit_harga']);

    if (!empty($id) && !empty($nama) && !empty($kapasitas) && !empty($status) && !empty($merek) && !empty($harga)) {
        $sql = "UPDATE tbl_mesincuci 
                SET nama='$nama', kapasitas='$kapasitas', status='$status', merek='$merek', harga_per_15_menit='$harga' 
                WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Data berhasil diperbarui'); window.location.href='mesinCuci.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('Semua field harus diisi untuk mengedit data!');</script>";
    }
}

$search = "";
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
    $sql = "SELECT * FROM tbl_mesincuci 
            WHERE nama LIKE '%$search%' 
            OR kapasitas LIKE '%$search%'
            OR status LIKE '%$search%'
            OR merek LIKE '%$search%'
            OR harga_per_15_menit LIKE '%$search%'";
} else {
    // Default Query
    $sql = "SELECT * FROM tbl_mesincuci";
}
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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .add-button, .edit-button, .delete-button {
            padding: 8px 12px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 2px;
        }

        .add-button { background-color: #28a745; }
        .edit-button { background-color: #ffc107; }
        .delete-button { background-color: #dc3545; }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            cursor: pointer;
        }
</style>

</head>
<body>
    <h1>Daftar Mesin Cuci</h1>
    <button class="add-button" onclick="openModal()">Tambah Mesin Cuci</button>
    <form method="GET" action="mesinCuci.php">
        <input type="text" name="search" placeholder="Cari mesin cuci..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Cari</button>
    </form>

    <!-- Tabel Data Mesin Cuci -->
    <table>
        <thead>
            <tr>
                <th>Nama Mesin Cuci</th>
                <th>Kapasitas</th>
                <th>Status</th>
                <th>Merek</th>
                <th>Harga (per 15 menit)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['kapasitas']) . " Kg</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['merek']) . "</td>";
                    echo "<td>Rp." . htmlspecialchars($row['harga_per_15_menit']) . "</td>";
                    echo "<td>
                        <button class='edit-button' onclick=\"openEditModal('".$row['id']."', '".$row['nama']."', '".$row['kapasitas']."', '".$row['status']."', '".$row['merek']."', '".$row['harga_per_15_menit']."')\">Edit</button>
                        <button class='delete-button' onclick=\"confirmDelete('".$row['id']."')\">Hapus</button>
                    </td>";
                    echo "</tr>";
                }
            }              
            ?> 
        </tbody>
    </table>

    

    <!-- Modal Form Tambah Mesin Cuci -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Tambah Mesin Cuci</h2>
            <form method="POST" action="mesinCuci.php">
                <label for="nama">Nama:</label><br>
                <input type="text" id="nama" name="nama" required><br><br>

                <label for="kapasitas">Kapasitas (Kg):</label><br>
                <input type="number" id="kapasitas" name="kapasitas" required><br><br>

                <label for="status">Status:</label><br>
                <input type="text" id="status" name="status" required><br><br>

                <label for="merek">Merek:</label><br>
                <input type="text" id="merek" name="merek" required><br><br>

                <label for="harga">Harga:</label><br>
                <input type="number" id="harga" name="harga" required><br><br>

                <button type="submit" name="tambah">Simpan</button>
            </form>
        </div>
    </div>


    <!-- Modal Form Edit Mesin Cuci -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Edit Mesin Cuci</h2>
        <form method="POST" action="mesinCuci.php">
            <input type="hidden" id="editId" name="edit_id">

            <label for="editNama">Nama:</label><br>
            <input type="text" id="editNama" name="edit_nama" required><br><br>

            <label for="editKapasitas">Kapasitas (Kg):</label><br>
            <input type="number" id="editKapasitas" name="edit_kapasitas" required><br><br>

            <label for="editStatus">Status:</label><br>
            <input type="text" id="editStatus" name="edit_status" required><br><br>

            <label for="editMerek">Merek:</label><br>
            <input type="text" id="editMerek" name="edit_merek" required><br><br>

            <label for="editHarga">Harga:</label><br>
            <input type="number" id="editHarga" name="edit_harga" required><br><br>

            <button type="submit" name="update">Update</button>
        </form>
    </div>
</div>


    <!-- JavaScript untuk Modal -->
    <script>
    function openEditModal(id, nama, kapasitas, status, merek, harga) {
        document.getElementById('editModal').style.display = 'flex';
        document.getElementById('editId').value = id;
        document.getElementById('editNama').value = nama;
        document.getElementById('editKapasitas').value = kapasitas;
        document.getElementById('editStatus').value = status;
        document.getElementById('editMerek').value = merek;
        document.getElementById('editHarga').value = harga;
    }

    function confirmDelete(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            window.location.href = 'mesinCuci.php?delete_id=' + id;
        }
    }

    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
        document.getElementById('addModal').style.display = 'none';
    }

    function openModal() {
            document.getElementById('addModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('addModal').style.display = 'none';
        }
</script>


<?php
// Tutup koneksi
$conn->close();
?>