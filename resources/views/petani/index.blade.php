<x-dashboard title="Petani">
    <h3>Pengelolaan Petani</h3>
    <hr>
    <div class="text-end">
        <a href="/petani/create"class="btn btn-warning bg-tersier-color text-white">Tambah
            Data</a>
    </div>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show my-3" style="width: 100%" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($petanis->isEmpty())
        <p class="text-center">Data Petani Kosong</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($petanis as $petani)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td scope="row">{{ $petani->name }}</td>
                        <td scope="row">{{ $petani->email }}</td>
                        <td scope="row">{{ $petani->role }}</td>
                        <td scope="row">
                            <form action="{{ route('petani.destroy', $petani->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $petanis->links() }}
    @endif
</x-dashboard>
