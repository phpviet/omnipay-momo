<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\QRCode\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\QRCode\NotificationRequest;

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
        $request->initialize([], [], [], [], [], [], '{"partnerCode":"MOMO0HGO20180417","accessKey":"E8HZuQRy2RsjVtZp","amount":10000,"partnerRefId":"B001221","partnerTransId":"","transType":"momo_wallet","momoTransId":"43121679","status":0,"message":"Th\u00e0nh C\u00f4ng","responseTime":1555472829549,"storeId":"store001","signature":"f25c699ee9c961eaca8f91227413877d4c7ce6818342abdcf014d5f799a953d3"}');
        $this->request = new NotificationRequest($client, $request);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertEquals(12, count($data));
        $this->assertEquals('MOMO0HGO20180417', $data['partnerCode']);
        $this->assertEquals('E8HZuQRy2RsjVtZp', $data['accessKey']);
        $this->assertEquals(10000, $data['amount']);
        $this->assertEquals('B001221', $data['partnerRefId']);
        $this->assertEquals('', $data['partnerTransId']);
        $this->assertEquals('momo_wallet', $data['transType']);
        $this->assertEquals(43121679, $data['momoTransId']);
        $this->assertEquals(1555472829549, $data['responseTime']);
    }
}
