<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Badge extends Component
{
    public $type;
    public $checkNewPost;

    /**
     * Create the component instance.
     *
     * @param  string  $type
     * @param  boolean  $checkNewPost
     * @return void
     */
    public function __construct($type, $checkNewPost)
    {
        $this->type = $type;
        $this->checkNewPost = $checkNewPost;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.badge');
    }
}
