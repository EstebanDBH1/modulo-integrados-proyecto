// LISTA DE PRODUCTOS
document.addEventListener("DOMContentLoaded", () => {
  getData();
});

const containerProducts = document.querySelector(".all-products");

const getData = async () => {
  try {
    const res = await fetch("http://localhost/api_proyecto/products");
    const data = await res.json();

    paintData(data);
    console.log(data);
  } catch (error) {
    console.log(error);
  }
};

function paintData(data) {
  data.forEach((product) => {
    containerProducts.innerHTML += `
      <li class="card-product-home">
      <div class="car-product__inner">
        <figure>
          <img src=${product.image_product} alt="" />
        </figure>
      </div>
  
      <div class="info-product">
        <h2 class="name-product">${product.product_name}</h2>
        <p class="price"><span>$ </span>${product.price}</p>
      </div>

      <a href="https://api.whatsapp.com/send?phone=3148817457" class="favorite-icon">
      <svg width="15" height="28" viewBox="0 0 29 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M25.5687 2.01957C22.4078 -1.0171 17.5242 -0.560978 14.5 2.95682C11.4758 -0.560978 6.59219 -1.02335 3.43125 2.01957C-0.681243 5.97474 -0.0796807 12.423 2.85157 15.8408L12.4437 27.0065C12.9906 27.6438 13.7234 28 14.5 28C15.282 28 16.0094 27.6501 16.5562 27.0128L26.1484 15.8471C29.0742 12.4292 29.6867 5.98099 25.5687 2.01957ZM24.2781 13.7351L14.6859 24.9008C14.5547 25.0508 14.4453 25.0508 14.3141 24.9008L4.72188 13.7351C2.72579 11.4108 2.3211 7.01196 5.1211 4.31894C7.24844 2.27575 10.5297 2.58192 12.5859 4.97502L14.5 7.20566L16.4141 4.97502C18.4812 2.56942 21.7625 2.27575 23.8789 4.3127C26.6734 7.00571 26.2578 11.4295 24.2781 13.7351Z" fill="#000"/>
</svg>

        
      </a>
    </li>
      `;
  });
}

// admin actions
// Función para cargar la lista de productos al cargar la página
window.onload = function () {
  // Obtener la lista de productos desde el servidor
  fetch("http://localhost/api_proyecto/products")
    .then((response) => response.json())
    .then((data) => {
      const listProductMain = document.querySelector(".list-product-admin");
      // Crear elementos de lista para cada producto
      data.forEach((producto) => {
        //  const listItem = document.createElement("li");
        // listItem.classList.add('co-card-product')
        listProductMain.innerHTML += `
         <li class="card-product-admin">
         <div class="wrapper-card-product-admin">
           <figure>
             <img src=${producto.image_product} alt="" />
             <div class="btn-actions">
               <button class="btn-delete" onclick="eliminarProducto(${producto.product_id})">Eliminar</button>
             </div>
           </figure>
         </div>
         <figcaption class="info-product-admin">
           <h2 class="name-product">${producto.product_name}</h2>
           <p class="price">${producto.price}</p>
         </figcaption>
       </li>  
       `;
      });
    })

    .catch((error) => {
      console.error("Error al cargar la lista de productos:", error);
    });
};

// Función para eliminar un producto
function eliminarProducto(productoId) {
  fetch("http://localhost/api_proyecto/products", {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ product_id: productoId }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Respuesta del servidor al eliminar:", data);
      // Puedes realizar acciones adicionales después de eliminar el producto
      // Por ejemplo, puedes volver a cargar la lista de productos después de eliminar
      window.location.reload();
    })
    .catch((error) => {
      console.error("Error al eliminar el producto:", error);
    });
}

function agregarProducto() {
  // Obtener los valores del formulario
  const product_name = document.getElementById("product_name").value;
  const description = document.getElementById("description").value;
  const price = document.getElementById("price").value;
  const image_product = document.getElementById("image_product").value;
  const stock = document.getElementById("stock").value;

  // Construir el objeto de datos
  const datosProducto = {
    product_name: product_name,
    description: description,
    price: price,
    image_product: image_product,
    stock: stock,
  };
  // Realizar la solicitud POST al servidor
  fetch("http://localhost/api_proyecto/products", {
    // Reemplaza con la URL correcta de tu backend
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(datosProducto),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Respuesta del servidor:", data);
      // Puedes realizar acciones adicionales después de agregar el producto.

      product_name.value = "";
      description.value = "";
      price.value = "";
      image_product.value = "";
      stock.value = "";

      window.location.reload();
    })
    .catch((error) => {
      console.error("Error al agregar el producto:", error);
    });
}

/*
// Función para actualizar un producto
function actualizarProducto(productoId) {
  // Implementa la lógica de actualización según tus necesidades
  console.log(`Actualizar producto con ID: ${productoId}`);
}*/
