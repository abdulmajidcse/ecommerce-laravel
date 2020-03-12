                        <!-- Nav -->
                        <div class="row">
                            <nav class="navbar navbar-expand-lg navbar-light bg-white col-12">
                                <button class="navbar-toggler d-lg-none border-0" type="button" data-toggle="collapse" data-target="#mainNav">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="mainNav">
                                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="brands" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Brand</a>
                                            <div class="dropdown-menu" aria-labelledby="brands">
                                                @php
                                                    $brands = App\Brand::orderBy('name', 'asc')->get();
                                                @endphp
                                                @foreach ($brands as $oneBrand)
                                                    <a class="dropdown-item" href="{{ url('/brand-product/'.$oneBrand->name) }}">{{ $oneBrand->name }}</a>
                                                @endforeach
                                            </div>
                                        </li>
                                        <!-- category -->
                                        @foreach (App\Category::where('parent_id', NULL)->get() as $parent)
                                            @if (count(App\Category::where('parent_id', $parent->id)->get()) > 0)
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="#" id="{{ $parent->name }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $parent->name }}</a>
                                                    <div class="dropdown-menu" aria-labelledby="{{ $parent->name }}">
                                                        @foreach (App\Category::where('parent_id', $parent->id)->get() as $child)
                                                            <a class="dropdown-item" href="{{ url('/category-product/'.$child->name) }}">{{ $child->name }}</a>
                                                        @endforeach
                                                    </div>
                                                </li>

                                            @else
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ url('/category-product/'.$parent->name) }}">
                                                        {{ $parent->name }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                        <!-- end of category -->
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <!-- Nav -->