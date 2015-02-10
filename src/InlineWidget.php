<?php namespace Flamingo\Fluent;

use FluentForm\Contract\Renderable;

/**
 * Inline html widget.
 *
 * @package FluentForm
 */
class InlineWidget implements Renderable {

    /**
     * Widget html tag name.
     *
     * @var string
     */
    protected $tagName = 'hr';

    /**
     * Widget html tag parameters.
     *
     * @var array
     */
    protected $params = [];

    /**
     * Get widget tag name.
     *
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }

    /**
     * Set widget tag name.
     *
     * @param  string $tagName
     * @return $this
     */
    public function withTagName($tagName)
    {
        $this->tagName = $tagName;

        return $this;
    }

    /**
     * Get rendered html parameters.
     *
     * @return string
     */
    public function getParams()
    {
        return $this->buildParams($this->params);
    }

    /**
     * Set parameter.
     *
     * @param  string $name
     * @param  string $value
     * @return $this
     */
    public function withParam($name, $value)
    {
        $this->params[$name] = $value;

        return $this;
    }

    /**
     * Set parameters.
     *
     * @param  array $params
     * @return $this
     */
    public function withParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Render widget.
     *
     * @return string
     */
    public function render()
    {
        $tagName = $this->getTagName();
        $params = $this->getParams();

        return "<{$tagName} {$params}/>";
    }

    /**
     * Concat parameters.
     *
     * @param  array
     * @return string
     */
    protected function buildParams(array $params)
    {
        return implode(' ', array_map(function($k, $v) {
            return "{$k}=\"{$v}\"";
        }, array_keys($params), array_values($params)));
    }

}
