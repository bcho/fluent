<?php namespace Flamingo\Fluent;

class InlineWidget extends BaseWidget {

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $tagName = $this->getTagName();
        $params = $this->getParams();

        if ($params)
        {
            return "<{$tagName} {$params} />";
        }

        return "<{$tagName} />";
    }

    /**
     * {@inheritdoc}
     */
    public function value($value)
    {
        $this->param('value', $value);

        return $this;
    }

}
