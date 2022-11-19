//Registro de Pedidos de productos
const productsTable = document.querySelector("#productsTable");
const listaPedido = document.querySelector("#listaPedido");
const totalLabel = document.querySelector("#totalPedido");
const totalPedidoBD = document.querySelector("#totalPedidoBD");
const tablaResultados = document.querySelector('#tablaResultados');
const cajaCodigoBarras = document.querySelector('#searchCode');
const cajaBusquedaProducto = document.querySelector('#searchBox');
const cajaDescuento = document.querySelector('#descuento');
const cajaValorDescuento = document.querySelector('#valorDescuento');
const cajaTotalNeto = document.querySelector('#pedidoNeto');
const btnCobrar = document.querySelector('#btnCobrar');

btnCobrar.disabled = true;
tablaResultados.style.display = "none";

let listaProds = []; // opciones despues de busqueda por nombre
let pedido = [];  // total de articulos de la venta
let totalPedido = 0;

//Asignamos la fecha de hoy al datepicker del formulario
$(document).ready(function() {
  var date = new Date();
  var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

  $('#fechaMovimiento').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom'
  });

  $('#fechaMovimiento').datepicker('setDate', today);

});


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


//busca codigo de barras   ================================================================================================
function buscaCodigo(name){
  if (name !== ''){
      fetch('views/codeSearch.php', { // ubicacion del archivo que hace la consulta segun el nombre
          method: "POST",            // que le enviamos por metodo POST
          body: new URLSearchParams('name=' + name)
      })
      .then(res => res.json())
      .then(res => verCodigos(res))
      .catch(e => console.error('Error: ' + e))
    }
  }
  


function verCodigos(data){
  //  console.log(data[0]);
  const cantidad = 1;
  const cantProductos = pedido.length;
  // console.log(pedido);
  // console.log(cantProductos);
  let agrega = true;

  if (cantProductos > 0 ){
    for (const i of pedido) {
      if (i.idProducto == data[0]["idProducto"]) 
      {
        i.cantidad = i.cantidad + 1;
        agrega = false;
        totalPedido = totalPedido + (data[0]["dayPrice"]);
        totalLabel.innerHTML = `$ ${totalPedido}`;
        totalPedidoBD.value = totalPedido;
        cajaDescuento.value=0;
        calculaDescuento(0);
        botonCobrar();
      }
    }
  } 
  
  if (agrega){
    const productoObj ={
      id: Date.now(),
      idProducto: data[0]["idProducto"],
      nombre: data[0]["name"],
      disponible: data[0]["disponibilidad"],
      medida: data[0]["medida"],
      precio: data[0]["dayPrice"],
      cantidad: 1 ,
      medida: data[0]["medida"]
    }
    agregarProductoLista(productoObj, cantidad);    
  }
  creaListaPedido(); 

}
//=========================================================================================================================
function viewSearchResult(data){
   const lista = Object.entries(data).length;

  listaProds = [];
  for (let i = 0; i < lista; i++){
      const productoObj ={
        id: Date.now()+i,
        idProducto: data[i]["idProducto"],
        nombre: data[i]["name"],
        disponible: data[i]["disponibilidad"],
        precio: data[i]["dayPrice"],
        cantidad: 0,
        medida: data[i]["medida"]
      }

    listaProds = [...listaProds, productoObj];
  
   }
   creaOpciones();

}

function creaOpciones(){
  limpiarTablaResultados();
  
  tablaResultados.style.display = "table";
  if (listaProds.length > 0){
    listaProds.forEach( ft =>{

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
        let cantidad = document.querySelector("#cant"+ft.id).value;

        if (cantidad < 1){
          mostrarError('La cantidad es incorrecta');
          return
        }
        else agregarProductoLista(ft, cantidad); 
        //liveUpdate(ft.id, cantidad);
      }


      btnColumn.appendChild(btnAgrearAPedido);

      renglon.innerHTML = `
        <td>${ft.nombre}</td>
        <td>${parseInt(ft.disponible)}</td>
        <td>${ft.precio}</td>
      `;

      renglon.appendChild(inputColumn);
      renglon.appendChild(btnColumn);
      
      productsTable.appendChild(renglon);

    });
  }
}


