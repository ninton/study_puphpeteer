<?php

namespace Ninton\Test;

use Ninton\Test\Libs\Jpostal\Sample1Page;

class Jpostal100v3Test extends BasePuppeteerTestCase
{
    public function test_1000001は東京都千代田区千代田(): void
    {
        $sample1Page = Sample1Page::goto($this->page);

        $sample1Page->type郵便番号の上3桁('100');
        sleep(2);
        $this->screenShot();

        $address1 = $sample1Page->get都道府県value();
        $this->assertEquals('東京都', $address1);

        $address2 = $sample1Page->get市区町村value();
        $this->assertEquals('千代田区', $address2);

        $sample1Page->type郵便番号の下4桁('0001');
        usleep(100000);
        $this->screenShot();

        $address3 = $sample1Page->get町域value();
        $this->assertEquals('千代田', $address3);

        $sample1Page->type郵便番号の下4桁('0002');
        usleep(100000);
        $this->screenShot();

        $address3 = $sample1Page->get町域value();
        $this->assertEquals('皇居外苑', $address3);
    }
}
