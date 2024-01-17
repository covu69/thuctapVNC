<div id="tintuc">
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="titie-section wow fadeInDown animated ">
                        <h1>{{ trans('messages.lienhe') }}</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 wow fadeInLeft animated">
                    <div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.123495472135!2d105.80185617500048!3d21.02774408781397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac9f07337671%3A0x3738d875d489a9a5!2sVINICORP%20-%20Viet%20Nhat%20General%20JSC!5e0!3m2!1svi!2s!4v1699845936595!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="left-content">
                        <h1><span>N</span>ews</h1>
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
                    <form action="{{ route('add_contact') }}" method="post" id="contact-form" class="contact-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="{{ trans('messages.hoten') }}">
                                    <span class="form-message" style="color:#fff"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    <span class="form-message" style="color:#fff"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="phone" name="phone" placeholder="{{ trans('messages.dienthoai') }}">
                                    <span class="form-message" style="color:#fff"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="{{ trans('messages.tieude') }}">
                                    <span class="form-message" style="color:#fff"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <textarea name="content" id="content" class="form-control" cols="30" rows="5" placeholder="{{ trans('messages.noidung') }}"></textarea>
                                    <span class="form-message" style="color:#fff"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 15px;">
                            <div class="col-md-12">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                                <span class="form-message" style="color:#fff"></span>>
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
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Validator({
                                form: '#contact-form',
                                formGroupSelector: '.input-group',
                                errorSelector: '.form-message',
                                rules: [
                                    // Validator.isRecaptchaFilled( 'Vui lòng xác nhận reCAPTCHA'),
                                    Validator.isRequired('#name', 'Vui lòng nhập họ tên'),
                                    Validator.isRequired('#title', 'Vui lòng nhập tiêu đề'),
                                    Validator.isRequired('#content', 'Vui lòng không để trống'),
                                    Validator.isEmail('#email', 'Vui lòng nhập email hợp lệ'),
                                    Validator.isRequired('#phone', 'Vui lòng nhập số điện thoại của bạn'),
                                ],
                                // onSubmit: function(data) {
                                //   // Gọi API
                                //   console.log(data);
                                // }
                            });
                        });
                    </script>



                </div>
            </div>
        </div>
    </section>
</div>