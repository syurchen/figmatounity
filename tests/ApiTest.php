<?php

namespace App\Tests\Util;

use PHPUnit\Framework\TestCase;
use App\Figma\Api;
use App\Figma\Parser;
use App\Figma\FiPage;

class FigmaApiTest extends TestCase
{
    public function testApi()
    {

	    $this->markTestSkipped('must be revisited.');

	$key = '8729-262a006c-3cee-4fb4-a209-0f6b2936cd43';
	$api = new Api($key);

	$result = $api->getFileAsArray('HPqtAwfAl0gAvc5IQlb411');

        $this->assertTrue(is_array($result));
        $this->assertFalse(empty($result));
    }


    public function testParser(){
	    $array = json_decode(file_get_contents(__DIR__ . '/file.json'), true);
	    print_r(array_keys($array['document']['children'][0]['children'][0]['children'][0]));

	    
    }
}