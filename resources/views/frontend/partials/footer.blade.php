            <div class="col-12 align-self-end">
                <!-- Footer -->
                <footer class="row">
                    <div class="col-12 bg-dark text-white pb-3 pt-5">
                        <div class="row">
                            <div class="col-lg-2 col-sm-4 text-center text-sm-left mb-sm-0 mb-3">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="footer-logo">
                                            <a href="{{ url('/') }}">
                                                @php
                                                    $settings = App\Settings::get()->first();
                                                @endphp
                                                @if (!empty($settings))
                                                    <img src="{{ URL::to($settings->logo) }}" style="width: 40px;" class="rounded-circle" alt="">
                                                    {{ ' ' . $settings->name }}
                                                @else
                                                    <i class="fas fa-home"></i> E-commerce
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        @php
                                            $settings = App\Settings::get()->first();
                                        @endphp
                                        @if (!empty($settings))
                                            <address>
                                                {{ $settings->address }}
                                            </address>
                                        @else
                                            {{ 'Company Address' }}
                                        @endif
                                        
                                    </div>
                                    <div class="col-12">
                                        @if (!is_null(App\SocialContact::orderBy('priority', 'asc')->get()))
                                            @foreach (App\SocialContact::orderBy('priority', 'asc')->get() as $social_contact)
                                                <a href="{{ $social_contact->social_url }}" class="social-icon" target="_blank"><img src="{{ URL::to($social_contact->icon) }}" style="width: 20px;" class="rounded" alt="social link"></a>
                                            @endforeach
                                            
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-8 text-center text-sm-left mb-sm-0 mb-3">
                                <div class="row">
                                    <div class="col-12 text-uppercase">
                                        <h4>Payment Methods</h4>
                                    </div>
                                    <div class="col-12">
                                        @if(!empty(App\Payment::all()))
                                            @foreach(App\Payment::orderBy('priority', 'asc')->get() as $payment)
                                            <img src="{{ URL::to($payment->image) }}" style="width: 35px;" class="rounded-circle" alt="">{{ ' ' . $payment->name }} <br/>
                                            @endforeach
                                        @else
                                            {{ 'Not Available!' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-3 col-5 ml-lg-auto ml-sm-0 ml-auto mb-sm-0 mb-3">
                                <div class="row">
                                    <div class="col-12 text-uppercase">
                                        <h4>Quick Links</h4>
                                    </div>
                                    <div class="col-12">
                                        <ul class="footer-nav">
                                            @foreach (App\CustomPages::all() as $page)
                                            <li>
                                                
                                                @if ($page->type == 1)
                                                    <a href="{{ URL::to('page/'.$page->slug) }}">{{ $page->name }}</a>
                                                @endif
                                                
                                            </li>
                                            @endforeach
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-3 col-4 mr-auto mb-sm-0 mb-3">
                                <div class="row">
                                    <div class="col-12 text-uppercase text-underline">
                                        <h4>Help</h4>
                                    </div>
                                    <div class="col-12">
                                        <ul class="footer-nav">
                                            @foreach (App\CustomPages::all() as $page)
                                            <li>
                                                
                                                @if ($page->type == 2)
                                                    <a href="{{ URL::to('page/'.$page->slug) }}">{{ $page->name }}</a>
                                                @endif
                                                
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 text-center text-sm-left">
                                <div class="row">
                                    <div class="col-12 text-uppercase">
                                        <h4>Get Updates</h4>
                                    </div>
                                    <div class="col-12">
                                        <form action="{{ URL::to('subscriber/store') }}" method="POST" class="was-validated">
                                            @csrf
                                            
                                            <div class="form-group">
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter your email..." required>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-outline-light text-uppercase">Subscribe</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>

                        <div class="text-center mt-4">
                            <p class="text-uppercase">Developed by <a href="https://www.facebook.com/abdulmajidweb" class="text-info" target="_blank">Abdul Majid</a></p>
                        </div>

                    </div>
                </footer>
                <!-- Footer -->
            </div>
        </div>

    </div>

    @include('frontend.partials.scripts')

</body>
</html>