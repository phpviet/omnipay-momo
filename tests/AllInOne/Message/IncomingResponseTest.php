<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\AllInOne\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\AllInOne\IncomingResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class IncomingResponseTest extends TestCase
{
    public function testConstruct()
    {
        // response should decode URL format data
        $response = new IncomingResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testResponse()
    {
        $request = $this->getMockRequest();
        $response = new IncomingResponse(
            $request,
            [
                'test' => 321,
            ]
        );

        $this->assertSame(321, $response->test);
    }
}
