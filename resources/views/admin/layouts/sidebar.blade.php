
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img style="width: 70px;" src="{{ asset('uploads/default_small.png') }}" alt="{{ config('app.name') }}">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }} <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-store"></i>
            <span>Products</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Products:</h6>
                <a class="collapse-item" href="{{route('admin.products.index')}}">All producs</a>
                <a class="collapse-item" href="{{route('admin.products.create')}}">Create new product</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Categories</span>
        </a>
        <div id="collapseCategories" class="collapse" aria-labelledby="headingCategories" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Categories:</h6>
                <a class="collapse-item" href="{{route('admin.product-categories.index')}}">All categories</a>
                <a class="collapse-item" href="{{route('admin.product-categories.create')}}">Create new category</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCoupons" aria-expanded="true" aria-controls="collapseCoupons">
            <i class="fas fa-gift"></i>
            <span>Coupons</span>
        </a>
        <div id="collapseCoupons" class="collapse" aria-labelledby="headingCoupons" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Coupons:</h6>
                <a class="collapse-item" href="{{route('admin.coupons.index')}}">Coupons</a>
                <a class="collapse-item" href="{{route('admin.coupons.create')}}">Create new coupon</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTags" aria-expanded="true" aria-controls="collapseTags">
            <i class="fas fa-tags"></i>
            <span>Tags</span>
        </a>
        <div id="collapseTags" class="collapse" aria-labelledby="headingCoupons" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Tags:</h6>
                <a class="collapse-item" href="{{route('admin.tags.index')}}">Tags</a>
                <a class="collapse-item" href="{{route('admin.tags.create')}}">Create new tags</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="true" aria-controls="collapseUsers">
            <i class="fas fa-user"></i>
            <span>Users</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Users:</h6>
                <a class="collapse-item" href="{{route('admin.users.index')}}">All users</a>
                <a class="collapse-item" href="{{route('admin.users.create')}}">Create new user</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.product-comments.index')}}">
            <i class="fas fa-comments"></i>
            <span>Comments</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.orders.index')}}">
            <i class="fas fa-truck"></i>
            <span>Orders</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.contacts.index')}}">
            <i class="far fa-envelope"></i>
            <span>Contact Us</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

{{--    <!-- Heading -->--}}
{{--    <div class="sidebar-heading">--}}
{{--        Addons--}}
{{--    </div>--}}

{{--    <!-- Nav Item - Pages Collapse Menu -->--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">--}}
{{--            <i class="fas fa-fw fa-folder"></i>--}}
{{--            <span>Pages</span>--}}
{{--        </a>--}}
{{--        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">--}}
{{--            <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                <h6 class="collapse-header">Login Screens:</h6>--}}
{{--                <a class="collapse-item" href="login.html">Login</a>--}}
{{--                <a class="collapse-item" href="register.html">Register</a>--}}
{{--                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>--}}
{{--                <div class="collapse-divider"></div>--}}
{{--                <h6 class="collapse-header">Other Pages:</h6>--}}
{{--                <a class="collapse-item" href="404.html">404 Page</a>--}}
{{--                <a class="collapse-item" href="blank.html">Blank Page</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </li>--}}

{{--    <!-- Nav Item - Charts -->--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="charts.html">--}}
{{--            <i class="fas fa-fw fa-chart-area"></i>--}}
{{--            <span>Charts</span></a>--}}
{{--    </li>--}}

{{--    <!-- Nav Item - Tables -->--}}
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link" href="tables.html">--}}
{{--            <i class="fas fa-fw fa-table"></i>--}}
{{--            <span>Tables</span></a>--}}
{{--    </li>--}}

    <!-- Divider -->
{{--    <hr class="sidebar-divider d-none d-md-block">--}}

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->












{{--
@php
    $current_page = Route::currentRouteName();
@endphp

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('uploads/default_small.png') }}" width="50" alt="{{ config('app.name') }}">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @role(['admin'])
    @foreach($admin_side_menu as $menu)
        @if (count($menu->appearedChildren) == 0)

            <li class="nav-item {{ $menu->id == getParentShowOf($current_page) ? 'active' : '' }}">
                <a href="{{ route('admin.'. $menu->as) }}" class="nav-link">
                    <i class="{{ $menu->icon != null ? $menu->icon : 'fa fa-home' }}"></i>
                    <span>{{ $menu->display_name }}</span></a>
            </li>
            <hr class="sidebar-divider">
        @else
            <li class="nav-item {{ in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'active' : '' }}">
                <a class="nav-link {{ in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'collapsed' : '' }}" href="#" data-toggle="collapse" data-target="#collapse_{{ $menu->route }}" aria-expanded="{{ $menu->parent_show == getParentOf($current_page) && getParentOf($current_page) != null ? 'false' : 'true' }}" aria-controls="collapse_{{ $menu->route }}">
                    <i class="{{ $menu->icon != null ? $menu->icon : 'fa fa-home' }}"></i>
                    <span>{{ $menu->display_name }}</span>
                </a>
                @if (isset($menu->appearedChildren) && count($menu->appearedChildren) > 0)
                    <div id="collapse_{{ $menu->route }}" class="collapse {{ in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'show' : '' }}"
                         aria-labelledby="heading_{{ $menu->route }}" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            @foreach($menu->appearedChildren as $sub_menu)
                                <a class="collapse-item {{ getParentOf($current_page) != null && (int)(getParentIdOf($current_page)+1) == $sub_menu->id ? 'active' : '' }}" href="{{ route('admin.' . $sub_menu->as) }}">{{ $sub_menu->display_name }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </li>
        @endif
    @endforeach
    @endrole

    @role(['editor'])
    @foreach($admin_side_menu as $menu)
        @permission($menu->name)
        @if (count($menu->appearedChildren) == 0)
            <li class="nav-item {{ $menu->id == getParentShowOf($current_page) ? 'active' : '' }}">
                <a href="{{ route('admin.'. $menu->as) }}" class="nav-link">
                    <i class="{{ $menu->icon != null ? $menu->icon : 'fa fa-home' }}"></i>
                    <span>{{ $menu->display_name }}</span></a>
            </li>
            <hr class="sidebar-divider">
        @else
            <li class="nav-item {{ in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'active' : '' }}">
                <a class="nav-link {{ in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'collapsed' : '' }}" href="#" data-toggle="collapse" data-target="#collapse_{{ $menu->route }}" aria-expanded="{{ $menu->parent_show == getParentOf($current_page) && getParentOf($current_page) != null ? 'false' : 'true' }}" aria-controls="collapse_{{ $menu->route }}">
                    <i class="{{ $menu->icon != null ? $menu->icon : 'fa fa-home' }}"></i>
                    <span>{{ $menu->display_name }}</span>
                </a>
                @if (isset($menu->appearedChildren) && count($menu->appearedChildren) > 0)
                    <div id="collapse_{{ $menu->route }}" class="collapse {{ in_array($menu->parent_show, [getParentShowOf($current_page), getParentOf($current_page)]) ? 'show' : '' }}"
                         aria-labelledby="heading_{{ $menu->route }}" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            @foreach($menu->appearedChildren as $sub_menu)
                                @permission($sub_menu)
                                <a class="collapse-item {{ getParentOf($current_page) != null && (int)(getParentIdOf($current_page)+1) == $sub_menu->id ? 'active' : '' }}" href="{{ route('admin.' . $sub_menu->as) }}">{{ $sub_menu->display_name }}</a>
                                @endpermission
                            @endforeach
                        </div>
                    </div>
                @endif
            </li>
        @endif
        @endpermission
    @endforeach
    @endrole



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar --> --}}

