<?php

namespace Ninton\Test;

use Ninton\Test\Libs\Amazon\SearchScenario;

class Amazon2Test extends BasePuppeteerTestCase
{
    use SearchScenario;

    public function test_２冊を購入(): void
    {
        $this->本を検索してカートに入れる('テスト駆動開発');
        $this->assertカート追加直後の小計('3080');

        $this->本を検索してカートに入れる('実践テスト駆動開発');
        $this->assertカート追加直後の小計('7700');
    }
}
