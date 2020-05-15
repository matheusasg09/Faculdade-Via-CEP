<?php
function getAddress()
{
  if (isset($_POST['cep'])) {
    $cep = $_POST['cep'];
    $cep = filterCep($cep);

    if (isCep($cep)) {
      $response = getAddressViaCep($cep);
      $address = (object) [
        'cep' => $response->cep,
        'logradouro' => $response->logradouro,
        'bairro' => $response->bairro,
        'cidade' => $response->cidade,
        'uf' => $response->estado
      ];
      
      if (property_exists($address, 'erro')) {
        $address = addressEmpty();
        $address->cep = 'CEP não encontrado"';
      }
    } else {
      $address = addressEmpty();
      $address->cep = 'CEP Inválido"';
    }
  } else {
    $address = addressEmpty();
  }
  return $address;
}

function isCep(String $cep): bool
{
  return preg_match('/^[0-9]{5}-?[0-9]{3}$/', $cep);
}

function getAddressViaCep(String $cep)
{
  $url = "https://api.postmon.com.br/v1/cep/{$cep}";
  return json_decode(file_get_contents($url));
}

function filterCep(String $cep): String
{
  return preg_replace('/[^0-9]/', '', $cep);
}

function addressEmpty()
{
  return (object) [
    'cep' => '',
    'logradouro' => '',
    'bairro' => '',
    'cidade' => '',
    'uf' => '',
  ];
}
