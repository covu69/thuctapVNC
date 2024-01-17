<!DOCTYPE html>
<html lang="en">

@include('client.cl_layout.cl_head')
<style>
    .text-center {
        text-align: center;
    }

    .star-ratings {
        display: flex;
        justify-content: center;
    }

    .star-ratings small {
        margin-right: 2px;
        /* Khoảng cách giữa các ngôi sao */
    }

    .text-body {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        height: 2.7em;
        line-height: 1.35em;
        white-space: normal;
    }
</style>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    @include('client.cl_layout.cl_navbar')
    <!-- Navbar End -->
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-2 text-dark mb-4 animated slideInDown">Tea Store</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item text-dark" aria-current="page">{{ trans('messages.vechungtoi') }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    <div style="display: grid; grid-template-columns: 70% 30%; margin:10px 9%; ">
        <div style="border: 1px solid #3333; padding:10px">
            {!! $page->content !!}
        </div>
        <div style="padding-left: 50px;">
            <h2>Bài viết</h2>
        </div>
    </div>
    <!-- Contact Start -->
    <div class="container-xxl contact py-5">
        <div class="container">
            <div class="section-title text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium fst-italic text-primary">Contact Us</p>
                <h1 class="display-6">Contact us right now</h1>
            </div>
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-8">
                    <p class="text-center mb-5">Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo</p>
                    <div class="row g-5">
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.3s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="fa fa-envelope fa-2x text-white"></i>
                            </div>
                            <p class="mb-2">info@example.com</p>
                            <p class="mb-0">support@example.com</p>
                        </div>
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.4s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="fa fa-phone fa-2x text-white"></i>
                            </div>
                            <p class="mb-2">+012 345 67890</p>
                            <p class="mb-0">+012 345 67890</p>
                        </div>
                        <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="0.5s">
                            <div class="btn-square mx-auto mb-3">
                                <i class="fa fa-map-marker-alt fa-2x text-white"></i>
                            </div>
                            <p class="mb-2">123 Street</p>
                            <p class="mb-0">New York, USA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Start -->


    <!-- Footer Start -->
    @include('client.cl_layout.cl_footer')
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="fw-medium" href="#">Your Site Name</a>, All Right Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Designed By <a class="fw-medium" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="fw-medium" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('cl/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('cl/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('cl/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('cl/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('cl/js/main.js')}}"></script>
</body>

</html>