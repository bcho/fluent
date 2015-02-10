<?php namespace Flamingo\Fluent;

use Flamingo\Fluent\Contract\Renderable;

abstract class BaseWidget implements Renderable {

    /**
     * Widget tag name.
     *
     * @var string
     */
    protected $tagName = '';

    /**
     * Widget parameters.
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
    public function tag($tagName)
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
    public function param($name, $value)
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
    public function params($params)
    {
        $this->params = $params;

        return $this;
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

    /**
     * {@inheritdoc}
     */
    abstract function render();
}
