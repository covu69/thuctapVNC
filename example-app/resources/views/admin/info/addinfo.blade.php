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
                <div style="padding: 20px;">
                    <form action="{{route('save_info')}}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Type</label>
                                <input type="number" class="form-control" id="type" name="type" placeholder="Type">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Content</label>
                            <textarea class="form-control" id="ckeditor" name="content" rows="5"></textarea>
                        </div>

                </div>
                <button type="submit" class="btn btn-primary" style="margin-left: 20px;">Thực hiện</button>
                </form>
            </div>

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