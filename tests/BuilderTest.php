<?php

use Flamingo\Fluent\Builder;
use Flamingo\Fluent\InlineWidget;
use Flamingo\Fluent\BlockWidget;

class BuilderTest extends PHPUnit_Framework_TestCase {

    public function testRender()
    {
        $w = Builder::create()
            ->tag('form')
            ->param('method', 'POST');

        $this->assertEquals(
            '<form method="POST"></form>',
            $w->render()
        );
    }

    public function testGetWidget()
    {
        $w1 = Builder::create()
            ->inline()
            ->tag('br')
            ->widget();

        $this->assertTrue($w1 instanceof InlineWidget);
        $this->assertEquals(
            (new InlineWidget())->tag('br')->render(),
            $w1->render()
        );
        
        $w2 = Builder::create()
            ->block()
            ->tag('div')
            ->widget();

        $this->assertTrue($w2 instanceof BlockWidget);
        $this->assertEquals(
            (new BlockWidget())->tag('div')->render(),
            $w2->render()
        );
    }
}
