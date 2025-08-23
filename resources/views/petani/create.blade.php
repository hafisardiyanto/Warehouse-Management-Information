<x-dashboard title="Tambah Petani">
    <h3>Tambah Data Petani</h3>
    <hr>
    <form action="/petani" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama petani..."
                required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email"
                placeholder="Masukkan email petani..." required>
        </div>
        @error('email')
            <div class="alert alert-danger" style="width: 100%" role="alert">
                Email telah digunakan, silahkan gunakan email lain
            </div>
        @enderror
        <div class="mb-3">
            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password" name="password"
                placeholder="Masukkan password petani..." required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfimasi Password <span
                    class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                placeholder="Masukkan password petani..." required>
        </div>
        @error('password')
            <div class="alert alert-danger" style="width: 100%" role="alert">
                Konfirmasi password tidak sesuai dengan password yang dimasukkan
            </div>
        @enderror
        <div class="mb-3">
            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
            <select class="form-select" aria-label="Default select example" name="role">
                <option value="pengelola gudang">Pengelola Gudang</option>
                <option value="petani" selected>Petani</option>
            </select>
        </div>
        <button class="btn btn-warning bg-tersier-color text-white">Tambah</button>
    </form>
</x-dashboard>
