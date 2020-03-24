@extends('admin.layouts.app')

@section('title')
    {{ 'All slider' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Slider</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="contentWrapper">
                                <div class="card">
                                    <div class="card-header text-primary">All slider</div>

                                    <div class="card-body">
                                        <!--all product table-->
                                        <table class="table table-hover table-striped table-bordered table-responsive-lg" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($sliders) < 1)
                                                <tr>
                                                    <td colspan="3"><p class="text-center text-danger"><em>No slider</em></p></td>
                                                </tr>
                                                @else
                                                @foreach($sliders as $slider)
                                                <tr>
                                                    <td>
                                                        {{ $loop->index + 1 }}
                                                    </td>
                                                    <td>
                                                        <img src="{{ url($slider->image) }}" style="height: 100px;">
                                                    </td>
                                                    <td>
                                                        <a id="delete" href="{{ URL::to('/admin/sliders/delete/'.$slider->id) }}" class="btn btn-sm btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table><!--end of all product table-->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!--end of content row-->

                </div>
                <!-- Begin Page Content -->

@endsection