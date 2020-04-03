@extends('admin.layouts.app')

@section('title')
    {{ 'All product' }}
@endsection

@section('content')
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Product</h1>
                    <a href="{{ URL::to('/') }}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-alt-circle-right"></i> Go to website</a>
                    </div>

                    <!-- Content Row -->

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="contentWrapper">
                                <div class="card">
                                    <div class="card-header text-primary">All product</div>
                
                                    <div class="form-group m-2">
                                        <input type="text" name="search" placeholder="Type here to search..." class="form-control mt-2" id="liveSearch">
                                    </div>

                                    <div class="card-body">
                                        <!--all product table-->
                                        <table id="liveTable" class="table table-hover table-striped table-bordered table-responsive-lg">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Image</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 0; @endphp
                                                @if(count($product) < 1)
                                                <tr>
                                                    <td colspan="7"><p class="text-center text-danger"><em>No product</em></p></td>
                                                </tr>
                                                @else
                                                @foreach($product as $row)
                                                <tr class="tr">
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $row->title }}</td>
                                                    <td>{{ $row->categories->name }}</td>
                                                    <td>
                                                    @php $j = 1; @endphp
                                                    @foreach($row->productImages as $image)
                                                    @if($j > 0)
                                                        <img src="{{ URL::to($image->name) }}" alt="Product image" style="height: 50px;">
                                                    @endif
                                                    @php $j --; @endphp
                                                    @endforeach
                                                    </td>
                                                    <td>{{ $row->quantity }}</td>
                                                    <td>{{ $row->price }}</td>
                                                    <td>
                                                        <a href="{{ URL::to('/admin/products/edit/'.$row->id) }}" class="btn btn-sm btn-info">Edit</a>
                                                        <a id="delete" href="{{ URL::to('/admin/products/delete/'.$row->id) }}" class="btn btn-sm btn-danger">Delete</a>
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

                    <!--pagination-->
                    <div class="float-right mt-4">
                        {{ $product->links() }}
                    </div>

                </div>
                <!-- Begin Page Content -->

@endsection