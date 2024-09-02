$(document).ready(function () {
    cargarDatos();
});

function cargarDatos() {

    var idpaciente = $('#idpaciente').val();
    var url = "/covid/obtenerpacientecoviddidpaciente/" + idpaciente;
    var text;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result = data['result'];

                    $('#dni').val(result['numeroDoc']).prop("disabled", true);
                    $('#nombres').val(result['apPaterno']+' '+result['apMaterno']+', '+result['pNombre']+' '+result['sNombre']);
                    $('#fecnac').val(result['fecNac']).prop("disabled", true);
                    $('#telefo').val(result['telefono']).prop("disabled", true);
                    $('#dir').val(result['pedir']).prop("disabled", true);
                    $('#fecdiag').val(result['fecExamen']).prop("disabled", true);
                    $('#fecsinini').val(result['fecSintIni']).prop("disabled", true);
                    $('#ref').val(result['referencia']).prop("disabled", true);
                    completarDis(result['dispe'],'lugna');
                    $('#lugcont').val(result['dircont']);
                    estPrueba(result['estadoPrueba']);
                    llenarMorbilidad(idpaciente);
                } else {

                }
            }

        });

}
function completarDis(iddisval,idinp) {
 //   bloquear();
    var url = "/obtenerubicacion/" + iddisval;
    var arreglo='';
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    arreglo = data['ubic'];
                   $('#'+idinp).val(arreglo['depdescripcion'] +' - ' + arreglo['prodescripcion']  +' - ' + arreglo['disdescripcion'] );
                   // desbloquear();
                } else {
                }
            }

        });
}

function estPrueba(idesprueb) {
    var arrayPrueba = [];
    $("#estprueb option").each(function () {
        arrayPrueba.push($(this).text());
    });
    var select = $('#estprueb').html('');
    var htmla = '';
    for (var i = 0; i < arrayPrueba.length; i++) {
        if (i === idesprueb) {
            htmla = '<option  selected disabled="">' + arrayPrueba[i] + '</option>';
            break;
        }
    }
    select.append(htmla).prop("disabled", true);
}
function llenarMorbilidad(idpaciente) {
    $('#morbilidad').prop("disabled", true);
    var  hrefclic= $('#addmorbilidad');
    hrefclic.removeAttr('href');
    hrefclic.attr("onclick", "").unbind("click");
    var url = "/covid/morbililista/" + idpaciente;
    $.ajax(
        {
            type: "GET",
            url: url,
            cache: false,
            dataType: 'json',
            data: '_token = <?php echo csrf_token() ?>',
            success: function (data) {
                if (data['error'] === 0) {
                    var result=data['result'];
                    var listacontact = $('#lista').html('');
                    var htmla = '', html = '';
                    for (var i = 0; i < result.length; i++) {
                        htmla = '<li > <strong>-</strong> ' + result[i]['descripcion'] + '</li>';
                        html = htmla + html;
                    }
                    listacontact.append(html);
                } else {

                }
            }

        });
}
