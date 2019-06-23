<?php
/**
 * @link https://github.com/phpviet/omnipay-momo
 * @copyright (c) PHP Viet
 * @license [MIT](http://www.opensource.org/licenses/MIT)
 */

namespace Omnipay\MoMo\Message\AllInOne;

use Omnipay\Common\Message\AbstractRequest;

/**
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
abstract class AbstractHttpRequest extends AbstractRequest
{
    use Concerns\HttpRequestData;

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
}
