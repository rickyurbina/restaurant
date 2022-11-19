
//variables
const btnGuardar = document.querySelector('#btnGuardar');
const fechaMovimiento = document.querySelector("#fechaMovimiento");
const totalLabel = document.querySelector("#totalFactura");
const totalPedidoBD = document.querySelector('#totalPedidoBD');
const productosBD = document.querySelector('#productosBD');
const productsTable = document.querySelector('#productsTable');
const tablaResultados = document.querySelector('#tablaResultados'); //tabla completa de resultados
const productsSearch = document.querySelector('#productsSearch'); //lista de resultados de busqueda dentro de la tabla de resultados
const searchBox = document.querySelector('#searchBox');

let totalPedido = 0;

let productos = [];

//Event Listeners
eventListeners();

function eventListeners(){    
    // cuando el documento esta listo despues de recargar
    // si el localStorege no se encuentra entonces inicializa con un arreglo vacio
    document.addEventListener('DOMContentLoaded', ()=>{
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            $('#fechaMovimiento').datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom'
            });
            $('#fechaMovimiento').datepicker('setDate', today);

            tablaResultados.style.display = "none";
            btnGuardar.disabled = true;
        //productos = JSON.parse( localStorage.getItem('productos')) || [];
        // console.log(features);
        //crearHTML();
    });
}

