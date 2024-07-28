<?php

class DashboardReport {
    
    public function getDataPenjualan() {
        require '../connection/connectiondb.php';
        
        $data = [];
        $query = "select barang.id, barang.nama,
            avg(penjualan.harga) as harga_jual, 
            sum(penjualan.jumlah) as jumlah_jual,
            (avg(penjualan.harga) * sum(penjualan.jumlah)) as total
        from penjualan 
        join barang on penjualan.id_barang = barang.id 
        where month(penjualan.tanggal) = month(CURRENT_DATE())
        group by barang.id";

        $result = mysqli_query($conn, $query);
        while ($d = mysqli_fetch_array($result)) {
            $data[$d['id']]['id'] = $d['id'];
            $data[$d['id']]['nama'] = $d['nama'];
            $data[$d['id']]['harga_jual'] = $d['harga_jual'];
            $data[$d['id']]['jumlah_jual'] = $d['jumlah_jual'];
            $data[$d['id']]['total'] = $d['total'];
        }

        $conn->close();
        return $data;
    }

    public function getDataPembelian() {
        require '../connection/connectiondb.php';
        
        $data = [];
        $query = "select barang.id, barang.nama,
            avg(pembelian.harga) as harga_beli, 
            sum(pembelian.jumlah) as jumlah_beli,
            (avg(pembelian.harga) * sum(pembelian.jumlah)) as total
        from pembelian 
        join barang on pembelian.id_barang = barang.id 
        where month(pembelian.tanggal) = month(CURRENT_DATE())
        group by barang.id";

        $result = mysqli_query($conn, $query);
        while ($d = mysqli_fetch_array($result)) {
            $data[$d['id']]['id'] = $d['id'];
            $data[$d['id']]['nama'] = $d['nama'];
            $data[$d['id']]['harga_beli'] = $d['harga_beli'];
            $data[$d['id']]['jumlah_beli'] = $d['jumlah_beli'];
            $data[$d['id']]['total'] = $d['total'];
        }

        $conn->close();
        return $data;
    }

    public function getCountDataBarang() {
        require '../connection/connectiondb.php';
        
        $data = [];
        $query = "select count(*) as jumlah_barang from barang";

        $result = mysqli_query($conn, $query);
        while ($d = mysqli_fetch_array($result)) {
            $data['jumlah_barang'] = $d['jumlah_barang'];
        }

        $conn->close();
        return $data;
    }

}

?>