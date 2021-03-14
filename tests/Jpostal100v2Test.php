<?php

namespace Ninton\Test;

class Jpostal100v2Test extends BasePuppeteerTestCase
{
    public function test_1000001は東京都千代田区千代田(): void
    {
        $this->page->goto('https://jpostal-1006.appspot.com/sample_1.html');

        $this->type郵便番号の上3桁('100');
        sleep(2);
        $this->screenShot();

        $address1 = $this->get都道府県value();
        $this->assertEquals('東京都', $address1);

        $address2 = $this->get市区町村value();
        $this->assertEquals('千代田区', $address2);

        $this->type郵便番号の下4桁('0001');
        usleep(100000);
        $this->screenShot();

        $address3 = $this->get町域value();
        $this->assertEquals('千代田', $address3);

        $this->type郵便番号の下4桁('0002');
        usleep(100000);
        $this->screenShot();

        $address3 = $this->get町域value();
        $this->assertEquals('皇居外苑', $address3);
    }

    private function type郵便番号の上3桁(string $text): void
    {
        $this->pageType('#postcode1', $text);
    }

    private function type郵便番号の下4桁(string $text): void
    {
        $this->pageType('#postcode2', $text);
        usleep(100000);
    }

    private function get都道府県value(): string
    {
        $el = $this->page->querySelector('#address1');
        $value = $el->getProperty('value')->jsonValue();
        return $value;
    }

    private function get市区町村value(): string
    {
        $el = $this->page->querySelector('#address2');
        $value = $el->getProperty('value')->jsonValue();
        return $value;
    }

    private function get町域value(): string
    {
        $el = $this->page->querySelector('#address3');
        $value = $el->getProperty('value')->jsonValue();
        return $value;
    }
}
