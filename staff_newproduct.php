<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style_staff_newproduct.css">
</head>

<body>
    <form action="handle_form.php" method="post" enctype="multipart/form-data">
        <h1>Create New Product</h1>

        <h2>Cover Page</h2>
        <div class="box upload-box1">
            <p>Upload a picture of the new product</p>
            <input type="file" id="newproduct_image" name="newproduct_image"  required accept="image/png, image/jpg">
            
            
            <div id = "display_image"></div> 
            <script scr= "choose_img.js"></script></script>
        </div>

        <h2>Product Name</h2>
        <div class="box">
            <input type="text" id="newproduct_Name" name="newproduct_Name" placeholder="Product Name" required>
        </div>

        <h2>Product Details</h2>
        <div class="box">
                <label class="label" for="Collection" >Collection :</label>
                <select id="newproduct_collection" name="newproduct_collection" class="textbox" required>
                    <option value="BlackPink">BlackPink</option>
                    <option value="Twice">Twice</option>
                    <option value="EXO">EXO</option>
                </select> 
                <div>
                    <a href="add_collection.html">
                        <button class="addcollection-button" type="button">Add New Collection</button>
                    </a>
                </div>
                <br>
                <br>
                <br>
                <textarea class = "textarea2" id="newproduct_detail" name="newproduct_detail" rows="10" cols="103" placeholder="Product Detail"required></textarea>
                
        </div>

        <h2>Price</h2>
        <div class="box2">
            <input type="text2" id="newproduct_price" name="newproduct_price" placeholder="Price"required >
            <label class="label2" for="newproduct_price">THB</label>
        </div>

        <h2>Stock</h2>
        <div class="box2">
            <input type="text2" id="newproduct_stock_item" name="stock_item" placeholder="Quantity"required size="20">     
            <label class="label2" for="newproduct_stock_item">Items</label>
        </div>
     
        <br><br><br>
        <input type="submit" value="Create New Product">
        <br><br>

    </form>
</body>

</html>