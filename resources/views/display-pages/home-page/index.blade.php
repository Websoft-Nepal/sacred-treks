@extends('layouts.app')
@section('page-title', 'Home Page')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div>
            <h4 class="page-title text-left">Home Page</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Home Page</a></li>

            </ol>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Home Page</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.page.home.update', $home->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="heading" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Heading</label>
                        <input type="text" name="heading" class="form-control" value="{{ $home->heading }}"
                            id="heading" aria-describedby="textHelp">
                    </div>
                    @error('heading')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="subheading" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            subheading</label>
                        <textarea class="form-control" name="subheading" id="subheading" rows="3">{{$home->subheading}}</textarea>

                    </div>
                    @error('subheading')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror



                    @if ($home->headimg1 != null)
                        <div class="my-3">
                            <label for="headimg1" class="form-label">Current Heading Image 1</label>
                            <div>
                                <a href="{{ asset($home->headimg1) }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset($home->headimg1) }}" class="img-fluid" width="400px" alt="tour headimg1"
                                        srcset="">
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="image" class="form-label">
                            <span class="text-danger h3"><sup>*</sup></span>Image</label>
                        <input type="file" class="form-control" name="headimg1" id="image">
                    </div>

                    @error('headimg1')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    @if ($home->headimg2 != null)
                        <div class="my-3">
                            <label for="image" class="form-label">Current Heading Image 2</label>
                            <div>
                                <a href="{{ asset($home->headimg2) }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset($home->headimg2) }}" class="img-fluid" width="400px"
                                        alt="blog image" srcset="">
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="headimg2" class="form-label"><span class="text-danger h3"><sup>*</sup></span>Heading Image 2</label>
                        <input type="file" class="form-control" name="headimg2" id="headimg2">
                        @error('headimg2')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    @if ($home->bookimg != null)
                        <div class="my-3">
                            <label for="bookimg" class="form-label">Current Book Image</label>
                            <div>
                                <a href="{{ asset($home->bookimg) }}" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset($home->bookimg) }}" class="img-fluid" width="400px"
                                        alt="blog bookimg" srcset="">
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="bookimg" class="form-label"><span class="text-danger h3"><sup>*</sup></span>Book Image</label>
                        <input type="file" class="form-control" name="bookimg" id="bookimg">
                        @error('bookimg')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="gallery_title" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Gallery Title</label>
                        <input type="text" name="gallery_title" class="form-control" value="{{ $home->gallery_title }}"
                            id="gallery_title" aria-describedby="textHelp" placeholder="5 days">
                    </div>
                    @error('gallery_title')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="trekking_title" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Trekking Title</label>
                        <input type="text" name="trekking_title" class="form-control" value="{{ $home->trekking_title }}"
                            id="trekking_title" aria-describedby="textHelp">
                    </div>
                    @error('trekking_title')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="trekking_slogan" class="form-label"><span class="text-danger h3"><sup>*</sup></span>Trekking Slogan</label>
                        <textarea class="form-control" name="trekking_slogan" id="trekking_slogan" rows="3">{{ $home->trekking_slogan }}</textarea>
                    </div>
                    @error('trekking_slogan')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="tour_title" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Tour Title</label>
                        <input type="text" name="tour_title" class="form-control" value="{{ $home->tour_title }}"
                            id="tour_title" aria-describedby="textHelp">
                    </div>
                    @error('tour_title')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="tour_slogan" class="form-label"><span class="text-danger h3"><sup>*</sup></span>Tour Slogan</label>
                        <textarea class="form-control" name="tour_slogan" id="tour_slogan" rows="3">{{ $home->tour_slogan }}</textarea>
                    </div>
                    @error('tour_slogan')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="feature_title" class="form-label"><span class="text-danger h3"><sup>*</sup></span>
                            Feature Title</label>
                        <input type="text" name="feature_title" class="form-control" value="{{ $home->feature_title }}"
                            id="feature_title" aria-describedby="textHelp">
                    </div>
                    @error('feature_title')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="mb-3">
                        <label for="footer" class="form-label"><span class="text-danger h3"><sup>*</sup></span>Footer</label>
                        <textarea class="form-control" name="footer" id="editor" rows="3">{{ $home->footer }}</textarea>
                    </div>
                    @error('footer')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@push('scriptaddon')
    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .catch( error => {
    console.error( error );
    } );
    ClassicEditor
    .create( document.querySelector( '#description' ) )
    .catch( error => {
    console.error( error );
    } );
@endpush
