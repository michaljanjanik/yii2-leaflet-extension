<?php
use michajanjanik\leaflet\layers\Marker;
use michajanjanik\leaflet\layers\TileLayer;
use michajanjanik\leaflet\LeafLet;
use michajanjanik\leaflet\types\LatLng;
use yii\web\JsExpression;
use tests\TestPlugin;

/* @var $this yii\web\View */
/* @var $config array */
?>

<?php

// first lets setup the center of our map
$center = new LatLng(['lat' => 51.508, 'lng' => -0.11]);

// now lets create a marker that we are going to place on our map
$marker = new Marker(['latLng' => $center, 'popupContent' => 'Hi!']);

// The Tile Layer (very important)
$tileLayer = new TileLayer(
    [
        'urlTemplate' => 'http://otile{s}.mqcdn.com/tiles/1.0.0/map/{z}/{x}/{y}.jpeg',
        'clientOptions' => [
            'attribution' => 'Tiles Courtesy of <a href="http://www.mapquest.com/" target="_blank">MapQuest</a> ' .
                '<img src="http://developer.mapquest.com/content/osm/mq_logo.png">, ' .
                'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
            'subdomains' => '1234'
        ]
    ]
);

// now our component and we are going to configure it
$leaflet = new LeafLet(
    [
        'center' => $center, // set the center
        'clientEvents' => [
            'click' => new JsExpression('function(e){ console.log(e); }')
        ],
    ]
);
// Different layers can be added to our map using the `addLayer` function.
$leaflet->addLayer($marker)// add the marker
->setTileLayer($tileLayer);  // add the tile layer

$plugin = new TestPlugin(['name' => 'test']);

$leaflet->installPlugin($plugin);

$leaflet->getPlugins()->registerAssetBundles($this);
// finally render the widget
echo $leaflet->widget($config);
