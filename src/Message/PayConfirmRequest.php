<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\MoMo\Concerns\Parameters;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class PayConfirmRequest extends AbstractRequest
{
    use Parameters;
    use Concerns\RequestSignature;

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

    public function getData()
    {
        $this->validate('partnerCode', 'partnerRefId', 'requestType', 'requestId', 'momoTransId');
    }

    public function sendData($data)
    {
        // TODO: Implement sendData() method.
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        return ['partnerCode', 'partnerRefId', 'requestType', 'requestId', 'momoTransId'];
    }
}
