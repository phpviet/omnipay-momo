<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo;

use Omnipay\Common\AbstractGateway;
use Omnipay\MoMo\Message\AllInOne\RefundRequest;
use Omnipay\MoMo\Message\AllInOne\PurchaseRequest;
use Omnipay\MoMo\Message\AllInOne\QueryRefundRequest;
use Omnipay\MoMo\Message\AllInOne\QueryTransactionRequest;
use Omnipay\MoMo\Message\AllInOne\CompletePurchaseRequest;
use Omnipay\MoMo\Message\AllInOne\CompletePurchaseNotifyRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class AllInOneGateway extends AbstractGateway
{
    use Concerns\AllInOneParameters;

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'MoMo';
    }

    /**
     * Create complete purchase request.
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|CompletePurchaseRequest
     */
    public function completePurchase(array $options = []): CompletePurchaseRequest
    {
        return $this->createRequest(CompletePurchaseRequest::class, $options);
    }

    /**
     * Create complete purchase notify request.
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|CompletePurchaseNotifyRequest
     */
    public function completePurchaseNotify(array $options = []): CompletePurchaseNotifyRequest
    {
        return $this->createRequest(CompletePurchaseNotifyRequest::class, $options);
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\RequestInterface|PurchaseRequest
     */
    public function purchase(array $options = []): PurchaseRequest
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    /**
     * Tạo yêu cầu truy vấn thông tin giao dịch đến MoMo.
     *
     * @param  array  $options
     * @return \Omnipay\Common\Message\RequestInterface|QueryTransactionRequest
     */
    public function queryTransaction(array $options = []): QueryTransactionRequest
    {
        return $this->createRequest(QueryTransactionRequest::class, $options);
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\RequestInterface|RefundRequest
     */
    public function refund(array $options = [])
    {
        return $this->createRequest(RefundRequest::class, $options);
    }

    /**
     * {@inheritdoc}
     * @return \Omnipay\Common\Message\RequestInterface|QueryRefundRequest
     */
    public function queryRefund(array $options = [])
    {
        return $this->createRequest(QueryRefundRequest::class, $options);
    }
}
