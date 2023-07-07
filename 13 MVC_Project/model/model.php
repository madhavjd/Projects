<?php
date_default_timezone_set('Asia/Kolkata');
//  error_reporting(0);
class model{
    private $connection="";
    public function __construct(){
        try {
            $this->connection=new mysqli("localhost","root","","masterdatabase");
            // echo " Try";
            // print_r($this->connection);
        } catch (\Throwable $th) {
            // echo "Catch";
            // print_r($th->getMessage());
            if(!file_exists("log")){
                mkdir("log");
            }
            $ErrorFileName=date('d_M_Y');
            $Error=$th->getMessage();
            $ErrorMessage=PHP_EOL."============================".PHP_EOL;
            $ErrorMessage.="ErrorDateTime >>".date('d-M-Y h:i:s A').PHP_EOL;
            $ErrorMessage.="ErrorMessage".$Error.PHP_EOL;
            $ErrorMessage.="============================".PHP_EOL;
            file_put_contents("log/$ErrorFileName.txt",$ErrorMessage,FILE_APPEND);
            echo $Error;
        }
        }
         public function insert($tbl,$data){
            $clm= implode(",",array_keys($data));
            $vls=implode("','",$data);
            $SQL= "INSERT INTO $tbl ($clm) VALUES('$vls')";
            $SQLEx = $this->connection->query($SQL);
            if ($SQLEx > 0) {
                $ResData['Msg'] = "Success";
                $ResData['Data'] = '1';
                $ResData['Code'] = "1";
            }else{
                $ResData['Msg'] = "Try again";
                $ResData['Data'] = "0";
                $ResData['Code'] = "0";
            }
            return $ResData;
         }

         public function login($uname,$pass){
            $SQL = "SELECT * FROM users WHERE password='$pass' AND (username='$uname' OR email='$uname' OR mobile='$uname')";
            $SQLEX = $this->connection->query($SQL);
            //  echo "<pre>";
            //   print_r($SQLEX);
            //  echo "</pre>";
            if ($SQLEX->num_rows>0) {
                while ($data=$SQLEX->fetch_object()) {
                    $Fetchdata[]=$data;
                    }
                    $ResData['Msg'] = "Success";
                    $ResData['Data'] = $Fetchdata;
                    $ResData['Code'] = "1";
                 
                }
              else{
                  $ResData['Msg'] = "Try again";
                  $ResData['Data'] = "0";
                  $ResData['Code'] = "0";
              }
             return $ResData;
            }  

            public function select($tbl){
                $SQL = "SELECT * FROM $tbl";
                $SQLEX = $this->connection->query($SQL);
                if ($SQLEX->num_rows>0) {
                    while ($data=$SQLEX->fetch_object()) {
                        $Fetchdata[]=$data;
                        }
                        $ResData['Msg'] = "Success";
                        $ResData['Data'] = $Fetchdata;
                        $ResData['Code'] = "1";
                    }
                  else{
                      $ResData['Msg'] = "Try again";
                      $ResData['Data'] = "0";
                      $ResData['Code'] = "0";
                  }
                 return $ResData;
                }  

                public function selectwhere($tbl,$where=""){
                    $SQL = "SELECT * FROM $tbl";
                    if ($where!="") {
                        $SQL .= " WHERE ";
                        foreach ($where as $key => $value) {
                            $SQL .= " $key = '$value' AND";
                        }
                        $SQL = rtrim($SQL,"AND");
                    }
                    // echo $SQL;
                    $SQLEX = $this->connection->query($SQL);
                    if ($SQLEX->num_rows>0) {
                        while ($data=$SQLEX->fetch_object()) {
                            $Fetchdata[]=$data;
                            }
                            $ResData['Msg'] = "Success";
                            $ResData['Data'] = $Fetchdata;
                            $ResData['Code'] = "1";
                        }
                      else{
                          $ResData['Msg'] = "Try again";
                          $ResData['Data'] = "0";
                          $ResData['Code'] = "0";
                      }
                     return $ResData;
                    }  

