<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo;

use Omnipay\Common\AbstractGateway;
use Omnipay\MoMo\Message\PayConfirmResponse;
use Omnipay\MoMo\Message\Pos\PurchaseRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PosGateway extends AbstractGateway
{
    use Concerns\PosParameters;

    /**
     * {@inheritdoc}
     */
    public function getDefaultParameters(): array
    {
        return [
            'version' => '2.0',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\RequestInterface|PurchaseRequest
     */
    public function purchase(array $options = []): PurchaseRequest
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Tạo yêu cầu xác nhận hoàn thành hoặc hủy bỏ giao dịch đến MoMo.
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|PayConfirmResponse
     */
    public function payConfirm(array $options = []): PayConfirmResponse
    {
        return $this->createRequest(PayConfirmResponse::class, $options);
    }
}
