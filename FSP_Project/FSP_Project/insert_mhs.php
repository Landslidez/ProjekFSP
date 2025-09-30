<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: white;
            color: black;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px;
        }

        h1, h2, h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            background: blue;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
        }

        a:hover {
            background: blue;
        }

        form {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid grey;
            border-radius: 6px;
            outline: none;
        }

        form input[type="text"]:focus,
        form input[type="number"]:focus,
        form input[type="date"]:focus,
        form input[type="file"]:focus {
            border: 1px solid blue;
        }

        form label {
            margin-right: 15px;
            font-weight: 500;
        }
        form input[type="radio"] {
            margin-right: 6px;
        }

        form input[type="submit"] {
            display: block;
            width: 100%;
            background: green;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
        }

        form input[type="submit"]:hover {
            background: green;
        }
    </style>
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