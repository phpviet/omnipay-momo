<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\PayQueryStatusResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PayQueryStatusResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new PayQueryStatusResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testResponse()
    {
        $httpResponse = $this->getMockHttpResponse('PayQueryStatusResponse.txt');
        $request = $this->getMockRequest();
        $response = new PayQueryStatusResponse(
            $request,
            json_decode($httpResponse->getBody()->getContents(), true)
        );

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals(147938695, $response->getTransactionReference());
        $this->assertEquals('Merchant123556666', $response->getTransactionId());
    }
}
