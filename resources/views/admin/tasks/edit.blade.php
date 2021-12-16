@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if ($errors->storetask->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->storetask->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{route('admin.checklists.tasks.update',[$task->checklist_id,$task] )}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-header">{{ __('Edit tasl') }}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">{{__('Name')}}</label>
                                            <input class="form-control" value="{{$task->name}}" name="name"
                                                   type="text" >
                                        </div>
                                        <div class="form-group">
                                            <label for="name">{{__('Description')}}</label>
                                            <textarea class="form-control" name="description" id="task-textarea">  {{$task->description}} </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-primary" type="submit">{{ __('Save') }}</button>
                            </div>
                        </form>
                    </div>
                                   </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        ClassicEditor
            .create( document.querySelector('#task-textarea') )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
