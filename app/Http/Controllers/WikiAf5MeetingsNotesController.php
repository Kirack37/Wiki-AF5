<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5MeetingsNotes;
use App\Models\WikiAf5Meetings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WikiAf5MeetingsNotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, Request $request)
    {
        $meetings = WikiAf5Meetings::where('id', $id)->get();
        $notes = WikiAf5MeetingsNotes::where('meeting_id' , $id)
                ->orderBy('created_at', 'asc')
                ->when($request->term, function ($query, $term ){
                    $query->where('subjects','LIKE','%' . $term . '%');})
                ->with('users')
                ->with('meetings')
                ->paginate(10)
                ->withQueryString()
                ->sortBy('name');

        return Inertia::render('MeetingsNotes/Index', [
            'meetings' => $meetings,
            'notes' =>  $notes,
            'paginator' =>WikiAf5MeetingsNotes::paginate(10)
      
     ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {   
        $user_id = Auth::id();
        $meetings = WikiAf5Meetings::where('id', $id)->get();

        return Inertia::render('MeetingsNotes/NoteForm', ['meetings' => $meetings, 'user_id' => $user_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $request->validate(
            [   
                'subjects' => 'required',
                'notes' => 'required',
            ]
        );

        WikiAf5MeetingsNotes::create($request->all());

        return Redirect::route('note.index', $id)->with('success', '¡Nota de reunión creada correctamente!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5MeetingsNotes  $wikiAf5MeetingsNotes
     * @return \Illuminate\Http\Response
     */
    public function show(WikiAf5MeetingsNotes $wikiAf5MeetingsNotes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5MeetingsNotes  $wikiAf5MeetingsNotes
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $user_id = Auth::id();
        $meeting = WikiAf5Meetings::where('id', $id)->get();
        
        if (isset($request['note']) && $request['note']) {
            $note_id = $request['note'];
            $note = WikiAf5MeetingsNotes::find($note_id);

            if (isset($note->id)){
                
                return Inertia::render('MeetingsNotes/NoteEditForm', ['meeting' =>  $meeting, 'note' => $note, 'user_id' => $user_id]);
            }
        } 
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5MeetingsNotes  $wikiAf5MeetingsNotes
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        if (isset($request['note']) && $request['note']) {
            $note_id = $request['note'];
            $note = WikiAf5MeetingsNotes::find($note_id);
            if (isset($note->id)){
                $note->update($request->all());
                return Redirect::route('note.index', $id)->with('success', '¡Nota de reunión editada correctamente!');
            }
        } 
        abort(404);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5MeetingsNotes  $wikiAf5MeetingsNotes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if (isset($request['note']) && $request['note']) {
            $note_id = $request['note'];
            $note = WikiAf5MeetingsNotes::find($note_id);
            if (isset($note->id)){
                $note->delete();
                return redirect()->back()->with('success', 'Nota de reunión borrada correctamente');
            }
        } 
        abort(404);        
    }
}
