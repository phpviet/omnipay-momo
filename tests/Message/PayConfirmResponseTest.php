<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\PayConfirmResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PayConfirmResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new PayConfirmResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testResponse()
    {
        $httpResponse = $this->getMockHttpResponse('PayConfirmResponse.txt');
        $request = $this->getMockRequest();
        $request->shouldReceive('getSecretKey')->once()->andReturn('fj00YKnJhmYqahaFWUgkg75saNTzMrbO');
        $response = new PayConfirmResponse(
            $request,
            json_decode($httpResponse->getBody()->getContents(), true)
        );

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals(12436514111, $response->getTransactionReference());
        $this->assertEquals('Merchant123556666', $response->getTransactionId());
    }
}
