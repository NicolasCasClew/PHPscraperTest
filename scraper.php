<?php

namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Interactions\WebDriverActions;

require_once('vendor/autoload.php');

// url server
$host = 'http://192.168.56.1:4444';

// Chrome/firefox(no shadow root)
$capabilities = DesiredCapabilities::chrome();

$chromeOptions = new ChromeOptions();
//$chromeOptions->addArguments(['--headless']); //ver no ver


$capabilities->setCapability(ChromeOptions::CAPABILITY_W3C, $chromeOptions);

// creamos driver
$driver = RemoteWebDriver::create($host, $capabilities);


// agrandamos ventana
$driver->manage()->window()->maximize();

// abrimos ventana objetivo
$driver->get('https://www.vividseats.com/real-madrid-tickets-estadio-santiago-bernabeu-12-22-2024--sports-soccer/production/5045935'); //'https://www.vividseats.com/real-madrid-tickets-estadio-santiago-bernabeu-12-22-2024--sports-soccer/production/5045935'

//esperamos que se ejecute el js
usleep(3000000);

// extraemos el html (debug) 
$html = $driver->getPageSource();
echo $html;

$product_element = $driver->findElement(WebDriverBy::id('px-captcha')); //x1ja2u2z x78zum5

// debug
echo "Objeto encontrado \n";

// Accedemos al shadow Root
$shadowRoot = $product_element->getShadowRoot();

// obtenemos los iframes almacenados en este (4)
// de entre los 4 iframes 1 contiene el boton que hay que apretar
$iFramesInShadow = $shadowRoot->findElements(WebDriverBy::tagName('h1'));

// debug
echo "EL NUMERO ES :           ";
echo count($iFramesInShadow);


// iteramos y mantenemos pulsados por 10 segundos todos los botones
foreach ($iFramesInShadow as $iframe) {
    echo "REPETICION \n";
    //...
}
$elementInShadow = $shadowRoot->findElement(WebDriverBy::partialLinkText('Pulsar y mantener pulsado'));

$action = new WebDriverActions($driver);

// hace click y lo mantiene
$action->clickAndHold($product_element)
    ->perform();

usleep(10000000); // 10 segundos en microsegundos

// soltamos click
$action->release($product_element)->perform();

// debug
$html = $driver->getPageSource();
echo $html;

// cerramos driver
$driver->close();



//lo mismo pero con SeatGeek