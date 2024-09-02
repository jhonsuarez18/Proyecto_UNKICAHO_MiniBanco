@php
    try{
     $usuario= Auth::user()->name;
     $roll=Session::get('rol');
    }catch (Exception $e)
    {
     $usuario= null;
    }
@endphp
@if($usuario!==null)
    <div class="modal fade" id="modal-dialog-perfil">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Actualizar perfil</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                    <div class="row justify-content-center">
                        <form role="form" method="POST" action="{{route('subir')}}" accept-charset="UTF-8"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-12 row ">
                                <input id="id" name="id" type="text" value="{{ Auth::user()->id }}" hidden>
                                <div class="form-group col-md-6">
                                    Nombre de cuenta
                                    <input id="nombre" name="nombre" class="form-control " type="text"
                                           autocomplete="off"
                                           value="{{ Auth::user()->name }}" required
                                    />
                                </div>
                                <div class="form-group col-md-6">
                                    Email <input id="email" type="email" name="email" class="form-control"
                                                 placeholder="Enter email"
                                                 autocomplete="off" value="{{ Auth::user()->email }}" required/>
                                </div>
                                <div class="col-md-6 form-group">
                                    Imagen de perfil
                                    <input id="archivo" type="file" name="archivo" accept=".png,.jpg"
                                    />
                                </div>
                            </div>
                            <hr style="color: #0056b2;"/>

                            <div class="col-md-12 row">
                                <div class="form-group col-md-12 text-center">
                                    CONTRASEÑA:cambiar si lo concidera necesario
                                </div>

                                <div class="form-group col-md-6">
                                    Nueva contraseña
                                    <input id="contra1" class="form-control " name="contra1" type="password"
                                           autocomplete="off"/>
                                </div>

                            </div>
                            <div class="col-xl-12 text-center">
                                <a href="javascript:" class="btn btn-danger" data-dismiss="modal">

                                    Cerrar</a>
                                <button name="enviar" id="enviar" class="btn btn-success" type="submit">
                                    Editar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<div id="footer" class="footer">
    <!-- BEGIN container -->
    <div class="container">
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-3 -->
            <div class="col-lg-3">
                <h4 class="footer-header">ACERCA DE NOSOTROS</h4>
                <p>
                    EL SIS tiene como misión administrar los fondos destinados al financiamiento de las prestaciones de
                    salud individual, de conformidad con la Política del Sector.
                </p>
                <p class="mb-lg-4 mb-0">

                </p>
            </div>
            <!-- END col-3 -->
            <!-- BEGIN col-3 -->
            <div class="col-lg-3">
                <h4 class="footer-header">LINKS RELACIONADOS</h4>
                <ul class="fa-ul mb-lg-4 mb-0">
                    <li><i class="fa fa-li fa-angle-right"></i> <a
                            href="http://www.regionamazonas.gob.pe/sisadport/portal/index.html#/home">Gobierno
                            regional</a></li>
                </ul>
            </div>
            <!-- END col-3 -->

            <!-- BEGIN col-3 -->
            <div class="col-lg-3">
                <h4 class="footer-header">CONTACTENOS</h4>
                <address class="mb-lg-4 mb-0">
                    <strong>DIRECCION</strong><br/>
                    AVENIDA CHACHAPOYAS N° 3035<br/>
                    BAGUA GRANDE - UTCUBAMBA - AMAZONAS<br/><br/>
                </address>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1670.1015620362077!2d-77.86669926673424!3d-6.231332661741647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2spe!4v1556142951364!5m2!1ses-419!2spe"
                    width="200" height="200" frameborder="1" style="border:1px" allowfullscreen></iframe>
            </div>
            <!-- END col-3 -->
        </div>
        <!-- END row -->
    </div>
    <!-- END container -->
</div>
<div id="footer-copyright" class="footer-copyright">
    <div class="container text-center">
        <div class="footer-brand">
            <div>
                <img src="../assets/img/diresa/Logo.png" alt="logo" width="50px" height="60px">
            </div>
            <titu>DISTRIBUIDORA ORTIZ</titu>
        </div>
        <p>
            &copy; Copyright Distribuidora de Gas Ortiz<br/>
            Creado por <a href="#">Br.,en ingenieria de Sistemas, Suarez Ortiz Jhon.</a>
        </p>
    </div>
</div>
<div class="theme-panel">
    <a href="javascript:" data-click="theme-panel-expand" class="theme-collapse-btn">
        <i class="fa fa-cog">

        </i></a>
    <div class="theme-panel-content">
        <ul class="theme-list clearfix">
            <ul class="theme-list clearfix">
                <li><a href="javascript:" class="bg-red" data-theme="red"
                       data-theme-file="../assets/template/assets/css/e-commerce/theme/red.min.css"
                       data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                       data-title="Red" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:" class="bg-pink" data-theme="pink"
                       data-theme-file="../assets/template/assets/css/e-commerce/theme/pink.min.css"
                       data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                       data-title="Pink" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:" class="bg-orange" data-theme="orange"
                       data-theme-file="../assets/template/assets/css/e-commerce/theme/orange.min.css"
                       data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                       data-title="Orange" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:" class="bg-yellow" data-theme="yellow"
                       data-theme-file="../assets/template/assets/css/e-commerce/theme/yellow.min.css"
                       data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                       data-title="Yellow" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:" class="bg-lime" data-theme="lime"
                       data-theme-file="../assets/template/assets/css/e-commerce/theme/lime.min.css"
                       data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                       data-title="Lime" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:" class="bg-green" data-theme="green"
                       data-theme-file="../assets/template/assets/css/e-commerce/theme/green.min.css"
                       data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                       data-title="Green" data-original-title="" title="">&nbsp;</a></li>
                <li class="active"><a href="javascript:" class="bg-teal" data-theme-file="" data-theme="default"
                                      data-click="theme-selector" data-toggle="tooltip" data-trigger="hover"
                                      data-container="body" data-title="Default" data-original-title=""
                                      title="">&nbsp;</a></li>
                <li><a href="javascript:" class="bg-aqua" data-theme="aqua"
                       data-theme-file="../assets/template/assets/css/e-commerce/theme/aqua.min.css"
                       data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                       data-title="Aqua" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:" class="bg-blue" data-theme="blue"
                       data-theme-file="../assets/template/assets/css/e-commerce/theme/blue.min.css"
                       data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                       data-title="Blue" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:" class="bg-purple" data-theme="purple"
                       data-theme-file="../assets/template/assets/css/e-commerce/theme/purple.min.css"
                       data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                       data-title="Purple" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:" class="bg-indigo" data-theme="indigo"
                       data-theme-file="../assets/template/assets/css/e-commerce/theme/indigo.min.css"
                       data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                       data-title="Indigo" data-original-title="" title="">&nbsp;</a></li>
                <li><a href="javascript:" class="bg-black" data-theme="black"
                       data-theme-file="../assets/template/assets/css/e-commerce/theme/black.min.css"
                       data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body"
                       data-title="Black" data-original-title="" title="">&nbsp;</a></li>
            </ul>
        </ul>
    </div>
</div>
