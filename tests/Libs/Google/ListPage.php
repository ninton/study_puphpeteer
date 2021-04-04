<?php

namespace Ninton\Test\Libs\Google;

use Ninton\Test\Libs\BasePage;

class ListPage extends BasePage
{
    public function get検索結果の１つめ(): string
    {
        $selector = 'div.tF2Cxc:nth-child(2) > div:nth-child(1) > a:nth-child(1) > h3:nth-child(2)';
        $el = $this->page->querySelectorX($selector);
        $text = $el->getProperty('textContent')->jsonValue();
        return $text;
    }

    public function get検索結果のh3テキスト配列(int $len = 10): array
    {
        $selector = 'div.tF2Cxc  h3';
        $elArr = $this->page->querySelectorAll($selector);
        $elArr = array_slice($elArr, 0, $len);

        $textArr = array_map(function ($el) {
            $text = $el->getProperty('textContent')->jsonValue();
            return $text;
        }, $elArr);

        return $textArr;
    }
}
