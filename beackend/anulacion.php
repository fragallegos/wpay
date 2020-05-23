<?php
if(isset($_POST['ctransaccion'])){
  $cTransaccional = $_POST['ctransaccion'];
  $paymentType = $_POST['payment_type'];
  $amount = $_POST['amount'];
  $currency = $_POST['currency'];
  $authcode = $_POST['authcode'];
  $pan = $_POST['pan'];
  $stan = $_POST['stan'];
  $mes = $_POST['mes'];
  $anio = $_POST['anio'];
  $customVal = $_POST['customval'];
  $interes = $_POST['interes'];
  $gracia = $_POST['gracia'];
  $diferido = $_POST['diferido'];

   var_dump(json_decode(anulacion($cTransaccional, $paymentType, $amount, $currency, $authcode, $pan, $stan, $mes, $anio, $customVal, $interes, $gracia, $diferido), true));
   // probar($cTransaccional, $paymentType, $amount, $currency, $authcode, $pan, $stan, $mes, $anio, $customVal, $interes, $gracia, $diferido);
}

// function probar($cTransaccional, $paymentType, $amount, $currency, $authcode, $pan, $stan, $mes, $anio, $customVal, $interes, $gracia, $diferido){
//   $contenido = "Interes: ".$interes." gracia: ".$gracia." diferido: ".$diferido;
//   echo $contenido;
// }



function anulacion($cTransaccional, $paymentType, $amount, $currency, $authcode, $pan, $stan, $mes, $anio, $customVal, $interes, $gracia, $diferido){
    $url = "https://test.oppwa.com/v1/payments/".$cTransaccional;
    $data = "authentication.entityId=8ac7a4c871bf63f00171c2f2e77c0d14".
            "&paymentType=".$paymentType.
            "&amount=".$amount.
            "&currency=".$currency.
            "&customParameters[AUTHCODE]=".$authcode.
            "&customParameters[PAN]=".$pan.
            "&customParameters[STAN]=".$stan.
            "&customParameters[expiryMonth]=".$mes.
            "&customParameters[expiryYear]=".$anio.
            "&customParameters[1000000505_PD100406]=".$customVal.
            "&customParameters[SHOPPER_interes]=".$interes.
            "&customParameters[SHOPPER_gracia]=".$gracia.
            "&customParameters[SHOPPER_installments]=".$diferido;

            $data.='&testMode=EXTERNAL';



    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 50);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization:Bearer OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhjNzI4YzBkOTV8YmZxR3F3UTMyWA=='));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if(curl_errno($ch)){
        return curl_error($ch);
    }

    curl_close($ch);
    return $response;
}

?>

<html>
<head>
  <style>
  .center {
  padding: 70px 0;
  text-align: center;
}
  </style>
</head>
<body>
  <div class="center">
    <form action="" method="post">

      <label for="ctransaccion">Id transaccion:</label><br>
      <input type="text" id="ctransaccion" name="ctransaccion"><br>

      <label for="anio">Año de expiracion:</label><br>
      <input type="text" id="anio" name="anio"><br>

      <label for="mes">mes de expiracion:</label><br>
      <input type="text" id="mes" name="mes"><br>

      <label for="payment_type">Payment type:</label><br>
      <input type="text" id="payment_type" value="RF" name="payment_type"><br>

      <label for="amount">Amount:</label><br>
      <input type="text" id="amount" value="0" name="amount"><br>

      <label for="currency">Currency:</label><br>
      <input type="text" id="currency" value="USD" name="currency"><br>

      <label for="authcode">CP Authocode:</label><br>
      <input type="text" id="authcode" value="" name="authcode"><br>

      <label for="pan">CP PAN, Numero de Tarjeta:</label><br>
      <input type="text" id="pan" value="" name="pan"><br>

      <label for="stan">CP STAN, ReferenceNbr:</label><br>
      <input type="text" id="stan" value="" name="stan"><br>

      <label for="customval">Custom Val:</label><br>
      <input type="text" id="customval" value="" name="customval"><br>

      <label for="interes">Interes:</label><br>
      <input type="number" id="interes" value="0" name="interes"><br>

      <label for="gracia">Gracia:</label><br>
      <input type="number" id="gracia" value="0" name="gracia"><br>

      <label for="diferido">Diferido:</label><br>
      <input type="number" id="diferido" value="0" name="diferido"><br>

      <button type="submit"> Anular </button>
    </form>
  </div>
</body>
</html>
