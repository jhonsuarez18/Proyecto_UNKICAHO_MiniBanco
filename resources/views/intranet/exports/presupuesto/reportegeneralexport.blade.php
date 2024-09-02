<style>


</style>
<table>
    <thead>
    <tr>
        <th colspan="12">RESUMEN PRESUPUESTAL</th>
    </tr>
    <tr>
        <th>PROGRAMA PRESUPUESTAL</th>
        <th>META</th>
        <th>ESPECIFICA DE GASTO</th>
        <th>TRAN/MODI</th>
        <th>PIM</th>
        <th>EJECUTADP</th>
        <th>SALDO</th>
        <th>PEDIDO</th>
        <th>CERTIFICADO</th>
        <th>COMPROMETIDO</th>
        <th>DEVENGADO</th>
        <th>GIRADO</th>

    </tr>
    </thead>
    <tbody>
    @php
        $mont=0;
        $est0=0;
        $est1=0;
        $est2=0;
         $est3=0;
          $est4=0;
          $totejec=0;
          $sobr=0;

    @endphp
    @foreach($ejecucion as $ejecucion)
        <tr>
            <td>{{ $ejecucion->pPDesc }}</td>
            <td>{{ $ejecucion->mCod }}</td>
            <td>{{ $ejecucion->eGDesc }}</td>
            <td>{{ $ejecucion->trNumRj }}</td>
            <td>{{ $ejecucion->mont }}</td>
            <td>{{ $ejecucion->totejec }}</td>
            <td>{{ $ejecucion->sobr }}</td>
            <td>{{ $ejecucion->est0 }}</td>
            <td>{{ $ejecucion->est1 }}</td>
            <td>{{ $ejecucion->est2 }}</td>
            <td>{{ $ejecucion->est3 }}</td>
            <td>{{ $ejecucion->est4 }}</td>
        </tr>
        @php $mont=$mont+$ejecucion->mont;
                                $totejec=$totejec+$ejecucion->totejec;
                                $sobr=$sobr+$ejecucion->sobr;
                                $est0=$est0+ $ejecucion->est0;
                                $est1=$est1+ $ejecucion->est1;
                                $est2=$est2+ $ejecucion->est2;
                                $est3=$est3+ $ejecucion->est3;
                                $est4=$est4+ $ejecucion->est4;
        @endphp
    @endforeach
    <tr>
        <td colspan="4"  align="right">TOTAL</td>
        <td>{{$mont}}</td>
        <td>{{$totejec}}</td>
        <td>{{$sobr}}</td>
        <td>{{$est0}}</td>
        <td>{{$est1}}</td>
        <td>{{$est2}}</td>
        <td>{{$est3}}</td>
        <td>{{$est4}}</td>
    </tr>
    </tbody>


</table>
