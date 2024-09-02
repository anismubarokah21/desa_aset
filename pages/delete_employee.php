<?php
include('../db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM employees WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Karyawan berhasil dihapus.";
        header('Location: employees.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>