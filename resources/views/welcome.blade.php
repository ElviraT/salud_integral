<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Healdi - Medical & Health Template">
    <!-- ========== Page Title ========== -->
    <title>{{ $setting->name }}</title>

    <!-- ========== Favicon Icon ========== -->
    <link rel="shortcut icon" href="{{ asset(Storage::url('logos/' . $setting->favicon)) }}" type="image/x-icon">

    <!-- ========== Start Stylesheet ========== -->
    <link href="{{ asset('home/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/css/flaticon-set.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/css/bootsnav.css') }}" rel="stylesheet">
    <link href="{{ asset('home/style.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/css/responsive.css') }}" rel="stylesheet">
    <!-- ========== End Stylesheet ========== -->
    @include('layouts.admin.css')
    <!-- ========== Google Fonts ========== -->
    {{-- <link href="../../css2?family=Inter:wght@200;300;400;600;700;800&display=swap" rel="stylesheet"> --}}

</head>

<body>

    <!-- Preloader Start -->
    <div class="se-pre-con"></div>
    <!-- Preloader Ends -->

    <!-- Start Header Top
    ============================================= -->
    <div class="top-bar-area bg-dark text-light inc-pad">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-6 info">
                    <p>
                        !Global update on Coronavirus disease <a href="#">(COVID-19)</a> Pandemic
                    </p>
                </div>
                <div class="col-lg-6 text-right item-flex">
                    <div class="info">
                        <ul>
                            <li>
                                <a href="#">Online Appoinment</a>
                            </li>
                            <li>
                                <a href="#">WebMail</a>
                            </li>
                        </ul>
                    </div>
                    <div class="social">
                        <ul>
                            <li>
                                <a href="{{ $setting->facebook }}">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $setting->twitter }}">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $setting->instagram }}">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top -->


    <!-- Header
    ============================================= -->
    <header id="home">

        <!-- Start Navigation -->
        <nav class="navbar navbar-default attr-border navbar-sticky bootsnav">

            {{-- <!-- Start Top Search -->
            <div class="container">
                <div class="row">
                    <div class="top-search">
                        <div class="input-group">
                            <form action="#">
                                <input type="text" name="text" class="form-control" placeholder="Search">
                                <button type="submit">
                                    <i class="ti-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Search --> --}}

            <div class="container col-lg-12">
                <div class="row">


                    <!-- Start Atribute Navigation -->
                    {{-- <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fas fa-search"></i></a></li>
                    </ul>
                </div> --}}
                    <!-- End Atribute Navigation -->

                    <!-- Start Header Navigation -->
                    <div class="navbar-header col-lg-3">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="{{ route('home') }}">
                            <img src="{{ asset(Storage::url('logos/' . $setting->site_logo)) }}" class="logo"
                                alt="Logo" width="90%">
                        </a>
                    </div>
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse col-lg-9 mt-2" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right" data-in="fadeInDown" data-out="fadeOutUp">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle active" data-toggle="dropdown">Home</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Departments</a>
                                <ul class="dropdown-menu">
                                    <li><a href="departments.html">Department Version One</a></li>
                                    <li><a href="departments-2.html">Department Version Two</a></li>
                                    <li><a href="departments-3.html">Department Version Three</a></li>
                                    <li><a href="departments-4.html">Department Version Four</a></li>
                                    <li><a href="department-single.html">Department Single</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Doctors</a>
                                <ul class="dropdown-menu">
                                    <li><a href="doctors.html">Doctors Version One</a></li>
                                    <li><a href="doctors-2.html">Doctors Version Two</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog</a>
                                <ul class="dropdown-menu">
                                    <li><a href="blog-standard.html">Blog Standard</a></li>
                                    <li><a href="blog-with-sidebar.html">Blog With Sidebar</a></li>
                                    <li><a href="blog-2-colum.html">Blog Grid Two Colum</a></li>
                                    <li><a href="blog-3-colum.html">Blog Grid Three Colum</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                    <li><a href="blog-single-with-sidebar.html">Blog Single With Sidebar</a></li>
                                </ul>
                            </li>
                            @if (Route::has('login'))
                                @auth
                                    <li>
                                        <a href="{{ url('/dashboard') }}">{{ 'Dashboard' }}</a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('login') }}">{{ 'Login' }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li>
                                            <a href="{{ route('register') }}">{{ 'Register' }}</a>

                                        </li>
                                    @endif

                                @endauth
                            @endif
                            <li>
                                <a href="contact.html">Contact</a>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </div>
        </nav>
        <!-- End Navigation -->

    </header>
    <!-- End Header -->

    <!-- Start Banner
