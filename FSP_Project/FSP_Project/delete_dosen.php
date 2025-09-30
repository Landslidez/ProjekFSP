<?php
require_once("dosen.php");
$npk = $_GET["npk"];
$dosen = new dosen();
$stmt = $dosen->deleteDosen($npk);
if ($stmt) {
    //Paling buat notif mboh wes capek otak dah perih
}
else{
     echo "Delete Gagal. <br>";
}
header("Location: index.php?pilihan=dosen");