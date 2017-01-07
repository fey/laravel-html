<?php

namespace Spatie\Html\Elements;

use Exception;
use Spatie\Html\Html;
use Spatie\Html\BaseElement;

class Select extends BaseElement
{
    /** @var string */
    protected $tag = 'select';

    /** @var array */
    protected $options = [];

    /** @var string */
    protected $value = '';

    /**
     * @param iterable $options
     *
     * @return static
     */
    public function options(iterable $options)
    {
        return $this->setChildren(
            array_map(function ($value, $label) {
                return Html::option($value, $label)->selectedIf($value === $this->value);
            }, $options, array_keys($options))
        );
    }

    /**
     * @param iterable|string $children
     *
     * @return static
     */
    public function setChildren($children)
    {
        if (! is_iterable($children)) {
            throw new Exception;
        }

        foreach ($children as $child) {
            if (! $child instanceof Option) {
                throw new Exception;
            }
        }

        return parent::setChildren($children);
    }

    /**
     * @param string $value
     *
     * @return static
     */
    public function value(string $value)
    {
        $element = clone $this;

        $element->value = $value;

        return $element;
    }
}
