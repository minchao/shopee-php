<?php

namespace Shopee\Tests\Nodes\Item;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Shopee\Nodes\Item\Parameters\AddItemImg;
use Shopee\Tests\HelperTrait;

class ItemTest extends TestCase
{
    use HelperTrait;

    public function testShouldBeOkWhenAddItemImg()
    {
        $parameters = [
            'item_id' => 1,
            'images' => [
                'https://example.com/image-1.png',
                'https://example.com/image-2.png',
            ],
        ];

        $client = $this->createMockClient();
        $client->addResponse(new Response());
        $client->item->addItemImg(new AddItemImg($parameters));

        $transaction = $client->popHistory();
        $actualParameters = $this->getRequestParametersFromTransaction($transaction, true);

        $this->assertEquals($parameters, $actualParameters);
    }
}
