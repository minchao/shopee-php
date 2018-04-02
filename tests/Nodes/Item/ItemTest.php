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

        $expectedData = [
            'item_id' => 1,
            'fail_image' => [],
        ];

        $client = $this->createMockClient();
        $client->addResponse(new Response(200, [], json_encode($expectedData)));
        $responseData = $client->item->addItemImg(new AddItemImg($parameters));

        $transaction = $client->popHistory();
        $actualParameters = $this->getRequestParametersFromTransaction($transaction, true);

        $this->assertEquals($parameters, $actualParameters);
        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals($expectedData, $responseData->getData());
    }
}
