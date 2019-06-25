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
trait PosParameters
{
    use Parameters;

    /**
     * Thiết lập public key do MoMo cấp.
     *
     * @param  string  $key
     */
    public function setPublicKey($key): void
    {
        $this->setParameter('publicKey', $key);
    }
}
