<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\AllInOne;

use Omnipay\Omnipay;
use Omnipay\Tests\GatewayTestCase;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\MoMo\Message\AllInOne\NotificationRequest;
use Omnipay\MoMo\Message\AllInOne\CompletePurchaseRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class AllInOneGatewayTest extends GatewayTestCase
{
    protected function setUp()
    {
        $this->gateway = Omnipay::create('MoMo_AllInOne', $this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setAccessKey('E8HZuQRy2RsjVtZp');
        $this->gateway->setPartnerCode('MOMO0HGO20180417');
        $this->gateway->setSecretKey('fj00YKnJhmYqahaFWUgkg75saNTzMrbO');
        $this->gateway->setTestMode(true);

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

        $this->assertFalse($response->isSuccessful());
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

    public function testQueryTransaction()
    {
        $this->setMockHttpResponse('QueryTransaction.txt');
        $response = $this->gateway->queryTransaction([
            'orderId' => '0.38857000 1561110614',
            'requestId' => microtime(true),
        ])->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertEquals(500000, $response->amount);
    }

    public function testRefund()
    {
        $this->setMockHttpResponse('Refund.txt');
        $response = $this->gateway->refund([
            'orderId' => '0.38857000 1561110614',
            'requestId' => microtime(true),
            'transId' => 123,
            'amount' => 10000,
        ])->send();

        $this->assertEquals(123, $response->transId);
        $this->assertEquals(10000, $response->amount);
        $this->assertEquals('0.38857000 1561110614', $response->orderId);
    }

    public function testQueryRefund()
    {
        $this->setMockHttpResponse('QueryRefund.txt');
        $response = $this->gateway->queryRefund([
            'orderId' => '0.38857000 1561110614',
            'requestId' => microtime(true),
        ])->send();

        $this->assertEquals('99', $response->getCode());
    }

    public function testCompletePurchaseSuccess()
    {
        $request = $this->gateway->completePurchase();
        $this->assertInstanceOf(CompletePurchaseRequest::class, $request);
        $this->expectException(InvalidRequestException::class);
        $request->getData();
    }

    public function testNotification()
    {
        $request = $this->gateway->notification();
        $this->assertInstanceOf(NotificationRequest::class, $request);
        $this->expectException(InvalidRequestException::class);
        $request->getData();
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testDefaultParametersHaveMatchingMethods()
    {
        parent::testDefaultParametersHaveMatchingMethods();
    }
}
