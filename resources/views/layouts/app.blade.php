<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <!-- begin::Head -->
  <head>
    <base href="">
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Mafia City RP - UCP') }}</title>
    <meta name="description" content="{{ config('app.description', 'Mafia City Roleplay GTA V user control panel') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('images/logos/favicon-mcrp.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/logos/favicon-mcrp.png') }}" />

    @yield('head')
  </head>

  <!-- end::Head -->
  <!-- begin::Body -->
  <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">
   <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
      <div class="kt-header-mobile__logo">
        <a href="{{ url('/') }}">
          <img alt="Logo" style="height: 65px;" src="{{ asset('images/logos/logo-mcrp-new.png') }}" />
        </a>
      </div>
      <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
      </div>
    </div>

    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
      <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
        <div class="kt-aside kt-aside--fixed kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
          <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
            <div class="kt-aside__brand-logo">
              <a href="{{ route('home') }}">
                <img alt="Logo" style="height: 65px;" src="{{ asset('images/logos/logo-mcrp-new.png') }}">
              </a>
            </div>
            <div class="kt-aside__brand-tools">
              <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler"><span></span></button>
            </div>
          </div>
          <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
            <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
              <ul class="kt-menu__nav ">
                <li class="kt-menu__item  @if(Route::current()->getName() == 'home') kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('home') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-architecture-and-city"></i><span class="kt-menu__link-text">Dashboard</span></a></li>
                <li class="kt-menu__section ">
                  <h4 class="kt-menu__section-text">Master Access</h4>
                  <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu @if(mb_strpos(url(Route::current()->uri()), url('master/user')) === 0) kt-menu__item--open kt-menu__item--here @endif" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-calendar-3"></i><span class="kt-menu__link-text">My Account</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                  <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Utils</span></span></li>
                      <li class="kt-menu__item @if(Route::current()->getName() == 'profile') kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('profile') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Personal Information</span></a></li>
                      <li class="kt-menu__item @if(Route::current()->getName() == 'profile.password') kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('profile.password') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Change Password</span></a></li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item @if(Route::current()->getName() == 'punishments') kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('punishments') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-warning"></i><span class="kt-menu__link-text">Punishments Records</span></a></li>
                <li class="kt-menu__section ">
                  <h4 class="kt-menu__section-text">Characters</h4>
                  <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                @if (Auth::user()->characters->count() > 0)
                  @foreach (Auth::user()->characters as $character)
                    <li class="kt-menu__item  kt-menu__item--submenu @if(mb_strpos(url(Request::fullUrl()), url('character/'.$character->id)) === 0) kt-menu__item--open kt-menu__item--here @endif" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><span class="kt-menu__link-text">{{ $character->name }}</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                      <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                        <ul class="kt-menu__subnav">
                          <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Utils</span></span></li>
                          <li class="kt-menu__item @if(Route::current()->getName() == 'character.overview') kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('character.overview', ['id' => $character->id, 'slug' => $character->slug()]) }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Overview</span></a></li>
                          <li class="kt-menu__item @if(Route::current()->getName() == 'character.settings') kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('character.settings', ['id' => $character->id, 'slug' => $character->slug()]) }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Settings</span></a></li>
                        </ul>
                      </div>
                    </li>
                  @endforeach
                @else
                  <li class="kt-menu__item" aria-haspopup="true"><span class="kt-menu__link "><span class="kt-menu__link-text">No character found.</span></span></li>
                @endif
                <li class="kt-menu__section ">
                  <h4 class="kt-menu__section-text">Development Access</h4>
                  <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu @if(mb_strpos(url(Route::current()->uri()), url('development/bug')) === 0 && Route::current()->getName() != 'bug.review') kt-menu__item--open kt-menu__item--here @endif" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-rocket-1"></i><span class="kt-menu__link-text">Bug Reports</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                  <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Utils</span></span></li>
                      <li class="kt-menu__item @if(Route::current()->getName() == 'bug.create') kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('bug.create') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Open New Ticket</span></a></li>
                      <li class="kt-menu__item @if(Route::current()->getName() == 'bug.index') kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('bug.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">View Your Tickets</span></a></li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item @if(Route::current()->getName() == 'bug.review') kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('bug.review') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-rocket"></i><span class="kt-menu__link-text">Review Bug Reports</span><span class="kt-menu__link-badge"><span class="kt-badge kt-badge--rounded kt-badge--danger"><i class="la la-lock"></i></span></span></a></li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-ui"></i><span class="kt-menu__link-text">Test server</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                  <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Test Server</span></span></li>
                      <li class="kt-menu__item " aria-haspopup="true"><a href="{{ url('/') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Account Settings</span></a></li>
                    </ul>
                  </div>
                </li>

                <li class="kt-menu__section ">
                  <h4 class="kt-menu__section-text">Admin Access</h4>
                  <i class="kt-menu__section-icon flaticon-more-v2"></i>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu @if(mb_strpos(url(Route::current()->uri()), url('admin/request')) === 0) kt-menu__item--open kt-menu__item--here @endif" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon-edit-1"></i><span class="kt-menu__link-text">Requests</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                  <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Requests</span></span></li>
                      <li class="kt-menu__item @if(Route::current()->getName() == 'leave.index') kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('leave.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Leave Of Absence</span></a></li>
                      <li class="kt-menu__item" aria-haspopup="true"><a href="{{ route('leave.review') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Review LOA</span>@if (\App\Models\RequestLeave::where('status', 0)->count() > 0)<span class="kt-menu__link-badge"><span class="kt-badge kt-badge--rounded kt-badge--danger">{{ \App\Models\RequestLeave::where('status', 0)->count() }}</span></span>@endif</a></li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-user-1"></i><span class="kt-menu__link-text">User Management</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                  <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">User Management</span></span></li>
                      <li class="kt-menu__item " aria-haspopup="true"><a href="{{ route('lookup.user.search') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Lookup User / Manage</span></a></li>
                      <li class="kt-menu__item @if(Route::current()->getName() == 'staff') kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('staff') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Staff List</span></a></li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu @if(mb_strpos(url(Route::current()->uri()), url('admin/logs')) === 0) kt-menu__item--open kt-menu__item--here @endif" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-file-2"></i><span class="kt-menu__link-text">Server Logs</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                  <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Server Logs</span></span></li>
                      <li class="kt-menu__item @if(Route::current()->getName() == 'logs.panel') kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('logs.panel') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Control Panel</span></a></li>
                      <li class="kt-menu__item @if(Route::current()->getName() == 'logs.server') kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('logs.server') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Server</span></a></li>
                    </ul>
                  </div>
                </li>
                <li class="kt-menu__item  kt-menu__item--submenu @if(mb_strpos(url(Route::current()->uri()), url('admin/system')) === 0) kt-menu__item--open kt-menu__item--here @endif" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon flaticon2-gear"></i><span class="kt-menu__link-text">System</span><i class="kt-menu__ver-arrow la la-angle-right"></i></a>
                  <div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                    <ul class="kt-menu__subnav">
                      <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text">Server Logs</span></span></li>
                      <li class="kt-menu__item " aria-haspopup="true"><a href="{{ url('/') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Panel Settings</span></a></li>
                      <li class="kt-menu__item @if(mb_strpos(url(Route::current()->uri()), route('usergroup.index')) === 0) kt-menu__item--active @endif" aria-haspopup="true"><a href="{{ route('usergroup.index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i><span class="kt-menu__link-text">Usergroups</span></a></li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
          <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
            <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
            <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
              <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
              </div>
            </div>
            <div class="kt-header__topbar">
              <div class="kt-header__topbar-item kt-header__topbar-item--search dropdown" id="kt_quick_search_toggle">
                @if (Auth::user()->admin > 0)
                  <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                    <span class="kt-header__topbar-icon">
                      <i class="flaticon2-search-1"></i>
                    </span>
                  </div>
                @endif
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-lg">
                  <div class="kt-quick-search kt-quick-search--dropdown kt-quick-search--result-compact" id="kt_quick_search_dropdown">
                    <form method="get" class="kt-quick-search__form">
                      <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="flaticon2-search-1"></i></span></div>
                        <input type="text" class="form-control kt-quick-search__input" placeholder="Search...">
                        <div class="input-group-append"><span class="input-group-text"><i class="la la-close kt-quick-search__close"></i></span></div>
                      </div>
                    </form>
                    <div class="kt-quick-search__wrapper kt-scroll" data-scroll="true" data-height="325" data-mobile-height="200">
                    </div>
                  </div>
                </div>
              </div>
              <div class="kt-header__topbar-item kt-header__topbar-item--user">
                <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                  <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{ Auth::user()->username }}</span>
                    <img alt="Pic" class="kt-radius-100" src="{{ asset('images/avatars/gtav03.png') }}" />
                  </div>
                </div>
                <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                  <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url({{ asset('images/bg/bg-profile.png') }})">
                    <div class="kt-user-card__avatar">
                      <img alt="Pic" src="{{ asset('images/avatars/gtav03.png') }}" />
                    </div>
                    <div class="kt-user-card__name">
                      {{ Auth::user()->username }}
                    </div>
                  </div>
                  <div class="kt-notification">
                    <a href="{{ route('profile') }}" class="kt-notification__item">
                      <div class="kt-notification__item-icon">
                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                      </div>
                      <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title kt-font-bold">
                          My Profile
                        </div>
                        <div class="kt-notification__item-time">
                          Account settings and more
                        </div>
                      </div>
                    </a>
                    <div class="kt-notification__custom kt-space-between">
                      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
            <div class="kt-subheader   kt-grid__item" id="kt_subheader">
              <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                  <h3 class="kt-subheader__title">@yield('page_title')</h3>
                  <span class="kt-subheader__separator kt-hidden"></span>
                  <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('home') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    @yield('breadcrumb')
                  </div>
                </div>
              </div>
            </div>
            <div class="kt-container kt-container--fluid  kt-grid__item kt-grid__item--fluid">
              @yield('content')
            </div>
          </div>
          <div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
            <div class="kt-container kt-container--fluid ">
              <div class="kt-footer__copyright">
                2019&nbsp;&copy;&nbsp;<a href="{{ url('/') }}" target="_blank" class="kt-link">Mafia City Roleplay - v2.0.0</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="kt_scrolltop" class="kt-scrolltop">
      <i class="fa fa-arrow-up"></i>
    </div>
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#2c77f4",
                    "light": "#ffffff",
                    "dark": "#282a3c",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>
    <script src="{{ asset('js/global.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts.js') }}" type="text/javascript"></script>
    @yield('scripts')

  </body>
</html>
