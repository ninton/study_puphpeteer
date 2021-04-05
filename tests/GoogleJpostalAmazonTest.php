<?php

namespace Ninton\Test;

use Ninton\Test\Libs\Amazon\SearchScenario;
use Ninton\Test\Libs\Google\SearchScenario as GoogleSearchScenario;
use Ninton\Test\Libs\Jpostal\Sample1PageScneario;

class GoogleJpostalAmazonTest extends BasePuppeteerTestCase
{
    use SearchScenario;
    use GoogleSearchScenario;
    use Sample1PageScneario;

    public function setUp(): void
    {
        parent::setUp();

        $this->browser->newPage();
        $this->browser->newPage();
    }

    public function test_3タブ(): void
    {
        $this->selectPage(0);
        $this->本を検索してカートに入れる('テスト駆動開発');
        $this->assertカート追加直後の小計('3080');

        $this->本を検索してカートに入れる('実践テスト駆動開発');
        $this->assertカート追加直後の小計('7700');

        $this->selectPage(1);
        $this->google検索する('PuPHPeteer');
        $this->assertGoogle検索結果にあるはず('rialto-php/puphpeteer');

        $this->selectPage(2);
        $this->jpostal_1000001は東京都千代田区千代田();
    }
}
