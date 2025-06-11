<?php

class model_register extends model
{
    function __construct()
    {
        parent::__construct();
    }
    function insert_data($post)
    {
        $sql = "SELECT * FROM users WHERE user=?";
        $params = array($post['username']);
        $result = $this->doSelect($sql, $params);

        if (sizeof($result) == 0) {
            $g=0;
            $sql = "INSERT INTO users (user,password,registerdate) VALUES (?,?,?)";
            $params = array($post['username'], md5($post['password']), self::jalali_date("Y/m/d"));
            $this->doQuery($sql, $params);
            echo json_encode(
                array(
                    "msg" => "ok",
                    "status_code"=>  "200",
                )
            );
           
        } else {
            echo json_encode(
                array(
                    "msg" => "not found",
                    "status_code"=>  "404" 
                )
            );
           
        }
    }

}