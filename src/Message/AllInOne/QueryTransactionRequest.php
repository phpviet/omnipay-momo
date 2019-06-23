<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class QueryTransactionRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    public function getData(): array
    {
        $this->setParameter('requestType', 'transactionStatus');

        return parent::getData();
    }

    /**
     * {@inheritdoc}
     */
    protected function responseClass(): string
    {
        return QueryTransactionResponse::class;
    }
}
