<?php

namespace App\View\Components;

use App\Models\Identitas;
use App\Models\Menu;
use Illuminate\View\Component;
use Illuminate\View\View;

class ApLayout extends Component
{
  /**
   * Get the view / contents that represents the component.
   */
  public function render(): View
  {
    $identitas = Identitas::first();
    $menus = Menu::query()
      ->with('items', function ($query) {
        return $query->where('status', true)->orderBy('index');
      })
      ->where('status', true)
      ->orderBy('index')
      ->get();

    return view('layouts.ap', compact('menus', 'identitas'));
  }
}
