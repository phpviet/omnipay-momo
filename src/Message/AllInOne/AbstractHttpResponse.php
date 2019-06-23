<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class AbstractHttpResponse extends AbstractResponse
{
    use Concerns\PurchasedResponseParameters;

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(string $requestType): array
    {
        return [
            'partnerCode', 'accessKey', 'requestId', 'amount', 'orderId', 'orderInfo', 'orderType',
            'transId', 'message', 'localMessage', 'responseTime', 'errorCode', 'payType', 'extraData',
        ];
    }

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

    /**
     * Trả về phương thức thanh toán của khách.
     *
     * @return string
     */
    public function getPayType(): string
    {
        return $this->data['payType'];
    }

    /**
     * Trả về order type từ MoMo.
     *
     * @return string
     */
    public function getOrderType(): string
    {
        return $this->data['orderType'];
    }
}
