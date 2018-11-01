<?php
include("elementFeature.php");

  class CrudBaseModel {
    var  $mainEntity;
    var  $featurizer = [];
    
    public function __construct($xmlFile)
    {
      $this->mainEntity = (string)$xmlFile['name'];
      
      foreach($xmlFile->attributes->children() as $attribute) { 
        $elementFeature = new ElementFeature;
        $elementFeature->name = (string)$attribute;
        $elementFeature->orderPosition = (string)$attribute['id'];
        $elementFeature->type = (string)$attribute['type'];
        $elementFeature->description = (string)$attribute['description'];
        $elementFeature->lenght = (string)$attribute['lenght'];
        $elementFeature->default = (string)$attribute['default'];
        array_push( $this->featurizer, $elementFeature);
        unset($elementFeature);
      }
    }
  }

   
  

 ?>
