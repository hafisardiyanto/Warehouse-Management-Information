<x-dashboard title="Tambah Gudang">
    <h3>Tambah Data Gudang</h3>
    <hr>
    <form action="/gudang" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name"
                placeholder="Masukkan nama jenis gudang..." required>
        </div>
        <button class="btn btn-warning bg-tersier-color text-white">Tambah</button>
    </form>
</x-dashboard>
