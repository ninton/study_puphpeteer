<?php

namespace Ninton\Test\Libs\Amazon;

use Nesk\Puphpeteer\Resources\Page;
use Ninton\Test\Libs\BasePage;

class TopPage extends BasePage
{
    /**
     * @param Page $page
     * @return TopPage
     */
    public static function goto(Page $page): TopPage
    {
        $page->goto('https://www.amazon.co.jp');
        return new TopPage($page);
    }

    /**
     * @param string $text
     */
    public function type検索ワード(string $text): void
    {
        $this->pageType('#twotabsearchtextbox', $text);
    }

    /**
     *
     */
    public function click検索(): void
    {
        $this->page->click('#nav-search-submit-button');
    }
}
