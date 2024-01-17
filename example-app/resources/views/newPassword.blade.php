<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi mật khẩu mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/addusers.js')}}"></script>
</head>

<body>
    <form style="padding: 10%;" action="{{route('reset_Password')}}" id="form_resetps" method="post">
        @csrf
        <input type="text" hidden value="{{$token}}" name="token">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="password">
            <span class="form-message"></span>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Confirmation password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="password_confirmation">
            <span class="form-message"></span>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mong muốn của chúng ta
            Validator({
                form: '#form_resetps',
                formGroupSelector: '.form-group',
                errorSelector: '.form-message',
                rules: [
                    Validator.isEmail('#email'),
                    Validator.isPassword('#password'),
                    Validator.isRequired('#password_confirmation'),
                    Validator.isConfirmed('#password_confirmation', function() {
                        return document.querySelector('#form_resetps #password').value;
                    }, 'Mật khẩu nhập lại không chính xác')
                ],
                // onSubmit: function(data) {
                //   // Call API
                //   console.log(data);
                // }
            });
        });
    </script>
</html>