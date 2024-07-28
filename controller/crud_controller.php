<?php
    require "../model/barang.php";
    require "../model/pembelian.php";
    require "../model/penjualan.php";

    $barangModel = new Barang();
    $pembelianModel = new Pembelian();
    $penjualanModel = new Penjualan();

    // GET
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $type_master = $_GET["type_master"];
        
        if ($type_master == "barang") {
            $id_barang = $_GET["id_data"];
            
            $result = $barangModel->getDataById($id_barang);

            echo json_encode($result);
        }

        if ($type_master == "pembelian") {
            $id = $_GET["id_data"];
            
            $result = $pembelianModel->getDataById($id);

            echo json_encode($result);
        }

        if ($type_master == "penjualan") {
            $id = $_GET["id_data"];
            
            $result = $penjualanModel->getDataById($id);

            echo json_encode($result);
        }
    }

    //CREATE - UPDATE - DELETE
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $type_master = $_POST["type_master"];
        $operation_type = $_POST["operation_type"];

        if ($type_master == "barang") {
            if ($operation_type != "delete") {
                $nama = $_POST["nama"];
                $keterangan = $_POST["keterangan"];
                $satuan = $_POST["satuan"];
            }

            if ($operation_type == "create") {
                $result = $barangModel->insertData($nama, $keterangan, $satuan);
            } else if ($operation_type == "update") {
                $id = $_POST["id_data"];
                $result = $barangModel->updateData($id, $nama, $keterangan, $satuan);
            } else {
                $id = $_POST["id_data"];
                $result = $barangModel->deleteData($id);
            }

            if ($result == 1) {
                header("location:barang_controller.php");
            }
        }

        if ($type_master == "pembelian") {
            if ($operation_type != "delete") {
                $id_barang = $_POST["id_barang"];
                $tanggal = $_POST["tanggal"];
                $harga = $_POST["harga"];
                $jumlah = $_POST["jumlah"];
            }

            if ($operation_type == "create") {
                $result = $pembelianModel->insertData($id_barang, $tanggal, $harga, $jumlah);
            } else if ($operation_type == "update") {
                $id = $_POST["id_data"];
                $result = $pembelianModel->updateData($id, $id_barang, $tanggal, $harga, $jumlah);
            } else {
                $id = $_POST["id_data"];
                $result = $pembelianModel->deleteData($id);
            }

            if ($result == 1) {
                header("location:pembelian_controller.php");
            }
        }

        if ($type_master == "penjualan") {
            if ($operation_type != "delete") {
                $id_barang = $_POST["id_barang"];
                $tanggal = $_POST["tanggal"];
                $harga = $_POST["harga"];
                $jumlah = $_POST["jumlah"];
            }

            if ($operation_type == "create") {
                $result = $penjualanModel->insertData($id_barang, $tanggal, $harga, $jumlah);
            } else if ($operation_type == "update") {
                $id = $_POST["id_data"];
                $result = $penjualanModel->updateData($id, $id_barang, $tanggal, $harga, $jumlah);
            } else {
                $id = $_POST["id_data"];
                $result = $penjualanModel->deleteData($id);
            }

            if ($result == 1) {
                header("location:penjualan_controller.php");
            }
        }
    }

?>