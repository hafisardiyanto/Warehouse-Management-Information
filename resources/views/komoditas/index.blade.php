<x-dashboard title="Komoditas">
    <h3>Pengelolaan Komoditas</h3>
    <hr>
    <div class="text-end">
        <a href="/komoditas/create"class="btn btn-warning bg-tersier-color text-white">Tambah
            Data</a>
    </div>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show my-3" style="width: 100%" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h4>Pengajuan Komoditas</h4>
    @if ($komoditasPengajuan->isEmpty())
        <p class="text-center">Data Komoditas Kosong</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Petani</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Kuantitas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($komoditasPengajuan as $komoditas)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td scope="row">{{ $komoditas->user->name }}</td>
                        <td scope="row">{{ $komoditas->cabai->name }}</td>
                        <td scope="row">{{ $komoditas->quantity }}</td>
                        @if (auth()->user()->role == 'petani')
                            <td scope="row">
                                <form action="/komoditas/{{ $komoditas->id }}" method="post" class="d-inline"
                                    onsubmit="return confirm('Apa anda yakin akan menghapus data?')">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        @else
                            <td scope="row">
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal{{ $loop->iteration }}">Terima</button>
                                <a href="/komoditas/{{ $komoditas->id }}/refuse" class="btn btn-danger"
                                    onclick="return confirm('Apa anda yakin akan menolak pengajuan ini?')">Tolak</a>
                            </td>
                            <div class="modal fade" id="modal{{ $loop->iteration }}" tabindex="-1"
                                aria-labelledby="modal{{ $loop->iteration }}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modal{{ $loop->iteration }}Label">Tinjau
                                                Pengajuan
                                                Komoditas</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="/komoditas/{{ $komoditas->id }}/accept" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <label for="gudang_id" class="form-label">Nama Gudang<span
                                                        class="text-danger">*</span></label>
                                                <select name="gudang_id" id="gudang_id" class="form-select">
                                                    @foreach ($gudangs as $gudang)
                                                        <option value="{{ $gudang->id }}">{{ $gudang->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary">Setujui</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $komoditasPengajuan->links() }}
    @endif

    <hr>

    <h4>Riwayat Komoditas</h4>
    @if ($komoditasTindakLanjut->isEmpty())
        <p class="text-center">Data Komoditas Kosong</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Petani</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Kuantitas</th>
                    <th scope="col">Gudang</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($komoditasTindakLanjut as $komoditas)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td scope="row">{{ $komoditas->user->name }}</td>
                        <td scope="row">{{ $komoditas->cabai->name }}</td>
                        <td scope="row">{{ $komoditas->quantity }}</td>
                        @if ($komoditas->status == 'diterima')
                            <td scope="row"><span class="badge text-bg-success" style="width: 80px">Diterima</span>
                            </td>
                        @else
                            <td scope="row"><span class="badge text-bg-danger" style="width: 80px">Ditolak</span>
                            </td>
                        @endif
                        @if (!is_null($komoditas->gudang))
                            <td scope="row">{{ $komoditas->gudang->name }}</td>
                        @else
                            <td scope="row">-</td>
                        @endif

                        <td scope="row">
                            <form action="{{ route('komoditas.destroy', $komoditas->id) }}" method="POST" class="d-inline"
      onsubmit="return confirm('Apa anda yakin akan menghapus data?')">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-sm">Delete</button>
</form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $komoditasTindakLanjut->links() }}
    @endif
</x-dashboard>
