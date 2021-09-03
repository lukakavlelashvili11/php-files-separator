<?php

namespace app\controllers;

use ZipArchive;

class zipController{

    private $files = [];
    private $zip;
    private $zip_name;

    public function __construct($files,$details){
        $this->files = $files['files'];
        $this->zip = new ZipArchive();

        if(isset($details['name'])){
            $name = htmlspecialchars($details['name']).'.zip';
        }else{
            $name = time().".zip";
        }
        $zip_name = realpath('uploads').'/'.$name;
        $this->zip_name = $name;
        $this->zip->open($zip_name,(ZipArchive::CREATE | ZipArchive::OVERWRITE));

        if(isset($details['sortType'])){
            $this->{'sortBy'.$details['sortType']}($zip_name);
        }
    }

    public function sortByType(): void{
        for($i = 0;$i < count($this->files['tmp_name']);$i++){
            if($this->files['size'][$i] != 0){
                $content = file_get_contents($this->files['tmp_name'][$i]);
                $file_name = explode('/',$this->files['type'][$i])[0];
                $this->zip->addFromString($file_name.'/'.$this->files['name'][$i],$content);
            }
        }
        
    }

    public function sortByExtension(): void{
        for($i = 0;$i < count($this->files['tmp_name']);$i++){
            if($this->files['size'][$i] != 0){
                $content = file_get_contents($this->files['tmp_name'][$i]);
                $file_name = explode('.',$this->files['name'][$i])[1];
                $this->zip->addFromString($file_name.'/'.$this->files['name'][$i],$content);
            }
        }
    }

    public function getDir(): string{
        return $this->zip_name;
    }
}
