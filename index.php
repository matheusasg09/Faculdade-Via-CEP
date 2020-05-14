<?php
  include_once ('viacep.php');
  $address = getAddress();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumindo API</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="." method="post">
        <p>Digite o CEP para encontrar o endereço.</p>
        <input type="text" placeholder="Digite um cep..." name="cep" value="<?php echo $address->cep ?>">
        <input type="submit">
        <input type="text" placeholder="rua"    disabled name="rua"    value="<?php echo $address->logradouro ?>">
        <input type="text" placeholder="bairro" disabled name="bairro" value="<?php echo $address->bairro ?>">
        <input type="text" placeholder="cidade" disabled name="cidade" value="<?php echo $address->localidade ?? $address->cidade ?>">
        <input type="text" placeholder="estado" disabled name="estado" value="<?php echo $address->uf ?? $address->estado_info->nome ?>">
    </form>
</body>
</html>
