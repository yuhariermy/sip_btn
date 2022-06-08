@extends('layouts.app')

@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Profile</h5>
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item">
            <a href="{{ route('profile.index') }}" class="text-muted">Profile</a>
        </li>
    </ul>
@endsection

@section('content')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Profile</h3>
                </div>
            </div>
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Error!</strong> Ada beberapa masalah dengan masukan Anda.<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-15">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Nama Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap" value="{{ old('name', $user->name) }}" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Username
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Username" value="{{ old('username', $user->username) }}" name="username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Email
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" placeholder="Masukkan Email" value="{{ old('email', $user->email) }}" name="email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Password
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-9">
                                <input type="password" class="form-control" placeholder="Masukkan Password" value="{{ old('password') }}" name="password">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Role
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-9">
                                <select class="form-control select2 satuan" style="width: 100%;" id="is_role" name="is_role">
                                    <option value="">-- Silahkan Pilih Role --</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Staff</option>
                                    <option value="3">Opr Change Management a.k.a CMT</option>
                                    <option value="4">Quality Assurance a.k.a QA</option>
                                    <option value="5">IT Security</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="form-group row wrappar_attachment">
                            <label class="col-lg-3 col-form-label">Tanda Tangan
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-9">
                                <input type="file" accept="image/*" class="form-control attachment" placeholder="Masukkan Thumbnail" value="{{ old('thumbnail') }}" name="thumbnail">
                                <span class="form-text text-muted mt-2">Tipe File : Jpg/Jpeg/Png, Ukuran File Max : 2MB</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary float-right mb-4">Update Profile</button>
                </div>
            </form>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
@endsection
