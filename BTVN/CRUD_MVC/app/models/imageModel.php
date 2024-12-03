<?php
class ImageModel
{
    private $id;
    private $name;
    private $desc;
    private $img;

    public function __construct($name, $desc, $img)
    {
        $this->name = $name;
        $this->desc = $desc;
        $this->img = $img;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function getImg()
    {
        return $this->img;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }
}
