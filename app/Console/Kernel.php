<?php

namespace App\Console;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\LeaveRequest;
use App\Models\Salary;
use App\Models\WorkingDay;
use Carbon\Carbon;
use CreateSalariesTable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // DB::table('recent_users')->delete();

            //retrieve all holiday at current month

            $currentYear = date('Y',strtotime(Carbon::now()));
            $currentMonth = date('m',strtotime(Carbon::now()));
            $currentDay = date('Y-m-d',strtotime(Carbon::now()));
            $holidayMonth = Holiday::where('year',$currentYear)->where('month',$currentMonth)->first();
            $allLeaves = LeaveRequest::where('status','Accept')->where('from','<=',$currentDay)->where('to','>=',$currentDay)->get();

            $flag = false;
            //give attendacne based on holiday
            if($holidayMonth != null){
                foreach ($holidayMonth->holidayDetails as $holiday) {
                    if($holiday->date == date('Y-m-d',strtotime(Carbon::now()))){
                        $employees = Employee::where('status','Active')->get();
                        foreach ($employees as $employee) {
                            $flag = true;
                            Attendance::insert([
                                'employee_id' => $employee->id,
                                'date_time' => Carbon::now(),
                                'ip' => request()->getClientIp(),
                                'status' => 'Holiday',
                            ]);
                        }
                    }
                }
            }
            //give attendance based on leave
            if(!$flag){
                if($allLeaves != null){
                    foreach ($allLeaves as $leave) {
                        $from = Carbon::parse($leave->from);
                        $to = Carbon::parse($leave->to);
                        $totalDay = $to->diffInDays($from) + 1;
                        for ($i=0; $i <$totalDay ; $i++) {
                            if($from->format('Y-m-d') == Carbon::now()->format('Y-m-d')){
                                Attendance::insert([
                                    'employee_id' => $leave->employee_id,
                                    'date_time' => Carbon::now(),
                                    'ip' => request()->getClientIp(),
                                    'status' => 'Leave',
                                ]);
                                $from->addDay(1);
                            }
                        }
                    }
                }
            }


        })->daily();

        //if office time is over then gibe abse who are not present today
        $schedule->call(function () {
                $todayAttendances = Attendance::whereDate('date_time',Carbon::today())->get();
                $employees = Employee::where('status','Active')->get();
                foreach ($employees as $employee) {
                    $flag1 = false;
                    foreach ($todayAttendances as $todayAttendance) {
                        if($todayAttendance->employee_id == $employee->id){
                            $flag1 = true;
                        }
                    }
                    if(!$flag1){
                        Attendance::insert([
                            'employee_id' => $employee->id,
                            'date_time' => Carbon::now(),
                            'ip' => request()->getClientIp(),
                            'status' => 'Absent',
                        ]);
                    }
                }

                //salary calculate everyday at last hour(office time)
                $salaries = Salary::with('workingday')->whereYear('date',Carbon::now()->format('Y'))->whereMonth('date',Carbon::now()->format('m'))->get();

                $employees = Employee::where('status','Active')->get();

                foreach ($employees as $employee) {
                    $flag2 = false;

                    $currentMonthWorkingInfo = WorkingDay::where('year',Carbon::now()->format('Y'))->where('month',Carbon::now()->format('m'))->first();


                    if ($currentMonthWorkingInfo !=  null) {
                        $perDaySalary = round($employee->salary/$currentMonthWorkingInfo->total_day,2);

                    $currentMonthTotalDay = Attendance::where('employee_id',$employee->id)->whereYear('date_time',Carbon::now()->format('Y'))->whereMonth('date_time',Carbon::now()->format('m'))->count();
                    // dd($currentMonthTotalDay);
                    $currentMonthTotalAbsent = Attendance::where('employee_id',$employee->id)->whereYear('date_time',Carbon::now()->format('Y'))->whereMonth('date_time',Carbon::now()->format('m'))->where('status','Absent')->count();
                    $currentMonthTotalPresent = Attendance::where('employee_id',$employee->id)->whereYear('date_time',Carbon::now()->format('Y'))->whereMonth('date_time',Carbon::now()->format('m'))
                                                    ->where(function($query){
                                                        return $query->where('status','Present')
                                                        ->orWhere('status','Holiday')
                                                        ->orWhere('status','Leave');
                                                    })->count();



                    foreach ($salaries as $salary) {
                        if($salary->employee_id == $employee->id && Carbon::parse($salary->date)->format('Y-m') == Carbon::now()->format('Y-m')){
                            $flag2 = true;

                            Salary::where('employee_id',$employee->id)->whereYear('date',Carbon::now()->format('Y'))->whereMonth('date',Carbon::now()->format('m'))->update([
                                'total_present' => $currentMonthTotalPresent,
                                'total_absent' => $currentMonthTotalAbsent,
                                'payable_salary' => round($perDaySalary * $currentMonthTotalPresent,2),
                                'punishment' => round($perDaySalary * $currentMonthTotalAbsent),
                            ]);

                        }
                    }

                    if(!$flag2){
                        //new entry insert
                        Salary::insert([
                            'employee_id' => $employee->id,
                            'working_day_id' => $currentMonthWorkingInfo->id,
                            'date' => Carbon::now(),
                            'basic_salary' => $employee->salary,
                            'per_day_salary' => $perDaySalary,
                            'total_present' => $currentMonthTotalPresent,
                            'total_absent' => $currentMonthTotalAbsent,
                            'payable_salary' => round($perDaySalary * $currentMonthTotalPresent,2),
                            'punishment' => round($perDaySalary * $currentMonthTotalAbsent),
                            'created_at' => Carbon::now()
                        ]);
                    }
                    }
                }



        })->dailyAt('17:00')->days([Schedule::SUNDAY,Schedule::MONDAY,Schedule::TUESDAY,Schedule::WEDNESDAY, Schedule::THURSDAY]);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}