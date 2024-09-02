<?php
include('../db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informasi Karyawan</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="usage.php">Pengadaan Aset</a></li>
            <li><a href="employees.php">Karyawan</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Informasi Karyawan</h1>
        <form action="employees.php" method="POST">
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" required>

            <label for="position">Jabatan:</label>
            <input type="text" id="position" name="position" required>
            
            <label for="address">Alamat:</label>
            <input type="text" id="address" name="address" required>
            
            <label for="birth_details">Tempat, Tanggal Lahir:</label>
            <input type="text" id="birth_details" name="birth_details" placeholder="Contoh: Jakarta, 1990-01-01" required>
            
            <label for="contact">Kontak:</label>
            <input type="text" id="contact" name="contact" required>
            
            <label for="sk_number">Nomor SK:</label>
            <input type="text" id="sk_number" name="sk_number" required>
            
            <label for="tmt">TMT:</label>
            <input type="text" id="tmt" name="tmt" placeholder="YYYY-MM-DD" required>
            
            <button type="submit" name="submit">Tambah Karyawan</button>
        </form>

        <!-- Tombol untuk mengunduh PDF -->
        <form action="../pages/generate_employee_pdf.php" method="POST">
            <input type="submit" value="Unduh PDF Karyawan">
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $position = $_POST['position'];
            $address = $_POST['address'];
            $birth_details = $_POST['birth_details'];
            $contact = $_POST['contact'];
            $sk_number = $_POST['sk_number'];
            $tmt = $_POST['tmt'];

            $sql = "INSERT INTO employees (name, position, address, birth_details, contact, sk_number, tmt) VALUES ('$name', '$position', '$address', '$birth_details', '$contact', '$sk_number', '$tmt')";
            if ($conn->query($sql) === TRUE) {
                echo "Karyawan baru berhasil ditambahkan.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $result = $conn->query("SELECT * FROM employees");
        if ($result->num_rows > 0) {
            echo "<h2>Data Karyawan:</h2>";
            echo "<table>";
            echo "<tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>Tempat, Tanggal Lahir</th>
                    <th>Kontak</th>
                    <th>Nomor SK</th>
                    <th>TMT</th>
                    <th>Aksi</th>
                  </tr>";
            
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['position']) . "</td>";
                echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                echo "<td>" . htmlspecialchars($row['birth_details']) . "</td>";
                echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
                echo "<td>" . htmlspecialchars($row['sk_number']) . "</td>";
                echo "<td>" . htmlspecialchars($row['tmt']) . "</td>";
                echo "<td>
                        <a href='edit_employee.php?id=" . htmlspecialchars($row['id']) . "'>Edit</a> |
                        <a href='delete_employee.php?id=" . htmlspecialchars($row['id']) . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                    </td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Tidak ada data karyawan.";
        }
        ?>
    </div>
    <script src="../js/scripts.js"></script>
</body>
</html>