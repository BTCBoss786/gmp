<?php

namespace App\Http\Controllers;

use App\Models\Grievance;
use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OfficerController extends Controller
{
    function login() {
        return view('officer.login');
    }

    function check(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4|max:16'
        ]);
        $officer = Officer::withTrashed()->where('email', '=', strtolower($request->email))->first();
        if ($officer && $officer->trashed())
            return back()->withErrors('Account Deactivated - Contact Admin');
        if (!$officer || !Hash::check($request->password, $officer->password))
            return back()->withErrors('Invalid email or password');
        session()->put('user', $officer);
        return redirect()->route('officer.dashboard');
    }

    function dashboard() {
        $grievances = Grievance::all();
        if (session()->has('user') && !session()->get('user')->admin) {
            $subject_id = Officer::find(session()->get('user')->id)->subject_id;
            $grievances = Grievance::where('subject_id', $subject_id)->get();
        }
        $total = $grievances->count();
        $pending = $grievances->where('status', '=', 'Pending')->count();
        $resolve = $grievances->where('status', '=', 'Resolved')->count();
        $report = $grievances->where('status', '=','Reported')->count();
        return view('officer.dashboard', ['total' => $total, 'pending' => $pending, 'resolve' => $resolve, 'report' => $report]);
    }

    function add() {
        return view('officer.add');
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:officers',
            'password' => 'required|min:4|max:16',
            'subject' => 'required'
        ]);
        $officer = new Officer();
        $officer->name = $request->name;
        $officer->email = strtolower($request->email);
        $officer->password = Hash::make($request->password);
        $officer->subject_id = $request->subject;
        $officer->save();
        return back()->with('officer_added', $officer->id);
    }

    function manage() {
        $officers = Officer::with(['subject', 'grievances'])->withTrashed()->where('admin', 0)->paginate(5);
        return view('officer.manage', ['officers' => $officers]);
    }

    function status(Request $request) {
        $request->validate([
            'id' => 'required'
        ]);
        $officer = Officer::withTrashed()->find($request->id);
        if (!$officer->trashed())
            $status = $officer->delete();
        else
            $status = $officer->restore();
        return back()->with('officer_status', $status);
    }

    function profile() {
        $officer = Officer::find(session()->get('user')->id);
        return view('officer.profile', ['officer' => $officer]);
    }

    function edit(Request $request) {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'old_password' => 'nullable|min:4|max:16',
            'password' => 'nullable|min:4|max:16',
        ]);
        $officer = Officer::find(session()->get('user')->id);
        $officer->name = $request->name;
        if ($request->old_password && $request->password) {
            if (Hash::check($request->old_password, $officer->password))
                $officer->password = Hash::make($request->password);
            else
                return back()->withErrors("Old password not matched");
        }
        $officer->save();
        return back()->with('officer_updated', $officer);
    }

    function logout() {
        if (session()->has('user'))
            session()->forget('user');
        return redirect()->route('officer.login');
    }
}
