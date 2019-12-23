@extends('layouts.app')

@section('content')
  <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">
      <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
        <i class="la la-close"></i>
      </button>
      <div class="kt-grid__item kt-app__toggle kt-app__aside" id="kt_user_profile_aside">
        <div class="kt-portlet ">
          <div class="kt-portlet__head  kt-portlet__head--noborder">
            <div class="kt-portlet__head-label">
              <h3 class="kt-portlet__head-title">
              </h3>
            </div>
          </div>
          <div class="kt-portlet__body kt-portlet__body--fit-y">
            <div class="kt-widget kt-widget--user-profile-1">
              <div class="kt-widget__head">
                <div class="kt-widget__media">
                  <img src="{{ asset('images/avatars/gtav03.png') }}" alt="image">
                </div>
                <div class="kt-widget__content">
                  <div class="kt-widget__section">
                    <a href="#" class="kt-widget__username">
                      {{ $user->username }}
                      <i class="flaticon2-correct kt-font-success"></i>
                    </a>
                    <span class="kt-widget__subtitle">
                      {{ $user->getRank() }}
                    </span>
                  </div>
                </div>
              </div>
              <div class="kt-widget__body mt-5">
                <div class="kt-widget__items">
                  <a href="{{ route('lookup.user.overview', ['user' => $user]) }}" class="kt-widget__item @if(Route::current()->getName() == 'lookup.user.overview') kt-widget__item--active @endif">
                    <span class="kt-widget__section">
                      <span class="kt-widget__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z" fill="#000000"/>
                          </g>
                        </svg>
                      </span>
                      <span class="kt-widget__desc">
                        Account Overview
                      </span>
                    </span>
                  </a>
                  <a href="{{ route('lookup.user.usergroup', ['user' => $user]) }}" class="kt-widget__item @if(Route::current()->getName() == 'lookup.user.usergroup') kt-widget__item--active @endif">
                    <span class="kt-widget__section">
                      <span class="kt-widget__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                          </g>
                        </svg>
                      </span>
                      <span class="kt-widget__desc">
                        Adjust Usergroup
                      </span>
                    </span>
                  </a>
                  <a href="{{ route('lookup.user.punishments', ['user' => $user]) }}" class="kt-widget__item @if(Route::current()->getName() == 'lookup.user.punishments') kt-widget__item--active @endif">
                    <span class="kt-widget__section">
                      <span class="kt-widget__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3.51471863,18.6568542 L13.4142136,8.75735931 C13.8047379,8.36683502 14.4379028,8.36683502 14.8284271,8.75735931 L16.2426407,10.1715729 C16.633165,10.5620972 16.633165,11.1952621 16.2426407,11.5857864 L6.34314575,21.4852814 C5.95262146,21.8758057 5.31945648,21.8758057 4.92893219,21.4852814 L3.51471863,20.0710678 C3.12419433,19.6805435 3.12419433,19.0473785 3.51471863,18.6568542 Z" fill="#000000" opacity="0.3"/>
                            <path d="M9.87867966,6.63603897 L13.4142136,3.10050506 C13.8047379,2.70998077 14.4379028,2.70998077 14.8284271,3.10050506 L21.8994949,10.1715729 C22.2900192,10.5620972 22.2900192,11.1952621 21.8994949,11.5857864 L18.363961,15.1213203 C17.9734367,15.5118446 17.3402718,15.5118446 16.9497475,15.1213203 L9.87867966,8.05025253 C9.48815536,7.65972824 9.48815536,7.02656326 9.87867966,6.63603897 Z" fill="#000000"/>
                            <path d="M17.3033009,4.86827202 L18.0104076,4.16116524 C18.2056698,3.96590309 18.5222523,3.96590309 18.7175144,4.16116524 L20.8388348,6.28248558 C21.0340969,6.47774772 21.0340969,6.79433021 20.8388348,6.98959236 L20.131728,7.69669914 C19.9364658,7.89196129 19.6198833,7.89196129 19.4246212,7.69669914 L17.3033009,5.5753788 C17.1080387,5.38011665 17.1080387,5.06353416 17.3033009,4.86827202 Z" fill="#000000" opacity="0.3"/>
                          </g>
                        </svg>
                      </span>
                      <span class="kt-widget__desc">
                        Punishments Records
                      </span>
                    </span>
                  </a>
                  <a href="{{ route('lookup.user.whois', ['user' => $user]) }}" class="kt-widget__item @if(Route::current()->getName() == 'lookup.user.whois') kt-widget__item--active @endif">
                    <span class="kt-widget__section">
                      <span class="kt-widget__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>
                          </g>
                        </svg>
                      </span>
                      <span class="kt-widget__desc">
                        Account WHOIS
                      </span>
                    </span>
                  </a>
                  <a href="{{ route('lookup.user.staff_profile', ['user' => $user]) }}" class="kt-widget__item @if(Route::current()->getName() == 'lookup.user.staff_profile') kt-widget__item--active @endif">
                    <span class="kt-widget__section">
                      <span class="kt-widget__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M2,13.1500272 L2,5.5 C2,4.67157288 2.67157288,4 3.5,4 L6.37867966,4 C6.77650439,4 7.15803526,4.15803526 7.43933983,4.43933983 L10,7 L20.5,7 C21.3284271,7 22,7.67157288 22,8.5 L22,19.5 C22,20.3284271 21.3284271,21 20.5,21 L10.9835977,21 C10.9944753,20.8347382 11,20.6680143 11,20.5 C11,16.3578644 7.64213562,13 3.5,13 C2.98630124,13 2.48466491,13.0516454 2,13.1500272 Z" fill="#000000"/>
                            <path d="M4.5,16 C5.05228475,16 5.5,16.4477153 5.5,17 L5.5,19 C5.5,19.5522847 5.05228475,20 4.5,20 C3.94771525,20 3.5,19.5522847 3.5,19 L3.5,17 C3.5,16.4477153 3.94771525,16 4.5,16 Z M4.5,23 C3.94771525,23 3.5,22.5522847 3.5,22 C3.5,21.4477153 3.94771525,21 4.5,21 C5.05228475,21 5.5,21.4477153 5.5,22 C5.5,22.5522847 5.05228475,23 4.5,23 Z" fill="#000000" opacity="0.3"/>
                          </g>
                        </svg>
                      </span>
                      <span class="kt-widget__desc">
                        Staff Profile
                      </span>
                    </span>
                    <span class="kt-badge kt-badge--unified-danger kt-badge--sm kt-badge--rounded kt-badge--bolder"><i class="la la-times"></i></span>
                    <span class="kt-badge kt-badge--unified-success kt-badge--sm kt-badge--rounded kt-badge--bolder"><i class="la la-check"></i></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="kt-grid__item kt-grid__item--fluid kt-app__content">
        @yield('content-lookup')
      </div>
    </div>
  </div>
@endsection
