<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\Concerns;

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
        $rsa = new RSAEncrypt($this->getParameter('publicKey'));

        foreach ($this->getHashParameters() as $parameter) {
            $data[$parameter] = $this->getParameter($parameter);
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
