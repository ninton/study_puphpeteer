<?php

namespace Tests;

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

    public function test(): void
    {
        $this->page->goto('https://www.google.co.jp');
        $this->screenShot();

        $selector = 'input[name="q"]';
        $this->page->type($selector, 'PuPHPeteer');

        $selector = 'input[name="btnK"]';
        $this->page->click($selector);
        $this->waitForPageLoad();
        $this->screenShot();
    }

    public function waitForPageLoad(): void
    {
        $this->page->waitForNavigation("{waitUntil: ['load', 'networkidle2']}");
    }

    public function screenShot(): void
    {
        $path = __DIR__ . '/../tmp/' . strftime('%Y-%m-%s-%H-%M-%S.jpg');

        $this->page->screenshot([
            'path'     => $path,
            'fullPage' => true,
        ]);
    }
}
