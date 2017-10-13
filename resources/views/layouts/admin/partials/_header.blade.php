<header class="header">
    <div class="header-block header-block-collapse hidden-lg-up">
        <button class="collapse-btn" id="sidebar-collapse-btn">
            <i class="fa fa-bars"></i>
        </button>
    </div>
    <div class="header-block header-block-search hidden-sm-down">
        <form role="search">
            <div class="input-container"><i class="fa fa-search"></i> <input type="search" placeholder="Search">
                <div class="underline"></div>
            </div>
        </form>
    </div>
    <div class="header-block header-block-nav">
        <ul class="nav-profile">
            <li class="profile dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="img"
                         style="background-image: url('{{ Auth::user()->avatar() }}')"></div> <span
                            class="name">
                        {{ Auth::user()->username != null ? Auth::user()->username : Auth::user()->firstname  }}
    			    </span>
                </a>
                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                        <i class="fa fa-user icon"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="">
                        <i class="fa fa-bell icon"></i>
                        Notifications
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-gear icon"></i>
                        Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off icon"></i>
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </li>
        </ul>
    </div>
</header>
