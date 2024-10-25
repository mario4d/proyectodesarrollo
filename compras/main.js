console.log('script funcionando');

// INPUTS DEL FORMULARIO
const idproducto = document.getElementById('idproducto');
const detalle = document.getElementById('detalle');
const cantidad = document.getElementById('cantidad');

// DIVs PARA MOSTRAR
const nombrepr = document.getElementById('mostrar-nombrepr');
const preciopr = document.getElementById('mostrar-preciopr');
const proveedor = document.getElementById('mostrar-proveedor');
const departamento= document.getElementById('mostrar-departamento');

// document.getElementById('enviar').addEventListener('click', function(e) {
//     e.preventDefault();
//     e.stopPropagation();

//     let idcompra = document.getElementById('idcompra');
//     let idproducto = document.getElementById('idproducto');
//     let cantidad = document.getElementById('cantidad');
//     let precio = document.getElementById('precio');
//     let idproveedor = document.getElementById('idproveedor');
//     let iddepartamento = document.getElementById('iddepartamento');
//     let detalle = document.getElementById('detalle');

//     let data = new FormData();
//     data.append('idcompra', idcompra);
//     data.append('idproducto', idproducto);
//     data.append('cantidad', cantidad);
//     data.append('precio', precio);
//     data.append('idproveedor', idproveedor);
//     data.append('iddepartamento', iddepartamento);
//     data.append('detalle', detalle);

//     fetch('./l_compras.php', {method: 'POST', body: data})
//         .then(function(res) { return res.json } )
//         .then(function(data) {
//             console.log(data);
//         })
//         .catch(error => { console.error('hubo un error: ', error) });
    
// });


// const selectDep = document.getElementById('iddepartamento')
// document.addEventListener('DOMContentLoaded', function(e) {

//     fetch('./php/l_selectDepartamento.php')
//         .then( function(res) { return res.json() })
//         .then( function(data) {

//             data.forEach(opcion => {
//                 const optionElement = document.createElement('option'); // Crear un nuevo elemento <option>
//                 optionElement.value = opcion.ID_Departamento; // Asignar el valor
//                 optionElement.textContent = opcion.Nombre_Departamento; // Asignar el texto que se mostrará
//                 selectDep.appendChild(optionElement); // Agregar la opción al <select>
//             });

//         })
//         .catch(error => { console.error('Hubo un error: ', error)});

// });


document.addEventListener("DOMContentLoaded", function() {
    // Desplegar lista de solicitudes recibidas
    const resultados = ['Item 1', 'Item 2', 'Item 3', 'Item 4', 'hola2'];

    const lista = document.getElementById("lista");
    const formularioCompras = document.getElementById("formularioCompra");

    // Generar la lista a partir de los resultados
    resultados.forEach(item => {
        const li = document.createElement('li');
        li.textContent = item;
        li.style.cursor = 'pointer'; // Para indicar que es seleccionable
        li.onclick = function() {
            mostrarFormulario(item);
        };
        lista.appendChild(li);
    });

    function mostrarFormulario(item) {
        // Generar el formulario usando innerHTML
        formularioCompras.innerHTML = `
            <h3>Formulario para ${item}</h3>
            <form id="miFormulario">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <br>
                <button type="submit">Enviar</button>
            </form>
        `;
    }
});




// document.getElementById('buscar-producto').addEventListener('click', function(e){
//     e.preventDefault();
//     e.stopPropagation();

//     const inputBuscar = document.getElementById('idproducto');
//     let data = new FormData();
//     data.append('idproducto', inputBuscar.value);
//     fetch('./php/l_busquedaProducto.php', { method: 'POST', body: data })
//         .then( function(res) { return res.json() })
//         .then( function(datar) {
//             console.log(datar);

//             nombrepr.innerHTML += datar[0].Nombre_Producto;
//             preciopr.innerHTML += datar[0].Precio_Producto;
//             departamento.innerHTML += datar[0].Codigo;

//         })
//         .catch( error => { console.error('Hubo un error: ', error)} );
// });