<?php

class Barang {
    private $id;
    private $nama;
    private $keterangan;
    private $satuan;
    
    public function getid() {
        return $this->id;    
    }
        
    public function getnama() {
        return $this->nama;
    }
    
    public function getKeterangan() {
        return $this->keterangan;
    }
    
    public function getSatuan() {
        return $this->satuan;
    }
    
    public function getAllData() {
        require '../connection/connectiondb.php';
        
        $data = [];
        $result = mysqli_query($conn,"select * from barang");
        while ($d = mysqli_fetch_array($result)) {
            $data[$d['id']]['id'] = $d['id'];
            $data[$d['id']]['nama'] = $d['nama'];
            $data[$d['id']]['keterangan'] = $d['keterangan'];
            $data[$d['id']]['satuan'] = $d['satuan'];
        }

        $conn->close();
        return $data;
    }

    public function getDataById($id) {
        require '../connection/connectiondb.php';
        
        $data = [];
        $result = mysqli_query($conn,"select * from barang where id = '$id'");
        while ($d = mysqli_fetch_array($result)) {
            $data['id'] = $d['id'];
            $data['nama'] = $d['nama'];
            $data['keterangan'] = $d['keterangan'];
            $data['satuan'] = $d['satuan'];
        }

        $conn->close();
        return $data;
    }

    public function insertData($nama, $keterangan, $satuan) {
        require '../connection/connectiondb.php';
        
        $query = "insert into barang values('','$nama','$keterangan','$satuan')";
        $result = mysqli_query($conn, $query);
        $data = 0;
        
        if ($result === true) {
            $data = 1;
        }
        
        $conn->close();
        return $data;
    }

    public function updateData($id, $nama, $keterangan, $satuan) {
        require '../connection/connectiondb.php';
        
        $query = "update barang set nama = '$nama', keterangan = '$keterangan', satuan = '$satuan' where id = '$id'";
        $result = mysqli_query($conn, $query);
        $data = 0;
        
        if ($result === true) {
            $data = 1;
        }
        
        $conn->close();
        return $data;
    }

    public function deleteData($id) {
        require '../connection/connectiondb.php';
        
        $query = "delete from barang where id = '$id'";
        $result = mysqli_query($conn, $query);
        $data = 0;
        
        if ($result === true) {
            $data = 1;
        }
        
        $conn->close();
        return $data;
    }
}

?>