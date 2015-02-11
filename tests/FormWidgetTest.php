<?php

use Flamingo\Fluent\FormWidget;
use Flamingo\Fluent\InlineWidget;

class FormWidgetTest extends PHPUnit_Framework_TestCase {

    public function testAdd()
    {
        $sub = new InlineWidget();
        $sub->tag('input');

        $form = new FormWidget();
        $form->add('<input type="text" />');
        $this->assertEquals(
            '<form><input type="text" /></form>',
            $form->render()
        );

        $form = new FormWidget();
        $form->add($sub);
        $this->assertEquals(
            '<form><input /></form>',
            $form->render()
        );

        $form = new FormWidget();
        $form->add('this-should-not-have-name-in-output', $sub);
        $this->assertEquals(
            '<form><input /></form>',
            $form->render()
        );

        $form = new FormWidget();
        $form->add('test-name', 'text');
        $this->assertEquals(
            '<form><input name="test-name" type="text" /></form>',
            $form->render()
        );
    }

    public function testAction()
    {
        $form = new FormWidget();
        $form->action('/');
        $this->assertEquals(
            '<form action="/" method="POST"></form>',
            $form->render()
        );
        
        $form = new FormWidget();
        $form->action('/', 'GET');
        $this->assertEquals(
            '<form action="/" method="GET"></form>',
            $form->render()
        );
    }

    public function testRenderWithResource()
    {
        $res = [
            'text1' => 'test1',
            'text2' => 'test2'
        ];
        $form = new FormWidget($res);
        $form->add('text1', 'text');
        
        $this->assertEquals(
            '<form><input name="text1" type="text" value="test1" /></form>',
            $form->render()
        );

        $form->add('text2', 'textarea');
        $this->assertEquals(
            '<form><input name="text1" type="text" value="test1" /><textarea name="text2">test2</textarea></form>',
            $form->render()
        );
    }

}
