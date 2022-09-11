
<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href="{{route('admin.dashboard')}}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title"
                        data-i18n="nav.add_on_drag_drop.main">{{__('admin/sidebar.Main')}} </span></a>
            </li>
            {{--Start language--}}
                    <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><i class="la la-home"></i>
                            {{--Start Current Langue--}}
                            <span class="mr-1">
                                <span
                                    class="user-name text-bold-700"> {{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                            </span>
                            {{--End Current Langue--}}
                        </a>
                        {{--Start Show All Languages--}}
                        <div class="dropdown-menu dropdown-menu-right">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                {{--Show All Languages--}}
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                                {{--<div class="dropdown-divider"></div>--}}
                            @endforeach
                        </div>
                        {{--End Show All Languages--}}
            {{--End language--}}


            {{--Start Main Categories--}}
            @can('categories')
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/index.Categories')}} </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Category::count()}} </span>
                </a>

                <ul class="menu-content">
                    {{--Main Category --}}
                    <li class="active"><a class="menu-item" href="{{route('admin.maincategories')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/index.Show All')}} </a>
                    </li>
                    {{-- Start Add Main Category--}}
                    <li class="active"><a class="menu-item" href="{{route('admin.maincategories.create')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/index.Add Category')}} </a>
                    </li>
                    {{-- End Add Main Category --}}
                </ul>
            </li>
            @endcan
            {{--End Main Categories--}}



            {{--Start Brands--}}
            @can('brands')
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.Brands')}} </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Brand::count()}}</span>
                </a>
                <ul class="menu-content">
                    {{--Brands--}}
                    <li class="active"><a class="menu-item" href="{{route('view-brands')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/index.Show All')}} </a>
                    </li>
                    {{--Start Add Brands--}}
                        <li class="active">
                            <a class="menu-item" data-i18n="nav.dash.ecommerce" href="{{route('add-brand')}}">
                                {{__('admin/sidebar.Add Brands')}}
                            </a>
                        </li>
                    {{--End Add Brands--}}

                </ul>
            </li>
            @endcan
            {{--End Brands--}}

            {{--Start Tags--}}
            @can('tags')
            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/sidebar.Tags')}}  </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Tag::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.tags')}}"
                                          data-i18n="nav.dash.ecommerce">{{__('admin/index.Show All')}} </a>
                    </li>
                    <li class="active">
                            <a class="menu-item" data-i18n="nav.dash.ecommerce" href="{{route('admin.tags.create')}}">
                                {{__('admin/sidebar.Add Tags')}}
                            </a>
                        </li>
                </ul>
            </li>
            @endcan
            {{--End Tags--}}

            {{--Start Product--}}
            @can('products')
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">{{__('admin/index.Products') }} </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">
                        {{\App\Models\Product::count()}}</span>
                </a>
                <ul class="menu-content">
                    {{--Products--}}
                    <li class="active"><a class="menu-item" href="{{route('admin.products')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/index.Show All')}} </a>
                    </li>
                    {{--Start Add Products--}}
                        <li class="active">
                            <a class="menu-item" data-i18n="nav.dash.ecommerce" href="{{route('admin.products.general.create')}}">
                                {{__('admin/sidebar.Add Product')}}
                            </a>
                        </li>
                    {{--End Add Products--}}
                </ul>
            </li>
            @endcan
            {{--End Products--}}


            {{--Start Attributes--}}
            @can('attributes')
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> {{__('admin/sidebar.Products Attributes')}} </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{\App\Models\Attribute::count()}} </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.attributes')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/index.Show All')}} </a>
                    </li>
                    <li class="active"><a class="menu-item" href="{{route('admin.attributes.create')}}" data-i18n="nav.dash.crypto">
                            {{__('admin/sidebar.Add Attribute')}}</a>
                    </li>
                </ul>
            </li>
            @endcan
            {{--End Attributes--}}


            {{--Start Attribute Options--}}
            @can('options')
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> {{__('admin/sidebar.Attribute Options')}} </span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{\App\Models\Option::count()}} </span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.options')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/index.Show All')}} </a>
                    </li>
                    <li class="active"><a class="menu-item" href="{{route('admin.options.create')}}" data-i18n="nav.dash.crypto">
                            {{__('admin/sidebar.Add Option')}}</a>
                    </li>
                </ul>
            </li>
            @endcan
            {{--End Attribute Options--}}


            {{--Start permissions--}}
            @can('roles')
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> {{__('admin/sidebar.permissions')}} </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Role::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.roles.index')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/index.Show All')}} </a>
                    </li>
                    <li class="active"><a class="menu-item" href="{{route('admin.roles.create')}}" data-i18n="nav.dash.crypto">
                            {{__('admin/sidebar.Add permissions')}}</a>
                    </li>
                </ul>
            </li>
            @endcan
            {{--End permissions--}}


            {{--Start Control Panel Users--}}
            @can('users')
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> {{__('admin/sidebar.Control Panel Users')}} </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\User::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.users.index')}}"
                                          data-i18n="nav.dash.ecommerce"> {{__('admin/index.Show All')}} </a>
                    </li>
                    <li class="active"><a class="menu-item" href="{{route('admin.users.create')}}" data-i18n="nav.dash.crypto">
                            {{__('admin/sidebar.Add Users')}} </a>
                    </li>
                </ul>
            </li>
            @endcan
            {{--End Control Panel Users--}}



            {{--Start Settings--}}
            @can('setings')
            <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title"
                                                                                    data-i18n="nav.templates.main">{{__('admin/sidebar.Settings')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.templates.vert.main">{{__('admin/sidebar.Shipping Methods')}}</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('edit.shippings.methods','free')}}"
                                   data-i18n="nav.templates.vert.classic_menu">{{__('admin/sidebar.Free Shipping')}}</a>
                            <li><a class="menu-item" href="{{route('edit.shippings.methods','inner')}}"
                                   data-i18n="nav.templates.vert.compact_menu">{{__('admin/sidebar.Local Shipping')}}</a>
                            </li>
                            <li><a class="menu-item" href="{{route('edit.shippings.methods','outer')}}"
                                   data-i18n="nav.templates.vert.content_menu">{{__('admin/sidebar.Outer Shipping')}}</a>
                            </li>
                        </ul>
                    </li>
                    {{--Start Slider--}}
                    <li><a class="menu-item" href="#"
                           data-i18n="nav.templates.vert.main"> {{__('admin/sidebar.Main Slider')}} </a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="{{route('admin.sliders.create')}}"
                                   data-i18n="nav.templates.vert.classic_menu"> {{__('admin/sidebar.Slider Images')}} </a>
                            </li>
                        </ul>
                    </li>
                    {{--End Slider--}}
                </ul>
            </li>
            @endcan
            {{--End Settings--}}
        </ul>
    </div>
</div>
