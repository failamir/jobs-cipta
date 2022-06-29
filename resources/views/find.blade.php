<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cipta Wira Tirta|Find Job</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-color: #F5F6FB;">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="img/logo-cowpy.png" class="logo-utama" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="https://ciptawiratirta.com/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://ciptawiratirta.com/about/">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Our Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="https://ciptawiratirta.com/manning-services/">Maning Services</a></li>
                            <li><a class="dropdown-item" href="https://ciptawiratirta.com/insurance/">Insurance</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://ciptawiratirta.com/safety-quality-policy/">Safety & Quality Policy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="https://ciptawiratirta.com/jobs/">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://ciptawiratirta.com/contact/">Contact</a>
                    </li>
                </ul>
                @if(Auth::id() == null)
                <form class="d-flex">
                    {{-- <a class="tombol-login ms-5 btn btn-outline-light center" href="{{ url('/login') }}" type="submit">Login</a> --}}
                    <button class="tombol-login ms-5 btn btn-outline-light center ticker-btn" onclick="location.href='{{ url('/register') }}'" type="button">Signup</a>
				    <button class="tombol-login ms-5 btn btn-outline-light center ticker-btn" onclick="location.href='{{ url('/login') }}'" type="button">Login</a>
                </form>
                @else
                <button class="tombol-login ms-5 btn btn-outline-light center ticker-btn" onclick="location.href='{{ url('/admin') }}'" type="button">Hai {{Auth::user()->name }} </button>
                @endif
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="search mt-5 rounded-3 d-flex justify-content-between align-items-center">
            <div class="icon ms-5">
                <i class="tombol bi bi-search"></i>
                <input type="text" placeholder="Search Jobs, keywords..." class="ms-3">
            </div>
            <div class="tombol-cari d-flex align-items-center">
                <i class="tombol bi bi-briefcase"></i>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        All Categories
                    </button>
                    <ul class="dropdown-menu mx-2" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Hotel Department</a></li>
                    </ul>
                </div>
                <button type="button" class="btn btn-primary ms-2 me-5">Find Jobs</button>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-between">
                    <h6 class="mt-4">Showing All 2 result</h6>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Short by ( Default )
                        </button>
                        <ul class="dropdown-menu mx-2" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Short by ( Default )</a></li>
                            <li><a class="dropdown-item" href="#">Newest</a></li>
                            <li><a class="dropdown-item" href="#">Oldest</a></li>
                            <li><a class="dropdown-item" href="#">Random</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col d-flex flex-wrap">
                    <?php foreach ($jobs as $d){ ?>
                        {{-- @dump($d) --}}
                    <div class="card me-4 mb-5 p-4 d-flex flex-column justify-content-center align-items-center"
                        style="width: 18rem;">
                        <a href="#"><img src="img/nclh_logo-1-150x150.jpg" class="rounded-circle" width="100"
                                alt="..."></a>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h5 class="card-title"><a href='{{ url('/detail/'.$d->id) }}' type="button" >{{ $d->title }}</a></h5>
                            <p class="card-text"><a href="#">{{ 'Expired: '. date('jS M Y', strtotime($d->date_expired)) }}</a></p>
                        </div>
                    </div>
                    <?php  } ?>
                    {{-- <div class="card me-4 mb-5 p-4 d-flex flex-column justify-content-center align-items-center"
                        style="width: 18rem;">
                        <a href="#"><img src="img/nclh_logo-1-150x150.jpg" class="rounded-circle" width="100"
                                alt="..."></a>
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <h5 class="card-title"><a href="#">Norwegian Cruise Line</a></h5>
                            <p class="card-text"><a href="#">JR. Deck Seafarer</a></p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>


    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>