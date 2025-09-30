<?php
require_once("dosen.php");
if (isset($_POST['submit'])) {
    $npk = $_POST["npk"];
    $nama = $_POST["nama"];
    $foto = $_FILES["foto"];
    $npk1 = $_POST["npk1"];
    $ext = pathinfo($foto["name"], PATHINFO_EXTENSION);
    $dosen = new dosen();
    $stmt = $dosen->updateDosen($npk, $nama, $ext, $npk1);
    if ($stmt) {
        $dst = "uploads/$npk.$ext";
        move_uploaded_file($foto["tmp_name"], $dst);
    } else {
        echo "Edit Gagal. <br>";
    }
    header("Location: index.php?pilihan=dosen");
}