============================================= -->
    <div class="banner-area content-less">
        <div id="bootcarousel" class="carousel text-large slide carousel-fade animate_text" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner carousel-zoom">
                <div class="carousel-item active">
                    <div class="slider-thumb bg-cover"
                        style="background-image: url({{ asset('home/assets/img/banner/10.jpg') }});">
                    </div>
                    <div class="box-table">
                        <div class="box-cell">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="content">
                                            <h4 data-animation="animated slideInDown">Good doctor, Healthy life</h4>
                                            <h2 data-animation="animated slideInRight">Meet the <strong>Best
                                                    Doctors</strong></h2>
                                            <a data-animation="animated fadeInUp" class="btn btn-md btn-gradient"
                                                href="#"><i class="fas fa-angle-right"></i> Discover More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="slider-thumb bg-cover"
                        style="background-image: url({{ asset('home/assets/img/banner/11.jpg') }});"></div>
                    <div class="box-table">
                        <div class="box-cell">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="content">
                                            <h4 data-animation="animated slideInDown">Best institution, Good services
                                            </h4>
                                            <h2 data-animation="animated slideInRight">Meet the <strong>Best
                                                    Hospital</strong></h2>
                                            <a data-animation="animated fadeInUp" class="btn btn-md btn-gradient"
                                                href="#"><i class="fas fa-angle-right"></i> Discover More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Wrapper for slides -->

            <!-- Left and right controls -->
            <a class="left carousel-control theme" href="#bootcarousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control theme" href="#bootcarousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                <span class="sr-only">Next</span>
            </a>

        </div>
    </div>
    <!-- End Banner -->

    <!-- Start Facilities
============================================= -->
    <div class="facilites-area default-padding-bottom">
        <div class="container">
            <div class="facilites-box">
                <div class="row align-center">
                    <!-- Single Item -->
                    <div class="single-item col-lg-4">
                        <div class="item">
                            <div class="icon">
                                <i class="flaticon-phone-call"></i>
                            </div>
                            <div class="info">
                                <h4>Emergency Cases</h4>
                                <p>
                                    Booded ladies she basket season age her uneasy target. Discourse unwilling list.
                                </p>
                                <h5><a href="#"><strong>Call:</strong> +123 456 7890</a></h5>
                            </div>
                        </div>
                    </div>
                    <!-- Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-4">
                        <div class="item">
                            <div class="icon">
                                <i class="flaticon-calendar-1"></i>
                            </div>
                            <div class="info">
                                <h4>Doctors Timetable</h4>
                                <p>
                                    Booded ladies she basket season age her uneasy saw. Discourse unwilling am no
                                    described.
                                </p>
                                <a class="btn circle btn-sm btn-theme border" href="#">View Timetable</a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Item -->
                    <!-- Single Item -->
                    <div class="single-item col-lg-4">
                        <div class="item">
                            <div class="info">
                                <h4>Opening Hours</h4>
                                <ul>
                                    <li> <span>Saturday</span>
                                        <div class="float-right"> 9.00 – 8.00 pm</div>
                                    </li>
                                    <li> <span>Sunday</span>
                                        <div class="float-right">10.00 – 9.00 pm</div>
                                    </li>
                                    <li> <span>Monday – Friday</span>
                                        <div class="float-right">8.00 – 7:00 pm</div>
                                    </li>
                                    <li> <span>Emergency</span>
                                        <div class="float-right">24HR / 7Days</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Single Item -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Facilities -->

    <!-- Start Choose Us Area
