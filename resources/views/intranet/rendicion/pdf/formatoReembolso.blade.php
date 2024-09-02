@foreach($result as $ress=>$res)
    <table style="width: 100%; border-collapse: collapse; border-style: none;" border="2">
        <tbody>
        <tr style="height: 54px;">
            <td style="width:100%;font-size: 12px ;text-align: center" colspan="4">FORMATO DE RECORTE DEL CONSUMO EN EL TRASLADO DE EMERGENCIA</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:100%;font-size: 12px ;text-align: left" colspan="4">DATOS DEL ASEGURADO</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 60%;font-size: 12px ;text-align: center"colspan="2"><b>Nombre y Apellidos</b></td>
            <td style="width: 5%;font-size: 12px; text-align: center; "><b>Edad</b></td>
            <td style="width: 35%;font-size: 12px; text-align: center; "><b>Fecha de Nacimiento</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 60%;font-size: 12px ;text-align: center"colspan="2">{{$res->afiliado}}</td>
            <td style="width: 5%;font-size: 12px; text-align: center; ">{{$res->edad}}</td>
            <td style="width: 35%;font-size: 12px; text-align: center; ">{{$res->fecnac}}</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:60%;font-size: 12px ;text-align: center"COLSPAN="2"><b>Formato Unico de Atencion</b></td>
            <td style="width: 40%;font-size: 12px; text-align: center;"COLSPAN="2"><b>Codigo de Afiliacion</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:60%;font-size: 12px ;text-align: center"COLSPAN="2">{{$nrofua}}</td>
            <td style="width: 40%;font-size: 12px; text-align: center;"COLSPAN="2">{{$res->codafi}}</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 3%;font-size: 12px ;text-align: left"><b>Diagnostico</b></td>
            <td style="width: 55%;font-size: 12px; text-align: center;">
                @foreach($result1 as $ress1=>$res1)
                    @if($ress1===0)
                        {{$res1->cDescripcion}}
                    @endif
                @endforeach
            </td>
            <td style="width: 5%;font-size: 12px ;text-align: center"><b>cie 10:</b></td>
            <td style="width: 35%;font-size: 12px; text-align: center;">
                @foreach($result1 as $ress1=>$res1)
                    @if($ress1===0)
                        {{$res1->cCodigo}}
                    @endif
                @endforeach
            </td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 3%;font-size: 12px ;text-align: left"><b>Diagnostico</b></td>
            <td style="width: 55%;font-size: 12px; text-align: center;">
                @foreach($result1 as $ress1=>$res1)
                    @if($ress1===1)
                        {{$res1->cDescripcion}}
                    @endif
                @endforeach
            </td>
            <td style="width: 5%;font-size: 12px ;text-align: center"><b>cie 10:</b></td>
            <td style="width: 35%;font-size: 12px; text-align: center;">
                @foreach($result1 as $ress1=>$res1)
                    @if($ress1===1)
                        {{$res1->cCodigo}}
                    @endif
                @endforeach
            </td>
        </tr>
        <tr style="height: 54px;">
            <td style="width: 3%;font-size: 12px ;text-align: left"><b>Diagnostico</b></td>
            <td style="width: 55%;font-size: 12px; text-align: center;">
                @foreach($result1 as $ress1=>$res1)
                    @if($ress1===2)
                        {{$res1->cDescripcion}}
                    @endif
                @endforeach
            </td>
            <td style="width: 5%;font-size: 12px ;text-align: center"><b>cie 10:</b></td>
            <td style="width: 35%;font-size: 12px; text-align: center;">
                @foreach($result1 as $ress1=>$res1)
                    @if($ress1===2)
                        {{$res1->cCodigo}}
                    @endif
                @endforeach
            </td>
        </tr>
        </tbody>
    </table>
    <br>
    <table style="width: 100%; border-collapse: collapse; border-style: none;" border="2">
        <tbody>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: left" colspan="7"><b>Tipo de Traslado</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:20%;font-size: 12px ;text-align: left"><b>Emergencia:</b></td>
            <td style="width: 10%;font-size: 12px; text-align: center; "><b>X</b></td>
            <td style="width: 30%;font-size: 12px; text-align: left; "><b>Hospitalizacion:</b></td>
            <td style="width:10%;font-size: 12px ;text-align: center"><b></b></td>
            <td style="width: 30%;font-size: 12px; text-align: center; "><b>Plan Esperanza-EHR:</b></td>
            <td style="width: 10%;font-size: 12px; text-align: center; "><b></b></td>
            <td style="width: 10%;font-size: 12px; text-align: center; "><b></b></td>
        </tr>
        </tbody>
    </table>
    <br>
    <table style="width: 100%; border-collapse: collapse; border-style: none;" border="2">
        <tbody>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: left" colspan="7"><b>Tipo de Ambulancia que brinda el servicio</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:20%;font-size: 12px ;text-align: left"><b>Publica:</b></td>
            <td style="width: 10%;font-size: 12px; text-align: center; "><b>
                    @if($res->vPlaca!==null)
                        X
                    @endif
                    </b></td>
            <td style="width: 30%;font-size: 12px; text-align: left; "><b>Privada:</b></td>
            <td style="width:10%;font-size: 12px ;text-align: center"><b>
                    @if($res->vPlaca===null)
                        X
                    @endif
                </b></td>
            <td style="width: 30%;font-size: 12px; text-align: center; "><b>Otros:</b></td>
            <td style="width: 10%;font-size: 12px; text-align: center; "><b></b></td>
            <td style="width: 10%;font-size: 12px; text-align: center; "><b></b></td>
        </tr>
        </tbody>
    </table>
    <br>
    <b style="font-size: 12px ;text-align: left">Datos de la Referencia</b>
    <table style="width: 100%; border-collapse: collapse; border-style: none;" border="2">
        <tbody>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: center" colspan="2"><b>Nombre de la IPRESS que refiere</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Codigo RENAES</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: center" colspan="2">{{$res->ipresorig}}</td>
            <td style="width:2%;font-size: 12px ;text-align: center">{{$res->codrena}}</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: center" colspan="2"><b>Fecha y hora de la Referencia(dd/mm/aa;00:00)</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Nombre de la IPRESS de Destino</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:20%;font-size: 12px ;text-align: center">{{$res->fecsal}}</td>
            <td style="width: 10%;font-size: 12px; text-align: center; ">{{$res->hora}}</td>
            <td style="width: 30%;font-size: 12px; text-align: center; ">{{$res->ipresdest}}</td>
        </tr>
        </tbody>
    </table>
    <br>
    <table style="width: 100%; border-collapse: collapse; border-style: none;" border="2">
        <tbody>
        <tr style="height: 54px;">
            <td style="width:7%;font-size: 12px ;text-align: center"><b>Recorrido (origen-destino-origen)</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Km</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Vehiculo</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Placa</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:7%;font-size: 12px ;text-align: center">{{$res->recorr}}</td>
            <td style="width:2%;font-size: 12px ;text-align: center"></td>
            <td style="width:2%;font-size: 12px ;text-align: center">
                @if($res->vPlaca!==null)
                    {{$res->mDesc}}
                @endif
            </td>
            <td style="width:2%;font-size: 12px ;text-align: center">
                @if($res->vPlaca!==null)
                    {{$res->vPlaca}}
                @endif
            </td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Cantidad de galones a m3 utilizados</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Tipo de combustible</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Costo por galon</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Total importe</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: center">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
            <td style="width:2%;font-size: 12px ;text-align: center">
                @if($res->vPlaca!==null)
                    {{$res->tCDesc}}
                @endif
            </td>
            <td style="width:2%;font-size: 12px ;text-align: center">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
            <td style="width:2%;font-size: 12px ;text-align: center">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: center" colspan="2"><b>Nombre o Razon social del Proveedor</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center" colspan="2"><b>RUC</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: center" colspan="2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
            <td style="width:2%;font-size: 12px ;text-align: center" colspan="2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>
        </tr>
        </tbody>
    </table>
    <br>
    <table style="width: 100%; border-collapse: collapse; border-style: none;" border="2">
        <tbody>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: left" colspan="6">Detalles del gasto (Traslado Importe+TUUA):(*)</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: left" colspan="6">(*)Declaracion bajo juramento, que los gastos por el traslado son:</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: left"><b>Pasaje</b></td>
            <td style="width:2%;font-size: 12px ;text-align: left"><b>Aereo:</b></td>
            <td style="width:2%;font-size: 12px ;text-align: left"><b>Importe: S/.</b></td>
            <td style="width:2%;font-size: 12px ;text-align: left" colspan="3"><b>TUUA: S/.</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: left"><b>Terrestre</b></td>
            <td style="width:2%;font-size: 12px ;text-align: left">Imp:S/.</td>
            <td style="width:2%;font-size: 12px ;text-align: left">TUUA:S/.</td>
            <td style="width:2%;font-size: 12px ;text-align: left"><b>Marítimo:</b></td>
            <td style="width:2%;font-size: 12px ;text-align: left">Imp:S/.</td>
            <td style="width:2%;font-size: 12px ;text-align: left">TUUA:S/.</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: left"><b>Flubial</b></td>
            <td style="width:2%;font-size: 12px ;text-align: left">Imp:S/.</td>
            <td style="width:2%;font-size: 12px ;text-align: left">TUUA:S/.</td>
            <td style="width:2%;font-size: 12px ;text-align: left"><b>Lacustre:</b></td>
            <td style="width:2%;font-size: 12px ;text-align: left">Imp:S/.</td>
            <td style="width:2%;font-size: 12px ;text-align: left">TUUA:S/.</td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: center" colspan="3"><b>TOTAL:</b></td>
            <td style="width:2%;font-size: 12px ;text-align: left" colspan="3"><b>S/.</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Combustible</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center" colspan="2"></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Tipo Combustible</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center" colspan="2">
                @if($res->vPlaca!==null)
                    {{$res->tCDesc}}
                @endif
            </td>
        </tr>
        </tbody>
    </table>
    <br>
    <table style="width: 100%; border-collapse: collapse; border-style: none;" border="2">
        <tbody>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Viaticos</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Nro Personas</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b></b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Total</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"></td>
        </tr>
        </tbody>
    </table>
    <br>
    <i style="font-size: 12px ;text-align: center">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;ASIGNACION POR ALIMENTACION (Por parte del Familiar o Acompañante)(*)</i>
    <table style="width: 100%; border-collapse: collapse; border-style: none;" border="2">
        <tbody>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: center" colspan="2"><b>Nombre y Apellidos Completos</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>DNI</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>Domicilio</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: center" colspan="2"><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</b></td>
            <td style="width:2%;font-size: 12px ;text-align: center"><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:15%;font-size: 12px ;text-align: center"><b>(desayuno/almuerzo/cena)</b></td>
            <td style="width:28%;font-size: 12px ;text-align: center" colspan="2"><b>del (dd/mm/aaaa) al (dd/mm/aaaa)</b></td>
            <td style="width:20%;font-size: 12px ;text-align: center"><b>Monto Total por concepto de alimentacion</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:15%;font-size: 12px ;text-align: left"><b>S/.</b></td>
            <td style="width:14%;font-size: 12px ;text-align: center"><b></b></td>
            <td style="width:14%;font-size: 12px ;text-align: center"><b></b></td>
            <td style="width:20%;font-size: 12px ;text-align: left"><b>S/.</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 12px ;text-align: left"colspan="2"><b>firma y huella digital del familiar o acompañante, en señal de
                conformidad de la asignacion de alimentacion</b></td>
            <td style="width:10%;font-size: 12px ;text-align: left"><b>Firma:</b></td>
            <td style="width:10%;font-size: 12px ;text-align: left"><b>Huella:</b></td>
        </tr>
        </tbody>
    </table>
    <b style="font-size: 10px ;text-align: left">FECHA:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{$res->fecact}}</b>
    <hr>
    <table style="width: 100%; border-collapse: collapse; border-style: none;" border="0">
        <tbody>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 9px ;text-align: left"colspan="2">(*)Información declarada, bajo responsabilidad, sometiendome a las disposiciones de la ley
                Nº 27444, Ley del proceso administrativo <br>
                <b style="font-size: 10px ;text-align: left"> General, asimismo autorizo al Seguro Integral de Salud a Iniciar las sanciones legales
                correspondientes en caso de falta a la verdad</b></td>
        </tr>
        <tr style="height: 54px;">
            <td style="width:2%;font-size: 10px ;text-align: center"><b><br><br><br>
                    ________________________________ <br> Jefe/Gerente/Personal acompañante <br>de Establecimiento de Salud
                </b></td>
            <td style="width:2%;font-size: 10px ;text-align: center"><b><br><br><br>
                    ________________________________ <br> Firma y sello <br>Jefe oficina/unidad de seguros
                </b></td>
        </tr>
        </tbody>
    </table>
@endforeach
