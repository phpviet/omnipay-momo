<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests;

use Omnipay\MoMo\Gateway;
use Omnipay\Omnipay;
use Omnipay\Tests\TestCase;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class FirstTest extends TestCase
{
    public function testCreate()
    {
        $gateway = Omnipay::create('MoMo');
        $gateway->setAccessKey('E8HZuQRy2RsjVtZp');
        $gateway->setSecretKey('fj00YKnJhmYqahaFWUgkg75saNTzMrbO');
        $gateway->setPartnerCode('MOMO0HGO20180417');
        $gateway->setTestMode(true);

        $orderId = microtime();
        $requestId = microtime();

        $responseData = $gateway->purchase([
            'amount' => 500000,
            'returnUrl' => 'http://localhost',
            'notifyUrl' => 'http://localhost',
            'orderId' => $orderId,
            'requestId' => $requestId,
        ])->send();

        print $responseData->getRedirectUrl(); die;
    }
}
