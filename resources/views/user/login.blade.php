<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} | Log in</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte3/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte3/dist/css/adminlte.min.css')}}">

    <style>
        .login-box {
            position: relative;
        }
    
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset("images/medicalrs.png") }}');
            background-size:30%;
            background-repeat: no-repeat;
            background-position: right center;
            /* background-position: right center; */
            /* opacity: 0.5; */
        }
    
        .right-image {
            float: right;
            margin-top: 20px;
            margin-right: 20px;
        }
    </style>
    
</head>

<body class="hold-transition login-page background-image">
    <div class="login-logo">
        <img src="{{ asset('images/logoahp.png') }}" height="100" />
        <h5 style="margin-top: 10px;">Sistem Pendukung Keputusan Penjadwalan Hemodialisis RSU Adhyaksa</h5>
    </div>
    
    {{-- <div class="background-image"></div> <!-- Tambahkan div untuk background image --> --}}
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan masuk ke akun Anda!</p>
                {{ show_error($errors) }}
                <form action="{{ route('login.action') }}" method="post">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>

                        <div class="col-6">
                            <button id="checkjadwal" type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#myModal">Cek Jadwal</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Cek Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="nama_norm">Nama/No Rm:</label>
                            <input type="text" class="form-control" id="nama_norm" placeholder="ketik disini...">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="tampiljadwal" type="button" class="btn btn-primary">Tampilkan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('adminlte3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte3/dist/js/adminlte.min.js') }}"></script>
    <script type="text/javascript">
        $('.form-control').attr('autocomplete', 'off');
    </script>
    <script>
        $('#tampiljadwal').on('click',function(){
            alert('coming soon')
        })
    </script>
</body>

</html>