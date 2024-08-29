<!-- ========== Left Sidebar Start ========== -->
@php
    $generalsetting = \App\Models\Setting::first();
    $rolePermiss = \App\Models\Role::findOrFail(Auth::user()->role_id)->permissions;
@endphp
<div class="left side-menu">
    <!-- LOGO -->
    <div class="topbar-left">
        <div>
            <a href="{{ route('admin.dashboard') }}" class="logo head_sidebar">
                @if($generalsetting->st_logo != null)
                    <img src="{{ asset($generalsetting->st_logo) }}" class="brand-icon"
                         alt="{{ $generalsetting->st_name_site }}" height="50px">
                @else
                    <div class="brand-title">
                        <span class="brand-text">{{ $generalsetting->st_name_site }}</span>
                    </div>
                @endif
            </a>
        </div>
    </div>
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="has_sub {{areActiveRoutesParentLi([
                        'categories.create', 'categories.edit', 'brands.create', 'brands.edit', 'products.create', 'products.edit',
                        'ingredients.create', 'ingredients.edit', 'product_uses.create', 'product_uses.edit'
                ])}}">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="mdi mdi-buffer"></i>
                        <span> Sản phẩm
                            <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                        </span>
                    </a>
                    <ul class="list-unstyled">
                        @if(in_array('1', json_decode($rolePermiss)))
                            <li class="{{areActiveRoutes(['categories.index', 'categories.create', 'categories.edit'])}}">
                                <a href="{{url('admin/categories')}}">Danh mục</a>
                            </li>
                            <li><a href="{{url('admin/categories-sort')}}">Sắp xếp danh mục</a></li>
                        @endif
                        @if(in_array('3', json_decode($rolePermiss)))
                            <li class="{{areActiveRoutes(['brands.index', 'brands.create', 'brands.edit'])}}">
                                <a href="{{url('admin/brands')}}">Thương hiệu</a>
                            </li>
                        @endif
                        @if(in_array('18', json_decode($rolePermiss)))
                            <li class="{{areActiveRoutes(['ingredients.index', 'ingredients.create', 'ingredients.edit'])}}">
                                <a href="{{ route('ingredients.index') }}">Quản lý thành phần</a>
                            </li>
                        @endif
                        @if(in_array('19', json_decode($rolePermiss)))
                            <li class="{{areActiveRoutes(['product_uses.index', 'product_uses.create', 'product_uses.edit'])}}">
                                <a href="{{url('admin/product_uses')}}">Quản lý công dụng</a>
                            </li>
                        @endif
                        @if(in_array('2', json_decode($rolePermiss)))
                            <li class="{{areActiveRoutes(['products.index', 'products.create', 'products.edit'])}}">
                                <a href="{{url('admin/products')}}" class="prod-index">Sản phẩm</a>
                            </li>
                        @endif
                    </ul>
                </li>
                @if(in_array('9', json_decode($rolePermiss)))
                    <li class="has_sub {{areActiveRoutesParentLi(['orders.show'])}}">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-buffer"></i>
                            <span> Đơn hàng
                                <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                            </span>
                        </a>
                        <ul class="list-unstyled">
                            <li class="{{areActiveRoutes(['orders.show'])}}"><a href="{{url('admin/orders')}}">Danh
                                    sách đơn hàng</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array('5', json_decode($rolePermiss)))
                    <li class="has_sub {{areActiveRoutesParentLi(['articles-categories.edit'])}}">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-tag-multiple"></i>
                            <span> Danh mục tin tức
                                <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                            </span>
                        </a>
                        <ul class="list-unstyled">
                            <li class="{{areActiveRoutes(['articles-categories.index', 'articles-categories.edit'])}}">
                                <a href="{{url('admin/articles-categories')}}">Danh sách</a></li>
                            <li><a href="{{url('admin/articles-categories/create')}}">Thêm danh mục</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array('6', json_decode($rolePermiss)))
                    <li class="has_sub {{areActiveRoutesParentLi(['admin.article.edit'])}}">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-newspaper"></i>
                            <span> Tin tức
                                <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                            </span>
                        </a>
                        <ul class="list-unstyled">
                            <li class="{{areActiveRoutes(['articles.index', 'admin.article.edit'])}}"><a
                                    href="{{url('admin/articles')}}">Danh sách bài viết</a></li>
                            <li><a href="{{url('admin/articles/create')}}">Thêm bài viết</a></li>
                        </ul>
                    </li>
                @endif

                @if(in_array('8', json_decode($rolePermiss)))
                    <li class="{{areActiveRoutes(['admin.customers.viewed_products', 'admin.customers.bought_products', 'admin.customers.orders'])}}">
                        <a href="{{ url('admin/customers') }}"
                           class="waves-effect {{areActiveRoutes(['admin.customers.viewed_products', 'admin.customers.bought_products', 'admin.customers.orders'])}}">
                            <i class="mdi mdi-account-multiple"></i>
                            <span>Khách hàng</span>
                        </a>
                    </li>
                @endif
                @if(in_array('16', json_decode($rolePermiss)))
                    <li class="has_sub {{areActiveRoutesParentLi(['delivery_fees.edit'])}}">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-truck"></i>
                            <span> Quản lý phí vận chuyển
                                    <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                                </span>
                        </a>
                        <ul class="list-unstyled">
                            <li class="{{areActiveRoutes(['delivery_fees.edit'])}}">
                                <a href="{{url('admin/delivery_fees')}}">Danh sách</a>
                            </li>
                            <li><a href="{{url('admin/delivery_fees/create')}}">Thêm phí vận chuyển</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array('7', json_decode($rolePermiss)))
                    <li>
                        <a href="{{route('admin.contacts.index')}}" class="waves-effect">
                            <i class="mdi mdi-email"></i>
                            <span>Liên hệ - Góp ý</span>
                        </a>
                    </li>
                @endif

                @if(in_array('10', json_decode($rolePermiss)))
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="fa fa-comments"></i>
                            <span> Popups
                                <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                            </span>
                        </a>
                        <ul class="list-unstyled">
                            <li class="{{areActiveRoutes(['popups.index', 'popups.edit'])}}"><a
                                    href="{{url('admin/popups')}}">Danh sách popups</a></li>
                            <li><a href="{{url('admin/popups/create')}}">Thêm popups</a></li>
                        </ul>
                    </li>
                @endif

                @if(in_array('11', json_decode($rolePermiss)))
                    <li class="has_sub {{areActiveRoutesParentLi(['sliders.edit'])}}">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class=" mdi mdi-burst-mode"></i>
                            <span> Sliders
                                <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                            </span>
                        </a>
                        <ul class="list-unstyled">
                            <li class="{{areActiveRoutes(['sliders.index', 'sliders.edit'])}}"><a
                                    href="{{url('admin/sliders')}}">Danh sách sliders</a></li>
                            <li><a href="{{url('admin/sliders/create')}}">Thêm slider</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array('12', json_decode($rolePermiss)))
                    <li class="has_sub {{areActiveRoutesParentLi(['banners.edit'])}}">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="fa fa-image"></i>
                            <span> Banner
                                <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                            </span>
                        </a>
                        <ul class="list-unstyled">
                            <li class="{{areActiveRoutes(['banners.index', 'banners.edit'])}}"><a
                                    href="{{url('admin/banners')}}">Danh sách banner</a></li>
                            <li><a href="{{url('admin/banners/create')}}">Thêm banner</a></li>
                        </ul>
                    </li>
                @endif
                @if(in_array('13', json_decode($rolePermiss)))
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class=" mdi mdi-book-open-page-variant"></i>
                            <span> Chính sách của Trang
                                <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                            </span>
                        </a>
                        <ul class="list-unstyled">
                            <li><a href="{{route('about_us.index', 'about_us')}}">Giới Thiệu</a></li>
                            <li><a href="{{route('purchase_pay.index', 'purchase_pay')}}">Chính mua hàng thanh toán</a>
                            </li>
                            <li><a href="{{route('delivery_policy.index', 'delivery_policy')}}">Chính sách giao hàng</a>
                            </li>
                            <li><a href="{{route('privacy_policy.index', 'privacy_policy')}}">Chính sách bảo mật</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(in_array('14', json_decode($rolePermiss)))
                    <li class="has_sub {{areActiveRoutesParentLi(['roles.create', 'roles.edit', 'admin.create', 'admin.edit'])}}">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-account-key"></i>
                            <span>Quản trị hệ thống
                                <span class="pull-right"><i class="mdi mdi-chevron-right"></i></span>
                            </span>
                        </a>
                        <ul class="list-unstyled">
                            <li class="{{areActiveRoutes(['admin.index', 'admin.create', 'admin.edit'])}}">
                                <a href="{{ url('admin/admin') }}">Tài khoản quản trị</a>
                            </li>
                            <li class="{{areActiveRoutes(['roles.index', 'roles.create', 'roles.edit'])}}">
                                <a href="{{ url('admin/roles') }}">Danh sách phân quyền</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(in_array('15', json_decode($rolePermiss)))
                    <li>
                        <a href="{{url('admin/settings')}}" class="waves-effect">
                            <i class="mdi mdi-settings-box"></i>
                            <span> Cài đặt hệ thống</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->
