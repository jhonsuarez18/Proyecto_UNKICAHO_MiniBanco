<style>


</style>
<table>
    <thead>
    <tr>
        <th colspan="12">RESUMEN POR TRAMA</th>
    </tr>
    <tr>
        <th>AÑO</th>
        <th>PROG. PRESUPUESTAL</th>
        <th>PRODUCTO</th>
        <th>ACTIVIDAD</th>
        <th>META</th>
        <th>FINALIDAD</th>
        <th>CLASIFICADOR</th>
        <th>PIM</th>
        <th>N° NOTA</th>
    </tr>
    </thead>
    <tbody>
    @php
        $totpim=0;

    @endphp
    @foreach($trama as $trama)
        <tr>
            <td>{{ $trama->trFecCrea }}</td>
            <td>{{ $trama->pPCod }}</td>
            <td>{{ $trama->fCodProducto }}</td>
            <td>{{ $trama->fCodActividad }}</td>
            <td>{{ $trama->mCod }}</td>
            <td>{{ $trama->fCodFinalidad }}</td>
            <td>{{ $trama->eGCod }}</td>
            <td>{{ $trama->monto }}</td>
            <td>{{ $trama->nNro }}</td>
        </tr>
        @php
            $totpim=$totpim+$trama->monto;

        @endphp
    @endforeach
    <tr>
        <td colspan="7"  align="right">TOTAL</td>
        <td>{{$totpim}}</td>

    </tr>
    </tbody>


</table>
