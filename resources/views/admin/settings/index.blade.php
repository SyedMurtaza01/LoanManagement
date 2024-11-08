@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <h4>{{ $setting }}</h4>
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{ $setting }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
                    <h4 class="card-title">Update Setting</h4>
                </div>

                <form action="{{ route('admin.setting') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="light_logo" class="form-label">Light Logo </label>
                                <input type="file" class="form-control dropify" name="light_logo" id="light_logo"
                                data-default-file="{{ isset($web_setting->light_logo) ? asset('logos/'.$web_setting->light_logo) : '' }}">
                                @error('light_logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="dark_logo" class="form-label">Dark Logo </label>
                                <input type="file" class="form-control dropify" name="dark_logo" id="dark_logo"
                                data-default-file="{{ isset($web_setting->dark_logo) ? asset('logos/'.$web_setting->dark_logo) : '' }}">
                                @error('dark_logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="footer_logo" class="form-label">Footer Logo </label>
                                <input type="file" class="form-control dropify" name="footer_logo" id="footer_logo"
                                data-default-file="{{ isset($web_setting->footer_logo) ? asset('logos/'.$web_setting->footer_logo) : '' }}">
                                @error('footer_logo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="favicon_icon" class="form-label">Favicon Icon </label>
                                <input type="file" class="form-control dropify" name="favicon_icon" id="favicon_icon"
                                data-default-file="{{ isset($web_setting->favicon_icon) ? asset('logos/'.$web_setting->favicon_icon) : '' }}">
                                @error('favicon_icon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="{{ old('email', $web_setting->email) }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" value="{{ old('address', $web_setting->address) }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Enter Phone Number" value="{{ old('phone_number', $web_setting->phone_number) }}">
                                @error('phone_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="website_title" class="form-label">Website Title</label>
                                <input type="text" class="form-control" name="website_title" id="website_title" placeholder="Enter Website Title" value="{{ old('website_title', $web_setting->website_title) }}">
                                @error('website_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="footer_description" class="form-label">Footer Description</label>
                                <input type="text" class="form-control" name="footer_description" id="footer_description" placeholder="Enter Footer Description" value="{{ old('footer_description', $web_setting->footer_description) }}">
                                @error('footer_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
