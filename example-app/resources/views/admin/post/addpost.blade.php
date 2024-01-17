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
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/addusers.js') }}"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script src="https://example.com/ckfinder/ckfinder.js"></script>
    <style>
                    .ck-editor__editable[role="textbox"] {
                /* editing area */
                min-height: 200px;
            }
    </style> -->
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
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif -->
                <section class="vh-70" style="background-color: #eee;">
                    <div class="container h-80">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col-lg-12 col-xl-11">
                                <div class="card text-black" style="border-radius: 20px;">
                                    <div class="card-body p-md-5">
                                        <div class="row justify-content-center">
                                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Thêm bài viết</p>

                                                <form action="{{route('save_addpost')}}" method="POST" class="was-validated" id="form-add-post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="text" name="user_id" value="{{Auth::user()->id}}" hidden>
                                                    <!-- title input -->
                                                    <div class="form-group">
                                                        <label class="form-label" for="form6Example3">Tiêu đề bài viết</label>
                                                        <input type="text" id="title" name="title" class="form-control" />

                                                        <span class="form-message"></span>
                                                    </div>

                                                    <!-- thumbnail input -->
                                                    <div class="form-group">
                                                        <label class="form-label" for="form6Example4">Hình ảnh </label>
                                                        <input type="file" id="thumbnail" name="thumbnail" class="form-control" />

                                                        <span class="form-message"></span>
                                                    </div>

                                                    <!-- public input -->
                                                    <label for="dateTimePicker">Chọn ngày và giờ:</label>
                                                    <input type="datetime-local" id="dateTimePicker" name="public_at" min="<?php echo date('Y-m-d\TH:i'); ?>">


                                                    <!-- Content input -->
                                                    <div class="form-group ">
                                                        <textarea class="form-control" id="ckeditor" name="content" rows="5"></textarea>
                                                        <label class="form-label" for="form6Example7">Nội dung</label>
                                                        <span class="form-message"></span>
                                                    </div>

                                                    <div class="form-check-inline">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="banner" class="form-check-input" value="1">Nổi bật
                                                        </label>
                                                    </div>

                                                    <!-- Checkbox -->
                                                    <div class="form-check d-flex justify-content-center mb-4">
                                                        <input class="form-check-input me-2" type="checkbox" value="" id="form6Example8" checked />
                                                        <label class="form-check-label" for="form6Example8"> Create? </label>
                                                    </div>

                                                    <!-- Submit button -->
                                                    <button class="form-submit" style="outline: none;background-color: #1dbfaf;margin-top: 12px;padding: 12px 16px;font-weight: 600;color: #fff;border: none;width: 100%;font-size: 14px;border-radius: 8px;cursor: pointer;">
                                                        Thực hiện
                                                    </button>
                                                </form>
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        // Mong muốn của chúng ta
                                                        Validator({
                                                            form: '#form-add-post',
                                                            formGroupSelector: '.form-group',
                                                            errorSelector: '.form-message',
                                                            rules: [
                                                                Validator.isRequired('#title', 'Vui lòng nhập tiêu đề bài viết'),
                                                                Validator.isRequired('#thumbnail', 'Vui chọn đường dẫn ảnh'),
                                                            ],
                                                            // onSubmit: function(data) {
                                                            //   // Call API
                                                            //   console.log(data);
                                                            // }
                                                        });
                                                    });
                                                </script>


                                            </div>
                                            <!-- <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                                <img src="../public/img/iron.jpg" class="img-fluid" alt="Sample image">

                                            </div> -->
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

    <!-- date -->
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy trường nhập ngày
            var datePicker = document.getElementById("datePicker");

            // Lấy ngày hiện tại
            var today = new Date().toISOString().split('T')[0];

            // Đặt thuộc tính min cho trường nhập ngày
            datePicker.setAttribute("min", today);
        });
    </script> -->
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <!-- ckeditor -->
    <!-- validate  -->


    <script src="{{ asset('plugin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('plugin/ckfinder/ckfinder.js') }}"></script>
    <script>
        createCkeditor('ckeditor');

        function createCkeditor(name) {
            CKEDITOR.replace(name, {
                filebrowserBrowseUrl: "{{ asset('plugin/ckfinder/ckfinder.html') }}",
                filebrowserImageBrowseUrl: "{{ asset('plugin/ckfinder/ckfinder.html?type=Images') }}",
                filebrowserFlashBrowseUrl: "{{ asset('plugin/ckfinder/ckfinder.html?type=Flash') }}",
                filebrowserUploadUrl: "{{ asset('plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
                filebrowserImageUploadUrl: "{{ asset('plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
                filebrowserFlashUploadUrl: "{{ asset('plugin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
            });
        }
    </script>
    @section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'), {
                ckfinder: {
                    uploadUrl: "{{route('ck_upload',['_token'=>csrf_token()])}}",
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    @endsection


</body>

</html>