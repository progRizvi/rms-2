<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
        <a href="index.html"><img src="img/logo.png" alt></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class>
            <a href="{{ route('user.dashboard') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="img/menu-icon/5.svg" alt>
                </div>
                <span>User Profile</span>
            </a>
        </li>
        <li class>
            <a href="{{ route('user.all.booking') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="img/menu-icon/5.svg" alt>
                </div>
                <span>Bookings</span>
            </a>
        </li>
    </ul>
</nav>
