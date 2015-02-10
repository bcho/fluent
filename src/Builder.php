<?php namespace Flamingo\Fluent;

use InvalidArgumentException;

use Flamingo\Fluent\Contract\Renderable;

class Builder implements Renderable {

    /**
     * Widget instance.
     *
     * @var \Flamingo\Fluent\Contract\Renderable
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
     * Widget tag name.
     *
     * @var string|null
     */
    protected $tagName = null;

    /**
     * Widget parameters.
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
        $widget = $this->makeWidget();

        return $widget->render();
    }

    /**
     * Make a widget.
     *
     * @return \Flamingo\Fluent\Contract\Renderable
     */
    public function makeWidget()
    {
        switch ($this->type) {
        case 'inline':
            $widget = new InlineWidget();
            break;
        case 'block':
            $widget = new BlockWidget();
            break;
        default:
            throw new InvalidArgumentException('Invalid widget type.');
        }

        if (! is_null($this->tagName))
        {
            $widget = $widget->tag($this->tagName);
        }

        if (! is_null($this->params))
        {
            $widget = $widget->params($this->params);
        }

        return $widget;
    }
    
    /**
     * Create a builder instance.
     *
     * @return \Flamingo\Fluent\Builder
     */
    public static function create()
    {
        return new static();
    }

}
