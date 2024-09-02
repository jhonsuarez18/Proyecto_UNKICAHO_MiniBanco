@php
$o=0;
@endphp
@foreach($result as $ress=> $res)
    <table style="height: 20px; width: 100%; border: none;" border="0">
        <tbody>
        <tr style="height: 57px; border: none;">
            <td style="width: 25%; height: 40px;"><img style="display: block;text-align: right;"
                                                       src="http://siar.regionamazonas.gob.pe/sites/default/files/imgtop_0.png"
                                                       alt="" width="170" height="50"/></td>
            <td style="width: 25%; height: 50px;" align="right"></td>
        </tr>
        <tr style="height: 57px; border: none;">
            <td style="width: 100%; height: 40px;text-align: center" colspan="2">
                <h6 style="width: 100%; height: 10px;text-align: left">
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SEDE ADMINISTRATIVA
                </h6>
                <h4 style="font-size: 12px"><U><strong>DIRECTIVA Nº 004-2019-GOBIERNO REGIONAL AMAZONAS/GGR</strong></U></h4>
                <h5 style="font-size: 12px"><U><strong>FORMATO I</strong></U></h5>
                <h5 style="font-size: 12px"><U><strong>PLAN Y RECIBO PARA LA COMISIÓN DE SERVICIO </strong></U></h5>
            </td>
        </tr>
        <br>
        </tbody>
    </table>

    <table style="height: 20px; width: 100%; border: none;" border="0">
        <tbody>
        <tr style="height: 30px; border: none;">
            <td style="width: 6%; height: 30px;font-size: 12px"><b>A.</b></td>
            <td style="width: 100%; height: 30px;font-size: 12px"colspan="4"><b><U>DATOS DEL COMISIONADO:</U></b></td>
        </tr>
        <tr style="height: 30px; border: none;">
            <td style="width: 6%; height: 30px" ></td>
            <td style="width: 100%; height: 30px;font-size: 12px" colspan="4" >
                APELLIDOS Y NOMBRES&nbsp; &nbsp; &nbsp; &nbsp;:
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{$res->personals}}
                <br>
                UNIDAD ORGÁNICA&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CENTRO DE SALUD {{$res->unidorg}}
                <br>
                CARGO&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{$res->tPDescripcion}}
            </td>
        </tr>
        <tr style="height: 30px; border: none;">
            <td style="width: 6%; height: 30px;font-size: 12px"><b>B.</b></td>
            <td style="width: 100%; height: 30px;font-size: 12px" colspan="4"><b><u>SOBRE LA COMISIÓN DE SERVICIO:</u></b></td>
        </tr>
        <tr style="height: 30px; border: none;">
            <td style="width: 6%; height: 30px"></td>
            <td style="width: 100%; height: 30px;font-size: 12px" colspan="4">
                CRONOGRAMA DE ACTIVIDADES: <br>
                <br>

                <u>FECHA DE SALIDA</u>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<u>ACTIVIDADES A REALIZAR</u>
                <br>
                DEL&nbsp; &nbsp;{{$res->fecsal}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; TRASLADO DE PACIENTE POR {{$res->rMotRef}} AL
                <br>
                AL&nbsp; &nbsp; &nbsp;{{$res->fecretor}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{$res->descripcion}}
            </td>
        </tr>
        <tr style="height: 30px; border: none;">
            <td style="width: 6%; height: 30px;font-size: 12px"><b>C.</b></td>
            <td style="width: 100%; height: 30px;font-size: 12px" colspan="4"><b><u>OBJETIVO DE LA COMISIÓN:</u></b></td>
        </tr>
        <tr style="height: 30px; border: none;">
            <td style="width: 6%; height: 30px"></td>
            <td style="width: 100%; height: 30px;font-size: 12px" colspan="4">
                FECHA DE SALIDA&nbsp;:&nbsp; {{$res->fecsal}}&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; FECHA DE REGRESO&nbsp;:&nbsp; {{$res->fecretor}}
                <br>
                DURACIÓN &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; :&nbsp; {{$dias}} DIAS&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; DESTINO&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:&nbsp; {{$res->descripcion}}
                <br>
                MEDIO DE TRANSPORTE:OFICIAL () PARTICULAR ()
            </td>
        </tr>
        <tr style="height: 30px; border: none;">
            <td style="width: 6%; height: 30px;font-size: 12px"><b>D.</b></td>
            <td style="width: 100%; height: 30px;font-size: 12px" colspan="4"><b><u>AFECTACIÓN PRESUPUESTAL:</u> Actividad o Proyecto</b></td>
        </tr>
        <tr style="height: 30px; border: none;">
            <td style="width: 6%; height: 30px;font-size: 12px"><b>E.</b></td>
            <td style="width: 100%; height: 30px;font-size: 12px" colspan="4"><b><u>UTILIZACIÓN DE RECURSOS:</u></b></td>
        </tr>
        <tr style="height: 10px; border: none;">
            <td style="width: 6%; height: 10px;font-size: 12px"></td>
            <td style="width: 100%; height: 10px;font-size: 12px" colspan="4">
                <b><u>VIÁTICOS</u></b><br>
            </td>
        </tr>
        @php
        $i=-1;
        @endphp
        <tr style="height: 10px; border: none;">
            @foreach($result1 as $res1)
                @if($res->vId===$res1->idv)
                    @if($res1->idg===1)
                        <td style="width: 6%; height: 10px;font-size: 12px"></td>
                        <td style="width: 100%; height: 10px;font-size: 12px">ALIMENTACIÓN POR DIA</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">S/. {{$i=$res1->cosxdia}}</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">N° DIAS {{$res1->dias}}</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">TOTAL S/.{{$res1->decla}}</td>
                    @endif
                @endif
            @endforeach
                @if($i===-1)
                    <td style="width: 6%; height: 10px;font-size: 12px"></td>
                    <td style="width: 100%; height: 10px;font-size: 12px">ALIMENTACIÓN POR DIA</td>
                    <td style="width: 100%; height: 10px;font-size: 12px">S/.</td>
                    <td style="width: 100%; height: 10px;font-size: 12px">N° DIAS</td>
                    <td style="width: 100%; height: 10px;font-size: 12px">TOTAL S/.</td>
                @else
                    @php
                        $i=-1;
                    @endphp
                @endif
        </tr>
        <tr style="height: 10px; border: none;">
            @foreach($result1 as $res1)
                @if($res->vId===$res1->idv)
                    @if($res1->idg===2)
                        <td style="width: 6%; height: 10px;font-size: 12px"></td>
                        <td style="width: 100%; height: 10px;font-size: 12px">HOSPEDAJE POR NOCHE</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">S/. {{$i=$res1->cosxdia}}</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">N° DIAS {{$res1->dias}}</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">TOTAL S/.{{$res1->decla}}</td>
                    @endif
                @endif
            @endforeach
                @if($i===-1)
                    <td style="width: 6%; height: 10px;font-size: 12px"></td>
                    <td style="width: 100%; height: 10px;font-size: 12px">HOSPEDAJE POR NOCHE</td>
                    <td style="width: 100%; height: 10px;font-size: 12px">S/.</td>
                    <td style="width: 100%; height: 10px;font-size: 12px">N° DIAS</td>
                    <td style="width: 100%; height: 10px;font-size: 12px">TOTAL S/.</td>
                @else
                    @php
                        $i=-1;
                    @endphp
                @endif
        </tr>
        <tr style="height: 10px; border: none;">
            @foreach($result1 as $res1)
                @if($res->vId===$res1->idv)
                    @if($res1->idg===3)
                        <td style="width: 6%; height: 10px;font-size: 12px"></td>
                        <td style="width: 100%; height: 10px;font-size: 12px">MOVILIDAD LOCAL DIARIA</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">S/. {{$i=$res1->cosxdia}}</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">N° DIAS {{$res1->dias}}</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">TOTAL S/.{{$res1->decla}}</td>
                    @endif
                @endif
            @endforeach
            @if($i===-1)
                <td style="width: 6%; height: 10px;font-size: 12px"></td>
                <td style="width: 100%; height: 10px;font-size: 12px">MOVILIDAD LOCAL DIARIA</td>
                <td style="width: 100%; height: 10px;font-size: 12px">S/.</td>
                <td style="width: 100%; height: 10px;font-size: 12px">N° DIAS</td>
                <td style="width: 100%; height: 10px;font-size: 12px">TOTAL S/.</td>
            @else
                @php
                    $i=-1;
                @endphp
            @endif
        </tr>
        <tr style="height: 10px; border: none;">
            @foreach($totales as $tot=>$to)
                @if($to['idv']===$res->vId)
                        <td style="width: 6%; height: 10px;font-size: 12px"></td>
                        <td style="width: 100%; height: 10px;font-size: 12px"></td>
                        <td style="width: 100%; height: 10px;font-size: 12px"></td>
                        <td style="width: 100%; height: 10px;font-size: 12px"></td>
                        <td style="width: 100%; height: 10px;font-size: 12px">TOTAL S/. {{$i=$to['totv']}}</td>
                @endif
            @endforeach
                @if($i===-1)
                    <td style="width: 6%; height: 10px;font-size: 12px"></td>
                    <td style="width: 100%; height: 10px;font-size: 12px"></td>
                    <td style="width: 100%; height: 10px;font-size: 12px"></td>
                    <td style="width: 100%; height: 10px;font-size: 12px"></td>
                    <td style="width: 100%; height: 10px;font-size: 12px">TOTAL S/.</td>
                @else
                    @php
                        $i=-1;
                    @endphp
                @endif
        </tr>
        <tr style="height: 10px; border: none;">
            <td style="width: 6%; height: 10px;font-size: 12px"></td>
            <td style="width: 100%; height: 10px;font-size: 12px" colspan="4">
                <b><u>PASAJES</u></b><br>
            </td>
        </tr>
        <tr style="height: 10px; border: none;">
            @foreach($result1 as $res1)
                @if($res->vId===$res1->idv)
                    @if($res1->idg===5)
                        <td style="width: 6%; height: 10px;font-size: 12px"></td>
                        <td style="width: 100%; height: 10px;font-size: 12px">TRANSPORTE TERRESTRE:</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">IDA S/.</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">VUELTA S/.</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">TOTAL S/. {{$i=$res1->decla}}</td>
                    @endif
                @endif
            @endforeach
            @if($i===-1)
                <td style="width: 6%; height: 10px;font-size: 12px"></td>
                <td style="width: 100%; height: 10px;font-size: 12px">TRANSPORTE TERRESTRE:</td>
                <td style="width: 100%; height: 10px;font-size: 12px">IDA S/.</td>
                <td style="width: 100%; height: 10px;font-size: 12px">VUELTA S/.</td>
                <td style="width: 100%; height: 10px;font-size: 12px">TOTAL S/.</td>
            @else
                @php
                    $i=-1;
                @endphp
            @endif
        </tr>
        <tr style="height: 10px; border: none;">
            @foreach($result1 as $res1)
                @if($res->vId===$res1->idv)
                    @if($res1->idg===6)
                        <td style="width: 6%; height: 10px;font-size: 12px"></td>
                        <td style="width: 100%; height: 10px;font-size: 12px">TRANSPORTE AÉREO:</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">IDA S/.</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">VUELTA S/.</td>
                        <td style="width: 100%; height: 10px;font-size: 12px">TOTAL S/. {{$i=$res1->decla}}</td>
                    @endif
                @endif
            @endforeach
            @if($i===-1)
                <td style="width: 6%; height: 10px;font-size: 12px"></td>
                <td style="width: 100%; height: 10px;font-size: 12px">TRANSPORTE AÉREO:</td>
                <td style="width: 100%; height: 10px;font-size: 12px">IDA S/.</td>
                <td style="width: 100%; height: 10px;font-size: 12px">VUELTA S/.</td>
                <td style="width: 100%; height: 10px;font-size: 12px">TOTAL S/.</td>
            @else
                @php
                    $i=-1;
                @endphp
            @endif
        </tr>
        <tr style="height: 10px; border: none;">
            @foreach($totales as $tot=>$to)
                @if($to['idv']===$res->vId)
                        <td style="width: 6%; height: 10px;font-size: 12px"></td>
                        <td style="width: 100%; height: 10px;font-size: 12px"></td>
                        <td style="width: 100%; height: 10px;font-size: 12px"></td>
                        <td style="width: 100%; height: 10px;font-size: 12px"colspan="2">
                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; TOTAL GENERAL S/. {{$i=($to['totv']+$to['totp'])}}</td>
                @endif
            @endforeach
            @if($i===-1)
                <td style="width: 6%; height: 10px;font-size: 12px"></td>
                <td style="width: 100%; height: 10px;font-size: 12px"></td>
                <td style="width: 100%; height: 10px;font-size: 12px"></td>
                <td style="width: 100%; height: 10px;font-size: 12px"colspan="2">
                    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; TOTAL GENERAL S/.</td>
            @else
                @php
                    $i=-1;
                @endphp
            @endif
        </tr>
        <tr style="height: 30px; border: none;">
            <td style="width: 6%; height: 30px;font-size: 12px"><b>F.</b></td>
            <td style="width: 100%; height: 30px;font-size: 12px" colspan="4"><b><u>UNIDAD DE TESORERÍA:</u></b></td>
        </tr>
        <tr style="height: 30px; border: none;">
            <td style="width: 6%; height: 30px;font-size: 12px"></td>
            <td style="width: 100%; height: 30px;font-size: 12px" colspan="4">
                Recibi de la Unidad de caja de la Gerencia Regional de Administración la suma de S/...........(.........)
                Por concepto de viáticos para ser utilizadso en la Comisión de Servicio a la Localidad y/o Ciudad de....................
                con cargo a rendir cuenta documentada dentro del plazo establecido. <br>
                El (la) suscrito (a) AUTORIZA, a la Gerencia Regional de Administración la retención en mi Planilla Única de Pagos, si incumplo
                con presentar la Rendición de Cuenta documentada y/o devolución de viáticos no utilizados en el plazo de 10 días.
                <br>
                          <p style="text-align: right;font-size: 12px">Chachapoyas, {{$res->dia}} de {{$mes}}  del {{$res->ano}}</p>
            </td>
        </tr>
        <br>
        </tbody>
    </table>
    @if(count($result)!=$ress+1)
        <div style="page-break-after:always;"></div>
    @endif
@endforeach
