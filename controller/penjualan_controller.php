<?php
    require "../model/penjualan.php";
    require "../model/barang.php";

    class PenjualanController {

        private $penjualanModel;
        private $barangModel;

        public function __construct() {
            $this->penjualanModel = new Penjualan();
            $this->barangModel = new Barang();
        }

        public function getDataList() {
            $data = $this->penjualanModel->getAllData();
            return $data;
        }

        public function getDataBarang() {
            $data = $this->barangModel->getAllData();
            return $data;
        }

    }

    $penjualan_controller = new PenjualanController();
    $data = $penjualan_controller->getDataList();
    $barang = $penjualan_controller->getDataBarang();

    include "../view/template/header.html";
    include "../view/template/menu.html";
    include "../view/penjualan/page.php";
    include "../view/template/footer.html";
?>