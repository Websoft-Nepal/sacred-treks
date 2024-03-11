@extends('layouts.app')
@section('page-title', 'Social Media')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Social Media Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Social Media</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Social Media list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Social Media</h6>
            </div>
            <div class="card-body">
                <form action="{{route('admin.social.update',$social->id)}}" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="youtube" class="form-label">Youtube</label>
                        <input type="text" name="youtube" value="{{$social->youtube}}"  class="form-control" id="youtube"
                            aria-describedby="textHelp">
                    </div>  
                    <div class="mb-3">
                        <label for="facebook" class="form-label">Facebook</label>
                        <input type="text" name="facebook" value="{{$social->facebook}}" class="form-control" id="facebook"
                            aria-describedby="textHelp">
                    </div>  
                    <div class="mb-3">
                        <label for="instagram" class="form-label">Instagram</label>
                        <input type="text" name="instagram" value="{{$social->instagram}}" class="form-control" id="instagram"
                            aria-describedby="textHelp">
                    </div>   
                    <div class="mb-3">
                        <label for="twitter" class="form-label">Twitter</label>
                        <input type="text" name="twitter" value="{{$social->twitter}}" class="form-control" id="twitter"
                            aria-describedby="textHelp">
                    </div>   
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
