<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $npk = $_GET['npk'];
    $conn = new mysqli("localhost", "root", "", "fullstack");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM dosen WHERE npk =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $npk);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $nama = $row["nama"];
    }
    ?>
    <a href="index.php?pilihan=dosen">Back to the home</a>
    <form method="post" enctype="multipart/form-data" action="update_dosen_proses.php">
        NPK : <input type="text" name="npk" maxlength="6" value="<?php echo $npk ?>"><br>
        Nama Dosen : <input type="text" name="nama" value = "<?php echo $nama ?>"><br>
        Foto : <input type="file" name="foto" accept="image/*"><br>
        <input type="hidden" name = "npk1" value= "<?php echo $npk ?>">
        <input type="submit" name="submit" value="Tambah Dosen">
    </form>
</body>
</html>