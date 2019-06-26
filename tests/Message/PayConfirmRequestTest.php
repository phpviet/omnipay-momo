<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\PayConfirmRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PayConfirmRequestTest extends TestCase
{
    /**
     * @var PayConfirmRequest
     */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new PayConfirmRequest($client, $request);
    }

    public function testGetData()
    {
        $this->request->setPartnerRefId(1);
        $this->request->setPartnerCode(2);
        $this->request->setMomoTransId(3);
        $this->request->setRequestId(4);
        $this->request->setRequestType(5);
        $this->request->setCustomerNumber(6);
        $this->request->setSecretKey(7);
        $this->request->setTestMode(true);
        $this->request->setPublicKey('-----BEGIN PUBLIC KEY-----
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
        $data = $this->request->getData();
        $this->assertEquals(7, count($data));
        $this->assertEquals(1, $data['partnerRefId']);
        $this->assertEquals(2, $data['partnerCode']);
        $this->assertEquals(3, $data['momoTransId']);
        $this->assertEquals(4, $data['requestId']);
        $this->assertEquals(5, $data['requestType']);
        $this->assertEquals(6, $data['customerNumber']);
        $this->assertEquals(null, $data['secretKey'] ?? null);
        $this->assertEquals(null, $data['publicKey'] ?? null);
        $this->assertEquals(null, $data['paymentCode'] ?? null);
        $this->assertEquals(null, $data['testMode'] ?? null);
        $this->assertTrue(isset($data['signature']));
    }
}
