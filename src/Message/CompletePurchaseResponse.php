<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class CompletePurchaseResponse extends AbstractResponse
{
    /**
     * Trả về thời gian phản hồi phiên giao dịch.
     *
     * @return string
     */
    public function getResponseTime(): string
    {
        return $this->data['responseTime'];
    }

    /**
     * Trả về giống với order id đã gửi lên MoMo, dùng để đối soát.
     *
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->data['orderId'];
    }

    /**
     * Trả về giống với order info đã gửi lên MoMo, dùng để đối soát.
     *
     * @return string
     */
    public function getOrderInfo(): string
    {
        return $this->data['orderInfo'];
    }

    /**
     * Trả về giống với amount đã gửi lên MoMo, dùng để đối soát.
     *
     * @return string
     */
    public function getAmount(): string
    {
        return $this->data['amount'];
    }

    /**
     * Trả về mã giao dịch của MoMo.
     *
     * @return string
     */
    public function getTransId(): string
    {
        return $this->data['transId'];
    }

    /**
     * Trả về giống với extra data đã gửi lên MoMo, dùng để đối soát.
     *
     * @return string
     */
    public function getExtraData(): string
    {
        return $this->data['extraData'];
    }

    /**
     * Trả về giống với partner code đã gửi lên MoMo, dùng để đối soát.
     *
     * @return string
     */
    public function getPartnerCode(): string
    {
        return $this->data['partnerCode'];
    }

    /**
     * Trả về giống với access key đã gửi lên MoMo, dùng để đối soát.
     *
     * @return string
     */
    public function getAccessKey(): string
    {
        return $this->data['accessKey'];
    }
}
