<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @include('layouts.header')
</head>

<body>
    <div class="wrapper" style="margin: 0 auto; width: 35%; top: 200px;">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="text-center card-title">Đăng nhập</h3>
            </div>
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <!-- /.card-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST" action="{{ route('check.login') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email"
                                value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password"
                                name="password" value="">
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="col-8 pl-5">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">
                            Ghi nhớ tôi
                        </label>
                    </div>
                </div>
                <div class="text-center card-footer">
                    <button type="submit" class="btn btn-info">Đăng nhập</button>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
    </div>

</body>

</html>
