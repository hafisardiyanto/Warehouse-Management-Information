<x-dashboard title="Petani">
    <h3>Profil</h3>
    <hr>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show my-3" style="width: 100%" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="/profil" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                placeholder="Masukkan nama petani..." required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                placeholder="Masukkan email petani..." required>
        </div>
        @error('email')
            <div class="alert alert-danger" style="width: 100%" role="alert">
                Email telah digunakan, silahkan gunakan email lain
            </div>
        @enderror
        <div class="mb-3">
            <label for="password" class="form-label">Password Lama <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password" name="current_password"
                placeholder="Masukkan password lama..." required>
        </div>
        @error('current_password')
            <div class="alert alert-danger" style="width: 100%" role="alert">
                Password lama yang anda masukkan salah
            </div>
        @enderror
        <div class="mb-3">
            <label for="password" class="form-label">Password Baru <span class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password" name="password"
                placeholder="Masukkan password baru..." required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfimasi Password Baru <span
                    class="text-danger">*</span></label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                placeholder="Masukkan konfirmasi password..." required>
        </div>
        @error('password')
            <div class="alert alert-danger" style="width: 100%" role="alert">
                @if ($errors->first('password') == 'The password field must be at least 8 characters.')
                    Password minimal 8 karakter
                @else
                    Konfirmasi password tidak sesuai dengan password yang dimasukkan
                @endif
            </div>
        @enderror

        <button class="btn btn-warning bg-tersier-color text-white">Ubah Data</button>
    </form>
</x-dashboard>
