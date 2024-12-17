<?php
require $_SERVER['DOCUMENT_ROOT'] . '/laundry/db_connection.php';

$username = $_POST["nama"];
$password = $_POST["password"];

$sql = "SELECT * FROM tbl_staff WHERE nama = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($password === $row["password"]) {
        header("Location: /laundry/homeStaff/homeStaff.html");
        exit;
    } 
} else {
    echo "
    <div style='
        display: flex; 
        justify-content: center; 
        align-items: center; 
        height: 100vh; 
        background-color: #e3f2fd;
        color: #2c3e50; 
        font-family: Arial, sans-serif; 
        text-align: center;
        margin: 0; 
        padding: 0;'> 
    <div style='
            border: 1px solid #2c3e50;
            padding: 20px 40px; 
            border-radius: 10px; 
            background-color: #fff;'>
        <h1 style='font-size: 2rem; margin-bottom: 10px;'>Username Tidak Ditemukan atau Password Salah</h1>
        <p style='font-size: 1rem;'>Silakan periksa kembali username dan password Anda .</p>
        <a href='/laundry/staff/staff.html' style='
                display: inline-block; 
                margin-top: 20px; 
                padding: 10px 20px; 
                background-color: #2c3e50;
                color: #fff; 
                text-decoration: none; 
                border-radius: 5px; 
                font-size: 1rem;'>Kembali ke Login</a>
    </div>
</div>

";
}

$conn->close();
?>
