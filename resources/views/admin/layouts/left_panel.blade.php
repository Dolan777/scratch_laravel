<?php
$routeArray = app('request')->route()->getAction();
$controllerAction = class_basename($routeArray['controller']);
list($controller, $action) = explode('@', $controllerAction);
?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item start {{ ($controller=="DashboardController") ? 'active' : '' }}">
                <a href="{{Route('admin-dashboard')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start {{ in_array($controller, ['ArtistsController']) ? 'active' : '' }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">User Management</span>
                    <span class="selected"></span>
                    <span class="arrow {{ in_array($controller, ['ArtistsController']) ? 'open' : '' }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ ($controller=="ArtistsController") ? 'active' : '' }}">
                        <a href="{{Route('artists-list')}}" class="nav-link ">
                            <i class="fa fa-user-o" aria-hidden="true"></i>
                            <span class="title">Manage Artists</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start {{ in_array($controller, ['SettingsController','EmailNotificationController','CmspageController','CmsController','FaqController','SliderController']) ? 'active' : '' }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-cog"></i>
                    <span class="title">Site Management</span>
                    <span class="selected"></span>
                    <span class="arrow {{ in_array($controller, ['SettingsController','EmailNotificationController','CmspageController','CmsController','FaqController','SliderController']) ? 'open' : '' }}"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start {{ ($controller=="SettingsController") ? 'active' : '' }}">
                        <a href="{{Route('settings')}}" class="nav-link ">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                            <span class="title">Settings</span>
                        </a>
                    </li>
                    <li class="nav-item start {{ ($controller=="CmspageController") ? 'active' : '' }}">
                        <a href="{{Route('cmspage')}}" class="nav-link ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            <span class="title">CMS Page Management</span>
                            <span class="selected"></span>

                        </a>
                    </li>
                    <li class="nav-item start {{ ($controller=="CmsController") ? 'active' : '' }}">
                        <a href="{{Route('cms')}}" class="nav-link ">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            <span class="title">CMS Management</span>
                            <span class="selected"></span>

                        </a>
                    </li>
                    <li class="nav-item start {{ ($controller=="EmailNotificationController") ? 'active' : '' }}">
                        <a href="{{Route('emailNotification')}}" class="nav-link ">
                            <i class="fa fa-envelope-open" aria-hidden="true"></i>
                            <span class="title">Email Management</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start {{ ($controller=="FaqController") ? 'active' : '' }}">
                        <a href="{{Route('faqpage')}}" class="nav-link ">
                            <i class="fa fa-envelope-open" aria-hidden="true"></i>
                            <span class="title">Faq Management</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item start {{ ($controller=="SliderController") ? 'active' : '' }}">
                        <a href="{{Route('slider')}}" class="nav-link ">
                            <i class="fa fa-envelope-open" aria-hidden="true"></i>
                            <span class="title">Slider Management</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item start {{ ($controller=="ContactusController") ? 'active' : '' }}">
                <a href="{{Route('contactus')}}" class="nav-link nav-toggle">
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    <span class="title">Contact Us</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start">
                <a href="{{Route('admin-logout')}}" class="nav-link nav-toggle">
                    <i class="fa fa-sign-out"></i>
                    <span class="title">Logout</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </div>
</div>