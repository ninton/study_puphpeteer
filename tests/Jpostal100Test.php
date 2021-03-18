<?php

namespace Ninton\Test;

use PHPUnit\Framework\TestCase;

class Jpostal100Test extends BasePuppeteerTestCase
{
    public function test_1000001は東京都千代田区千代田(): void
    {
        $this->page->goto('https://jpostal-1006.appspot.com/sample_1.html');
        $this->screenShot();

        $this->page->type('#postcode1', '100');
        sleep(2);
        $this->screenShot();

        $el = $this->page->querySelector('#address1');
        $value = $el->getProperty('value')->jsonValue();
        $this->assertEquals('東京都', $value);

        $el = $this->page->querySelector('#address2');
        $value = $el->getProperty('value')->jsonValue();
        $this->assertEquals('千代田区', $value);

        $this->page->type('#postcode2', '0001');
        usleep(100000);
        $this->screenShot();

        $el = $this->page->querySelector('#address3');
        $value = $el->getProperty('value')->jsonValue();
        $this->assertEquals('千代田', $value);

        $this->pageType('#postcode2', '0002');
        usleep(100000);
        $this->screenShot();

        $el = $this->page->querySelector('#address3');
        $value = $el->getProperty('value')->jsonValue();
        $this->assertEquals('皇居外苑', $value);
    }
}
