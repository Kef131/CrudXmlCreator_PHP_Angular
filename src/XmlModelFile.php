<?php

class XmlModelFile {
  var $namefile;
  var $pathFile;

  public function __construct($name,$path){
    $this->namefile = $name;
    $this->pathFile = $path;    
  }
  
  function readXmlFile(){
    if (file_exists($this->pathFile)) { 
      $xml = simplexml_load_file($this->pathFile);
      return $xml;
    } else {
      echo '<script language="javascript">';
      echo 'alert("Error with XML File")';
      echo '</script>';
    }
  }

  function readXmlString(){
      if ($xml = simplexml_load_string($this->pathFile)){
        return $xml;
      }else{
        echo '<script language="javascript">';
        echo 'alert("Error with XML String")';
        echo '</script>';
      }
      
  }
}
?>