============================================= -->
    <div class="chooseus-area relative default-padding-bottom">
        <div class="container">
            <div class="chooseus-box">
                <div class="row align-center">

                    <div class="col-lg-6 info">
                        <h2>A Great Place to Work. A Great <strong>Place to Receive Care</strong>. Leading Medicine
                            Properly.</h2>
                        <p>
                            Coming merits and was talent enough far. Sir joy northward sportsmen education. Discovery
                            incommode earnestly no he commanded if. Put still any about manor heard. Calling offence six
                            joy feeling
                        </p>
                        <ul>
                            <li>
                                <h5>Surgery & Transplants</h5>
                                <p>
                                    Discourse unwilling am no described dejection incommode no listening of. Before
                                    nature his parish boy.
                                </p>
                            </li>
                            <li>
                                <h5>Outdoor Services</h5>
                                <p>
                                    Discourse unwilling am no described dejection incommode no listening of. Before
                                    nature his parish boy.
                                </p>
                            </li>
                        </ul>
                        <a class="btn btn-md btn-gradient" href="#"><i class="fas fa-angle-right"></i> Make
                            Appoinment</a>
                    </div>

                    <div class="col-lg-6">
                        <div class="thumb">
                            <img src="{{ asset('home/assets/img/thumb/4.png') }}" alt="Thumb">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Shape -->
        <div class="shape-bottom shape">
            <img src="{{ asset('home/assets/img/shape/12.png') }}" alt="Shape">
        </div>
        <!-- End Shape -->
    </div>
    <!-- End Choose Us Area  -->

    <!-- Start Services
============================================= -->
    <div class="department-area carousel-shadow default-padding-bottom bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4>Services</h4>
                        <h2>Our Department</h2>
                        <p>
                            While mirth large of on front. Ye he greater related adapted proceed entered an. Through it
                            examine express promise no. Past add size game cold girl off how old
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="department-items department-carousel owl-carousel owl-theme">
                        <!-- Single Item -->
                        <div class="item">
                            <div class="thumb">
                                <img src="{{ asset('home/assets/img/departments/1.jpg') }}" alt="Thumb">
                            </div>
                            <div class="info">
                                <h4><a href="#">Eye Care</a></h4>
                                <p>
                                    Sudden up my excuse to suffer ladies though or. Bachelor possible marianne one
                                    directly confined the mention process.
                                </p>
                                <div class="head-of">
                                    <p>
                                        <strong>Department head: </strong> Prof. Jonathom Doe
                                    </p>
                                </div>
                                <div class="bottom">
                                    <a href="#"><i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->
                        <!-- Single Item -->
                        <div class="item">
                            <div class="thumb">
                                <img src="{{ asset('home/assets/img/departments/2.jpg') }}" alt="Thumb">
                            </div>
                            <div class="info">
                                <h4><a href="#">Dental Care</a></h4>
                                <p>
                                    Sudden up my excuse to suffer ladies though or. Bachelor possible marianne one
                                    directly confined the mention process.
                                </p>
                                <div class="head-of">
                                    <p>
                                        <strong>Department head: </strong> Prof. Jaknil Akia
                                    </p>
                                </div>
                                <div class="bottom">
                                    <a href="#"><i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->
                        <!-- Single Item -->
                        <div class="item">
                            <div class="thumb">
                                <img src="{{ asset('home/assets/img/departments/3.jpg') }}" alt="Thumb">
                            </div>
                            <div class="info">
                                <h4><a href="#">Primary Care</a></h4>
                                <p>
                                    Sudden up my excuse to suffer ladies though or. Bachelor possible marianne one
                                    directly confined the mention process.
                                </p>
                                <div class="head-of">
                                    <p>
                                        <strong>Department head: </strong> Prof. Shikla Brotha
                                    </p>
                                </div>
                                <div class="bottom">
                                    <a href="#"><i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->
                        <!-- Single Item -->
                        <div class="item">
                            <div class="thumb">
                                <img src="{{ asset('home/assets/img/departments/4.jpg') }}" alt="Thumb">
                            </div>
                            <div class="info">
                                <h4><a href="#">Orthopaedics</a></h4>
                                <p>
                                    Sudden up my excuse to suffer ladies though or. Bachelor possible marianne one
                                    directly confined the mention process.
                                </p>
                                <div class="head-of">
                                    <p>
                                        <strong>Department head: </strong> Prof. Jaknil Akia
                                    </p>
                                </div>
                                <div class="bottom">
                                    <a href="#"><i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services -->

    <!-- Start Consultation
