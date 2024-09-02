
<table class="table table-bordered m-b-0">
    <thead>
    <tr>
        <th class="text-center" colspan="11">RESUMEN PRESUPUESTAL POR META Y ESPECIFICA DE GASTO</th>
    </tr>
    <tr>
        <th class="text-center">PROGRAMA PRESUPUESTAL</th>
                                               <th class="text-center">META</th>
                                               <th class="text-center">ESPECIFICA</th>
                                               <th class="text-center">MONTO INICIAL</th>
                                               <th class="text-center">CERTIFICADO</th>
                                               <th class="text-center">DEVENGADO</th>
                                              <th class="text-center">SALDO</th>
    </thead>
    <tbody>
    @php
        $est1 = 0;$est3 = 0;$saldo = 0;$mont=0;
    @endphp
    @foreach($ejecucion as $ejecucion)
        <tr>
            <td>{{ $ejecucion->pPDesc }}</td>
            <td class="text-center">{{ $ejecucion->mCod }}</td>
            <td class="text-center">{{ $ejecucion->eGDesc }}</td>
            <td class="text-center">{{ $ejecucion->mont }}</td>
            <td class="text-center">{{ $ejecucion->est1 }}</td>
            <td>{{ $ejecucion->est3 }}</td>
            <td class="text-center">{{ $ejecucion->saldo }}</td>
        </tr>
                @php
                  $mont=$mont+$ejecucion->mont;
                    $est1 =$est1+$ejecucion->est1  ;
                    $est3 =$est3+$ejecucion->est3;
                    $saldo =$saldo+$ejecucion->saldo;

                @endphp
    @endforeach
    <tr>
        <td colspan="3" class="text-right">TOTAL</td>
        <td class="text-center">{{$mont}}</td>
        <td class="text-center">{{$est1}}</td>
        <td class="text-center">{{$est3}}</td>
        <td class="text-center">{{$saldo}}</td>
    </tr>
    </tbody>


</table>
