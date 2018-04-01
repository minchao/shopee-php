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
        $historyContainer = [];
        $parameters = [
            'item_id' => 1,
            'images' => [
                'https://example.com/image-1.png',
                'https://example.com/image-2.png',
            ],
        ];

        $client = $this->createMockClient([new Response()], $historyContainer);
        $client->item->addItemImg(new AddItemImg($parameters));

        $actualParameters = $this->getRequestParametersFromHistory($historyContainer, true)[0];

        $this->assertEquals($parameters, $actualParameters);
    }
}
