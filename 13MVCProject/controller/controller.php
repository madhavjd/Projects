<?php
include_once("model/model.php");
session_start();
class Controller extends Model
{
    private $baseURL = "";
    public function __construct()
    {
        ob_start();
        parent::__construct();
        // echo "Called";
        // echo "<pre>";
        // print_r($_SERVER);
        // echo "http://localhost/laravel/02FebLaravelTTS_03/13MVC/<br>";
        $ReqURI = explode("/", $_SERVER['REQUEST_URI']);

        // print_r($ReqURI);
        // echo $this->baseURL = "<br>".$_SERVER['REQUEST_SCHEME']."://".$_SERVER['SERVER_NAME']."/".$_SERVER['REQUEST_URI']."/assets/<br>";
        $this->baseURL = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . "/" . $ReqURI[1] . "/" . $ReqURI[2] . "/" . $ReqURI[3] . "/assets/";
        // exit;
        if (isset($_SESSION['UserData'])) {
            $CartData = $this->select("cart", array("userid" => $_SESSION['UserData']->id));
            // echo "<pre>";
            // print_r(count($CartData['Data']));
            // echo "</pre>";
        }
        if (isset($_SERVER['PATH_INFO'])) {

            switch ($_SERVER['PATH_INFO']) {

                case '/home':
                    include_once("views/header.php");
                    include_once("views/content.php");
                    include_once("views/footer.php");
                    break;
                case '/about':
                    include_once("views/header.php");
                    echo "<h2>About us page data</h2>";
                    include_once("views/footer.php");
                    break;
                // case '/login':
                //     include_once("views/header.php");
                //     include_once("views/loginpage.php");
                //     include_once("views/footer.php");
                //     if (isset($_POST['Login'])) {
                //         if ($_POST['username'] !== "" && $_POST['password'] !== "") {
                //             $LoginResponse = $this->login($_POST['username'], $_POST['password']);
                //             print_r($LoginResponse);
                //             if ($LoginResponse['Code'] == 1) {
                               
                //                 $_SESSION['UserData'] = $LoginResponse['Data'][0];
                //                 if ($LoginResponse['Data'][0]->role_id == 1) {
                //                     header("location:admindahboard");
                //                 } else {                                
                //                     header("location:home");
                //                 }
                //             } else {
                //                 echo "<script>alert('Invalid user')</script>";
                //             }
                //         } else {
                //             echo "<script>alert('username and password is required')</script>";
                //         }
                //     }
                //     break;
                case '/register':
                    include_once("views/header.php");
                    include_once("views/registerpage.php");
                    include_once("views/footer.php");
                    if (isset($_POST['Register'])) {
                        $InsertData = array("username" => $_POST['username'], "password" => $_POST['password'], "gender" => $_POST['gender'], "email" => $_POST['email'], "mobile" => $_POST['mobile']);
                        // echo "<pre>";
                        // print_r($InsertData);
                        // $this->insert("users",array("username"=>$_POST['username'],"password"=>$_POST['password'],"gender"=>$_POST['gender'],"email"=>$_POST['email'],"mobile"=>$_POST['mobile']));
                        // array_pop($_REQUEST);
                        // $this->insert("users",$_REQUEST);
                        $this->insert("users", $InsertData);
                    }
                    break;
                case '/products':
                    $ProductsData = $this->select("product");
                    include_once("views/header.php");
                    include_once("views/productcateloge.php");
                    include_once("views/footer.php");
                    if (isset($_POST['addtocart'])) {
                        if (isset($_SESSION['UserData'])) {
                            echo "<pre>";
                            print_r($_SESSION);
                            print_r($_REQUEST);
                            $amount = $_POST['product_quantity'] * $_POST['product_price'];
                            $InsertData = array("userid" => $_SESSION['UserData']->id, "prodid" => $_POST['product_id'], "quantity" => $_POST['product_quantity'], "date" => date('Y-m-d'), "amount" => $amount);
                            $this->insert("cart", $InsertData);
                        } else {
                            header("location:login");
                        }
                    }
                    break;
                case '/admindahboard':
                    include_once("views/admin/header.php");
                    include_once("views/admin/dashboard.php");
                    include_once("views/admin/footer.php");
                    break;
                case '/allusers':
                    // $allUsersData = $this->select("users");
                    $allUsersData = $this->selectjoin("users", array(
                        "cities_data" => "users.city=cities_data.id",
                        "state" => "cities_data.state_id=state.id",
                        "country" => "state.countryid=country.country_id",
                    ), array("status" => 1));
                    // echo "<pre>";
                    // print_r($usersDataById);
                    // echo "</pre>";
                    // exit;
                    include_once("views/admin/header.php");
                    include_once("views/admin/allusers.php");
                    include_once("views/admin/footer.php");

                    break;
                case '/edit':
                    $CountryData = $this->select("country");
                    $StateData = $this->select("states");
                    $CitiesData = $this->select("cities_data");
                    $userId = $_GET['userid'] ?? "";
                    // $usersDataById = $this->selectwhere("users",array("id"=>$userId,"status"=>1));
                    if (isset($_REQUEST['userid'])) {
                        $usersDataById = $this->selectjoin("users", array(
                            "cities_data" => "users.city=cities_data.id",
                            "state" => "cities_data.state_id=state.id",
                            "country" => "state.countryid=country.country_id",
                        ), array("users.id" => $userId, "status" => 1));
                    }
                    // echo "<pre>";
                    // print_r($usersDataById);
                    // echo "</pre>";
                    include_once("views/admin/header.php");
                    include_once("views/admin/edit_or_insert_user.php");
                    include_once("views/admin/footer.php");
                    if (isset($_POST['update'])) {
                        if ($_FILES['prof_pic']['error'] == 0) {
                            $FileName = $_FILES['prof_pic']['name'];
                            move_uploaded_file($_FILES['prof_pic']['tmp_name'], "uploads/$FileName");
                        } else {
                            $FileName = $_REQUEST['old_prof_pic'];
                        }
                        $Hobbie = implode(",", $_REQUEST['hobbies']);
                        array_pop($_REQUEST);
                        unset($_REQUEST['country'], $_REQUEST['state'], $_REQUEST['hobbies'], $_REQUEST['old_prof_pic'], $_REQUEST['userid']);
                        $UpdateData = array_merge($_REQUEST, array("hobby" => $Hobbie, "prof_pic" => $FileName));
                        // echo "<pre>";
                        // print_r($UpdateData);
                        // echo "</pre>";
                        // exit;

                        $UpdateUsersDataById = $this->update("users", $UpdateData, array("id" => $userId));
                        // echo "<pre>";
                        // print_r($UpdateUsersDataById);
                        // echo "</pre>";
                        if ($UpdateUsersDataById['Code'] == 1) {
                            header("location:allusers");
                        }
                    }
                    if (isset($_POST['insert'])) {
                        // echo "<pre>";
                        // print_r($_FILES);
                        if ($_FILES['prof_pic']['error'] == 0) {
                            $FileName = $_FILES['prof_pic']['name'];
                            move_uploaded_file($_FILES['prof_pic']['tmp_name'], "uploads/$FileName");
                        } else {
                            $FileName = "Default.jpg";
                        }
                        $Hobbie = implode(",", $_REQUEST['hobbies']);
                        // echo "<pre>";
                        // echo "======= Form request ";
                        // print_r($_REQUEST);
                        array_pop($_REQUEST);
                        // echo "======= Form request after pop";
                        // print_r($_REQUEST);
                        unset($_REQUEST['country'], $_REQUEST['state'], $_REQUEST['hobbies']);
                        // echo "======= Form request after unset";
                        // print_r($_REQUEST);
                        $InsertData = array_merge($_REQUEST, array("hobby" => $Hobbie, "prof_pic" => $FileName));
                        // echo "======= Form request after merge hobbies";
                        // print_r($InsertData);
                        // echo "</pre>";
                        // exit;
                        $insertUser = $this->insert("users", $InsertData);
                        if ($insertUser['Code'] == 1) {
                            // header("location:allusers");
                        }
                    }
                    break;

                case '/addnewuser':
                    $CountryData = $this->select("country");
                    $StateData = $this->select("states");
                    $CitiesData = $this->select("cities_data");
                    include_once("views/admin/header.php");
                    include_once("views/admin/edit_or_insert_user.php");
                    include_once("views/admin/footer.php");
                    if (isset($_POST['insert'])) {
                        $usersDataById = $this->insert("users", array("username" => $_POST['username'], "email" => $_POST['email']));
                        if ($usersDataById['Code'] == 1) {
                            header("location:allusers");
                        }
                    }
                    break;

                case '/delete':
                    // $deleteUserData = $this->delete("users",array("id"=>$_REQUEST['userid']));
                    $deleteUserData = $this->delete("users", array("id" => $_GET['userid']));
                    header("location:allusers");
                    break;
                case '/logout':
                    session_destroy();
                    header("location:login");
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
                    } elseif (!empty($posted['hash'])) {
                        $hash = $posted['hash'];
                        $action = $PAYU_BASE_URL . '/_payment';
                    }

                    // $CartData = $this->select("cart",array("userid"=>$_SESSION['UserData']->id));
                    $CartData  = $this->join("cart", array(
                        "product" => "cart.prodid=product.pid",
                    ), array("cart.userid" => $_SESSION['UserData']->id));
                    include_once("views/header.php");
                    include_once("views/cart.php");
                    include_once("views/footer.php");
                    break;
                case '/deletecartdata':
                    $deleteUserData = $this->delete("cart", array("userid" => $_GET['userid'], "prodid" => $_GET['prodid']));
                    header("location:cart");
                    break;
                default:
                    # code...
                    break;
            }
        } else {
            header("location:home");
        }
        ob_flush();
    }
}
$Controller = new Controller;
