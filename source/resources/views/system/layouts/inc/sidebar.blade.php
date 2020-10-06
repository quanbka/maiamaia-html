<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/sys/images/no-image.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Control Panel</li>
            <li class="{{ (Route::currentRouteName()=='system-index')?'active':'' }}">
                <a href="{{ route('system-index' )}}"><i class="fa fa-line-chart"></i> <span>Dashboard</span></a>
            </li>
            <li class="{{ (Route::currentRouteName()=='system-user')?'active':'' }}">
                <a href="{{ route('system-user' )}}"><i class="fa fa-user"></i> <span>Tài khoản</span></a>
            </li>
            <li class="{{ (Route::currentRouteName()=='system-banner')?'active':'' }}">
                <a href="{{ route('system-banner' )}}"><i class="fa fa-image"></i> <span>Banner</span></a>
            </li>
            <li class="{{ (Route::currentRouteName()=='system-category')?'active':'' }}">
                <a href="{{ route('system-category', ['news'] )}}"><i class="fa fa-credit-card"></i> <span>Danh mục</span></a>
            </li>
            <li class="{{ (Route::currentRouteName()=='system-article')?'active':'' }}">
                <a href="{{ route('system-article' )}}"><i class="glyphicon glyphicon-list-alt"></i> <span>Dịch vụ</span></a>
            </li>
            <li class="{{ (Route::currentRouteName()=='system-article-beauty')?'active':'' }}">
                <a href="{{ route('system-article-beauty' )}}"><i class="fa fa-tachometer"></i> <span>Dịch vụ thẩm mỹ</span></a>
            </li>
            <li class="treeview {{ in_array(Route::currentRouteName(),['system-setting', 'frontend-config']) ? 'active' : '' }}">
                <a href="#">
                    <i class="glyphicon glyphicon-cog"></i>
                    <span>Setting</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="padding-left: 12px">
                    <li class="{{ (Route::currentRouteName()=='system-setting') ? 'active' : '' }}"><a href="{{ route('system-setting' )}}"><i class="fa fa-circle-o"></i> Param Config</a></li>
                    <li class="{{ (Route::currentRouteName()=='frontend-config') ? 'active' : '' }}"><a href="{{ route('frontend-config' )}}"><i class="fa fa-circle-o"></i> Frontend Config</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
