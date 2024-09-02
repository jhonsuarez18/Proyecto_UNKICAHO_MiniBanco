@foreach($result as $ress=>$res)
    <table style="width: 100%; border-collapse: collapse; border-style: none;" border="2">
        <tbody>
        <tr style="height: 54px;">

            <td style="width:2%;font-size: 12px ;text-align: left" colspan="5">
                <U style="text-align: center;font-size: 16px"><h3><strong>FORMATO - II</strong></h3></U>
                <p style="text-align: justify"><b>1.Unidad Ejecutora</b>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>-----------------</strong></p>
                <p style="text-align: justify"><b>2.Nº.Comprobante de Pago</b>
                    &nbsp; &nbsp; &nbsp; &nbsp;<strong>-----------------</strong></p>
                <p style="text-align: justify"><b>3.Nº.Expediente SIAF</b>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>-----------------</strong></p>
                <p style="text-align: justify"><b>4.Nª De Planilla</b>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<strong>-----------------</strong></p>
                <p style="text-align: justify"><b>5.Apellidos y Nombres</b>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{$res->personals}}</p>
                <p style="text-align: justify"><b>6.Motivo de Comision</b>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{$res->rMotRef}}</p>
                <p style="text-align: justify"><b>7.Fecha de Salida</b>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{$res->fecsal}}</p>
                <p style="text-align: justify"><b>8.Fecha de Retorno</b>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{$res->fecretor}}</p>
                <p style="text-align: justify"><b>9.Nº.De Dias</b>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{$res->dias}}</p>
                <p style="text-align: justify"><b>10.Lugar(s)</b>
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{$res->descripcion}}</p>

                <p style="text-align: justify"><b>DETALLE DEL GASTO:</b></p>
            </td>

        </tr>
        <tr style="height: 54px;">
            <td style="width:30%;font-size: 12px ;text-align: center"><b>DESCRIPCION</b></td>
            <td style="width: 10%;font-size: 12px; text-align: center;"><b>FONDOS ASIGNADOS</b></td>
            <td style="width: 20%;font-size: 12px; text-align: center; "><b>RENDICION CON DOCUMENTOS</b></td>
            <td style="width: 10%;font-size: 12px; text-align: center; "><b>RENDICION CON DD.JJ</b></td>
            <td style="width: 10%; font-size: 12px; text-align: center; "><b>TOTAL</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: left"><u><b>VIATICOS</b></u></td>
            <td style="width: 10%;font-size: 12px; text-align: center;"COLSPAN="4"></td>
        </tr>
        @foreach($result1 as $res1)
            @if($res1->vId===$res->vId)
                @if($res1->tGId===1)
                <tr style="height: 54px;">
                    <td style="width: 1%;font-size: 12px; text-align: left;">{{$res1->gDesc}}</td>
                    <td style="width: 5%;font-size: 12px; text-align: center;">{{$res1->fondasig}}</td>
                    <td style="width: 8%;font-size: 12px; text-align: center;">
                        @if($res1->compro===null)
                            {{0.0}}
                        @else
                            {{$res1->compro}}
                        @endif
                    </td>
                    <td style="width: 8%;font-size: 12px; text-align: center;">
                        @if($res1->decla===null)
                            {{0.0}}
                        @else
                            {{$res1->decla}}
                        @endif
                    </td>
                    <td style="width: 8%;font-size: 12px; text-align: center;">{{$res1->total}}</td>
                </tr>
                @endif
            @endif
        @endforeach
        @foreach($result2 as $res2)
            @if($res2->vId===$res->vId and $res2->tGId===1)
                <tr style="height: 54px;">
                    <td style="width:2%;font-size: 12px ;text-align: center"><b>SUBTOTAL</b></td>
                    <td style="width: 10%;font-size: 12px; text-align: center;"><b> {{$res2->subfond}}</b></td>
                    <td style="width: 20%;font-size: 12px; text-align: center; "><b>
                            @if($res2->compro===null)
                                {{0.0}}
                            @else
                                {{$res2->compro}}
                            @endif
                        </b></td>
                    <td style="width: 10%;font-size: 12px; text-align: center; "><b>
                            @if($res2->decla===null)
                                {{0.0}}
                            @else
                                {{$res2->decla}}
                            @endif
                        </b></td>
                    <td style="width: 5%; font-size: 12px; text-align: center; "><b>{{$res2->total}}</b></td>
                </tr>
            @endif
        @endforeach
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: left"><u><b>PASAJES</b></u></td>
            <td style="width: 10%;font-size: 12px; text-align: center;"COLSPAN="4"></td>
        </tr>
        @foreach($result1 as $res1)
            @if($res1->vId===$res->vId)
                @if($res1->tGId===2)
                    <tr style="height: 54px;">
                        <td style="width: 1%;font-size: 12px; text-align: left;">{{$res1->gDesc}}</td>
                        <td style="width: 5%;font-size: 12px; text-align: center;">{{$res1->fondasig}}</td>
                        <td style="width: 8%;font-size: 12px; text-align: center;">
                            @if($res1->compro===null)
                                {{0.0}}
                            @else
                                {{$res1->compro}}
                            @endif
                        </td>
                        <td style="width: 8%;font-size: 12px; text-align: center;">
                            @if($res1->decla===null)
                                {{0.0}}
                            @else
                                {{$res1->decla}}
                            @endif
                        </td>
                        <td style="width: 8%;font-size: 12px; text-align: center;">{{$res1->total}}</td>
                    </tr>
                @endif
            @endif
        @endforeach
        @php
            $total=0;
        @endphp
        @foreach($totales as $tot=>$to)
            @if($to['idv']===$res->vId)
                <tr style="height: 54px;">
                    <td style="width:2%;font-size: 12px ;text-align: center"><b>TOTAL</b></td>
                    <td style="width: 10%;font-size: 12px; text-align: center;"><b>{{$to['tfondc']}}</b></td>
                    <td style="width: 20%;font-size: 12px; text-align: center; "><b>{{$to['tcomp']}}</b></td>
                    <td style="width: 10%;font-size: 12px; text-align: center; "><b>{{$to['tdecla']}}</b></td>
                    <td style="width: 5%; font-size: 12px; text-align: center; "><b>{{$total=$to['totalv']}}</b></td>
                </tr>
            @endif
        @endforeach

        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: justify" COLSPAN="5"><b>NOTA: Se rinde con declaracion jurada hasta el 30% del monto total recibido
                    por concepto de viaticos sin considerar el monto percibido por pasajes</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: justify" COLSPAN="5"><b>DECLARACION JURADA </b><br>
                De conformidad con el Art. 3º del Decreto Supremo Nº007-2013-EF, Norma que regula el Otorgamiento de Viáticos
                para viajes en de servicios en el Territorio Nacional, declaro bajo Juramento que el monto <b>S/ {{$total}}</b> nuevos
                soles recibido lo he utilizado para gastos de alimentacion, hospedaje, movilidad local, taxi agencia de transportes,
                en el cumplimiento de la comisión de servicio <br><b>Lima</b></td>
        </tr>
        <tr style="height: 75px;">
            <td style="width:2%;font-size: 12px ;text-align: justify" COLSPAN="5">
                <p style="text-align: right;"><strong>Chachapoyas, {{$res->dia}} de {{$mes}} de {{$res->ano}}</strong></p>
                <br>
                <br>
                <br>
                <br>
                <p style="text-align: left;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>ADMINISTRADOR</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>ECONOMIA</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>JEFE INMEDIATO</b></p><br>

                <br>
                <br>
                <br>
                <br>
                <p style="text-align: left;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>TESORERO</b>&nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>COMISIONADO</b></p>
            </td>
        </tr>
        </tbody>
    </table>
    @if(count($result)!=$ress+1)
        <div style="page-break-after:always;"></div>
    @endif
@endforeach
