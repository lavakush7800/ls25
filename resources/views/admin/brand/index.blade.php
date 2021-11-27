<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brand
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    @endif
                        <div class="card-header">All Brand</div>

                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">SL No</th>
                            <th scope="col">Brand Name</th>
                            <th scope="col">Brand Image</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- @php($i = 1) -->
                            @foreach($brands as $brand)
                            <tr>
                            <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                            <td>{{ $brand->brand_name }}</td>
                            <td><img src="{{ asset($brand->brand_image) }}" style="height:40px; width:70px;"></td>
                            <td>
                                @if($brand->created_at == NULL)  
                            <span class="text-danger">NO Date Set</span>  
                            @else
                            {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                            @endif</td>

                            <td>
                                <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <a href="{{ url('brand/delete/'.$brand->id) }}" onclick="return confirm('Are you sureto delete')" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        {{ $brands->links() }}
                   </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Brand</div>
                        <div class="card-body">
                            <form action="{{ route('store.brand') }}" method="POST" enctype='multipart/form-data'>
                                <div class="form-group">
                                    <label for="brand_name">Brand Name</label>
                                    <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Enter brand name">
                                    @error('brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brand_image">Brand Image</label>
                                    <input type="file" class="form-control" name="brand_image" id="brand_image" placeholder="Enter brand image">
                                    @error('brand_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @csrf
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
