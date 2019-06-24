<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\AllInOne\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\AllInOne\PurchaseRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseRequestTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new PurchaseRequest($client, $request);
    }

    public function testGetData()
    {
        $this->request->setExtraData(1);
        $this->request->setOrderInfo(2);
        $this->request->setAmount(3);
        $this->request->setRequestId(4);
        $this->request->setAccessKey(5);
        $this->request->setPartnerCode(6);
        $this->request->setSecretKey(7);
        $this->request->setOrderId(8);
        $this->request->setReturnUrl(9);
        $this->request->setNotifyUrl(10);
        $this->request->setTestMode(11);
        $data = $this->request->getData();
        $this->assertEquals(11, count($data));
        $this->assertEquals(1, $data['extraData']);
        $this->assertEquals(2, $data['orderInfo']);
        $this->assertEquals(3, $data['amount']);
        $this->assertEquals(4, $data['requestId']);
        $this->assertEquals(5, $data['accessKey']);
        $this->assertEquals(6, $data['partnerCode']);
        $this->assertEquals(null, $data['secretKey'] ?? null);
        $this->assertEquals(8, $data['orderId']);
        $this->assertEquals(8, $data['orderId']);
        $this->assertEquals(9, $data['returnUrl']);
        $this->assertEquals(10, $data['notifyUrl']);
        $this->assertEquals(null, $data['testMode'] ?? null);
        $this->assertTrue(isset($data['signature']));
    }
}
