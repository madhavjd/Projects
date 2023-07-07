<div class="container">
  <div class="row">
    <div class="col">
      <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product ID</th>
      <th scope="col">Product Title</th>
      <th scope="col">Product Quantity</th>
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
       <td><?php echo $value->prodid; ?></td>
       <td><?php echo $value->name; ?></td>
       <td><?php echo $value->quantity;?></td>
       <td><?php echo $value->amount;?></td>
       <td><a href="deletecartdata?cartid=<?php echo $value->cartid;?>">Delete</a></td>
      </tr>
   <?php $TotalAmount += $value->amount; } ?>
  </tbody>
</table>

<form action="<?php echo $action; ?>" method="post" name="payuForm">

<input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
<input type="hidden" name="hash" value="<?php echo $hash ?>"/>
<input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
<table>
<tr>
<td>Amount: </td>
<td><input type="text" name="amount" value="<?php echo $TotalAmount; ?>" /></td>
<td>User Name: </td>
<td><input name="firstname" id="firstname" value="<?php echo $_SESSION['UserData']->username; ?>" /></td>
</tr>
<tr>
<td>Email: </td>
<td><input name="email" id="email" value="<?php echo $_SESSION['UserData']->email; ?>" /></td>
<td>Phone: </td>
<td><input name="phone" value="<?php echo $_SESSION['UserData']->mobile; ?>" /></td>
</tr>
<tr>
<td>Product Info: </td>
<td colspan="3"><textarea name="productinfo" value="Prod"><?php foreach ($CartData['Data'] as $key => $value) {
 echo $value->name." ".",";
} ?></textarea></td>
</tr>
<tr>
<!-- <td>Success URI: </td> -->
<td colspan="3"><input type="hidden" value="http://localhost/laravel/01Dec_laravel_TTS9/PHP/19PayuMoney/payumoney/success.php" name="surl" size="64" /></td>
</tr>
<tr>
<!-- <td>Failure URI: </td> -->
<td colspan="3"><input name="furl" type="hidden" value="http://localhost/laravel/01Dec_laravel_TTS9/PHP/19PayuMoney/payumoney/failure.php" size="64" /></td>
</tr>
<tr>
<td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>
</tr>
</table>
<tr>
<?php if(!$hash) { ?>
<td colspan="4"><input type="submit" value="Pay Now" /></td>
<?php } ?>
</tr>

</form>
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