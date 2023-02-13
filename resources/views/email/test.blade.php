
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            	<div class="card-header">{{ __('Email From Task Scheduler') }}</div>
                <div class="card-body">
                	Succesful Send Url: <a href="{{url($task->task_url)}}">{{$task->task_url}}</a>
                </div>
                <div class="card-body">
                    Status: {{$status}}
                </div>
            </div>
        </div>
    </div>
</div>

