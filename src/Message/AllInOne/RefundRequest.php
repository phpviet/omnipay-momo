<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne;

/**
 * @link https://developers.momo.vn/#/docs/aio/?id=ho%c3%a0n-ti%e1%bb%81n-giao-d%e1%bb%8bch
 *
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class RefundRequest extends AbstractSignatureRequest
{
    /**
     * {@inheritdoc}
     */
    protected $responseClass = RefundResponse::class;

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        $this->setParameter('requestType', 'refundMoMoWallet');

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionId(): ?string
    {
        return $this->getTransId();
    }

    /**
     * {@inheritdoc}
     */
    public function setTransactionId($value)
    {
        return $this->setTransId($value);
    }

    /**
     * Trả về mã giao dịch của MoMo.
     *
     * @return null|string
     */
    public function getTransId(): ?string
    {
        return $this->getParameter('transId');
    }

    /**
     * Thiết lập mã giao dịch của MoMo.
     *
     * @param  null|string  $id
     * @return $this
     */
    public function setTransId(?string $id)
    {
        return $this->setParameter('transId', $id);
    }

    /**
     * {@inheritdoc}
     */
    protected function getSignatureParameters(): array
    {
        return [
            'partnerCode', 'accessKey', 'requestId', 'amount', 'orderId', 'transId', 'requestType',
        ];
    }
}
