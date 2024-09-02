<style>


</style>
<table>
    <thead>
    <tr>
        <th colspan="12">RESUMEN POR PEDIDO</th>
    </tr>
    <tr>
        <th>META</th>
        <th>PEDIDO</th>
        <th>ESPECIFICA DE GASTO</th>
        <th>TRAN/MODI</th>
        <th>MONTO</th>
        <th>FECHA</th>
        <th>ESTADO SIGA</th>
        <th>TIPO</th>
    </tr>
    </thead>
    <tbody>
    @php
          $sobr=0;

    @endphp
    @foreach($pedido as $pedido)
        <tr>
            <td>{{ $pedido->mCod }}</td>
            <td>{{ $pedido->peCodPed }}</td>
            <td>{{ $pedido->eGCod }}</td>
            <td>{{ $pedido->pre }}</td>
            <td>{{ $pedido->peMonto }}</td>
            <td>{{ $pedido->peFecPre }}</td>
            <td>{{ $pedido->ests }}</td>
            <td>{{ $pedido->tdesc }}</td>
        </tr>
        @php
                                $sobr=$sobr+$pedido->peMonto;

        @endphp
    @endforeach
    <tr>
        <td colspan="4"  align="right">TOTAL</td>
        <td>{{$sobr}}</td>

    </tr>
    </tbody>


</table>
