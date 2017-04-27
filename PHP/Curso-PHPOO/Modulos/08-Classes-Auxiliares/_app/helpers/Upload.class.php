<?php

/**
 * Upload.class [HELPER]
 * Classe responsável por executar todo o gerenciamento de uploads no sistema
 * 
 */
class Upload {

    private $file;
    private $name;
    private $send;              //caminho do arquivo
    private $width;
    private $image;
    private $result;
    private $error;
    private $folder;
    private static $baseDir;

    public function __construct($baseDir = null) {
        self::$baseDir = ((string) $baseDir ? $baseDir : '../uploads/');
        if (!file_exists(self::$baseDir) && !is_dir(self::$baseDir)) {
            mkdir(self::$baseDir, 0777);
        }
    }

    public function Image(array $image, $name = null, $width = null, $folder = null) {
        $this->file = $image;
        $this->name = ((string) $name ? $name : substr($image['name'], 0, strpos($image['name'], '.')));
        $this->width = ((int) $width ? $width : 1024);
        $this->folder = ((string) $folder ? $folder : 'imagens');

        $this->CheckFolder($this->folder);
        $this->SetFileName();
        $this->UploadImage();
    }
    
    public function File(array $file, $name = null, $folder = null, $maxFileSize = null) {
        $this->file = $file;
        $this->name = ((string) $name ? $name : substr($file['name'], 0, strpos($file['name'], '.')));
        $this->folder = ((string) $folder ? $folder : 'files');
        $maxFileSize = ((int) $maxFileSize ? $maxFileSize : 2);
        
        $file_accept = [
            'application/octet-stream',
            'application/pdf'
        ];
        
        if($this->file['size'] > ($maxFileSize * (1024*1024))){
            $this->result = false;
            $this->error = "Tamanho do arquivo maior que o permitido. O tamanho permitido é {$maxFileSize}mb!";
        }else if(!in_array($this->file['type'], $file_accept)){
            $this->result = false;
            $this->error = "Arquivo não suportado! Arquivos aceitos: RAR e PDF!";            
        }else{
            $this->CheckFolder($this->folder);
            $this->SetFileName();
            $this->UploadFile();
        }        
    }

        public function Media(array $media, $name = null, $folder = null, $maxFileSize = null) {
        $this->file = $media;
        $this->name = ((string) $name ? $name : substr($media['name'], 0, strpos($media['name'], '.')));
        $this->folder = ((string) $folder ? $folder : 'media');
        $maxFileSize = ((int) $maxFileSize ? $maxFileSize : 40);
        
        $file_accept = [
            'audio/mp3',
            'video/mp4'
        ];
        
        if($this->file['size'] > ($maxFileSize * (1024*1024))){
            $this->result = false;
            $this->error = "Tamanho do arquivo maior que o permitido. O tamanho permitido é {$maxFileSize}mb!";
        }else if(!in_array($this->file['type'], $file_accept)){
            $this->result = false;
            $this->error = "Arquivo não suportado! Arquivos aceitos: RAR e PDF!";            
        }else{
            $this->CheckFolder($this->folder);
            $this->SetFileName();
            $this->UploadFile();
        }
        
        
    }

    
    public function getResult() {
        return $this->result;
    }

    public function getError() {
        return $this->error;
    }

    private function CheckFolder($folder) {
        list($y, $m) = explode("/", date("Y/m"));
        $this->CreateFolder("{$folder}/");
        $this->CreateFolder("{$folder}/{$y}/");
        $this->CreateFolder("{$folder}/{$y}/{$m}/");
        $this->send = "{$folder}/{$y}/{$m}/";
    }

    private function CreateFolder($folder) {
        if (!file_exists(self::$baseDir . $folder) && !is_dir(self::$baseDir . $folder)) {
            mkdir(self::$baseDir . $folder, 0777);
        }
    }

    private function SetFileName() {
        $fileName = Check::Nome($this->name) . strrchr($this->file['name'], '.');
        if (file_exists(self::$baseDir . $this->send . $fileName)) {
            $fileName = Check::Nome($this->name) . "-" . time() . strrchr($this->file['name'], '.');
        }
        $this->name = $fileName;
    }

    private function UploadImage() {

        switch ($this->file['type']) {
            case "image/jpg":
            case "image/jpeg":
            case "image/pjpeg":
                $this->image = imagecreatefromjpeg($this->file['tmp_name']);
                break;
            case "image/png":
            case "image/x-png":
                $this->image = imagecreatefrompng($this->file['tmp_name']);
                break;
        }

        if (!$this->image) {
            $this->result = false;
            $this->error = "Formato inválido de imagem, por favor informe uma imagem em JPG ou PNG!";
        } else {
            $x = imagesx($this->image);
            $y = imagesy($this->image);
            $imageW = ($this->width < $x ? $this->width : $x);
            $imageH = ($this->width * $y) / $x;

            $newImage = imagecreatetruecolor($imageW, $imageH);
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $imageW, $imageW, $x, $y);

            switch ($this->file['type']) {
                case "image/jpg":
                case "image/jpeg":
                case "image/pjpeg":
                    imagejpeg($this->image, self::$baseDir . $this->send . $this->name);
                    break;
                case "image/png":
                case "image/x-png":
                    imagepng($this->image, self::$baseDir . $this->send . $this->name);
                    break;
            }
            
            if(!$newImage){
                $this->result = false;
                $this->error = "Formato inválido de imagem, por favor informe uma imagem em JPG ou PNG!";
            }else{
                $this->result = "{$this->name}";
                $this->error = null;
            }
            
            imagedestroy($newImage);
            imagedestroy($this->image);
        }
    }
    
    private function UploadFile() {
        if(move_uploaded_file($this->file['tmp_name'], self::$baseDir . $this->send . $this->name)){
            $this->result = $this->name;
            $this->error = null;
        }else{
            $this->result = false;
            $this->error = "Erro ao mover o arquivo! Favor tente novamente mais tarde.";
        }
    }

}
