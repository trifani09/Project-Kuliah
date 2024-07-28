<main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class="text-lg">List Barang</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="px-4 pt-0 pb-2">
                            <button id="showform" type="button" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#exampleModalMessage">
                                Tambah Barang
                            </button>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 mx-4">
                                <thead>
                                    <tr>
                                    <th class="text-secondary font-weight-bolder opacity-7">Nama Barang</th>
                                    <th class="text-secondary font-weight-bolder opacity-7 ps-2">Keterangan</th>
                                    <th class="text-secondary font-weight-bolder opacity-7">Satuan</th>
                                    <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data as $d) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?= $d["nama"] ?>
                                        </td>
                                        <td>
                                            <?= $d["keterangan"] ?>
                                        </td>
                                        <td>
                                            <?= $d["satuan"] ?>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-edit" onclick="settingEditForm(<?= $d['id'] ?>)">Edit Barang</a>
                                            <a href="#" class="btn btn-delete" onclick="deleteData(<?= $d['id'] ?>)">Hapus Barang</a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Form Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formdata" action="../controller/crud_controller.php" method="post">
                        <input type="hidden" class="form-control" id="type-master" name="type_master" value="barang">
                        <input type="hidden" class="form-control" id="operation_type" name="operation_type" value="create">
                        <input type="hidden" class="form-control" id="id_data" name="id_data">
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="col-form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="satuan" class="col-form-label">Satuan</label>
                            <input type="text" class="form-control" placeholder="pcs/box/etc" id="satuan" name="satuan" required>
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
    function showModal() {
        var modal = document.getElementById("exampleModalMessage");
        modal.style.display = "block";
    }

    function settingEditForm(id) {
        var reqData = {
            type_master: "barang",
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
                var nama = document.getElementById("nama");
                var keterangan = document.getElementById("keterangan");
                var satuan = document.getElementById("satuan");

                operation_type.value = "update";
                id_data.value = data["id"];
                nama.value = data["nama"];
                keterangan.value = data["keterangan"];
                satuan.value = data["satuan"];

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
            type_master: "barang",
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