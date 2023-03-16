<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *   /**
     * Paginate a standard Laravel Collection.
     *
     * @param int $perPage
     * @param int $total
     * @param int $page
     * @param string $pageName
     * @return array
     */
    public function boot()
    {
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        date_default_timezone_set('Asia/Kathmandu');

        //pass top product to store view
        view()->composer(['home.store'], function ($view) {
            $view->with('topProd', Product::getTopProducts());
        });

        //pass root category  to multiple view
        view()->composer(['home.store', 'dashboard.category.create', 'dashboard.category.edit', 'dashboard.product.create', 'dashboard.product.edit'], function ($view) {
            $view->with('rootCategories', Category::getRootCategories());
        });
    }
}