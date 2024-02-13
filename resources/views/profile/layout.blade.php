<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
    <div class="card-inner-group" data-simplebar>
        <div class="card-inner">
            <div class="user-card user-card-s2">
                <div class="tw-relative">
                    <div class="tw-w-40 tw-h-40">
                        <img alt="profile" class="tw-w-40 tw-h-40 object-fit-cover tw-rounded-full" src="{{auth()->user()->avatar()}}" />
                    </div>
                    <div class="user-action tw-absolute -tw-bottom-0 tw-end-1">
                        <div class="dropdown">
                            <a class="btn btn-icon tw-bg-slate-100 tw-rounded-full btn-trigger me-n2" data-bs-toggle="dropdown"><em class="icon ni ni-camera"></em></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <ul class="link-list-opt no-bdr">
                                    <li><a onclick="uploadAvatar()" class="clickable"><em class="icon ni ni-camera-fill"></em><span>Change Photo</span></a></li>
                                    <input type="file" id="avatar" class="tw-hidden form-control">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user-info">
                    <div class="badge badge-dim bg-primary rounded-pill ucap">{{auth()->user()->role}}</div>
                    <h5>{{auth()->user()->name}}</h5>
                    <span class="sub-text">{{auth()->user()->email}}</span>
                </div>
            </div>
        </div>
        <div class="card-inner">
            <div class="user-account-info py-0">
                <div class="row g-3">
                    <div class="col-6"><span class="sub-text">Last Login:</span>
                        <span>{{auth()->user()->lastLoginAt()->timezone(session('timezone'))->format('j M Y h:i A')}}</span>
                    </div>
                    <div class="col-6"><span class="sub-text">Register At:</span>
                        <span>{{auth()->user()->created_at->timezone(session('timezone'))->format('j M Y h:i A')}}</span>
                    </div>
                </div>
            </div>
        </div><!-- .card-inner -->
        <div class="card-inner p-0 pb-5">
            <ul class="link-list-menu">
                <li><a class="{!! (Request::url() == route('profile.index')) ? 'active' : '' !!}" href="{{route('profile.index')}}"><em class="icon ni ni-user-fill-c"></em><span>Personal Infomation</span></a></li>
                <li><a class="{!! (Request::url() == route('profile.activity')) ? 'active' : '' !!}" href="{{route('profile.activity')}}"><em class="icon ni ni-activity-round-fill"></em><span>Account Activity</span></a></li>
                <li><a class="{!! (Request::url() == route('profile.security')) ? 'active' : '' !!}" href="{{route('profile.security')}}"><em class="icon ni ni-lock-alt-fill"></em><span>Security Settings</span></a></li>
                <li><a class="{!! (Request::url() == route('profile.social')) ? 'active' : '' !!}" href="{{route('profile.social')}}"><em class="icon ni ni-grid-add-fill-c"></em><span>Connected with Social</span></a></li>
            </ul>
        </div><!-- .card-inner -->
    </div><!-- .card-inner-group -->
</div><!-- card-aside -->

@push('scripts')
    <script>
        function uploadAvatar() {
            $('#avatar').trigger('click');
        }
        $('#avatar').change(function () {
            //get the file type
            var fileType = $(this).prop('files')[0].type;
            //allow only valid image file types
            if (fileType !== 'image/jpg' && fileType !== 'image/jpeg' && fileType !== 'image/png') {
                _Swal.error('Invalid file type. Only jpg, jpeg and png image types are allowed.');
                return;
            }
            Swal.fire(
                {
                    title: 'Change profile image?',
                    text: "Confirm to change your profile image to the new image?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Change it!',
                    cancelButtonText: 'No, keep it'
                }
            ).then((result) => {
                if (result.isConfirmed) {
                    uploadImage();
                }
            });
        });

        function uploadImage(){
            let formData = new FormData();
            formData.append('image', $('#avatar').prop('files')[0]);
            formData.append('_token', '{{ csrf_token() }}');
            $.ajax({
                url: '{{route('profile.upload')}}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    _Swal.success(response.message, 'Success', function () {
                        location.reload();
                    });
                }
            });
        }
    </script>
@endpush
