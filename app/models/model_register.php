<?php

class model_register extends model
{
    function __construct()
    {
        parent::__construct();
    }
    function insert_data($post)
    {
        $sql = "SELECT * FROM usersm WHERE user=?";
        $params = array($post['username']);
        $result = $this->doSelect($sql, $params);

        if (sizeof($result) == 0) {
            $g=0;
            $sql = "INSERT INTO usersm (user,password,registerdate) VALUES (?,?,?)";
            $jalaliDate = self::jalali_date("Y/m/d");
            $gregorianDate = self::jalali_to_miladi($jalaliDate, '/', '-');
            $dateTime = $gregorianDate . " 00:00:00";
            $params = array($post['username'], md5($post['password']), $dateTime);
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