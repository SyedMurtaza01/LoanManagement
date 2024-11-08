@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <h4>Blogs</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="card-title">Blogs Create</h4>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary"><i class="mdi mdi-arrow-left"></i> Back</a>
                </div>

                <form action="{{ route('admin.blogs.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="image" class="form-label">Blog Image <small>(Optional)</small></label>
                                <input type="file" class="form-control dropify" name="image" id="image" >
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter blog title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type" class="form-label" >Video Or Description</label>
                                <select name="type" class="form-control" id="type">
                                    <option value="" selected disabled>Select Video Or Description</option>
                                    <option value="1">Video</option>
                                    <option value="2">Description</option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6" id="youtube_input_div" style="display:none;">
                            <div class="mb-3">
                                <label for="youtube_link" class="form-label">Add Youtube Video Link</label>
                                <input type="text" class="form-control" name="youtube_link" id="youtube_link" placeholder="Enter Youtube Link">
                                @error('youtube_link')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6" id="description_input_div" style="display:none;">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description">
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" class="form-control">
                                    <option value="" selected disabled>Select Blog Type</option>
                                    <option value="1">News</option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-6" style="margin-top:45px " >
                            <div class="mb-3">

                                <input type="checkbox" class="form-check-control" name="letest" id="letest">
                                <label for="letest" class="form-label">Keep Latest</label>
                                @error('letest')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
$(document).ready(function() {

    $('#type').on('change', function() {

        var selectedValue = $(this).val();

        if (selectedValue == '1') {
            $('#youtube_input_div').show();
            $('#description_input_div').hide();
        } else if (selectedValue == '2') {
            $('#description_input_div').show();
            $('#youtube_input_div').hide();
        } else {
            $('#youtube_input_div').hide();
            $('#description_input_div').hide();
        }
    });
});
</script>
@endsection

