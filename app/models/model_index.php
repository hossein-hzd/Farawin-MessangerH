<?php

class model_index extends Model
{
    function __construct()
    {
        parent::__construct();
    }
    function contact_data($post)
    {
        $sql = "SELECT * FROM users WHERE user=?";
        $params = array($post['contactPhone']);
        $result = $this->doSelect($sql, $params);
        if (sizeof($result) == 0) {
            echo json_encode(array(
                    "msg" => "not found",
                    "status_code"=>  "404"
                )
            );
        } 
        else if($result[0]['id']== $this->session_get('id'))
        {echo json_encode(array(
            "msg" => "user khodeti",
            "status_code"=>  "300"
        ));}
        
        else {
            $sql = "SELECT * FROM contact WHERE contact_id=? AND user_id=?";
            $params = array($result[0]['id'],$this->session_get('id'));
            $res = $this->doSelect($sql, $params);
            if (sizeof($res) != 0) {
                echo json_encode(array(
                        "msg" => "مخاطب قبلا وارد شده",
                        "status_code"=>  "405"
                    )
                );
            } 


            else
           {
            $sql = "INSERT INTO contact (contact_id,user_id,name) VALUES (?,?,?)";
            $params = array($result[0]['id'],$this->session_get('id'),$post['contactName'] );
            $this->doQuery($sql, $params);
            echo json_encode(array(
                    "msg" => "ok",
                    "status_code"=>  "200"
                )
            );}
        }
    }
    function get_contact_data($post){
        $sql = "SELECT * FROM contact WHERE user_id=?";
        $params = array($this->session_get('id'));
        $result = $this->doSelect($sql, $params);
       
        echo json_encode(array(
            "msg" => $result,
            "status_code"=>  "600"
        ));
    }
    function edit_datan($post){
        $this->session_set("contactid", $_POST["contactid"]);
        echo json_encode(array(
            "msg" =>1,
            "status_code"=>  "301"
        ));
    }

    function edit_data($post){
        if($_POST['contactname']=='')
        {echo json_encode(array(
            "msg" =>2,
            "status_code"=>  "302"
        )) ;}  
         
        else
           { $sql=" UPDATE `contact` SET `name` = ? WHERE `contact_id` =?";
            $params = array($_POST['contactname'] ,$this->session_get('contactid'));
            $this->doQuery($sql, $params);
            echo json_encode(array(
                "msg" =>1,
                "status_code"=>  "302"
            ));
        } 
    }

    function contact_massage($post){
        if(!isset($_POST["gettext"])){ $this->session_set("getid", $_POST["getid"]);} 
        if(isset($_POST["gettext"])){  
                   
                    $sql = "INSERT INTO massage (SendID,GetID,Text) VALUES (?,?,?)";
                    $params = array($this->session_get('id'),$this->session_get('getid'),$_POST["gettext"]);
                    $this->doQuery($sql, $params);

                    $sql = "SELECT * FROM massage WHERE SendID=? AND GetID=?";
                    $params = array($this->session_get('id'),$this->session_get('getid'));
                    $result_1 = $this->doSelect($sql, $params);

                    $sql = "SELECT * FROM massage WHERE SendID=? AND GetID=?";
                    $params = array($this->session_get('getid'),$this->session_get('id'));
                    $result_2 = $this->doSelect($sql, $params);
                    $result_3=array_merge( $result_1, $result_2);
                    sort($result_3);
                    echo json_encode(array(
                        "msg" => $result_3,
                        "msg_2" =>$this->session_get('id'),
                        "status_code"=>  "606"
                    ));
                   
                    

                    
        }
    }
       
    function refresh_massage($post){

                    $sql = "SELECT * FROM massage WHERE SendID=? AND GetID=?";
                    $params = array($this->session_get('id'), $_POST["idm"]);
                    $result_1 = $this->doSelect($sql, $params);

                    $sql = "SELECT * FROM massage WHERE SendID=? AND GetID=?";
                    $params = array($_POST["idm"],$this->session_get('id'));
                    $result_2 = $this->doSelect($sql, $params);
                    $result_3=array_merge( $result_1, $result_2);
                    sort($result_3);
                    echo json_encode(array(
                        "msg" => $result_3,
                        "msg_2" =>$this->session_get('id'),
                        "status_code"=>  "606"
                    ));            

                    
    }
    function edit_massage($post){
        if(isset($_POST['idm']))  {$this->session_set("idp", $_POST["idm"]);}
        if(isset($_POST['newmassage']))
       {         $sql=" UPDATE massage SET Text = ? WHERE ID =?";
                $params = array($_POST['newmassage'] ,$this->session_get('idp'));
                $this->doQuery($sql, $params);

         
      }
      $sql = "SELECT * FROM massage WHERE ID=?";
      $params = array($this->session_get('idp'));
      $result= $this->doSelect($sql, $params);
      echo json_encode(array(
          "msg" =>$result,
          "status_code"=>  "308"
      ));
      if(isset($_POST['remove'])){
        $sql="DELETE FROM massage WHERE ID=?";
        $params = array($this->session_get('idp'));
        $this->doQuery($sql, $params);
      
      }
    }

}     
     

   


?>