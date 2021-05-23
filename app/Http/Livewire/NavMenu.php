<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavMenu extends Component
{
    public $menus=[
        [
          "name"=>"Dashboard",
          "path"=>"dashboard"  
        ],
        [
            "name"=>"Orders",
            "path"=>"order"  
        ],
        [
            "name"=>"Products",
            "path"=>"products"  
        ],
        [
            "name"=>"Categories",
            "path"=>"categories"  
        ],
        [
            "name"=>"Activity",
            "path"=>"activity"  
        ],
        [
            "name"=>"Settings",
            "path"=>"setting"  
        ],
    ];
    public function render()
    {
        return view('livewire.nav-menu');
    }
}
