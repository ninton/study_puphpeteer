<?php

namespace Ninton\StudyPuppeteer;

use Nesk\Puphpeteer\Puppeteer;
use Nesk\Puphpeteer\Resources\Browser;
use Nesk\Puphpeteer\Resources\Page;
use PHPUnit\Framework\TestCase;

class GoogleSearchTest extends TestCase
{
    /**
     * @var Browser
     */
    private $browser;

    /**
     * @var Page
     */
    private $page;

    public function setUp(): void
    {
        parent::setUp();

        $puppeteer = new Puppeteer();
        $this->browser = $puppeteer->launch($this->launchOptions());
        $this->page = ($this->browser->pages())[0];
    }

    private function launchOptions(): array
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

    public function tearDown(): void
    {
        $this->browser->close();

        parent::tearDown();
    }

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
}
