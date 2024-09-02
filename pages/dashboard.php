<?php include '../db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Aset Desa</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="usage.php">Pengadaan Aset</a></li>
            <li><a href="employees.php">Karyawan</a></li>
            <li><a href="logout.php">logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Dashboard Aset Desa Sukamukti</h1>

        <div class="cards">
            <div class="card">
                <h2>Total Aset</h2>
                <?php
                // Menghitung total aset dari tabel asset_usage
                $sql = "SELECT COUNT(*) as total FROM asset_usage";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo $row['total'];
                ?>
            </div>
            <div class="card">
                <h2>Total Karyawan</h2>
                <?php
                // Menghitung total karyawan dari tabel employees
                $sql = "SELECT COUNT(*) as total FROM employees";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                echo $row['total'];
                ?>
            </div>
        </div>
    </div>
    <script src="../js/scripts.js"></script>
</body>
</html>