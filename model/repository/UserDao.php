<?php

 class UserDao 
{
    public static function getOne(int $id): User
    {
        $query = BDD->prepare('SELECT * FROM users WHERE id = :id_user');
        $query->execute(array(':id_user' => $id));
        $data = $query->fetch();
        return new Actor($data['id'], $data['name'], $data['firstname']);
    }

    public static function addOne($data): User
        $hashPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        {
        $query = BDD->prepare('INSERT INTO users (firstname, lastname, password) VALUES (:firstname, :lastname, :password)');
        return $query->execute(array(':firstname' => $data['firstname'], ':lastname' => $data['lastname'], ':password' => $hashPassword));
        }
    }
