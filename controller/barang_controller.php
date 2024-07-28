<?php
    require "../model/barang.php";

    class BarangController {

        private $barangModel;
        private $barangView;

        public function __construct() {
            $this->barangModel = new Barang();
        }

        public function getDataList() {
            $data = $this->barangModel->getAllData();
            return $data;
        }

    }

    $barang_controller = new BarangController();
    $data = $barang_controller->getDataList();

    include "../view/template/header.html";
    include "../view/template/menu.html";
    include "../view/barang/page.php";
    include "../view/template/footer.html";
?> 