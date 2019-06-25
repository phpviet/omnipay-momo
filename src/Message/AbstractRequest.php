<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractRequest extends BaseAbstractRequest
{
    use Concerns\RequestEndpoint;
    use Concerns\RequestSignature;

    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $parameters = $this->getParameters();
        call_user_func_array([$this, 'validate'], $this->getSignatureParameters());
        $parameters['signature'] = $this->generateSignature();
        unset($parameters['secretKey'], $parameters['testMode']);

        return $parameters;
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
}
