<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\AllInOne\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\AllInOne\NotificationRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class NotificationRequestTest extends TestCase
{
    /**
     * @var NotificationRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $params = [
            'partnerCode', 'accessKey', 'requestId', 'amount', 'orderId', 'orderInfo', 'orderType', 'transId',
            'message', 'localMessage', 'responseTime', 'errorCode', 'extraData', 'signature', 'payType',
        ];
        $request->initialize([], array_combine($params, range(1, 15)));
        $this->request = new NotificationRequest($client, $request);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertEquals(15, count($data));
        $this->assertEquals(1, $data['partnerCode']);
        $this->assertEquals(2, $data['accessKey']);
        $this->assertEquals(3, $data['requestId']);
        $this->assertEquals(4, $data['amount']);
        $this->assertEquals(5, $data['orderId']);
        $this->assertEquals(6, $data['orderInfo']);
        $this->assertEquals(7, $data['orderType']);
        $this->assertEquals(8, $data['transId']);
        $this->assertEquals(9, $data['message']);
        $this->assertEquals(10, $data['localMessage']);
        $this->assertEquals(11, $data['responseTime']);
        $this->assertEquals(12, $data['errorCode']);
        $this->assertEquals(13, $data['extraData']);
        $this->assertEquals(14, $data['signature']);
        $this->assertEquals(15, $data['payType']);
    }
}
