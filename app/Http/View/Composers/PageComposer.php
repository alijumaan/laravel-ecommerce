<?php
namespace App\Http\View\Composers;

use App\Models\Page;
use Illuminate\View\View;

class PageComposer
{
    protected $pages;

    public function __construct(Page $pages)
    {
        $this->pages = $pages;
    }

    public function compose(View $view)
    {
        return $view->with('pages', $this->pages->all());
    }
}
