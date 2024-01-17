<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            min-width: 1000px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 15px;
            background: #435d7d;
            color: #fff;
            padding: 16px 30px;
            min-width: 100%;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a,
        .pagination li.active a.page-link {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }

        /* Custom checkbox */
        .custom-checkbox {
            position: relative;
        }

        .custom-checkbox input[type="checkbox"] {
            opacity: 0;
            position: absolute;
            margin: 5px 0 0 3px;
            z-index: 9;
        }

        .custom-checkbox label:before {
            width: 18px;
            height: 18px;
        }

        .custom-checkbox label:before {
            content: '';
            margin-right: 10px;
            display: inline-block;
            vertical-align: text-top;
            background: white;
            border: 1px solid #bbb;
            border-radius: 2px;
            box-sizing: border-box;
            z-index: 2;
        }

        .custom-checkbox input[type="checkbox"]:checked+label:after {
            content: '';
            position: absolute;
            left: 6px;
            top: 3px;
            width: 6px;
            height: 11px;
            border: solid #000;
            border-width: 0 3px 3px 0;
            transform: inherit;
            z-index: 3;
            transform: rotateZ(45deg);
        }

        .custom-checkbox input[type="checkbox"]:checked+label:before {
            border-color: #03A9F4;
            background: #03A9F4;
        }

        .custom-checkbox input[type="checkbox"]:checked+label:after {
            border-color: #fff;
        }

        .custom-checkbox input[type="checkbox"]:disabled+label:before {
            color: #b8b8b8;
            cursor: auto;
            box-shadow: none;
            background: #ddd;
        }

        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
            font-size: 14px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }
    </style>
    <script>
        $(document).ready(function() {
            // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function() {
                if (this.checked) {
                    checkbox.each(function() {
                        this.checked = true;
                    });
                } else {
                    checkbox.each(function() {
                        this.checked = false;
                    });
                }
            });
            checkbox.click(function() {
                if (!this.checked) {
                    $("#selectAll").prop("checked", false);
                }
            });
        });
    </script>
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
                <div class="container-xl">
                    <div class="form-group">
                        <form action="{{route('search_post')}}" method="get">
                            <div class="input-group">
                                <input class="form-control" name="search" placeholder="Search.......">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>

                    <div class="form-group" style="float:right">
                        <label for="itemsPerPage">Hiển thị số lượng kết quả:</label>
                        <select class="form-select" id="itemsPerPage" style="width : 100% ;" name="itemsPerPage" onchange="updateItemsPerPage()">
                            <option value="5" {{ $itemsPerPage==5 ? 'selected' : '' }}>5</option>
                            <option value="10" {{ $itemsPerPage==10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ $itemsPerPage==20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ $itemsPerPage==50 ? 'selected' : '' }}>50</option>
                        </select>
                    </div>


                    <div class="table-responsive">

                        <form action="{{route('deleteSelectd_post')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <!-- <div class="table-wrapper"> -->
                            <div class="table-title" style="padding: 20px;margin: 15px 0;">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h2>Manage admin <b>Info</b></h2>
                                    </div>
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-danger"><i class="material-icons">&#xE15C;</i> <span>Delete</span></button>
                                        <a href="{{route('add_info')}}" class="btn btn-success"> <span>Add Post</span></a>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->

                            <table class="table table-striped table-hover" id="myTable">

                                <thead>
                                    <tr>
                                        <th>
                                            <span class="custom-checkbox">
                                                <input type="checkbox" id="selectAll">
                                                <label for="selectAll"></label>
                                            </span>
                                        </th>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($info as $in)
                                    <tr>
                                        <td>
                                            <span class="custom-checkbox">
                                                <input type="checkbox" id="checkbox1" name="ids[{{$in->id}}]" value="{{$in->id}}">
                                                <label for="checkbox1"></label>
                                            </span>
                                        </td>
                                        <td>{{$in->id}}</td>
                                        <td>{{$in->title}}</td>
                                        <td>
                                            <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; height: 2.7em; line-height: 1.35em; white-space: normal;">
                                                {!! $in->content !!}
                                            </div>
                                        </td>
                                        <td>{{$in->type}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('show_info',$in->id)}}" style="padding: 2%;"><i style="font-size:24px" class="fa">&#xf06e;</i></a>
                                                <a href="{{route('edit_info',$in->id)}}" style="padding: 2%;"><i class="fa fa-pencil"></i></a>
                                                <a href="{{route('destroy_info',$in->id)}}" onclick="return confirm('Bạn có chắc muốn xóa bài viết này không?')"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            <!-- <button type="submit" value="delete">Delete the selected user</button> -->
                        </form>

                        <div>
                            {{$info->links()}}
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
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script>
        function updateItemsPerPage() {
            var itemsPerPage = document.getElementById("itemsPerPage").value;
            var currentUrl = window.location.href;

            // Sử dụng URLSearchParams để thay đổi tham số itemsPerPage trong URL
            var searchParams = new URLSearchParams(window.location.search);
            searchParams.set("itemsPerPage", itemsPerPage);
            var newUrl = currentUrl.split('?')[0] + '?' + searchParams.toString();
            window.location.href = newUrl;
        }
    </script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
    <script>
        // Hàm cập nhật văn bản nút và lưu giá trị vào local storage
        function updateButtonText(selectedLanguage) {
            var button = document.getElementById('dropdownMenuButton');

            // Cập nhật văn bản của button
            button.innerText = 'Article language: ' + selectedLanguage;

            // Lưu giá trị vào local storage
            localStorage.setItem('selectedLanguage', selectedLanguage);
        }

        // Hàm khôi phục giá trị từ local storage khi trang được tải lại
        $(document).ready(function() {
            var selectedLanguage = localStorage.getItem('selectedLanguage');
            if (selectedLanguage) {
                updateButtonText(selectedLanguage);
            }
        });
    </script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</body>

</html>