@extends('layouts.admin.main')
@section('content')

    <x-content_header title="Create New Admin" subtitle="Invite new admin user that will manage AsiaDealHub system."/>

    <div class="nk-block">
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="preview-block"><span class="preview-title-lg overline-title">Default Preview</span>
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
                                        <option value="default_option">Admin</option>
                                        <option value="option_select_name">Moderator</option>
                                        <option value="option_select_name">Super Admin</option>
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
                                    'New admin user has been registered.',
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
