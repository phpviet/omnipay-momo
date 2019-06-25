<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\MoMo\Concerns\Parameters;

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
    use Parameters;

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
     * Thiết lập mã đơn hàng.
     *
     * @param  string  $id
     */
    public function setPartnerRefId(string $id): void
    {
        $this->setParameter('partnerRefId', $id);
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
     * Thiết lập số điện thoại khách hàng.
     *
     * @param  string  $number
     */
    public function setCustomerNumber(string $number): void
    {
        $this->setParameter('customerNumber', $number);
    }

    /**
     * Thiết lập loại request type yêu cầu MoMo, commit hoặc rollback.
     *
     * @param  string  $type
     */
    public function setRequestType(string $type): void
    {
        $this->setParameter('requestType', $type);
    }

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
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        return ['partnerCode', 'partnerRefId', 'requestType', 'requestId', 'momoTransId'];
    }
}
