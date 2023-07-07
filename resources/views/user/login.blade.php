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

    <footer style="margin-top: 10px;">
        <p>SPK HD | 2023</p>
    </footer>
    <!-- /.login-box -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Jadwal Pasien</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <form> --}}
                        <div class="form-group">
                            <label for="nama_norm">Cek Disini :</label>
                            <input type="number" class="form-control" id="typenik" placeholder="Ketik NIK...">
                        </div>
                    {{-- </form> --}}
                    <div id="resultjadwal"></div>
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
            var nik = $('#typenik').val();
            // alert(nik)
            $.ajax({
                url: '/getjadwalbynik',
                type: 'POST',
                data: {
                    // your data object
                    nik
                },
                success: function(response) {
                    // Success callback function
                    // console.log('Success:', response.jadwal);
                    // Perform actions based on the success response

                    // Assuming you have the JSON response stored in a variable called 'response'

// Assuming you have the JSON response stored in a variable called 'response'

// Assuming you have the JSON response stored in a variable called 'response'

// Parse the JSON response
var data = response;

// Create a formatted string to display the schedule information
// var scheduleInfo = "<h2>Jadwal:</h2>";
// scheduleInfo += "<p><strong>Kode Alternatif:</strong> " + data.jadwal.kode_alternatif + "</p>";
var scheduleInfo = "<p><strong>NIK:</strong> " + data.jadwal.nik + "</p>";
scheduleInfo += "<p><strong>Nama:</strong> " + data.jadwal.nama_alternatif + "</p>";
scheduleInfo += "<p><strong>Tempat Lahir:</strong> " + data.jadwal.tempat_lahir + "</p>";
scheduleInfo += "<p><strong>Telepon:</strong> " + data.jadwal.telepon + "</p>";
scheduleInfo += "<p><strong>Alamat:</strong> " + data.jadwal.alamat + "</p>";
scheduleInfo += "<p><strong>Tanggal Lahir:</strong> " + data.jadwal.tgl_lahir + "</p>";
scheduleInfo += "<p><strong>Tanggal Daftar:</strong> " + data.jadwal.tgl_daftar + "</p>";
// scheduleInfo += "<p><strong>Keterangan:</strong> " + data.jadwal.keterangan + "</p>";
// scheduleInfo += "<p><strong>Total:</strong> " + data.jadwal.total + "</p>";
// scheduleInfo += "<p><strong>Rank:</strong> " + data.jadwal.rank + "</p>";
scheduleInfo += "<p><strong>Jenis Tindakan:</strong> " + data.jadwal.jenis_tindakan + "</p>";

// Create a list of the "hari" data
scheduleInfo += "<h3>Jadwal Harian:</h3>";
scheduleInfo += "<ul>";
var days = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu"];
days.forEach(function(day) {
  if (data.jadwal[day] && data.jadwal[day].length > 0) {
    scheduleInfo += "<li><strong>" + day + ":</strong>";
    scheduleInfo += "<ul>";
    data.jadwal[day].forEach(function(shiftData) {
      Object.keys(shiftData).forEach(function(shift) {
        var value = shiftData[shift];
        var checkmarkSymbol = (value === 1) ? "<span class='checkmark'>&#10004;</span>" : "";
        scheduleInfo += "<li>" + shift + ": " + checkmarkSymbol + "</li>";
      });
    });
    scheduleInfo += "</ul>";
    scheduleInfo += "</li>";
  }
});
scheduleInfo += "</ul>";

// Display the formatted schedule information in the 'resultjadwal' div
$('#resultjadwal').html(scheduleInfo);



                },
                error: function(xhr, status, error) {
                    // Error callback function
                    console.log('Error:', error);
                    // Handle the error response
                }
            });

        })
    </script>
</body>

</html>