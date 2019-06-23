<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests;

use Omnipay\Omnipay;
use Omnipay\Tests\GatewayTestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class AllInOneGatewayTest extends GatewayTestCase
{
    protected function setUp()
    {
        $this->gateway = Omnipay::create('MoMo_AllInOne', $this->getHttpClient(), $request = $this->getHttpRequest());
        $this->gateway->setAccessKey('MOMO0HGO20180417');
        $this->gateway->setPartnerCode('E8HZuQRy2RsjVtZp');
        $this->gateway->setSecretKey('fj00YKnJhmYqahaFWUgkg75saNTzMrbO');
        $this->gateway->setTestMode(true);
        $request->query->replace([

        ]);

        parent::setUp();
    }

    public function testPurchaseSuccess()
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->gateway->purchase([
            'amount' => 99999999,
            'returnUrl' => 'http://localhost',
            'notifyUrl' => 'http://localhost',
            'orderId' => microtime(true),
            'requestId' => microtime(true),
        ])->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertContains('momo.vn', $response->getRedirectUrl());
    }

    public function testPurchaseFailure()
    {
        $this->setMockHttpResponse('PurchaseFailure.txt');
        $response = $this->gateway->purchase([
            'amount' => 0,
            'returnUrl' => 'http://localhost',
            'notifyUrl' => 'http://localhost',
            'orderId' => microtime(true),
            'requestId' => microtime(true),
        ])->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertFalse($response->isRedirect());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testDefaultParametersHaveMatchingMethods()
    {
        parent::testDefaultParametersHaveMatchingMethods();
    }
}
