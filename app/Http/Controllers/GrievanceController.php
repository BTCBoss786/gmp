<?php

namespace App\Http\Controllers;

use App\Models\Grievance;
use App\Models\Officer;
use App\Models\Student;
use Illuminate\Http\Request;

class GrievanceController extends Controller
{
    function add() {
        return view('grievance.add');
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'enrolment' => 'required|numeric|digits:6',
            'message' => 'required',
            'subject' => 'required'
        ]);
        $student_id = Student::where('enrolment_no', $request->enrolment)->first()->id ?? null;
        if (!$student_id) {
            $student = new Student();
            $student->name = $request->name;
            $student->enrolment_no = $request->enrolment;
            $student->save();
            $student_id = $student->id;
        }
        $grievance = new Grievance();
        $grievance->token = date('Ymd') . (Grievance::all()->last()->id ?? 0);
        $grievance->message = $request->message;
        $grievance->student_id = $student_id;
        $grievance->subject_id = $request->subject;
        $grievance->save();
        return back()->with('grievance_token', $grievance->token);
    }

    function track() {
        return view('grievance.track');
    }

    function show(Request $request) {
        $request->validate([
            'token' => 'required|numeric|min:9'
        ]);
        $grievance = Grievance::with(['student', 'subject'])->where('token', '=', $request->token)->first();
        if ($grievance)
            return back()->with('record', $grievance);
        return back()->withErrors(['token' => 'Invalid token entered']);
    }

    function pending() {
        if (session()->has('user') && session()->get('user')->admin)
            $grievances = Grievance::where('status', 'Pending')->paginate(5);
        else
            $grievances = Grievance::where('status', 'Pending')->where('subject_id', Officer::find(session()->get('user')->id)->subject_id)->paginate(5);
        return view('grievance.pending', ['grievances' => $grievances]);
    }

    function reply($token) {
        $grievances = Grievance::with(['student', 'subject', 'officer'])->where('token', '=', $token)->get();
        return view('grievance.reply', ['grievances' => $grievances]);
    }

    function replied(Request $request) {
        $request->validate([
            'reply' => 'required'
        ]);
        $grievance = Grievance::find($request->id);
        $grievance->reply = $request->reply;
        $grievance->officer_id = session()->get('user')->id;
        $grievance->status = 'Resolved';
        $grievance->save();
        return redirect()->route('grievance.pending')->with('status', 'Grievance Resolved Successfully!!!');
    }

    function resolve() {
        if (session()->has('user') && !session()->get('user')->admin)
            $grievances = Grievance::with(['officer' => fn($q) => $q->withTrashed(), 'subject', 'student'])->where('status', 'Resolved')->where('subject_id', Officer::find(session()->get('user')->id)->subject_id)->paginate(5);
        else
            $grievances = Grievance::with(['officer' => fn($q) => $q->withTrashed(), 'subject', 'student'])->where('status', 'Resolved')->paginate(5);
        return view('grievance.resolve', ['grievances' => $grievances]);
    }

    function report() {
        $grievances = Grievance::where('status', 'Reported')->paginate(5);
        return view('grievance.report', ['grievances' => $grievances]);
    }
}
