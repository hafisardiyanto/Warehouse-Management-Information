<x-dashboard title="Cabai">
    <h3>Pengelolaan Cabai</h3>
    <hr>
    <div class="text-end">
        <a href="/cabai/create"class="btn btn-warning bg-tersier-color text-white">Tambah
            Data</a>
    </div>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show my-3" style="width: 100%" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($cabais->isEmpty())
        <p class="text-center">Data Cabai Kosong</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cabais as $cabai)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td scope="row">{{ $cabai->name }}</td>
                        <td scope="row">
                            @if ($cabai->image == null)
                                Tidak Ada gambar
                            @else
                                <img src="{{ asset('images/cabais/' . $cabai->image) }}" width="200px" height="200px"
                                    class="object-fit-cover" alt="{{ $cabai->name }}">
                            @endif
                        </td>
                        <td scope="row">{{ $cabai->description }}</td>
                        <td scope="row">
                            <a href="/cabai/{{ $cabai->id }}/edit" class="btn btn-primary mb-1"
                                style="width: 100px">Edit</a>
                            <form action="/cabai/{{ $cabai->id }}" method="post" class="d-inline"
                                onsubmit="return confirm('Apa anda yakin akan menghapus data?')">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" style="width: 100px">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $cabais->links() }}
    @endif
</x-dashboard>
