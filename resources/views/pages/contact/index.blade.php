@extends('layouts.app')
@section('page-title', 'Contact')
@section('main-section')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div>
            <h4 class="page-title text-left">Contact Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Contact</a>
                </li>
                <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Contact list</a></li>

            </ol>
        </div>
        @include('notify::components.notify')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contact</h6>
            </div>
            <div class="card-body">
                <form action="{{route('admin.contact.update',$contact->id)}}" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" value="{{$contact->phone}}"  class="form-control" id="youtube"
                            aria-describedby="textHelp">
                    </div>
                    @error('phone')
                        {{$message}}
                    @enderror
                    <div class="mb-3">
                        <label for="fax" class="form-label">Fax</label>
                        <input type="text" name="fax" value="{{$contact->fax}}" class="form-control" id="facebook"
                            aria-describedby="textHelp">
                    </div>
                    @error('fax')
                        {{$message}}
                    @enderror
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" value="{{$contact->email}}" class="form-control" id="instagram"
                            aria-describedby="textHelp">
                    </div>
                    @error('email')
                        {{$message}}
                    @enderror

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
