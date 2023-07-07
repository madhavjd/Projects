<?php
include_once("model/model.php");
session_start();
class Controller extends model{
    private $baseURL = "";
    public function __construct() {
       parent::__construct();
       ob_start();
    //    echo "<pre>";
       //    print_r($_SERVER);
       //    echo "http://localhost/practice/Tasks/MVC_Project/";
          $Requri=explode("/",$_SERVER['REQUEST_URI']);
       //    print_r($Requri);
           $this->baseURL = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".$Requri[1]."/".$Requri[2]."/".$Requri[3]."/assets/";
       //    exit;
       if (isset($_SESSION['UserData'])) {
        $CartData  = $this->join("cart", array("product" => "cart.prodid=product.pid"), array("userid" => $_SESSION['UserData']->id));

        // $CartData = $this->select("cart",array("userid"=>$_SESSION['UserData']->id));
    }
       if (isset($_SERVER['PATH_INFO'])){
        switch($_SERVER['PATH_INFO']){
            case '/home':
            include_once("views/header.php");
            include_once("views/content.php");
            include_once("views/footer.php");
            break;
            case '/about':
            include_once("views/header.php");
            include_once("views/about.php");
            include_once("views/footer.php");
            break;
            case '/contact':
            include_once("views/header.php");
            include_once("views/about.php");
            include_once("views/footer.php");
            break;
            case '/login':
            include_once("views/header.php");
            include_once("views/login.php");
            include_once("views/footer.php");
            if (isset($_POST['login'])) {
              if ($_POST['username']!=="" && $_POST['password']!==""){
                $loginResponse = $this->login($_POST['username'],$_POST['password']);
                if ($loginResponse['Code']==1){
                 $_SESSION['UserData'] = $loginResponse['Data'][0];
                 if ($loginResponse['Data'][0]->username = "admin") {
                    header("location:admindashboard");
                } 
                 else{
                    header("location:home");
                }
                }
                else {
                    echo "<script>alert('Invalid user')</script>";
                 }
              }
              else {
              echo "<script>alert('username and password is required')</script>";
               }
            }
            break;
            case '/register':
            include_once("views/header.php");
            include_once("views/register.php");
            include_once("views/footer.php");
            break;
            case '/logout':
                session_destroy();
                header("location:home");
            break;
            case '/admindashboard':
            include_once("views/admin/header.php");
            include_once("views/admin/dashboard.php");
            include_once("views/admin/footer.php");
            break;

            case '/products':
            $Productsdata=$this->select("product");
            include_once("views/header.php");
            include_once("views/productcateloge.php");
            include_once("views/footer.php");
            if (isset($_POST['addtocart'])) {
             if (isset($_SESSION['UserData'])) {
                $amount = $_POST['product_quantity'] * $_POST['product_price'];
                $Insertdata = array("userid"=>$_SESSION['UserData']->id,"prodid"=>$_POST['product_id'],"quantity"=>$_POST['product_quantity'],"date"=>date('Y-m-d'),"amount"=>$amount);
                $this->insert("cart",$Insertdata);
             }
             else {
                header("location:login");
             }
            }
            break;

            case '/cart':
            // Merchant key here as provided by Payu
            $MERCHANT_KEY = "L5ur0mHt";
            // Merchant Salt as provided by Payu
            $SALT = "UKGDngKWIm";
            // Change to https://secure.payu.in for LIVE mode
            $PAYU_BASE_URL = "https://test.payu.in";
            $action = '';
            $posted = array();
            if (!empty($_POST)) {
                foreach ($_POST as $key => $value) {
                    $posted[$key] = $value;
                }
            }
            $formError = 0;
            if (empty($posted['txnid'])) {
                // Generate random transaction id
                $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
            } else {
                $txnid = $posted['txnid'];
            }
            $hash = '';
        // Hash Sequence
           $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
           if (empty($posted['hash']) && sizeof($posted) > 0) {
            if (
                empty($posted['key'])
                || empty($posted['txnid'])
                || empty($posted['amount'])
                || empty($posted['firstname'])
                || empty($posted['email'])
                || empty($posted['phone'])
                || empty($posted['productinfo'])
                || empty($posted['surl'])
                || empty($posted['furl'])
                || empty($posted['service_provider'])
            ) {
                $formError = 1;
            } else {
                //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
                $hashVarsSeq = explode('|', $hashSequence);
                $hash_string = '';
                foreach ($hashVarsSeq as $hash_var) {
                    $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                    $hash_string .= '|';
                }
                $hash_string .= $SALT;
                $hash = strtolower(hash('sha512', $hash_string));
                $action = $PAYU_BASE_URL . '/_payment';
            }
        }  elseif (!empty($posted['hash'])) {
            $hash = $posted['hash'];
            $action = $PAYU_BASE_URL . '/_payment';
        }
            // $CartData = $this->select("cart",array("userid"=>$_SESSION['UserData']->id));
            $CartData  = $this->join("cart", array("product" => "cart.prodid=product.pid"), array("userid" => $_SESSION['UserData']->id));
            // echo "<pre>";
            // print_r($_SESSION['UserData']);
            // print_r($CartData);
            // echo "</pre>";
            // exit;
            include_once("views/header.php");
            include_once("views/cart.php");
            include_once("views/footer.php");
            break;

            case '/deletecartdata':
                // echo "called";
            $deleteuserdata = $this->delete("cart",array("cartid"=>$_GET['cartid']));
            header("location:cart");
            break;

            case '/allusers':
             $allusersdata = $this->select("users");
            include_once("views/admin/header.php");
            include_once("views/admin/allusers.php");
            include_once("views/admin/footer.php");
            break;

            case '/allproducts':
             $allproducts = $this->select("product");;
            include_once("views/admin/header.php");
            include_once("views/admin/allproducts.php");
            include_once("views/admin/footer.php");
            break;

            case '/addoreditprod':
              if (isset($_REQUEST['pid'])) {
                $ProductsDataById = $this->selectwhere("product",array("pid"=>$_REQUEST['pid']));
            }
                if (isset($_POST['insertprod'])) {
                    if ($_FILES['pic']['error']==0) {
                        $Filename = $_FILES['pic']['name'];
                        move_uploaded_file($_FILES['pic']['tmp_name'],"uploads/$Filename");
                    }
                    else {
                        $Filename = "Default.jpg";
                      }
                    unset($_REQUEST['insertprod']);
                $InsertProdData = array_merge($_REQUEST,array("pic"=>$Filename));
                $InsertProduct = $this->insert("product",$InsertProdData);
                if ($InsertProduct['Code'] == '1') {
                    header("location:allproducts");
                   }
                }

                if (isset($_POST['updateprod'])) {
                    if ($_FILES['pic']['error']==0) {
                        $Filename = $_FILES['pic']['name'];
                        move_uploaded_file($_FILES['pic']['tmp_name'],"uploads/$Filename");
                    }
                    else {
                        $Filename = $_REQUEST['old_pic'];
                      }
                    unset($_REQUEST['updateprod'],$_REQUEST['old_pic']);
                $UpdateProdData = array_merge($_REQUEST,array("pic"=>$Filename));
                echo "<pre>";
                print_r($UpdateProdData);
                echo "</pre>";
                $UpdateProduct = $this->update("product",$UpdateProdData,array("pid"=>$_REQUEST['pid']));
                if ($UpdateProduct['Code'] == '1') {
                    header("location:allproducts");
                   }
                }
            include_once("views/admin/header.php");
            include_once("views/admin/edit_or_insert_product.php");
            include_once("views/admin/footer.php");
            break;

            case '/deleteprod':
             $deleteprod = $this->delete("product",array("pid"=>$_REQUEST['pid']));
            if ($deleteprod['Code']=='1') {
                header("location:allproducts");
              }
            break;

             case '/addnewuser':
            $StateData = $this->select("state");
            $CitiesData = $this->select("cities");
            include_once("views/admin/header.php");
            include_once("views/admin/edit_or_insert_user.php");
            include_once("views/admin/footer.php");
             if (isset($_POST['insert'])) {
             $Insertdata = $this->insert("users",array("username"=>$_POST['username'],"password"=>$_POST['password'],"gender"=>$_POST['gender'],"email"=>$_POST['email'],"mobile"=>$_POST['mobile']),array("id"=>$userID));
             if ($Insertdata['Code'] == 1) {
             header("location:allusers");
              }
             }
             if (isset($_POST['update'])) {
                $Insertdata = $this->update("users",array("username"=>$_POST['username'],"password"=>$_POST['password'],"gender"=>$_POST['gender'],"email"=>$_POST['email'],"mobile"=>$_POST['mobile']),array("id"=>$userID));
                if ($Insertdata['Code'] == 1) {
                    header("location:allusers");
                }
            }
            break;

            case '/edit':
            $StateData = $this->select("state");
            $CitiesData = $this->select("cities");
            $userID = $_GET['userid'] ?? "";
            if ($userID) {
                $usersDataById = $this->selectjoin("users",array(
                    "cities"=>"users.city=cities.id",
                    "state"=>"cities.state_id=state.id"
                ),array("users.id"=>$_REQUEST['userid']));
            }
           
            // echo "<pre>";
            // print_r($usersDataById);
            // echo "</pre>";
            
            include_once("views/admin/header.php");
            include_once("views/admin/edit_or_insert_user.php");
            include_once("views/admin/footer.php");
            if (isset($_POST['insert'])) {
                // $Insertdata = $this->insert("users",array("username"=>$_POST['username'],"password"=>$_POST['password'],"gender"=>$_POST['gender'],"email"=>$_POST['email'],"mobile"=>$_POST['mobile']),array("id"=>$userID));
                // echo "<pre>";
                // print_r($_FILES);
                if ($_FILES['prof_pic']['error']==0) {
                    $Filename=$_FILES['prof_pic']['name'];
                    move_uploaded_file($_FILES['prof_pic']['tmp_name'],"uploads/$Filename");
                }
                else{
                    $Filename="Default.jpg";
                }
                array_pop($_REQUEST);
                unset($_REQUEST['state'],$_REQUEST['cities'],$_REQUEST['country']);
                $Insertdata=array_merge($_REQUEST,array("prof_pic"=>$Filename));
                $insertuser=$this->insert("users",$Insertdata);
                echo "<pre>";
                print_r($insertuser);
                if ($insertuser['Code'] == 1) {
                // header("location:allusers");
                 }
                }
            if (isset($_POST['update'])) {
                if ($_FILES['prof_pic']['error'] ==0 ) {
                    $FileName = $_FILES['prof_pic']['name'];
                    move_uploaded_file($_FILES['prof_pic']['tmp_name'],"uploads/$FileName");
                } else {
                    $FileName = $_REQUEST['old_prof_pic'];
                }
                array_pop($_REQUEST);
                unset($_REQUEST['country'],$_REQUEST['state'],$_REQUEST['old_prof_pic'],$_REQUEST['userid']);
                $UpdateData = array_merge($_REQUEST,array("prof_pic"=>$FileName));
                // echo "<pre>";
                // print_r($UpdateData);
                // echo "</pre>";
                // exit;
                $UpdateUsersDataById = $this->update("users",$UpdateData,array("id"=>$userID));
                 echo "<pre>";
                        print_r($UpdateUsersDataById);
                        echo "</pre>";
                if ($UpdateUsersDataById['Code'] == 1) {
                    header("location:allusers");
                }
               }
            break;

            case '/search':
            if (isset($_POST['search'])) {
            $searchtext = $this->search("users",$_POST['search']);
            }
            include_once("views/admin/header.php");
            include_once("views/admin/search.php");
            include_once("views/admin/footer.php");
            break;

            case '/delete':
             $deleteuserdata = $this->delete("users",array("id"=>$_REQUEST['userid']));
             header("location:allusers");
            break;
            
            default:
            # code...
            break;
        }
       }
       else 
       {
           header("location:home");
       }

       ob_flush();
    }
}
$Controller = new Controller;
?>