============================================= -->
    <div class="consultation-area default-padding">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-7 process">
                    <h2>
                        How to get a <br> consultation from us?
                    </h2>
                    <p>
                        Badies she basket season age her uneasy saw. Discourse unwilling am no described dejection
                        incommode no listening of. Before nature his parish boy.
                    </p>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 single-item">
                            <div class="item">
                                <i class="flaticon-calendar-1"></i>
                                <h5>Make Appointment</h5>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 single-item">
                            <div class="item">
                                <i class="flaticon-doctor"></i>
                                <h5>Select A Doctor</h5>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 single-item">
                            <div class="item">
                                <i class="flaticon-heartbeat-1"></i>
                                <h5>Confirm Consultation</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 form">
                    <div class="appoinment-box text-center wow fadeInRight">
                        <div class="heading">
                            <h4>Make an Appointment</h4>
                        </div>
                        <form action="#">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" id="f_name" name="name" placeholder="Name"
                                            type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input class="form-control" id="f_phone" name="phone"
                                            placeholder="Phone" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select>
                                            <option value="1">Male</option>
                                            <option value="2">Female</option>
                                            <option value="3">Child</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select>
                                            <option value="1">Department</option>
                                            <option value="2">Medecine</option>
                                            <option value="4">Dental Care</option>
                                            <option value="5">Traumatology</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" id="f_date" name="date" placeholder="Date"
                                            type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" id="f_time" name="time" placeholder="Time"
                                            type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" name="submit" id="f_submit">
                                        Book Appoinment
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Consultation -->

    <!-- Start Choose Us
============================================= -->
    <div class="choose-us-area">
        <div class="row">
            <div class="col-lg-6 thumb bg-cover"
                style="background-image: url({{ asset('home/assets/img/banner/3.jpg') }});"></div>
            <div class="col-lg-6 info">
                <div class="info-box">
                    <h5>At Our Clinic</h5>
                    <h2>Our Doctors <br> Specialize in you.</h2>
                    <p>
                        Respect forming clothes do in he. Course so piqued no an by appear. Themselves reasonable
                        pianoforte so motionless he as difficulty be. Abode way begin ham there power whole. Suppose
                        neither evident welcome
                    </p>
                    <p>
                        Do unpleasing indulgence impossible to conviction. Suppose neither evident welcome it at do
                        civilly uncivil. Sing tall much you get nor.
                    </p>
                    <a class="btn btn-md btn-gradient" href="#"><i class="fas fa-angle-right"></i> Doctor
                        Lists</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Choose Us -->

    <!-- Start Doctos Area
