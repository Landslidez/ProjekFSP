<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once("mahasiswa.php");
    $con = new mysqli("localhost", "root", "", "fullstack");

    if ($con->connect_errno) {
        die("Connect Failed: " . $con->connect_error);
    }
    if (isset($_POST['submit'])) {
        $nrp = $_POST['nrp'];
        $nama = $_POST['nama'];
        $gender = $_POST['gender'];
        $tanggalLahir = $_POST['tanggalLahir'];
        $angkatan = $_POST['angkatan'];
        $foto = $_FILES['foto'];
        $ext = pathinfo($foto["name"], PATHINFO_EXTENSION);
        $mahasiswa = new mahasiswa();
        $stmt = $mahasiswa->insertMahasiswa($nrp, $nama, $gender, $tanggalLahir, $angkatan, $ext);
        if ($stmt) {
            $dst = "uploads/$nrp.$ext";
            move_uploaded_file($foto["tmp_name"], $dst);
        }
    }
    $con->close();

    ?>
    <a href="index.php?pilihan=mahasiswa">Back to the home</a>
    <form method="post" enctype="multipart/form-data">
        NRP : <input type="text" name="nrp" maxlength="9"><br>
        Nama Mahasiswa : <input type="text" name="nama"><br>
        Gender : <input type="radio" id="Pria" name="gender" value="Pria"><label for="Pria">Pria</label>
        <input type="radio" id="Wanita" name="gender" value="Wanita"><label for = "Wanita">Wanita</label><br>
        Tanggal Lahir : <input type="date" name="tanggalLahir"><br>
        Angkatan : <input type="number" name="angkatan" min = "1966" max = "<?php echo date('Y')?>"><br>
        Foto : <input type="file" name="foto" accept="image/*"><br>
        <input type="submit" name="submit" value="Tambah Mahasiswa">
    </form>
</body>

</html>