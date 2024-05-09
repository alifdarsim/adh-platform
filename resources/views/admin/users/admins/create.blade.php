@extends('layouts.admin.main')
@section('content')

    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">  <a class="back" href="javascript:history.back()"><i
                            class="fa-solid fa-arrow-left me-2 fs-4"></i></a>Create New Admin/Member</h3>
                <div class="nk-block-des text-soft">
                    <p>Invite new Admin that will help manage AsiaDealHub system.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="nk-block">
        @if (!auth()->user()->isAdmin())
            <div class="alert alert-warning">
                <div class="alert-cta flex-wrap flex-md-nowrap">
                    <div class="alert-text mr-3">
                        <p><strong>Warning!</strong> You are not authorized to perform this action.</p>
                        <p>Only 'Super Admin' can invite new ADH member (admin) user.</p> </div>
                    <div class="alert-actions">
                        <a href="{{route('admin.admins.index')}}" class="btn btn-lg btn-primary">Back to Admins</a>
                    </div>
                </div>
            </div>
        @else
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="preview-block"><span class="preview-title-lg overline-title">New User Information</span>
                        <div class="row gy-4 pt-2">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="first_name">First Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="first_name" placeholder="Eg: John">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="last_name">Last Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="last_name" placeholder="Eg: Doe">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email Address</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="email"
                                               placeholder="Eg: johndoe@asiadealhub.com">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label" for="role">Role</label>
                                    <div class="form-control-wrap">
                                        <select class="form-select js-select2" id="role">
                                            <option value="member">ADH Member</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-5">
                                <div class="form-group">
                                    <div class="custom-control custom-control-xs custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="terms">
                                        <label class="custom-control-label" for="terms">I'm aware that this user will
                                            have permission to modified and access certain resources on AsiaDealHub
                                            website.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-2">
                                <div class="form-group">
                                    <a onclick="registerAdmin()" class="btn btn-primary tw-px-24">Register Admin User</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection

@push('scripts')
    <script>
        function registerAdmin() {

            Swal.fire({
                title: 'Invite new Admin Role?',
                html: `You are about to invite a new admin user <br>Email: ${$('#email').val() || 'Not set'}<br>Confirm to proceed?`,
                icon: 'info', showCancelButton: true,
                confirmButtonText: 'Yes, register it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{route('admin.admins.store')}}",
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            "name": $('#first_name').val() + " " + $('#last_name').val(),
                            "email": $('#email').val(),
                            "role": $('#role').val(),
                            "terms": $('#terms').is(":checked"),
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            if (data.success) {
                                Swal.fire(
                                    'Registered!',
                                    'New admin user has been registered. Make sure to inform the user about to check their email for setting the password',
                                    'success'
                                ).then(() => window.open("{{route('admin.admins.index')}}", "_self"));
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr);
                            Swal.fire(
                                'Error!',
                                xhr.responseJSON.message,
                                'error'
                            )
                        }
                    });

                }
            })
        }

    </script>
@endpush
