<table class="table table-bordered m-b-0">
    <thead>
    <tr>
        <th class="text-center" colspan="11">RESUMEN PRESUPUESTAL POR ESPECIFICA DE GASTO</th>
    </tr>
    <tr>
        <th class="text-center">CODIGO</th>
        <th class="text-center">ESPECIFICA</th>
        <th class="text-center">MONTO</th>
        <th class="text-center">PORCENTAJE</th>
    </tr>
    <tbody>
    @php
        $tota = 0;
    @endphp
    @foreach($ejecucion as $ejecucion)
        <tr>
            <td class="text-center">{{ $ejecucion->eGCod }}</td>
            <td class="text-center">{{ $ejecucion->eGDesc }}</td>
            <td class="text-center">{{ $ejecucion->tot }}</td>
            <td class="text-center">{{ $ejecucion->por }}</td>
        </tr>
        @php
            $tota=$tota+$ejecucion->tot;
        @endphp
    @endforeach
    <tr>
        <td colspan="2" class="text-right">TOTAL</td>
        <td class="text-center">{{$tota}}</td>
    </tr>
    </tbody>


</table>
