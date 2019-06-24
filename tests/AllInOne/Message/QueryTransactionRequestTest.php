<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\AllInOne\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\AllInOne\QueryTransactionRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class QueryTransactionRequestTest extends TestCase
{
    /**
     * @var QueryTransactionRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new QueryTransactionRequest($client, $request);
    }

    public function testGetData()
    {
        $this->request->setAmount(1);
        $this->request->setRequestId(2);
        $this->request->setAccessKey(3);
        $this->request->setPartnerCode(4);
        $this->request->setSecretKey(5);
        $this->request->setOrderId(6);
        $data = $this->request->getData();
        $this->assertEquals(7, count($data));
        $this->assertEquals(1, $data['amount']);
        $this->assertEquals(2, $data['requestId']);
        $this->assertEquals(3, $data['accessKey']);
        $this->assertEquals(4, $data['partnerCode']);
        $this->assertEquals(null, $data['secretKey'] ?? null);
        $this->assertEquals(6, $data['orderId']);
        $this->assertTrue(isset($data['signature']));
        $this->assertEquals('transactionStatus', $data['requestType']);
    }
}
