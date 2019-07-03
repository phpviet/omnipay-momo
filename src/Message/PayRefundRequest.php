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
class PayRefundRequest extends AbstractHashRequest
{
    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        $this->setParameter('version', 2);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data)
    {
        $response = $this->httpClient->request('POST', $this->getEndpoint().'/pay/refund', [
            'Content-Type' => 'application/json; charset=utf-8',
        ], json_encode($data));
        $responseData = $response->getBody()->getContents();

        return $this->response = new PayRefundResponse($this, json_decode($responseData, true) ?? []);
    }

    /**
     * Trả về request id.
     *
     * @return null|string
     */
    public function getRequestId(): ?string
    {
        return $this->getParameter('requestId');
    }

    /**
     * Thiết lập request id của đơn hàng.
     *
     * @param  null|string  $id
     * @return $this
     */
    public function setRequestId(?string $id)
    {
        return $this->setParameter('requestId', $id);
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
     * Trả về mã đơn hàng của MoMo.
     *
     * @return null|string
     */
    public function getMomoTransId(): ?string
    {
        return $this->getParameter('momoTransId');
    }

    /**
     * Thiết lập mã giao dịch của MoMo.
     *
     * @param  null|string  $id
     * @return $this
     */
    public function setMomoTransId(?string $id)
    {
        return $this->setParameter('momoTransId', $id);
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
     * @param  null|string  $id
     * @return $this
     */
    public function setStoreId(?string $id)
    {
        return $this->setParameter('storeId', $id);
    }

    /**
     * {@inheritdoc}
     */
    protected function getHashParameters(): array
    {
        $parameters = [
            'partnerCode', 'partnerRefId', 'momoTransId', 'amount',
        ];

        if ($this->getParameter('storeId')) {
            $parameters[] = 'storeId';
        }

        if ($this->getParameter('description')) {
            $parameters[] = 'description';
        }

        return $parameters;
    }
}
