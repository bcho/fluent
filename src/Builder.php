<?php namespace Flamingo\Fluent;

use FluentForm\Contract\Renderable;

/**
 * Form builder.
 *
 * @package FluentForm
 */
class Builder implements Renderable {

    /**
     * Widget instance.
     *
     * @var \FluentForm\Contract\Renderable
     */
    protected $widget;

    /**
     * Is the widget a inline or block element?
     *
     * Defaults to `block`.
     *
     * @var string
     */
    protected $type = 'block';

    /**
     * Widget html tag name.
     *
     * @var string|null
     */
    protected $tagName = null;

    /**
     * Widget html parameters.
     *
     * @var array|null
     */
    protected $params = null;

    /**
     * Mark widget as an inline element.
     *
     * @return $this
     */
    public function inline()
    {
        $this->type = 'inline';

        return $this;
    }

    /**
     * Mark widget as a block element.
     *
     * @return $this
     */
    public function block()
    {
        $this->type = 'block';

        return $this;
    }

    /**
     * Set tag name.
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
     * Set parameters.
     *
     * @param  array $params
     * @return $this
     */
    public function params(array $params)
    {
        $this->params = $params;

        return $this;
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
        if (is_null($this->params))
        {
            $this->params([]);
        }

        $this->params[$name] = $value;

        return $this;
    }

    /**
     * Render the widget.
     *
     * @return string
     */
    public function render()
    {
        $widget = $this->buildWidget();

        if (! is_null($this->tagName))
        {
            $widget = $widget->withTagName($this->tagName);
        }

        if (! is_null($this->params))
        {
            $widget = $widget->withParams($this->params);
        }

        return $widget->render();
    }

    /**
     * Build the widget.
     *
     * @return \FluentForm\Contract\Renderable
     */
    public function buildWidget()
    {
        switch ($this->type) {
        case 'inline':
            return new InlineWidget();
        case 'block':
            return new BlockWidget();
        }

        throw new InvalidArgumentException('Invalid widget type.');
    }
    
    /**
     * Make a builder instance.
     *
     * @return \FluentForm\Builder
     */
    public static function make()
    {
        return new static();
    }

}
