<?php
require_once("parent.php");
class mahasiswa extends ortu
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertMahasiswa($nrp, $nama, $gender, $tanggalLahir, $angkatan, $foto)
    {
        $sql = "INSERT INTO mahasiswa values (?,?,?,?,?,?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssssss", $nrp, $nama, $gender, $tanggalLahir, $angkatan, $foto);
        $stmt->execute();
        return $stmt;
    }

    public function updateMahasiswa($nrp1, $nrp, $nama, $gender, $tanggalLahir, $angkatan, $foto)
    {
        $sql = "UPDATE mahasiswa SET nrp = ?, nama = ?, gender = ?, tanggal_lahir = ?, angkatan = ?, foto_extention = ?
        WHERE nrp = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sssssss", $nrp, $nama, $gender, $tanggalLahir, $angkatan, $foto, $nrp1);
        $stmt->execute();
        return $stmt;
    }

     public function deleteMahasiswa($nrp){
        $sql = "DELETE FROM mahasiswa WHERE nrp = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $nrp);
        $stmt->execute();
        return $stmt;
    }
}
