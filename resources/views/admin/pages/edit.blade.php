@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{route('admin.pages.update',[$page] )}}" method="POST">
                            @csrf
                            @method('PUT')
                            @if(session('message'))
                                <div class="alert alert-info">{{session('message')}}</div>
                            @endif
                            <div class="card-header">{{ __('Edit Page') }}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="title">{{__('Title')}}</label>
                                            <input id="title" class="form-control" value="{{$page->title}}"
                                                   name="title"
                                                   type="text">
                                        </div>
                                        <div class="form-group">
                                            <label for="content-textarea">{{__('Content')}}</label>
                                            <textarea class="form-control" name="content"
                                                      id="content-textarea">  {{$page->content}} </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-sm btn-primary" type="submit">{{ __('Save Page') }}</button>
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
            .create(document.querySelector('#content-textarea'), {
                codeBlock: {
                    languages: [
                        // Do not render the CSS class for the plain text code blocks.
                        { language: 'plaintext', label: 'Plain text', class: '' },

                        // Use the "php-code" class for PHP code blocks.
                        { language: 'php', label: 'PHP', class: 'php-code' },

                        // Use the "js" class for JavaScript code blocks.
                        // Note that only the first ("js") class will determine the language of the block when loading data.
                        { language: 'javascript', label: 'JavaScript', class: 'js javascript js-code' },

                        // Python code blocks will have the default "language-python" CSS class.
                        { language: 'python', label: 'Python' }
                    ]
                }
            } )
        .catch(error => {
            console.error(error);
        });
    </script>
@endsection
