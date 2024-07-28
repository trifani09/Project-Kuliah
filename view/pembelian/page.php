<main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class="text-lg">List Pembelian</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="px-4 pt-0 pb-2">
                            <button id="showform" type="button" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#exampleModalMessage">
                                Tambah Data Pembelian
                            </button>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 mx-4">
                                <thead>
                                    <tr>
                                    <th class="text-secondary font-weight-bolder opacity-7">Tanggal Pembelian</th>
                                    <th class="text-secondary font-weight-bolder opacity-7 ps-2">Barang</th>
                                    <th class="text-secondary font-weight-bolder opacity-7">Harga</th>
                                    <th class="text-secondary font-weight-bolder opacity-7">Jumlah</th>
                                    <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data as $d) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $d["tanggal"] ?>
                                        </td>
                                        <td>
                                            <?= $d["nama_barang"] ?>
                                        </td>
                                        <td>
                                            <?= $d["harga"] ?>
                                        </td>
                                        <td>
                                            <?= $d["jumlah"] ?>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-edit" onclick="settingEditForm(<?= $d['id'] ?>)">Edit Data</a>
                                            <a href="#" class="btn btn-delete" onclick="deleteData(<?= $d['id'] ?>)">Hapus Data</a>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Pembelian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formdata" action="../controller/crud_controller.php" method="post">
                        <input type="hidden" class="form-control" id="type-master" name="type_master" value="pembelian">
                        <input type="hidden" class="form-control" id="operation_type" name="operation_type" value="create">
                        <input type="hidden" class="form-control" id="id_data" name="id_data">
                        <div class="form-group">
                            <label for="tanggal" class="col-form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal" class="col-form-label">Barang</label>
                            <select name="id_barang" class="form-control" id="id_barang" required>
                                <option value="" selected disabled>-- Pilih Barang --</option>
                                <?php
                                foreach ($barang as $b) {
                                ?>
                                <option value="<?= $b["id"] ?>"><?= $b["nama"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="harga" class="col-form-label">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="col-form-label">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <div class="form-group modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function settingEditForm(id) {
        var reqData = {
            type_master: "pembelian",
            id_data: id
        };
        
        $.ajax({
            url: "../controller/crud_controller.php",
            type: "GET",
            data: reqData,
            dataType: "json",
            success: function(data) {
                var id_data = document.getElementById("id_data");
                var operation_type = document.getElementById("operation_type");
                var id_barang = document.getElementById("id_barang");
                var tanggal = document.getElementById("tanggal");
                var harga = document.getElementById("harga");
                var jumlah = document.getElementById("jumlah");

                operation_type.value = "update";
                id_data.value = data["id"];
                id_barang.value = data["id_barang"];
                tanggal.value = data["tanggal"];
                harga.value = data["harga"];
                jumlah.value = data["jumlah"];

                document.getElementById("showform").click();

                console.log(data);
            },
            error: function(xhr, status, error) {
                console.error("Error: " + status, error);
            }
        });
    }

    function deleteData(id) {
        var reqData = {
            type_master: "pembelian",
            id_data: id,
            operation_type: "delete"
        };
        
        $.ajax({
            url: "../controller/crud_controller.php",
            type: "POST",
            data: reqData,
            dataType: "json",
            success: function(data) {
                console.log("Data deleted");
            },
            error: function(xhr, status, error) {
                console.error("Error: " + status, error);
                location.reload();
            }
        });
    }
</script>