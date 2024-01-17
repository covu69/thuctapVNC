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

        .custom-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            font-size: 10px;
            transition: background-color 0.3s;
        }

        .custom-button:hover {
            background-color: #2980b9;
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
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                    @if (session('errorRows'))
                    <ul>
                        @foreach (session('errorRows') as $errorRow)
                        <li>{{ json_encode($errorRow) }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <!-- Begin Page Content -->
                <div class="container-xl">
                    <div class="form-group">
                        <form action="{{route('search_user')}}" method="get" id="get-form">
                            <div class="input-group">
                                <input class="form-control" name="search" id="search-field" placeholder="Search......." @if(isset($data)){ value="{{$data}}" } @endif>
                                <button type="submit" class="btn btn-primary" id="search-button" value="">Search</button>
                            </div>
                        </form>
                    </div>
                    <div style="
                    display:grid;
                    grid-template-columns: 1fr 1fr;
                    ">
                        <div class="form-group" style="float:right">
                            <label for="itemsPerPage">Select list:</label>
                            <select class="form-select" id="itemsPerPage" style="width : 100% ;" name="itemsPerPage" onchange="updateItemsPerPage()">
                                <option value="10" {{ $itemsPerPage==10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ $itemsPerPage==20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ $itemsPerPage==50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ $itemsPerPage==100 ? 'selected' : '' }}>100</option>
                            </select>
                        </div>
                        <div style="display:grid;grid-template-columns: 1fr 1fr;">
                            <div>
                                <form action="{{ route('import-excel') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="excel_file">
                                    <button type="submit" class="custom-button">Tải lên</button>
                                </form>
                            </div>   
                            <div>
                                <div>
                                    <form action="{{route('exportDataToExcel')}}" id="excel-form" method="post">
                                        @csrf
                                        <input type="text" name="search" id="search-field-excel" value="{{ request('search') }}" hidden>
                                        <button style="font-size:12px" class="custom-button">Xuất Excel<i class="fa fa-file-excel-o"></i></button>
                                    </form>
                                </div>
                                <form action="{{route('export_checkbox')}}" id="form_ex_cb" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @foreach($users as $user)
                                    <input type="checkbox" hidden name="selectedIds[{{$user->id}}]" value="{{$user->id}}" data-user-id="{{$user->id}}">
                                    @endforeach
                                    <button id="btn-excheckbox" style="font-size:12px" class="custom-button">Xuất Excel theo Checkbox<i class="fa fa-file-excel-o"></i></button>
                                </form>
                                <div>

                                </div>


                            </div>


                        </div>
                    </div>

                    <div class="table-responsive">

                        <form action="{{route('deleteSelectd')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="table-wrapper">
                                <div class="table-title" >
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h2>Manage <b>User</b></h2>
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="{{route('useradd')}}" class="btn btn-success"> <span>Add New User</span></a>
                                            <button type="submit" class="btn btn-danger"><i class="material-icons">&#xE15C;</i> <span>Delete</span></button>
                                        </div>




                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped table-hover" id="myTable">

                                <thead>
                                    <tr>
                                        <th>
                                            <span class="custom-checkbox">
                                                <input type="checkbox" id="selectAll">
                                                <label for="selectAll"></label>
                                            </span>
                                        </th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Role</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <span class="custom-checkbox">
                                                <input type="checkbox" name="ids[{{$user->id}}]" value="{{$user->id}}" data-user-id="{{$user->id}}">
                                                <label for="checkbox1"></label>
                                            </span>
                                        </td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>{{$user->updated_at}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{route('edit',$user->id)}}" style="padding: 2%;"><i class="fa fa-pencil"></i></a>
                                                <!-- <form action="{{route('destroy',$user->id)}}" method="post" type="button">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger m-0" style="padding: 2%"><i class="fa fa-trash"></i></button>
                                                </form> -->
                                                <a href="{{ route('destroy', ['id' => $user->id]) }}" onclick="return confirm('Bạn có chắc muốn xóa bài viết này không?')"><i class="fa fa-trash"></i></a>
                                            </div>


                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <!-- <button type="submit" value="delete">Delete the selected user</button> -->
                        </form>

                        <div>
                            {{$users->links()}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Modal HTML -->
            <div id="addEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h4 class="modal-title">Add Employee</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-success" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Modal HTML -->
            <div id="editEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Employee</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-info" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Delete Modal HTML -->
            <div id="deleteEmployeeModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form>
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Employee</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete these Records?</p>
                                <p class="text-warning"><small>This action cannot be undone.</small></p>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
    <!-- phân trang -->
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

    <!-- end -->
    <!-- search -->
    <script>
        document.getElementById('search-button').addEventListener('click', function() {
            var searchValue = document.getElementById('search-field').value;
            document.getElementById('search-field-excel').value = searchValue;
            document.getElementById('excel-form').submit();
        });
    </script>
    <!-- end search -->

    <!-- ex checkbox -->

    <!-- <script>
    document.getElementById("btn-excheckbox").addEventListener("click", function() {
        var selectedCheckboxes = document.querySelectorAll('input[type="checkbox"][name^="ids"]:checked');
        var form_ex_cb = document.getElementById('form_ex_cb');
        
        // Lưu trạng thái ban đầu của biểu mẫu (form)
        var originalFormHTML = form_ex_cb.innerHTML;

        // Xóa các trường input ẩn đã thêm trước đó
        var existingHiddenInputs = form_ex_cb.querySelectorAll('input[type="hidden"]');
        existingHiddenInputs.forEach(input => {
            form_ex_cb.removeChild(input);
        });

        // Thêm các trường input ẩn mới
        selectedCheckboxes.forEach(selectedCheckbox => {
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = selectedCheckbox.name;
            hiddenInput.value = selectedCheckbox.value;
            form_ex_cb.appendChild(hiddenInput);
        });

        // Sau khi đã hoàn thành xử lý, xóa dữ liệu đã thêm trước đó
        setTimeout(function() {
            form_ex_cb.innerHTML = originalFormHTML;
        }, 5000); // Số mili giây trước khi xóa (ví dụ: 5000ms = 5 giây)
    });
</script> -->
    <script>
        // Lấy tất cả checkbox ẩn và checkbox hiển thị
        const hiddenCheckboxes = document.querySelectorAll("input[type='checkbox'][name^='selectedIds']");
        const visibleCheckboxes = document.querySelectorAll("input[type='checkbox'][name^='ids']");
        // Lắng nghe sự kiện "change" cho các checkbox hiển thị
        visibleCheckboxes.forEach(visibleCheckbox => {
            visibleCheckbox.addEventListener("change", function() {
                // Lấy giá trị của thuộc tính data-user-id
                const userId = this.getAttribute("data-user-id");
                // Tìm checkbox ẩn tương ứng dựa trên data-user-id và cập nhật trạng thái
                const hiddenCheckbox = document.querySelector(`input[type='checkbox'][name^='selectedIds'][data-user-id='${userId}']`);
                if (hiddenCheckbox) {
                    hiddenCheckbox.checked = this.checked;
                }
            });
        });
    </script>

    <!-- end -->
    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>

</body>

</html>