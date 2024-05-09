<div class="nk-footer nk-auth-footer-full tw-bg-gray-900">
    <div class="container wide-lg">
        <div class="row g-3">
            <div class="col-lg-6 order-lg-last">
                <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                    <li class="nav-item dropup">
                        <a class="nav-link tw-text-slate-300" href="{{route('others.terms')}}">{{__('others.terms_conditions')}}</a>
                    </li>
                    <li class="nav-item dropup">
                        <a class="nav-link tw-text-slate-300" href="{{route('others.policy')}}">{{__('others.privacy_policy')}}</a>
                    </li>
                    <li class="nav-item dropup">
                        <a class="dropdown-toggle dropdown-indicator has-indicator nav-link tw-text-slate-300" data-bs-toggle="dropdown" data-offset="0,10"><span>
                                @switch(key(request()->query()) ?? \App::getLocale())
                                    @case('en')
                                        🇺🇸 English
                                        @break
                                    @case('zh')
                                        🇨🇳 中文
                                        @break
                                    @case('ja')
                                        🇯🇵 日本語
                                        @break
                                    @case('ms')
                                        🇲🇾 Bahasa Melayu
                                        @break
                                    @case('ko')
                                        🇰🇷 한국어
                                        @break
                                    @case('id')
                                        🇮🇩 Bahasa Indonesia
                                        @break
                                    @case('th')
                                        🇹🇭 ภาษาไทย
                                        @break
                                    @case('vi')
                                        🇻🇳 Tiếng Việt
                                        @break
                                    @default
                                        🇺🇸 English
                                        @break
                                @endswitch
                            </span></a>
                        <div class="dropdown-menu tw-min-w-[220px] dropdown-menu-end">
                            <ul class="language-list">
                                <li>
                                    <a href="#" class="language-item" data-lang="en">
                                        <span class="language-name">🇺🇸 English</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item" data-lang="zh">
                                        <span class="language-name">🇨🇳 中文</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item" data-lang="ja">
                                        <span class="language-name">🇯🇵 日本語</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item" data-lang="ms">
                                        <span class="language-name">🇲🇾 Bahasa Melayu</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item" data-lang="ko">
                                        <span class="language-name"> 🇰🇷 한국어</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item" data-lang="id">
                                        <span class="language-name"> 🇮🇩 Bahasa Indonesia</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item" data-lang="th">
                                        <span class="language-name"> 🇹🇭 ภาษาไทย</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item" data-lang="vi">
                                        <span class="language-name"> 🇻🇳 Tiếng Việt</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="nk-block-content text-center text-lg-left">
                    <p class="tw-text-slate-300 dropup">&copy; 2023 - {{date('Y')}} | Asia Deal Hub Pte Ltd. {{__('others.all_right_reserved')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        let lang_key = '{{key(request()->query())}}'
        let lang = lang_key ? lang_key : 'en';
        $(document).ready(function () {
            $('.language-item').on('click', function (e) {
                e.preventDefault();
                let lang = $(this).data('lang');
                document.cookie = `language=${lang};path=/`;
                location.reload();
            });
        });
    </script>
@endpush
