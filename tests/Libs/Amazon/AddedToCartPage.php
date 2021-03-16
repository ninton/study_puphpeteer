<?php

namespace Ninton\Test\Libs\Amazon;

use Ninton\Test\Libs\BasePage;

class AddedToCartPage extends BasePage
{
    private const CHECKOUT_BUTTON = '#hlb-ptc-btn-native';

    /**
     *
     */
    public function waitForレジに進むボタン(): void
    {
        $this->page->waitForSelector(self::CHECKOUT_BUTTON);
    }

    /**
     * @return string
     */
    public function getカートの小計(): string
    {
        $selector = '#hlb-subcart  span.hlb-price';
        $text = $this->pageGetText($selector);
        $text = ltrim(rtrim($text));
        return $text;
    }
}
