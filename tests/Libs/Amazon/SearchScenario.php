<?php

namespace Ninton\Test\Libs\Amazon;

trait SearchScenario
{
    /**
     * @param string $title
     */
    private function 本を検索してカートに入れる(string $title): void
    {
        $this->トップページ_表示する();
        $this->トップページ_検索する($title);
        $this->検索結果_最初のサムネイル画像をクリックする();
        $this->商品詳細_カートに入れるボタンをクリックする();
        $this->カート追加直後_レジに進むボタンを待つ();
    }

    /**
     * @param string $expectedSubTotal
     */
    private function assertカート追加直後の小計(string $expectedSubTotal): void
    {
        $addedToCartPage = new AddedToCartPage($this->page);
        $subTotal = $addedToCartPage->getカートの小計();

        $this->assertEquals($expectedSubTotal, $subTotal);
    }

    private function トップページ_表示する(): void
    {
        TopPage::goto($this->page);
        $this->screenShot();
    }

    private function トップページ_検索する(string $title): void
    {
        $topPage = new TopPage($this->page);
        $topPage->type検索ワード($title);
        $topPage->click検索();
        $this->waitForPageLoad();
        $this->screenShot();
    }

    private function 検索結果_最初のサムネイル画像をクリックする(): void
    {
        $searchResultPage = new SearchResultPage($this->page);
        $searchResultPage->click最初のサムネイル画像();
    }

    private function 商品詳細_カートに入れるボタンをクリックする(): void
    {
        $detailPage = new DetailPage($this->page);
        $detailPage->waitForカートに入れるボタン();
        $this->screenShot();

        $detailPage->clickカートに入れるボタン();
    }

    private function カート追加直後_レジに進むボタンを待つ(): void
    {
        $addedToCartPage = new AddedToCartPage($this->page);
        $addedToCartPage->waitForレジに進むボタン();
        $this->screenShot();
    }
}