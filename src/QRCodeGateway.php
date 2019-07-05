<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo;

use Omnipay\Common\AbstractGateway;
use Omnipay\MoMo\Message\PayRefundRequest;
use Omnipay\MoMo\Message\PayConfirmRequest;
use Omnipay\MoMo\Message\PayQueryStatusRequest;
use Omnipay\MoMo\Message\QRCode\NotificationRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class QRCodeGateway extends AbstractGateway
{
    use Concerns\Parameters;

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
     * @return \Omnipay\Common\Message\RequestInterface|PayConfirmRequest
     */
    public function payConfirm(array $options = []): PayConfirmRequest
    {
        return $this->createRequest(PayConfirmRequest::class, $options);
    }

    /**
     * Tạo yêu cầu truy vấn thông tin giao dịch đến MoMo.
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|PayQueryStatusRequest
     */
    public function queryTransaction(array $options = []): PayQueryStatusRequest
    {
        return $this->createRequest(PayQueryStatusRequest::class, $options);
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\RequestInterface|PayRefundRequest
     */
    public function refund(array $options = []): PayRefundRequest
    {
        return $this->createRequest(PayRefundRequest::class, $options);
    }
}
