
@foreach($lug as $lu=>$l)
    @if($l['l']===0)
        @foreach($result2 as $res2)
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
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{$res2->personals}}</p>
                        <p style="text-align: justify"><b>6.Motivo de Comision</b>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{$res2->rMotRef}}</p>
                        <p style="text-align: justify"><b>7.Fecha de Salida</b>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{$res2->fecsal}}</p>
                        <p style="text-align: justify"><b>8.Fecha de Retorno</b>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{$res2->fecretor}}</p>
                        <p style="text-align: justify"><b>9.Nº.De Dias</b>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{$res2->dias}}</p>
                        <p style="text-align: justify"><b>10.Lugar(s)</b>
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{$res2->descripcion}}</p>

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
                @foreach($result3 as $res3)
                    @if($res3->vId===$res2->vId)
                        @if($res3->tGId===1)
                            <tr style="height: 54px;">
                                <td style="width: 1%;font-size: 12px; text-align: left;">{{$res3->gDesc}}</td>
                                <td style="width: 5%;font-size: 12px; text-align: center;"> {{$res3->fondasig}}</td>
                                <td style="width: 8%;font-size: 12px; text-align: center;">
                                    @if($res3->compro===null)
                                        {{0.0}}
                                    @else
                                        {{$res3->compro}}
                                    @endif
                                </td>
                                <td style="width: 8%;font-size: 12px; text-align: center;">
                                    @if($res3->decla===null)
                                        {{0.0}}
                                    @else
                                        {{$res3->decla}}
                                    @endif
                                </td>
                                <td style="width: 8%;font-size: 12px; text-align: center;">{{$res3->total}}</td>
                            </tr>
                        @endif
                    @endif
                @endforeach
                @foreach($result4 as $res4)
                    @if($res4->vId===$res2->vId and $res4->tGId===1)
                        <tr style="height: 54px;">
                            <td style="width:2%;font-size: 12px ;text-align: center"><b>SUBTOTAL</b></td>
                            <td style="width: 10%;font-size: 12px; text-align: center;"><b>{{$res4->subfond}}</b></td>
                            <td style="width: 20%;font-size: 12px; text-align: center; "><b>
                                    @if($res4->compro===null)
                                        {{0.0}}
                                    @else
                                        {{$res4->compro}}
                                    @endif
                                </b></td>
                            <td style="width: 10%;font-size: 12px; text-align: center; "><b>
                                    @if($res4->decla===null)
                                        {{0.0}}
                                    @else
                                        {{$res4->decla}}
                                    @endif
                                </b></td>
                            <td style="width: 5%; font-size: 12px; text-align: center; "><b>{{$res4->total}}</b></td>
                        </tr>
                    @endif
                @endforeach
                <tr style="height: 54px;">
                    <td style="width:2%;font-size: 12px ;text-align: left"><u><b>PASAJES</b></u></td>
                    <td style="width: 10%;font-size: 12px; text-align: center;"COLSPAN="4"></td>
                </tr>
                @foreach($result3 as $res3)
                    @if($res3->vId===$res2->vId)
                        @if($res3->tGId===2)
                            <tr style="height: 54px;">
                                <td style="width: 1%;font-size: 12px; text-align: left;">{{$res3->gDesc}}</td>
                                <td style="width: 5%;font-size: 12px; text-align: center;">{{$res3->fondasig}}</td>
                                <td style="width: 8%;font-size: 12px; text-align: center;">
                                    @if($res3->compro===null)
                                        {{0.0}}
                                    @else
                                        {{$res3->compro}}
                                    @endif
                                </td>
                                <td style="width: 8%;font-size: 12px; text-align: center;">
                                    @if($res3->decla===null)
                                        {{0.0}}
                                    @else
                                        {{$res3->decla}}
                                    @endif
                                </td>
                                <td style="width: 8%;font-size: 12px; text-align: center;">{{$res3->total}}</td>
                            </tr>
                        @endif
                    @endif
                @endforeach
                @php
                    $total=0;
                @endphp
                @foreach($totales as $tot=>$to)
                    @if($to['idv']===$res2->vId)
                        <tr style="height: 54px;">
                            <td style="width:2%;font-size: 12px ;text-align: center"><b>TOTAL</b></td>
                            <td style="width: 10%;font-size: 12px; text-align: center;"><b>{{$to['tfondc']}}</b></td>
                            <td style="width: 20%;font-size: 12px; text-align: center; "><b>{{$to['tcomp']}}</b></td>
                            <td style="width: 10%;font-size: 12px; text-align: center; "><b>{{$to['tdecla']}}</b></td>
                            <td style="width: 5%; font-size: 12px; text-align: center; "><b>{{$to['totalv']}}</b></td>
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
                        <p style="text-align: right;"><strong>Chachapoyas, {{$res2->dia}} de {{$mes}} de {{$res2->ano}}</strong></p>
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
                <div style="page-break-after:always;"></div>
        @endforeach
    @endif
@endforeach

