<?php

namespace App\Http\Controllers;

use App\Models\WikiAf5Meetings;
use App\Models\User;
use App\Models\WikiAf5Priorities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WikiAf5MeetingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $meetings = WikiAf5Meetings::query()
            ->orderBy('subjects','ASC')
            ->when($request->term, function ($query, $term ){
                $query->where('subjects','LIKE','%' . $term . '%');})
            ->with('users')
            ->paginate(10)
            ->withQueryString()
            ->sortBy('name');

        return Inertia::render('Meetings/Index', [
       
            'meetings' =>  $meetings,
            'paginator' =>WikiAf5Meetings::paginate(10)
          
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $users = User::where('user_type_id', 1)->get();
        $priorities = WikiAf5Priorities::all();
        
        return Inertia::render('Meetings/MeetingForm')->with('priorities', $priorities)->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate(
            [   
                'date' => 'required',
                'subjects' => 'required',
                'description' => 'required',
                'owner_id' => 'required',
                'priority_id' => 'required'
            ]
        );

        WikiAf5Meetings::create($request->all());

        return Redirect::route('meetings')->with('success', '¡Reunión creada correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WikiAf5Meetings  $wikiAf5Meetings
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        if (isset($request['meeting']) && $request['meeting']) {

            $meeting_id = $request['meeting'];
            $meeting = WikiAf5Meetings::find($meeting_id);

            if (isset($meeting->id)){

                $owner_id = $meeting->owner_id;
                $owner = User::where('id', $owner_id)->get();
                $priority_id = $meeting->priority_id;
                $priority = WikiAf5Priorities::where('id', $priority_id)->get();

                return Inertia::render('Meetings/Show', ['meeting' =>  $meeting, 'priority' => $priority, 'owner' => $owner]);
            }
        } 
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WikiAf5Meetings  $wikiAf5Meetings
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (isset($request['meeting']) && $request['meeting']) {

            $meeting_id = $request['meeting'];
            $meeting = WikiAf5Meetings::find($meeting_id);

            if (isset($meeting->id)){

                $owners = User::where('user_type_id', 1)->get();
                $priorities = WikiAf5Priorities::all();

                return Inertia::render('Meetings/MeetingEditForm', ['meeting' =>  $meeting, 'priorities' => $priorities, 'owners' => $owners]);
            }
        } 
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WikiAf5Meetings  $wikiAf5Meetings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (isset($request['meeting']) && $request['meeting']) {

            $meeting_id = $request['meeting'];
            $meeting = WikiAf5Meetings::find($meeting_id);

            if (isset($meeting->id)){

                $meeting->update($request->all());

                return Redirect::route('meetings')->with('success', '¡Reunión editada correctamente!');
            }
        } 
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WikiAf5Meetings  $wikiAf5Meetings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (isset($request['meeting']) && $request['meeting']) {

            $meeting_id = $request['meeting'];
            $meeting = WikiAf5Meetings::find($meeting_id);

            if (isset($meeting->id)){

                $meeting->delete();

                return redirect()->back()->with('success', 'Reunión borrada correctamente');
            }
        } 
        abort(404);        
    }
}
