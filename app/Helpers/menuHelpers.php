<?php

use App\Models\Menu;

function getMenus()
{
    return Menu::with('subMenus')->whereNull('root')->get();
}
