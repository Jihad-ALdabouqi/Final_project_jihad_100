<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ url('admin/dashboard') }}" class="logo">
                <img src="{{ asset('admin/assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a data-bs-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.dashboard') }}">
    <span class="sub-item">Dashboard 1</span>
</a>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="far fa-user"></i>
                        <p>Users</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('users.index') }}"><span class="sub-item">All Users</span></a></li>
                            <li><a href="{{ route('users.create') }}"><span class="sub-item">Add User</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- قسم Salons الجديد -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#salons">
                        <i class="fas fa-user-tie"></i>
                        <p>Salons</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="salons">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('salons.index') }}"><span class="sub-item">All Salons</span></a></li>
                            <li><a href="{{ route('salons.create') }}"><span class="sub-item">Add Salon</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- قسم Services الجديد -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#services">
                        <i class="fas fa-concierge-bell"></i>
                        <p>Services</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="services">
                        <ul class="nav nav-collapse">
                            <li><a href="{{ route('services.index') }}"><span class="sub-item">All Services</span></a></li>
                            <li><a href="{{ route('services.create') }}"><span class="sub-item">Add Service</span></a></li>
                        </ul>
                    </div>
                </li>

                <!-- قسم Coin Transactions -->
<li class="nav-item">
    <a data-bs-toggle="collapse" href="#coin-transactions">
        <i class="fas fa-coins"></i>
        <p>Coin Transactions</p>
        <span class="caret"></span>
    </a>
    <div class="collapse" id="coin-transactions">
        <ul class="nav nav-collapse">
            <li><a href="{{ route('coin-transactions.index') }}"><span class="sub-item">All Transactions</span></a></li>
            <li><a href="{{ route('coin-transactions.create') }}"><span class="sub-item">Add Transaction</span></a></li>
        </ul>
    </div>
</li>
<!-- Offers -->
<li class="nav-item">
    <a data-bs-toggle="collapse" href="#offers">
        <i class="fas fa-tags"></i>
        <p>Offers</p>
        <span class="caret"></span>
    </a>
    <div class="collapse" id="offers">
        <ul class="nav nav-collapse">
            <li><a href="{{ route('offers.index') }}"><span class="sub-item">All Offers</span></a></li>
            <li><a href="{{ route('offers.create') }}"><span class="sub-item">Add Offer</span></a></li>
        </ul>
    </div>
</li>
<!-- Feedbacks -->
<li class="nav-item">
    <a data-bs-toggle="collapse" href="#feedbacks">
        <i class="fas fa-comment-alt"></i>
        <p>Feedbacks</p>
        <span class="caret"></span>
    </a>
    <div class="collapse" id="feedbacks">
        <ul class="nav nav-collapse">
            <li><a href="{{ route('feedbacks.index') }}"><span class="sub-item">All Feedbacks</span></a></li>
            <li><a href="{{ route('feedbacks.create') }}"><span class="sub-item">Add Feedback</span></a></li>
        </ul>
    </div>
</li>
<!-- 🔻 أضف زر Logout هنا 🔻 -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
                

                

              

               
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->