<?php

namespace Shopee\Tests\Nodes\Item;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Shopee\Tests\ClientTrait;

class ItemTest extends TestCase
{
    use ClientTrait;

    public function itemCasesProvider(): array
    {
        return [
            [
                'addItemImg',
                [
                    'item_id' => 1,
                    'images' => [
                        'https://example.com/image-1.png',
                        'https://example.com/image-2.png',
                    ],
                ],
                [
                    'item_id' => 1,
                    'fail_image' => [],
                ]
            ],
            [
                'addVariations',
                [
                    'item_id' => 1,
                    'variations' => [
                        [
                            'name' => 'Heart of Gold',
                            'stock' => 1,
                            'price' => 100.0,
                            'variation_sku' => 'HG',
                        ],
                    ],
                ],
                [
                    'item_id' => 1,
                    'modified_time' => 1522938000,
                ],
            ],
            [
                'delete',
                [
                    'item_id' => 1,
                ],
                [
                    'item_id' => 1,
                    'msg' => 'msg',
                ],
            ],
            [
                'deleteItemImg',
                [
                    'item_id' => 1,
                    'images' => [
                        'https://example.com/image-1.png',
                    ],
                ],
                [],
            ],
            [
                'deleteVariation',
                [
                    'item_id' => 1,
                    'variation_id' => 100,
                ],
                [
                    'item_id' => 1,
                    'variation_id' => 100,
                    'modified_time' => 1522938000,
                ],
            ],
            [
                'getAttributes',
                [
                    'category_id' => 10,
                    'language' => 'en',
                ],
                [],
            ],
        ];
    }

    /**
     * @dataProvider itemCasesProvider
     * @param string $method
     * @param array $parameters
     * @param array $expectedData
     * @throws \Exception
     */
    public function testShouldBeOkWhenRunItemApis(string $method, array $parameters, array $expectedData)
    {
        $response = new Response(200, [], json_encode($expectedData));
        $history = [];

        $client = $this->createClient([], $this->createHttpClient($response, $history));
        $requestParametersClass = 'Shopee\\Nodes\\Item\\Parameters\\' . ucfirst($method);
        $responseData = $client->item->$method(new $requestParametersClass($parameters));

        /** @var Request $request */
        $request = $history[0]['request'];
        $actualParameters = json_decode((string)$request->getBody(), true);
        $actualParameters = array_diff_assoc($actualParameters, $client->getDefaultParameters());

        $this->assertEquals($parameters, $actualParameters);
        $this->assertEquals(200, $responseData->getResponse()->getStatusCode());
        $this->assertEquals($expectedData, $responseData->getData());
    }
}
