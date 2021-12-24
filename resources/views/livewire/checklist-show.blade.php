<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{$checklist->name}}
            </div>
            <div class="card-body">
                <table class="table">

                    @foreach($checklist->tasks as $task)
                        <tr>
                            <td><input type="radio" wire:click="complete_task({{$task->id}})"> </td>
                            <td wire:click="toggle_task({{$task->id}})">
                                {{$task->name}}
                            </td>
                            <td wire:click="toggle_task({{$task->id}})">
                                @if (in_array($task->id,$open_tasks))
                                    <svg id="task-caret-top-{{$task->id}}" class="c-icon">
                                        <use
                                            xlink:href=" {{asset('vendors/@coreui/icons/svg/free.svg#cil-caret-top')}}"></use>
                                    </svg>
                                @else
                                    <svg id="task-caret-bottom-{{$task->id}}" class="c-icon">
                                        <use
                                            xlink:href=" {{asset('vendors/@coreui/icons/svg/free.svg#cil-caret-bottom')}}"></use>
                                    </svg>
                                @endif
                            </td>
                        </tr>
                        @if (in_array($task->id,$open_tasks))
                            <tr>
                                <td></td>
                                <td colspan="2">
                                    {!! $task->description!!}
                                </td>
                            </tr>
                        @endif
                    @endforeach

                </table>
            </div>
        </div>
    </div>
</div>
