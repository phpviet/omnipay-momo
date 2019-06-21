<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message;

use Omnipay\Common\Message\AbstractRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractHttpRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate(array_keys($parameters = $this->getParameters()));

        return $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(array $parameters = []): self
    {
        parent::initialize($parameters);

        foreach ($this->getHttpRequestData() as $key => $value) {
            $this->setParameter($key, $value);
        }

        return $this;
    }

    /**
     * Trả về mảng dữ liệu từ HTTP dùng để khởi tạo parameters.
     * Nếu một trong các phần tử không tồn tại thì hãy thiết lập nó là NULL hổ trợ cho việc báo lỗi.
     *
     * @return array
     */
    abstract protected function getHttpRequestData(): array;
}
