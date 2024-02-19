<?php
// confirmar sesion
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Offbeat - Admin.</title>
    <link rel="stylesheet" href="assets/css/reset.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>
  <body>
    <header class="header">
      <nav class="nav container">
        <a href="/tienda-php-2/index.html" class="nav-link name-site">Offbeat.</a>

        <a href="cerrar-sesion.php" class="hi-link">Cerrar sesión</a>

        <ul class="nav-links">
          <li><a href="#">Inicio,</a></li>
          <li><a href="#">Catálogo,</a></li>
          <li><a href="#">Contacto</a></li>
        </ul>
      </nav>
    </header>

    <section class="hero-admin container">
      <p class="text-small-hero"><span>Admin</span> - Rol</p>
      <h1 class="text-hero-home text-home">
        <div class="line">
          <span>ADMINISTRA</span>
          <span>TODOS</span>
        </div>

        <div class="line">
          <span>TUS</span>
          <span>PRODUCTOS</span>
          <span>EN</span>
        </div>
        <div class="line">
          <span>stock</span>
          <span>desde</span>
          <span>aquí.</span>
        </div>
      </h1>
    </section>

    <!--FORMULARIO AGREGAR PRODUCTO MODAL-->
    <div class="overlay-modal">
      <form id="formularioProducto" class="form-add-product" method="post">
        <header class="header-form-admin">
          <h2 class="subtitle">Agrega un producto</h2>
          <button class="btn-close-modal-admin" id="btn-close-modal">
            [x]
          </button>
        </header>

        <div class="co-input">
          <label for="product_name">Nombre del Producto:</label>
          <input type="text" id="product_name" name="product_name" required />
        </div>

        <div class="co-input">
          <label for="description">Descripción:</label>
          <textarea id="description" name="description" required></textarea>
        </div>

        <div class="co-input">
          <label for="price">Precio:</label>
          <input type="number" id="price" name="price" required />
        </div>

        <div class="co-input">
          <label for="image_product">URL de la Imagen:</label>
          <input type="text" id="image_product" name="image_product"  required />
        </div>

        <div class="co-input">
          <label for="stock">Stock:</label>
          <input type="number" id="stock" name="stock" required />
        </div>

        <button
          type="button"
          class="btn-add-product-a"
          onclick="agregarProducto()"
        >
          Agregar Producto
        </button>
      </form>
    </div>

    <section class="co-products-admin container">
      <header class="header-list-product-admin">
        <h2 class="">Lista de productos subidos.</h2>
        <button class="btn-add-product" id="add-product-cta">
          Agregar un producto.
        </button>
      </header>
      <hr />

      <div>
        <ul class="list-product-admin">
          <li class="card-product-admin">
            <div class="wrapper-card-product-admin">
              <figure>
                <img src="assets/uploads/image-4.webp" alt="" />
                <div class="btn-actions">
                  <button class="btn-delete">Eliminar</button>
                </div>
              </figure>
            </div>
            <figcaption class="info-product-admin">
              <h2 class="name-product">Nike Dunk Lowe(M)</h2>
              <p class="price">34.0000</p>
            </figcaption>
          </li>
        </ul>
      </div>
    </section>
    <!--scripts-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.3/gsap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/animation.js"></script>
  </body>
</html>