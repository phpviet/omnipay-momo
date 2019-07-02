<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\AppInApp\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\AppInApp\PurchaseResponse;

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

    public function testResponse()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $request = $this->getMockRequest();
        $request->shouldReceive('getSecretKey')->once()->andReturn('fj00YKnJhmYqahaFWUgkg75saNTzMrbO');
        $response = new PurchaseResponse(
            $request,
            json_decode($httpResponse->getBody()->getContents(), true)
        );

        $this->assertEquals('43121679', $response->transid);
        $this->assertEquals('40000', $response->amount);
    }
}