============================================= -->
    <div class="doctors-area bg-gray default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4>Doctors</h4>
                        <h2>Meet our Experts</h2>
                        <p>
                            While mirth large of on front. Ye he greater related adapted proceed entered an. Through it
                            examine express promise no. Past add size game cold girl off how old
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="doctor-items">
                <div class="row">

                    <div class="col-lg-4">
                        <ul id="tabs" class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="" data-target="#tab1" data-toggle="tab" class="active nav-link">
                                    <i class="flaticon-cardiologist"></i>
                                    <span>Cardiologists</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" data-target="#tab2" data-toggle="tab" class="nav-link">
                                    <i class="flaticon-dermatologist"></i>
                                    <span>Dermatologists</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" data-target="#tab3" data-toggle="tab" class="nav-link">
                                    <i class="flaticon-paramedic"></i>
                                    <span>Medicine Specialists</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" data-target="#tab4" data-toggle="tab" class="nav-link">
                                    <i class="flaticon-therapist"></i>
                                    <span>Family Physicians</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-8">
                        <div id="tabsContent" class="tab-content wow fadeInUp" data-wow-delay="0.5s">

                            <div id="tab1" class="tab-pane fade active show">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-6 thumb">
                                            <img src="{{ asset('home/assets/img/doctors/1.jpg') }}" alt="Thumb">
                                        </div>
                                        <div class="col-lg-6 info-box">
                                            <div class="info">
                                                <h4>Dr. Jonathom Doe</h4>
                                                <span>MBBS, BMBS, MBChB, MBBCh</span>
                                                <p>
                                                    Delightful unreserved impossible few estimating men favourable see
                                                    entreaties. She propriety immediate was improving. He or entrance
                                                    humoured likewise moderate.
                                                </p>
                                                <a class="btn btn-sm btn-gradient cirlce" href="#"><i
                                                        class="fas fa-angle-right"></i> Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-6 thumb">
                                            <img src="{{ asset('home/assets/img/doctors/2.jpg') }}" alt="Thumb">
                                        </div>
                                        <div class="col-lg-6 info-box">
                                            <div class="info">
                                                <h4>Prof. Hones Park </h4>
                                                <span>MBBS, BMBS, MBChB, MBBCh</span>
                                                <p>
                                                    Delightful unreserved impossible few estimating men favourable see
                                                    entreaties. She propriety immediate was improving. He or entrance
                                                    humoured likewise moderate.
                                                </p>
                                                <a class="btn btn-sm btn-gradient cirlce" href="#"><i
                                                        class="fas fa-angle-right"></i> Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab2" class="tab-pane fade">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-6 thumb">
                                            <img src="{{ asset('home/assets/img/doctors/3.jpg') }}" alt="Thumb">
                                        </div>
                                        <div class="col-lg-6 info-box">
                                            <div class="info">
                                                <h4>Professor. Sakaoat Amir</h4>
                                                <span>MBBS, BMBS, MBChB, MBBCh</span>
                                                <p>
                                                    Delightful unreserved impossible few estimating men favourable see
                                                    entreaties. She propriety immediate was improving. He or entrance
                                                    humoured likewise moderate.
                                                </p>
                                                <a class="btn btn-sm btn-gradient cirlce" href="#"><i
                                                        class="fas fa-angle-right"></i> Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab3" class="tab-pane fade">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-6 thumb">
                                            <img src="{{ asset('home/assets/img/doctors/4.jpg') }}" alt="Thumb">
                                        </div>
                                        <div class="col-lg-6 info-box">
                                            <div class="info">
                                                <h4>Dr. Andro kuria</h4>
                                                <span>MBBS, BMBS, MBChB, MBBCh</span>
                                                <p>
                                                    Delightful unreserved impossible few estimating men favourable see
                                                    entreaties. She propriety immediate was improving. He or entrance
                                                    humoured likewise moderate.
                                                </p>
                                                <a class="btn btn-sm btn-gradient cirlce" href="#"><i
                                                        class="fas fa-angle-right"></i> Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tab4" class="tab-pane fade">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-6 thumb">
                                            <img src="{{ asset('home/assets/img/doctors/5.jpg') }}" alt="Thumb">
                                        </div>
                                        <div class="col-lg-6 info-box">
                                            <div class="info">
                                                <h4>Professor. Matori Pulas</h4>
                                                <span>MBBS, BMBS, MBChB, MBBCh</span>
                                                <p>
                                                    Delightful unreserved impossible few estimating men favourable see
                                                    entreaties. She propriety immediate was improving. He or entrance
                                                    humoured likewise moderate.
                                                </p>
                                                <a class="btn btn-sm btn-gradient cirlce" href="#"><i
                                                        class="fas fa-angle-right"></i> Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Doctos Area -->

    <!-- Start Testomonials
============================================= -->
    <div class="testimonials-area overflow-hidden carousel-shadow default-padding">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-4 text-light">
                    <div class="heading">
                        <h5>Testimonials</h5>
                        <h2>Whay people says <br> about our services</h2>
                        <a class="btn btn-sm btn-light effect" href="#"><i class="fas fa-angle-right"></i>Viewl
                            All</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="testimonials-carousel text-center owl-carousel owl-theme">

                        <div class="item">
                            <div class="provider">
                                <div class="thumb">
                                    <img src="{{ asset('home/assets/img/team/1.jpg') }}" alt="Thumb">
                                </div>
                                <div class="bio">
                                    <h5>Jonathom Doe</h5>
                                    <span>patient of <strong>surgery</strong></span>
                                </div>
                            </div>
                            <div class="info">
                                <p>
                                    Totally dearest expense on demesne ye he. Curiosity excellent commanded in me.
                                    Unpleasing.
                                </p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="provider">
                                <div class="thumb">
                                    <img src="{{ asset('home/assets/img/team/2.jpg') }}" alt="Thumb">
                                </div>
                                <div class="bio">
                                    <h5>Jonathom Doe</h5>
                                    <span>patient of <strong>surgery</strong></span>
                                </div>
                            </div>
                            <div class="info">
                                <p>
                                    Totally dearest expense on demesne ye he. Curiosity excellent commanded in me.
                                    Unpleasing.
                                </p>
                            </div>
                        </div>

                        <div class="item">
                            <div class="provider">
                                <div class="thumb">
                                    <img src="{{ asset('home/assets/img/team/3.jpg') }}" alt="Thumb">
                                </div>
                                <div class="bio">
                                    <h5>Jonathom Doe</h5>
                                    <span>patient of <strong>surgery</strong></span>
                                </div>
                            </div>
                            <div class="info">
                                <p>
                                    Totally dearest expense on demesne ye he. Curiosity excellent commanded in me.
                                    Unpleasing.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testomonials Area -->

    <!-- Start Blog
