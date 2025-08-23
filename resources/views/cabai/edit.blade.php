<x-dashboard title="Ubah Data Cabai">
    <h3>Ubah Data Produk</h3>
    <hr>
    <form action="/cabai/{{ $cabai->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name"
                placeholder="Masukkan nama jenis cabai..." value="{{ old('name') ?? $cabai->name }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label d-block">Gambar Produk</label>

            <img src="{{ asset('images/cabais/' . $cabai->image) }}" alt="{{ $cabai->name }}" width="200px"
                height="200px" class="object-fit-cover mb-2">
            <input class="form-control" type="file" id="image" name="image">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan deskripsi...">{{ old('description') ?? $cabai->description }}</textarea>
        </div>
        <button class="btn btn-warning bg-tersier-color text-white">Ubah</button>
    </form>
</x-dashboard>
