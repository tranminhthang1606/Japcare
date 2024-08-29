<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            'App\Repositories\Admin\AdminRepositoryInterface',
            'App\Repositories\Admin\AdminRepository'
        );

        $this->app->bind(
            'App\Repositories\ArticlesCate\ArticlesCateRepositoryInterface',
            'App\Repositories\ArticlesCate\ArticlesCateRepository'
        );

        $this->app->bind(
            'App\Repositories\Articles\ArticlesRepositoryInterface',
            'App\Repositories\Articles\ArticlesRepository'
        );

        $this->app->bind(
            'App\Repositories\Banner\BannerRepositoryInterface',
            'App\Repositories\Banner\BannerRepository'
        );

        $this->app->bind(
            'App\Repositories\BoughtProduct\BoughtProductRepositoryInterface',
            'App\Repositories\BoughtProduct\BoughtProductRepository'
        );

        $this->app->bind(
            'App\Repositories\Brand\BrandRepositoryInterface',
            'App\Repositories\Brand\BrandRepository'
        );

        $this->app->bind(
            'App\Repositories\Category\CategoryRepositoryInterface',
            'App\Repositories\Category\CategoryRepository'
        );

        $this->app->bind(
            'App\Repositories\Contact\ContactRepositoryInterface',
            'App\Repositories\Contact\ContactRepository'
        );

        $this->app->bind(
            'App\Repositories\Customer\CustomerRepositoryInterface',
            'App\Repositories\Customer\CustomerRepository'
        );

        $this->app->bind(
            'App\Repositories\CustomersAddress\CustomersAddressRepositoryInterface',
            'App\Repositories\CustomersAddress\CustomersAddressRepository'
        );

        $this->app->bind(
            'App\Repositories\DeliveryFee\DeliveryFeeRepositoryInterface',
            'App\Repositories\DeliveryFee\DeliveryFeeRepository'
        );

        $this->app->bind(
            'App\Repositories\District\DistrictRepositoryInterface',
            'App\Repositories\District\DistrictRepository'
        );

        $this->app->bind(
            'App\Repositories\Feedback\FeedbackRepositoryInterface',
            'App\Repositories\Feedback\FeedbackRepository'
        );

        $this->app->bind(
            'App\Repositories\Ingredient\IngredientRepositoryInterface',
            'App\Repositories\Ingredient\IngredientRepository'
        );

        $this->app->bind(
            'App\Repositories\Order\OrderRepositoryInterface',
            'App\Repositories\Order\OrderRepository'
        );

        $this->app->bind(
            'App\Repositories\OrderDetail\OrderDetailRepositoryInterface',
            'App\Repositories\OrderDetail\OrderDetailRepository'
        );

        $this->app->bind(
            'App\Repositories\Policy\PolicyRepositoryInterface',
            'App\Repositories\Policy\PolicyRepository'
        );

        $this->app->bind(
            'App\Repositories\Popup\PopupRepositoryInterface',
            'App\Repositories\Popup\PopupRepository'
        );

        $this->app->bind(
            'App\Repositories\Product\ProductRepositoryInterface',
            'App\Repositories\Product\ProductRepository'
        );

        $this->app->bind(
            'App\Repositories\ProductSize\ProductSizeRepositoryInterface',
            'App\Repositories\ProductSize\ProductSizeRepository'
        );

        $this->app->bind(
            'App\Repositories\ProductUses\ProductUsesRepositoryInterface',
            'App\Repositories\ProductUses\ProductUsesRepository'
        );

        $this->app->bind(
            'App\Repositories\Province\ProvinceRepositoryInterface',
            'App\Repositories\Province\ProvinceRepository'
        );

        $this->app->bind(
            'App\Repositories\Review\ReviewRepositoryInterface',
            'App\Repositories\Review\ReviewRepository'
        );

        $this->app->bind(
            'App\Repositories\Setting\SettingRepositoryInterface',
            'App\Repositories\Setting\SettingRepository'
        );

        $this->app->bind(
            'App\Repositories\Slider\SliderRepositoryInterface',
            'App\Repositories\Slider\SliderRepository'
        );

        $this->app->bind(
            'App\Repositories\User\UserRepositoryInterface',
            'App\Repositories\User\UserRepository'
        );

        $this->app->bind(
            'App\Repositories\Uses\UsesRepositoryInterface',
            'App\Repositories\Uses\UsesRepository'
        );

        $this->app->bind(
            'App\Repositories\ViewedProduct\ViewedProductRepositoryInterface',
            'App\Repositories\ViewedProduct\ViewedProductRepository'
        );

        $this->app->bind(
            'App\Repositories\Ward\WardRepositoryInterface',
            'App\Repositories\Ward\WardRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
