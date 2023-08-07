<?php

namespace tests;

use michajanjanik\leaflet\layers\ImageOverlay;
use michajanjanik\leaflet\layers\Marker;
use michajanjanik\leaflet\types\LatLng;
use michajanjanik\leaflet\types\LatLngBounds;

/**
 * @group layers
 */
class ImageOverlayTest extends TestCase
{
    public function testEncode()
    {
        $bounds = new LatLngBounds(
            [
                'southWest' => new LatLng(['lat' => 39.61, 'lng' => -105.02]),
                'northEast' => new LatLng(['lat' => 39.74, 'lng' => -104.99])
            ]
        );

        $overlay = new ImageOverlay(['imageBounds' => $bounds, 'imageUrl' => 'http://www.example.com/img.png']);

        $this->assertEquals($bounds, $overlay->getImageBounds());

        $actual = $overlay->encode();

        $this->assertEquals(
            "L.imageOverlay('http://www.example.com/img.png', L.latLngBounds([39.61,-105.02], [39.74,-104.99]), {})",
            $actual
        );
    }

    public function testEncodeWithName()
    {
        $bounds = new LatLngBounds(
            [
                'southWest' => new LatLng(['lat' => 39.61, 'lng' => -105.02]),
                'northEast' => new LatLng(['lat' => 39.74, 'lng' => -104.99])
            ]
        );

        $overlay = new ImageOverlay(
            ['name' => 'test', 'imageBounds' => $bounds, 'imageUrl' => 'http://www.example.com/img.png']
        );

        $this->assertEquals($bounds, $overlay->getImageBounds());

        $actual = $overlay->encode();

        $this->assertEquals(
            "var test = L.imageOverlay('http://www.example.com/img.png', L.latLngBounds([39.61,-105.02], [39.74,-104.99]), {});",
            $actual
        );
    }

    public function testEncodeWithMapName()
    {
        $bounds = new LatLngBounds(
            [
                'southWest' => new LatLng(['lat' => 39.61, 'lng' => -105.02]),
                'northEast' => new LatLng(['lat' => 39.74, 'lng' => -104.99])
            ]
        );

        $overlay = new ImageOverlay(
            ['map' => 'test', 'imageBounds' => $bounds, 'imageUrl' => 'http://www.example.com/img.png']
        );

        $this->assertEquals($bounds, $overlay->getImageBounds());

        $actual = $overlay->encode();

        $this->assertEquals(
            "L.imageOverlay('http://www.example.com/img.png', L.latLngBounds([39.61,-105.02], [39.74,-104.99]), {}).addTo(test);",
            $actual
        );
    }
}
