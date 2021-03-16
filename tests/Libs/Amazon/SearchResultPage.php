<?php

namespace Ninton\Test\Libs\Amazon;

use Exception;
use Ninton\Test\Libs\BasePage;

class SearchResultPage extends BasePage
{
    /**
     * @param string $text
     */
    public function click最初のサムネイル画像(): void
    {
        $selector = '.s-search-results .s-result-item a.a-text-bold';
        $this->page->click($selector);
    }
}
