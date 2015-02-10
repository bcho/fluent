# Fluent [WIP]

Building HTML fluently.


## Usage

### Render from builder:

```php
<?php

use Flamingo\Fluent\Builder;

$form = Builder::create()
    ->tag('form')
    ->param('action', '/back/to/the/future')
    ->param('method', 'POST');

echo $form->render();
```

Should output:

```html
<form action="/back/to/the/future" method="POST"></form>
```


### Render from widget:

```php
<?php

use \Flamingo\Fluent\BlockWidget;
use \Flamingo\Fluent\InlineWidget;

class FormWidget extends BlockWidget {

    protected $tagName = 'form';

}

class TextInputWidget extends InlineWidget {

    protected $tagName = 'input';

    protected $params = ['type' => 'text']; 

}


$article = (new FormWidget())
    ->add(new TextInputWidget());

echo $article->render();
```

Should output:

```html
<form><input type="text" /></form>
```


## TODO

- [ ] more widgets


## License

[LICENSE](LICENSE)
