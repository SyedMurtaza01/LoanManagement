@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4>Data Table</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title">User Edit</h4>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary"><i class="mdi mdi-arrow-left"></i> Back</a>
            </div>
            <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Left Column (Profile Image & Status) -->
                    <div class="col-md-4">
                        <!-- Profile Image Section -->
                        <div class="mb-3 text-center">
                            <label for="profile" class="form-label">Profile Image <small>(Optional)</small></label>
                            <div class="d-flex justify-content-center align-items-center">
                                <!-- Profile Image Upload with Dropify -->
                                <input type="file" class="dropify" name="profile" id="profile"
                                    data-default-file="{{ $user->profile ? asset('user/profile/' . $user->profile) : asset('default-image.webp') }}"
                                    data-max-file-size="3M" />
                            </div>
                            @error('profile')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status Section -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control" id="type">
                                <option value="" disabled>Select Status</option>
                                <option value="approved" {{ $user->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="rejected" {{ $user->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column (Other Inputs) -->
                    <div class="col-md-8">
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Role -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" class="form-control">
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="number" id="number" value="{{ $user->number }}">
                                    @error('number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" value="{{ $user->address }}">
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Branch -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="branch" class="form-label">Branch</label>
                                    <input type="text" class="form-control" name="branch" id="branch" value="{{ $user->branch }}">
                                    @error('branch')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

            <!-- Dropify Initialization -->
            <script>
                $(document).ready(function() {
                    // Initialize Dropify for file input
                    $('.dropify').dropify({
                        tpl: {
                            loader: '<div class="dropify-loader"></div>',
                            message: '<div class="dropify-message text-center"><p>Drag and drop a file here or click</p></div>',
                            preview: `
                    <div class="dropify-preview">
                        <span class="dropify-render">
                            <img src="{{ asset('default-image.webp') }}" class="rounded-circle dropify-image" style="width: 100px; height: 100px; object-fit: cover;" alt="Profile Image">
                        </span>
                    </div>`,
                            clearButton: '', // Hide clear button
                        }
                    });

                    // Ensure the image remains circular
                    $('.dropify-preview img').addClass('rounded-circle');
                    $('.dropify-preview img').css({
                        'width': '100px',
                        'height': '100px',
                        'object-fit': 'cover',
                    });

                    // Additional styling for the dropify input field to make it circular
                    $('.dropify-wrapper').css({
                        'border-radius': '50%',
                        'width': '100px',
                        'height': '100px',
                        'overflow': 'hidden',
                        'border': '2px solid #ccc',
                    });

                    $('.dropify').css({
                        'width': '100px',
                        'height': '100px',
                        'padding': '0',
                    });

                    // Hide the message after an image is selected
                    $('.dropify-wrapper .dropify-message').css({
                        'display': 'none',
                    });
                });
            </script>

            <!-- Custom Styles for Dropify -->
            <style>
                .dropify-wrapper .dropify-preview img {
                    border-radius: 50% !important;
                    width: 100px !important;
                    height: 100px !important;
                    object-fit: cover !important;
                }

                .dropify-wrapper {
                    border-radius: 50%;
                    width: 100px;
                    height: 100px;
                    overflow: hidden;
                    border: 2px solid #ccc;
                }

                .dropify {
                    width: 100px;
                    height: 100px;
                    padding: 0;
                }

                .dropify-wrapper .dropify-message {
                    display: none;
                }
            </style>

        </div>
    </div>
</div>
@endsection