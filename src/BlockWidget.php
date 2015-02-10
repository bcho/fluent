<?php namespace Flamingo\Fluent;

use Flamingo\Fluent\Contract\Renderable;

/**
 * Block html widget.
 */
class BlockWidget extends BaseWidget {

    /**
     * {@inheritdoc}
     */
    protected $tagName = 'div';

    /**
     * Sub widgets.
     *
     * @var array
     */
    protected $subWidgets = [];

    /**
     * Add sub widget.
     *
     * @param  mixed $subWidget
     * @return $this
     */
    public function add($subWidget)
    {
        $this->subWidgets[] = $subWidget;

        return $this;
    }

    /**
     * Get rendered sub widgets.
     *
     * @return string
     */
    public function getSubWidgets()
    {
        return $this->buildSubWidgets($this->subWidgets);
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $tagName = $this->getTagName();
        $params = $this->getParams();
        $body = $this->getSubWidgets();

        return "<{$tagName} {$params}>{$body}</{$tagName}>";
    }

    /**
     * Concat sub widgets.
     *
     * @param  array
     * @return string
     */
    protected function buildSubWidgets(array $subWidgets)
    {
        return implode('', array_map(function($subWidget) {

            if ($subWidget instanceof Renderable)
            {
                return $subWidget->render();
            }

            return $subWidget;
        }, $subWidgets));
    }
}
