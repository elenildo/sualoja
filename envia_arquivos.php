<html>
<head>
   <title>Multiple Upload</title>
</head>
<body>
   <form action="#" method="POST" enctype="multipart/form-data">
      <input type="file" name="fileUpload[]" multiple>
      <input type="submit" value="Enviar">
   </form>
</body>
</html>
 
<?php
   if(isset($_FILES['fileUpload']))
   {
      require 'WideImage/WideImage.php'; //Inclui classe WideImage � p�gina
 
      date_default_timezone_set("Brazil/East");
 
      $name 	= $_FILES['fileUpload']['name']; //Atribui uma array com os nomes dos arquivos � vari�vel
      $tmp_name = $_FILES['fileUpload']['tmp_name']; //Atribui uma array com os nomes tempor�rios dos arquivos � vari�vel
 
      $allowedExts = array(".gif", ".jpeg", ".jpg", ".png", ".bmp"); //Extens�es permitidas
 
      $dir = 'uploads/';
 
      for($i = 0; $i < count($tmp_name); $i++) //passa por todos os arquivos
      {
         $ext = strtolower(substr($name[$i],-4));
 
         if(in_array($ext, $allowedExts)) //Pergunta se a extens�o do arquivo, est� presente no array das extens�es permitidas
         {
            $new_name = date("Y.m.d-H.i.s") ."-". $i . $ext;
 
            $image = WideImage::load($tmp_name[$i]); //Carrega a imagem utilizando a WideImage
 
            $image = $image->resize(170, 180, 'outside'); //Redimensiona a imagem para 170 de largura e 180 de altura, mantendo sua propor��o no m�ximo poss�vel
            $image = $image->crop('center', 'center', 170, 180); //Corta a imagem do centro, for�ando sua altura e largura
 
            $image->saveToFile($dir.$new_name); //Salva a imagem
         }
      }
   }
?>