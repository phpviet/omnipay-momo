<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AppInApp;

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
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        $this->setParameter('payType', 3);
        $this->setParameter('version', 2);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        $this->validate('appData', 'customerNumber');

        return parent::getData();
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $response = $this->httpClient->request('POST', $this->getEndpoint().'/pay/app', [
            'Content-Type' => 'application/json; charset=utf-8',
        ], json_encode($data));
        $responseData = $response->getBody()->getContents();

        return $this->response = new PurchaseResponse($this, json_decode($responseData, true) ?? []);
    }

    /**
     * Trả về app data token nhận từ MoMo.
     *
     * @return null|string
     */
    public function getAppData(): ?string
    {
        return $this->getParameter('appData');
    }

    /**
     * Thiết app token từ app MoMo gửi sang.
     *
     * @param  null|string  $appData
     * @return $this
     */
    public function setAppData(?string $appData)
    {
        return $this->setParameter('appData', $appData);
    }

    /**
     * Trả về tên cửa hàng.
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
     * @param  null|string  $id
     * @return $this
     */
    public function setStoreId(?string $id)
    {
        return $this->setParameter('storeId', $id);
    }

    /**
     * Trả về store name.
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
     * @param  null|string  $name
     * @return $this
     */
    public function setStoreName(?string $name)
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
     * @param  null|string  $id
     * @return $this
     */
    public function setPartnerRefId(?string $id)
    {
        return $this->setParameter('partnerRefId', $id);
    }

    /**
     * Trả về mã đơn hàng bổ sung.
     *
     * @return null|string
     */
    public function getPartnerTransId(): ?string
    {
        return $this->getParameter('partnerTransId');
    }

    /**
     * Thiết lập mã đơn hàng bổ sung.
     *
     * @param  null|string  $id
     * @return $this
     */
    public function setPartnerTransId(?string $id)
    {
        return $this->setParameter('partnerTransId', $id);
    }

    /**
     * Trả về tên công ty, đơn vị của bạn.
     *
     * @return null|string
     */
    public function getPartnerName(): ?string
    {
        return $this->getParameter('partnerName');
    }

    /**
     * Thiết lập tên công ty, tổ chức của bạn.
     *
     * @param  null|string  $name
     * @return $this
     */
    public function setPartnerName(?string $name)
    {
        return $this->setParameter('partnerName', $name);
    }

    /**
     * Trả về số điện thoại khách hàng.
     *
     * @return null|string
     */
    public function getCustomerNumber(): ?string
    {
        return $this->getParameter('customerNumber');
    }

    /**
     * Thiết lập số điện thoại khách hàng.
     *
     * @param  null|string  $number
     * @return $this
     */
    public function setCustomerNumber(?string $number)
    {
        return $this->setParameter('customerNumber', $number);
    }

    /**
     * {@inheritdoc}
     */
    protected function getHashParameters(): array
    {
        $parameters = [
            'partnerCode', 'partnerRefId', 'amount',
        ];

        if ($this->getParameter('partnerName')) {
            $parameters[] = 'partnerName';
        }

        if ($this->getParameter('partnerTransId')) {
            $parameters[] = 'partnerTransId';
        }

        if ($this->getParameter('storeId')) {
            $parameters[] = 'storeId';
        }

        if ($this->getParameter('storeName')) {
            $parameters[] = 'storeName';
        }

        return $parameters;
    }
}
