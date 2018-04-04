<?php

namespace Shopee\Tests\Nodes\Item;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Shopee\Nodes\Item\Parameters\AddItemImg;
use Shopee\Tests\ClientTrait;

class ItemTest extends TestCase
{
    use ClientTrait;

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

        $response = new Response(200, [], json_encode($expectedData));
        $history = [];

        $client = $this->createClient([], $this->createHttpClient($response, $history));
        $responseData = $client->item->addItemImg(new AddItemImg($parameters));

        /** @var Request $request */
        $request = $history[0]['request'];
        $actualParameters = json_decode((string)$request->getBody(), true);
        $actualParameters = array_diff_assoc($actualParameters, $client->getDefaultParameters());

        $this->assertEquals($parameters, $actualParameters);
        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals($expectedData, $responseData->getData());
    }
}
