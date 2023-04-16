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

function setStatus($statusCode)
{
    $statusMap = [
        0 => '<span class="badge py-3 px-4 fs-7 badge-light-primary">Diajukan</span>',
        1 => '<span class="badge py-3 px-4 fs-7 badge-light-warning">Diproses</span>',
        2 => '<span class="badge py-3 px-4 fs-7 badge-light-danger">Ditolak</span>',
        3 => '<span class="badge py-3 px-4 fs-7 badge-light-success">Selesai</span>'
    ];

    return $statusMap[$statusCode] ?? '';
}
