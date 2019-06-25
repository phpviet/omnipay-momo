<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Support;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class RSAEncrypt
{
    /**
     * Khóa dùng để mã hóa dữ liệu.
     *
     * @var string
     */
    protected $publicKey;

    /**
     * Khởi tạo đối tượng DataEncrypt.
     *
     * @param  string  $publicKey
     */
    public function __construct(string $publicKey)
    {
        $this->publicKey = $publicKey;
    }

    /**
     * Trả về chuỗi mã hóa của dữ liệu truyền vào.
     *
     * @param  array  $data
     * @return string
     */
    public function encrypt(array $data): string
    {
        $data = json_encode($data);
        openssl_public_encrypt($data, $dataEncrypted, $this->publicKey, OPENSSL_PKCS1_PADDING);

        return base64_encode($dataEncrypted);
    }
}
