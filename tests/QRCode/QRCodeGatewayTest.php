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
        $this->gateway->setPublicKey('-----BEGIN PUBLIC KEY-----
MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAiBIo9EMTElPppPejirL1cdgCuZUoBzGZ
F3SyrTp+xdMnIXSOiFYG+zHmI1lFzoEbEd1JwXAUV52gn/oAkUo+2qwuqZAPdkm714tiyjvxXE/0
WYLl8X1K8uCSK47u26CnOLgNB6iW1m9jog00i9XV/AmKI1U8OioLFSp1BwMf3O+jA9uuRfj1Lv5Q
0Q7RMtk4tgV924+D8mY/y3otBp5b+zX0NrWkRqwgPly6NeXN5LwqRj0LwAEVVwGbpl6V2cztYv94
ZHjGzNziFJli2D0Vpb/HRPP6ibXvllgbL4UXU4Izqhxml8gwd74jXaNaEgNJGhjjeUXR1sAm7Mpj
qqgyxpx6B2+GpjWtEwvbJuO8DsmQNsm+bJZhw46uf9AuY5VSYy2cAF1XMXSAPNLqYEE8oVUki4IW
YOEWSNXcQwikJC25rAErbyst/0i8RN4yqgiO/xVA1J1vdmRQTvGMXPGbDFpVca4MkHHLrkdC3Z3C
zgMkbIqnpaDYoIHZywraHWA7Zh5fDt/t7FzX69nbGg8i4QFLzIm/2RDPePJTY2R24w1iVO5RhEbK
EaTBMuibp4UJH+nEQ1p6CNdHvGvWz8S0izfiZmYIddaPatQTxYRq4rSsE/+2L+9RE9HMqAhQVveh
RGWWiGSY1U4lWVeTGq2suCNcMZdgDMbbIaSEJJRQTksCAwEAAQ==
-----END PUBLIC KEY-----');
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

    public function testPayConfirm()
    {
        $this->setMockHttpResponse('PayConfirm.txt');
        $response = $this->gateway->payConfirm([
            'partnerRefId' => 'Merchant123556666',
            'requestType' => 'capture',
            'requestId' => '1512529262248',
            'momoTransId' => '12436514111',
            'customerNumber' => '0963181714',
        ])->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals(30000, $response->data['amount']);
    }

    public function testRefund()
    {
        $this->setMockHttpResponse('Refund.txt');
        $response = $this->gateway->refund([
            'partnerRefId' => 'Merchant123556666',
            'requestType' => 'capture',
            'requestId' => '1512529262248',
            'momoTransId' => '12436514111',
            'amount' => 30000,
        ])->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals(30000, $response->amount);
    }

    public function testQueryTransaction()
    {
        $this->setMockHttpResponse('QueryTransaction.txt');
        $response = $this->gateway->queryTransaction([
            'partnerRefId' => 'Merchant123556666',
            'requestId' => '1512529262248',
            'momoTransId' => '12436514111',
        ])->send();

        $this->assertTrue($response->isSuccessful());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testDefaultParametersHaveMatchingMethods()
    {
        parent::testDefaultParametersHaveMatchingMethods();
    }
}
