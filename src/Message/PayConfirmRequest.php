<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

/**
 * @link https://developers.momo.vn/#/docs/pos_payment?id=x%c3%a1c-nh%e1%ba%adn-giao-d%e1%bb%8bch
 * @link https://developers.momo.vn/#/docs/qr_payment?id=x%c3%a1c-nh%e1%ba%adn-giao-d%e1%bb%8bch
 * @link https://developers.momo.vn/#/docs/app_in_app?id=x%c3%a1c-nh%e1%ba%adn-giao-d%e1%bb%8bch
 *
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PayConfirmRequest extends AbstractSignatureRequest
{
    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidResponseException
     */
    public function sendData($data): PayConfirmResponse
    {
        $response = $this->httpClient->request('POST', $this->getEndpoint().'/pay/confirm', [
            'Content-Type' => 'application/json; charset=utf-8',
        ], json_encode($data));
        $responseData = $response->getBody()->getContents();

        return $this->response = new PayConfirmResponse($this, json_decode($responseData, true) ?? []);
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
     * Trả về só điện thoại của khách hàng.
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
     * Trả về loại request yêu cầu MoMo xử lý.
     *
     * @return null|string
     */
    public function getRequestType(): ?string
    {
        return $this->getParameter('requestType');
    }

    /**
     * Thiết lập loại request type yêu cầu MoMo, commit hoặc rollback.
     *
     * @param  null|string  $type
     * @return $this
     */
    public function setRequestType(?string $type)
    {
        return $this->setParameter('requestType', $type);
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        return [
            'partnerCode', 'partnerRefId', 'requestType', 'requestId', 'momoTransId',
        ];
    }
}
