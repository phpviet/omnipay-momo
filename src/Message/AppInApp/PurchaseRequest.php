<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AppInApp;

use Omnipay\MoMo\Concerns\AppInAppParameters;
use Omnipay\MoMo\Message\AbstractHashRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseRequest extends AbstractHashRequest
{
    use AppInAppParameters;

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        $this->validate('appData', 'customerNumber');
        $this->setParameter('payType', 3);

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
     * Thiết app token từ app MoMo gửi sang.
     *
     * @param  string  $appData
     */
    public function setAppData(string $appData): void
    {
        $this->setParameter('appData', $appData);
    }

    /**
     * Thiết lập mã cửa hàng.
     *
     * @param  string  $id
     */
    public function setStoreId(string $id): void
    {
        $this->setParameter('storeId', $id);
    }

    /**
     * Thiết lập tên cửa hàng.
     *
     * @param  string  $name
     */
    public function setStoreName(string $name): void
    {
        $this->setParameter('storeName', $name);
    }

    /**
     * Thiết lập mã đơn hàng.
     *
     * @param  string  $id
     */
    public function setPartnerRefId(string $id): void
    {
        $this->setParameter('partnerRefId', $id);
    }

    /**
     * Thiết lập mã đơn hàng bổ sung.
     *
     * @param  string  $id
     */
    public function setPartnerTransId(string $id): void
    {
        $this->setParameter('partnerTransId', $id);
    }

    /**
     * Thiết lập tên công ty, tổ chức của bạn.
     *
     * @param  string  $name
     */
    public function setPartnerName(string $name): void
    {
        $this->setParameter('partnerName', $name);
    }

    /**
     * Thiết lập số điện thoại khách hàng.
     *
     * @param  string  $number
     */
    public function setCustomerNumber(string $number): void
    {
        $this->setParameter('customerNumber', $number);
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
