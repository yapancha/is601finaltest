@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Add a Comment</div>
                    <div class="card-body">
                        @if($edit === FALSE)
                            {!! Form::model($comment, ['route' => ['comments.store', $question,$answer], 'method' => 'post']) !!}

                        @else()
                            {!! Form::model($comment, ['route' => ['comments.update', $question, $answer,$comment], 'method' => 'patch']) !!}
                        @endif
                        <div class="form-group">
                            {!! Form::label('body', 'Body') !!}
                            {!! Form::text('body', $comment->body, ['class' => 'form-control','required' => 'required']) !!}
                        </div>
                        <button class="btn btn-success float-right" value="submit" type="submit" id="submit">Save
                        </button>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection