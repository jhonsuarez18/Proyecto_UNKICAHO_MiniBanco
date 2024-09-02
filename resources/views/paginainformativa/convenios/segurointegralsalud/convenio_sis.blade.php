<!DOCTYPE html>

<html lang="en" class="ie8">

<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>DASCS | DIRECCION DE ASEGURAMIENTO EN SALUD Y CONVENIOS EN SALUD</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="../assets/img/diresa/Logo.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <link href="../assets/template/assets/css/e-commerce/app.min.css" rel="stylesheet"/>
    <!-- ================== END BASE JS ================== -->

</head>
<body data-spy="scroll" data-target="#header-navbar" data-offset="51" style="margin:0px;padding:0px">

<div id="page-container" class="fade">
    @include('menu')

    <div class="embed-responsive embed-responsive-4by3"  style="padding-top: 56.25%;background-color: white;" >
        <iframe  id="frame_reporte" name="frame_reporte" src="/reporte"  frameborder="0" style="overflow:hidden;height:100%;width:100%" height="110%" width="110%">

        </iframe>
    </div>


    <!-- end #footer -->

    <!-- begin theme-panel -->
@include('footer')
    <!-- end theme-panel -->
</div>
<!-- end #page-container -->

<script src="../assets/template/assets/js/e-commerce/app.min.js"></script>
</body>

</html>
