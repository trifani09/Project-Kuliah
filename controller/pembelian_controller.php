<?php
    require "../model/pembelian.php";
    require "../model/barang.php";

    class PembelianController {

        private $pembelianModel;
        private $barangModel;

        public function __construct() {
            $this->pembelianModel = new Pembelian();
            $this->barangModel = new Barang();
        }

        public function getDataList() {
            $data = $this->pembelianModel->getAllData();
            return $data;
        }

        public function getDataBarang() {
            $data = $this->barangModel->getAllData();
            return $data;
        }

    }

    $pembelian_controller = new PembelianController();
    $data = $pembelian_controller->getDataList();
    $barang = $pembelian_controller->getDataBarang();

    include "../view/template/header.html";
    include "../view/template/menu.html";
    include "../view/pembelian/page.php";
    include "../view/template/footer.html";
?>