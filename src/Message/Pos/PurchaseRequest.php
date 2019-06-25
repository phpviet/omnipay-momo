<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\Pos;

use Omnipay\MoMo\Concerns\PosParameters;
use Omnipay\MoMo\Message\AbstractHashRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PurchaseRequest extends AbstractHashRequest
{
    use PosParameters;

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
     * Thiết lập mã khách thanh toán.
     *
     * @param  string  $code
     */
    public function setPaymentCode(string $code): void
    {
        $this->setParameter('paymentCode', $code);
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        $this->setParameter('payType', 3);
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
     * {@inheritdoc}
     */
    protected function getHashParameters(): array
    {
        $parameters = [
            'partnerCode', 'partnerRefId', 'amount', 'paymentCode', 'storeId', 'storeName',
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
