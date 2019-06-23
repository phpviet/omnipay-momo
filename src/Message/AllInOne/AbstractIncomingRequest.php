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
abstract class AbstractIncomingRequest extends AbstractRequest
{
    use Concerns\IncomingRequestParameters;

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
        $this->parameters->replace($this->getIncomingParameters());

        return $this;
    }
}
