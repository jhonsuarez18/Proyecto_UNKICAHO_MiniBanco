
<table class="table table-bordered m-b-0">
    <thead>
    <tr>
        <th class="text-center" colspan="11">REPORTE DE PRESUPUESTO POR TRANSFERENCIA</th>
    </tr>
    <tr>
        <th class="text-center">NR RJ</th>
        <th class="text-center">COD TRANSFERENCIA</th>
        <th class="text-center">MONTO INICIAL</th>
        <th class="text-center">MONTO ASIGNADO</th>
        <th class="text-center">MONTO EJECUTADO</th>
        <th class="text-center">SALDO</th>
    </thead>
    <tbody>
    @php
        $monti=0;
   $monta=0;
      $monte=0;
         $saldo=0;
    @endphp
    @foreach($ejecucion as $ejecucion)
        <tr>
            <td>{{ $ejecucion->trNumRj }}</td>
            <td class="text-center">{{ $ejecucion->trCodTrans }}</td>
            <td class="text-center">{{ $ejecucion->trMonto }}</td>
            <td class="text-center">{{ $ejecucion->MontoIni }}</td>
            <td class="text-center">{{ $ejecucion->montoAsig }}</td>
            <td class="text-center">{{ $ejecucion->saldo }}</td>
        </tr>
                @php $monti=$monti+$ejecucion->trMonto;
                        $monta=$monta+$ejecucion->MontoIni;
                        $monte=$monte+$ejecucion->montoAsig;
                        $saldo=$saldo+$ejecucion->saldo;
                @endphp
    @endforeach
    <tr>
        <td colspan="2" class="text-right">TOTAL</td>
        <td class="text-center">{{$monti}}</td>
        <td class="text-center">{{$monta}}</td>
        <td class="text-center">{{$monte}}</td>
        <td class="text-center">{{$saldo}}</td>
    </tr>
    </tbody>


</table>
