<!doctype html>
<html class="no-js" lang="en">
@include('client.cl_layout.cl_head')

<body>

    <!-- PRELOADER -->
    <div id="preloader">
        <div class="preloader-area">
            <div class="preloader-box">
                <div class="preloader"></div>
            </div>
        </div>
    </div>
    <!--  -->
    @include('client.cl_layout.cl_navbar')
    <!--  -->
    <section class="featured-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titie-section wow fadeInDown animated ">
                        <h1>Kết quả của tìm kiếm</h1>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="filter-menu">
                            <ul class="button-group sort-button-group">
                                <li class="button active" data-category="all">All<span>8</span></li>
                                <li class="button" data-category="cat-1">Dresses and Suits<span>2</span></li>
                                <li class="button" data-category="cat-2">Accessories<span>2</span></li>
                                <li class="button" data-category="cat-3">Miscellaneous<span>4</span></li>
                            </ul>
                        </div>
                    </div>
                </div> -->
            <div class="row featured isotope">
                @foreach($posts as $post)
                <div class="col-md-3 col-sm-6 col-xs-12 cat-3 featured-items isotope-item">
                    <div class="product-item">
                        <img src="{{asset('upload/post/'.$post->thumbnail)}}" class="img-responsive" width="" height="" alt="">
                        <div class="product-hover">
                            <div class="product-meta">
                                <a href="{{route('chitiet',$post->id)}}">Thông tin chi tiết</a>
                            </div>
                        </div>
                        <div class="product-title">
                            <a href="#">
                                <h3>{{$post->title}}</h3>
                            </a>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
            <div>
                {{$posts->links()}}
            </div>
        </div>
    </section>

    <!--  -->

    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="titie-section wow fadeInDown animated ">
                        <h1>GET IN TOUCH</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 wow fadeInLeft animated">
                    <div class="left-content">
                        <h1><span>M</span>art</h1>
                        <h3>We'd love To Meet You In Person Or Via The Web!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vel nulla sapien. Class aptent tacitiaptent taciti sociosqu ad lit himenaeos. Suspendisse massa urna, luctus ut vestibulum necs et, vulputate quis urna. Donec at commodo erat.</p>
                        <div class="contact-info">
                            <p><b>Main Office:</b> 123 Elm St. New York City, NY</p>
                            <p><b>Phone:</b> 1.555.555.5555</p>
                            <p><b>Email:</b> info@yourdomain.com</p>
                        </div>
                        <div class="social-media">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 wow fadeInRight animated">
                    <form action="" method="" class="contact-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" placeholder="Your Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" placeholder="Subject">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" placeholder="Website URL">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <textarea name="" id="" class="form-control" cols="30" rows="5" placeholder="Your Message..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="submit" class="contact-submit" value="Send" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="center">Shared by <i class="fa fa-love"></i><a href="https://bootstrapthemes.co">BootstrapThemes</a>
                    </p>

                </div>
            </div>
        </div>
    </footer>

    <!-- JQUERY -->
    <script src="{{asset('nguoidung/js/vendor/jquery-1.11.2.min.js')}}"></script>
    <script src="{{asset('nguoidung/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('nguoidung/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('nguoidung/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('nguoidung/js/wow.min.js')}}"></script>
    <script src="{{asset('nguoidung/js/custom.js')}}"></script>
</body>

</html>