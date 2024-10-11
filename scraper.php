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

// initialize a driver to control a Chrome instance
$driver = RemoteWebDriver::create($host, $capabilities);


// maximize the window to avoid responsive rendering
$driver->manage()->window()->maximize();

// open the target page in a new tab
$driver->get('https://www.vividseats.com/real-madrid-tickets-estadio-santiago-bernabeu-12-22-2024--sports-soccer/production/5045935'); //'https://www.vividseats.com/real-madrid-tickets-estadio-santiago-bernabeu-12-22-2024--sports-soccer/production/5045935'

usleep(3000000);
// extract the HTML page source and print it
$html = $driver->getPageSource();
echo $html;
//$product_element = $driver->findElement(WebDriverBy::className('_42ft _4jy0 _6lth _4jy6 _4jy1 selected _51sy'));//x1ja2u2z x78zum5
//$product_element->click();

$product_element = $driver->findElement(WebDriverBy::id('px-captcha')); //x1ja2u2z x78zum5
//$product_element->click();
echo "ENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADOENCONTRADO";
//echo $product_element->getText();
//Accedemos al shadow Root
$shadowRoot = $product_element->getShadowRoot();

$iFramesInShadow = $shadowRoot->findElements(WebDriverBy::tagName('h1'));
echo "EL NUMERO ES :           ";
echo count($iFramesInShadow);
echo "     wao \n\n\n";


foreach ($iFramesInShadow as $iframe) {
    echo "REPETICION \n";
}
$elementInShadow = $shadowRoot->findElement(WebDriverBy::partialLinkText('Pulsar y mantener pulsado'));

$action = new WebDriverActions($driver);

// Hacer clic y mantenerlo durante 10 segundos
$action->clickAndHold($product_element) // Mantiene el clic
    ->perform(); // Ejecuta la acción de mantener el clic

usleep(10000000); // 10 segundos en microsegundos

// Soltar el clic después de la pausa
$action->release($product_element)->perform(); // Libera el clic

$html = $driver->getPageSource();
echo $html;
// Cerrar
// close the driver and release its resources
$driver->close();
