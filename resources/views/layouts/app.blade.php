<!DOCTYPE html>
<html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>UNKICAHO | Pagina de ingreso</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="google-site-verification" content="vj4lm9Al8aeYki-nfv913mILfpiRWnH-tEsNvvUAPyE" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="google-site-verification" content="HH0iU8qAF5GYD7pL1eXeoVOtntu7YCwfGAIRIVooJN8" />
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../assets/css/default/app.min.css" rel="stylesheet" />
    <!-- ================== END BASE CSS STYLE ================== -->
</head>
<body class="pace-top">
<!-- begin #page-loader -->
<div id="page-loader" class="fade show"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade">
    <!-- begin login -->
    <div class="login login-v1">
        <!-- begin login-container -->
        <div class="login-container">
            <!-- begin login-header -->
            <div class="login-header">
                <div class="brand">
                    <img  height="40px" width="40px" src="../assets/img/UNKICAHO/cafe.png"></span> <b>UNKICAHO</b> INTRANET
                     <small> MINI BANCO</small>
                </div>
                <div class="align-content-center">
                    <a href="/" title="Click para regresar al incio">
                        <img  height="150px" width="150px" src="../assets/img/UNKICAHO/LOGO_UNKICAHO.png">
                    </a>
                </div>
            </div>
            <!-- end login-header -->
            <!-- begin login-body -->
            <div class="login-body">
                <!-- begin login-content -->
                <div class="login-content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group m-b-20">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Correo Electronico"
                            >
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>Correo electronico no valido.</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group m-b-20">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"
                            placeholder="Contraseña"
                            >

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>Contraseñas no valida.</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="login-buttons">
                            <button type="submit" class="btn  btn-block btn-lg"  style="background:#93b738">Ingresar</button>
                        </div>
                    </form>
                </div>
                <!-- end login-content -->
            </div>
            <!-- end login-body -->
        </div>
        <!-- end login-container -->
    </div>
    <!-- end login -->


</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="../assets/js/app.min.js"></script>
<script src="../assets/js/theme/default.min.js"></script>
<!-- ================== END BASE JS ================== -->
</body>
</html>
