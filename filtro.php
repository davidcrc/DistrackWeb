<?php
function HTML_filtro($contenido){
      $contenido=preg_replace("/�/","&ntilde;",$contenido);
      $contenido=preg_replace("/�/","&Ntilde;",$contenido);
      $contenido=preg_replace("/�/","&aacute;",$contenido);
      $contenido=preg_replace("/�/","&Aacute;",$contenido);
      $contenido=preg_replace("/�/","&eacute;",$contenido);
      $contenido=preg_replace("/�/","&Eacute;",$contenido);
      $contenido=preg_replace("/�/","&iacute;",$contenido);
      $contenido=preg_replace("/�/","&Iacute;",$contenido);
      $contenido=preg_replace("/�/","&oacute;",$contenido);
      $contenido=preg_replace("/�/","&Oacute;",$contenido);
      $contenido=preg_replace("/�/","&uacute;",$contenido);
      $contenido=preg_replace("/�/","&Uacute;",$contenido);
      $contenido=preg_replace("/�/","&Igrave;",$contenido);
      $contenido=preg_replace("/�/","&Ograve;",$contenido);
      $contenido=preg_replace("/�/","&Ugrave;",$contenido);
      $contenido=preg_replace("/N�/","N&ordm;",$contenido);
      $contenido=preg_replace("/N�/","N&ordm;",$contenido);
      $contenido=preg_replace("/1�/","1&ordm;",$contenido);
      $contenido=preg_replace("/2�/","2&ordm;",$contenido);
      $contenido=preg_replace("/3�/","3&ordm;",$contenido);
      $contenido=preg_replace("/4�/","4&ordm;",$contenido);
      $contenido=preg_replace("/5�/","5&ordm;",$contenido);
      $contenido=preg_replace("/6�/","6&ordm;",$contenido);
      $contenido=preg_replace("/7�/","7&ordm;",$contenido);
      $contenido=preg_replace("/8�/","8&ordm;",$contenido);
      $contenido=preg_replace("/9�/","9&ordm;",$contenido);
      $contenido=preg_replace("/1�/","1&ordm;",$contenido);
      $contenido=preg_replace("/2�/","2&ordm;",$contenido);
      $contenido=preg_replace("/�/","'",$contenido);
      $contenido=preg_replace("/�C/","&ordm;C",$contenido);
      return $contenido;
   }
   
?>