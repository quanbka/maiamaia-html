<header class="main-header" ng-controller="HeaderController">
  <!-- Logo -->
  <a href="/" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b><i class="fa fa-grav"></i></b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><i class="fa fa-grav"></i> MaiaMaia</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">

      <ul class="nav navbar-nav">
          <li class=" messages-menu">
            <a href="#" class="dropdown-toggle">
              <i class="fa fa-calendar-o"></i>
              <span ng-bind="day"></span>
            </a>

          </li>
          <li class=" messages-menu open">
            <a href="#" class="dropdown-toggle">
              <i class="fa fa-clock-o"></i>
              <span ng-bind="time"></span>
            </a>

          </li>
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="/sys/images/no-image.png" class="user-image" alt="User Image">
            <span class="hidden-xs">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">

              <p>
                {{ Auth::user()->name }}
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                  <form class="" action="/logout" method="post">
                      <button href="#" class="btn btn-default btn-flat">Sign out</button>
                      {{ csrf_field() }}
                  </form>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->

      </ul>
    </div>
  </nav>
</header>
