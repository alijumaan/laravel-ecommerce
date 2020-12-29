
<header class="ptb-50">
    <div class="header-bottom wrapper-padding-2 res-header-sm sticker header-sticky-3 furits-header">
        <div class="container-fluid">

            <div class="header-bottom-wrapper ">
                <div class="logo-2 ptb-35 menu-hover">
                    <a href="{{route('home')}}">
                        <img style="width: 150px" src="{{asset('assets/img/logo/logo.png')}}" alt="">
                    </a>
                </div>
                <div class="menu-style-2 handicraft-menu menu-hover">
                    <nav>
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
			    <li><a href="{{route('frontend.products.index')}}">All Products</a></li>
                                <ul class="single-dropdown">
                                    <li><a href="{{route('contact.index')}}">Contact us</a></li>
                                    @guest
                                    <li><a href="{{route('frontend.login')}}">Login</a></li>
                                    @if (route('frontend.register.form'))
                                    <li><a href="{{route('frontend.register.form')}}">Register</a></li>
                                    @endif
                                    @endguest
                                    <li><a href="{{route('cart.index')}}">Cart page</a></li>
                                </ul>
                            <li><a href="javascript:void(0);">Categories</a>
                                <ul class="single-dropdown">
                                    @foreach($global_categories as $global_category)
                                        <li><a href="{{ route('category.product', $global_category->slug) }}">{{ $global_category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="{{route('contact.index')}}">Contact</a></li>

                        </ul>
                    </nav>
                </div>
                <div class="furits-login-cart">
                    <div class="furits-login menu-hover">
                        <ul>
                            @guest
                                <li>
                                    <a href="{{route('frontend.login')}}">Login</a>
                                </li>
                                <li>
                                    <a href="{{route('frontend.register.form')}}">Reg</a>
                                </li>
                            @else
                                @if(auth()->user()->isAdmin())
                                    <li ><a href="{{ route('admin.index') }}" style="color: #578a01;">Administration</a>
                                @endif
                                <li><a href="javascript:void(0);" style="color: #578a01;">My Account</a>
                                    <ul class="single-dropdown" >
                                        <li ><a href="{{ route('dashboard') }}" style="color: #578a01;">Dashboard</a></li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('frontend.logout') }}"
                                               onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" style="color: #578a01;">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>




{{--                                <span class="header-cart-4 furits-cart bell">--}}
{{--                                    <a href="">--}}
{{--                                        <span class="handicraft-count">*</span>--}}
{{--                                        <i class="far fa-bell fa-2x"></i>--}}
{{--                                        <ul class="cart-dropdown">--}}
{{--                                        <li class="single-product-cart" style="display: inline;">--}}
{{--                                            <div class="cart-img">--}}
{{--                                                <a href="#"><img style="width: 100px;" src="{{ asset('uploads/products/default_small.png') }}" alt=""></a>--}}
{{--                                                <p class="ml-3" style="display: inline;"><a href="#" > Bits Headphone</a></p>--}}
{{--                                                <span>$80.00 x 1</span>--}}
{{--                                                <span class="cart-delete mt-3" style="float: right;">--}}
{{--                                                <a href="#"><i class="far fa-trash-alt"></i></a>--}}
{{--                                                </span>--}}
{{--                                             </div>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                    </a>--}}
{{--                                </span>--}}

                            @endguest

                        </ul>

                    </div>
                    <div class="header-cart-4 furits-cart">
                        <a class="icon-cart" href="{{route('cart.index')}}">
                            @auth
                                <span class="handicraft-count">
                                    {{Cart::session(auth()->id())->getContent()->count()}}</span>
                                    <i class="fas fa-shopping-cart fa-3x"></i>
                            @else
                                <span class="handicraft-count">0</span>
                                <i class="fas fa-shopping-cart fa-3x"></i>
                            @endauth
                        </a>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="menu-overflow">
                                <li><a href="{{route('home')}}">HOME</a></li>
				                <li><a href="{{route('frontend.products.index')}}">ALL PRODUCTS</a></li>
                                <li><a href="#">Categories</a>
                                    <ul>
                                        <li>
                                        @foreach($global_categories as $global_category)
                                            <a href="{{ route('category.product', $global_category->slug) }}">{{ $global_category->name }}</a>
                                        @endforeach
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{route('contact.index')}}">contact</a></li>
                                @guest
                                    <li>
                                        <a href="{{route('frontend.login')}}">Login</a>
                                    </li>
                                    <li>
                                        <a href="{{route('frontend.register.form')}}">Reg</a>
                                    </li>
                                @else
                                    @if(auth()->user()->isAdmin())
                                        <li ><a href="{{ route('admin.index') }}">Administration</a>
                                    @endif
                                    <li ><a href="{{ route('dashboard') }}" >Dashboard</a></li>

                                    <li>
                                        <a class="dropdown-item" href="{{ route('frontend.logout') }}"
                                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                @endguest
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="breadcrumb-area pt-50" >


        <div class="container-fluid">
            <div class="furniture-bottom-wrapper">
                <div class="furniture-login">

                </div>
                <div class="furniture-search">
                    {!! Form::open(['route' => 'search', 'method' => 'get']) !!}
                        <div class="form-input">
                            {!! Form::text('keyword', old('keyword', request()->keyword), ['placeholder' => 'I am Searching for . . .']) !!}
                            {!! Form::button('<i class="fas fa-search"></i>', ['type' => 'submit']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="furniture-wishlist">

                </div>
            </div>
        </div>

</div>
