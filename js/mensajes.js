function desactivarEstado(i) {
    Swal.fire({
        text: '¿Desea eliminar el detalle Nº ' + (i) +
            ' de este pedido?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value == true) {
            Swal.fire({
                text: 'Detalle eliminado  correctamente',
                type: "success",
                showConfirmButton: true
            }).then(r => {
                document.getElementById('form-eliminarDetalle' + i).submit()

            })
        } else {
            Swal.fire({
                text: 'Se canceló la eliminación del detalle',
                type: "error",
                showConfirmButton: true
            })

        }
    })
    return false
}

function ConfirmarEliminacionDetalle(i) {
    Swal.fire({
        text: '¿Desea eliminar el detalle Nº ' + (i + 1) +
            ' de este pedido?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value == true) {
            Swal.fire({
                text: 'Detalle eliminado  correctamente',
                type: "success",
                showConfirmButton: true
            }).then(r => {
                document.getElementById('form-eliminarDetalle' + i).submit()

            })
        } else {
            Swal.fire({
                text: 'Se canceló la eliminación del detalle',
                type: "error",
                showConfirmButton: true
            })

        }
    })
    return false
}

function ConfirmarEliminacion(i) {
    Swal.fire({
        text: '¿Desea eliminar el producto?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value == true) {
            Swal.fire({
                text: 'Producto eliminado  correctamente',
                type: "success",
                showConfirmButton: true
            }).then(r => {
                document.getElementById('form-eliminar' + i).submit()
                    /*document.getElementById('form-eliminar').addEventListener('click', function() {
                        return true;
                    })*/
            })
        } else {
            Swal.fire({
                text: 'Se canceló la eliminación de su producto',
                type: "error",
                showConfirmButton: true
            })

        }
    })
    return false
}

function ConfirmarCancelacion() {
    Swal.fire({
        text: '¿Desea cancelar el pedido?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value == true) {
            Swal.fire({
                text: 'Pedido cancelado  correctamente',
                type: "success",
                showConfirmButton: true
            }).then(r => {
                document.getElementById('form-cancelarpedido').submit()

            })
        } else {
            Swal.fire({
                text: 'Operación cancelada',
                type: "error",
                showConfirmButton: true
            })

        }
    })
    return false
}



function LimpiarCarrito() {
    Swal.fire({
        text: '¿Desea eliminar todos los productos de su pedido?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value == true) {
            Swal.fire({
                text: 'Todos sus productos fueron eliminados',
                type: "success",
                showConfirmButton: true
            }).then(r => {
                document.getElementById('form-eliminar').submit()
            })
        } else {
            Swal.fire({
                text: 'Se canceló la eliminación de sus productos',
                type: "error",
                showConfirmButton: true
            })

        }
    })
    return false
}

function VerificarEnvioPedido() {
    Swal.fire({
        text: '¿Desea enviar su pedido?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value == true) {
            Swal.fire({
                text: 'Su pedido ha sido enviado correctamente',
                type: "success",
                showConfirmButton: true
            }).then(r => {
                document.getElementById('form-envio-pedido').submit()
            })
        } else {
            Swal.fire({
                text: 'Se canceló el envío de su Pedido',
                type: "error",
                showConfirmButton: true
            })

        }
    })
    return false
}

function ConfirmarAprobacion() {
    Swal.fire({
        text: '¿Desea aprobar este pedido?',
        type: 'success',
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value == true) {
            Swal.fire({
                text: 'Pedido aprobado correctamente',
                type: "success",
                showConfirmButton: true
            }).then(r => {
                document.getElementById('form-aprobarPedido').submit()
            })
        } else {
            Swal.fire({
                text: 'Se canceló aprobación  del pedido',
                type: "error",
                showConfirmButton: true
            })

        }
    })
    return false
}

function ConfirmarCVenta() {
    Swal.fire({
        text: '¿Desea cancelar la venta?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value == true) {
            Swal.fire({
                text: 'Venta cancelado  correctamente',
                type: "success",
                showConfirmButton: true
            }).then(r => {
                document.getElementById('form-cancelarventa').submit()

            })
        } else {
            Swal.fire({
                text: 'Operación cancelada',
                type: "error",
                showConfirmButton: true
            })

        }
    })
    return false
}

function ConfirmarVenta() {
    Swal.fire({
        text: '¿Desea registrar la venta?',
        type: 'success',
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value == true) {
            Swal.fire({
                text: 'Venta registrada correctamente',
                type: "success",
                showConfirmButton: true
            }).then(r => {

                document.getElementById('form-registrarventa').submit()

            })
        } else {
            Swal.fire({
                text: 'Se canceló la operación',
                type: "error",
                showConfirmButton: true
            })

        }
    })
    return false
}

function ConfirmarImportacion() {
    Swal.fire({
        text: '¿Desea importar los productos faltantes?',
        type: 'success',
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value == true) {
            Swal.fire({
                text: 'Productos para importar registrados',
                type: "success",
                showConfirmButton: true
            }).then(r => {
                document.getElementById('form-importarPedido').submit()
            })
        } else {
            Swal.fire({
                text: 'Se canceló la operación',
                type: "error",
                showConfirmButton: true
            })

        }
    })
    return false
}

function desactivarProducto(i) {
    Swal.fire({
        text: '¿Desea desactivar el producto Nº ' + (i + 1) +
            ' de esta lista?',
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value == true) {
            Swal.fire({
                text: 'Producto desactivado  correctamente',
                type: "success",
                showConfirmButton: true
            }).then(r => {
                document.getElementById('form-DesactivarProducto' + i).submit()

            })
        } else {
            Swal.fire({
                text: 'Se canceló la desactivación del producto',
                type: "error",
                showConfirmButton: true
            })

        }
    })
    return false
}

function activarProducto(i) {
    Swal.fire({
        text: '¿Desea activar el producto Nº ' + (i + 1) +
            ' de esta lista?',
        type: 'success',
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.value == true) {
            Swal.fire({
                text: 'Producto activado  correctamente',
                type: "success",
                showConfirmButton: true
            }).then(r => {
                document.getElementById('form-activarProducto' + i).submit()

            })
        } else {
            Swal.fire({
                text: 'Se canceló la activación del producto',
                type: "error",
                showConfirmButton: true
            })

        }
    })
    return false
}