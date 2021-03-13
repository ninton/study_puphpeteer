<?php

namespace Ninton\Test;

class GoogleSearchTest extends BasePuppeteerTestCase
{
    public function test_GoogleでPuPHPeteer検索するとrialto_php_puphpeteerがあること(): void
    {
        $this->page->goto('https://www.google.co.jp');
        $this->screenShot();

        $selector = 'input[name="q"]';
        $this->page->type($selector, 'PuPHPeteer');

        $selector = 'input[name="btnK"]';
        $this->page->click($selector);
        $this->waitForPageLoad();
        $this->screenShot();

        $selector = 'div.tF2Cxc:nth-child(2) > div:nth-child(1) > a:nth-child(1) > h3:nth-child(2)';
        $el = $this->page->querySelector($selector);
        $text = $el->getProperty('textContent')->jsonValue();
        $this->assertStringContainsString('rialto-php/puphpeteer', $text);
    }
}
