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
    <script src="../resources/js/addusers.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script src="https://example.com/ckfinder/ckfinder.js"></script>
    <style>
        /* .ck-editor__editable[role="textbox"] {
            
            min-height: 200px;
        } */
        .readonly-input {
            background-color: #f0f0f0;
            /* Màu nền xám để chỉ ra trường input chỉ đọc */
            border: 1px solid #ccc;
            /* Viền xám xung quanh trường input */
            color: #333;
            /* Màu chữ */
        }

        .contact-form {
            padding: 50px;
            margin: 30px 0;
        }

        .contact-form h1 {
            color: #19bc9d;
            font-weight: bold;
            margin: 0 0 15px;
        }

        .contact-form .form-control,
        .contact-form .btn {
            min-height: 38px;
            border-radius: 2px;
        }

        .contact-form .form-control:focus {
            border-color: #19bc9d;
        }

        .contact-form .btn-primary,
        .contact-form .btn-primary:active {
            color: #fff;
            min-width: 150px;
            font-size: 16px;
            background: #19bc9d !important;
            border: none;
        }

        .contact-form .btn-primary:hover {
            background: #15a487 !important;
        }

        .contact-form .btn i {
            margin-right: 5px;
        }

        .contact-form label {
            opacity: 0.7;
        }

        .contact-form textarea {
            resize: vertical;
        }

        .hint-text {
            font-size: 15px;
            padding-bottom: 20px;
            opacity: 0.6;
        }

        label {
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            margin: 5px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        label:hover {
            background-color: #ddd;
            /* Màu nền thay đổi khi di chuột qua label */
        }
    </style>

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
                <!-- @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif -->
                <div class="container-lg">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <div class="contact-form">
                                <h1>Thông tin bài viết</h1>
                                <p class="hint-text"></p>
                                <form action="/examples/actions/confirmation.php" method="post">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputName">Name</label>
                                                <input type="text" class="form-control" readonly class="readonly-input" id="name" value="{{$contact->name}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="inputPhone">Email</label>
                                                <input type="text" readonly class="readonly-input" name="email" value="{{$contact->email}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputPhone">Phone</label>
                                            <input type="text" readonly class="readonly-input" name="phone" value="{{$contact->phone}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputPhone">Title</label>
                                            <input type="text" readonly class="readonly-input" name="phone" value="{{$contact->title}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="inputMessage">Content</label>
                                            <textarea name="content" readonly id="content" class="form-control" cols="30" rows="5">{{$contact->content}}</textarea>
                                        </div>
                                    </div>

                                    <a href="{{route('contact')}}" style="padding: 2%;"><i style="font-size:24px" class="fa">&#xf122;</i></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


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
    <!-- <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script> -->


</body>

</html>