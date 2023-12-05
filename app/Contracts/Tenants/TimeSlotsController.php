<?php

namespace App\Contracts\Tenants;

use Carbon\Carbon;
use App\Models\TimeSlot;
use Carbon\CarbonPeriod;
use App\Helpers\Constant;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Tenants\ApplicantSlotsResourceCollection;

class TimeSlotsController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->interviewer_id) return $this->failedResponse("Interviewer id is required.");

        $slots = [];
        $user_id = $request->interviewer_id;

        $dates = TimeSlot::where('user_id', $user_id)
            ->groupBy('date')
            ->when($request->from_date, function ($query) {
                $query->whereBetween('date', [request()->input('start_date'), request()->input('end_date')]);
            })
            ->when(!$request->from_date, function ($query) {
                $carbon_start = Carbon::now()->startOfWeek()->format('Y-m-d');
                $carbon_end = Carbon::now()->endOfWeek()->format('Y-m-d');
                $query->whereBetween('date', [$carbon_start, $carbon_end]);
            })
            ->orderBy('date', 'ASC')
            ->pluck('date');

        foreach ($dates as $date) {
            $slots[$date] = TimeSlot::where('user_id', $user_id)->where('date', $date)->select('start_time', 'end_time', 'status')->get();
        }

        return $this->successResponse("User time slots", $slots);
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'start_time' => 'required|array',
                'end_time' => 'required|array',
                'dates' => 'required|array',
                'interviewer_id' => 'required|exists:users,id'
            ]);

            $user_id = $request->interviewer_id;
            foreach ($request->dates as $key => $date) {
                TimeSlot::where('date', $date)->where('user_id', $user_id)->where('status', Constant::SLOT_AVAILABLE)->delete();
                foreach ($request->start_time[$date] as $key2 => $start_time) {
                    TimeSlot::create([
                        'date' => $date,
                        'user_id' => $user_id,
                        'start_time' => $start_time,
                        'end_time' => $request->end_time[$date][$key2],
                    ]);
                }
            }

            DB::commit();
            return $this->okResponse("Time slots added successfully");
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->failedResponse($th->getMessage());
        }
    }


    public function getSlots(Request $request)
    {

        $validator = Validator::make($request->input(), [
            'from_date' => 'required|date|date_format:Y-m-d',
            'to_date' => 'required|date|date_format:Y-m-d|after:from_date'
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors()->first());
        }

        // $settings = Setting::first();

        // if (!$settings)
        //     return $this->failedResponse(__("settings.Please ask admin to add start & end time in settings"));

        $office_start_time = "10:00";
        $office_end_time = "19:00";

        // $from_date = Carbon::now()->startOfWeek()->format('Y-m-d');
        // $to_date = Carbon::now()->endOfWeek()->format('Y-m-d');
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $booked_slots = TimeSlot::where('status', Constant::SLOT_BOOKED)
            ->whereBetween('date', [$from_date, $to_date])
            ->where('user_id', Auth::user()->id)
            ->select('start_time', 'end_time', 'date')
            ->get();

        $booked_dates = [];
        foreach ($booked_slots as $date) {
            $booked_dates[$date->date->format('dmY')][] = date('H:i', strtotime($date->start_time)) . "-" . date('H:i', strtotime($date->end_time));
        }

        $time_range = collect(CarbonInterval::minutes(30)->toPeriod($office_start_time, $office_end_time))->map->format('H:i');
        $dates = CarbonPeriod::create($from_date, $to_date);


        return $this->successResponse("Success", [
            'dates' => $dates,
            'time_range' => $time_range,
            'booked_dates' => $booked_dates
        ]);
    }

    public function getTrainerSlots(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'interviewer_id' => 'required|exists:users,id',
            'date' => 'required|date|date_format:Y-m-d'
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors()->first());
        }

        $slots = TimeSlot::with(['applicantSlots:id,slot_id,user_id'])->where('user_id', $request->interviewer_id)
            ->where('status', Constant::SLOT_AVAILABLE)
            ->where('date', $request->date)
            ->get();

        $slots = new ApplicantSlotsResourceCollection($slots);

        return $this->successResponse("Applicant Slots", $slots);
    }

    public function getFilteredSlots(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $slots = [];

        $user_id = $request->user_id;
        $dates = TimeSlot::where('user_id', $user_id)
            ->whereBetween('date', [$from_date, $to_date])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->pluck('date');

        foreach ($dates as $date) {
            $slots[$date->format('d-m-Y')] = TimeSlot::where('user_id', $user_id)->where('date', $date)->select('start_time', 'end_time', 'status')->get();
        }

        return $this->successResponse("Success", $slots);
    }

    public function removeTimeSlot(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'time_slot_id' => 'required|exists:time_slots,id'
        ]);

        if ($validator->fails()) {
            return $this->failedResponse($validator->errors()->first());
        }
    }
}
