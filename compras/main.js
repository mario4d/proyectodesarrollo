console.log('script funcionando');

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