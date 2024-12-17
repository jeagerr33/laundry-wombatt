<?php
require $_SERVER['DOCUMENT_ROOT'] . '/laundry/db_connection.php';

// Query untuk mengambil nama kelurahan sebagai dropdown
$kelurahanResult = $conn->query("SELECT id, nama_kelurahan FROM tbl_kelurahan");

// Proses Tambah Data Pelanggan
if (isset($_POST['tambah'])) {
    $nama = trim($_POST['nama']);
    $hp = trim($_POST['hp']);
    $email = trim($_POST['email']);
    $id_kelurahan = trim($_POST['id_kelurahan']);

    if (!empty($nama) && !empty($hp) && !empty($email) && !empty($id_kelurahan)) {
        $sql = "INSERT INTO tbl_pelanggan (nama, hp, email, id_kelurahan) 
                VALUES ('$nama', '$hp', '$email', '$id_kelurahan')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Data berhasil ditambahkan'); window.location.href='pelangganView.php';</script>";
        }
    } else {
        echo "<script>alert('Semua field harus diisi!');</script>";
    }
}

// Proses Update Data Pelanggan
if (isset($_POST['update'])) {
    $id = trim($_POST['edit_id']);
    $nama = trim($_POST['edit_nama']);
    $hp = trim($_POST['edit_hp']);
    $email = trim($_POST['edit_email']);
    $id_kelurahan = trim($_POST['edit_id_kelurahan']);

    if (!empty($id) && !empty($nama) && !empty($hp) && !empty($email) && !empty($id_kelurahan)) {
        $sql = "UPDATE tbl_pelanggan
                SET nama='$nama', hp='$hp', email='$email', id_kelurahan='$id_kelurahan' 
                WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Data berhasil diperbarui'); window.location.href='pelangganView.php';</script>";
        }
    } else {
        echo "<script>alert('Semua field harus diisi!');</script>";
    }
}

// Proses Pencarian Data
$search = "";
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
    $sql = "SELECT tbl_pelanggan.id, tbl_pelanggan.nama, tbl_pelanggan.hp, tbl_pelanggan.email, tbl_kelurahan.nama_kelurahan 
            FROM tbl_pelanggan
            JOIN tbl_kelurahan ON tbl_pelanggan.id_kelurahan = tbl_kelurahan.id
            WHERE tbl_pelanggan.nama LIKE '%$search%' 
            OR tbl_pelanggan.hp LIKE '%$search%'
            OR tbl_pelanggan.email LIKE '%$search%'
            OR tbl_kelurahan.nama_kelurahan LIKE '%$search%'";
} else {
    $sql = "SELECT tbl_pelanggan.id, tbl_pelanggan.nama, tbl_pelanggan.hp, tbl_pelanggan.email, tbl_kelurahan.nama_kelurahan 
            FROM tbl_pelanggan
            JOIN tbl_kelurahan ON tbl_pelanggan.id_kelurahan = tbl_kelurahan.id";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan</title>
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

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .add-button,
        .edit-button {
            padding: 10px 15px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 2px;
        }

        .add-button {
            background-color: #28a745;
        }

        .edit-button {
            background-color: #ffc107;
        }

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
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 30%;
            height: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-content h2 {
            margin-bottom: 15px;
            font-size: 1.5em;
        }

        .modal-content form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .modal-content div {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-content label {
            width: 20%;
            font-weight: bold;
            text-align: left;
        }

        .modal-content input,
        .modal-content select {
            width: 70%;
            height: 35px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box;
        }

        .modal-content button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        .modal-content button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <h1>Daftar Pelanggan</h1>

    <!-- Form Pencarian -->
    <form method="GET" action="pelangganView.php">
        <input type="text" name="search" placeholder="Cari pelanggan..."
            value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Cari</button>
    </form>

    <button class="add-button" onclick="openModal()">Tambah Pelanggan</button>

    <!-- Tabel Data Pelanggan -->
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>HP</th>
                <th>Email</th>
                <th>Kelurahan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php echo htmlspecialchars($row['nama']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($row['hp']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($row['email']); ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($row['nama_kelurahan']); ?>
                    </td>
                    <td>
                        <div id="edit">
                            <button class="edit-button" onclick="openEditModal(
                        '<?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?>', 
                        '<?php echo htmlspecialchars($row['nama'], ENT_QUOTES); ?>', 
                        '<?php echo htmlspecialchars($row['hp'], ENT_QUOTES); ?>', 
                        '<?php echo htmlspecialchars($row['email'], ENT_QUOTES); ?>', 
                        '<?php echo isset($row['id_kelurahan']) ? htmlspecialchars($row['id_kelurahan'], ENT_QUOTES) : ''; ?>'
                        )">Edit</button>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Modal Tambah Pelanggan -->
    <div id="addModal" class="modal">
    <div class="modal-content">
        <h2>Tambah Pelanggan</h2>
        <form method="POST" action="pelangganView.php">
            <div>
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div>
                <label for="hp">HP:</label>
                <input type="text" id="hp" name="hp" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="id_kelurahan">Kelurahan:</label>
                <select id="id_kelurahan" name="id_kelurahan" required>
                    <option value="">-- Pilih Kelurahan --</option>
                    <?php while ($row = $kelurahanResult->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($row['id']); ?>">
                            <?php echo htmlspecialchars($row['nama_kelurahan']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" name="tambah">Simpan</button>
        </form>
    </div>
</div>


    <div id="editModal" class="modal">
        <div class="modal-content">
            <h2>Edit Pelanggan</h2>
            <form method="POST" action="pelangganView.php">
                <input type="hidden" id="editId" name="edit_id">
                <div>
                    <label for="editNama">Nama:</label>
                    <input type="text" id="editNama" name="edit_nama" required>
                </div>
                <div>
                    <label for="editHp">HP:</label>
                    <input type="text" id="editHp" name="edit_hp" required>
                </div>
                <div>
                    <label for="editEmail">Email:</label>
                    <input type="email" id="editEmail" name="edit_email" required>
                </div>
                <div>
                    <label for="editKelurahan">Kelurahan:</label>
                    <select id="editKelurahan" name="edit_id_kelurahan" required>
                        <option value="">-- Pilih Kelurahan --</option>
                        <?php
                        $kelurahanResult = $conn->query("SELECT id, nama_kelurahan FROM tbl_kelurahan");
                        while ($kelurahanRow = $kelurahanResult->fetch_assoc()) {
                            echo "<option value='{$kelurahanRow['id']}'>{$kelurahanRow['nama_kelurahan']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="update">Update</button>
            </form>
        </div>
    </div>
 


    <script>
        function openModal() {
            document.getElementById('addModal').style.display = 'flex';
        }

        function openEditModal(id, nama, hp, email, id_kelurahan) {
            document.getElementById('editModal').style.display = 'flex';
            document.getElementById('editId').value = id;
            document.getElementById('editNama').value = nama;
            document.getElementById('editHp').value = hp;
            document.getElementById('editEmail').value = email;

            const dropdown = document.getElementById('editKelurahan');
            for (let i = 0; i < dropdown.options.length; i++) {
                if (dropdown.options[i].value == id_kelurahan) {
                    dropdown.options[i].selected = true;
                    break;
                }
            }
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
            document.getElementById('addModal').style.display = 'none';
        }

    </script>
</body>

</html>

<?php $conn->close(); ?>