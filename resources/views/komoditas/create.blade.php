<x-dashboard title="Tambah Komoditas">
    <h3>Tambah Data Komoditas</h3>
    <hr>
    <form action="/komoditas" method="POST">
        @csrf
        <div class="mb-3">
            <label for="cabai_id" class="form-label">Nama Produk<span class="text-danger">*</span></label>
            <select name="cabai_id" id="cabai_id" class="form-select">
                @foreach ($cabais as $cabai)
                    <option value="{{ $cabai->id }}">{{ $cabai->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Kuantitas <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Jumlah" required>
        </div>
        <button class="btn btn-warning bg-tersier-color text-white">Tambah</button>
    </form>
</x-dashboard>
