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
                <form action="{{ route('admin.testimonial.update',[$testimonial->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" value="{{ $testimonial->name }}" class="form-control"
                            id="name" aria-describedby="textHelp">
                        @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Review</label>
                        <input type="text" name="review" value="{{ $testimonial->review}}" class="form-control" id="review"
                            aria-describedby="textHelp">
                        @error('review')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-3">
                        <label for="image" class="form-label">Current Image</label>
                        <div>
                            <a href="{{ asset('storage/uploads/testimonials/' . $testimonial->image) }}" target="_blank"
                                rel="noopener noreferrer">
                                <img src="{{ asset('storage/uploads/testimonials/' . $testimonial->image) }}"
                                    class="img-fluid" width="200px" alt="Trekking image" srcset="">
                            </a>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
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
                            <option value="active" @selected($testimonial->status == "active")>Active</option>
                            <option value="inactive" @selected($testimonial->status == "inactive") >Inactive</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{ $testimonial->description }}</textarea>
                        @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@push('scriptaddon')
CKEDITOR.replace('description');

@endpush