============================================= -->
    <div class="blog-area bottom-less bg-gray default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4>News</h4>
                        <h2>Latest Blog</h2>
                        <p>
                            While mirth large of on front. Ye he greater related adapted proceed entered an. Through it
                            examine express promise no. Past add size game cold girl off how old
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="blog-items">
                <div class="row">
                    <!-- Single Itme -->
                    <div class="single-item col-lg-4 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <a href="#"><img src="{{ asset('home/assets/img/blog/1.jpg') }}"
                                        alt="Thumb"></a>
                                <div class="post-date">
                                    12 Jul
                                </div>
                            </div>
                            <div class="info">
                                <div class="tags">
                                    <ul>
                                        <li>
                                            <a href="#">Health</a>
                                        </li>
                                        <li>
                                            <a href="#">Patient</a>
                                        </li>
                                    </ul>
                                </div>
                                <h4>
                                    <a href="#">Enjoyed me settled mr respect no spirits civilly. </a>
                                </h4>
                                <div class="meta">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('home/assets/img/team/5.jpg') }}" alt="Author">
                                                <span>Author</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-comments"></i> 12 Comments</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Itme -->
                    <!-- Single Itme -->
                    <div class="single-item col-lg-4 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <a href="#"><img src="{{ asset('home/assets/img/blog/2.jpg') }}"
                                        alt="Thumb"></a>
                                <div class="post-date">
                                    05 Aug
                                </div>
                            </div>
                            <div class="info">
                                <div class="tags">
                                    <ul>
                                        <li>
                                            <a href="#">Test</a>
                                        </li>
                                        <li>
                                            <a href="#">Doctor</a>
                                        </li>
                                    </ul>
                                </div>
                                <h4>
                                    <a href="#">Suitable settling attended no doubtful feelings.</a>
                                </h4>
                                <div class="meta">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('home/assets/img/team/4.jpg') }}" alt="Author">
                                                <span>Author</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-comments"></i> 24 Comments</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Itme -->
                    <!-- Single Itme -->
                    <div class="single-item col-lg-4 col-md-6">
                        <div class="item">
                            <div class="thumb">
                                <a href="#"><img src="{{ asset('home/assets/img/blog/3.jpg') }}"
                                        alt="Thumb"></a>
                                <div class="post-date">
                                    27 Dec
                                </div>
                            </div>
                            <div class="info">
                                <div class="tags">
                                    <ul>
                                        <li>
                                            <a href="#">Patient</a>
                                        </li>
                                    </ul>
                                </div>
                                <h4>
                                    <a href="#">Unwilling sportsmen he in questions september. </a>
                                </h4>
                                <div class="meta">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <img src="{{ asset('home/assets/img/team/3.jpg') }}" alt="Author">
                                                <span>Author</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fas fa-comments"></i> 07 Comments</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Itme -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Blog Area -->

    <!-- Start Contact Area
