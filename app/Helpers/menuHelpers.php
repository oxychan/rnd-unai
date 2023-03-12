<?php

use App\Models\Menu;

function getMenus()
{
    return Menu::with('subMenus')->whereNull('root')->get();
}

function isParentExpanded($parentUrl)
{
    if (getFirstUrl(explode('/', url()->current(), 4)[3]) == getFirstUrl(explode('/', url($parentUrl), 4)[3])) {
        return true;
    }

    return false;
}

function getFirstUrl($url)
{
    return explode('/', $url)[0];
}

function getBreadCrumb()
{
    $urlExploded = explode('/', explode('/', url()->current(), 4)[3]);
    return $urlExploded;
}
