<?php

/**
 * Clase para el manejo de imagenes
 * Proovee herramientas necesarias para redimencionar imagenes, y obtener los datos necesarios
 * para guardarlos en base de datos en un campo blob, para posteriormente ser leidos e impresos.
 * 
 *
 * @author Habacuc Hernandez
 * @since v1.0 2013-07-22
 */

class ImagesManager 
{
    // constantes para la clase
    const DEFAULT_POST_IMAGE_WIDTH = 640;
    const DEFAULT_POST_IMAGE_HEIGHT = 415;
    
    // tama?o por default
    private $_x;
    private $_y;
    
    public function __construct($x = self::DEFAULT_POST_IMAGE_WIDTH, $y = self::DEFAULT_POST_IMAGE_HEIGHT){
       $this->_x = $x;
       $this->_y = $y;
    }
    
    public function getWidth(){ return $this->_x;}
    public function getHeight(){ return $this->_y;}

    /**
     * Metodo que recibe una imagen y la re-ensambla ajustando sus tamanios
     * 
     * @param resource $originalImage
     * @param integer $newImageWidth
     * @param integer $newImageHeight
     * @return resource
     */
    public function resizeImage($originalImage,$newImageWidth ,$newImageHeight){
        
        $originalImageWidth = imagesx($originalImage);
        $originalImageHeight = imagesy($originalImage);
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        imagecopyresampled($newImage, $originalImage, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $originalImageWidth, $originalImageHeight);
        
        return $newImage;
    }
    
    /**
     * Medoto que recibe los datos de imagen de la superglobal $_FILES['imagen'] y que regresa un $string,
     * con los datos de la imagen comprimida y ajustada a x e y defaults, para poder ser impreso
     * mediante la siguiente nomenclatura '<img src="data:image/jpeg;base64,'.base64_encode($string).'"/>'
     * 
     * @param array $imageFilesData
     * @return string (los datos en base64 del resource recibido)
     */
    
    public function imageData($imageFilesData){
        $newImageData = false;
        
        $tmpImagePath = $imageFilesData['tmp_name'];
        if($tmpImagePath != false && $tmpImagePath != ''){
            
            // creamos la imagen a partir de los datos del archivo temporal
            $dataImg = file_get_contents($tmpImagePath);
            $image = imagecreatefromstring($dataImg);
            $newImage = $this->resizeImage($image, $this->_x, $this->_y);
            imagedestroy($image);
            $newImageData = $this->changeImageToJpg($newImage);
            imagedestroy($newImage);
        }
 
        return $newImageData;
    }
    
    /**
     * Metodo que genera un peque?o buffer de la imagen en jpg y lo regresa ya como JPG
     * 
     * @param resource $image
     * @return resource
     */
    private function changeImageToJpg($image){
        ob_start();
        imagejpeg($image); 
        $jpgImageBuffer = ob_get_clean();
        return $jpgImageBuffer;
    }
}