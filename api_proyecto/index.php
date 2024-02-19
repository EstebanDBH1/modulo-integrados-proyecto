<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
require 'flight/Flight.php';
// ` `
Flight::register('db', 'PDO',array('mysql:host=localhost;dbname=tienda_online', 'root', ''));

Flight::route('GET /products', function () {
     $sentencia = Flight::db()->prepare("SELECT * FROM `product`");
     $sentencia->execute();
     $datos=$sentencia->fetchAll();
     Flight::json($datos);
});

//INSERTAR DATOS;
Flight::route('POST /products', function () {
    $product_name = Flight::request()->data->product_name;
    $price = Flight::request()->data->price;
    $description = Flight::request()->data->description;
    $image_product = Flight::request()->data->image_product;
    $stock = Flight::request()->data->stock;

    $sql = "INSERT INTO product (product_name, price, description, image_product, stock) VALUES (?, ?, ?, ?, ?)";
    
    $sentencia = Flight::db()->prepare($sql);
    $sentencia->bindParam(1, $product_name);
    $sentencia->bindParam(2, $price);
    $sentencia->bindParam(3, $description);
    $sentencia->bindParam(4, $image_product);
    $sentencia->bindParam(5, $stock);
    $sentencia->execute();
    Flight::json(["Producto agregado"]);
});

//ELIMINAR REGISTROS
Flight::route('DELETE /products', function () {
    $product_id=(Flight::request()->data->product_id);
    $sql = "DELETE FROM product WHERE product_id=?";
    $sentencia = Flight::db()->prepare($sql);
    $sentencia->bindParam(1,$product_id);
    $sentencia->execute();
    Flight::jsonp(["Producto eliminado"]);
});

//ACTUALIZAR REGISTROS
Flight::route('PUT /products', function () {
    $product_id = Flight::request()->data->product_id;
    $product_name = Flight::request()->data->product_name;
    $price = Flight::request()->data->price;
    $description = Flight::request()->data->description;
    $image_product = Flight::request()->data->image_product;
    $stock = Flight::request()->data->stock;

    $sql = "UPDATE product SET product_name=?, price=?, description=?, image_product=?, stock=? WHERE product_id=?";
    $sentencia = Flight::db()->prepare($sql);

    $sentencia->bindParam(1, $product_name);
    $sentencia->bindParam(2, $price);
    $sentencia->bindParam(3, $description);
    $sentencia->bindParam(4, $image_product);
    $sentencia->bindParam(5, $stock);
    $sentencia->bindParam(6, $product_id);
    $sentencia->execute();
    Flight::json(["Producto modificado"]);
});

//CONSULTAR UN DATO DE UNA TABLA.
Flight::route('GET /products/@id', function ($id) {
    $sentencia = Flight::db()->prepare("SELECT * FROM `product` WHERE product_id=?");
    $sentencia->bindParam(1, $id);
    $sentencia->execute();
    $datos=$sentencia->fetchAll();
    Flight::json($datos);
});

Flight::start();