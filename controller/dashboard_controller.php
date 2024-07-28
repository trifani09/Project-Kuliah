<?php
    require "../model/dashboard_report.php";

    class DashboardController {

        private $dashboardModel;

        public function __construct() {
            $this->dashboardModel = new DashboardReport();
        }

        public function getPenjualan() {
            $data = $this->dashboardModel->getDataPenjualan();
            return $data;
        }
        
        public function getPembelian() {
            $data = $this->dashboardModel->getDataPembelian();
            return $data;
        }

        public function getCountBarang() {
            $data = $this->dashboardModel->getCountDataBarang();
            return $data;
        }

    }

    $dashboard_controller = new DashboardController();
    $penjualan = $dashboard_controller->getPenjualan();
    $pembelian = $dashboard_controller->getPembelian();
    $jumlah_barang = $dashboard_controller->getCountBarang();

    include "../view/template/header.html";
    include "../view/template/menu.html";
    include "../view/dashboard/page.php";
    include "../view/template/footer.html";

?>