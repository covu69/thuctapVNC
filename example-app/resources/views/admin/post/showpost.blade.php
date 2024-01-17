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

        .selected {
            color: red;
            /* Màu của thẻ đã chọn */
            font-weight: bold;
            /* Để làm nổi bật thêm, bạn có thể thay đổi kiểu chữ hoặc thuộc tính khác */
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
                <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-left: 35px">
                    <li class="nav-item">
                        <a class="nav-link active" id="vi-tab" data-toggle="tab" href="#vi" role="tab" aria-controls="vi" aria-selected="true">VI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="en-tab" data-toggle="tab" href="#en" role="tab" aria-controls="en" aria-selected="false">En</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" href="{{route('post')}}" role="tab" aria-controls="contact" aria-selected="false">Back</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="vi" role="tabpanel" aria-labelledby="vi-tab">
                        <div class="container-lg">
                            <div class="row" id="vi" aria-labelledby="home-tab" aria-labelledby="vi-tab">
                                <div class="col-md-10 mx-auto">
                                    <div class="contact-form">
                                        <h1>Thông tin bài viết</h1>
                                        <p class="hint-text"></p>
                                        <form action="/examples/actions/confirmation.php" method="post">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="inputName">Title</label>
                                                        <input type="text" class="form-control" readonly class="readonly-input" id="inputName" value="{{$post_vi->title}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="inputPhone">User id</label>
                                                        <input type="text" readonly class="readonly-input" name="user_id" value="{{Auth::user()->id}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="inputEmail">Thumbnail</label>
                                                    @if(isset($post_vi->thumbnail))
                                                    <img src="{{asset('upload/post/'.$post_vi->thumbnail)}}" width="100px" height="100px" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputMessage">Content</label>
                                                {!! $post_vi->content !!}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="en" role="tabpanel" aria-labelledby="en-tab">
                        <div class="container-lg">
                            <div class="row" id="vi" aria-labelledby="home-tab" aria-labelledby="vi-tab">
                                <div class="col-md-10 mx-auto">
                                    <div class="contact-form">
                                        <h1>Article information</h1>
                                        <p class="hint-text"></p>
                                        @if(isset($post_en))
                                        <form action="/examples/actions/confirmation.php" method="post">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="inputName">Title</label>
                                                        <input type="text" class="form-control" readonly class="readonly-input" id="inputName" value="{{$post_en->title}}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="inputPhone">User id</label>
                                                        <input type="text" readonly class="readonly-input" name="user_id" value="{{Auth::user()->id}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="inputEmail">Thumbnail</label>
                                                    @if(isset($post_en->thumbnail))
                                                    <img src="{{asset('upload/post/'.$post_en->thumbnail)}}" width="100px" height="100px" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputMessage">Content</label>
                                                {!! $post_en->content !!}
                                            </div>
                                        </form>
                                        @else
                                        <div>
                                            <h2>There is currently no content</h2>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div> -->
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