<style>


</style>
<table>
    <thead>
    <tr>
        <th colspan="12" align="center">RESUMEN POR VALES</th>
    </tr>
    <tr>
        <th>Nº VALE</th>
        <th>O/C</th>
        <th>PROGRAMA</th>
        <th>META</th>
        <th>FACTURA</th>
        <th>GRIFO</th>
        <th>PLACA</th>
        <th>CONDUCTOR</th>
        <th>ITEM</th>
        <th>FECHA</th>
        <th>GALONES</th>
    </tr>
    </thead>
    <tbody>
    @php
        $sobr=0;

    @endphp
    @foreach($vales as $vales)
        <tr>
            <td>{{ $vales->codcons }}</td>
            <td>{{ $vales->oNumOC }}</td>
            <td>{{ $vales->pPDesc }}</td>
            <td>{{ $vales->mCod }}</td>
            <td>{{ $vales->oCNumFact }}</td>
            <td>{{ $vales->gDesc }}</td>
            <td>{{ $vales->vPlaca }}</td>
            <td>{{ $vales->chofer }}</td>
            <td>{{ $vales->tCDesc }}</td>
            <td>{{ $vales->cFecEnt }}</td>
            <td>{{ $vales->cCantGal }}</td>
        </tr>
        @php
            $sobr=$sobr+$vales->cCantGal;

        @endphp
    @endforeach
    <tr>
        <td colspan="10"  align="right">TOTAL</td>
        <td>{{$sobr}}</td>

    </tr>
    </tbody>


</table>
