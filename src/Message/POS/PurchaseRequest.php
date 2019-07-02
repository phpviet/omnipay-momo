<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\POS;

use Omnipay\MoMo\Message\AbstractHashRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseRequest extends AbstractHashRequest
{
    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = []): self
    {
        parent::initialize($parameters);
        $this->setParameter('payType', 3);
        $this->setParameter('version', 2);

        return $this;
    }

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('paymentCode');
        $parameters = parent::getData();
        unset($parameters['paymentCode']);

        return $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data): PurchaseResponse
    {
        $response = $this->httpClient->request('POST', $this->getEndpoint().'/pay/pos', [
            'Content-Type' => 'application/json; charset=utf-8',
        ], json_encode($data));
        $responseData = $response->getBody()->getContents();

        return $this->response = new PurchaseResponse($this, json_decode($responseData, true) ?? []);
    }

    /**
     * Trả về mã cửa hàng.
     *
     * @return null|string
     */
    public function getStoreId(): ?string
    {
        return $this->getParameter('storeId');
    }

    /**
     * Thiết lập mã cửa hàng.
     *
     * @param  string  $id
     * @return self
     */
    public function setStoreId(string $id): self
    {
        return $this->setParameter('storeId', $id);
    }

    /**
     * Trả về tên cửa hàng.
     *
     * @return null|string
     */
    public function getStoreName(): ?string
    {
        return $this->getParameter('storeName');
    }

    /**
     * Thiết lập tên cửa hàng.
     *
     * @param  string  $name
     * @return self
     */
    public function setStoreName(string $name): self
    {
        return $this->setParameter('storeName', $name);
    }

    /**
     * Trả về mã đơn hàng.
     *
     * @return null|string
     */
    public function getPartnerRefId(): ?string
    {
        return $this->getParameter('partnerRefId');
    }

    /**
     * Thiết lập mã đơn hàng.
     *
     * @param  string  $id
     * @return self
     */
    public function setPartnerRefId(string $id): self
    {
        return $this->setParameter('partnerRefId', $id);
    }

    /**
     * Trả về mã thanh toán.
     *
     * @return null|string
     */
    public function getPaymentCode(): ?string
    {
        return $this->getParameter('paymentCode');
    }

    /**
     * Thiết lập mã khách thanh toán.
     *
     * @param  string  $code
     * @return self
     */
    public function setPaymentCode(string $code): self
    {
        return $this->setParameter('paymentCode', $code);
    }

    /**
     * {@inheritdoc}
     */
    protected function getHashParameters(): array
    {
        $parameters = [
            'partnerCode', 'partnerRefId', 'amount', 'paymentCode',
        ];

        if ($this->getParameter('storeId')) {
            $parameters[] = 'storeId';
        }

        if ($this->getParameter('storeName')) {
            $parameters[] = 'storeName';
        }

        return $parameters;
    }
}
