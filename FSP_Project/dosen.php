<?php
require_once("parent.php");
class dosen extends ortu
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insertDosen($npk, $nama, $foto)
    {
        $sql = "INSERT INTO dosen values (?,?,?)";
        $stmt = $this-> con ->prepare($sql);
        $stmt->bind_param("sss", $npk, $nama, $foto);
        $stmt->execute();
        return $stmt;
    }

    public function updateDosen($npk, $nama, $foto, $npk1){
        $sql = "UPDATE dosen SET npk = ?, nama = ?, foto_extension = ? WHERE npk = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssss", $npk, $nama, $foto, $npk1);
        $stmt->execute();
        return $stmt;
    }

    public function deleteDosen($npk){
        $sql = "DELETE FROM dosen WHERE npk = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $npk);
        $stmt->execute();
        return $stmt;
    }
}
