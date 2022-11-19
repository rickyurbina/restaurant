
//variables
const btnAgrega = document.querySelector("#agregaProductoLista");
const pedido = document.getElementById("pedidoNum");
const proveedor = document.querySelector("#proveedor");
const concepto = document.querySelector("#concepto");
const fechaMovimiento = document.querySelector("#fechaMovimiento");
const idProducto = document.querySelector("#idProducto");


const lote = document.querySelector("#lote");
const cantidad = document.querySelector("#cantidad");
const medida = document.querySelector("#medida");
const precio = document.querySelector("#precio");

const formulario = document.forms['entradas'];

const productsTable = document.querySelector('#productsTable');

let productos = [];

//Event Listeners
eventListeners();

function eventListeners(){
    //cuando el usuario agrega un feature
    btnAgrega.addEventListener('click', agregaProducto);
    
    // cuando el documento esta listo despues de recargar
    // si el localStorege no se encuentra entonces inicializa con un arreglo vacio
    document.addEventListener('DOMContentLoaded', ()=>{
        //productos = JSON.parse( localStorage.getItem('productos')) || [];
        // console.log(features);
        //crearHTML();
    });
}



//funciones
function agregaProducto(e){
    e.preventDefault();
    const idProd = idProducto.options[idProducto.selectedIndex].value;
    const nomProducto = idProducto.options[idProducto.selectedIndex].text;
    const nomMedida = medida.options[medida.selectedIndex].text;
    const nomCantidad = cantidad.value;
    console.log(idProducto.value, idProd, nomProducto, lote.value, cantidad.value, medida.value, precio.value);

    if (lote.value === '' || nomProducto === ''){
        mostrarError('Complete los valores');
        return
    }

    const productosObj ={
        id: Date.now(),
        idProducto: idProd,
        producto: nomProducto,
        lote: lote.value,
        cantidad: nomCantidad,
        medida: nomMedida,
        precio: precio.value
    }

    //Añadir al arreglo de productos
    productos = [...productos, productosObj];

    crearHTML(nomProducto, nomMedida, nomCantidad);
    // reiniciar las cajas de texto 
    //featName.value = "";
    lote.value = "";
    
}

function mostrarError(error){
    const mensajeError = document.createElement('div');
    mensajeError.classList.add('alert','alert-secondary')
    mensajeError.textContent = error;
    //mensajeError.classList.add('');

    // Insertar el contenido
    const contenido = document.querySelector('#error');
    contenido.appendChild(mensajeError);

    setTimeout(()=>{
        mensajeError.remove();
    }, 3000);

    console.log(productos);
}


function crearHTML(nomProducto, nomMedida, nomCantidad){

    limpiarHTML();
    console.log(productos);
     if (productos.length > 0){
        productos.forEach( prod =>{        
            //creamos el renglon de la tabla
            let hilera = document.createElement("tr");
            
            let celdaProducto = document.createElement("td");
            let celdaLote = document.createElement("td");
            let celdaCantidad = document.createElement("td");
            let celdaPrecio = document.createElement("td");
            let celdaBtnBorrar = document.createElement("td");
            celdaBtnBorrar.classList.add('text-center');
            
            const btn = document.createElement("button");
            btn.classList.add('text-white');
            btn.classList.add('btn');
            btn.classList.add('btn-red');
            btn.classList.add('btn-sm');
            btn.innerHTML = '<i class="fa fa-trash"></i>';
            
            //añadimos la funcion de eliminar
            btn.onclick = () => {
                borrarFeature(prod.id); 
                console.log(prod.id);
             }

            celdaBtnBorrar.appendChild(btn);


            let txtProducto = document.createTextNode(prod.producto);            
            let txtLote = document.createTextNode(prod.lote);
            let txtPeso = document.createTextNode( prod.cantidad+ " " + prod.medida);
            let txtPrecio = document.createTextNode(prod.lote);

            celdaProducto.appendChild(txtProducto);
            celdaLote.appendChild(txtLote);
            celdaCantidad.appendChild(txtPeso);
            celdaPrecio.appendChild(txtPrecio);

            hilera.appendChild(celdaProducto);
            hilera.appendChild(celdaLote);
            hilera.appendChild(celdaCantidad);
            hilera.appendChild(celdaPrecio);
            hilera.appendChild(celdaBtnBorrar);

            productsTable.appendChild(hilera);

        });
    }

    sincronizarStorage();
}


function sincronizarStorage(){
    localStorage.setItem('productos', JSON.stringify(productos));
    // actualizamos el la caja de texto todas las features para ser insertadas en la BD
    // document.querySelector('#featuresBD').value = features;
    productosBD.value = JSON.stringify(productos);
}


function limpiarHTML(){
    while(productsTable.firstChild){
        productsTable.removeChild(productsTable.firstChild);
    }
}

//eliminar una feature de la lista

function borrarFeature(id){
    productos = productos.filter(producto => producto.id !== id);
    const nomProducto = idProducto.options[idProducto.selectedIndex].text;
    const nomMedida = medida.options[medida.selectedIndex].text;
    const nomCantidad = cantidad.value;
    crearHTML(nomProducto, nomMedida, nomCantidad);
}

