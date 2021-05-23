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
            "path"=>"product"  
        ],
        [
            "name"=>"Categories",
            "path"=>"category"  
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
