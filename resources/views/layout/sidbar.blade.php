<?php
use App\Models\City;
$city =City::count();
?>


<aside class="app-sidebar sidebar-scroll" >
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="javascripty:void(0)"><img src="{{asset('assets/images/photo.jpg')}}" width="200" height="200" class="main-logo" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="javascripty:void(0)"><img src="{{asset('assets/images/photo.jpg')}}" width="200" height="200" class="logo-icon" alt="logo"></a>
    </div>
    <div class="main-sidemenu mCustomScrollbar _mCS_1 mCS-autoHide" style="position: relative; overflow: visible;">
        <div id="mCSB_1" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: none;" tabindex="0">
            <div id="mCSB_1_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" >

                
        <div class="app-sidebar__user clearfix active">
            <div class="dropdown user-pro-body">
                @if(auth()->guard('company')->user()->image == null)
                    <div class="">
                        <img alt="user-img" class="avatar avatar-xl brround mCS_img_loaded" src="{{asset('assets/img/faces/6.jpg')}}">
                        <span class="avatar-status profile-status bg-green"></span>
                    </div>
                @else
                    <div class="">
                        <img alt="user-img" class="avatar avatar-xl brround mCS_img_loaded" src="{{asset(auth()->guard('company')->user()->image)}}">
                        <span class="avatar-status profile-status bg-green"></span>
                    </div>
                @endif
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{auth()->guard('company')->user()->first_name}} {{auth()->guard('company')->user()->last_name}}</h4>
                    <span class="mb-0 text-muted">{{auth()->guard('company')->user()->name_company}} </span>
                </div>
            </div>
        </div>
        @if (auth()->guard('company')->user()->type == 'owner')

            @include('layout.sidebar_owner')
        @else


            @include('layout.sidebar_admin')
        @endif
    </div>
</div>
<div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal mCSB_scrollTools_vertical" style="display: block;">
    <div class="mCSB_draggerContainer">
        <div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; display: block; height: 84px; max-height: 275.6px; top: 0px;">
            <div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail">
                </div>
            </div>
        </div>
    </div>
</aside>