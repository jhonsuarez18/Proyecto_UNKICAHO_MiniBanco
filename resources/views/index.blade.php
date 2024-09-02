<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Distribuidora Ortiz</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta name="google-site-verification" content="vj4lm9Al8aeYki-nfv913mILfpiRWnH-tEsNvvUAPyE" />
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <link href="../assets/template/assets/css/e-commerce/app.min.css" rel="stylesheet"/>
    <script type='text/javascript'>
        $(document).ready(function(){
            $(window).scroll(function(){
                if ($(this).scrollTop() > 100) {
                    $('#scroll').fadeIn();
                } else {
                    $('#scroll').fadeOut();
                }
            });
            $('#scroll').click(function(){
                $("html, body").animate({ scrollTop: 0 }, 600);
                return false;
            });
        });
    </script>
    <!-- ================== END BASE CSS STYLE ================== -->
    <style type="text/css">
        /* BackToTop button css */
        #scroll {
            position:fixed;
            right:10px;
            bottom:10px;
            cursor:pointer;
            width:50px;
            height:50px;
            background-color:#3498db;
            text-indent:-9999px;
            display:none;
            -webkit-border-radius:60px;
            -moz-border-radius:60px;
            border-radius:60px
        }
        #scroll span {
            position:absolute;
            top:50%;
            left:50%;
            margin-left:-8px;
            margin-top:-12px;
            height:0;
            width:0;
            border:8px solid transparent;
            border-bottom-color:#ffffff
        }
        #scroll:hover {
            background-color:#e74c3c;
            opacity:1;filter:"alpha(opacity=100)";
            -ms-filter:"alpha(opacity=100)";
        }
    </style>
    <style >
        #header {
            background: #4c9141}
    </style>
    <style >
        #footer-copyright{
            background: #4c9141}
    </style>
    <style>
        .social-bar{
            pisition: fixed;
            right: 0;
            top:35%;
            font-size:1.5rem;
            display:flex;
            flex-direction: column;
            align-items:flex-end;
            z-index:100;
        }

        .icon{
            color:white;
            text-decoration:none;
            padding: .7rem;
            display:flex;
            transition: all .5s;
        }

        .icon-facebook{
            background:#2E406E;
        }
        .icon-youtube{
            background:#E83028;
        }
        .icon-instagram{
            background:#3F60A5;
            border-radius: 1rem 0 0 0;
        }

        .icon:first-child{
            border-radius: 1rem 0 0 0;
        }

        .icon:last-child{
            border-radius: 0 0 0 1rem;
        }

        .icon:hover{
            padding-right: 3rem;
            border-radius: 1rem 0 0 1rem;
            box-shadow: 0 0 .5rem rgba(0,0,0,0.42);
        }
    </style>
</head>
<body>
<!-- BEGIN #page-container -->
<div id="page-container" class="fade show">

@include('menu')
<!-- BEGIN #slider -->
    <div id="noticias" class="section-container p-0 bg-black-darker">
        <!-- BEGIN carousel -->
        <div id="main-carousel" class="carousel slide" data-ride="carousel">
            <!-- BEGIN carousel-inner -->
            <div class="col-xl-12 col-sm-12 col-xs-12 row">
                <div class="col-xl-3 col-sm-3 col-xs-3">

                </div>
                <div class="col-xl-9 col-sm-9 col-xs-9">
                    <div class="carousel-inner">
                        <!-- BEGIN item -->
                        <div class="carousel-item active" data-paroller="true" data-paroller-factor="0.3"
                             data-paroller-factor-sm="0.01" data-paroller-factor-xs="0.01"
                             style="background: url(../storage/slider/fondo/fondo_salud.png) center 0 / cover no-repeat;">
                            <div class="container">
                                <img src="../assets/img/diresa/diresa.jpg"
                                     class="product-img right bottom fadeInRight animated" alt=""/>
                            </div>
                            <div class="carousel-caption carousel-caption-left">
                                <div class="container">
                                    <p class="title m-b-5 fadeInLeftBig animated " style="
                            color: white; text-shadow: black 0.1em 0.1em 0.2em">DISTRIBUIDORA ORTIZ</p>
                                    <div class="price m-b-30 fadeInLeftBig animated">
                                        <small>DO</small>
                                    </div>
                                </div>

                            </div>
                            <!-- END item -->


                        </div>
                        <!-- END carousel-inner -->
                        <a class="carousel-control-prev" href="#main-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="carousel-control-next" href="#main-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="social-bar">
                <a href="https://web.facebook.com/Diresamazonasoficial/?ref=bookmarks" class="icon icon-facebook" target="_blank"><i class="fab fa-lg fa-fw me-10px fa-facebook"></i></a>
                <a href="https://www.youtube.com/channel/UCwKoSpzmhF780-PeFeSwdRQ" class="icon icon-youtube" target="_blank"><i class="fab fa-lg fa-fw me-10px fa-youtube"></i></a>
                <a href="https://twitter.com/Diresa_amazonas?lang=es" class="icon icon-instagram" target="_blank"><i class="fab fa-lg fa-fw me-10px fa-twitter"></i></a>
            </div>
        <!-- END carousel -->
    </div>
    <!-- END #slider -->
    <!-- end theme-panel -->
    @include('footer')
</div>
</div>
<a href="javascript:void(0);" id="scroll" title="Scroll to Top" style="display: none;">Top<span></span></a>
<!-- ================== BEGIN BASE JS ================== -->
<script src="../assets/template/assets/js/e-commerce/app.min.js"></script>
<!-- ================== END BASE JS ================== -->
</body>
</html>
