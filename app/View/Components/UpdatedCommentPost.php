<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UpdatedCommentPost extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $params){
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.updated-comment-post');
    }
}
