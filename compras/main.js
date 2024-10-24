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

document.getElementById('enviar').addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();

    let idcompra = document.getElementById('idcompra');
    let idproducto = document.getElementById('idproducto');
    let cantidad = document.getElementById('cantidad');
    let precio = document.getElementById('precio');
    let idproveedor = document.getElementById('idproveedor');
    let iddepartamento = document.getElementById('iddepartamento');
    let detalle = document.getElementById('detalle');

    let data = new FormData();
    data.append('idcompra', idcompra);
    data.append('idproducto', idproducto);
    data.append('cantidad', cantidad);
    data.append('precio', precio);
    data.append('idproveedor', idproveedor);
    data.append('iddepartamento', iddepartamento);
    data.append('detalle', detalle);

    fetch('./l_compras.php', {method: 'POST', body: data})
        .then(function(res) { return res.json } )
        .then(function(data) {
            console.log(data);
        })
        .catch(error => { console.error('hubo un error: ', error) });
    
});


//const selectDep = document.getElementById('iddepartamento')
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


document.getElementById('buscar-producto').addEventListener('click', function(e){
    e.preventDefault();
    e.stopPropagation();

    const inputBuscar = document.getElementById('idproducto');
    let data = new FormData();
    data.append('idproducto', inputBuscar.value);
    fetch('./php/l_busquedaProducto.php', { method: 'POST', body: data })
        .then( function(res) { return res.json() })
        .then( function(datar) {
            console.log(datar);

            nombrepr.innerHTML += datar[0].Nombre_Producto;
            preciopr.innerHTML += datar[0].Precio_Producto;
            departamento.innerHTML += datar[0].Codigo;

        })
        .catch( error => { console.error('Hubo un error: ', error)} );
});