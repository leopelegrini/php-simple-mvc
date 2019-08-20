<?php

class User extends Model
{

    public function create($data)
    {
        $query = $this->conn->pdo->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

        $query->bindValue(':name', $data['name']);

        $query->bindValue(':email', $data['email']);

        $query->bindValue(':password', $data['password']);

        if($query->execute()){
            return true;
        }
        else {
            return false;
        }
    }

    public function emailExists($email)
    {
        $query = $this->conn->pdo->prepare('SELECT * FROM users WHERE email = :email');
        
        $query->bindValue(':email', $email, PDO::PARAM_STR);

        $query->execute();

        $query->fetch(PDO::FETCH_OBJ);

        return $query->rowCount();
    }

    public function login($email, $password)
    {
        $query = $this->conn->pdo->prepare('SELECT * FROM users WHERE email = :email');

        $query->bindValue(':email', $email, PDO::PARAM_STR);

        $query->execute();

        $row = $query->fetch(PDO::FETCH_OBJ);
        
        $hashed_password = $row->password;

        if(password_verify($password, $hashed_password)){
            return $row;
        } else {
            return false;
        }
    }
}