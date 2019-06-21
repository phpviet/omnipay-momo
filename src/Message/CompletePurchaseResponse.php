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
    use Concerns\PurchasedResponseParameters;

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
     * Trả về giống với order info đã gửi lên MoMo, dùng để đối soát.
     *
     * @return string
     */
    public function getOrderInfo(): string
    {
        return $this->data['orderInfo'];
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
}
