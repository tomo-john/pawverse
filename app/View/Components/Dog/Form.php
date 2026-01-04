<?php

namespace App\View\Components\Dog;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $dog;
    public $colors;
    public $sizes;
    public $action;
    public $method;
    public $submitText;

    public function __construct(
        $dog,
        $colors,
        $sizes,
        $action,
        $method = 'POST',
        $submitText = '保存'
    ) {
        $this->dog = $dog;
        $this->colors = $colors;
        $this->sizes = $sizes;
        $this->action = $action;
        $this->method = $method;
        $this->submitText = $submitText;
      }

    public function render(): View|Closure|string
    {
        return view('components.dog.form');
    }
}
