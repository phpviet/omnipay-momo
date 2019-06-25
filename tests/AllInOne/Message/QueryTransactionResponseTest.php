<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\AllInOne\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\AllInOne\QueryTransactionResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class QueryTransactionResponseTest extends TestCase
{
    public function testConstruct()
    {
        // response should decode URL format data
        $response = new QueryTransactionResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testResponse()
    {
        $httpResponse = $this->getMockHttpResponse('QueryTransaction.txt');
        $request = $this->getMockRequest();
        $response = new QueryTransactionResponse(
            $request,
            json_decode($httpResponse->getBody()->getContents(), true)
        );

        $this->assertSame('MOMO0HGO20180417', $response->partnerCode);
        $this->assertSame('0', $response->getTransactionReference());
    }
}
