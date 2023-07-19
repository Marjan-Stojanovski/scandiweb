<?php

session_start();
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>JuniorDeveloperTest-Marjan-Stojanovski</title>
</head>
<body>
<div class="container">
    <div class="row" style="padding-top: 50px">
        <div class="col-md-3">
            <h1>Product List</h1>
        </div>
        <div class="col-md-6"></div>
        <div class="col-md-1">
            <a href="/createproduct.php" class="btn" style="border: 2px solid black; padding: 4px">ADD</a>
        </div>
        <div class="col-md-2">
            <button id="massdelete" type="button" class="btn"
                    style="border: 2px solid black; padding: 4px">MASS DELETE
            </button>
        </div>
    </div>
    <hr class="solid-black" style="border: 1px solid black">
    <div class="row">
        <?php
        $data = new Product();
        $products = $data->getAll();

        foreach ($products as $product) {
            echo '
        <div class="col-md-3 optional">
            <div class="card" style="width: 200px; height: 200px; flex-direction: row">
                <label class="delete" for="checkbox" hidden>' . $product->id . '</label>
                <input type="checkbox" class="delete-checkbox"  style="position: fixed">
                <div class="card-body">
                    <h6 class="card-title" style="text-align: center">' . $product->sku . '</h6>
                    <div class="card-text" style="text-align: center">' . $product->name . '</div>
                    <div class="card-text" style="text-align: center">' . $product->price . '$</div>
                    <div class="card-text action" hidden data-id="' . $product->id . '" style="text-align: center">' . $product->action . '</div>
                    <div class="card-text formOption" id="dvd-' . $product->id . '" style="text-align: center">Size ' . $product->size . ' MB</div>
                    <div class="card-text formOption" id="book-' . $product->id . '" style="text-align: center">Weight ' . $product->weight . ' KG</div>
                    <div class="card-text formOption" id="furniture-' . $product->id . '" style="text-align: center">Dimensions: ' . $product->height . 'x' . $product->width . 'x' . $product->length . '</div>
                </div>
            </div>
        </div>
        ';
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {

            let divs = $(document).find("div.optional");

            for (let i = 0; i < divs.length; i++) {

                let actionElement = $(divs[i]).find('.action');
                let id = actionElement.attr('data-id');
                let action = actionElement.html();
                let optionElements = $(divs[i]).find(".formOption");

                for (let i = 0; i < optionElements.length; i++) {
                    optionElements[i].style.display = "none";
                }
                document.getElementById(`${action}-${id}`).style.display = "block";
            }

            let data = [];
            $(".delete-checkbox").on('click', function (e) {
                let temp = $(this).parent();
                let temp2 = temp.find("label.delete");
                let temp3 = temp2.html();
                if (data.includes(temp3)) {
                    const index = data.indexOf(temp3);
                    const x = data.splice(index, 1);
                } else {
                    data.push(temp3);
                }
            });

            $("#massdelete").on('click', function () {
                $.post(
                    'http://proba.test/deleteproduct.php',
                    {data: JSON.stringify(data)},
                    function (data) {
                        window.location.href = "index.php";
                    });
            });
        });
    </script>
    <footer>
        <hr class="solid-black" style="border: 1px solid black">
        <h6 style="text-align: center">Scandiweb Test Assignment</h6>
    </footer>
</div>
</body>
</html>