//funciones =======================================================================================================================
function buscaJS(name) {
    if( name != "" ){
        fetchSearchData(name);
    }
    else{
      limpiarTablaResultados();
  
    }
  }
  
  
  function fetchSearchData(name){
      fetch('views/liveSearch.php', { // ubicacion del archivo que hace la consulta segun el nombre
          method: "POST",            // que le enviamos por metodo POST
          body: new URLSearchParams('name=' + name)
      })
      .then(res => res.json())
      .then(res => viewSearchResult(res))
      .catch(e => console.error('Error: ' + e))
  }

  function viewSearchResult(data){
    const lista = Object.entries(data).length;
    prodsResult = [];
   for (let i = 0; i < lista; i++){
       const productoObj ={
         id: Date.now()+i,
         idProducto: data[i]["idProducto"],
         nombre: data[i]["name"],
         disponible: data[i]["disponibilidad"],
         medida: data[i]["medida"],
         costo: data[i]["dayPrice"],
         cantidad: 0,
         medida: data[i]["medida"]
       }
 
     prodsResult = [...prodsResult, productoObj];
   
    }
    creaOpciones();
 
 }

 function creaOpciones(){
    limpiarTablaResultados();
    
    tablaResultados.style.display = "table";
    if (prodsResult.length > 0){
      prodsResult.forEach( ft =>{
  
        let renglon = document.createElement("tr");
        let btnColumn = document.createElement("td");
        let inputColumn = document.createElement("td");
        let inputField = document.createElement("input");
        inputField.style.width="40px";
        inputField.setAttribute('id', "cant"+ft.id);
        inputField.setAttribute('min', 1);
        inputField.setAttribute('max', ft.disponible);
        inputField.setAttribute('value', 1);
  
        inputColumn.appendChild(inputField);
  
        const btnAgrearAPedido = document.createElement('button');
              btnAgrearAPedido.classList.add('ml-auto');
              btnAgrearAPedido.classList.add('btn');
              btnAgrearAPedido.classList.add('btn-outline-primary');
              btnAgrearAPedido.classList.add('btn-sm');
              btnAgrearAPedido.innerText ='+';
  
        //añadimos la funcion de eliminar
        btnAgrearAPedido.onclick = () => {
          let cantidad = Number(document.querySelector("#cant"+ft.id).value);
          agregarProductoLista(ft, cantidad); 

          // let cantidad = Number(document.querySelector("#cant"+ft.id).value);
          // let disponible = Number(document.querySelector("#disp-"+ft.id).innerText);
  
          // if ( cantidad < 1 || cantidad > disponible ){
          //   mostrarError('La cantidad es incorrecta');
          //   return
          // }
          // else {
          //   agregarProductoLista(ft, cantidad); 
          // }
        }
  
  
        btnColumn.appendChild(btnAgrearAPedido);
  
        renglon.innerHTML = `
          <td>${ft.nombre}</td>
          <td id="disp-${ft.id}">${parseInt(ft.disponible)}</td>
          <td>${ft.costo}</td>
        `;
  
        renglon.appendChild(inputColumn);
        renglon.appendChild(btnColumn);
        
        productsSearch.appendChild(renglon);
  
      });
    }
  }

  function limpiarTablaResultados(){
    while(productsSearch.firstChild){
      productsSearch.removeChild(productsSearch.firstChild);
    }
    tablaResultados.style.display = "none";
  }

  function limpiarTablaProductos(){
    while(productsTable.firstChild){
      productsTable.removeChild(productsTable.firstChild);
    }
    tablaResultados.style.display = "none";
    //cajaBusquedaProducto.value = '';
  }

  function agregarProductoLista(productoAdd, nuevaCantidad){
    //Calcular y mostrar el total del pedido 
    totalPedido = totalPedido + (productoAdd.costo * nuevaCantidad);
    totalLabel.innerHTML = `$ ${totalPedido}`;
    totalPedidoBD.value = totalPedido;
    // cajaDescuento.value=0;
    // calculaDescuento(0);
    // botonCobrar();
  
    productoAdd.cantidad = nuevaCantidad;
    productos = [...productos, productoAdd];
    creaListaProductos(); 
  }
  
  function creaListaProductos(){
    limpiarTablaProductos();
    limpiarTablaResultados();
    if (productos.length > 0){
      btnGuardar.disabled = false;
      
      productos.forEach( prod =>{
        let renglon = document.createElement("tr");
        let btnColumn = document.createElement("td");
  
        const btnEliminarPedido = document.createElement('button');
        btnEliminarPedido.classList.add('ml-auto');
        btnEliminarPedido.classList.add('btn');
        btnEliminarPedido.classList.add('btn-outline-primary');
        btnEliminarPedido.classList.add('btn-sm');
        btnEliminarPedido.innerText ='X';
  
        //añadimos la funcion de eliminar
        btnEliminarPedido.onclick = () => {
          eliminarProductoPedido(prod.id); 
        }
  
        btnColumn.appendChild(btnEliminarPedido);
  
        renglon.innerHTML = `
          <td>${prod.nombre}</td>
          <td id="cant-${prod.id}">${prod.cantidad} ${prod.medida}</td>
          <td id="costo-${prod.id}">${prod.costo}</td>
        `;
  
        renglon.appendChild(btnColumn);
        productsTable.appendChild(renglon);
      });
    }
    else{
      btnGuardar.disabled = true;
    }
    
    sincronizarStorage();
    searchBox.value = '';
    searchBox.focus();
  }

  function sincronizarStorage(){
    localStorage.setItem('productos', JSON.stringify(productos));
    productosBD.value = JSON.stringify(productos);
}


function eliminarProductoPedido(id){
    const costoEliminar = document.querySelector("#costo-"+id).textContent;
    const cantEliminar =   document.querySelector("#cant-"+id).textContent;
    totalPedido = totalPedido - (parseInt(costoEliminar)* parseInt(cantEliminar));
  
    totalLabel.innerHTML = `$ ${totalPedido}`;
    totalPedidoBD.value = totalPedido;
    // cajaDescuento.value=0;
    // calculaDescuento(0);
    // botonCobrar();
  
    productos = productos.filter(prod => prod.id !== id);
    creaListaProductos();
  }

  function mostrarError(error){
    const mensajeError = document.createElement('div');
    mensajeError.classList.add('alert','alert-primary', 'text-center', )
    mensajeError.textContent = error;

    // Insertar el contenido
    const contenido = document.querySelector('#error');
    contenido.appendChild(mensajeError);
  
    setTimeout(()=>{
        mensajeError.remove();
    }, 3000);
  
  }

 // ====================================================================================================================================


