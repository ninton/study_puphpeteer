<?php

namespace Ninton\Test\Libs\Google;

use Nesk\Puphpeteer\Resources\Page;
use Ninton\Test\Libs\BasePage;

class IndexPage extends BasePage
{
    public static function goto(Page $page): IndexPage
    {
        $page->goto('https://www.google.co.jp');
        return new IndexPage($page);
    }

    public function type検索ワード(string $text): void
    {
        $selector = 'input[name="q"]';
        $this->page->type($selector, 'PuPHPeteer');
    }

    public function click検索ボタン(): void
    {
        $selector = 'input[name="btnK"]';
        $this->page->click($selector);
    }
}
