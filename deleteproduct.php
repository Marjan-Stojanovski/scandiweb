<?php

spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});

    $data = json_decode($_POST['data']);

    foreach ($data as $id) {
        $product = new Product();
        $product = $product->delete($id);
    }
return 'Success';


