<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <form  method="post" id="commonform" enctype="multipart/form-data">
        <div class="form-group">
          <label for="name">Product Name</label>
          <input type="text" name="name" id="name" placeholder="Enter Productname" value="<?php echo $ProductsDataById['Data'][0]->name ??""; ?>"><br>
        </div>
        <div  class="form-group">
          <label for="fullname">Price</label>
          <input type="text" name="Price" id="Price" placeholder="Enter Product Price" value="<?php echo $ProductsDataById['Data'][0]->price ??""; ?>"><br>
        </div>
        <div  class="form-group">
          <label for="email">Weight</label>
          <input type="text" name="weight" id="weight" placeholder="Enter weight" value="<?php echo $ProductsDataById['Data'][0]->weight ??""; ?>"><br>
        </div>
        <div  class="form-group">
          <label for="pic">Product Picture</label>
            <?php if (isset($ProductsDataById)) {?>
                <input type="hidden" name="old_pic" value="<?php echo $ProductsDataById['Data'][0]->pic ??""; ?>" id="pic">
            <?php } ?>
          <input type="file" name="pic" accept="image/*" id="pic"><br>
        </div>
            <?php if (isset($ProductsDataById)) {?>
            <input type="submit" name="updateprod" value="update" id="">
           <?php }else{?>
            <input type="submit" name="insertprod" value="Add" id="">
          <?php }?>
        </div>
    </form>
</body>
</html>