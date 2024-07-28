<main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="mb-0 font-weight-bold">Jumlah Barang</p>
                    <h1 id="jumlah_barang" class="font-weight-bolder">
                      2,300
                    </h1>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="mb-0 font-weight-bold">Total Laba Rugi</p>
                    <h1 id="total_labarugi" class="font-weight-bolder">
                      +Rp 3,462
                    </h1>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
      <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="mb-0 font-weight-bold">Total Pemasukan</p>
                    <h1 id="total_penjualan" class="font-weight-bolder">
                      Rp 53,000
                    </h1>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="mb-0 font-weight-bold">Total Pengeluaran</p>
                    <h1 id="total_pembelian" class="font-weight-bolder">
                      Rp 103,430
                    </h1>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-12 mb-lg-0 mb-0">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
              <h6 class="text-capitalize cstm-sz">Penjualan Barang Bulan July 2024</h6>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="200"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
    var barang = [];
    var penjualan = [];
    var pembelian = [];
    var labarugi = [];
    var total_penjualan = 0;
    var total_pembelian = 0;
    var total_labarugi = 0;

    <?php
      foreach ($penjualan as $d) {
      ?>
        barang.push("<?= $d["nama"] ?>");
        penjualan.push(<?= $d["total"] ?>);
      <?php
      }
    ?>
    
    <?php
      foreach ($pembelian as $d) {
      ?>
        pembelian.push(<?= $d["total"] ?>);
      <?php
      }
    ?>

    for (let i = 0; i < penjualan.length; i++) {
      labarugi.push(penjualan[i] - pembelian[i]);
      total_labarugi += labarugi[i];
      total_penjualan += penjualan[i];
      total_pembelian += pembelian[i];
    }

    document.getElementById("jumlah_barang").innerHTML = "<?= $jumlah_barang["jumlah_barang"] ?>";
    document.getElementById("total_labarugi").innerHTML = "Rp "+total_labarugi.toLocaleString('en-US');
    document.getElementById("total_penjualan").innerHTML = "Rp "+total_penjualan.toLocaleString('en-US');
    document.getElementById("total_pembelian").innerHTML = "Rp "+total_pembelian.toLocaleString('en-US');

    var ctx1 = document.getElementById("chart-line").getContext("2d");
    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

    
    new Chart(ctx1, {
    type: "line",
    data: {
        labels: barang,
        datasets: [{
            label: "Laba Rugi",
            tension: 0.4,
            borderWidth: 3,
            pointRadius: 0,
            borderColor: "#454B61",
            backgroundColor: gradientStroke1,
            fill: true,
            data: labarugi,
            maxBarThickness: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        interaction: {
            intersect: false,
            mode: 'index'
        },
        scales: {
            y: {
                grid: {
                    drawBorder: true,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    padding: 10,
                    color: '#333',
                    font: {
                        size: 11,
                        family: "Poppins",
                        style: 'normal',
                        lineHeight: 2
                    }
                }
            },
            x: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    color: '#333',
                    padding: 20,
                    font: {
                        size: 11,
                        family: "Poppins",
                        style: 'normal',
                        lineHeight: 2
                    }
                }
            }
        }
    }
});
  </script>