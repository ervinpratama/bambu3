<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Anyaman Bambu Desa Duwet</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('landing/assets/favicon.ico') }}" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('landing/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                    @if (auth()->user())
                        <li class="nav-item"><a class="nav-link" href="{{ route('cart') }}"><i
                                    class="fas fa-shopping-cart">
                                </i>
                                @if (cart_count() != 0)
                                    <span class="counter">{{ cart_count() }}</span>
                            </a></li>
                    @endif

                    <li class="nav-item"><a class="nav-link" href="{{ route('customer') }}"><i
                                class="fas fa-user"></i></a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="register">Register</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- Masthead-->
    <header class="masthead">
        <div class="container">
            <div class="masthead-subheading">Welcome!</div>
            <div class="masthead-heading text-uppercase">Apa sih anyaman bambu Desa Duwet itu?</div>
            <a class="btn btn-primary btn-xl text-uppercase" href="#penjelasan">Klik Disini Ya!</a>
        </div>
    </header>
    <!-- Services-->
    <section class="page-section" id="penjelasan">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Info Penting!</h2>
                <h3 class="section-subheading text-muted">Buat yang belum tahu apa sih produk anyaman bambu desa duwet
                    itu.</h3>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-book fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Desa Duwet</h4>
                    <p class="text-muted">Buat yang belum tentang Desa Duwet. <br>
                        Desa Duwet adalah salah satu desa yang berada di Kabupaten Malang tepatnya di Kecamatan Tumpang.
                    </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Produk Anyaman Bambu</h4>
                    <p class="text-muted">Di Desa Duwet ini sendiri ada organisasi yang melibatkan masyarakat nih.
                        <br> Salah satunya yaitu produk anyaman bambu ini, organisasi ini sudah mulai ada dari tahun 60'
                        an sampai sekarang loh gengs.
                        <br> Tujuan adanya organisasi dibuat agar mempermudah dalam berkoordinasi untuk pengembangan
                        produk anyaman bambu kedepannya.
                    </p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fas fa-circle fa-stack-2x text-primary"></i>
                        <i class="fas fa-pencil fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="my-3">Awal Mula Produl</h4>
                    <p class="text-muted">Nah awal mula produk anyaman bambu ini bukan langsung jadi berbagai variasi
                        produk loh.
                        <br> Mereka pertama kali produksi yaitu bentuk besek nih pada tahun 60' an, saat ini sudah
                        banyak variasi produk yang dibuat oleh kurang lebih 165 pengrajin handal guys.
                    </p> 
                </div>
            </div>
        </div>
    </section>
    <!-- Portfolio Grid-->
    <section class="page-section bg-light" id="produk">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Produk</h2>
                <h3 class="section-subheading text-muted">Disini ada beberapa produk terbaik yang dibuat guys.</h3>
            </div>
            <div class="row">
                <h3 class="section-heading text-uppercase">Kategori Produk</h3>
                    <hr/>
                    <center>
                    <div class="row">
                        @foreach ($kategori as $item)
                        <div class="col-md-2">
                            <a href="/customer/category/{{ $item->id }}">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="card-content-kategori">
                                            <img src="{{ asset('foto_kategori/'.$item->foto)}}" alt="">
                                            <h6 class="section-heading text-uppercase" color="black">{{ $item->nama}}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>    
                        @endforeach
                    </div>
                    </center>
                <div class="col-lg-4 col-sm-6 mb-4">
                </div>
                </div>
            </div>
        </div>
    </section>
<!-- Footer-->
<footer class="footer py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-start">Copyright &copy; Duwet 2023</div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>
