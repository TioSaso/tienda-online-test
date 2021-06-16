const items = document.getElementById('items')
const templateCard = document.getElementById('template-card').content
const fragment = document.createDocumentFragment()

document.addEventListener("DOMContentLoaded", function(event) {
    fetchData()
  });

const fetchData = async () => {
    try{
        const res = await fetch('api.json')
        const data= await res.json()
        rellenarCards(data);
    }catch(error){
        console.log(error)
    }
}

const rellenarCards = data => {
    data.forEach( producto =>{
        templateCard.querySelector('img').setAttribute('src', producto.url_image)
        templateCard.querySelector('h5').textContent = producto.name
        templateCard.querySelector('p').textContent = '$'+producto.price
        const clone = templateCard.cloneNode(true)
        fragment.appendChild(clone);
    })
    items.appendChild(fragment)
}

function busquedaProducto(){
    // DOM
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
