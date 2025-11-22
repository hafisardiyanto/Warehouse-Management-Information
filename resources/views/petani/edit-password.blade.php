<x-dashboard title="Edit Password Petani">
    <h3>Edit Password: {{ $petani->name }}</h3>
    <hr>

    <form action="{{ route('petani.updatePassword', $petani->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input type="password" class="form-control" name="password" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-success">Update Password</button>
        <a href="{{ url('/petani') }}" class="btn btn-secondary">Batal</a>
    </form>
</x-dashboard>
