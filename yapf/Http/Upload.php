<?php

class yapf_Http_Upload
{
    var $file;

    var $tmp_name;

    var $name;

    var $extension;

    var $type;

    var $fileName;

    var $uploadPath;

    public function __construct($name)
    {
        if(isset($_FILES[$name])){
            foreach($_FILES[$name] as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    /**
     * @param $name
     * @return bool
     */
    public function getFile($name)
    {
        return $this->file;
    }

    public function setFileName($name){
        $pathinfo = pathinfo($this->file['name']);
        $this->fileName = $name . '.' .$pathinfo['extension'];
    }

    public function setUploadPath($path) {
        $this->uploadPath = $path;
    }

    public function upload(){
        move_uploaded_file($this->file['tmp_name'], $this->uploadPath . $this->fileName);
    }
}