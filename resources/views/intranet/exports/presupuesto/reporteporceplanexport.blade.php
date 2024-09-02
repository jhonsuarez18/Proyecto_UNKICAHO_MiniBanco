<style>


</style>
<table>
    <thead>
    <tr>
        <th colspan="12">RESUMEN POR CEPLAN</th>
    </tr>
    <tr>
        <th>PROGRAMA PRESUPUESTAL</th>
        <th>META</th>
        <th>ESPECIFICA DE GASTO</th>
        <th>PIM</th>
        <th>EJEC</th>
        <th>SALDO</th>
        <th>PEDI</th>
        <th>CERT</th>
        <th>COMP</th>
        <th>DEVE</th>
        <th>GIRA</th>
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
    @foreach($ceplan as $ceplan)
        <tr>
            <td>{{ $ceplan->pPDesc }}</td>
            <td>{{ $ceplan->mCod }}</td>
            <td>{{ $ceplan->eGDesc }}</td>
            <td>{{ $ceplan->mont }}</td>
            <td>{{ $ceplan->totejec }}</td>
            <td>{{ $ceplan->sobr }}</td>
            <td>{{ $ceplan->est0 }}</td>
            <td>{{ $ceplan->est1 }}</td>
            <td>{{ $ceplan->est2 }}</td>
            <td>{{ $ceplan->est3 }}</td>
            <td>{{ $ceplan->est4 }}</td>
        </tr>
        @php $mont=$mont+$ceplan->mont;
                                $totejec=$totejec+$ceplan->totejec;
                                $sobr=$sobr+$ceplan->sobr;
                                $est0=$est0+ $ceplan->est0;
                                $est1=$est1+ $ceplan->est1;
                                $est2=$est2+ $ceplan->est2;
                                $est3=$est3+ $ceplan->est3;
                                $est4=$est4+ $ceplan->est4;
        @endphp
    @endforeach
    <tr>
        <td colspan="3"  align="right">TOTAL</td>
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
