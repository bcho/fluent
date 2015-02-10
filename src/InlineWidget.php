<?php namespace Flamingo\Fluent;

class InlineWidget extends BaseWidget {

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $tagName = $this->getTagName();
        $params = $this->getParams();

        return "<{$tagName} {$params}/>";
    }

}