function limpiarTablaResultados(){
  while(productsTable.firstChild){
    productsTable.removeChild(productsTable.firstChild);
  }
  tablaResultados.style.display = "none";
}


function agregarProductoLista(producto, nuevaCantidad){

  //Calcular y mostrar el total del pedido 
  totalPedido = totalPedido + (producto.precio * nuevaCantidad);
  totalLabel.innerHTML = `$ ${totalPedido}`;
  totalPedidoBD.value = totalPedido;
  cajaDescuento.value=0;
  calculaDescuento(0);
  botonCobrar();

  producto.cantidad = nuevaCantidad;
  pedido = [...pedido, producto];
  creaListaPedido(); 
}

function creaListaPedido(){
  limpiarTablaPedidos();
  limpiarTablaResultados();
  if (pedido.length > 0){
    
    pedido.forEach( prod =>{
      let renglon = document.createElement("tr");
      let btnColumn = document.createElement("td");

      const btnAgrearAPedido = document.createElement('button');
      btnAgrearAPedido.classList.add('ml-auto');
      btnAgrearAPedido.classList.add('btn');
      btnAgrearAPedido.classList.add('btn-outline-primary');
      btnAgrearAPedido.classList.add('btn-sm');
      btnAgrearAPedido.innerText ='X';

      //añadimos la funcion de eliminar
      btnAgrearAPedido.onclick = () => {
        eliminarProductoPedido(prod.id); 
      }

      btnColumn.appendChild(btnAgrearAPedido);

      renglon.innerHTML = `
        <td>${prod.nombre}</td>
        <td id="precio-${prod.id}">${prod.precio}</td>
        <td id="cant-${prod.id}">${prod.cantidad} ${prod.medida}</td>
      `;

      renglon.appendChild(btnColumn);
      listaPedido.appendChild(renglon);
    });
  }
  
  sincronizarStorage();
  cajaCodigoBarras.value = '';
  cajaCodigoBarras.focus();
}

function limpiarTablaPedidos(){
  while(listaPedido.firstChild){
    listaPedido.removeChild(listaPedido.firstChild);
  }
  tablaResultados.style.display = "none";
  cajaBusquedaProducto.value = '';
}

function eliminarProductoPedido(id){
  const precioEliminar = document.querySelector("#precio-"+id).textContent;
  const cantEliminar =   document.querySelector("#cant-"+id).textContent;
  totalPedido = totalPedido - (parseInt(precioEliminar)* parseInt(cantEliminar));

  totalLabel.innerHTML = `$ ${totalPedido}`;
  totalPedidoBD.value = totalPedido;
  // cajaDescuento.value=0;
  // calculaDescuento(0);
  // botonCobrar();

  pedido = pedido.filter(prod => prod.id !== id);
  creaListaPedido();
}


function sincronizarStorage(){
  localStorage.setItem('pedido', JSON.stringify(pedido));
    // actualizamos el la caja de texto todas las features para ser insertadas en la BD
    pedidoBD.value = JSON.stringify(pedido);
}

function mostrarError(error){
  const mensajeError = document.createElement('div');
  mensajeError.classList.add('alert','alert-primary', 'text-center', )
  mensajeError.textContent = error;

  //mensajeError.classList.add('');

  // Insertar el contenido
  const contenido = document.querySelector('#error');
  contenido.appendChild(mensajeError);

  setTimeout(()=>{
      mensajeError.remove();
  }, 3000);

}

function calculaDescuento(descuento){
  if (descuento>=0 && descuento < 100) 
  {
    let valorDescuento = totalPedido * parseInt(descuento)/100;
    let totalNeto = totalPedido - valorDescuento;

    cajaTotalNeto.value = totalNeto;
    cajaValorDescuento.value = valorDescuento;
    totalLabel.innerHTML = `$ ${totalNeto}`;
    totalPedidoBD.value = totalPedido;
  }
  else
  {
    cajaDescuento.value = 0;
  }
}

function botonCobrar(){
  if(totalPedido>0) btnCobrar.disabled = false;
  else btnCobrar.disabled = true;
}