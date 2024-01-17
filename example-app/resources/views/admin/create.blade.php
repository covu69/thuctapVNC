@extends('admin.layout')
@section('content')
@if(Session::has('success'))
<div class="alert alert-success">
  {{ Session::get('success') }}
  @php
  Session::forget('success');
  @endphp
</div>
@endif
<!-- Way 1: Display All Error Messages -->
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
<section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form action="{{route('register')}}" method="POST" class="was-validated" id="form_create">
                @csrf
                <h3 class="heading">Thành viên đăng ký ❤️</h3>

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

              <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="{{route('login')}}" class="fw-bold text-body"><u>Login here</u></a></p>

              </form>
              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  // Mong muốn của chúng ta
                  Validator({
                    form: '#form_create',
                    formGroupSelector: '.form-group',
                    errorSelector: '.form-message',
                    rules: [
                      Validator.isRequired('#name', 'Vui lòng nhập user'),
                      Validator.isEmail('#email'),
                      Validator.isRequired('#phone', 'Vui lòng nhập số điện thoại của bạn'),
                      Validator.isPassword('#password'),
                      Validator.isRequired('#password_confirmation'),
                      Validator.isConfirmed('#password_confirmation', function() {
                        return document.querySelector('#form_create #password').value;
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
          </div>
        </div>
      </div>
    </div>
  </div>
</section>