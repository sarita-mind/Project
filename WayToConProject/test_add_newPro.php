<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="icon" type="image/x-icon" href="image/template.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="test_add_newPro.css">
</head>

<body>
    <?php include_once('staffheader.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-start mb-2 mt-5">Create New Product</h1>
                <h2 class="text-start mb-2 mt-2">Cover Page</h2>
            </div>
        </div>

        <form action="test_add_newPro_db.php" method ="POST">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="box upload-box1">
                            <p>Upload a picture of the new product</p>
                            <input type="file" id="newproduct_image" name="newproduct_image" required accept="image/png, image/jpg" onchange="loadFile(event)">
                            <p><img id="output" class="img-fluid" /></p>
                            <script>
                                var loadFile = function(event) {
                                    var image = document.getElementById('output');
                                    image.src = URL.createObjectURL(event.target.files[0]);
                                };
                            </script>
                        </div>
                    </div>


                    <h2>Product Name</h2>
                    <div class="box">
                        <input class="tex1" type="text" id="newproduct_Name" name="newproduct_Name" placeholder="Product Name" required>
                    </div>

                    <h2>Product Details</h2>
                    <div class="box">
                        <label class="label" for="Collection">Collection:</label>
                        <select id="newproduct_collection" name="newproduct_collection" class="textbox" required>
                            <option value="BlackPink">BlackPink</option>
                            <option value="Twice">Twice</option>
                            <option value="EXO">EXO</option>
                        </select>

                        <div>
                            <button id="addcollection-button" class="addcollection-button" type="button">Add New Collection</button>

                        </div>
                        <br>
                        <br>
                        <br>
                        <div id="inputField" style="display: none;">
                            <input class="tex1" type="text" id="collectionName" placeholder="New Collection Name">
                        </div>
                        <script>
                            document.getElementById('addcollection-button').addEventListener('click', function() {
                                var x = document.getElementById("inputField");
                                if (x.style.display === "none") {
                                    x.style.display = "block";
                                } else {
                                    x.style.display = "none";
                                }
                            });
                        </script>

                        <br>
                        <textarea class="textarea2" id="newproduct_detail" name="newproduct_detail" rows="10" cols="103" placeholder="Product Detail" required></textarea>
                    </div>

                    <h2>Price</h2>
                    <div class="box2">
                        <div class="form-group">
                            <input class="tex" type="text" id="newproduct_price" name="newproduct_price" placeholder="Price" required size="20">
                            <label class="label2" for="newproduct_price">THB</label>
                        </div>
                    </div>


                    <h2>Stock</h2>
                    <div class="box2">
                        <div class="form-group">
                            <input class="num" type="number" id="newproduct_stock_item" name="newproduct_stock_item" placeholder="Quantity" required>
                            <label class="label2" for="newproduct_stock_item">Items</label>
                        </div>
                    </div>

                    <br><br><br>
                    <input type="submit" name="create_new_product" id="create_new_product" value="Create New Product">
                    <br><br><br><br>
                </div>
            </div>
        </form>
    </div>
</body>

</html>