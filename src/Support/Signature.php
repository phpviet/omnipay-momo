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
class Signature
{
    /**
     * Khóa bí mật dùng để tạo và kiểm tra chữ ký dữ liệu.
     *
     * @var string
     */
    protected $secretKey;

    /**
     * Khởi tạo đối tượng DataSignature.
     *
     * @param  string  $secretKey
     */
    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * Trả về chữ ký dữ liệu của dữ liệu truyền vào.
     *
     * @param  array  $data
     * @return string
     */
    public function generate(array $data): string
    {
        $data = urldecode(http_build_query($data));

        return hash_hmac('sha256', $data, $this->secretKey);
    }

    /**
     * Kiểm tra tính hợp lệ của chữ ký dữ liệu so với dữ liệu truyền vào.
     *
     * @param  array  $data
     * @param  string  $expect
     * @return bool
     */
    public function validate(array $data, string $expect): bool
    {
        $actual = $this->generate($data);

        return 0 === strcasecmp($expect, $actual);
    }
}
