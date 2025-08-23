<x-dashboard title="Gudang">
    <h3>Gudang {{ $gudang->name }}</h3>
    <hr>
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show my-3" style="width: 100%" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($komoditasInWerehouse->isEmpty())
        <p class="text-center">Data Komoditas Kosong</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Petani</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Kuantitas (kg)</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($komoditasInWerehouse as $komoditas)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td scope="row">{{ $komoditas->user->name }}</td>
                        <td scope="row">{{ $komoditas->cabai->name }}</td>
                        <td scope="row">{{ $komoditas->quantity }}</td>
                        <td scope="row">
                            <button class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal{{ $loop->iteration }}">Jual</button>
                        </td>
                        <div class="modal fade" id="modal{{ $loop->iteration }}" tabindex="-1"
                            aria-labelledby="modal{{ $loop->iteration }}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modal{{ $loop->iteration }}Label">Jual
                                            Komoditas</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="/gudang/{{ $komoditas->id }}/sell" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <label for="quantity" class="form-label">Kuantitas (kg)<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="quantity" name="quantity"
                                                value="0" max="{{ $komoditas->quantity }}" required>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Setujui</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $komoditasInWerehouse->links() }}
    @endif
</x-dashboard>
