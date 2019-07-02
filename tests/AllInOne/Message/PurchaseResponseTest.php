<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\AllInOne\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\AllInOne\PurchaseResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new PurchaseResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testPurchaseSuccess()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $request = $this->getMockRequest();
        $request->shouldReceive('getSecretKey')->once()->andReturn('fj00YKnJhmYqahaFWUgkg75saNTzMrbO');
        $response = new PurchaseResponse(
            $request,
            json_decode($httpResponse->getBody()->getContents(), true)
        );

        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertSame('0.38857000 1561110614', $response->getTransactionId());
        $this->assertTrue($response->isRedirect());
        $this->assertSame('GET', $response->getRedirectMethod());
    }

    public function testPurchaseFailure()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseFailure.txt');
        $response = new PurchaseResponse(
            $this->getMockRequest(),
            json_decode($httpResponse->getBody()->getContents(), true)
        );

        $this->assertFalse($response->isPending());
        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
        $this->assertSame('Amount invalid should be between 1,000đ and 20,000,000đ', $response->getMessage());
    }
}
