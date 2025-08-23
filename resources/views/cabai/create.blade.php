<x-dashboard title="Tambah Cabai">
    <h3>Tambah Data Produk</h3>
    <hr>
    <form action="/cabai" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name"
                placeholder="Masukkan nama jenis cabai..." required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk</label>
            <input class="form-control" type="file" id="image" name="image">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan deskripsi..."></textarea>
        </div>
        <button class="btn btn-warning bg-tersier-color text-white">Tambah</button>
    </form>
</x-dashboard>
