<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form style="padding: 10%;" action="" method="post" id="myForm">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Địa chỉ Email</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Nhập địa chỉ Email">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Đánh dấu tôi</label>
    </div>
    <button type="submit" name="action" value="token" class="btn btn-primary">Token</button>
    <button type="submit" name="action" value="random_password" class="btn btn-primary">Mật khẩu Ngẫu nhiên</button>
</form>

<script>
    document.addEventListener('click', function(e) {
        if (e.target && e.target.name == 'action') {
            var action = e.target.value;
            if (action === 'token') {
                document.getElementById('myForm').action = "{{route('guimk')}}";
            } else if (action === 'random_password') {
                document.getElementById('myForm').action = "{{route('mk_rand')}}";
            }
        }
    });
</script>


</body>

</html>