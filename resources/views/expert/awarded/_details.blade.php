<div class="tw-col-span-3">
    <div class="tw-flex tw-justify-between">
        <p class="sub-text" style="text-transform: uppercase;"><i class="fa-solid fa-clock fs-11px me-1"></i> POSTED: {{ formatDate($project->published_at) }}</p>
    </div>
    <h6 class="my-3">Project Status: <span class="text-capitalize badge badge-sm bg-info px-3 rounded">{{$project->status}}</span></h6>
    <div class="d-flex mt-2">
        <h4 class="my-0">Project: {{$project->name}}</h4>
    </div>
    <div class="tw-container tw-mx-auto">
        <div class="my-2">
            <p class="tw-text-slate-600 fs-13px">{!! nl2br(e($project->description)) !!}</p>
        </div>
    </div>
{{--    <p class="mb-0 mt-2">Budget: {{$project->budget == null ? 'Undisclosed' : '$' . implode(' - ', $project->budget) . ' USD'}} </p>--}}
    <p class="mb-0 mt-1">Hub Types: <span class="">{{$project->hub->name}}</span></p>
    <p class="mb-0 mt-1">Created By: <a  class="tw-text-blue-500 hover:tw-text-blue-800">{{$project->created_by()->first()->name}}</a></p>
    <p class="mb-0 mt-1">Awarded To: <a  class="tw-text-blue-500 hover:tw-text-blue-800">{{$project->awardedTo->name}}</a></p>
    <div class="tw-flex tw-justify-between mt-1">
        <p class="mb-0">Tags:
            @foreach($project->keywords as $keyword)
                <span class="badge bg-outline-info border-2 tw-rounded-full tw-capitalize fs-12px tw-font-medium px-2 tw-py-0.5">{{$keyword->name}}</span>
            @endforeach</p>
    </div>
    <div class="tw-flex tw-justify-between mt-3">
        <p class="mb-0">Projects ID: #{{$project->pid}}</p>
        <p onclick="reportProject()" class="fs-12px tw-cursor-pointer hover:tw-text-red-700"><i class="fa-solid fa-flag me-1"></i> Report Projects</p>
    </div>
</div>