// function agregaProducto(e){
//     e.preventDefault();
//     const idProd = idProducto.options[idProducto.selectedIndex].value;
//     const nomProducto = idProducto.options[idProducto.selectedIndex].text;
//     const nomMedida = medida.options[medida.selectedIndex].text;
//     const nomCantidad = cantidad.value;
//     console.log(idProducto.value, idProd, nomProducto, cantidad.value, medida.value, costo.value);

//     if (nomProducto === ''){
//         mostrarError('Complete los valores');
//         return
//     }

//     const productosObj ={
//         id: Date.now(),
//         idProducto: idProd,
//         producto: nomProducto,
//         cantidad: nomCantidad,
//         medida: nomMedida,
//         costo: costo.value
//     }

//     //Calcular y mostrar el total del pedido 
//     totalFactura = totalFactura + (costo.value * cantidad.value);
//     totalLabel.innerHTML = `$ ${totalFactura}`;
//     //totalPedidoBD.value = totalFactura;

//     //Añadir al arreglo de productos
//     productos = [...productos, productosObj];

//     crearHTML(nomProducto, nomMedida, nomCantidad);
//     // reiniciar las cajas de texto 
//     //featName.value = "";
//     // lote.value = "";
    
// }

// function mostrarError(error){
//     const mensajeError = document.createElement('div');
//     mensajeError.classList.add('alert','alert-secondary')
//     mensajeError.textContent = error;

//     //mensajeError.classList.add('');

//     // Insertar el contenido
//     const contenido = document.querySelector('#error');
//     contenido.appendChild(mensajeError);

//     setTimeout(()=>{
//         mensajeError.remove();
//     }, 3000);

//     console.log(productos);
// }


// function crearHTML(nomProducto, nomMedida, nomCantidad){

//     limpiarHTML();
//     console.log(productos);
//      if (productos.length > 0){
//         productos.forEach( prod =>{        
//             //creamos el renglon de la tabla
//             let hilera = document.createElement("tr");
            
//             let celdaProducto = document.createElement("td");
//             // let celdaLote = document.createElement("td");
//             let celdaCantidad = document.createElement("td");
//             let celdaCosto = document.createElement("td");
//             let celdaBtnBorrar = document.createElement("td");
//             celdaBtnBorrar.classList.add('text-center');
            
//             const btn = document.createElement("button");
//             btn.classList.add('text-white');
//             btn.classList.add('btn');
//             btn.classList.add('btn-red');
//             btn.classList.add('btn-sm');
//             btn.innerHTML = '<i class="fa fa-trash"></i>';
            
//             //añadimos la funcion de eliminar
//             btn.onclick = () => {
//                 borrarFeature(prod.id); 
//                 console.log(prod.id);
//              }

//             celdaBtnBorrar.appendChild(btn);


//             let txtProducto = document.createTextNode(prod.producto);            
//             let txtLote = document.createTextNode(prod.lote);
//             let txtPeso = document.createTextNode( prod.cantidad+ " " + prod.medida);
//             let txtCosto = document.createTextNode(prod.costo);

//             celdaProducto.appendChild(txtProducto);
//             // celdaLote.appendChild(txtLote);
//             celdaCantidad.appendChild(txtPeso);
//             celdaCosto.appendChild(txtCosto);

//             hilera.appendChild(celdaProducto);
//             // hilera.appendChild(celdaLote);
//             hilera.appendChild(celdaCantidad);
//             hilera.appendChild(celdaCosto);
//             hilera.appendChild(celdaBtnBorrar);

//             productsTable.appendChild(hilera);

//         });
//     }

//     sincronizarStorage();
// }





// function limpiarHTML(){
//     while(productsTable.firstChild){
//         productsTable.removeChild(productsTable.firstChild);
//     }
// }

// //eliminar una feature de la lista

// function borrarFeature(id){
//     productos = productos.filter(producto => producto.id !== id);
//     const nomProducto = idProducto.options[idProducto.selectedIndex].text;
//     const nomMedida = medida.options[medida.selectedIndex].text;
//     const nomCantidad = cantidad.value;
//     crearHTML(nomProducto, nomMedida, nomCantidad);
// }

