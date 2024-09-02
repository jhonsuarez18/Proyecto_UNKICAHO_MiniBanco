@foreach($result as $res)
    <table style="height: 20px; width: 100%; border: none;" border="0">
        <tbody>
        <tr style="height: 57px; border: none;">
            <td style="width: 25%; height: 40px;"><img style="display: block;text-align: right;"
                                                       src="https://1.bp.blogspot.com/-16FCBxUGHXI/YJQLS-hbYEI/AAAAAAAAACA/uoGw_Tuyxhk9F7KMk2AyFDoKIaHC7scawCLcBGAsYHQ/s461/images.jpeg"
                                                       alt="" width="170" height="50"/></td>
            <td style="width: 25%; height: 50px;" align="right"><img style="display: block;text-align: right;"
                                                       src="http://190.119.171.164/docs/portal/entidad/2/logo_grande.png"
                                                       alt="" width="40" height="50"/></td>
        </tr>
        <tr style="height: 57px; border: none;">
            <td style="width: 100%; height: 40px;text-align: center" colspan="2">
                <h4 style="font-size: 12px"><strong>AÑO DEL BICENTENARIO DEL PERU: 200 AÑOS DE INDEPENDENCIA</strong></h4>
            </td>
        </tr>
        <br>
        </tbody>
    </table>
    <p style="text-align: right;font-size: 12px">Chachapoyas, {{$res->dia}} de {{$mes}}  del {{$res->ano}}</p>
    <h4 style="font-size: 13px"><U><strong>OFICIO Nº {{$res->codref}} -2021-GR.AMAZONAS-DRSA-RSCH/PS...</strong></U></h4>



    <h4 style="font-size: 13px"><strong>SEÑOR:</strong></h4>
    <h4 style="font-size: 13px"><strong>Blg. EDINSON ENRIQUE PURISACA MORANTE</strong></h4>
    <p style="text-align: left; font-size: 13px">Director de la Red de Salud Chachapoyas</p>
    <h4 style="font-size: 13px"><u><strong>Ciudad.-</strong></u></h4>

    <p style="text-align: justify; font-size: 13px"><b>ASUNTO</b>
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>: RENDICION DE TRASLADO DE PACIENTE SIS</strong></p>
    <p style="text-align: left; font-size: 13px"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Grato es dirigirme al Despacho de su digno cargo,
        para expresarle mi cordial saludo al mismo tiempo, presentar el expediente de traslado de
        emergencia de asegurado SIS para su tramite correspondiente, con los siguientes datos:</p>
    <table style="width: 100%; border-collapse: collapse; border-style: none;" border="2">
        <tbody>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: left"><b>Formato de afiliación</b></td>
            <td style="width: 10%;font-size: 12px; text-align: left;">{{$res->nafilia}}</td>

        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;"><b>FUA</b></td>
            <td style="width: 5%;font-size: 12px; text-align: left;">{{$res->rNroFua}}</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;"><b>Apellidos y Nombres del paciente</b></td>
            <td style="width: 5%;font-size: 12px; text-align: left;">{{$res->afiliado}}</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;"><b>Edad</b></td>
            <td style="width: 5%;font-size: 12px; text-align: left;">{{$res->edad}}</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;"><b>Diagnostico</b></td>
            <td style="width: 5%;font-size: 12px; text-align: left;">
                @foreach($result2 as $res2)
                    * &nbsp; &nbsp;{{$res2->cDescripcion}} &nbsp; &nbsp;({{$res2->cCodigo}})<br>
                @endforeach
            </td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;"><b>Fecha de atención</b></td>
            <td style="width: 5%;font-size: 12px; text-align: left;">{{$res->fecsal}}</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;"><b>Establecimiento de origen</b></td>
            <td style="width: 5%;font-size: 12px; text-align: left;">{{$res->estorig}}</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;"><b>Establecimiento de destino</b></td>
            <td style="width: 5%;font-size: 12px; text-align: left;">{{$res->estdesti}}</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;"><b>Personal que refiere</b></td>
            <td style="width: 5%;font-size: 12px; text-align: left;">{{$res->perref}}</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;"><b>Personal responsable del traslado</b></td>
            <td style="width: 5%;font-size: 12px; text-align: left;">
                @foreach($result1 as $res1)
                    {{$res1->personals}} ,
                @endforeach
            </td>
        </tr>
            <tr style="height: 54px;">
                <td style="width: 5%;font-size: 12px; text-align: left;"><b>Pasajes</b></td>
                <td style="width: 5%;font-size: 12px; text-align: left;">S/.
                    @if($res->pasaj===null)
                        {{0.0}}
                    @else
                        {{$res->pasaj}}
                    @endif
                </td>
            </tr>
            <tr style="height: 54px;">
                <td style="width: 5%;font-size: 12px; text-align: left;"><b>Viáticos</b></td>
                <td style="width: 5%;font-size: 12px; text-align: left;">S/.
                    @if($res->viati===null)
                        {{0.0}}
                    @else
                        {{$res->viati}}
                    @endif
                </td>
            </tr>
            <tr style="height: 54px;">
                <td style="width: 5%;font-size: 12px; text-align: left;"><b>Combustible</b></td>
                <td style="width: 5%;font-size: 12px; text-align: left;"></td>
            </tr>
            <tr style="height: 54px;">
                <td style="width: 5%;font-size: 12px; text-align: left;"><b>Total</b></td>
                <td style="width: 5%;font-size: 12px; text-align: left;">S/.{{$res->viati+$res->pasaj}}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <p style="text-align: left; font-size: 13px"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Propicia la oportunidad para
        expresarle las muestras de mi especial consideración.</p>
    <br>
    <p style="text-align: left; font-size: 13px"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Atentamente,</p>
    <br><br><br><br><br><br>
    <p style="text-align: left; font-size: 11px"><b>Reg.doc.______________</b></p>
    <p style="text-align: left; font-size: 11px"><b>Reg.Exp.______________</b></p>
@endforeach
