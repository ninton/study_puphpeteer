<?php

namespace Ninton\Test\Libs;

use Nesk\Puphpeteer\Resources\Page;
use Nesk\Rialto\Data\JsFunction;

abstract class BasePage
{
    /**
     * @var
     */
    protected $page;

    /**
     * BasePage constructor.
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function waitForPageLoad(): void
    {
        $this->page->waitForNavigation("{waitUntil: ['load', 'networkidle2']}");
    }

    public function screenShot(): void
    {
        $path = __DIR__ . '/../tmp/' . strftime('%Y-%m-%d-%H-%M-%S.jpg');

        $this->page->screenshot([
            'path'     => $path,
            'fullPage' => true,
        ]);
    }

    /**
     * @param string $selector
     */
    public function pageTypeClear(string $selector): void
    {
        $jsFunc = JsFunction::createWithBody("document.querySelector('${selector}').value = '';");
        $this->page->evaluate($jsFunc);
        usleep(100000);
    }

    /**
     * @param string $selector
     * @param string $text
     */
    public function pageType(string $selector, string $text): void
    {
        $this->pageTypeClear($selector);
        $this->page->type($selector, $text);
    }

    /**
     * @param string $selector
     * @return string
     */
    public function pageGetValue(string $selector): string
    {
        $el = $this->page->querySelector($selector);
        $value = $el->getProperty('value')->jsonValue();
        return $value;
    }
}
