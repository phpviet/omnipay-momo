<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\AllInOne\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\AllInOne\QueryRefundRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class QueryRefundRequestTest extends TestCase
{
    /**
     * @var QueryRefundRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new QueryRefundRequest($client, $request);
    }

    public function testGetData()
    {
        $this->request->setRequestId(1);
        $this->request->setAccessKey(2);
        $this->request->setPartnerCode(3);
        $this->request->setSecretKey(4);
        $this->request->setOrderId(5);
        $data = $this->request->getData();
        $this->assertEquals(6, count($data));
        $this->assertEquals(1, $data['requestId']);
        $this->assertEquals(2, $data['accessKey']);
        $this->assertEquals(3, $data['partnerCode']);
        $this->assertEquals(null, $data['secretKey'] ?? null);
        $this->assertEquals(5, $data['orderId']);
        $this->assertTrue(isset($data['signature']));
        $this->assertEquals('refundStatus', $data['requestType']);
    }
}
