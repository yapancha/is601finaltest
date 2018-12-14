@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header "><h3>Answer</h3></div>
                    <div class="card-body">
                        <strong>{{$answer->body}}</strong>
                    </div>

                    @if(Auth::user()->id === $answer->user->id)

                    <div class="card-footer">
                        {{ Form::open(['method'  => 'DELETE', 'route' => ['answers.destroy', $question, $answer->id]])}}
                        <button class="btn btn-danger float-right mr-2" value="submit" type="submit" id="submit">Delete
                        </button>
                        {!! Form::close() !!}
                        <a class="btn btn-primary float-right" href="{{ route('answers.edit',['question_id'=> $question, 'answer_id'=> $answer->id, ])}}">
                            Edit Answer
                        </a>
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <strong>Comments</strong>
                                <a class="btn btn-primary float-right"
                                   href="{{ route('comments.create', ['question_id'=> $question, 'answer_id'=> $answer->id])}}">
                                    Add Comment
                                </a>
                        </div>


                    @forelse($answer->comments as $comment)
                        <div class="card-header">
                            <div class="card-body text-muted">
                                <strong>{{$comment->body}}</strong>
                                @if($comment->user->profile)
                                    <div class="text-muted">
                                     By: {{$comment->user->profile->fname}}
                                    </div>
                                @else
                                    <div class="text-muted">
                                        By: User profile not created
                                    </div>
                                @endif
                                @if(Auth::user()->id === $comment->user->id)
                                    {{ Form::open(['method'  => 'DELETE', 'route' => ['answers.destroy', $question, $answer->id]])}}
                                    <button class="btn btn-danger float-right mr-2" value="submit" type="submit" id="submit">Delete
                                    </button>
                                    {!! Form::close() !!}
                                    <a class="btn btn-primary float-right" href="{{ route('answers.edit',['question_id'=> $question, 'answer_id'=> $answer->id, ])}}">
                                        Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        No comments.
                    @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection