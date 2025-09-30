<?php
require_once("mahasiswa.php");
$nrp = $_GET["nrp"];
$mahasiswa = new mahasiswa();
$stmt = $mahasiswa->deleteMahasiswa($nrp);
if ($stmt) {
    //Paling buat notif mboh wes capek otak dah perih
}
else{
     echo "Delete Gagal. <br>";
}
header("Location: index.php?pilihan=mahasiswa");