const btnCart = document.querySelector('.container-cart-icon')
const containerCartProduct = document.querySelector('.container-cart-product')

btnCart.addEventListener('click', () => {
    containerCartProduct.classList.toggle('hidden-cart')
})

/* ESTO SE SEPARA */

const cartInfo  = document.querySelector('.cart-product')
const rowProduct = document.querySelector('.row-product')

/* Lista de todos los contenedores de Productos*/

    const productList = document.querySelector('.container-img')      

    // variable de arreglos de productos
    
    let allProduct = []
    const valorTotal = document.querySelector('.total-pagar')
    const countProduct = document.querySelector ('#contador-productos')

    const cartEmpty = document.querySelector('.cart-empty');
    const cartTotal = document.querySelector('.cart-total');



// evento de agrecar los productos

    productList.addEventListener('click', e => {
        if (e.target.classList.contains('btn-add-cart')){
            const product = e.target.parentElement

            const infoProduct = {
                quantity: 1,
                title: product.querySelector('h2').textContent,
                price: product.querySelector('p').textContent,
            }

            const exits = allProduct.some(product => product.title === infoProduct.title)

            if (exits) {
                const product = allProduct.map(product => {
                    if(product.title === infoProduct.title){
                        product.quantity++;
                        return product
                    } else {
                        return product 
                    }
                })

                allProduct = [...product]
            } else{
                allProduct = [...allProduct, infoProduct]
            }

           

           showHTML();
        }
    });
    

    rowProduct.addEventListener('click', (e) =>{
        if (e.target.classList.contains ('icon-close')) {

            const product = e.target.parentElement; 
            const title = product.querySelector('p').textContent 

            allProduct = allProduct.filter ( product => product.title !== title);

    

            showHTML();
        }

    })


    //Función para mostrar HTML

    const showHTML = () => {

        if (!allProduct.length) {
            cartEmpty.classList.remove('hidden');
            rowProduct.classList.add('hidden');
            cartTotal.classList.add('hidden');
        } else {
            cartEmpty.classList.add('hidden');
            rowProduct.classList.remove('hidden');
            cartTotal.classList.remove('hidden');
        }

        // Limpiar html

        rowProduct.innerHTML = ''; 

        let total = 0;
        let totalOfproduct = 0 

      allProduct.forEach(product => {
        const containerProduct = document.createElement('div');
        containerProduct.classList.add('cart-product')

            containerProduct.innerHTML = `<div class="info-cart-product">
                <span class="cantidad-producto-carrito">${product.quantity}</span>
                    <p class="titulo-producto-carrito">${product.title}</p>
                    <span class="precio-producto-carrito">${product.price}</span>
                    </div>
                <button class="icon-close"><i class=" fa-solid fa-xmark"></i></button>` ;

        rowProduct.append(containerProduct);

        // Conseguir el total del valor , con el array .slice-(1) se quita el simbolo default 
        if (product.price.startsWith('$')) {
            total = total + parseFloat(product.quantity * product.price.slice(1));
          } else {
            total = total + parseFloat(product.quantity * product.price);
          }

        // total de productos

        totalOfproduct = totalOfproduct + product.quantity


      });

       valorTotal.innerText = `$${total}`
       countProduct.innerText = totalOfproduct; 

    };



  