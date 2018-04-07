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
                'add',
                [
                    'category_id' => 1,
                    'name' => 'Heart of Gold',
                    'description' => 'The starship Heart of Gold was the first spacecraft to make use of the Infinite Improbability Drive.',
                    'price' => 100.0,
                    'stock' => 1,
                    'item_sku' => 'HG',
                    'variations' => [
                        [
                            'name' => 'Prototype',
                            'stock' => 1,
                            'price' => 100.0,
                            'variation_sku' => 'HG',
                        ],
                    ],
                    'images' => [
                        [
                            'url' => 'https://example.com/image-1.png',
                        ],
                    ],
                    'attributes' => [
                        [
                            'attribute_id' => 10,
                            'value' => 'starship',
                        ],
                    ],
                    'logistics' => [
                        [
                            'logistic_id' => 1000,
                            'enabled' => true,
                            'shipping_fee' => 0.0,
                            'size_id' => 1,
                            'is_free' => true,
                        ],
                    ],
                    'weight' => 1.0,
                    'package_length' => 15000,
                    'package_width' => 15000,
                    'package_height' => 15000,
                    'days_to_ship' => 1,
                    'wholesales' => [
                        [
                            'min' => 1,
                            'max' => 1,
                            'unit_price' => 100.0,
                        ],
                    ],
                ],
                [
                    'item_id' => 1,
                    'fail_image' => [],
                ],
            ],
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
            [
                'insertItemImg',
                [
                    'item_id' => 1,
                    'image_url' => 'https://example.com/image-1.png',
                    'image_position' => 1,
                ],
                [
                    'item_id' => 1,
                    'modified_time' => 1522938000,
                ],
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
