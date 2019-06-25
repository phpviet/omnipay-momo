<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne;

/**
 * @link https://developers.momo.vn/#/docs/aio/?id=ph%c6%b0%c6%a1ng-th%e1%bb%a9c-thanh-to%c3%a1n
 *
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseRequest extends AbstractSignatureRequest
{
    /**
     * {@inheritdoc}
     */
    protected $responseClass = PurchaseResponse::class;

    /**
     * Thiết lập dữ liệu kèm theo đơn hàng.
     *
     * @param  string  $data
     */
    public function setExtraData(string $data): void
    {
        $this->setParameter('extraData', $data);
    }

    /**
     * Thiết lập thông tin đơn hàng.
     *
     * @param  string  $info
     */
    public function setOrderInfo(string $info): void
    {
        $this->setParameter('orderInfo', $info);
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->setOrderInfo($this->getParameter('orderInfo') ?? '');
        $this->setExtraData($this->getParameter('extraData') ?? '');
        $this->setParameter('requestType', 'captureMoMoWallet');

        return parent::getData();
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        return [
            'partnerCode', 'accessKey', 'requestId', 'amount', 'orderId', 'orderInfo', 'returnUrl', 'notifyUrl',
            'extraData',
        ];
    }
}
