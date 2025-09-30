<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            border: 1px solid black;
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
            background: orange;
            color: black;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
        }

        form input[type="submit"]:hover {
            background: orange;
        }

    </style>
</head>

<body>
    <?php
    $nrp = $_GET["nrp"];
    $conn = new mysqli("localhost", "root", "", "fullstack");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM mahasiswa WHERE nrp =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nrp);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $nama = $row["nama"];
        $gender = $row["gender"];
        $tanggalLahir = $row["tanggal_lahir"];
        $angkatan = $row["angkatan"];
    }
    ?>
    <a href="index.php?pilihan=mahasiswa">Back to the home</a>
    <form method="post" enctype="multipart/form-data" action="update_mhs_proses.php">
        NRP : <input type="text" name="nrp" maxlength="9" value="<?php echo $nrp ?>"><br>
        Nama Mahasiswa : <input type="text" name="nama" value="<?php echo $nama ?>"><br>
        Gender : <input type="radio" id="Pria" name="gender" value="Pria" <?php if ($gender == "Pria") echo "checked"; ?>><label for="Pria">Pria</label>
        <input type="radio" id="Wanita" name="gender" value="Wanita" <?php if ($gender == "Wanita") echo "checked"; ?>><label for="Wanita">Wanita</label><br>
        Tanggal Lahir : <input type="date" name="tanggalLahir" value="<?php echo $tanggalLahir ?>"><br>
        Angkatan : <input type="number" name="angkatan" min="1966" max="<?php echo date('Y') ?>" value= <?php echo $angkatan ?>><br>
        Foto : <input type="file" name="foto" accept="image/*"><br>
        <input type="hidden" name="nrp1" value = "<?php echo $nrp ?>"> <!-- nrp awal. Sama aja kayak nrp kalau gk ganti -->
        <input type="submit" name="submit" value="Update Mahasiswa">
    </form>
</body>

</html>