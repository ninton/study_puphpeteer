<?php

namespace Ninton\Test\Libs\Google;

trait SearchScenario
{
    private function google検索する(string $text): void
    {
        $indexPage = IndexPage::goto($this->page);
        $this->screenShot();

        $indexPage->type検索ワード($text);
        $indexPage->click検索ボタン();
        $this->waitForPageLoad();
        $this->screenShot();
    }

    private function assertGoogle検索結果にあるはず(string $expectedText): void
    {
        $listPage = new ListPage($this->page);
        $textArr = $listPage->get検索結果のh3テキスト配列();
        $containsArr = array_filter($textArr, function ($text) use ($expectedText) {
            return str_contains($text, $expectedText);
        });

        $containsArr = array_values($containsArr);

        $this->assertTrue(1 <= count($containsArr));
    }
}
