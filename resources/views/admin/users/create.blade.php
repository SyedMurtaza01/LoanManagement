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
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title">User Create</h4>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary"><i class="mdi mdi-arrow-left"></i> Back</a>
            </div>

            <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Left Column (Profile Image & Status) -->
                    <div class="col-md-4">
                        <!-- Profile Image Section -->
                        <div class="mb-3 text-center">
                            <label for="profile" class="form-label">Profile Image <small>(Optional)</small></label>
                            <div class="d-flex justify-content-center">
                                <input type="file" class="form-control-file" name="profile" id="profile" onchange="previewImage()" style="display: none;">
                                <label for="profile" class="d-flex justify-content-center align-items-center">
                                    <img id="profile-preview"
                                        src="{{ old('profile') ? asset('user/profile/' . old('profile')) : asset('default-profile.jpg') }}"
                                        class="rounded-circle border"
                                        alt="Profile Image"
                                        width="100" height="100" style="object-fit: cover;">
                                </label>
                            </div>
                            @error('profile')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Status Section -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control" id="type">
                                <option value="" selected disabled>Select Status</option>
                                <option value="approved">Approved</option>
                                <option value="pending">Pending</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column (Remaining Inputs) -->
                    <div class="col-md-8">
                        <div class="row">
                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
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
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
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
                                    <input type="text" class="form-control" name="number" id="number" placeholder="Enter Phone Number">
                                    @error('number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address">
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Branch -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="branch" class="form-label">Branch</label>
                                    <select name="branch" id="branch" class="form-control">
                                        <option value="" disabled>Select Branch</option> <!-- Placeholder option -->
                                        @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}">
                                            {{ $branch->name }}
                                        </option>

                                        @endforeach
                                    </select>
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Function to preview selected profile image
        function previewImage() {
            const file = document.getElementById('profile').files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('profile-preview').src = e.target.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

</div>
@endsection