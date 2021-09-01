<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\leaverequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function markattendance()
    {
        $attendance = Attendance::where('user', auth()->user()->id)->get()->count();
        $date = Carbon::createFromFormat('Y-m-d H:i:s', today())->format('Y-m-d');
        if ($attendance) {
            $date1 = Attendance::where('user', auth()->user()->id)->latest()->first()->date;
            if ($date1 === $date) {
                return redirect()->route('home')->with('success', 'Your Attendance Already Marked For Today...!');
            } else {
                return view('user.markattendance');
            }
        } else {
            return view('user.markattendance');
        }
    }
    public function markedattendance()
    {
        $attendance = Attendance::where('user', auth()->user()->id)->get()->count();
        $date = Carbon::createFromFormat('Y-m-d H:i:s', today())->format('Y-m-d');

        if ($attendance) {
            $date1 = Attendance::where('user', auth()->user()->id)->latest()->first()->date;
            if ($date1 !== $date) {
                Attendance::create([
                    'user' => auth()->user()->id,
                    'attendance' => 'P',
                    'date' => $date
                ]);
                return redirect()->route('home')->with('success', 'Attendance Marked');
            }
            else{
                return redirect()->route('home')->with('success', 'Your Attendance Already Marked For Today...!');
            }
        } else {

            Attendance::create([
                'user' => auth()->user()->id,
                'attendance' => 'P',
                'date' => $date
            ]);
            return redirect()->route('home')->with('success', 'Attendance Marked');
        }
    }
    public function viewattendance()
    {
        $attendance = Attendance::where('user', auth()->user()->id)->get();
        return view('user.viewattendance', compact('attendance'));
    }
    public function leave()
    {
        $leaverequestcount = leaverequest::where('user_id', auth()->user()->id)->get()->count();
        if ($leaverequestcount) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', today())->format('Y-m-d');
            $date1 = leaverequest::where('user_id', auth()->user()->id)->latest()->first()->created_at->toDateString();
            if ($date1 === $date) {
                return redirect()->route('home')->with('success', 'Your Leave Already Send...!');
            } else {
                return view('user.leave');
            }
        } else {
            return view('user.leave');
        }
    }

    public function leaverequest()
    {
        $leaverequestcount = leaverequest::where('user_id', auth()->user()->id)->get()->count();
        if ($leaverequestcount) {

            $date = Carbon::createFromFormat('Y-m-d H:i:s', today())->format('Y-m-d');
            $date1 = leaverequest::where('user_id', auth()->user()->id)->latest()->first()->created_at->toDateString();
            if ($date1 === $date) {
                leaverequest::create([
                    'user_id' => auth()->user()->id,
                    'approve' => '0'
                ]);
                return redirect()->route('home')->with('success', 'Your Leave is Send...!');
            } else {
                return view('user.leave');
            }
        } else {
            leaverequest::create([
                'user_id' => auth()->user()->id,
                'approve' => '0'
            ]);
            return redirect()->route('home')->with('success', 'Your Leave is Send...!');
        }
    }

    public function editprofile()
    {
        return view('user.editprofile');
    }
    public function updateprofile(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'profile_image' => 'image'
        ]);
        if ($request->hasFile('profile_image')) {

            // Get FileName with Extension
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            // Get Just FileName
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get Just Extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            // FileName To Store
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('profile_image')->storeAs('public/profile_image', $filenameToStore);
        }

        $profile = User::find($id);
        $profile->name = $request->name;
        if ($request->hasFile('profile_image')) {
            // Old Image Delete
            Storage::delete('public/profile_image/' . $profile->profile_image);
            // New Image Add
            $profile->profile_image = $filenameToStore;
        }
        $profile->save();
        return redirect()->route('home');
    }
}
