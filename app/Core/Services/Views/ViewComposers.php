<?php

namespace App\Core\Services\Views;

use App\Models\Category;
use App\Models\Contactus;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class ViewComposers
{

    public function getMenuItems(View $view)
    {
        $category = new Category;

        $menuItems = $category->menus()->with('pages')->orderBy('created_at', 'asc')->get();

        $contactusInfo = $this->contactusInfo();

        return $view->with(compact('menuItems', 'contactusInfo'));
    }

    public function getContactusInfo(View $view)
    {
        $contactusInfo = $this->contactusInfo();

        return $view->with(compact('contactusInfo'));
    }

    public function getCountriesList(View $view) {

        $countries = config('app.countriesList');

        return $view->with(compact('countries'));
    }


    public function getBreadCrumbs(View $view)
    {
        $link = '';

        $arrayFilter = ['index', 'create', 'update', 'store', 'destroy', 'delete', 'meta', 'attribute', 'edit'];

        $name = Route::currentRouteName();

        $routes = explode('.', $name);

        $routes = array_filter($routes, function ($item) use ($arrayFilter) {

            if (!in_array($item, $arrayFilter, true)) {

                return $item;

            }

        });

        $view->with('breadCrumbs', $routes);
    }

    public function contactusInfo()
    {

        if (!Cache::has('contactusInfo')) {

            $contactusInfo = Contactus::first();

            Cache::forever('contactusInfo', $contactusInfo);
        }

        return Cache::get('contactusInfo');
    }

    public function removeCache(View $view)
    {
        Cache::flush();

        return $view;
    }
}

