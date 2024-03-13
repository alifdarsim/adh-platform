@php
    $current_status = $project->status;

    $project_status = [
        ["status" => "pending", "stat" => "Pending", "color" => "primary", "text" => "Approve created project"],
        ["status" => "shortlisting", "stat" => "Shortlisting", "color" => "primary", "text" => "Expert Shortlisting and Invitation"],
        ["status" => "selection", "stat" => "Selection", "color" => "primary", "text" => "Expert Selection"],
        ["status" => "discussion", "stat" => "Discussion", "color" => "primary", "text" => "Discussion Agreement (Contract, Milestones, and Payment)"],
        ["status" => "in_progress", "stat" => "In Progress", "color" => "primary", "text" => "Project In Progress"],
        ["status" => "closed", "stat" => "Closed", "color" => "primary", "text" => "Closing and Payment"],
    ];
    // if $project->status = $project_status['status'], then add the class cross to the text
@endphp
<div class="card card-bordered card-preview mb-2">
    <div class="card-inner p-0">
        <div id="accordion" class="accordion">
            <div class="accordion-item">
                <a href="#" class="accordion-head" data-bs-toggle="collapse" data-bs-target="#accordion-item-1">
                    <h6 class="title">
                        <span class="fs-15px">Current Status :</span>
                        Approve created project
                    </h6>
                    <span class="accordion-icon"></span>
                </a>
                <div class="accordion-body collapse" id="accordion-item-1" data-bs-parent="#accordion">
                    <div class="accordion-inner pb-0">
                        <div class="timeline">
                            <ul class="timeline-list">
                                @foreach($project_status as $status)
                                    <li class="timeline-item pb-3">
                                        <div class="timeline-status bg-{{$status['color']}} is-outline"></div>
                                        <div class="timeline-date w-100">
                                            <p class="fs-14px fw normal tw-text-slate-700 tw-line-through">{{$status['text']}}</p>
                                        </div>
                                    </li>
{{--                                    <li class="timeline-item pb-3">--}}
{{--                                        <div class="timeline-status bg-{{$status['color']}} is-outline"></div>--}}
{{--                                        <div class="timeline-date w-100">--}}
{{--                                            <p class="fs-14px fw normal tw-text-slate-700">{{$status['text']}}</p>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
                                @endforeach
                            </ul>
                        </div>
{{--                        <p class="tw-underline">--}}
{{--                            <i class="fa-sharp fa-solid fa-circle-1"></i>--}}
{{--                            Approve created project--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            <i class="fa-sharp fa-solid fa-circle-2"></i>--}}
{{--                            Expert Shortlisting and Invitation--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            <i class="fa-sharp fa-solid fa-circle-3"></i>--}}
{{--                            Expert Selection--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            <i class="fa-sharp fa-solid fa-circle-4"></i>--}}
{{--                            Discussion Agreement (Contract, Milestones, and Payment)--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            <i class="fa-sharp fa-solid fa-circle-5"></i>--}}
{{--                            Project In Progress--}}
{{--                        </p>--}}
{{--                        <p>--}}
{{--                            <i class="fa-sharp fa-solid fa-circle-6"></i>--}}
{{--                            Closing and Payment--}}
{{--                        </p>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<script>--}}
{{--    $('.collapse').collapse()--}}
{{--</script>--}}
