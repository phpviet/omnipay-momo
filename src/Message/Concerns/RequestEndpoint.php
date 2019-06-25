<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\Concerns;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait RequestEndpoint
{
    /**
     * Trả về url kết nối MoMo.
     *
     * @return string
     */
    protected function getEndpoint(): string
    {
        return $this->getTestMode() ? 'https://test-payment.momo.vn' : 'https://payment.momo.vn';
    }
}
