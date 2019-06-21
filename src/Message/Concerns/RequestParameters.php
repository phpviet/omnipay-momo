<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\Concerns;

use Omnipay\MoMo\Concerns\Parameters as BaseParameters;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait RequestParameters
{
    use BaseParameters;

    /**
     * Thiết lập request id của đơn hàng.
     *
     * @param string $id
     */
    public function setRequestId(string $id): void
    {
        $this->setParameter('requestId', $id);
    }

    /**
     * Thiết lập id đơn hàng.
     *
     * @param string $id
     */
    public function setOrderId(string $id): void
    {
        $this->setParameter('orderId', $id);
    }
}
