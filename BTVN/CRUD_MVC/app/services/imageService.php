<?php
require_once __DIR__ . '/../models/databaseModel.php';
require_once __DIR__ . '/../models/imageModel.php';
class ImageService{
    private DatabaseModel $databaseModel;

    public function __construct()
    {
        $this->databaseModel = new DatabaseModel();
    }

    public function getAllImg(){
        return $this->databaseModel->getAll();
    }

    public function addImg(ImageModel $imageModel){
        return $this->databaseModel->add(($imageModel));
    }

    public function EditImg(ImageModel $imageModel , $id){
        return $this->databaseModel->edit($imageModel , $id);
    }

    public function RemoveImg($id){
        return $this->databaseModel->delete($id);
    }
}