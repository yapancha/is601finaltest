<?php

namespace App\Http\Controllers;
use Auth;
use App\Comment;
use App\Answer;
use App\Question;
use DemeterChain\C;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($question, $answer)
    {

        $comment = new Comment;
        $edit = FALSE;
        return view('commentForm', ['comment' => $comment,'edit' => $edit, 'question' =>$question, 'answer' => $answer  ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $question, $answer)
    {
        $input = $request->validate([
            'body' => 'required|min:5',
        ], [
            'body.required' => 'Body is required',
            'body.min' => 'Body must be at least 5 characters',
        ]);
        $input = request()->all();
        $question = Question::find($question);
        $answer = Answer::find($answer);

        $comment = new Comment($input);

        $comment->user()->associate(Auth::user());
        $comment->question()->associate($question);
        $comment->answer()->associate($answer);
        $comment->save();
        return redirect()->route('answers.show',['question_id' => $question, 'answer_id' => $answer->id])->with('message', 'Saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($question, $answer, $comment)
    {
        $comment = Comment::find($comment);
        $edit = TRUE;
        return view('commentForm',['comment' => $comment,'edit' => $edit, 'question' =>$question, 'answer' => $answer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $question, $answer, $comment)
    {
        $input = $request->validate([
            'body' => 'required|min:5',
        ], [
            'body.required' => 'Body is required',
            'body.min' => 'Body must be at least 5 characters',
        ]);

        $comment = Comment::find($comment);
        $comment->body = $request->body;
        $comment->save();
        return redirect()->route('answers.show',['question_id' => $question, 'answer_id' => $answer])->with('message', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($question, $answer,$comment)
    {
        $question = Question::find($question);
        $answer = Answer::find($answer);
        $comment = Comment::find($comment);

        $comment->delete();
        return redirect()->route('answers.show',['question_id' => $question, 'answer_id' => $answer->id])->with('message', 'Delete');
    }
}
