<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Components\FlashMessages;
use Jenssegers\Agent\Agent;

class AppServiceProvider extends ServiceProvider
{
    use FlashMessages;
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
     *
     * @return void
     */
    public function boot()
    {
        $agent = new Agent();
        if ($agent->isMobile()){
            $isDerive = 'mb';
        }else{
            $isDerive = 'pc';
        }

        //
        Schema::defaultStringLength(191);

        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        view()->share('_isDerive', $isDerive);
        view()->composer(
            ['frontend.*'],
            function ($view) {
                $view->with('generalsetting', Setting::first());
                $view->with('brands', Brand::where('status',1)->limit(10)->get(['id','title','slug']));
                $view->with('bannerTop', Banner::where('status',1)->where('type_show', 4)->first(['id','title', 'link', 'image']));

//                $view->with('menuList', ArticleCategory::tree());
                $view->with('menuProdList', Category::tree());
            }
        );

        view()->composer('frontend.partials.messages', function ($view) {
            $messages = self::messages();
            return $view->with('messages', $messages);
        });


    }
}
