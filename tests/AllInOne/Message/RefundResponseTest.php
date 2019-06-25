<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\AllInOne\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\AllInOne\RefundResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class RefundResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new RefundResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testResponse()
    {
        $httpResponse = $this->getMockHttpResponse('Refund.txt');
        $request = $this->getMockRequest();
        $response = new RefundResponse(
            $request,
            json_decode($httpResponse->getBody()->getContents(), true)
        );

        $this->assertSame('MOMO0HGO20180417', $response->partnerCode);
        $this->assertSame('refundMoMoWallet', $response->requestType);
    }
}
