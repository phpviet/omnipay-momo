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
trait AllInOneParameters
{
    use Parameters;

    /**
     * Thiết lập access key do MoMo cấp.
     *
     * @param  string  $key
     */
    public function setAccessKey(string $key): void
    {
        $this->setParameter('accessKey', $key);
    }
}
