<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo;

use Omnipay\Common\AbstractGateway;
use Omnipay\MoMo\Message\PayConfirmResponse;
use Omnipay\MoMo\Message\QRCode\NotificationRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class QRCodeGateway extends AbstractGateway
{
    use Concerns\QRCodeParameters;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'MoMo QRCode';
    }

    /**
     * Tạo request notification gửi từ MoMo.
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|NotificationRequest
     */
    public function notification(array $options = []): NotificationRequest
    {
        return $this->createRequest(NotificationRequest::class, $options);
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
