<x-dashboard title="Dashboard">
    <h3>Dashboard</h3>
    <hr>
    <div class="row">
        <div class="col-md-4 mb-4">
            <a href="/komoditas" class="text-decoration-none">
                <div class="card px-5 py-5 bg-info shadow btn btn-info">
                    <p class="mb-0 text-white">Pengajuan Komoditas</p>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="text-white fs-4 fw-bold me-2">{{ $countKomoditas }}</span><span
                            class="text-white fs-4 fw-bold">Komoditas</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="/cabai" class="text-decoration-none">
                <div class="card px-5 py-5 bg-success shadow btn btn-success">
                    <p class="mb-0 text-white">Total Produk</p>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="text-white fs-4 fw-bold me-2">{{ $countProduk }}</span><span
                            class="text-white fs-4 fw-bold">Produk</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="/petani" class="text-decoration-none">
                <div class="card px-5 py-5 bg-warning shadow btn btn-warning">
                    <p class="mb-0 text-white">Total Pengguna</p>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="text-white fs-4 fw-bold me-2">{{ $countPengguna }}</span><span
                            class="text-white fs-4 fw-bold">Pengguna</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="/gudang" class="text-decoration-none">
                <div class="card px-5 py-5 bg-danger shadow btn btn-danger">
                    <p class="mb-0 text-white">Total Gudang</p>
                    <div class="d-flex align-items-center justify-content-center">
                        <span class="text-white fs-4 fw-bold me-2">{{ $countGudang }}</span><span
                            class="text-white fs-4 fw-bold">Gudang</span>
                    </div>
                </div>
            </a>
        </div>


</x-dashboard>
