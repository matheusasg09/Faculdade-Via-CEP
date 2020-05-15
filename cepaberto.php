<?php
function getAddressCepAberto (String $cep):object {
$url = "https://www.cepaberto.com/api/v3/cep?cep={$cep}";  
$opts = array(
        'http'=>array(
            "method" => "GET",
            "header" => "Authorization: Token token=79e9692f1cb0050a1916845530525c3a" 
            )
  );
    $context = stream_context_create($opts);
    return json_decode(file_get_contents($url,false,$context));
  }