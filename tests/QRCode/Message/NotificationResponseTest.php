<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Tests\QRCode\Message;

use Omnipay\Tests\TestCase;
use Omnipay\MoMo\Message\QRCode\NotificationResponse;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class NotificationResponseTest extends TestCase
{
    public function testConstruct()
    {
        $response = new NotificationResponse($this->getMockRequest(), [
            'example' => 'value',
            'foo' => 'bar',
        ]);

        $this->assertEquals(['example' => 'value', 'foo' => 'bar'], $response->getData());
    }

    public function testResponse()
    {
        $request = $this->getMockRequest();
        $request->shouldReceive('getSecretKey')->once()->andReturn('fj00YKnJhmYqahaFWUgkg75saNTzMrbO');
        $response = new NotificationResponse(
            $request,
            [
                'partnerCode' => 'MOMO0HGO20180417',
                'accessKey' => 'E8HZuQRy2RsjVtZp',
                'amount' => 10000,
                'partnerRefId' => 'B001221',
                'partnerTransId' => '',
                'transType' => 'momo_wallet',
                'momoTransId' => '43121679',
                'status' => 0,
                'message' => 'Thành Công',
                'responseTime' => 1555472829549,
                'storeId' => 'store001',
                'signature' => 'f25c699ee9c961eaca8f91227413877d4c7ce6818342abdcf014d5f799a953d3',
            ]
        );

        $this->assertSame('MOMO0HGO20180417', $response->partnerCode);
        $this->assertSame('momo_wallet', $response->transType);
    }
}
