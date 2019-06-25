<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\AllInOne\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\AllInOne\QueryRefundResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class QueryRefundResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new QueryRefundResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testResponse()
    {
        $httpResponse = $this->getMockHttpResponse('QueryRefund.txt');
        $request = $this->getMockRequest();
        $response = new QueryRefundResponse(
            $request,
            json_decode($httpResponse->getBody()->getContents(), true)
        );

        $this->assertSame('99', $response->getCode());
    }
}
