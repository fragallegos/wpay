<?php
// •	ID de entidad : 8ac7a4c871bf63f00171c2f2e77c0d14
// •	ACCESS TOKEN  : OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhjNzI4YzBkOTV8YmZxR3F3UTMyWA==
// •	MID:1000000505
// •	TID: PD100406
// VISA GUAYAQUIL
// 4540633170010000
// 0422
// 279
$precioTotal = 1;

$preValor = $precioTotal;
$valor = number_format((float)$preValor, 2, '.', '');
$iva=0.12;
$valorIva = $valor*$iva;
$valorMasIva = $valor + $valorIva;

//parametro valor iva 12
//004 012
$prevValorIva = '004012';                             //Primero
$valorIvaString = strval($valorIva);
$iva = str_replace('.', '', $valorIvaString);
$valorIvaTabla = str_pad($iva, 12, '0', STR_PAD_LEFT);//despues

//Parametro base 0
//052 012
$prevValorSinTarifa = "052012";                       //primero
$valorSinTarifa = 0;
$valorST = number_format((float)$valorSinTarifa, 2, '.', '');;
$valorSinTarifaString = strval($valorST);
$valorSinTarifaString = str_replace('.', '', $valorSinTarifaString);
$valorSinTarifaTabla = str_pad($valorSinTarifaString, 12, '0', STR_PAD_LEFT); //despues
//echo $valorSinTarifaTabla;

//Identificador comercio electronico
//003 007
$prevIdentificador = "003007";                                  //primero
$identificadorComercio = "0103910";                             //despues

//identificador proveedor
//051008
$prevIdentificadorProveedor = '051008';                           //primero
$identifcadorProveedor = '17913101';                              //despues


//total base tarifa 12
//053 012
$prevBase12 = '053012';                                           //primero

$preTotalBase12 = $precioTotal;
$totalBase12 = number_format((float)$preTotalBase12, 2, '.', '');
$totalBase12String= strval($totalBase12);
$base12Replace = str_replace('.', '', $totalBase12String);
$base12total = str_pad($base12Replace, 12, '0', STR_PAD_LEFT);    //despues

$longitudTotal = '0081';                                           //antes de todo
$customParameter= '00810030070103910004012'.$valorIvaTabla.'05100817913101052012'.$valorSinTarifaTabla.'053012'.$base12total;



function request($customParam, $valor , $ip){
//   $ip;
//   if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
//     $ip = $_SERVER['HTTP_CLIENT_IP'];
// } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//     $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
// } else {
//     $ip = $_SERVER['REMOTE_ADDR'];
// }
    $precio = strval( $valor ) ;
    $url = "https://test.oppwa.com/v1/checkouts";
    $data = "entityId=8ac7a4c871bf63f00171c2f2e77c0d14".
            "&amount=".$precio.
            "&currency=USD".
            "&paymentType=DB".
            "&customer.givenName=Jose".
            "&customer.middleName=Daniel".
            "&customer.surname=Luna".
            "&customer.ip=".$ip.
            "&customer.merchantCustomerId=000000000001".
            "&merchantTransactionId=000000000000002".
            "&customer.email=jose@example.com".
            "&customer.identificationDocType=IDCARD".
            "&customer.identificationDocId=1718555555".
            "&customer.phone=0987654321".
            "&billing.street1=Cumbaya".
            "&billing.country=EC".
            "&shipping.street1=Cumbaya".
            "&shipping.country=EC".
            "&risk.parameters[USER-DATA2]=INFINITY".
            "&customParameters[1000000505_PD100406]=".$customParam;

    $data.='&cart.items[0].name=Producto1';
    $data.='&cart.items[0].description=Descripcion:Producto1';
    $data.='&cart.items[0].price=1';
    $data.='&cart.items[0].quantity=1';

            $data.='&testMode=EXTERNAL';



    $ch = curl_init();
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

 // $responseJson = json_decode(request($customParameter), true);
echo request($customParameter, $valorMasIva);
