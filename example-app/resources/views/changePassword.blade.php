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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        /* Định dạng các trường nhập có thuộc tính readonly */
        input[readonly] {
            background-color: #f2f2f2;
            /* Màu nền xám nhạt */
            border: 1px solid #ccc;
            /* Đường viền xám */
            color: #666;
            /* Màu chữ xám */
            width: 60%;
        }

        .button-like-link {
            display: inline-block;
            padding: 10px 20px;
            /* Điều chỉnh kích thước nút theo ý muốn */
            background-color: #3498db;
            /* Màu nền của nút */
            color: #ffffff;
            /* Màu chữ trắng */
            text-decoration: none;
            /* Loại bỏ gạch chân liên kết mặc định */
            border: 1px solid #3498db;
            /* Đường viền màu tương tự */
            border-radius: 5px;
            /* Bo tròn góc */
            text-align: center;
            /* Căn giữa nội dung */
        }

        .button-like-link:hover {
            background-color: #2980b9;
            /* Màu nền khi di chuột qua */
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
                <form style="margin: 100px;" action="{{route('changePassword')}}" method="post">
                    @csrf
                    <h2>Thay đổi mật khẩu</h2>
                    <div class="mb-3">
                        <label for="password" class="form-label">Current password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" value="">
                    </div>
                    <!-- <input type="password" name="current_password" placeholder="Mật khẩu hiện tại" > -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirmation password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="">
                    </div>
                    <button type="submit">Thực hiện</button>
                </form>

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
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>