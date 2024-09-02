
<table class="table table-bordered m-b-0">
    <thead>
    <tr>
        <th class="text-center" colspan="11">RESUMEN POR PROGRAMA</th>
    </tr>
    <tr>
        <th class="text-center">PROGRAMA PRESUPUESTAL</th>
                                              <th class="text-center">003-2020/SIS</th>
                                              <th class="text-center">107-2019/SIS</th>
                                              <th class="text-center">040-2017/SIS</th>
                                              <th class="text-center">12-2019/SIS</th>
        <th class="text-center">139-2019/SIS</th>
                                               <th class="text-center">165-2019/SIS</th>
                                              <th class="text-center">197-2019/SIS</th>
                                              <th class="text-center">172-2019/SIS</th>
                                               <th class="text-center">2016 - SAL ANTE</th>
        <th class="text-center">01-PIA 2020</th>
                                               <th class="text-center">MODI</th>
                                               <th class="text-center">TOT RJ</th>
                                              <th class="text-center">CERTIFICADO</th>
                                               <th class="text-center">DEVENGADO</th>
                                              <th class="text-center">TOT EJE</th>
    </thead>
    <tbody>
    @php
        $t1 = 0;$t2 = 0;$t3 = 0; $t4 = 0;$t5 = 0;$t6 = 0;$t7 = 0;$t8 = 0;
                    $t9 = 0;$t10 = 0;$mo = 0;$totrj = 0;$est1 = 0;$est3 = 0;$tote = 0;
    @endphp
    @foreach($ejecucion as $ejecucion)
        <tr>
            <td>{{ $ejecucion->pPDesc }}</td>
            <td class="text-center">{{ $ejecucion->t1 }}</td>
            <td class="text-center">{{ $ejecucion->t2 }}</td>
            <td class="text-center">{{ $ejecucion->t3 }}</td>
            <td class="text-center">{{ $ejecucion->t4 }}</td>
            <td class="text-center">{{ $ejecucion->t5 }}</td>
            <td>{{ $ejecucion->t6 }}</td>
            <td class="text-center">{{ $ejecucion->t7 }}</td>
            <td class="text-center">{{ $ejecucion->t8 }}</td>
            <td class="text-center">{{ $ejecucion->t9 }}</td>
            <td class="text-center">{{ $ejecucion->t10 }}</td>
            <td class="text-center">{{ $ejecucion->mo }}</td>
            <td>{{ $ejecucion->totrj }}</td>
            <td class="text-center">{{ $ejecucion->est1 }}</td>
            <td>{{ $ejecucion->est3 }}</td>
            <td class="text-center">{{ $ejecucion->tote }}</td>
        </tr>
                @php
                    $t1 =$t1+$ejecucion->t1  ;
                    $t2 =$t2+$ejecucion->t2;
                    $t3 =$t3+$ejecucion->t3;
                    $t4 = $t4+$ejecucion->t4;
                    $t5 =$t5+$ejecucion->t5;
                    $t6 = $t6+$ejecucion->t6;
                    $t7 =$t7+$ejecucion->t7;
                    $t8 = $t8+$ejecucion->t8;
                    $t9 = $t9+$ejecucion->t9;
                    $t10 = $t10+$ejecucion->t10;
                    $mo = $mo+$ejecucion->mo;
                    $totrj = $totrj+$ejecucion->totrj;
                    $est1 = $est1+$ejecucion->est1;
                    $est3 = $est3+$ejecucion->est3;
                    $tote = $tote+$ejecucion->tote;

                @endphp
    @endforeach
    <tr>
        <td colspan="1" class="text-right">TOTAL</td>
        <td class="text-center">{{$t1}}</td>
        <td class="text-center">{{$t2}}</td>
        <td class="text-center">{{$t3}}</td>
        <td class="text-center">{{$t4}}</td>
        <td class="text-center">{{$t5}}</td>
        <td class="text-center">{{$t6}}</td>
        <td class="text-center">{{$t7}}</td>
        <td class="text-center">{{$t8}}</td>
        <td class="text-center">{{$t9}}</td>
        <td class="text-center">{{$t10}}</td>
        <td class="text-center">{{$mo}}</td>
        <td class="text-center">{{$totrj}}</td>
        <td class="text-center">{{$est1}}</td>
        <td class="text-center">{{$est3}}</td>
        <td class="text-center">{{$tote}}</td>
    </tr>
    </tbody>


</table>
