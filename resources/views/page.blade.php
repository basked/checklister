@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">{{ $page->title }}</div>
                        <div class="card-body">
                            {!!$page->content!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
