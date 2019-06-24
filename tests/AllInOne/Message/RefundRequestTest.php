<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\AllInOne\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\AllInOne\RefundRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class RefundRequestTest extends TestCase
{
    /**
     * @var RefundRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new RefundRequest($client, $request);
    }

    public function testGetData()
    {
        $this->request->setAmount(1);
        $this->request->setRequestId(2);
        $this->request->setAccessKey(3);
        $this->request->setPartnerCode(4);
        $this->request->setSecretKey(5);
        $this->request->setOrderId(6);
        $this->request->setTransId(7);
        $data = $this->request->getData();
        $this->assertEquals(8, count($data));
        $this->assertEquals(1, $data['amount']);
        $this->assertEquals(2, $data['requestId']);
        $this->assertEquals(3, $data['accessKey']);
        $this->assertEquals(4, $data['partnerCode']);
        $this->assertEquals(null, $data['secretKey'] ?? null);
        $this->assertEquals(6, $data['orderId']);
        $this->assertTrue(isset($data['signature']));
        $this->assertEquals('refundMoMoWallet', $data['requestType']);
    }
}
