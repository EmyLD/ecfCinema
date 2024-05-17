<?php



namespace Model\repository;
use Model\Entity\User;

 class UserDao 
{
    public static function findOne($email, $password) : User | string
    {
        try {
            $querySql = 'SELECT * FROM user WHERE email = :email AND password = :password';
            $query = BDD->prepare($querySql);
            $query->execute(array('email'=> $email,'password'=> $password));
            $data = $query->fetch();
            if(!$data) {
                return 'not good';
            } else {
                $user= new User( $data['id'], $data['username'], $data['email'], $data['password']);
                return $user;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public static function addOne($username, $email, $password): bool 
        {
            try {
                $querySql = 
                'INSERT INTO user (username, email, password) 
                VALUES (:username, :email, :password)';
                $query = BDD->prepare($querySql);

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