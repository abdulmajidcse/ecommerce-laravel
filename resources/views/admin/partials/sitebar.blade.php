        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="sidebar-brand-text mx-3">E-commerce</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/admin') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- category menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cateogry-menu" aria-expanded="true" aria-controls="cateogry-menu">
                    <i class="fas fa-th"></i>
                    <span>Category</span>
                </a>
                <div id="cateogry-menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('/admin/categories/add') }}">Add category</a>
                        <a class="collapse-item" href="{{ url('/admin/categories/') }}">All category</a>
                    </div>
                </div>
            </li> <!-- end of category menu -->

            <!-- brand menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brand-menu" aria-expanded="true" aria-controls="brand-menu">
                    <i class="fas fa-columns"></i>
                    <span>Brand</span>
                </a>
                <div id="brand-menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('/admin/brands/add') }}">Add brand</a>
                        <a class="collapse-item" href="{{ url('/admin/brands/') }}">All brand</a>
                    </div>
                </div>
            </li> <!-- end of brand menu -->

            <!-- product menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product-menu" aria-expanded="true" aria-controls="product-menu">
                    <i class="fas fa-shopping-basket"></i>
                    <span>Product</span>
                </a>
                <div id="product-menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('/admin/products/add') }}">Add product</a>
                        <a class="collapse-item" href="{{ url('/admin/products/') }}">All product</a>
                    </div>
                </div>
            </li> <!-- end of product menu -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- division menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#division-menu" aria-expanded="true" aria-controls="division-menu">
                    <i class="fas fa-city"></i>
                    <span>Division</span>
                </a>
                <div id="division-menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('/admin/divisions/add') }}">Add division</a>
                        <a class="collapse-item" href="{{ url('/admin/divisions/') }}">All division</a>
                    </div>
                </div>
            </li> <!-- end of division menu -->

            <!-- district menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#district-menu" aria-expanded="true" aria-controls="district-menu">
                    <i class="fas fa-building"></i>
                    <span>District</span>
                </a>
                <div id="district-menu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('/admin/districts/add') }}">Add district</a>
                        <a class="collapse-item" href="{{ url('/admin/districts/') }}">All district</a>
                    </div>
                </div>
            </li> <!-- end of district menu -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->