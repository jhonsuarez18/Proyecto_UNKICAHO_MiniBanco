<style>
    /**
    * Define the width, height, margins and position of the watermark.
    **/
    #watermark {
        position: fixed;

        /**
            Set a position in the page for your image
            This should center it vertically
        **/
        bottom:   10cm;
        left:     5.5cm;

        /** Change image dimensions**/
        width:    8cm;
        height:   8cm;

        /** Your watermark should be behind every content**/
        z-index:  -1000;
    }
</style>
<body>
    @foreach($result as $res)
        @if($res->cEst==0)
            <div id="watermark">
                    <img style="display: block;margin: -180px 50px -200px -120px;"
                         src="https://blogger.googleusercontent.com/img/a/AVvXsEjXIp4Vlx86AMiwcfVxC0CNTzTbsMJt0f4pHYnauo4rrmG-A7bzoNFL4C5XyZrfzEYi73ZD8pX0Rc6tcH-Vj3ITH34tP5iQc_pDoDG8PoQRURb8cW2Vf03m2RdhYnpCFUb-8CBdB1u1y1hS6ib1l-ZAQcMJ6r48kvNN0QUK-4Kii1YaXOSYmI3FxZCYng=s16000"
                         alt="imagen"width="200%" height="250%"/>
            </div>
        @endif
    @endforeach
<main>
    @foreach($result as $res)
        <table style="height: 20px; width: 94.8722%; border: none; margin-left: auto; margin-right: auto;" border="0">
            <tbody>
            <tr style="height: 57px; border: none;">
                <td style="width: 20%; height: 31px;"><img style="display: block; margin-left: auto; margin-right: auto;"
                                                           src="https://hospitecnia.com/sites/default/files/styles/node_teaser/public/portada1588292056.png?itok=nI0E9VP2"
                                                           alt="imagen" width="138" height="69"/></td>
                <td style="width: 60%; text-align: center; height: 31px;">
                    <h3><strong>DIRECCION REGIONAL DE SALUD AMAZONAS - CHACHAPOYAS</strong></h3>
                </td>
                <td style="width: 10%; height: 31px;"><img style="display: block; margin-left: auto; margin-right: auto;"
                                                           src="https://pbs.twimg.com/profile_images/2184943894/diresa_400x400.jpg"
                                                           alt="" width="56" height="56"/></td>
                <td style="width: 10%; height: 31px;"><img style="display: block; margin-left: auto; margin-right: auto;"
                                                           src="https://www.geoidep.gob.pe/images/Noticias/Noticias_2017/Logo-Gobierno-Regional-de-Amazonas.jpg"
                                                           alt="" width="50" height="66"/></td>
            </tr>
            </tbody>
        </table>
        <h2 style="text-align: center; background: #3e444a">VALE PARA COMBUSTIBLE N&deg; <span
                style="color: #ff0000;background: white">{{$res->cId}}</span></h2>
        <h6><p style="text-align: justify">El vehiculo de transporte con placa de rodaje N&deg;
                <strong>{{$res->vPlaca}}</strong> perteneciente a&nbsp; <strong>{{$res->ent}}</strong> conducido por don:
                <strong>{{$res->nomb}}</strong> perteneciente a&nbsp; <strong>{{$res->entp}}</strong></p>
            <p style="text-align: justify">Esta autorizado por esta oficina para que el grifo
                <strong>{{$res->gDesc}}</strong></p>
            <p style="text-align: justify">Le proporcione con:</p>
            <p style="text-align: justify"> <strong>{{$galent}}</strong>
                @if($galdec==!"")
                    <strong> con {{$galdec}} </strong>
                @endif
                (<strong>{{$res->cCantGal}}</strong>) Glns. de <strong>{{$res->tCDesc}}</strong></p>
            <p style="text-align: justify">Autorizado por O/C N&deg; <strong>{{$res->oNumOC}}</strong> de la meta
                <strong>{{$res->mCod}}</strong> Factura N&deg; <strong>{{$res->oCNumFact}}</strong></p></h6>
        <table style="width: 100%; border-collapse: collapse; border-style: none;" border="0">
            <tbody>
            <tr style="height: 54px;">
                <td style="width: 9.94156%; text-align: left; height: 54px; vertical-align: top; ">Actividad:</td>
                <td style="width: 90.0584%; text-align: justify; height: 54px;vertical-align: top"> {{$res->cActiv}}</td>
            </tr>
            </tbody>
        </table>
        <p style="text-align: right;">Chachapoyas, <strong>{{$res->dia}}</strong> de <strong>{{$mes}}</strong> del
            <strong>{{$res->ano}}</strong></p>
        <p style="text-align: left;">&nbsp;</p>
        <p style="text-align: left;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
        <p style="text-align: left;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
        <p style="text-align: left;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Director de logistica&nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Firma
            solicitante</p>
        <p style="text-align: left;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
        <p style="text-align: left;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
        <p style="text-align: left;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
        <p style="text-align: left;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; V&deg;B&deg; Responsable Combustible&nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Firma conductor / Resp. Establecimiento</p>
    @endforeach
</main>
</body>