@php
$cont=0;
@endphp
@foreach($result as $ress=>$res)
    <table style="height: 10px; width: 100%; border: none; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
        <tr style="height: 10px; border: none;">
            <td style="width: 60%;font-size: 2px; text-align: center; height: 10px;">
                <hr size="3">
                <hr size="3">
            </td>
        </tr>
        </tbody>
    </table>
    <table style="height: 20px; width: 70%; border: none; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
        <tr style="height: 57px; border: none;">
            <td style="width: 60%; text-align: center; height: 31px;">
                <h3><strong>FORMATO-III</strong></h3>
                <h4><strong>DETALLE DE GASTOS EN COMISION DE SERVICIOS VIATICOS, PASAJES Y OTROS GASTOS</strong></h4>
            </td>
        </tr>
        </tbody>
    </table>
    <table style="height: 12%; width: 94.8722%; border: none; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
        <tr style="height: 3%;">
            <td style="width: 12%;font-size: 12px ; text-align: left; height: 15px; vertical-align: top; "><b>NOMBRES Y APELLIDOS:</b></td>
            <td style="width: 30%;font-size: 12px; text-align: justify; height: 15px;vertical-align: top"> {{$res->personals}}</td>
        </tr>
        <tr style="height: 3%;">
            <td style="width: 8%;font-size: 12px ; text-align: left; height: 15px; vertical-align: top; "><b>DEPENDENCIA:</b></td>
            <td style="width: 35%;font-size: 12px ; text-align: justify; height: 15px;vertical-align: top">{{$res->eper}}</td>
        </tr>
        <tr style="height: 3%;">
            <td style="width: 5%;font-size: 12px; text-align: left; height: 15px; vertical-align: top; "><b>CARGO:</b></td>
            <td style="width: 7%;font-size: 12px; text-align: justify; height: 15px;vertical-align: top">{{$res->tPDescripcion}}</td>
        </tr>
        </tbody>
    </table>
    <table style="width: 94.8722%; border-collapse: collapse; border-style: none;" border="3">
        <tbody>
        <tr style="height: 54px;">
            <td style="width:1%;font-size: 12px ;text-align: center" rowspan="2"><b>Nº</b></td>
            <td style="width: 10%;font-size: 12px; text-align: center;" colspan="3"><b>COMPROBANTE DE PAGO</b></td>
            <td style="width: 20%;font-size: 12px; text-align: center; " rowspan="2"><b>RAZON SOCIAL</b></td>
            <td style="width: 10%;font-size: 12px; text-align: center; " rowspan="2"><b>DETALLE DEL GASTO</b></td>
            <td style="width: 5%; font-size: 12px; text-align: center; " rowspan="2"><b>IMPORTE</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: center;"><b>FECHA</b></td>
            <td style="width: 5%;font-size: 12px; text-align: center;"><b>TIPO DOC.</b></td>
            <td style="width: 8%;font-size: 12px; text-align: center;"><b>Nº DOC.</b></td>
        </tr>
        @foreach($result1 as $ress1=>$res1)
                @if($res1->vId===$res->vId)
                    <tr style="height: 54px;">
                        <td style="width: 1%;font-size: 12px; text-align: center;">{{$ress1+1}}</td>
                        <td style="width: 5%;font-size: 12px; text-align: center;"> {{$res1->cFecha}}</td>
                        <td style="width: 8%;font-size: 12px; text-align: center;">{{$res1->tDDes}}</td>
                        <td style="width: 8%;font-size: 12px; text-align: center;">{{$res1->cNroDoc}}</td>
                        <td style="width: 8%;font-size: 12px; text-align: left;">{{$res1->cRazSoc}}</td>
                        <td style="width: 8%;font-size: 12px; text-align: center;">{{$res1->gDesc}}</td>
                        <td style="width: 8%;font-size: 12px; text-align: center;">{{$res1->cImp}}</td>
                    </tr>
                @endif
        @endforeach
        <tr style="height: 54px;">
            <td style="width: 5%;font-size: 12px; text-align: center;" colspan="6"><b>TOTAL GENERAL</b></td>
            <td style="width: 5%;font-size: 12px; text-align: center;"><b>{{$res->tot}}</b></td>
        </tr>
        </tbody>
    </table>
    <p style="text-align: left;">&nbsp;</p>
    <p style="text-align: left;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
    <p style="text-align: left;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
    <p style="text-align: left;font-size: 14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;______________&nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ________________
    <p style="text-align: left;font-size: 14px">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;COMISIONADO&nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;JEFE INMEDIATO
    </p>
    <table style="height: 10px; width: 100%; border: none; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
        <tr style="height: 10px; border: none;">
            <td style="width: 60%;font-size: 2px; text-align: center; height: 10px;">
                <hr size="3">
                <hr size="3">
            </td>
        </tr>
        </tbody>
    </table>
    @if(count($result)!=$ress+1)
        <div style="page-break-after:always;"></div>
    @endif

@endforeach
