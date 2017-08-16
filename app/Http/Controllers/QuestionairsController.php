<?php

namespace App\Http\Controllers;

use App\Question;
use App\Questionair;
use Illuminate\Http\Request;
use Auth;
class QuestionairsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $questions = Questionair::withCount('questions')->get();
        $index = 1;
        return view('questionairs.all', compact('questions','index'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questionairs.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $data = $request->all();
        $data['user_id'] = Auth::id();


        $questionair = Questionair::create($data);

        foreach($request->mani as $ma){


            $questionair->questions()->create($ma)->answers()->createMany($ma['answer']);
        }

        return redirect()->route('questionair.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Questionair  $questionair
     * @return \Illuminate\Http\Response
     */
    public function show(Questionair $questionair)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Questionair  $questionair
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionair $questionair)
    {
        return view('questionairs.edit' , compact('questionair'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Questionair  $questionair
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionair $questionair)
    {
        $questionair->name = $request->name;
        $questionair->duration = $request->duration;
        $questionair->resumeable = $request->resumeable;
        $questionair->type = $request->type;
        $questionair->save();
        return redirect()->back();
       dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Questionair  $questionair
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questionair $questionair)
    {
        $questionair->load('questions.answers');

        $questionair->delete();

        return redirect()->back();
    }
}
