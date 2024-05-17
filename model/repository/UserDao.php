<?php



namespace Model\repository;


 class UserDao 
{
    public static function findOne($email, $password)
    {
        try {
            $querySql = 'SELECT * FROM user WHERE email = :email AND password = :password';
            $query = BDD->prepare($querySql);
            $query->execute(array('email'=> $email,'password'=> $password));
            $data = $query->fetch();
            return $data;
            // if(!$data) {
            //     return 'not good';
            // } else {
            //     return new User( $data['id'], $data['username'], $data['email'], $data['password']);
            // }
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    // public static function register($data): User
    //     {
    //         $querySql = 
    //         'INSERT INTO users (firstname, lastname, password) 
    //         VALUES (:firstname, :lastname, :password)';

    //         $query = BDD->prepare($querySql);

    //         $query->execute(
    //             array(
    //                 ':firstname' => $data['firstname'], 
    //                 ':lastname' => $data['lastname'], 
    //                 ':password' => $data['password']
    //             ));

    //         return new User($data['id'], $data['firstname'], $data['lastname'], $data['password']);
    //     }
    }
