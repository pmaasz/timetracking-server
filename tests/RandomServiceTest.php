<?php

/**
 * Created by PhpStorm.
 * Author: Philip Maaß
 * Date: 19.07.22
 * Time: 17:13
 * License
 */

use Timetracking\Server\Service\RandomService;

class RandomServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testRandomString()
    {
        $randomService = new RandomService();
        $seed = $randomService->getSeed();
        $this->assertNotNull($seed);
    }
}