//Edicion de Pedidos de productos 
const productsTable = document.querySelector("#productsTable");
const listaPedido = document.querySelector("#listaPedido");
const totalLabel = document.querySelector("#totalPedido");
const productosDelPedido = document.querySelector("#pedidoBD");
const totalPedidoBD = document.querySelector("#totalPedidoBD");
const eliminadosBD = document.querySelector('#eliminadosBD');

let listaProds = [];
let pedido = [];
let totalPedido = parseFloat(totalPedidoBD.value);
let eliminados = [];

// al terminar de cargar el documento creo el Storage y Cargo el pedido en la tabla
document.addEventListener('DOMContentLoaded', ()=>{

  localStorage.setItem('pedido', productosDelPedido.value);
  totalLabel.innerHTML = `$ ${totalPedidoBD.value}`;

  pedido = JSON.parse( localStorage.getItem('pedido')) || [];
  // console.log(features);
  creaListaPedido();
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



function viewSearchResult(data){
  //console.log(data);
   const lista = Object.entries(data).length;

  limpiarTablaResultados();
  listaProds = [];
  for (let i = 0; i < lista; i++){
      const productoObj ={
        id: Date.now()+i,
        idProducto: data[i]["idProducto"],
        nombre: data[i]["name"],
        producto: data[i]["name"],
        lote: data[i]["lote"],
        disponible: data[i]["disponible"],
        precio: data[i]["dayPrice"],
        cantidad: 0,
        medida: data[i]["medida"]
      }

    // //Añadir al arreglo de features
    listaProds = [...listaProds, productoObj];
  
   } //for
   creaOpciones();

}

function creaOpciones(){
  if (listaProds.length > 0){
    listaProds.forEach( ft =>{
      ///   crea los elementos necesarios para la tabla de resultados del LiveSearch

      let renglon = document.createElement("tr");
      let btnColumn = document.createElement("td");
      let inputColumn = document.createElement("td");
      let inputField = document.createElement("input");
      inputColumn.style.width="40px";
      inputField.setAttribute('id', "cant"+ft.id);
      inputField.setAttribute('min', 1);
      inputField.setAttribute('max', ft.disponible);
      inputField.setAttribute('value', 0);


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
        agregarProductoLista(ft, cantidad); 
      }


      btnColumn.appendChild(btnAgrearAPedido);
      //console.log(ft);
      renglon.innerHTML = `
        <td>${ft.nombre}</td>
        <td>${ft.lote}</td>
        <td>${ft.disponible}</td>
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
}

function agregarProductoLista(producto, nuevaCantidad){

  //Calcular y mostrar el total del pedido 
  totalPedido = totalPedido + (producto.precio * nuevaCantidad);
  totalLabel.innerHTML = `$ ${totalPedido}`;
  totalPedidoBD.value = totalPedido;

  producto.cantidad = nuevaCantidad;
  pedido = [...pedido, producto];
  //console.log(pedido);
  creaListaPedido(); 
}

function creaListaPedido(){
  limpiarTablaPedidos();
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
        <td>${prod.producto}</td>
        <td>${prod.lote}</td>
        <td id="precio-${prod.id}">${prod.precio}</td>
        <td id="cant-${prod.id}">${prod.cantidad}</td>
      `;

      //renglon.appendChild(inputColumn);
      renglon.appendChild(btnColumn);
      
      // Agregar los datos del producto correspondiente a la tabla de lista de pedido
      listaPedido.appendChild(renglon);
    });
  }
  limpiarTablaResultados();
  sincronizarStorage();
  document.getElementById("searchBox").focus();
  
}

function limpiarTablaPedidos(){
  while(listaPedido.firstChild){
    listaPedido.removeChild(listaPedido.firstChild);
  }
}

function eliminarProductoPedido(id){
  const precioEliminar = document.querySelector("#precio-"+id).textContent;
  const cantEliminar =   document.querySelector("#cant-"+id).textContent;
  totalPedido = totalPedido - (parseFloat(precioEliminar)* parseFloat(cantEliminar));

  //Calcular y mostrar el total del pedido 
  // totalPedido = totalPedido - (precioEliminar * cantEliminar);
  // console.log(precioEliminar +" * "+ cantEliminar + " = " + totalPedido)
  totalLabel.innerHTML = `$ ${totalPedido}`;
  totalPedidoBD.value = totalPedido;

  // Producto eliminado
  const eliminado = pedido.filter(prod => prod.id === id);
  
  eliminados = [...eliminados, eliminado];
  eliminadosBD.value = eliminados;

  console.log(eliminados);

  //se quita el producto del arreglo 
  pedido = pedido.filter(prod => prod.id !== id);
  // se llama la funcion para crear la lista de productos del pedido nuevamente
  creaListaPedido();
  
  
}


function sincronizarStorage(){
  localStorage.setItem('pedido', JSON.stringify(pedido));
    // actualizamos el la caja de texto todas las features para ser insertadas en la BD
    pedidoBD.value = JSON.stringify(pedido);
}