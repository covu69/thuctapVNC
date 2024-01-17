<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/addusers.js')}}"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layout.sider-bar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layout.header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <section class="vh-70" style="background-color: #eee;">
                    <div class="container h-80">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-lg-12 col-xl-11">
                                <div class="card text-black" style="border-radius: 20px;">
                                    <div class="card-body p-md-5">
                                        <div class="row justify-content-center">
                                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Add User</p>

                                                <form action="{{route('add')}}" method="POST" id="form_add" class="was-validated">
                                                    @csrf
                                                    <h3 class="heading">Thêm thành viên ❤️</h3>
                                                    <div class="spacer"></div>

                                                    <div class="form-group">
                                                        <label for="fullname" class="form-label">Tên tài khoản</label>
                                                        <input id="name" name="name" type="text" placeholder="VD: abc01" class="form-control">
                                                        <span class="form-message"></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input id="email" name="email" type="text" placeholder="VD: email@domain.com" class="form-control">
                                                        <span class="form-message"></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="phone" class="form-label">Phone</label>
                                                        <input id="phone" name="phone" type="text" placeholder="VD: 0123456789" class="form-control">
                                                        <span class="form-message"></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password" class="form-label">Mật khẩu</label>
                                                        <input id="password" name="password" type="password" placeholder="Nhập mật khẩu" class="form-control">
                                                        <span class="form-message"></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                                                        <input id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu" type="password" class="form-control">
                                                        <span class="form-message"></span>
                                                    </div>

                                                    <button class="form-submit" style="outline: none;background-color: #1dbfaf;margin-top: 12px;padding: 12px 16px;font-weight: 600;color: #fff;border: none;width: 100%;font-size: 14px;border-radius: 8px;cursor: pointer;">
                                                        Đăng ký
                                                    </button>

                                                </form>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        // Mong muốn của chúng ta
                                                        Validator({
                                                            form: '#form_add',
                                                            formGroupSelector: '.form-group',
                                                            errorSelector: '.form-message',
                                                            rules: [
                                                                Validator.isRequired('#name', 'Vui lòng nhập user'),
                                                                Validator.isEmail('#email'),
                                                                Validator.isRequired('#phone', 'Vui lòng nhập số điện thoại của bạn'),
                                                                Validator.isPassword('#password'),
                                                                Validator.isRequired('#password_confirmation'),
                                                                Validator.isConfirmed('#password_confirmation', function() {
                                                                    return document.querySelector('#form_add #password').value;
                                                                }, 'Mật khẩu nhập lại không chính xác')
                                                            ],
                                                            // onSubmit: function(data) {
                                                            //   // Call API
                                                            //   console.log(data);
                                                            // }
                                                        });
                                                    });
                                                </script>

                                            </div>
                                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                                <img src="../public/img/iron.jpg" class="img-fluid" alt="Sample image">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <!-- <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> -->

    <!-- Logout Modal-->


    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>

</body>

</html>