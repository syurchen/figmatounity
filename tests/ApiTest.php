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
        file_put_contents('/tmp/file.json', json_encode($result));
        file_put_contents('/tmp/file.array', print_r($result, true));
        $this->assertFalse(empty($result));
    }


    public function testParser()
    {
        $array = json_decode(file_get_contents('/tmp/file.json'), true);
        $string = file_get_contents('/tmp/file.json');
        print_r(array_keys($array['document']));
//        print_r($array['name']);
//	print_r($array['version']);

        $page = Parser::parse($string);
        $this->assertTrue($page instanceof FiPage);
        //print_r(array_keys($array['document']['children'][0]['children'][0]['children'][0]));
    }
}