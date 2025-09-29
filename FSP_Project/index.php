<?php
    $conn = new mysqli("localhost", "root", "", "fullstack");

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $pilihan = isset($_GET['pilihan']) ? $_GET['pilihan'] : 'mahasiswa';

    if ($pilihan == 'dosen') {
        $sql = "SELECT npk, nama, foto_extension FROM dosen";
    } else {
        $sql = "SELECT nrp, nama, gender, tanggal_lahir, angkatan, foto_extention FROM mahasiswa";
    }

    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>FSP PROJECT</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="light">

    <div class="head">
        <h1>Website Sederhana</h1>
        <button id="toggleMode" class="toggle-btn light">Dark Mode</button>
    </div>

    <div class="body">
        <div class="atas">
            <h2 style="text-align:center;">Selamat Datang Admin</h2>
        </div>

        <div class="switch">
            <a href="?pilihan=mahasiswa" class="btn <?= $pilihan == 'mahasiswa' ? 'active' : '' ?>">Mahasiswa</a>
            <a href="?pilihan=dosen" class="btn <?= $pilihan == 'dosen' ? 'active' : '' ?>">Dosen</a>
        </div>

        <div class="bawah">
            <h3 style="text-align:center;">
                <?= ucfirst($pilihan) ?>
            </h3>
            <table style="border:1px solid black;">
                <thead>
                    <?php if ($pilihan == 'mahasiswa'): ?>
                        <tr>
                            <th>NRP</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Tanggal Lahir</th>
                            <th>Angkatan</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <th>NPK</th>
                            <th>Nama</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    <?php endif; ?>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <?php if ($pilihan == 'mahasiswa'): ?>
                                <tr>
                                    <td><?= $row['nrp'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['gender'] ?></td>
                                    <td><?= $row['tanggal_lahir'] ?></td>
                                    <td><?= $row['angkatan'] ?></td>
                                    <td><img src="uploads/<?= $row['foto_extension'] ?>.jpeg" alt="foto" width="50"></td>
                                    <td>
                                        <a href="update_mhs.php?nrp=<?= $row['nrp'] ?>" class="btn">Update</a>
                                        <a href="delete_mhs.php?nrp=<?= $row['nrp'] ?>" class="btn">Delete</a>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td><?= $row['npk'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><img src="uploads/<?= $row['foto_extension'] ?>.jpeg" alt="foto" width="50"></td>
                                    <td>
                                        <a href="update_dosen.php?npk=<?= $row['npk'] ?>" class="btn">Update</a>
                                        <a href="delete_dosen.php?npk=<?= $row['npk'] ?>" class="btn">Delete</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="7" style="text-align:center;">Tidak ada data</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div style="text-align:center;">
                <?php if ($pilihan == 'mahasiswa'): ?>
                    <a href="insert_mhs.php" class="btn">Insert Mahasiswa</a>
                <?php else: ?>
                    <a href="insert_dosen.php" class="btn">Insert Dosen</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>BAGIAN FOOTER GATAU MAU DIISI APA</p>
    </div>

    <script src="js/jquery-3.7.1.js"></script>
    <script>
        $(document).ready(function(){
            $("#toggleMode").click(function(){
                $("body").toggleClass("dark light");

                if($("body").hasClass("dark")){
                    $("#toggleMode")
                      .removeClass("light")
                      .addClass("dark")
                      .html("Light Mode");
                } else {
                    $("#toggleMode")
                      .removeClass("dark")
                      .addClass("light")
                      .html("Dark Mode");
                }
            });
        });
    </script>

</body>
</html>
