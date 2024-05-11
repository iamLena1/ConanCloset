<?php

session_start();

class Login
{
    private $error = "";

    public function evaluateUser($data)
    {
        $email = $data['email'];
        $password = $data['password'];

        $query = "select * from user where email = '$email' limit 1";
        
        $DB = new Database();
        $result = $DB->read($query);
        

        if($result)
        {
            $row = $result[0];

            if($password == $row['password'])
            {
                $_SESSION['ConanCloset_ID'] = $row['ID'];
            }
            else
            {
                $this->error .= "The email or password is incorrect<br>";
            }
        }
        else
        {
            $this->error .= "The email or password is incorrect<br>";
        }

        return $this->error;
    
    }

    public function check_loginUser($id)
    {
        $query = "select * from user where ID = '$id' limit 1 ";

        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            return true;
        }

        return false;
    }




    public function evaluateAdmin($data)
    {
        $email = $data['email'];
        $password = $data['password'];

        $query = "select * from admin where email = '$email' limit 1";
        
        $DB = new Database();
        $result = $DB->read($query);
        

        if($result)
        {
            $row = $result[0];

            if($password == $row['Password'])
            {
                $_SESSION['ConanCloset_ID'] = $row['ID'];
            }
            else
            {
                $this->error .= "The email or password is incorrect<br>";
            }
        }
        else
        {
            $this->error .= "The email or password is incorrect<br>";
        }

        return $this->error;
    
    }


    public function check_loginAdmin($id)
    {
        $query = "select * from admin where ID = '$id' limit 1 ";

        $DB = new Database();
        $result = $DB->read($query);

        if($result)
        {
            return true;
        }

        return false;
    }
}