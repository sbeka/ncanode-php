<?php

include_once './BSNCANode/BSNCANode.php';

if (isset($_POST['p12_pass']) && isset($_FILES['p12'])) {
  $nca = new BSNCANode($_FILES['p12']['tmp_name'], $_POST['p12_pass']);

  $filePdf = $nca->convertFileToBase64($_FILES['document']['tmp_name']);

  $rawSign = $nca->RAW_sign($filePdf);

  $pdf = $nca->convertBase64ToFile($rawSign['result']['cms'], 'document-signed.pdf');
  print_r($pdf);

  /*$verify = $nca->RAW_verify($cms);
  print_r($verify);*/
}
?>

<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <hr>
  <form action="" method="post" enctype="multipart/form-data">
    <div>
      <label>Выберите ЭЦП:</label>
      <input type="file" name="p12">
    </div>
    <div>
      <label>Введите пароль:</label>
      <input type="password" name="p12_pass">
    </div>
    <div>
      <label>Выберите документ:</label>
      <input type="file" name="document">
    </div>
    <button type="submit">upload</button>
  </form>
</body>
</html>
