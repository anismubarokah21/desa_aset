<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir registrasi
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Query untuk memeriksa apakah username sudah ada
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error = "Username sudah digunakan.";
    } else {
        // Query untuk memasukkan data pengguna baru
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            echo "Registrasi berhasil. <a href='login.php'>Login</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Registrasi</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Daftar</button>
        </form>
        <?php
        if (isset($error)) {
            echo "<p>$error</p>";
        }
        ?>
    </div>
    <script src="../js/scripts.js"></script>
</body>
</html>