<x-main-layout :title="$title">
    <nav class="bg-secondary-color position-fixed p-4 d-flex flex-column gap-2" style="width: 200px; height: 100%">
        <img src="/images/logo-with-text.png" width="100%" class="mb-3 p-1 bg-white rounded">
        <{{ Request::is('profil') ? 'div' : 'a href=/profil' }}
            class="text-white text-decoration-none p-2 rounded {{ Request::is('profil*') ? 'bg-tersier-color' : '' }}">
            <i class="fa-solid fa-user me-3"></i> Profile</{{ Request::is('profil') ? 'div' : 'a' }}>

            @can('pengelola gudang')
                <a href="/dashboard"
                    class="text-white text-decoration-none p-2 rounded {{ Request::is('dashboard*') ? 'bg-tersier-color' : '' }}"
                    style="{{ Request::is('dashboard*') ? 'cursor : default' : '' }}"><i
                        class="fa-solid fa-gauge me-3"></i></i>Dashboard</a>
            @endcan
            <{{ Request::is('komoditas') ? 'div' : 'a href=/komoditas' }}
                class="text-white text-decoration-none p-2 rounded {{ Request::is('komoditas*') ? 'bg-tersier-color' : '' }}">
                <i class="fa-solid fa-leaf me-3"></i>Komoditas</{{ Request::is('komoditas') ? 'div' : 'a' }}>

                @can('pengelola gudang')
                    <{{ Request::is('cabai') ? 'div' : 'a href=/cabai' }}
                        class="text-white text-decoration-none p-2 rounded {{ Request::is('cabai*') ? 'bg-tersier-color' : '' }}">
                        <i class="fa-solid fa-pepper-hot me-3"></i>Produk</{{ Request::is('cabai') ? 'div' : 'a' }}>
                        <{{ Request::is('petani') ? 'div' : 'a href=/petani' }}
                            class="text-white text-decoration-none p-2 rounded {{ Request::is('petani*') ? 'bg-tersier-color' : '' }}">
                            <i class="fa-solid fa-users-gear me-3"></i>Petani</{{ Request::is('petani') ? 'div' : 'a' }}>
                            <{{ Request::is('gudang') ? 'div' : 'a href=/gudang' }}
                                class="text-white text-decoration-none p-2 rounded {{ Request::is('gudang*') ? 'bg-tersier-color' : '' }}">
                                <i class="fa-solid fa-warehouse me-3"></i>Gudang
                                </{{ Request::is('gudang') ? 'div' : 'a' }}>
                            @endcan


                            <form action="{{ route('logout') }}" method="POST" class="mt-auto">
                                @csrf
                                <button type="submit"
                                    class="text-white p-0 shadow-none border-0 P-2 bg-secondary-color"><i
                                        class="fa-solid fa-right-from-bracket me-3"></i>Logout</button>
                            </form>
    </nav>
    <div style="margin-left: 200px" class="p-4 position-relative">
        {{ $slot }}
    </div>
</x-main-layout>
