<x-main-layout title="Login">
    <div class="row">
        <div class="col-md-6 overflow-hidden d-none d-md-block p-0">
            <img src="/images/login.jpg" class="vh-100 mx-auto" alt="login">
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center vh-100">
            <form method="POST" action="{{ route('login') }}">
                <img src="/images/logo-with-text.png" alt="cabai" class="mb-3">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Data tidak ditemukan
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control w-100" id="email" placeholder="Masukkan Email Anda"
                        name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="********" name="password">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Login</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Session Status -->


</x-main-layout>
