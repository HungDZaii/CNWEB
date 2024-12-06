<?php
class User{
    //Đồng
    // lưu ý : làm cả hàm getter , setter , constructor có tham số

    private $name;
    private $password;
    private $role;

    public function __construct($name, $password , $role)
    {
        $this->name = $name;
        $this->password = $password;
        $this->role = $role;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}