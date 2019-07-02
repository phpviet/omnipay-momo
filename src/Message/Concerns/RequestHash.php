<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\Concerns;

use Omnipay\MoMo\Support\Arr;
use Omnipay\MoMo\Support\RSAEncrypt;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
trait RequestHash
{
    /**
     * Trả về dữ liệu mã hóa theo [[getHashParameters()]].
     *
     * @return string
     */
    protected function generateHash(): string
    {
        $data = [];
        $rsa = new RSAEncrypt(
            $this->getPublicKey()
        );
        $parameters = $this->getParameters();

        foreach ($this->getHashParameters() as $pos => $parameter) {
            if (! is_string($pos)) {
                $pos = $parameter;
            }

            $data[$pos] = Arr::getValue($parameter, $parameters);
        }

        return $rsa->encrypt($data);
    }

    /**
     * Trả về danh sách parameters dùng để mã hóa gửi đến MoMo.
     *
     * @return array
     */
    abstract protected function getHashParameters(): array;
}
