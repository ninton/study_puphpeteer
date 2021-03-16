<?php

namespace Ninton\Test;

use Ninton\Test\Libs\Amazon\AddedToCartPage;
use Ninton\Test\Libs\Amazon\DetailPage;
use Ninton\Test\Libs\Amazon\SearchResultPage;
use Ninton\Test\Libs\Amazon\TopPage;

class AmazonTest extends BasePuppeteerTestCase
{
    public function test_テスト駆動開発を購入(): void
    {
        $topPage = TopPage::goto($this->page);
        $this->screenShot();

        $topPage->type検索ワード('テスト駆動開発');
        $topPage->click検索();
        $this->waitForPageLoad();
        $this->screenShot();

        $searchResultPage = new SearchResultPage($this->page);
        $searchResultPage->click最初のサムネイル画像();

        $detailPage = new DetailPage($this->page);
        $detailPage->waitForカートに入れるボタン();
        $this->screenShot();

        $detailPage->clickカートに入れるボタン();

        $addedToCartPage = new AddedToCartPage($this->page);
        $addedToCartPage->waitForレジに進むボタン();
        $this->screenShot();

        $subTotal = $addedToCartPage->getカートの小計();
        $this->assertEquals('3080', $subTotal);
    }
}
