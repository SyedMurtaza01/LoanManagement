@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4>Data Table</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Loan Plan</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title">Loan Edit</h4>
                <a href="{{ route('admin.loans.index') }}" class="btn btn-primary"><i class="mdi mdi-arrow-left"></i> Back</a>
            </div>

            <form action="{{ route('admin.loans.update' , $loan->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $loan->name }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" id="description" value="{{ $loan->description }}">
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="rate" class="form-label">Interest Rate</label>
                            <input type="text" class="form-control" name="rate" id="rate" value="{{ $loan->rate }}">
                            @error('rate')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="month" class="form-label">Duration Months</label>
                            <input type="text" class="form-control" name="month" id="month" value="{{ $loan->month }}">
                            @error('month')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="min_amount" class="form-label">Minimum Amount</label>
                            <input type="text" class="form-control" name="min_amount" id="min_amount" value="{{ $loan->min_amount }}">
                            @error('min_amount')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="max_amount" class="form-label">Maximum Amount</label>
                            <input type="text" class="form-control" name="max_amount" id="max_amount" value="{{ $loan->max_amount }}">
                            @error('max_amount')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control" id="type">
                                <option value="" disabled>Select Status</option>
                                <option value="approved" {{ $loan->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="pending" {{ $loan->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="rejected" {{ $loan->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection