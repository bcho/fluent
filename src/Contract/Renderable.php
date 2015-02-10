<?php namespace Flamingo\Fluent\Contract;

use Illuminate\Contracts\Support\Renderable as IlluminateRenderable;

interface Renderable extends IlluminateRenderable {

    /**
     * Get the rendered content of the object.
     *
     * @return string
     */
    public function render();

}
