<?php

namespace Ninton\Test;

use Nesk\Puphpeteer\Puppeteer;
use Nesk\Puphpeteer\Resources\Browser;
use Nesk\Puphpeteer\Resources\Page;
use Nesk\Rialto\Data\JsFunction;
use PHPUnit\Framework\TestCase;

abstract class BasePuppeteerTestCase extends TestCase
{
    /**
     * @var Browser
     */
    protected $browser;

    /**
     * @var Page
     */
    protected $page;

    public function setUp(): void
    {
        parent::setUp();

        $puppeteer = new Puppeteer();
        $this->browser = $puppeteer->launch($this->launchOptions());
        $this->page = ($this->browser->pages())[0];
    }

    public function tearDown(): void
    {
        $this->browser->close();

        parent::tearDown();
    }

    protected function launchOptions(): array
    {
        return [
            'defaultViewport' => [
                'width'  => 0,
                'height' => 0,
            ],
            'headless' => false,
            'ignoreHTTPSErrors' => true,
            'slowMo' => 50,

            'args' => [
                '--no-sandbox',
                '--disable-setuid-sandbox',
                "--window-size=1280,1024",
            ],
        ];
    }

    protected function waitForPageLoad(): void
    {
        $this->page->waitForNavigation("{waitUntil: ['load', 'networkidle2']}");
    }

    protected function screenShot(): void
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
    protected function pageTypeClear(string $selector): void
    {
        $jsFunc = JsFunction::createWithBody("document.querySelector('${selector}').value = '';");
        $this->page->evaluate($jsFunc);
        usleep(100000);
    }

    /**
     * @param string $selector
     * @param string $text
     */
    protected function pageType(string $selector, string $text): void
    {
        $this->pageTypeClear($selector);
        $this->page->type($selector, $text);
    }
}
