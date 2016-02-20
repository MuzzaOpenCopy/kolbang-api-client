<?php

use MuzzaOpenCopy\KolbangApi\KolbangApi;

class KolbangTest extends PHPUnit_Framework_TestCase {

    public function testKolbangHasCheese()
    {
        $kolbang = new KolbangApi;
        $this->assertTrue($kolbang->hasCheese());
    }

}