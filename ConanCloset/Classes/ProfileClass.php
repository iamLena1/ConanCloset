<?php

class User
{
    public function get_dataUser($id) 
    {
        $query = "select * from user where ID = '$id' limit 1 ";

        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            $row = $result[0];
            return $row;
        }
        else
        {
            return false;
        }
    }


    public function get_dataAdmin($id) 
    {
        $query = "select * from admin where ID = '$id' limit 1 ";

        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            $row = $result[0];
            return $row;
        }
        else
        {
            return false;
        }
    }
}
?>