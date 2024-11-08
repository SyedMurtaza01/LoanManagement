<div data-simplebar class="h-100">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Main</li>

            <li class="{{ request()->routeIs('admin.dashboard') ? 'mm-active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('admin.users.*') ? 'mm-active' : '' }}">
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-account"></i>
                    <span>Users</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('admin.users.index') }}">All Users</a></li>
                    <li><a href="{{ route('admin.users.create') }}">Add User</a></li>
                </ul>
            </li>
            
            <!-- <li class="{{ request()->routeIs('admin.blogs.*') ? 'mm-active' : '' }}">
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-blogger"></i>
                    <span>Blogs</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('admin.blogs.index') }}">All Blogs</a></li>
                    <li><a href="{{ route('admin.blogs.create') }}">Add Blogs</a></li>
                </ul>
            </li> -->

            <li class="{{ request()->routeIs('admin.branches.*') ? 'mm-active' : '' }}">
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-tree" style="font-size: 18px;"></i>
                    <span>Branches</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('admin.branches.index') }}">All Branches</a></li>
                    <li><a href="{{ route('admin.branches.create') }}">Add Branches</a></li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('admin.loans.*') ? 'mm-active' : '' }}">
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-cash" style="font-size: 18px;"></i>
                    <span>Loan Plans</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('admin.loans.index') }}">All Loans</a></li>
                    <li><a href="{{ route('admin.loans.create') }}">Add Loans</a></li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('admin.installments.*') ? 'mm-active' : '' }}">
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-credit-card" style="font-size: 18px;"></i>
                    <span>Installments</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('admin.installments.index') }}">All Installment</a></li>
                    <li><a href="{{ route('admin.installments.create') }}">Add Installment</a></li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('admin.documents.*') ? 'mm-active' : '' }}">
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-file-document" style="font-size: 20px; margin-right: 10px; vertical-align: middle;"></i>
                    <span style="vertical-align: middle;">Documents</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('admin.documents.index') }}">All Documents</a></li>
                    <li><a href="{{ route('admin.documents.create') }}">Add Documents</a></li>
                </ul>
            </li>



            <!-- <li class="{{ request()->routeIs('admin.setting') ? 'mm-active' : '' }}">
                <a href="{{ route('admin.setting') }}" class="waves-effect">
                    <i class="mdi mdi-cog"></i>
                    <span>Setting</span>
                </a>
            </li> -->
        </ul>
    </div>
</div>