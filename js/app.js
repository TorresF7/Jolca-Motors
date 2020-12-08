var inputCalcularSub = document.getElementById('cantidad-prod');
var divSubtotal = document.getElementById('div-subtotal');
var nuevoSubtotal = document.createElement('div');



eventListeners();

function eventListeners() {
    inputCalcularSub.addEventListener("blur", calcularSubtotal);
}


// CALCULAR SUBTOTAL
function calcularSubtotal() {

    if (this.value % 1 !== 0) {

        swal({
            type: 'info',
            icon: 'info',
            text: 'Ingrese un valor entero'
        })

        btnAgregarCarrito.disabled = true;
        nuevoSubtotal.innerText = '';

    }
    else if (this.value === '' || (this.value <= 0)) {

        swal({
            type: 'info',
            icon: 'info',
            text: 'Ingrese un valor mayor a 0'
        })

        btnAgregarCarrito.disabled = true;
        nuevoSubtotal.innerText = '';

    } else {
        let cantidad = document.getElementById('cantidad-prod').value;
        let precio = document.getElementById('precio').value;
        let stock = document.getElementById('stock').textContent;
        let pegar = document.querySelector('.div-subtotal');

        stock = Number(stock);
        cantidad = Number(cantidad);


        if (stock >= cantidad) {
            let resultado = cantidad * precio;
            resultado = Number(resultado.toFixed(2));

            nuevoSubtotal.id = 'subtotal';
            nuevoSubtotal.classList.add('subtotal')
            nuevoSubtotal.setAttribute("name", "subtotal");;
            nuevoSubtotal.innerHTML = `S/${resultado.toFixed(2)}`;
            divSubtotal.firstChild.remove();
            pegar.appendChild(nuevoSubtotal);
            btnAgregarCarrito.disabled = false;

        } else {
            swal({
                type: 'info',
                icon: 'info',
                text: 'Ingrese un valor menor a la cantidad disponible'
            })
            nuevoSubtotal.innerText = '';
            btnAgregarCarrito.disabled = true;

        }
    }
}