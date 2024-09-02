<table>
    <thead>
    <tr>
        <th style="alignment: center">
            NOMBRE COMPLETO
        </th>
        <th>
            DNI
        </th>

        <th>
            OFICINA
        </th>
        <th>
            FECHA

        </th>
        <th>
            ASISTENCIA
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($asistencias as $asistencia)
        <tr>
            <td>{{ $asistencia->nomb }}</td>
            <td>{{ $asistencia->numeroDoc }}</td>
            <td>{{ $asistencia->dircont }}</td>
            <td>{{ $asistencia->dia }}</td>
            <td>  @if ($asistencia->atenc == 1)
                    <label class="text-primary">CONTROLADO</label>
                @else
                    <label class="text-primary">NO CONTROLADO</label>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
