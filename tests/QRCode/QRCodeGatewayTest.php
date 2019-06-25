<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\QRCode;

use Omnipay\Omnipay;
use Omnipay\Tests\GatewayTestCase;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class QRCodeGatewayTest extends GatewayTestCase
{
    protected function setUp()
    {
        $this->gateway = Omnipay::create('MoMo_QRCode', $this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setAccessKey('E8HZuQRy2RsjVtZp');
        $this->gateway->setPartnerCode('MOMO0HGO20180417');
        $this->gateway->setSecretKey('fj00YKnJhmYqahaFWUgkg75saNTzMrbO');
        $this->gateway->setTestMode(true);

        parent::setUp();
    }

    public function testNotification()
    {
        $this->getHttpRequest()->initialize([], [], [], [], [], [], '{"partnerCode":"MOMO0HGO20180417","accessKey":"E8HZuQRy2RsjVtZp","amount":10000,"partnerRefId":"B001221","partnerTransId":"","transType":"momo_wallet","momoTransId":"43121679","status":0,"message":"Th\u00e0nh C\u00f4ng","responseTime":1555472829549,"storeId":"store001","signature":"f25c699ee9c961eaca8f91227413877d4c7ce6818342abdcf014d5f799a953d3"}');
        $response = $this->gateway->notification()->send();
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('MOMO0HGO20180417', $response->partnerCode);
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testDefaultParametersHaveMatchingMethods()
    {
        parent::testDefaultParametersHaveMatchingMethods();
    }
}
