@extends('layouts.app')
@section('page-title', 'Testimonials')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div>
            <h4 class="page-title text-left">Testimonials Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Testimonials</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Testimonials Create</a></li>

            </ol>
        </div>
        {{-- </div> --}}
        <div class="p-1">
            <a href="{{ route('admin.testimonial.index') }}" class="btn btn-primary btn-sm">View</a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add Testimonials</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.testimonial.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label"><span class="text-danger">*</span>Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            aria-describedby="textHelp" value="{{old('name')}}">
                        @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label"><span class="text-danger">*</span>Review</label>
                        <input type="text" name="review" class="form-control" id="review"
                            aria-describedby="textHelp" value="{{old('review')}}">
                        @error('review')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label"><span class="text-danger">*</span>Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        @error('image')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class=" mb-3">
                        <label class="form-label" for="inputGroupSelect01">Status</label>
                        <select class="form-select form-control" name="status" id="inputGroupSelect01">
                            <option selected>Choose...</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    @error('status')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@push('scriptaddon')
CKEDITOR.replace('description');

@endpush
