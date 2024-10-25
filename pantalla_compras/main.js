console.log('script funcionando');

function selectProveedor() {
    const selectProv = document.getElementById('proveedorProducto')
    fetch('./php/l_busquedaProveedores.php')
        .then( function(res) { return res.json() })
        .then( function(data) {
            console.log(data);
            data.forEach(opcion => {
                const optionElement = document.createElement('option'); // Crear un nuevo elemento <option>
                optionElement.value = opcion.ID_Proveedor; // Asignar el valor
                optionElement.textContent = opcion.Nombre_Proveedor; // Asignar el texto que se mostrará
                selectProv.appendChild(optionElement); // Agregar la opción al <select>
            });

        })
        .catch(error => { console.error('Hubo un error: ', error)});

}

document.addEventListener("DOMContentLoaded", function() {
    const lista = document.getElementById("lista");
    const formularioCompras = document.getElementById("formularioCompra");

    fetch('./php/l_busquedaSolicitudes.php')
        .then( function(res) { return res.json() })
        .then( function(data) {
            console.log(data);
            data.forEach(opcion => {
                const li = document.createElement('li');
                li.style.cursor = 'pointer';
                li.textContent = `Solicitud ${opcion.ID_Solicitud}`;
                li.onclick = function() { mostrarFormulario(opcion.ID_Solicitud, opcion.Nombre_Departamento, opcion.Descripcion_Solicitud, opcion.Cantidad_Solicitada, opcion.ID_Departamento); };
                lista.appendChild(li);
            });
        })
        .catch(error => { console.error('Hubo un error: ', error)});

    function mostrarFormulario(item, dep, det, cant, idDep) {
        formularioCompras.innerHTML = `
            <h3>Solicitud ${item}</h3>
            <div class="formCompra" id="miFormulario">
                <label class="formItemCompra">Departamento: </label>
                <input type="text" id="idDepartamento" value="${dep}" disabled>

                <label class="formItemCompra">Detalle de solicitud: </label>
                <input type="text" id="detalleSolicitud" value="${det}" disabled>

                <label class="formItemCompra">Cantidad solicitada: </label>
                <input type="text" id="cantidadProducto" value="${cant}" disabled>

                <br>

                <label for="nombreProducto">Nombre del producto</label>
                <input type="text" id="nombreProducto" required>
                
                <label for="inPrecioProducto">Precio</label>
                <input type="text" id="inPrecioProducto">
                
                <label for="detalleCompra">Detalle de compra (Marca, Modelo)</label>
                <input type="text" id="detalleCompra">
                
                <label for="proveedorProducto">Proveedor</label>
                <select id="proveedorProducto">
                    <option value="" selected disabled>Seleccione un proveedor</option>
                </select>
                
                <label class="formItemCompra">Total de la compra: </label>
                <input type="text" id="totalCompra" disabled>
                <button type="submit" id="botonComprar">Comprar</button>
            </div>
        `;

        document.getElementById('inPrecioProducto').addEventListener('input', function(e) {
            const total = document.getElementById('totalCompra');
            const precioUnitario = parseFloat(document.getElementById('inPrecioProducto').value);
            const cantidadProducto = parseInt(cant);
            const totalFinal = precioUnitario * cantidadProducto;
            total.value = totalFinal.toFixed(2); // Redondeo a dos decimales si es necesario
        })
        
        
        selectProveedor()

        document.getElementById('botonComprar').addEventListener('click', function(e) {
            e.stopPropagation();
            e.preventDefault();

            let cantidadProd = document.getElementById('cantidadProducto').value;
            let precioProd = document.getElementById('inPrecioProducto').value;
            let proveedorProd = document.getElementById('proveedorProducto').value;
            let idDepto = idDep;

            let detalleCompra = document.getElementById('detalleCompra').value + ', ' + document.getElementById('nombreProducto').value;
            let idSolici = item;
            let totalProd = document.getElementById('totalCompra').value;
        
            let data = new FormData();
            data.append('cantidadProd', cantidadProd);
            data.append('precioProd', precioProd);
            data.append('proveedor', proveedorProd);
            data.append('idDepartamento', idDepto);
            data.append('detalleCompra', detalleCompra);
            data.append('idSolicitud', idSolici);
            data.append('totalProducto', totalProd);

            console.log(detalleCompra);
            

        
            fetch('./php/l_insertarCompras.php', {method: 'POST', body: data})
                .then(function(res) { return res.json } )
                .then(function(data) {
                    console.log(data);
                    location.reload();
                })
                .catch(error => { console.error('hubo un error: ', error) });
        });
    }
});