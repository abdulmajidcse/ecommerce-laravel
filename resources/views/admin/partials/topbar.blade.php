                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                
                                    @php
                                        $notification = App\Order::where('is_seen_by_admin', 0)->count();
                                    @endphp
                                    @if ($notification > 0)
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter">
                                        {{ $notification }}
                                    </span>
                                    @endif
                                
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">Notifications Center</h6>
                                @if ($notification > 0)
                                    <div style="max-height: 65vh; overflow: scroll;">
                                    @foreach (App\Order::where('is_seen_by_admin', 0)->orderBy('id', 'desc')->get() as $order)
                                        <a class="dropdown-item d-flex align-items-center" href="{{ URL::to('admin/orders/view/'.$order->id) }}">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-primary">
                                                    <i class="fas fa-shopping-cart text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="small text-gray-700">{{ date_format($order->created_at, 'h:i a, F d, Y') }}</div>
                                                <span class="font-weight-bold">{{ $order->name }} has confirmed a order</span>
                                            </div>
                                        </a>
                                    @endforeach
                                    </div>
                                @else
                                    <p class="p-4 h6 text-danger text-center">No Notification here!</p>                                    
                                @endif
                                
                                {{-- <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a> --}}
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                @if (empty(Auth::user()->image))
                                    <i class="fas fa-user-shield" style="font-size:30px;"></i>
                                @else
                                    <img src="{{ URL::to(Auth::user()->image) }}" class="rounded-circle" style="width: 40px;" alt="Admin Image">
                                @endif
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('/admin/profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                                </a>
                                <a class="dropdown-item" href="{{ URL::to('admin/settings') }}">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Settings
                                </a>
                                <a class="dropdown-item" href="{{ URL::to('admin/payment-systems') }}">
                                    <i class="fas fa-shopping-cart fa-sm fa-fw mr-2 text-gray-400"></i> Payment Systems
                                </a>
                                <a class="dropdown-item" href="{{ URL::to('admin/subscribers') }}">
                                    <i class="fas fa-ticket-alt fa-sm fa-fw mr-2 text-gray-400"></i> Subscribers
                                </a>
                                <a class="dropdown-item" href="{{ URL::to('admin/customers') }}">
                                    <i class="fas fa-users fa-sm fa-fw mr-2 text-gray-400"></i> Customers
                                </a>
                                <a class="dropdown-item" href="{{ URL::to('admin/social-contacts') }}">
                                    <i class="far fa-address-card fa-sm fa-fw mr-2 text-gray-400"></i> Social Contact
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->