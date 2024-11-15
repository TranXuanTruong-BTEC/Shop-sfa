<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminLayout extends Component
{
    public $title;
    public $action;
    public $actionUrl;
    public $actionIcon;
    public $hasSearch;
    public $searchPlaceholder;

    public function __construct(
        $title = '',
        $action = '',
        $actionUrl = '',
        $actionIcon = '',
        $hasSearch = false,
        $searchPlaceholder = 'Tìm kiếm...'
    ) {
        $this->title = $title;
        $this->action = $action;
        $this->actionUrl = $actionUrl;
        $this->actionIcon = $actionIcon;
        $this->hasSearch = $hasSearch;
        $this->searchPlaceholder = $searchPlaceholder;
    }

    public function render()
    {
        return view('components.admin-layout');
    }
}