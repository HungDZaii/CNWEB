<?php
require_once __DIR__ . '/dbConnect.php';
require_once __DIR__ . '/User.php';

class DataUser
{
    private $conn;

    public function __construct(Database $database)
    {
        $this->conn = $database->getConnection();
    }

    // Lấy dữ liệu user bằng PDO
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users WHERE role = :role";
        $role = 0;
        $news = [];

        try {
            $stmt = $this->conn->prepare($sql); // Chuẩn bị câu lệnh SQL
            $stmt->bindParam(':role', $role, PDO::PARAM_INT);
            $stmt->execute(); // Thực thi câu lệnh
            $news = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả dữ liệu dạng mảng kết hợp
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        return $news;
    }
    // Lấy thông tin người dùng theo tên (optional)
    public function getUserByName($name)
    {
        $sql = "SELECT * FROM users WHERE username = :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserNamePass($name , $password)
    {
        $sql = "SELECT * FROM users WHERE username = :name AND password = :password";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Thêm user mới
    public function addUser(User $user)
    {
        $name = $user->getName();
        $password = $user->getPassword();
        $role = $user->getRole();
        $query = "INSERT INTO users (username, password, role) VALUES (:name, :password, :role)";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':password', $user->getPassword());
            $stmt->bindValue(':role', $user->getRole());
            $stmt->execute();
            echo "Thêm thành công";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Sửa thông tin user
    public function updateUser(User $user, $id)
    {
        $name = $user->getName();
        $password = $user->getPassword();
        $role = $user->getRole();
        // Câu lệnh SQL cập nhật
        $sql = "UPDATE users SET username = :name, password = :password, role = :role WHERE id = :id";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':password', $password); // Nếu cần mã hóa, xử lý trước khi truyền vào
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':id', $id);
            return $stmt->execute(); // Thực thi lệnh SQL
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


    // Xóa user
    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
