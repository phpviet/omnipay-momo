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
class PurchaseRequest extends AbstractRequest
{
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
     * @inheritDoc
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount', 'returnUrl', 'notifyUrl');
        $this->setOrderInfo($this->getParameter('orderInfo') ?? '');
        $this->setExtraData($this->getParameter('extraData') ?? '');
        $this->setParameter('requestType', 'captureMoMoWallet');
        $this->setParameter('signature', $this->generateSignature());

        return array_merge(parent::getData(), $this->getParameters());
    }

    /**
     * @inheritDoc
     */
    public function sendData($data)
    {
        $response = $this->httpClient->request('POST', $this->getEndpoint(), [
            'Content-Type' => 'application/json; charset=UTF-8',
        ], json_encode($data));
        $contents = $response->getBody()->getContents();

        return $this->response = new PurchaseResponse($this, json_decode($contents, true));
    }
}
