<?php
$rsrsPath = $_GET['resourcePath'];
$urlPath = "https://test.oppwa.com".$rsrsPath;

function request($url){
      $url .= '?entityId=8ac7a4c871bf63f00171c2f2e77c0d14';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer OGE4Mjk0MTg1YTY1YmY1ZTAxNWE2YzhjNzI4YzBkOTV8YmZxR3F3UTMyWA=='));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if(curl_errno($ch)){
        return curl_error($ch);
    }

    curl_close($ch);




    return $response;
}

function ActualizarDatoDB($data, $id){

  $url = 'https://wipayservicios.herokuapp.com/saveCheckout/'.$id;

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


$respuesta =  json_decode(request($urlPath), true);
$customerid = $_COOKIE['custumerId'];
$resultCode = $respuesta['result']['code'];
$descripcion = $respuesta['result']['description'];

$ShowSuccess= false;
$ShowError= false;
if($resultCode == '000.100.112' || $resultCode == '000.000.000' || $resultCode == '000.100.110'){
  $res = ActualizarDatoDB($respuesta, $customerid);
}

 ?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>wipay</title>
<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
<link rel="stylesheet" type="text/css" href="styles/style.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="fonts/css/fontawesome-all.min.css">
<link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
<link rel="apple-touch-icon" sizes="180x180" href="app/icons/icon-192x192.png">

<style media="screen">
  .mensaje{
    display: none;
  }
</style>

</head>

<body class="theme-light" data-background="none" data-highlight="red2">

<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>

<div id="page">

 <div class="header header-fixed header-logo-center">
       <a href="index.html" class="header-title">wipay</a>
        <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>

        <!-- <a href="#" class="header-icon header-icon-4" data-menu="menu-signup"><i class="fas fa-plus"></i></a>  -->
    </div>

    <div id="footer-bar" class="footer-bar-2">
           <!-- <a href="index.html"><i class="fa fa-home"></i><span>Home</span></a> -->
            <a href="page-about.html"><i class="fa fa-cube"></i><span>Acerca</span></a>
            <a href="index.html" class="active-nav"><i class="">P</i><span>Pay</span></a>
            <!-- <a href="index-search.html"><i class="fa fa-search"></i><span>Search</span></a> -->
            <a href="#" data-menu="menu-settings"><i class="fa fa-cog"></i><span>Settings</span><em class="badge bg-green1-dark">3</em></a>
        </div>

    <div class="page-content header-clear-medium">
      <?php echo $descripcion ?>
     <div id="success"class="pricing-1 mensaje rounded-m shadow-s bg-theme" >
            <!-- <h1 data-card-height="200" class="card card-style rounded-m shadow-xl preload-img" style="margin: 0px 16px 0px 16px; !important" data-src="images/pictures/28.jpg"></h1> -->
            <h1 class="pricing-title text-center text-uppercase font-28 font-900 tituloCompra">Reloj Moon</h1>
            <h2 class="pricing-subtitle text-center descripcionCompra">Reloj metalico diseño by moon</h2>
            <h3 class="pricing-value text-center color-green-dark mb-5 precioCompra" style="font-size: 70px;
    font-weight: 900; !important">$25<sup>.99</sup></h3>
    <img width="120" class="mx-auto mb-4 mt-3" src="images/sucess1.png">
            <a href="whatsapp://send?text=file:///t.ly/NiKY" class="shareToWhatsApp mb-3 btn btn-m bg-whatsapp btn-icon text-uppercase font-900" style="margin-left: 25px; margin-bottom: -9px !important;"><i class="fab fa-whatsapp font-16"></i>Compartir via  WhatsApp</a>
        </div>

        <div id="error"class="pricing-1 mensaje rounded-m shadow-s bg-theme" >
            <!-- <h1 data-card-height="200" class="card card-style rounded-m shadow-xl preload-img" style="margin: 0px 16px 0px 16px; !important" data-src="images/pictures/28.jpg"></h1> -->
            <h1 class="pricing-title text-center text-uppercase font-28 font-900 tituloCompra">Reloj Moon</h1>
            <h2 class="pricing-subtitle text-center descripcionCompra">Reloj metalico diseño by moon</h2>
            <h3 class="pricing-value text-center color-green-dark mb-5 precioCompra" style="font-size: 70px;
    font-weight: 900; !important">$25<sup>.99</sup></h3>
    <img width="120" class="mx-auto mb-4 mt-3" src="images/error1.png">
            <a class="btn bg-blue2-dark btn-m btn-center-m text-uppercase font-900" style="font-size: 10px !important;"  href="https://infinityec.co/wipay/wipay/page-pay-product.html" >Intentar Nuevamente</a>
        </div>




    </div>
    <!-- End of Page Content-->



    <!-- All Menus, Action Sheets, Modals, Notifications, Toasts, Snackbars get Placed outside the <div class="page-content"> -->
<div id="menu-settings" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="308">
        <div class="menu-title"><h1>Settings</h1><p class="color-highlight">Ajustes y Contácto</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
        <div class="divider divider-margins mb-n2"></div>
        <div class="content">
            <div class="list-group list-custom-small">
                <a href="#" data-toggle-theme data-trigger-switch="switch-dark-mode" class="pb-2 ml-n1">
                    <i class="fa font-12 fa-moon rounded-s bg-highlight color-white mr-3"></i>
                    <span>Dark Mode</span>
                    <div class="custom-control scale-switch ios-switch">
                        <input data-toggle-theme-switch type="checkbox" class="ios-input" id="switch-dark-mode">
                        <label class="custom-control-label" for="switch-dark-mode"></label>
                    </div>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>

            <div class="list-group list-custom-large">

             <!--    <a data-menu="menu-backgrounds" href="page-wallet.html">
                    <i class="fa fa-credit-card bg-blue1-dark rounded-s"></i>
                    <span>Tajerta</span>
                    <strong>Agregar forma de pago</strong>
                    <span class="badge bg-green1-dark">EDITAR</span>
                    <i class="fa fa-angle-right"></i>
                </a> -->

                <a data-menu="menu-backgrounds" href="page-contact.html">
                    <i class="fa fa-envelope bg-blue2-dark rounded-s"></i>
                    <span>Contacto</span>
                    <strong>Soporte</strong>
                  <!--  <span class="badge bg-highlight color-white">VER</span> -->
                    <i class="fa fa-angle-right"></i>
                </a>

                <a data-menu="menu-highlights" href="#">
                    <i class="fa font-14 fa-tint bg-green1-dark rounded-s"></i>
                    <span>Términos y Condiciones</span>
                    <strong>Pólitica de privacida</strong>
                 <span class="badge bg-highlight color-white">VER</span>
                    <i class="fa fa-angle-right"></i>
                </a>
                <a data-menu="menu-backgrounds" href="#" class="border-0">
                    <i class="fa font-14 fa-cog bg-blue2-dark rounded-s"></i>
                    <span>FAQ</span>
                    <strong>Preguntas Frecuentes</strong>
                    <span class="badge bg-highlight color-white">VER</span>
                    <i class="fa fa-angle-right"></i>
                </a>

            </div>
        </div>
    </div>
    <!-- Menu Settings Highlights-->
    <div id="menu-highlights" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="380" data-menu-effect="menu-over">
        <div class="menu-title"><h1>Términos y Condiciones</h1><p class="color-highlight">Pólitica de privacidad</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
        <div class="divider divider-margins mb-n2"></div>
        <div class="content">
            <div class="card card-style">
                <div class="content">

                <h2 class="bolder bottom-15">Pólitica de Privacidad</h2>
                <p>Su privacidad es muy importante para nosotros. En consecuencia, hemos desarrollado esta Política para que usted entienda cómo recopilamos, usamos, comunicamos, divulgamos y hacemos uso de la información personal. Lo siguiente describe nuestra política de privacidad.</p>
                <ul>
                    <li>Recopilaremos y utilizaremos información personal únicamente con el objetivo de cumplir con los fines especificados por nosotros y para otros fines compatibles, a menos que obtengamos el consentimiento de la persona en cuestión o según lo exija la ley.</li>
                    <li>Solo retendremos información personal durante el tiempo que sea necesario para el cumplimiento de esos fines.</li>
                    <li>Recopilaremos información personal por medios legales y justos y, cuando corresponda, con el conocimiento o consentimiento de la persona interesada. </li>

                </ul>
            </div>
        </div>
            <a href="page-terms.html" data-menu="menu-settings" class="btn btn-full btn-m rounded-sm bg-highlight shadow-xl text-uppercase font-900 mt-4">Conocer Términos y Condiciones</a>
        </div>
    </div>
    <!-- Menu Settings Backgrounds-->
    <div id="menu-backgrounds" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="310" data-menu-effect="menu-over">
        <div class="menu-title"><h1>FAQ</h1><p class="color-highlight">Preguntas Frecuentes</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
        <div class="divider divider-margins mb-n2"></div>
        <div class="content">
            <div class="card card-style">
            <div class="content mb-2">

                <div class="d-flex">
                    <div class="pt-1">
                        <h5 data-activate="question-1" class="font-600">Que seguridad dispone el aplicativo?</h5>
                    </div>
                    <div class="ml-auto mr-1 pr-2">
                        <div class="custom-control classic-switch">
                            <input type="checkbox" class="classic-input" id="question-1">
                            <label class="custom-control-label" for="question-1"></label>
                            <i class="fa fa-angle-down font-11 color-green1-dark"></i>
                        </div>
                    </div>
                </div>
                <div data-switch="question-1" class="switch-is-unchecked">
                    <p class="pb-3">
                        La plataforma usa el sistema de seguridad 3Ds provistapor datafast
                    </p>
                </div>

                <div class="divider mt-2 mb-2"></div>

                <div class="d-flex">
                    <div class="pt-1">
                        <h5 data-activate="question-2" class="font-600">Pagos de Pedido/Producto/Servicio?</h5>
                    </div>
                    <div class="ml-auto mr-1 pr-2">
                        <div class="custom-control classic-switch">
                            <input type="checkbox" class="classic-input" id="question-2">
                            <label class="custom-control-label" for="question-2"></label>
                            <i class="fa fa-angle-down font-11 color-green1-dark"></i>
                        </div>
                    </div>
                </div>
                <div data-switch="question-2" class="switch-is-unchecked">
                    <p class="pb-3">
                        Para realizar el pago del pedido/servicio/producto se debe digitar tarjeta de débito o crédito.
                    </p>
                </div>

                <div class="divider mt-2 mb-2"></div>

                <div class="d-flex">
                    <div class="pt-1">
                        <h5 data-activate="question-3" class="font-600">Envios?</h5>
                    </div>
                    <div class="ml-auto mr-1 pr-2">
                        <div class="custom-control classic-switch">
                            <input type="checkbox" class="classic-input" id="question-3">
                            <label class="custom-control-label" for="question-3"></label>
                            <i class="fa fa-angle-down font-11 color-green1-dark"></i>
                        </div>
                    </div>
                </div>

                <div data-switch="question-3" class="switch-is-unchecked">
                    <p class="pb-3">Cada servicio/producto/pedido cuenta con servicio de envio incluido.</p>
                </div>




                <div class="divider mt-2 mb-2"></div>

            </div>
        </div>
            <a href="page-faq.html" data-menu="menu-settings" class="btn btn-full btn-m rounded-sm bg-highlight shadow-xl text-uppercase font-900 mt-4">Ir a Preguntas Frecuentes</a>
        </div>
    </div>
    <!-- Menu Share -->
    <div id="menu-share" class="menu menu-box-bottom menu-box-detached rounded-m" data-menu-height="345" data-menu-effect="menu-over">
        <div class="menu-title mt-n1"><h1>Share the Love</h1><p class="color-highlight">Just Tap the Social Icon. We'll add the Link</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
        <div class="content mb-0">
            <div class="divider mb-0"></div>
            <div class="list-group list-custom-small list-icon-0">
                <a href="#" class="shareToFacebook">
                    <i class="font-18 fab fa-facebook color-facebook"></i>
                    <span class="font-13">Facebook</span>
                    <i class="fa fa-angle-right"></i>
                </a>
                <a href="#" class="shareToTwitter">
                    <i class="font-18 fab fa-twitter-square color-twitter"></i>
                    <span class="font-13">Twitter</span>
                    <i class="fa fa-angle-right"></i>
                </a>
                <a href="#" class="shareToLinkedIn">
                    <i class="font-18 fab fa-linkedin color-linkedin"></i>
                    <span class="font-13">LinkedIn</span>
                    <i class="fa fa-angle-right"></i>
                </a>
                <a href="#" class="shareToWhatsApp">
                    <i class="font-18 fab fa-whatsapp-square color-whatsapp"></i>
                    <span class="font-13">WhatsApp</span>
                    <i class="fa fa-angle-right"></i>
                </a>
                <a href="#" class="shareToMail border-0">
                    <i class="font-18 fa fa-envelope-square color-mail"></i>
                    <span class="font-13">Email</span>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!--Menu Sign Up-->
    <!---------------->
    <!---------------->
    <div id="menu-signup" class="menu menu-box-bottom menu-box-detached rounded-m"
         data-menu-height="480"
         data-menu-effect="menu-over">
         <div class="menu-title"><h1>Proceder a Pagar</h1><p class="color-blue2-dark">Llenar los siguientes datos </p><a href="#" class="close-menu"><i class="fa fa-times" style="color: #4a89dc;"></i></a></div>

            <div class="content">
                <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl"
                     data-tab-items="2"
                     data-tab-active="bg-blue2-dark color-white">
                    <a id="infor" href="#" data-tab-active data-tab="tab-5">Información</a>
                  <a id="tarjeta" href="#" data-tab="tab-6">Tarjeta</a>
                    <!-- <a id="pago" href="#" data-tab="tab-7">Pago</a> -->
                </div>
                <div class="clearfix mb-3"></div>
            <div class="tab-content" id="tab-5">
                   <!-- <h2>Información</h2> -->
        </br>
                <div class="input-style input-style-2 has-icon input-required">
                    <i class="input-icon fa fa-user"></i>
                    <span class="color-highlight input-style-1-active">Nombres y Apellidos</span>
                    <em>(required)</em>
                    <input type="name" name="Name" class="form-control" value="">
                </div>

                <div class="input-style input-style-2 has-icon input-required mt-4">
                    <i class="input-icon fa fa-at"></i>
                    <span class="color-highlight input-style-1-active">Email</span>
                    <em>(required)</em>
                    <input type="email" name="emailCostumer" class="form-control" value="">
                </div>

                <div class="input-style input-style-2 has-icon input-required mt-4">
                    <i class="input-icon fa fa-map-marker"></i>
                    <span class="color-highlight input-style-1-active">Ubicación</span>
                    <em>(required)</em>
                    <input type="textarea" name="ubicacion" class="form-control" value="">
                </div>


                 <div class="input-style input-style-2 has-icon input-required mt-4">

                    <span class="color-highlight input-style-1-active">Identificación</span>
                    <em><i class="fa fa-angle-down"></i></em>
                    <select name="idtype" class="form-control">
                        <option value="null" selected>Seleccionar</option>
                        <option value="cedula">Cédula</option>
                        <option value="ruc">Ruc</option>
                        <option value="pasaporte">Pasaporte</option>

                    </select>
                </div>

                <div class="input-style input-style-2 has-icon input-required mt-4">
                    <i class="input-icon fa fa-id-card"></i>
                    <span class="color-highlight input-style-1-active">Identificación</span>
                    <em>(required)</em>
                    <input type="number" name="cedula"  pattern="[0-9]*" class="form-control" value="">
                </div>

                <div class="input-style input-style-2 has-icon input-required mt-4">
                    <i class="input-icon fa fa-phone"></i>
                    <span class="color-highlight input-style-1-active">Número de télefono Celular*</span>
                    <em>(required)</em>
                    <input type="tel" name="numero"  pattern="[0-9]*"  class="form-control" value="" novalidate>
                </div>
                <a href="#"  id="getInfoButton" class="btn btn-full bg-green1-dark btn-m text-uppercase rounded-sm shadow-l mb-3 mt-4 font-900">Siguiente</a>



                </div>
                <div class="tab-content " id="tab-6">

                   <!--  <h2>Tarjeta</h2>
                <p>Llene el formulario para realizar la compra</p> -->
                <div id="TarjetaFormulario">

                </div>
                <!-- <div class="input-style input-style-2 has-icon input-required">
                    <i class="input-icon fa fa-credit-card"></i>
                    <span class="color-highlight input-style-1-active">Número de Tarjeta</span>
                    <em>(required)</em>
                    <input type="tel"  pattern="[0-9]*" class="form-control" value="Número de tarjeta" novalidate>
                </div>

                <div class="input-style input-style-2 has-icon input-required mt-4">
                    <i class="input-icon fa fa-calendar"></i>
                    <span class="color-highlight input-style-1-active">Fecha de Expiración</span>
                    <em>(required)</em>
                    <input type="date"  name="date"  class="form-control" value="20/20">
                </div>

                <div class="input-style input-style-2 has-icon input-required mt-4">
                    <i class="input-icon fa fa-lock"></i>
                    <span class="color-highlight input-style-1-active">CVV</span>
                    <em>(required)</em>
                    <input type="tel" pattern="[0-9]*" class="form-control" value="CVV" novalidate>
                </div>
                <a href="#" class="btn btn-full bg-green1-dark btn-m text-uppercase rounded-sm shadow-l mb-3 mt-4 font-900">Guardar</a> -->

                </div>
               <!--  <div class="tab-content" id="tab-7">
                    <p class="content mt-0">
                    Information regarding services provided by your wallet or other useful information that can go here. Simple to use and edit.
                </p>
                <div class="divider divider-margins"></div>
                    <div class="alert mr-3 ml-3 mb-5 rounded-s shadow-xl bg-green1-dark" role="alert">
                    <span class="alert-icon"><i class="fa fa-check font-18"></i></span>
                    <h4 class="text-uppercase color-white">Transfer Complete</h4>
                    <strong class="alert-icon-text">You received $200 from John Doe.</strong>
                </div>
                </div> -->
            </div>



    </div>


</div>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/bootstrap.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>//jquerycookie.js
<script type="text/javascript" src="scripts/custom.js"></script>
<script type="text/javascript" src="scripts/jquerycookie.js"></script>

<script type="text/javascript">

var status;
var nombre;
var descripcion;
var precio;

var cookie = $.cookie("custumerId");

var url = `https://wipayservicios.herokuapp.com/producto/${cookie}`

axios.get(url, {
  headers: {
 'Access-Control-Allow-Origin': '*'
}
},)
.then(function (response) {
  var query = response.data;
  nombre = query.nombre;
  describe = query.descripcion;
  precio = query.precio;
  status = query.estado;


})
.catch(function (error) {
  alert('Ha ocurrido un error');
  console.log(error);
}).then(function () {

  var precioSplit = precio.split('.');



  $(".precioCompra").each(function() {
    $(this).html(precioSplit[0]+'<sup>.'+precioSplit[1]+'</sup>');
  });
  $(".descripcionCompra").each(function() {
    $(this).html(descripcion);
  });
  $(".tituloCompra").each(function() {
    $(this).html(nombre);
  });

  console.log(status);
  if(status === "true"){
    console.log('status correct');
    $("#success").removeClass("mensaje");
  }else if(status === "false"){
    console.log('status error');
    $("#error").removeClass("mensaje");
  }

  });
</script>

</body>
