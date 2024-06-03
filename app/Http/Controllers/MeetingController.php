<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    public function index()
    {
        $meetings = Meeting::all();
        return view('meeting.index', compact('meetings'));
    } 

    public function create()
    {
        $employees = Employee::all();
        return view('meeting.create', compact('employees'));
    } 

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'         => 'required|string|max:255',
            'organizer'     => 'required|string|max:255',
            'date'          => 'required|date',
            'start_time'    => 'required|date_format:H:i',
            'end_time'      => 'required|date_format:H:i',
            'participant'   => 'required|array',
            'participant.*' => 'required|string|max:255',
        ]);

        if($validator->passes()){
            // Check for overlapping meetings
            $existingMeeting = Meeting::where('date', $request->date)
                ->where(function($query) use ($request) {
                    $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                        ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                        ->orWhere(function($query) use ($request) {
                            $query->where('start_time', '<=', $request->start_time)
                                    ->where('end_time', '>=', $request->end_time);
                        });
                })
                ->first();

            if ($existingMeeting) {
                return response()->json([
                    'status' => false,
                    'errors' => ['slot' => 'The selected slot is already booked.']
                ]);
            }
            // Convert participants array to a string
            $participants = implode(', ', $request['participant']);

            $meeting               = new Meeting();
            $meeting->title        = $request['title'];
            $meeting->organizer    = $request['organizer'];
            $meeting->date         = $request['date'];
            $meeting->start_time   = $request['start_time'];
            $meeting->end_time     = $request['end_time'];
            $meeting->participants = $participants;
            $meeting->save();
            $request->session()->flash('success','Data added successfully');
            return response()->json([
                'status' => true,
                'message' => 'Data added successfully'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        } 

        

        // Redirect or return a response
        return redirect()->back()->with('success', 'Event created successfully!');
    }
}
