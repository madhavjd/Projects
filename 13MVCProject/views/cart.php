
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Product Id</th>
                  <th scope="col">Product Title</th>
                  <th scope="col">Product quantity</th>
                  <th scope="col">Product Price</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
               <?php 
               $TotalAmount = 0;
               foreach ($CartData['Data'] as $key => $value) {?>
                <tr>
                  <th scope="row"></th>
                  <td><?php echo $value->prodid;?></td>
                  <td><?php echo $value->name;?></td>
                  <td><?php echo $value->quantity;?></td>
                  <td><?php echo $value->amount;?></td>
                  <td> <a href="deletecartdata?userid=<?php echo $value->userid; ?>&prodid=<?php echo $value->prodid; ?>">Delete</a></td>
                </tr>
             <?php 
                $TotalAmount += $value->amount;
            } 
            // echo "<pre>";
            // print_r($_SESSION['UserData']);
            // echo "</pre>";
            ?>
              </tbody>
            </table>
            <form action="<?php echo $action; ?>" method="post" name="payuForm">

<input type="text" name="key" value="<?php echo $MERCHANT_KEY ?>" />
<input type="text" name="hash" value="<?php echo $hash ?>"/>
<input type="text" name="txnid" value="<?php echo $txnid ?>" />
<table>
<tr>
<td><b>Mandatory Parameters</b></td>
</tr>
<tr>
<td>Amount: </td>
<td><input name="amount" value="<?php echo $TotalAmount; ?>" /></td>
<td>First Name: </td>
<td><input name="firstname" id="firstname" value="admin" /></td>
</tr>
<tr>
<td>Email: </td>
<td><input name="email" id="email" value="<?php echo $_SESSION['UserData']->email; ?>" /></td>
<td>Phone: </td>
<td><input name="phone" value="9879879878" /></td>
</tr>
<tr>
<td>Product Info: </td>
<td colspan="3"><textarea name="productinfo">Product datails</textarea></td>
</tr>
<tr>
<td>Success URI: </td>
<td colspan="3"><input value="http://localhost/laravel/01Dec_laravel_TTS9/PHP/19PayuMoney/payumoney/success.php" name="surl" size="64" /></td>
<!-- <td colspan="3"><input value="http://localhost/laravel/01Dec_laravel_TTS9/PHP/19PayuMoney/payumoney/success.php" name="surl" value="<?php echo (empty($posted['surl'])) ? '' : $posted['surl'] ?>" size="64" /></td> -->
</tr>
<tr>
<td>Failure URI: </td>
<td colspan="3"><input name="furl" value="http://localhost/laravel/01Dec_laravel_TTS9/PHP/19PayuMoney/payumoney/failure.php" size="64" /></td>
</tr>
<tr>
<td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
</tr>
<tr>
<?php if(!$hash) { ?>
<td colspan="4"><input type="submit" value="Submit" /></td>
<?php } ?>
</tr>
</table>
</form>
            <!-- <form method="post">
                <input type="text" name="prodid" value="<?php echo $_SESSION['UserData']->id ?>" id="">
                <input type="text" name="amount" value="<?php echo $TotalAmount ?>" id="">
                <input type="submit" name="btn-save" id="btn-save">
            </form> -->
        </div>
    </div>
</div>
<script>
var hash = '<?php echo $hash ?>';
function submitForm() {
if(hash == '') {
return;
}
var payuForm = document.forms.payuForm;
payuForm.submit();
}
submitForm()
</script>