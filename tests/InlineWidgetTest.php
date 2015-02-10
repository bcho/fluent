<?php

use Flamingo\Fluent\InlineWidget;

class InlineWidgetTest extends PHPUnit_Framework_TestCase {

    public function testRender()
    {
        $w = (new InlineWidget())
            ->tag('input')
            ->param('name', 'test')
            ->param('type', 'text');

        $this->assertEquals(
            '<input name="test" type="text" />',
            $w->render()
        );
    }
}
