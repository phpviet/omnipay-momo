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
class PayQueryStatusRequest extends AbstractHashRequest
{
    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->setParameter('version', 2);

        return parent::getData();
    }

    /**
     * {@inheritdoc}
     */
    public function sendData($data): PayQueryStatusResponse
    {
        $response = $this->httpClient->request('POST', $this->getEndpoint().'/pay/query-status', [
            'Content-Type' => 'application/json; charset=utf-8',
        ], json_encode($data));
        $responseData = $response->getBody()->getContents();

        return $this->response = new PayQueryStatusResponse($this, json_decode($responseData, true) ?? []);
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
     * @param  string  $id
     */
    public function setRequestId(string $id): void
    {
        $this->setParameter('requestId', $id);
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
     */
    public function setPartnerRefId(string $id): void
    {
        $this->setParameter('partnerRefId', $id);
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
     * @param  string  $id
     */
    public function setMomoTransId(string $id): void
    {
        $this->setParameter('momoTransId', $id);
    }

    /**
     * {@inheritdoc}
     */
    protected function getHashParameters(): array
    {
        $parameters = [
            'requestId', 'partnerCode', 'partnerRefId',
        ];

        if ($this->getParameter('momoTransId')) {
            $parameters[] = 'momoTransId';
        }

        return $parameters;
    }
}
