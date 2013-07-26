Autor: Habacuc Hernandez Ramirez

Ejemplo de la clase ImagesManager, la cual toma una enviada de la superglobal $_FILES y la 
trata (redimenciona y cipia) y regresa un resource del contenido de la misma para:
- guardarse en base, de preferencia en un registro BLOB 
- imprimerse, indicando los datos desde el src de la imagen ejemplo:
		echo '<img src="data:image/jpeg;base64,'.base64_encode($stringData).'"/>';