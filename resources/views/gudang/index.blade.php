<x-dashboard title="Gudang">
    <h3>Pengelolaan Gudang</h3>
    <hr>
    <div class="text-end">
        <a href="/gudang/create" class="btn btn-warning bg-tersier-color text-white">Tambah Data</a>
    </div>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show my-3" style="width: 100%" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($gudangs->isEmpty())
        <p class="text-center">Data Gudang Kosong</p>
    @else
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gudangs as $gudang)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td scope="row">{{ $gudang->name }}</td>
                        <td scope="row">
                            <a href="/gudang/{{ $gudang->id }}" class="btn btn-primary">Detail</a>
                            <form action="/gudang/{{ $gudang->id }}" method="post" class="d-inline"
                                onsubmit="return confirm('Apa anda yakin akan menghapus data?')">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $gudangs->links() }}
    @endif
</x-dashboard>
