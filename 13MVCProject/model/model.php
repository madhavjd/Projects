<?php

date_default_timezone_set('Asia/Kolkata');
// error_reporting(0);
class Model
{
    // $connection = new mysqli("hostname","username","password","databasename");
    // $connection = new mysqli("localhost","root","","masterdatabase");
    private $connection = "";
    public function __construct()
    {
        try {
            // echo "called";
            $this->connection = new mysqli("localhost", "root", "", "masterdatabase");
            // echo "inside try";
        } catch (\Throwable $th) {
            if (!file_exists("log")) {
                mkdir("log");
            }
            $errorFileName = date('d_M_Y');
            $Error = $th->getMessage();
            $ErrorMsg = PHP_EOL . "============================================ " . PHP_EOL;
            $ErrorMsg .= "Error DateTime >> " . date('d-M-Y h:i:s A') . PHP_EOL;
            $ErrorMsg .= "Error Message  >> " . $Error . PHP_EOL;
            $ErrorMsg .= "============================================ " . PHP_EOL;
            file_put_contents("log/$errorFileName.txt", $ErrorMsg, FILE_APPEND);
            echo "<h2>$Error</h2>";
        }
    }
    public function login($uname, $pass)
    {
        $SQL = "SELECT * FROM users WHERE password='$pass' AND (username='$uname' OR email='$uname' OR mobile='$uname')";
        $SQLEx = $this->connection->query($SQL);
        // echo "<pre>";
        // print_r($SQLEx);
        // echo "</pre>";
        if ($SQLEx->num_rows > 0) {
            // $FetchData = $SQLEx->fetch_all(); //return only numeric array  []
            // $FetchData = $SQLEx->fetch_array(); //return array numeric and assoc both []
            // $FetchData = $SQLEx->fetch_row(); //return only numeric array []
            // $FetchData = $SQLEx->fetch_column(); //return column []
            // $FetchData = $SQLEx->fetch_field(); //return [name] => id [orgname] => id [table] => users[orgtable] => users[def] => [db] => masterdatabase[catalog] => def[max_length] => 0[length] => 20[charsetnr] => 63[flags] => 49699[type] => 8[decimals] => 0
            // $FetchData = $SQLEx->fetch_assoc(); //return associative array []
            // $FetchData = $SQLEx->fetch_object(); //return associative array ->

            while ($Data = $SQLEx->fetch_object()) {
                $FetchData[] = $Data;
            }
            // echo "<pre>";
            // print_r($FetchData);
            // echo "</pre>";
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
    public function selectjoin($tbl,$join,$where=""){
        $SQL = "SELECT *,users.id as userid  FROM $tbl";
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
        echo $SQL;
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
    public function select($tbl,$where="")
    {
        $SQL = "SELECT * FROM $tbl";
        if ($where != "") {
            
            $SQL .= " WHERE";
            foreach ($where as $key => $value) {
                $SQL .= " $key = '$value' AND";
            }
            $SQL = rtrim($SQL, "AND");
        }
        $SQLEx = $this->connection->query($SQL);
        // echo $SQL;
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
    // public function selectwhere($tbl,$where){
    //     $SQL = "SELECT * FROM $tbl WHERE ";
    //     foreach ($where as $key => $value) {
    //         $SQL .= " $key = '$value' AND";
    //     }
    //     $SQL = rtrim($SQL,"AND");
    //     // echo $SQL;
    //     $SQLEx = $this->connection->query($SQL);
    //     if ($SQLEx->num_rows > 0) {
    //         while ($Data = $SQLEx->fetch_object()) {
    //             $FetchData[] =$Data;
    //         }
    //         $ResData['Msg'] = "Success";
    //         $ResData['Data'] = $FetchData;
    //         $ResData['Code'] = "1";
    //     }else{
    //         $ResData['Msg'] = "Try again";
    //         $ResData['Data'] = "0";
    //         $ResData['Code'] = "0";
    //     }
    //     return $ResData;
    // }
    public function insert($tbl, $data)
    {
        $clm = implode(",", array_keys($data));
        $vls = implode("','", $data);
        // echo "<pre>";
        // print_r($data);
        // print_r($clm);
        // echo "</pre>";
        // echo $SQL = "INSERT INTO $tbl (username,password) VALUES('test','123')";
        $SQL = "INSERT INTO $tbl ($clm) VALUES('$vls')";
        $SQLEx = $this->connection->query($SQL);
        if ($SQLEx > 0) {
            $ResData['Msg'] = "Success";
            $ResData['Data'] = "1";
            $ResData['Code'] = "1";
        } else {
            $ResData['Msg'] = "Try again";
            $ResData['Data'] = "0";
            $ResData['Code'] = "0";
        }
        return $ResData;
    }
    public function update($tbl, $data, $where)
    {
        $SQL = "UPDATE $tbl SET";
        foreach ($data as $dkey => $dvalue) {
            $SQL .= " $dkey = '$dvalue',";
        }
        $SQL = rtrim($SQL, ",");
        $SQL .= " WHERE ";

        foreach ($where as $key => $value) {
            $SQL .= "$key = '$value'";
        }
        $SQL = rtrim($SQL, "AND");
        // echo $SQL;
        // exit;
        $SQLEx = $this->connection->query($SQL);
        if ($SQLEx > 0) {
            $ResData['Msg'] = "Success";
            $ResData['Data'] = '1';
            $ResData['Code'] = "1";
        } else {
            $ResData['Msg'] = "Try again";
            $ResData['Data'] = "0";
            $ResData['Code'] = "0";
        }
        return $ResData;
    }
    public function delete($tbl, $whr)
    {
        $SQL = "DELETE FROM $tbl";
        $SQL .= " WHERE ";
        foreach ($whr as $key => $value) {
            $SQL .= " $key = '$value' AND";
        }
        $SQL = rtrim($SQL, "AND");
        // echo $SQL;
        // exit;
        $SQLEx = $this->connection->query($SQL);
        if ($SQLEx > 0) {
            $ResData['Msg'] = "Success";
            $ResData['Data'] = '1';
            $ResData['Code'] = "1";
        } else {
            $ResData['Msg'] = "Try again";
            $ResData['Data'] = "0";
            $ResData['Code'] = "0";
        }
        return $ResData;
    }
}

// $Model = new  Model;
// echo "<br>";
// $Model->insert('users',array("username"=>"te","password"=>"456","email"=>"mail@asd.com","mobile"=>"9878746546"));
// echo "<br>";
// $Model->insert('city',array("title"=>"Ahmedabad","state_id"=>2));
// echo "<br>";
// $Model->insert('state',array("title"=>"Gujarat","country_id"=>2));
// echo "<br>";
// $Model->insert('country',array("title"=>"India"));
?>