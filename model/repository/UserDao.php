<?php


namespace Model\repository;
use Model\repository\Dao;

 class UserDao extends Dao
{
    public  function findOne($email, $password) : string  
    {
        try {
            $querySql = 'SELECT * FROM user WHERE email = :email AND password = :password';
            $query = $this->pdo->prepare($querySql);
            $query->execute(array('email'=> $email,'password'=> $password));
            $data = $query->fetch();
            if($data) {
               $user = $data['username'];
               return $user;
            } else {
              return false;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public  function addOne($username, $email, $password): bool 
        {
            try {
                $querySql = 
                'INSERT INTO user (username, email, password) 
                VALUES (:username, :email, :password)';
                $query = $this->pdo->prepare($querySql);

                $isAdded = $query->execute(
                    array(
                        ':username' => $username, 
                        ':email' => $email, 
                        ':password' => $password
                    ));
                if(!$isAdded) {
                    return false;
                } else {
                    return true;
                }
            } catch (\Throwable $th) {
                throw $th;
            }
    }
}