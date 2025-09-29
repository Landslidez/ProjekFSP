<?php
require_once("mahasiswa.php");
if (isset($_POST['submit'])) {
    $nrp1 = $_POST["nrp1"];
    $nrp = $_POST["nrp"]; //nrp yang diganti
    $nama = $_POST["nama"];
    $gender = $_POST["gender"];
    $tanggalLahir = $_POST["tanggalLahir"];
    $angkatan = $_POST["angkatan"];
    $foto = $_FILES["foto"];
    $ext = pathinfo($foto["name"], PATHINFO_EXTENSION);
    $mahasiswa = new mahasiswa();
    $stmt = $mahasiswa->updateMahasiswa($nrp1, $nrp, $nama, $gender, $tanggalLahir, $angkatan, $ext);
    if ($stmt) {
        $dst = "uploads/$nrp.$ext";
        move_uploaded_file($foto["tmp_name"], $dst);
    } else {
        echo "Edit Gagal. <br>";
    }
    header("Location: index.php?pilihan=mahasiswa");
}
