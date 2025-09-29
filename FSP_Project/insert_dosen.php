<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    require_once("dosen.php");
    $con = new mysqli("localhost", "root", "", "fullstack");

    if ($con->connect_errno) {
        die("Connect Failed: " . $con->connect_error);
    }
    if (isset($_POST['submit'])) {
        $npk = $_POST['npk'];
        $nama = $_POST['nama'];
        $foto = $_FILES['foto'];
        $ext = pathinfo($foto["name"], PATHINFO_EXTENSION);
        $dosen = new dosen();
        $stmt = $dosen -> insertDosen($npk, $nama, $ext);
        if($stmt){
            $dst = "uploads/$npk.$ext";
            move_uploaded_file($foto["tmp_name"], $dst);
        }
    }
     $con->close();

    ?>
    <a href="index.php?pilihan=dosen">Back to the home</a>
    <form method="post" enctype="multipart/form-data">
        NPK : <input type="text" name="npk" maxlength="6"><br>
        Nama Dosen : <input type="text" name="nama"><br>
        Foto : <input type="file" name="foto" accept="image/*"><br>
        <input type="submit" name="submit" value="Tambah Dosen">
    </form>
</body>

</html>