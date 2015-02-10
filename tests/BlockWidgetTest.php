<?php

use Flamingo\Fluent\BlockWidget;

class BlockWidgetTest extends PHPUnit_Framework_TestCase {

    public function testRender()
    {
        $w = (new BlockWidget())
            ->tag('section')
            ->param('class', 'test')
            ->param('id', 'test');

        $this->assertEquals(
            '<section class="test" id="test"></section>',
            $w->render()
        );
    }

    public function testRenderWithSubWidgets()
    {
        $sub = (new BlockWidget())
            ->tag('section');

        $w = (new BlockWidget())
            ->tag('article')
            ->add($sub)
            ->add($sub->render());

        $this->assertEquals(
            '<article><section></section><section></section></article>',
            $w->render()
        );
    }
}