                public function update($tbl,$data,$where){
                    $SQL = "UPDATE $tbl SET";
                    foreach ($data as $dkey => $dvalue) {
                        $SQL .= " $dkey = '$dvalue',";
                    }
                    $SQL = rtrim($SQL,",");
                    $SQL .= " WHERE ";
                    
                    foreach ($where as $key => $value) {
                        $SQL .= "$key = '$value' ";
                    }
                    // $SQL = rtrim($SQL, "AND");
                    //  echo $SQL;
                    $SQLEx = $this->connection->query($SQL);
                    if ($SQLEx > 0) {
                        $ResData['Msg'] = "Success";
                        $ResData['Data'] = '1';
                        $ResData['Code'] = "1";
                    }else{
                        $ResData['Msg'] = "Try again";
                        $ResData['Data'] = "0";
                        $ResData['Code'] = "0";
                    }
                    return $ResData;
                }
                

                public function delete($tbl,$whr){
                    $SQL = "DELETE FROM $tbl";
                    $SQL .= " WHERE ";
                    foreach ($whr as $key => $value) {
                          $SQL .= "$key = '$value'";
                    }
                   echo $SQL;
                //    exit;
                    $SQLEX = $this->connection->query($SQL);
                    if ($SQLEX>0) {
                            $ResData['Msg'] = "Success";
                            $ResData['Data'] = "1";
                            $ResData['Code'] = "1";
                        }
                      else{
                          $ResData['Msg'] = "Try again";
                          $ResData['Data'] = "0";
                          $ResData['Code'] = "0";
                      }
                     return $ResData;
                    }  

                    public function search($tbl,$sa){
                        $SQL = "SELECT * FROM $tbl WHERE  ";  
                        $SQL .= "CONCAT(id,username,password,email,mobile,gender) LIKE '%$sa%'";
                        // $SQL .= "id LIKE '%$sa%' OR username LIKE '%$sa%' OR password LIKE '%$sa%' OR email LIKE '%$sa%' OR mobile LIKE '%$sa%' OR gender LIKE '%$sa%'";
                        // echo $SQL;
                        $SQLEX = $this->connection->query($SQL);
                        if ($SQLEX->num_rows>0) {
                            while ($data=$SQLEX->fetch_object()) {
                                $Fetchdata[]=$data;
                                }
                                $ResData['Msg'] = "Success";
                                $ResData['Data'] = $Fetchdata;
                                $ResData['Code'] = "1";
                            }
                      else{
                          $ResData['Msg'] = "Try again";
                          $ResData['Data'] = "0";
                          $ResData['Code'] = "0";
                      }
                     return $ResData;
                    }
                    public function selectjoin($tbl,$join,$where = '') {
                        $SQL = "SELECT * FROM $tbl";
                        foreach ($join as $akey => $avalue) {
                            $SQL .= " JOIN $akey ON $avalue";
                        }
                        if ($where != "") {
                            $SQL .= " WHERE ";
                    
                            foreach ($where as $key => $value) {
                                $SQL .= "$key = '$value'";
                            }
                            $SQL = rtrim($SQL,"AND");
                        }
                        $SQLEx = $this->connection->query($SQL);
                        if ($SQLEx->num_rows > 0) {
                            while ($Data = $SQLEx->fetch_object()) {
                                $FetchData[] = $Data;
                            }
                            $ResData['Msg'] = "Success";
                            $ResData['Data'] = $FetchData;
                            $ResData['Code'] = "1";
                        } else {
                            $ResData['Msg'] = "Try again";
                            $ResData['Data'] = "0";
                            $ResData['Code'] = "0";
                        }
                        return $ResData;
                    }

                    public function join($tbl,$join,$where=""){
                        $SQL = "SELECT * FROM $tbl";
                        foreach ($join as $jkey => $jvalue) {
                            $SQL .= " JOIN $jkey ON $jvalue";
                        }
                        if ($where != "") {
                            $SQL .= " WHERE";
                            foreach ($where as $key => $value) {
                                $SQL .= " $key = '$value' AND";
                            }
                            $SQL = rtrim($SQL, "AND");
                        }
                        // echo $SQL;
                        $SQLEx = $this->connection->query($SQL);
                        if ($SQLEx->num_rows > 0) {
                            while ($Data = $SQLEx->fetch_object()) {
                                $FetchData[] = $Data;
                            }
                            $ResData['Msg'] = "Success";
                            $ResData['Data'] = $FetchData;
                            $ResData['Code'] = "1";
                        } else {
                            $ResData['Msg'] = "Try again";
                            $ResData['Data'] = "0";
                            $ResData['Code'] = "0";
                        }
                        return $ResData;
                    }
                }



//  $model = new model;
//  $model->insert('users',array("username"=>"test"));
?>

