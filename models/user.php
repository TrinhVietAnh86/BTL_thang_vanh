<?php
require_once 'connect/connect.php';

class User {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = Database::connect(); // Sử dụng kết nối từ connect/connect.php
            if (!$this->pdo) {
                throw new PDOException("Không thể kết nối cơ sở dữ liệu.");
            }
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            throw new PDOException($e->getMessage());
        }
    }

    public function checkUserExists($username, $email) {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Error in checkUserExists: " . $e->getMessage());
            return true; // Giả định tồn tại để tránh lỗi bảo mật
        }
    }

    public function register($username, $email, $phone, $address, $password, $role = 'user') {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("INSERT INTO users (username, email, phone, address, password, role) VALUES (?, ?, ?, ?, ?, ?)");
            return $stmt->execute([$username, $email, $phone, $address, $hashedPassword, $role]);
        } catch (PDOException $e) {
            error_log("Error in register: " . $e->getMessage());
            return false;
        }
    }

    public function getAll() {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error in getAll: " . $e->getMessage());
            return [];
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error in getById: " . $e->getMessage());
            return false;
        }
    }

    public function getByEmail($email) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error in getByEmail: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $username, $email, $phone, $address, $password = null, $role = null) {
    try {
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare("UPDATE users SET username = ?, email = ?, phone = ?, address = ?, password = ?, role = ? WHERE id = ?");
            return $stmt->execute([$username, $email, $phone, $address, $hashedPassword, $role, $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE users SET username = ?, email = ?, phone = ?, address = ?, role = ? WHERE id = ?");
            return $stmt->execute([$username, $email, $phone, $address, $role, $id]);
        }
    } catch (PDOException $e) {
        error_log("Error in update: " . $e->getMessage());
        return false;
    }
}

    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error in delete: " . $e->getMessage());
            return false;
        }
    }

    public function login($identifier, $password) {
        try {
            error_log("Login attempt: identifier=$identifier, password=$password");
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$identifier, $identifier]);
            $user = $stmt->fetch();

            error_log("User found: " . json_encode($user));

            if ($user && password_verify($password, $user['password'])) {
                error_log("Login successful for user: " . $user['username']);
                return $user;
            }

            error_log("Login failed: Invalid credentials");
            return false;
        } catch (PDOException $e) {
            error_log("Error in login: " . $e->getMessage());
            return false;
        }
    }
}