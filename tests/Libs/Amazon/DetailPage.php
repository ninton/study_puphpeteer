<?php

namespace Ninton\Test\Libs\Amazon;

use Ninton\Test\Libs\BasePage;

class DetailPage extends BasePage
{
    private const ADD_TO_CART_BUTTON = '#add-to-cart-button';

    /**
     *
     */
    public function waitForカートに入れるボタン(): void
    {
        $this->page->waitForSelector(self::ADD_TO_CART_BUTTON);
    }

    /**
     *
     */
    public function clickカートに入れるボタン(): void
    {
        $this->page->click(self::ADD_TO_CART_BUTTON);
    }
}
