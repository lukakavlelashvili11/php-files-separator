<?php

namespace app\controllers;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

class zipController{

    private $files = [];
    private $zip;

    public function __construct($files,$details){
        $this->files = $files['files'];
        $this->zip = new ZipArchive();

        if(isset($details['name'])){
            $zip_name = htmlspecialchars($details['name']).'.zip';
        }else{
            $zip_name = time().".zip";
        }

        $this->zip->open($zip_name,(ZipArchive::CREATE | ZipArchive::OVERWRITE));

        if(isset($details['sortType'])){
            $this->{'sortBy'.$details['sortType']}($zip_name);
        }

        // return $this->getDir($zip_name);
    }

    public function sortByType($name){
        // $dir = 'uploads';
        // $zip_file = $name;
        // $rootPath = realpath($dir);
        // $files = new RecursiveIteratorIterator(
        //     new RecursiveDirectoryIterator($rootPath),
        //     RecursiveIteratorIterator::LEAVES_ONLY
        // );
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

    // public function getDir($name){
    //     chdir('..');
    //     rename($name,'uploads/'.$name);
    //     return 'uploads/'.$name;
    // }
}