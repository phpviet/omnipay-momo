<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Concerns;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait Parameters
{
    /**
     * Thiết lập secret key do MoMo cấp.
     *
     * @param  string  $key
     */
    public function setSecretKey(string $key): void
    {
        $this->setParameter('secretKey', $key);
    }

    /**
     * Thiết lập partner code do MoMo cấp.
     *
     * @param  string  $code
     */
    public function setPartnerCode(string $code): void
    {
        $this->setParameter('partnerCode', $code);
    }
}
