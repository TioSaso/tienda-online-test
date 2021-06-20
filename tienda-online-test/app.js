const items = document.getElementById('items')
const templateCard = document.getElementById('template-card').content
const fragment = document.createDocumentFragment()

document.addEventListener("DOMContentLoaded", function(event) {
    ajax();
    fetchData();
  });

/**
 * Realiza la ejecucion del archivo PHP
 **/
function ajax(){
    const http = new XMLHttpRequest();
    const url = 'conexion.php';
    http.onreadystatechange= function(){
        if(this.readyState==4 && this.status == 200){
            console.log('Peticion Terminada');
        }
    }
    http.open("GET", url);
    http.send();
}
/**
 * Realiza la toma de los datos desde el JSON
 **/
const fetchData = async ($datos) => {
    try{
        const res = await fetch('api.json')
        const data= await res.json()
        rellenarCards(data);
    }catch(error){
        console.log(error)
    }
}

/**
 * Toma el template de las CARDS para rellenarlas con los datos del JSON
 **/
const rellenarCards = data => {
    data.forEach( producto =>{
        templateCard.querySelector('img').setAttribute('src', producto.image_product)
        templateCard.querySelector('h5').textContent = producto.name_product
        templateCard.querySelector('h6').textContent = producto.name_category
        templateCard.querySelector('p').textContent = '$'+producto.price
        const clone = templateCard.cloneNode(true)
        fragment.appendChild(clone);
    })
    items.appendChild(fragment)
}
/**
 * Toma los datos provenientes del filtrador y los compara
 * con los datos existentes en las CARD
 **/
function busquedaProducto(){
    const input = document.getElementById('filter').value.toUpperCase();
    const cardContainer = document.getElementById('card-lists');
    const cards = cardContainer.getElementsByClassName('card');
    for(let i= 0; i< cards.length; i++){
        let title = cards[i].querySelector(".card-body h5.card-title");
        if(title.innerText.toUpperCase().indexOf(input)>-1){
            cards[i].style.display= "";
        }else{
            cards[i].style.display= "none";
        }
    }
}
