<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\leaverequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

class AdminController extends Controller
{
    public function adminHome()
    {
        return view('admin.adminHome');
    }
    public function viewrecords()
    {
        $users = User::where('is_admin', 0)->get();
        return view('user.viewallrecords', compact('users'));
    }
    public function deleteuser($id)
    {
        $user = User::find($id);
        $user->delete();
        Storage::delete('public/profile_image/' . $user->profile_image);

        return redirect()->route('admin');
    }

    // Attendance
    public function viewattendance()
    {
        $users = User::where('is_admin', 0)->get();
        return view('admin.viewattendance', compact('users'));
    }
    public function viewattendanceuser($id)
    {
        $attendancedata = Attendance::where('user', $id)->get();
        $users = User::where('is_admin', 0)->get();

        return view('admin.viewattendanceuser', compact('attendancedata', 'users', 'id'));
    }
    public function addattendanceuser($userid)
    {
        return view('admin.addattendance', compact('userid'));
    }
    public function addattendanceusercreate(Request $request)
    {
        $yesterday = Carbon::yesterday()->toDateString();
        $request->validate([
            'date' => 'required|date|after:yesterday',
            'attendance' => 'required',
        ]);
        $attendance = Attendance::where('user', $request->id)->get()->count();
        $date = $request->date;

        if ($attendance) {
            $date1 = Attendance::where('user', $request->id)->latest()->first()->date;
            if ($date1 !== $date) {

                Attendance::create([
                    'user' => $request->id,
                    'attendance' => $request->attendance,
                    'date' => $request->date
                ]);
                return redirect()->route('admin.viewattendanceuser', $request->id)->with('success', 'Attendance Marked...!');
            } else {
                return redirect()->route('admin.viewattendanceuser', $request->id)->with('success', 'Attendance of this Date Already Marked...!');
            }
        } else {
            Attendance::create([
                'user' => $request->id,
                'attendance' => $request->attendance,
                'date' => $request->date
            ]);
            return redirect()->route('admin.viewattendanceuser', $request->id)->with('success', 'Attendance Marked...!');
        }
    }
    public function viewattendanceuseredit($id)
    {
        $attendancedata = Attendance::find($id);
        return view('admin.editattendanceuser', compact('attendancedata'));
    }
    public function viewattendanceuserupdate(Request $request, $id)
    {
        $request->validate([
            'attendance' => 'required',
        ]);
        $attendancedata = Attendance::find($id);
        $attendancedata->attendance = $request->attendance;
        $attendancedata->save();

        return redirect()->route('admin.viewattendanceuser', $attendancedata->user);
    }
    public function viewattendanceuserdelete($id)
    {
        Attendance::find($id)->delete();
        return redirect()->back();
    }

    // Generate PDF Specific User
    public function pdfgeneratereport()
    {
        $users = User::where('is_admin', 0)->get();

        return view('admin.pdfgeneratereport', compact('users'));
    }

    public function pdfgeneratereportuser(Request $request)
    {
        $user =  User::where('id', $request->user)->first();
        $attendance = Attendance::whereBetween('date', [$request->fromdate, $request->todate])->get();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_specific_user_data_to_html($user, $attendance));
        return $pdf->stream();
    }

    public function convert_specific_user_data_to_html($user, $attendance)
    {
        $output = '<h3 align="center">' . $user->name . 'Data</h3>
        <table e width="100%" style="border-collapse: collapse; border: 0px;">
        <tr>
            <th style="border: 1px solid; padding:12px;" width="20%">User</th>
            <th style="border: 1px solid; padding:12px;" width="20%">Attendance</th>
            <th style="border: 1px solid; padding:12px;" width="20%">Date</th>
        </tr>
        ';
        foreach ($attendance as $item) {
            $output .= '
        <tr>
            <td style="border: 1px solid; padding:12px;">' . $user->name . '</td>
            <td style="border: 1px solid; padding:12px;">' . $item->attendance . '</td>
            <td style="border: 1px solid; padding:12px;">' . $item->date . '</td>
        </tr>';
        }

        $output .= '</table>';
        return $output;
    }

    public function pdfgeneratereportall(Request $request)
    {
        $attendance = Attendance::whereBetween('date', [$request->fromdate, $request->todate])->get();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_data_to_html($attendance));
        return $pdf->stream();
    }
    public function convert_data_to_html($attendance)
    {
        $output = '<h3 align="center"> Student Data</h3>
        <table e width="100%" style="border-collapse: collapse; border: 0px;">
        <tr>
            <th style="border: 1px solid; padding:12px;" width="20%">User</th>
            <th style="border: 1px solid; padding:12px;" width="20%">Attendance</th>
            <th style="border: 1px solid; padding:12px;" width="20%">Date</th>
        </tr>
        ';
        foreach ($attendance as $item) {
            $output .= '
        <tr>
            <td style="border: 1px solid; padding:12px;">' . $item->user . '</td>
            <td style="border: 1px solid; padding:12px;">' . $item->attendance . '</td>
            <td style="border: 1px solid; padding:12px;">' . $item->date . '</td>
        </tr>';
        }

        $output .= '</table>';
        return $output;
    }


    // Leave Module
    public function leavemodule()
    {
        $users = User::where('is_admin', 0)->get();
        $leave = leaverequest::where('approve', 0)->get();
        return view('admin.leavee', compact('leave', 'users'));
    }
    public function attendancedetails(Request $request)
    {
        $attendancedetails = Attendance::where('user', $request->user)->get();
        $attendancepresentcount = Attendance::where('user', $request->user)->where('attendance', 'P')->count();
        $attendanceleavecount = Attendance::where('user', $request->user)->where('attendance', 'L')->count();
        $attendanceabsentcount = Attendance::where('user', $request->user)->where('attendance', 'A')->count();
        $user = User::where('id', $request->user)->first();
        $grading = $attendanceleavecount + $attendanceabsentcount;
        return view('admin.attendancedetails', compact('attendancedetails', 'grading', 'user', 'attendancepresentcount', 'attendanceleavecount', 'attendanceabsentcount'));
    }
    public function attendancedetailsdate()
    {
        dd("attendancedetails");
    }
    public function leaveaccept($id)
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', today())->format('Y-m-d');
        $leaveaccept = leaverequest::find($id);
        $leaveaccept->approve = 1;
        $leaveaccept->save();

        Attendance::create([
            'user' => $leaveaccept->user_id,
            'attendance' => 'L',
            'date' => $date
        ]);

        return redirect()->route('admin.leavemodule');
    }
    public function leavereject($id)
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', today())->format('Y-m-d');

        $leavereject = leaverequest::find($id);
        $leavereject->approve = -1;
        $leavereject->save();

        Attendance::create([
            'user' => $leavereject->user_id,
            'attendance' => 'A',
            'date' => $date
        ]);
        return redirect()->route('admin.leavemodule');
    }
}
