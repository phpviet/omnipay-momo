<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * @inheritDoc
     */
    public function isSuccessful(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function isRedirect(): bool
    {
        return 0 === (int) $this->data['errorCode'];
    }

    /**
     * @inheritDoc
     */
    public function getRedirectUrl(): string
    {
        return $this->data['payUrl'];
    }

    /**
     * Trả về qr code image url dành cho thanh toán trực tiếp không cần chuyển sang MoMo.
     *
     * @return string
     */
    public function getQrCodeUrl(): string
    {
        return $this->data['qrCodeUrl'];
    }

    /**
     * Trả về link mở MoMo app cho khách hàng thanh toán.
     *
     * @return string
     */
    public function getDeepLink(): string
    {
        return $this->data['deeplink'];
    }

    /**
     * Trả về link mở màn hình xác nhận thanh toán của MoMo. Khi web của bạn nằm trong MoMo app.
     *
     * @return string
     */
    public function getDeepLinkWebInApp(): string
    {
        return $this->data['deeplinkWebInApp'];
    }

    /**
     * @inheritDoc
     */
    public function getMessage(): string
    {
        return $this->data['message'];
    }

    /**
     * Trả về message tiếng việt.
     *
     * @return string
     */
    public function getLocalMessage(): string
    {
        return $this->data['localMessage'];
    }

    /**
     * Trả về giống với request id đã gửi lên MoMo, dùng để đối soát.
     *
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->data['requestId'];
    }

    /**
     * Trả về giống với request type đã gửi lên MoMo, dùng để đối soát.
     *
     * @return string
     */
    public function getRequestType(): string
    {
        return $this->data['requestType'];
    }
}
