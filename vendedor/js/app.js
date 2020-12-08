$(function() {
    $("#registros").DataTable({
        "responsive": true,
        "pageLength": 8,
        "autoWidth": false,
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        'language': {
            paginate: {
                next: '&raquo',
                previous: '&laquo',
                last: 'Ultimo',
                first: 'Primero'
            },
            info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
            // NO HAY REGISTROS
            emptyTable: 'No hay registros',
            infoEmpty: '0 Registros',
            // BUSCAR
            search: 'Buscar:'
        }
    });

    $('body').on('click', '.btnModificarCantidadPedido', function(e) {
        e.preventDefault()
        let cantidad = $(e.currentTarget).data('cantidad')
        let id_pedido = $(e.currentTarget).data('id-pedido')
        let id_producto = $(e.currentTarget).data('id-producto')
        $('#cantidad_producto').val(cantidad)
        $('#id_pedido').val(id_pedido)
        $('#id_producto').val(id_producto)
        $('#modificarDetallePedido').modal('show')
    })
});