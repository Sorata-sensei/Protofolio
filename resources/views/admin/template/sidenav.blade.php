<ul class="navbar-nav bg-gradient-side sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <img class="img-logo" src="{{ url('asset/logo.png') }}" alt="brand&Balance">
        {{-- <div class="sidebar-brand-text mx-3">PortaFinance <sup></sup></div> --}}
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Personal Branding
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li
        class="nav-item {{ request()->is('admin/carier') ? 'active' : '' }}{{ request()->is('admin/carier/create') ? 'active' : '' }}">
        <a class="nav-link {{ request()->is('admin/carier') ? '' : 'collapsed' }} {{ request()->is('admin/carier/create') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-building"></i>
            <span>Carier</span>
        </a>
        <div id="collapseTwo"
            class="collapse {{ request()->is('admin/carier') ? 'show' : '' }} {{ request()->is('admin/carier/create') ? 'show' : '' }}"
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item {{ request()->is('admin/carier') ? 'active' : '' }}"
                    href="{{ route('carier.admin.index') }}">View</a>
                <a class="collapse-item {{ request()->is('admin/carier/create') ? 'active' : '' }}"
                    href="{{ route('carier.admin.create') }}">Add</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Research Collapse Menu -->
    <li
        class="nav-item {{ request()->is('admin/research') ? 'active' : '' }} {{ request()->is('admin/research/create') ? 'active' : '' }}">
        <a class="nav-link  {{ request()->is('admin/research') ? '' : 'collapsed' }} {{ request()->is('admin/research/create') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseResearch" aria-expanded="true"
            aria-controls="collapseResearch">
            <i class="fas fa-fw fa-book"></i>
            <span>Research</span>
        </a>
        <div id="collapseResearch"
            class="collapse {{ request()->is('admin/research') ? 'show' : '' }} {{ request()->is('admin/research/create') ? 'show' : '' }}"
            aria-labelledby="headingResearch" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item {{ request()->is('admin/research') ? 'active' : '' }}"
                    href="{{ route('research.admin.index') }}">View</a>
                <a class="collapse-item {{ request()->is('admin/research/create') ? 'active' : '' }}"
                    href="{{ route('research.admin.create') }}">Add</a>
            </div>
        </div>
    </li>

    <li
        class="nav-item {{ request()->is('admin/activities') ? 'active' : '' }} {{ request()->is('admin/activities/create') ? 'active' : '' }}">
        <a class="nav-link {{ request()->is('admin/activities') ? '' : 'collapsed' }} {{ request()->is('admin/activities/create') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseActivities" aria-expanded="true"
            aria-controls="collapseActivities">
            <i class="fas fa-fw fa-paper-plane"></i>
            <span>Activities</span>
        </a>
        <div id="collapseActivities"
            class="collapse {{ request()->is('admin/activities') ? 'show' : '' }} {{ request()->is('admin/activities/create') ? 'show' : '' }}"
            aria-labelledby="headingActivities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item {{ request()->is('admin/activities') ? 'active' : '' }}"
                    href="{{ route('admin.activities.index') }}">View</a>
                <a class="collapse-item {{ request()->is('admin/activities/create') ? 'active' : '' }}"
                    href="{{ route('admin.activities.create') }}">Add</a>
            </div>
        </div>
    </li>

    <li
        class="nav-item {{ request()->is('admin/visitor') ? 'active' : '' }} {{ request()->is('admin/visitor/chart') ? 'active' : '' }} {{ request()->is('admin/visitor/daily_chart') ? 'active' : '' }}{{ request()->is('admin/visitor/month_chart') ? 'active' : '' }}">
        <a class="nav-link {{ request()->is('admin/visitor') ? '' : 'collapsed' }} {{ request()->is('admin/visitor/chart') ? '' : 'collapsed' }} {{ request()->is('admin/visitor/daily_chart') ? '' : 'collapsed' }} {{ request()->is('admin/visitor/month_chart') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseVisitor" aria-expanded="true"
            aria-controls="collapseVisitor">
            <i class="fas fa-fw fa-user"></i>
            <span>Visitor</span>
        </a>
        <div id="collapseVisitor"
            class="collapse {{ request()->is('admin/visitor') ? 'show' : '' }} {{ request()->is('admin/visitor/chart') ? 'show' : '' }} {{ request()->is('admin/visitor/daily_chart') ? 'show' : '' }} {{ request()->is('admin/visitor/month_chart') ? 'show' : '' }}"
            aria-labelledby="headingVisitor" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item {{ request()->is('admin/visitor') ? 'active' : '' }}"
                    href="{{ route('admin.visitor.index') }}">View</a>
                <a class="collapse-item {{ request()->is('admin/visitor/chart') ? 'active' : '' }}"
                    href="{{ route('admin.visitor.chart') }}">Chart</a>
                <a class="collapse-item {{ request()->is('admin/visitor/daily_chart') ? 'active' : '' }}"
                    href="{{ route('admin.visitor.daily_chart') }}">Chart Daily</a>
                <a class="collapse-item {{ request()->is('admin/visitor/month_chart') ? 'active' : '' }}"
                    href="{{ route('admin.visitor.month_chart') }}">Chart Month</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading">
        Personal Finance
    </div>

    <li
        class="nav-item {{ request()->is('admin/finance') ? 'active' : '' }} {{ request()->is('admin/finance/fund') ? 'active' : '' }}{{ request()->is('admin/finance/expense') ? 'active' : '' }}">
        <a class="nav-link {{ request()->is('admin/finance') ? '' : 'collapsed' }} {{ request()->is('admin/finance/fund') ? '' : 'collapsed' }} {{ request()->is('admin/finance/expanse') ? '' : 'collapsed' }}"
            href="#" data-toggle="collapse" data-target="#collapseFinance" aria-expanded="true"
            aria-controls="collapseFinance">
            <i class="fas fa-fw fa-user"></i>
            <span>Finance</span>
        </a>
        <div id="collapseFinance"
            class="collapse {{ request()->is('admin/finance') ? 'show' : '' }} {{ request()->is('admin/finance/fund') ? 'show' : '' }}{{ request()->is('admin/finance/expense') ? 'show' : '' }}"
            aria-labelledby="headingFinance" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item {{ request()->is('admin/finance') ? 'active' : '' }}"
                    href="{{ route('admin.finance.index') }}">Main</a>
                <a class="collapse-item {{ request()->is('admin/finance/fund') ? 'active' : '' }}"
                    href="{{ route('admin.finance.Fund') }}">Fund</a>
                <a class="collapse-item {{ request()->is('admin/finance/expense') ? 'active' : '' }}"
                    href="{{ route('admin.finance.Expense') }}">Expense</a>
            </div>
        </div>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    {{-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div> --}}


</ul>
