<?php
/**
 * Ejemplo del uso de la calse ImagesManager, la cual toma una imagen, la redimenciona y regresa
 * el data del resource para poder ser guardada en base o imprimirla.
 * 
 * @author Habacuc Hernandez  http://www.habacuchernandez.com/
 * @since v1.0 2013-07-22
 */
include_once 'ImagesManager.php';

if (isset($_FILES['image'])) {
    $imagenManager = new ImagesManager(); // coloca aqui x e y al que se redimencionara tu imagen.
    $dataImg = $imagenManager->imageData($_FILES['image']);
    echo 'Imagen tratada a un tama&ntilde;o de ' . $imagenManager->getWidth() . 'px x ' . $imagenManager->getHeight() . 'px<br>';
    echo '<img src="data:image/jpeg;base64,' . base64_encode($dataImg) . '"/>';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ejemplo del manejador de imagenes | Habacuc Hernandez</title>
        <style>
            body{
                background-color: lightgray;
                font: 200 12px/1.5 Georgia, Times New Roman, serif;
                text-align: center;
            }
        </style>
    </head>    
    <body>
        <h2>Ejemplo de manejador de im&aacute;genes:</h2>
        <hr>
        <div>
            <p>Selecciona la imagen que quieres tratar y redimecionar:</p>
            <form method="POST" enctype="multipart/form-data">
                <label class="control-label">Im&aacute;gen:</label>
                <input id="image" name="image" type="file" value=""/>
                <br>
                <input type="submit" value="Enviar">
            </form>
        </div>
        <small><a href="http://www.habacuchernandez.com" target="_BLANK">Habacuc Hern&aacute;ndez Ram&iacute;rez</a></small>
    </body>
</html>