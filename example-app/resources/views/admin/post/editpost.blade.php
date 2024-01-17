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
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
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
                @if(session('success'))
                <div class="alert alert-success" id="alert-message">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger" id="alert-message">
                    {{ session('error') }}
                </div>
                @endif

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="margin-left: 35px">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">VI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">EN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-contact-tab" href="{{route('post')}}" role="tab" aria-controls="pills-contact" aria-selected="false">Back</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <!-- bài viết tiếng việt -->
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <form action="{{route('update_post',$post_vi->id)}}" style="padding: 3%; " method="POST" id="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <h2>EDIT POSTS</h2>
                            </div>
                            <div class="form-group">
                                <label for="name">Title:</label>
                                <input type="text" class="form-control " id="name" placeholder="Enter username" name="title" value="{{$post_vi->title}}" required>
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail:</label>
                                <input type="file" class="form-control " id="Thumbnail" placeholder="Enter Thumbnail" name="thumbnail" value="{{$post_vi->thumbnail}}">
                                @if(isset($post_vi->thumbnail))
                                <img src="{{asset('upload/post/'.$post_vi->thumbnail)}}" width="100px" height="100px" alt="">
                                @endif
                                <span class="form-message"></span>
                            </div>
                            <!-- public input -->
                            <label for="dateTimePicker">Chọn ngày và giờ:</label>
                            <input type="datetime-local" id="dateTimePicker" name="public_at" min="<?php echo date('Y-m-d\TH:i', strtotime($post_vi->public_at)); ?>" value="{{$post_vi->public_at}}">

                            <div class="form-outline mb-4">
                                <textarea class="form-control" id="ckeditor" name="content" rows="5" value="">{!! $post_vi->content !!}</textarea>
                                <label class="form-label" for="form6Example7">Nội dung</label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" name="banner" class="form-check-input" {{ $post_vi->banner == 1 ? 'checked' : '' }}>Nổi bật
                                </label>
                            </div>
                            <div class="form-group form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember" required> I agree on blabla.
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Check this checkbox to continue.</div>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <!-- kết thúc -->
                    <!-- bài viết en -->
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        @if(isset($post_en))
                        <form action="{{route('save_en',$post_en->id)}}" style="padding: 3%; " method="POST" id="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <h2>EDIT POSTS</h2>
                            </div>
                            <div class="form-group">
                                <label for="name">Title:</label>
                                <input type="text" class="form-control " id="name" placeholder="Enter username" name="title" value="{{$post_en->title}}" required>
                                <span class="form-message"></span>
                            </div>
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail:</label>
                                <input type="file" class="form-control " id="Thumbnail" placeholder="Enter Thumbnail" name="thumbnail" value="{{$post_en->thumbnail}}">
                                @if(isset($post_en->thumbnail))
                                <img src="{{asset('upload/post/'.$post_en->thumbnail)}}" width="100px" height="100px" alt="">
                                @endif
                                <span class="form-message"></span>
                            </div>

                            <!-- public input -->
                            <label for="dateTimePicker">Chọn ngày và giờ:</label>
                            <input type="datetime-local" id="dateTimePicker" name="public_at" min="<?php echo date('Y-m-d\TH:i', strtotime($post_en->public_at)); ?>" value="{{$post_en->public_at}}">

                            <div class="form-outline mb-4">
                                <textarea class="form-control" id="ckeditor_en" name="content" rows="5" value="">{!! $post_en->content !!}</textarea>
                                <label class="form-label" for="form6Example7">Nội dung</label>
                            </div>
                            <div class="form-group form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="remember" required> I agree on blabla.
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Check this checkbox to continue.</div>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        @else
                        <form action="{{route('add_en')}}" style="padding: 3%; " method="POST" id="" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h2>EDIT POSTS</h2>
                            </div>
                            <input type="text" name="posts_id" value="{{$id}}" hidden>
                            <div class="form-group">
                                <label class="form-label" for="form6Example3">Tiêu đề bài viết</label>
                                <input type="text" id="title" name="title" class="form-control" require>
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
                                <textarea class="form-control" id="ckeditor_en" name="content" rows="5"></textarea>
                                <label class="form-label" for="form6Example7">Nội dung</label>
                                <span class="form-message"></span>
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
                            @endif
                    </div>
                    <!-- kết thúc -->
                    <!-- <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div> -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mong muốn của chúng ta
            Validator({
                form: '#form-add-post',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isRequired('#title', 'Vui lòng nhập tiêu đề bài viết'),
                ],
                // onSubmit: function(data) {
                //   // Call API
                //   console.log(data);
                // }
            });
        });
    </script>
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
    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor_en'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        if (document.getElementById('alert-message')) {
            setTimeout(function() {
                document.getElementById('alert-message').style.display = 'none';
            }, 5000);
        }
    </script>

</body>

</html>