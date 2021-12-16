@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if ($errors->storechecklist->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->storechecklist->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form
                            action="{{route('admin.checklist_groups.checklists.update',[$checklistGroup,$checklist])}}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-header">{{ __('Edit checklists') }} </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">{{__('Name')}}</label>
                                            <input class="form-control" value="{{$checklist->name}}" name="name"
                                                   type="text"
                                                   placeholder="{{__('Checklist name')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-primary" type="submit">{{ __('Save Checklist') }}</button>
                            </div>
                        </form>
                    </div>
                    <form action="{{route('admin.checklist_groups.checklists.destroy',[$checklistGroup,$checklist])}}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit"
                                onclick="return confirm('{{__('Are you sure?')}}')">
                            {{ __('Delete this Checklist') }}
                        </button>
                    </form>
                    <hr>
                    <div class="card">
                        <div class="card-header"> {{__('List of Tasks')}}</div>
                        <div class="card-body">
                            <table class="table table-responsive-sm">
                                <tbody>
                                @foreach($checklist->tasks  as $task)
                                    <tr>
                                        <td>{{$task->name}}</td>
                                        <td>{{$task->description}}</td>
                                        <td>

                                            <a class="btn btn-sm btn-primary" type="submit" href="{{route('admin.checklists.tasks.edit',[$checklist,$task])}}">Edit</a>
                                            <form style="display: inline-block"
                                                  action="{{route('admin.checklists.tasks.destroy',[$checklist,$task])}}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                        onclick="return confirm('{{__('Are you sure?')}}')">
                                                    {{ __('Delete Task') }}
                                                </button>
                                            </form>
                                          </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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

                        <form action="{{route('admin.checklists.tasks.store',[$checklist])}}" method="POST">
                            @csrf
                            <div class="card-header">{{ __('New Task') }} </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="name">{{__('Name')}}</label>
                                            <input class="form-control" name="name" type="text" value="{{old('name')}}"
                                                   placeholder="{{__('Task name')}}" {{old('description')}}>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">{{__('Description')}}</label>
                                            <textarea class="form-control" name="description"
                                                      rows="5"> {{old('description')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-sm btn-primary" type="submit">{{ __('Save Task') }}</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection