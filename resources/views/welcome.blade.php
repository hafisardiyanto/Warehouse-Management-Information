<x-main-layout title="Welcome">
    <section id="beranda">
        <div class="row shadow-sm">
            <div class="col-md-4 d-flex align-items-center ps-5">
                <img src="/images/clock.svg" alt="jam" width="14px"
                    class="me-2">{{ now()->locale('id')->translatedFormat('l, d F Y') }}
            </div>
            <div class="col-md-8 py-md-3">
                <marquee behavior="scroll" direction="left" class="text-secondary-color"> Sistem Manajemen Pergudangan
                    Cabai </marquee>
            </div>
        </div>
        <div class="row" style="width: 100%">
            <div class="col-12 py-2 ps-5">
                <img src="/images/logo-with-text.png" width="300px" alt="Sistem Manajemen Pergudangan">
            </div>
        </div>
    </section>
    {{-- Navbar --}}
    <nav id="navbar" class="navbar bg-success px-3 d-flex justify-content-center sticky-top">
        <ul class="nav nav-pills d-flex gap-4 py-1">
            <li class="nav-item">
                <a class="nav-link text-white navigation-item" href="#beranda"><i class="fa-solid fa-house"></i>
                    Beranda</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white navigation-item" href="#produk"><i class="fa-solid fa-pepper-hot"></i>
                    Produk Kami</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white navigation-item" href="#kontak"><i class="fa-solid fa-address-book"></i>
                    Kontak Kami</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white navigation-item" href="/login"><i class="fa-solid fa-door-open"></i>
                    Masuk</a>
            </li>
        </ul>
    </nav>
    {{-- Slider --}}
    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/banner1.png" class="d-block w-100" style="height: 450px; object-fit: cover;"
                    alt="Banner Pasar Cabai">
            </div>
            <div class="carousel-item">
                <img src="/images/banner2.png" class="d-block w-100" style="height: 450px; object-fit: cover;"
                    alt="Banner Pasar Cabai">
            </div>
            <div class="carousel-item">
                <img src="/images/banner3.png" class="d-block w-100" style="height: 450px; object-fit: cover;"
                    alt="Banner Pasar Cabai">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <section id="produk">
        <div class="row" style="padding:80px">
            <div class="d-flex align-items-center flex-column">
                <h4 class="fw-bold">Produk Kami</h4>
                <hr width="200px" class="text-secondary-color">
            </div>
            @foreach ($cabais as $cabai)
                <div class="col-md-4 p-1">
                    <div class="card h-100 p-3">
                        <div class="card overflow-hidden mb-2">
                            @if (is_null($cabai->image))
                                <img src="images/cabais/placeholder.jpg" width="100%" alt="hoamm" height="150px"
                                    class="object-fit-cover">
                            @else
                                <img src="{{ asset('images/cabais/' . $cabai->image) }}" alt="{{ $cabai->name }}"
                                    width="100%" height="150px" class="object-fit-cover">
                            @endif
                        </div>
                        <h5 class="fw-bold text-center mb-2">{{ $cabai->name }}</h5>
                        <p class="mb-0 fw-bold">Deskripsi</p>
                        <p class="mb-0">Jumlah: {{ $cabai->komoditas_sum_quantity ?? 0 }}</p>
                        @if (is_null($cabai->description))
                            <p class="fs-6">Produk pedas populer terbaik yang digunakan dalam berbagai masakan.</p>
                        @else
                            <p class="mb-2">{{ $cabai->description }}</p>
                        @endif
                        @if ($cabai->komoditas_sum_quantity > 0)
                            <!-- <a href="https://wa.me/6287870092987" class="btn btn-success mt-auto"><i
                                    class="fa-solid fa-phone"></i> Pesan</a> -->
                        @else
                            <button class="btn btn-secondary mt-auto" disabled><i class="fa-solid fa-phone-slash"></i>
                                Pesan</button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="kontak">
        <div class="bg-dark p-5 d-flex flex-column align-items-center">
            <div class="d-flex align-items-center flex-column">
                <h4 class="fw-bold text-white">Kontak Kami</h4>
                <hr width="200px" class="text-tersier-color">
            </div>
            <!-- <p class="text-white text-center mb-5 fst-italic" style="max-width: 780px">"Dari kebun ke meja, pasar
                cabai
                kami menawarkan cabai terbaik untuk hidangan rasa pedas yang membangkitkan selera dan hidup sehat dengan
                cabai segar, karena rasa pedas adalah teristimewa. Nikmati cinta yang hangat."</p>
            <p class="text-white">Jika ada pertanyaan bisa hubungi :</p>
            <h5 class="text-white">Koordinator Pasar Cabai</h5>
            <h5 class="text-tersier-color fw-bold">Mas Taat (0878-7009-2987)</h5> -->
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-link');

            window.addEventListener('scroll', () => {
                let scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    const sectionId = section.getAttribute('id');

                    if (scrollPosition >= sectionTop && scrollPosition < sectionTop +
                        sectionHeight) {
                        navLinks.forEach(link => {
                            link.classList.remove(
                                'text-orange'); // Hapus kelas warna oranye dari semua link
                            if (link.getAttribute('href') === `#${sectionId}`) {
                                link.classList.add(
                                    'text-orange'
                                ); // Tambahkan kelas warna oranye untuk link aktif
                            }
                        });
                    }
                });
            });
        });
    </script>

    <style>
        .text-orange {
            background-color: orange !important;
        }
    </style>
</x-main-layout>
