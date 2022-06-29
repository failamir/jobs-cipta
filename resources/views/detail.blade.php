<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Job</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../img/logo-cowpy.png" class="logo-utama" alt=""></a>
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
        <div class="row">
            <div class="col mt-5 d-flex justify-content-between align-items-center">
                <div class="title">
                    <h2>JR. Deck Seafarer <i class="bi bi-check-circle"></i></h2>
                    <div class="badge bg-warning text-dark">Urgent</div>
                </div>

                <div class="d-flex">
                    <button type="button" class="btn btn-primary ms-2 me-5" onclick="location.href='{{ url('/apply/'.$job->id) }}'" type="button">Apply Now</button>
                    <i class="tombol-bookmark bi bi-bookmark-check"></i>
                </div>
            </div>
        </div>
        {{-- @dump($job) --}}
        <div class="row mt-5">
            <div class="col">
                <div class="job-overview">
                    <h6 class="mx-4 mb-3">Job Overview</h6>
                    <div class="row">
                        <div class="col d-flex">
                            <div class="date-posted d-flex me-4">
                                <i class="logo-date bi bi-calendar mx-4"></i>
                                <div class="text">
                                    <h6 class="title-date">Date Posted</h6>
                                    <h6 class="sub-title">{{ date('jS M Y', strtotime($job->date_posted)) }}</h6>
                                </div>
                            </div>

                            <div class="date-posted d-flex">
                                <i class="logo-date bi bi-hourglass-top mx-4"></i>
                                <div class="text">
                                    <h6 class="title-date">Expiration date</h6>
                                    <h6 class="sub-title">{{ date('jS M Y', strtotime($job->date_expired)) }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <h6 class="mb-4">Job Description</h6>
            {{-- <img src="../img/job.jpg" class="img-job" alt=""> --}}
            {!! $job->job_description !!}
            <h6 class="mt-4">Requirement:</h6>
            {!! $job->requirement !!}
            {{-- <ul class="ms-5">
                <li>Must have valid STCW Certificates</li>
                <li>Min 2 years experience in the same position</li>
                <li>Good english communication</li>
                <li>Must have valid email address & Passport</li>
                <li>Must be fully vaccinated with COV-19 vaccine</li>
            </ul> --}}
            <button onclick="show()" class="tombol-job btn btn-primary mb-4">Click Here For Procedure Recruitment</button>
            <div style="display:none" id="info">{!! $job->procedure_recruitment !!}</div>
            <h6 class="mt-5">Share this post <span class="ms-2"><button class="badge bg-primary border-0"><i
                            class="tombol-facebook bi bi-facebook me-1"></i>Facebook</button></span></h6>

            <h4 class="mt-5">Related Jobs</h4>

            <div class="related-jobs d-flex justify-content-between mb-5">
                <div class="d-flex py-4">
                    <img src="../img/job.jpeg" class="foto-job mx-3" alt="">
                    <div>
                        <h6>Room Stewardess</h6>
                        <p><i class="bi bi-briefcase me-1"></i>Deck Department</p>
                    </div>
                </div>
                <i class="bi bi-bookmark-check"></i>
            </div>
        </div>
    </div>


    <script src="../js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
    function show() {
  var divide = document.getElementById("info");
  if (divide.style.display === "none") {
    divide.style.display = "block";
  } else {
    divide.style.display = "none";
  }
}
</script>