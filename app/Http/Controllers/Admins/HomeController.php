<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\Articles\ArticlesRepositoryInterface;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Services\AdminService;
use Carbon\Carbon;

class HomeController extends Controller
{
    protected $adminRepository;
    protected $productRepository;
    protected $orderRepository;
    protected $newsRepository;
    protected $customerRepository;
    protected $adminService;
    public function __construct(
        AdminRepositoryInterface $adminRepository,
        ArticlesRepositoryInterface $newsRepository,
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,
        CustomerRepositoryInterface $customerRepository,
        AdminService $adminService
    ) {
        $this->adminRepository = $adminRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->newsRepository = $newsRepository;
        $this->customerRepository = $customerRepository;
        $this->adminService = $adminService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $dataShow = [
            'total_customer' => 0,
            'total_news' => 0,
            'total_product' => 0,
            'total_order' => 0
        ];

        $dataShow = $this->adminService->handleDataShow($dataShow);
        // count customer
       

        return view('admins.home', ['data' => $dataShow]);
    }
}
