<?php

class Penjualan {
    private $id;
    private $id_barang;
    private $tanggal;
    private $jumlah;
    private $harga;

    public function getid() {
        return $this->id;
    }

    public function getid_barang() {
        return $this->id_barang;
    }

    public function gettanggal() {
        return $this->tanggal;
    }

    public function getjumlah() {
        return $this->jumlah;
    }

    public function getharga() {
        return $this->harga;
    }

    public function getIdPengguna() {
        return $this->idPengguna;
    }

    public function getAllData() {
        require '../connection/connectiondb.php';
        
        $data = [];
        $result = mysqli_query($conn,"select penjualan.*, barang.nama as nama_barang from penjualan inner join barang on penjualan.id_barang = barang.id");
        while ($d = mysqli_fetch_array($result)) {
            $data[$d['id']]['id'] = $d['id'];
            $data[$d['id']]['id_barang'] = $d['id_barang'];
            $data[$d['id']]['nama_barang'] = $d['nama_barang'];
            $data[$d['id']]['tanggal'] = $d['tanggal'];
            $data[$d['id']]['harga'] = $d['harga'];
            $data[$d['id']]['jumlah'] = $d['jumlah'];
        }

        $conn->close();
        return $data;
    }

    public function getDataById($id) {
        require '../connection/connectiondb.php';
        
        $data = [];
        $result = mysqli_query($conn,"select penjualan.*, barang.nama as nama_barang from penjualan inner join barang on penjualan.id_barang = barang.id where penjualan.id = '$id'");
        while ($d = mysqli_fetch_array($result)) {
            $data['id'] = $d['id'];
            $data['id_barang'] = $d['id_barang'];
            $data['tanggal'] = $d['tanggal'];
            $data['harga'] = $d['harga'];
            $data['jumlah'] = $d['jumlah'];
        }

        $conn->close();
        return $data;
    }

    public function insertData($id_barang, $tanggal, $harga, $jumlah) {
        require '../connection/connectiondb.php';
        
        $query = "insert into penjualan values('', '$id_barang', '$tanggal', '$harga', '$jumlah')";
        $result = mysqli_query($conn, $query);
        $data = 0;
        
        if ($result === true) {
            $data = 1;
        }
        
        $conn->close();
        return $data;
    }

    public function updateData($id, $id_barang, $tanggal, $harga, $jumlah) {
        require '../connection/connectiondb.php';
        
        $query = "update penjualan set id_barang = '$id_barang', tanggal = '$tanggal', harga = '$harga', jumlah = '$jumlah' where penjualan.id = '$id'";
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
        
        $query = "delete from penjualan where penjualan.id = '$id'";
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
