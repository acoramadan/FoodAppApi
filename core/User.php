<?php

Class User {
    private $conn;
    private $table = 'user';

    private $id;
    private $userName;
    private $email;
    private $password;
    private $phoneNumber;
    private $createdAt;
    private $modified;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function read() {
        $query = 'SELECT * FROM '.$this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function userLogin() {
        $query = 'SELECT * FROM '.$this->table.' WHERE email = ? AND password = ? LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->password);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function createUser() {
        $query = 'INSERT INTO '.$this->table.' SET user_name = :username, email = :email, password = :password, phone_number = :phone_number';
        $stmt = $this->conn->prepare($query);
        $this->userName = htmlspecialchars(strip_tags($this->userName));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->phoneNumber = htmlspecialchars(strip_tags($this->phoneNumber));
        $stmt->bindParam(':username', $this->userName);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':phone_number', $this->phoneNumber);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePasswordByEmail() {
        $query = 'UPDATE '.$this->table.' SET password = :password WHERE email = :email';
        $stmt = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updatePasswordById() {
        $query = 'UPDATE '.$this->table.' SET password = :password WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->id));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':password', $this->password);
        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getUserById() {
        $query = 'SELECT * FROM '.$this->table.' WHERE id = ? LIMIT 1';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setUserName($userName) {
        $this->userName = $userName;
    }
    public function setNoTelp($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }
    public function setModified($modified) {
        $this->modified = $modified;
    }
    public function getModified() {
        return $this->modified;
    }
    public function getCreatedAt() {
        return $this->createdAt;
    }
    public function getPhoneNumber() {
        return $this->phoneNumber;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getUserName() {
        return $this->userName;
    }
}