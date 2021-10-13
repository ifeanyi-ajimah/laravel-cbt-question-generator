<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Option;
use App\Http\Resources\QuestionResource;
use App\Http\Requests\StoreQuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
        

        $cat_id = $request->category_id;
        
        $questions = Question::when( $request->category_id   , function($query, $cat_id){
            $query->where('questioncategory_id', $cat_id );
        })->paginate(15);

        

        return QuestionResource::collection( $questions );
    }

  
    public function store(StoreQuestionRequest $request)
    {   
        $validated = $request->validated();

        $question = Question::create([
            'title' => $validated['title'],
            'questioncategory_id' => $validated['questioncategory_id'],
        ]);

        $option = Option::create([
            'question_id' => $question->id,
            'option_a' => $validated['option_a'],
            'option_b' => $validated['option_b'],
            'option_c' => $validated['option_c'],
            'option_d' => $validated['option_d'],
        ]);
        
        return new QuestionResource( $question );
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        return new QuestionResource( $question );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
    
        $question = Question::find($id);
        $question->update([
            'title' => $request['title'],
            'questioncategory_id' => $request['questioncategory_id'],
        ]);

        $option = Option::where('question_id',$id)->first();
        $option->update([
            'question_id' => $question->id,
            'option_a' => $request['option']['option_a'],
            'option_b' => $request['option']['option_b'],
            'option_c' => $request['option']['option_c'],
            'option_d' => $request['option']['option_d'],
        ]);

        return new QuestionResource( $question );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
    public function destroy($id)
    {
        $option = Option::where('question_id',$id )->first();
        $option->delete();
        $question = Question::find($id);
        $question->delete();
        return response()->noContent();

    }
}

