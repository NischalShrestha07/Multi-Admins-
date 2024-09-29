@extends('teacher.layout')
@section('customCss')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">

<link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
{{-- problem --}}
@endsection
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="text-dark">Change Password</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="col-md-8">

                    <div class="card card-primary shadow-lg">
                        <div class="card-header">
                            <h3 class="card-title">Update Password</h3>
                        </div>

                        <div class="card-body">
                            {{-- Success Notification --}}
                            @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                            @endif

                            {{-- Error Notification --}}
                            @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                            @endif

                            <form action="{{ route('teacher.updatePassword') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="oldPassword">Old Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="oldPassword" id="oldPassword"
                                            placeholder="Enter Old Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                    </div>
                                    @error('oldPassword')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="newPassword" id="newPassword"
                                            placeholder="Enter New Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                    </div>
                                    @error('newPassword')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="confirmPassword"
                                            id="confirmPassword" placeholder="Confirm New Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                    </div>
                                    @error('confirmPassword')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary btn-lg">Change Password</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>

</div>@endsection
@section(' customJs') <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>


<script>
    $(function () {
    bsCustomFileInput.init();
  });
@endsection