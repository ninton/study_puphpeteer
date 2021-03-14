<?php

namespace Ninton\Test\Libs\Jpostal;

use Nesk\Puphpeteer\Resources\Page;
use Ninton\Test\Libs\BasePage;

class Sample1Page extends BasePage
{
    /**
     * @param Page $page
     * @return Sample1Page
     */
    public static function goto(Page $page): Sample1Page
    {
        $page->goto('https://jpostal-1006.appspot.com/sample_1.html');
        return new Sample1Page($page);
    }

    public function type郵便番号の上3桁(string $text): void
    {
        $this->pageType('#postcode1', $text);
    }

    public function type郵便番号の下4桁(string $text): void
    {
        $this->pageType('#postcode2', $text);
        usleep(100000);
    }

    public function get都道府県value(): string
    {
        return $this->pageGetValue('#address1');
    }

    public function get市区町村value(): string
    {
        return $this->pageGetValue('#address2');
    }

    public function get町域value(): string
    {
        return $this->pageGetValue('#address3');
    }
}
