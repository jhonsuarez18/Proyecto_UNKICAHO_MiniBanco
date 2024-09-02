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
            <td style="width: 100%; height: 40px;text-align: center" colspan="0">
                <h4 style="font-size: 12px"><strong>AÑO DEL BICENTENARIO DEL PERU: 200 AÑOS DE INDEPENDENCIA</strong></h4>
            </td>
        </tr>
        <br>
        </tbody>
    </table>
    <h4 style="font-size: 13px"><U><strong>INFORME Nº {{$res->codref}} -2021-GOB.REG.AMAZONAS-DRSA.HMA.OS</strong></U></h4>
    <table style="width: 100%; border-collapse: collapse; border-style: none;" border="0">
        <tbody>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: left">A &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
            <td style="width: 10%;font-size: 12px; text-align: left;">ABRAHAM VICENTE MUÑANTE <br>
                DIRECTOR HOSPITAL MARIA AUXILIADORA
            </td>

        </tr>
        <tr style="height: 54px;">
            <td style="width: 2%;font-size: 12px; text-align: left;">DE &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
            <td style="width: 5%;font-size: 12px; text-align: left;">OFICINA DE SEGUROS</td>
        </tr>
        </tbody>
    </table>
    <br>
    <hr>
    <p style="text-align: left; font-size: 13px"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Tengo a bien dirigirme al despacho de su digno cargo, para hacer de su conocimiento que se procedio
        al traslado de un paciente afiliado al SIS, dicho traslado fue desde el Hospital {{$res->estorig}} de {{$res->provorig}} con destino al
        Hospital {{$res->estdesti}} de {{$res->provdest}}, el cual se detalla:</p>
    <table style="width: 100%; border-collapse: collapse; border-style: none;" border="0">
        <tbody>
        <tr style="height: 54px;">
            <td style="width:5%;font-size: 12px ;text-align: left">NOMBRE DEL PACIENTE &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
            <td style="width: 10%;font-size: 12px; text-align: left;">{{$res->afiliado}}</td>

        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;">CODIGO DE AFILIACION &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
            <td style="width: 5%;font-size: 12px; text-align: left;">{{$res->nafilia}}</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;">DIAGNOSTICOS &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
            <td style="width: 5%;font-size: 12px; text-align: left;">
                @foreach($result2 as $res2)
                    * &nbsp; &nbsp;{{$res2->cDescripcion}} &nbsp; &nbsp;({{$res2->cCodigo}})<br>
                @endforeach
            </td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;">FECHA DE SALIDA &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
            <td style="width: 5%;font-size: 12px; text-align: left;">{{$res->fecsal}}</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;">MOVILIDAD &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:</td>
            <td style="width: 5%;font-size: 12px; text-align: left;">OFICIAL-
                    @if($res->vPlaca===null)
                        VEHICULO PARTICULAR
                    @else
                    PLACA Nº {{$res->vPlaca}}
                    @endif
            </td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: left;">RESP DEL TRASLADO &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :</td>
            <td style="width: 5%;font-size: 12px; text-align: left;">
                @foreach($result1 as $res1)
                    {{$res1->tPDescripcion}}: {{$res1->personals}} <br>
                @endforeach
            </td>
        </tr>
        </tbody>
    </table>
    <br>
    <!--<p style="text-align: left; font-size: 13px">OBSERVACION:_________SOLO SE SOLICITA DEVOLUACION DE COMBUSTIBLE ____________________________
    _______________________________________________________________________________________________________
    _______________________________________________________________________________________________________
    _______________________________________________________________________________________________________
    _______________________________________________________________________________________________________
    _______________________________________________________________________________________________________</p>-->
    <br>
    <p style="text-align: left; font-size: 13px"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ATENTAMENTE,</p>
@endforeach
