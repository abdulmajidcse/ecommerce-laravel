                    <!-- Slider -->
                    <div class="col-12 px-0">
                        <div id="slider" class="carousel slide w-100" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach($sliders as $slider)
                                <li data-target="#slider" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner" role="listbox">
                                @foreach($sliders as $slider)
                                <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                                    <img src="{{ url($slider->image) }}" class="slider-img">
                                </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <!-- Slider -->