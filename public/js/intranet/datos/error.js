var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function () {

});
$(function(){
    $('#tabla_error').DataTable({
        ajax: '/errores',
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        processing: true,
        serverSide: false,
        ordering: false,
        select: true,
        destroy: true,
        responsive: true,
        bAutoWidth: true,
        dom: 'lBfrtip',
        buttons: [
            'excel'
        ],
        columnDefs: [
            {"targets": 0, "width": "60%", "className": "text-left"},
            {"targets": 1, "width": "5%", "className": "text-center"},
            {"targets": 2, "width": "5%", "className": "text-center"},
            {"targets": 3, "width": "3%", "className": "text-center"},
            {"targets": 5, "width": "3%", "className": "text-center"},
        ],

        columns: [
            {data: 'eDescripcion', name: 'eDescripcion'},
            {data: 'eClase', name: 'eClase'},
            {data: 'eMetodo', name: 'eMetodo'},
            {data: 'eFecCrea', name: 'eFecCrea'},
            {
                data: function (row) {
                    return parseInt(row.eEst) === 0 ? '<span class="text-success">ATENDIDO</span>' : '<span class="text-danger">PENDIENTE</span>'

                }
            },
            {
                data: function (row) {
                    if (parseInt(row.eEst) === 1) {
                        return '<tr >\n' +
                            '<a href="#" style="color: #ff0000" TITLE="Solucionar Error" onclick="eliminarError(' + row.eId + ')">' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-times"> </i></a>\n' +
                            '</tr>';
                    } else {
                        return '<tr >\n' +
                            '<a href="#" style="color: green" TITLE="Error no Solucionado" onclick="eliminarError(' + row.eId + ')">\n' +
                            '<i class="fas fa-lg fa-fw m-r-10 fa-check"> </i></a>\n' +
                            '</tr>';
                    }
                }
            },

        ]
    })
});

function eliminarError(iderr) {
    console.log(iderr);
    var url = "/deleteError/" + iderr;
    Swal.fire({
        title: 'Esta seguro(a)?',
        text: 'Se solucionó/queda pendiente este registro',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto',
        cancelButtonText: 'no, cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax(
                {
                    type: "GET",
                    url: url,
                    cache: false,
                    dataType: 'json',
                    data: '_token = <?php echo csrf_token() ?>',
                    success: function (data) {
                        if (data['error'] === 0) {
                            redirect('/error');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                type: 'success',
                                title: 'Error Atendido/Pendiente correctamente!',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        } else {
                            redirect('/error');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                type: 'error',
                                title: 'ocurrio un error!',
                                text: data['error'],
                                showConfirmButton: false,
                                timer: 3000
                            });

                        }
                    }

                });

        }
    })
}
