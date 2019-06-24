<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\AllInOne\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\AllInOne\Response;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class ResponseTest extends TestCase
{
    public function testConstruct()
    {
        // response should decode URL format data
        $response = new Response($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testValidateSignature()
    {
        $httpResponse = $this->getMockHttpResponse('PurchaseSuccess.txt');
        $request = $this->getMockRequest();
        $request->shouldReceive('getParameters')->once()->andReturn([
            'secretKey' => 'fj00YKnJhmYqahaFWUgkg75saNTzMrbO',
        ]);
        new Response(
            $request,
            json_decode($httpResponse->getBody()->getContents(), true)
        );
    }

    public function testGetMagicProperties()
    {
        $response = new Response($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals('value', $response->example);
        $this->assertEquals('bar', $response->foo);

        try {
            $response->alio;
        } catch (\Throwable $throwable) {
            $this->assertContains('Undefined property:', $throwable->getMessage());
        }
    }
}
