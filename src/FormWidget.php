<?php namespace Flamingo\Fluent;

use Flamingo\Fluent\Builder;
use Flamingo\Fluent\BlockWidget;
use Flamingo\Fluent\Contract\Renderable;

class FormWidget extends BlockWidget {

    /**
     * {@inheritdoc}
     */
    protected $tagName = 'form';

    /**
     * Binded resource instance.
     *
     * @var \ArrayAccess|null
     */
    protected $resource;

    /**
     * Well known form widgets.
     *
     * @var array
     */
    protected $knownWidgets = [
        'text' => [
            'tag'  => 'input',
            'type' => 'inline'
        ],
        'password' => [
            'tag'  => 'input',
            'type' => 'inline'
        ],
        'textarea' => [
            'tag'  => 'textarea',
            'type' => 'block'
        ]
    ];

    public function __construct($resource = null)
    {
        if (! is_null($resource))
        {
            $this->resource($resource);
        }
    }

    /**
     * Bind resource instance.
     *
     * @param  \ArrayAccess|array $resource
     * @return $this
     */
    public function resource($resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Set form action.
     *
     * @param  string $action
     * @param  string $method defaults to ``POST``
     * @return $this
     */
    public function action($action, $method = 'POST')
    {
        return $this
            ->param('action', $action)
            ->param('method', $method);
    }

    /**
     * Add form widget.
     *
     * You can add a sub widget with input name & widget type:
     *
     *      $form->add('name', 'textarea');
     *
     * @param  mixed $subWidgetOrName
     * @param  mixed $subWidgetName
     * @return $this
     */
    public function add($subWidgetOrName, $subWidget = null)
    {
        if (is_null($subWidget) || $subWidgetOrName instanceof Renderable)
        {
            return parent::add($subWidgetOrName);
        }

        $name = $subWidgetOrName;
        $this->subWidgets[$name] = $this->buildSubWidget($name, $subWidget);

        return $this;
    }

    /**
     * Bind values and render the form.
     *
     * @return string
     */
    public function render()
    {
        $this->bindResource($this->resource);
        return parent::render();
    }

    /**
     * Build a sub widget (renderable) from input.
     *
     * If the ``$subWidget`` is a well known form widget name,
     * it will build the widget, otherwise simply return the widget.
     *
     * @param  string $name
     * @param  mixed $subWidget
     * @return mixed
     */
    protected function buildSubWidget($name, $subWidgetName)
    {
        if (! in_array($subWidgetName, array_keys($this->knownWidgets)))
        {
            return $subWidgetName;
        }

        $configs = $this->knownWidgets[$subWidgetName];

        $widget = Builder::create()
            ->tag($configs['tag']);
        $params = [
            'name' => $name
        ];
        if ($configs['type'] === 'inline')
        {
            $params['type'] = $subWidgetName;
            $widget->inline();
        }
        else
        {
            $widget->block();
        }
        $widget->params($params);

        return $widget;
    }

    /**
     * Bind resource's value to form.
     *
     * @return $this
     */
    protected function bindResource()
    {
        if (is_null($this->resource))
        {
            return $this;
        }

        foreach ($this->subWidgets as $name => $widget)
        {
            if (! is_string($name))
            {
                continue;
            }
            if ((! $widget instanceof Renderable)
                && (! $widget instanceof Builder))
            {
                continue;
            }

            $widget->value($this->resource[$name]);
        }

        return $this;
    }

}
