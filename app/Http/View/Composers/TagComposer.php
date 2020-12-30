<?php
namespace App\Http\View\Composers;

use App\Models\Tag;
use Illuminate\View\View;

class TagComposer
{
    public $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function compose(View $view)
    {
        return $view->with('tags', $this->tag->orderBy('id', 'desc')->pluck('name', 'id'));
    }
}
