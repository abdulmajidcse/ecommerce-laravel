@extends('frontend.layouts.app')

@section('title')
    {{ $custom_page->name }}
@endsection

@section('content')

            <div class="col-12">
                <!-- Main Content -->
                <main class="container">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-info">{{ $custom_page->name }}</h3>
                        </div>
                        <div class="card-body">
                            @if ($custom_page->image)
                                <img src="{{ URL::to($custom_page->image) }}" class="img-fluid img-thumbnail" style="width: 400px;" alt="">
                            @endif
                            <p>{!! $custom_page->content !!}</p>
                        </div>
                    </div>
                </main>
                <!-- Main Content -->
            </div>

@endsection