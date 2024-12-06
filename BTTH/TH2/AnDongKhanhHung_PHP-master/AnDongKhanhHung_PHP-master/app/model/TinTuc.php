<?php
class News {
    private $id;
    private $title;
    private $content;
    private $image;
    private $createdAt;
    private $categoryId;

    // Constructor
    public function __construct($id = null, $title = null, $content = null, $image = null, $createdAt = null, $categoryId = null) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->image = $image;
        $this->createdAt = $createdAt;
        $this->categoryId = $categoryId;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getImage() {
        return $this->image;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }
}
?>