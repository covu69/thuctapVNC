<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit User</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}" rel="stylesheet">

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
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{route('update',$user->id)}}"  style="padding: 3%; " method="POST" id="form_edit">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <h2>EDIT USER</h2>
                    </div>
                    <div class="form-group">
                        <label for="name">Username:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter username" name="name" value="{{$user->name}}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @endif
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" name="email" value="{{$user->email}}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @endif
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" value="{{$user->phone}}">
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Password:</label>
                        <input type="password" class="form-control" id="phone" placeholder="Enter password" name="password" >
                        <span class="form-message"></span>
                    </div>

                    <div class="form-group form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember"> I agree on blabla.
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Check this checkbox to continue.</div>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Mong muốn của chúng ta
                        Validator({
                            form: '#form_edit',
                            formGroupSelector: '.form-group',
                            errorSelector: '.form-message',
                            rules: [
                                Validator.isRequired('#name', 'Vui lòng nhập user'),
                                Validator.isEmail('#email'),
                                Validator.isRequired('#phone', 'Vui lòng nhập số điện thoại của bạn'),
                                // Validator.isPassword('#password'),
                                // Validator.isRequired('#password_confirmation'),
                                // Validator.isConfirmed('#password_confirmation', function() {
                                //     return document.querySelector('#form_add #password').value;
                                // }, 'Mật khẩu nhập lại không chính xác')
                            ],
                            // onSubmit: function(data) {
                            //   // Call API
                            //   console.log(data);
                            // }
                        });
                    });
                </script>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layout.footer')
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