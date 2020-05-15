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
        'uf' => $response->uf,
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
  $url = "https://viacep.com.br/ws/{$cep}/json/";
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
    'localidade' => '',
    'uf' => '',
  ];
}
