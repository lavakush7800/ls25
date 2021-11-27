<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Brand</div>
                        <div class="card-body">
                            <form action="{{ url('brand/update/'.$brands->id) }}" method="POST" enctype='multipart/form-data'>
                                <div class="form-group">
                                    <label for="brand_name">Update Brand Name</label>
                                    <input type="text" class="form-control" name="brand_name" id="brand_name" value="{{ $brands->brand_name }}">
                                    @error('brand_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brand_image">Update Brand image</label>
                                    <input type="file" class="form-control" name="brand_image" id="brand_image" value="{{ $brands->brand_image }}">
                                    <input type="hidden" class="form-control" name="old_image" value="{{ $brands->brand_image }}">
                                    @error('brand_image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <img src="{{ asset($brands->brand_image) }}" style="width:400px; height:200px;">
                                </div>
                                @csrf
                                <button type="submit" class="btn btn-primary">Update Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