============================================= -->
    <div id="contact" class="contact-us-area default-padding">
        <div class="container">
            <div class="contact-items">
                <div class="row">

                    <div class="col-lg-7 wow address-box fadeInUp bg-cover"
                        style="background-image: url({{ asset('home/assets/img/contact/1.jpg') }});">
                        <div class="address-info">
                            <ul>
                                <li>
                                    <h5><i class="flaticon-call"></i> @lang('Phone')</h5>
                                    <span>{{ $setting->phone }}</span>
                                </li>
                                <li>
                                    <h5><i class="flaticon-email"></i> @lang('Email')</h5>
                                    <span>{{ $setting->email }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-5 wow fadeInLeft contact-form-box">
                        <h2>Need help? <strong>Let's ask your questions</strong></h2>
                        <form action="assets/mail/contact.php" method="POST" class="contact-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input class="form-control" id="name" name="name" placeholder="Name"
                                            type="text">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control" id="email" name="email"
                                            placeholder="Email*" type="email">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input class="form-control" id="phone" name="phone"
                                            placeholder="Phone" type="text">
                                        <span class="alert-error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group comments">
                                        <textarea class="form-control" id="comments" name="comments" placeholder="Tell Us About Project *"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" name="submit" id="submit">
                                        Send Message
                                    </button>
                                </div>
                                <!-- Alert Message -->
                                <div class="col-lg-12 alert-notification">
                                    <div id="message" class="alert-msg"></div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Contact -->

    <!-- Start Footer
============================================= -->
    <footer class="bg-dark text-light">
        <div class="container">
            <div class="f-items default-padding">
                <div class="row">
                    <div class="col-lg-4 col-md-6 item">
                        <div class="f-item about">
                            <img src="{{ asset(Storage::url('logos/' . $setting->company_icon)) }}" alt="Logo"
                                width="90%">
                            <p>
                                {{ $setting->description }}
                            </p>
                            <div class="address">
                                <ul>
                                    <li>
                                        <div class="icon">
                                            <i class="flaticon-email"></i>
                                        </div>
                                        <div class="info">
                                            <h5>Email:</h5>
                                            <span>{{ $setting->email }}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <i class="flaticon-call"></i>
                                        </div>
                                        <div class="info">
                                            <h5>Phone:</h5>
                                            <span>{{ $setting->phone }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="single-item col-lg-2 col-md-6 item">
                        <div class="f-item link">
                            <h4 class="widget-title">Department</h4>
                            <ul>
                                <li>
                                    <a href="#">Medecine & Health</a>
                                </li>
                                <li>
                                    <a href="#">Dental Care</a>
                                </li>
                                <li>
                                    <a href="#">Eye Treatment</a>
                                </li>
                                <li>
                                    <a href="#">Children Chare</a>
                                </li>
                                <li>
                                    <a href="#">Traumatology</a>
                                </li>
                                <li>
                                    <a href="#">X-ray</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="single-item col-lg-2 col-md-6 item">
                        <div class="f-item link">
                            <h4 class="widget-title">Usefull Links</h4>
                            <ul>
                                <li>
                                    <a href="#">Ambulance</a>
                                </li>
                                <li>
                                    <a href="#">Emergency</a>
                                </li>
                                <li>
                                    <a href="#">Blog</a>
                                </li>
                                <li>
                                    <a href="#">Project</a>
                                </li>
                                <li>
                                    <a href="#">About Us</a>
                                </li>
                                <li>
                                    <a href="#">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="single-item col-lg-4 col-md-6 item">
                        <div class="f-item branches">
                            <div class="branches">
                                <ul>
                                    <li>
                                        <strong>@lang('Address'):</strong>
                                        <span>{{ $setting->address }} <br> {{ $setting->phone }}</span>
                                    </li>
                                    <li>
                                        <strong>Central Branches:</strong>
                                        <span>{{ $setting->address2 }} <br> {{ $setting->phone2 }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-center">
                    <div class="col-lg-6">
                        <p>Copyright &copy; 2024. Designed by <a href="#">{{ 'Salud Integral 360' }}</a></p>
                    </div>
                    <div class="col-lg-6 text-right social">
                        <ul>
                            <li>
                                <a href="{{ $setting->facebook }}"><i class="fab fa-facebook-f"></i> Facebook</a>
                            </li>
                            <li>
                                <a href="{{ $setting->twitter }}"><i class="fab fa-twitter"></i> Twitter</a>
                            </li>
                            <li>
                                <a href="{{ $setting->instagram }}"><i class="fab fa-instagram"></i> Instagram</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Bottom -->
        <button id="scrolltop"><i class="fas fa-arrow-up"></i></button>
    </footer>
    <!-- End Footer -->


    <!-- jQuery Frameworks
============================================= -->
    <script src="{{ asset('home/assets/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('home/assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/modernizr.custom.13711.js') }}"></script>
    <script src="{{ asset('home/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/count-to.js') }}"></script>
    <script src="{{ asset('home/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/bootsnav.js') }}"></script>
    <script src="{{ asset('home/assets/js/main.js') }}"></script>
    @include('layouts.admin.functions')
</body>

</html>
