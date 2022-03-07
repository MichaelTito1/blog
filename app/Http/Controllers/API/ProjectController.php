<?php

namespace App\Http\Controllers\API;

use DB;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProjectResource;
use App\Models\Employee;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return response([ 'projects' => ProjectResource::collection($projects), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'cost' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $project = Project::create($data);

        return response(['project' => new ProjectResource($project), 'message' => 'Created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return response(['project' => new ProjectResource($project), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->update($request->all());

        return response(['project' => new ProjectResource($project), 'message' => 'Update successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return response(['message' => 'Deleted']);
    }

    protected function fillTable(){
        $totalSalaries = DB::table('employee')->sum('salary');
        $totalBonus = DB::table('employee')
                        ->sum(DB::raw('salary * bonus_percent'));
        $totalPayments = $totalBonus + $totalSalaries;

        $currentYear = date('Y');
        $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        foreach($months as $month){
            $salaryPaymentDay = self::calculateSalaryPaymentDay($month, (Integer)$currentYear);
            $bonusPaymentDay = self::calculateBonusPaymentDay($month, (Integer)$currentYear);

            $record = new Project;
            $record->month = $month;
            $record->salaries_payment_day = $salaryPaymentDay;
            $record->bonus_payment_day = $bonusPaymentDay;
            $record->salaries_total = $totalSalaries;
            $record->bonus_total = $totalBonus;
            $record->payments_total = $totalPayments;

            $record->save();
        }

        return Response(['message' => 'Months for the year '.$currentYear.' added successfully.'], 201);
    }

    protected function calculateSalaryPaymentDay(String $month, int $currentYear){
        $nmonth = date('m', strtotime($month.' '.$currentYear));
        $lastDayInMonth = cal_days_in_month(CAL_GREGORIAN, $nmonth, $currentYear);
        $day = date('D', strtotime($currentYear.'-'.$nmonth.'-'.$lastDayInMonth));
        echo $day, strcmp($day, "Sat") , " ";
        // echo 
        if( strcmp($day, "Sat") == 0 ){
            return $lastDayInMonth - 1;
        }
        else if( strcmp($day, "Sun") == 0 ){
            return $lastDayInMonth - 2;
        }
        return $lastDayInMonth;
    }

    protected function calculateBonusPaymentDay(String $month, int $currentYear){
        $nmonth = date('m', strtotime($month.' '.$currentYear));
        $day = date('D', strtotime($currentYear.'-'.$nmonth.'-15'));
        echo $day, "\n";
        if( strcmp($day, "Sat") == 0 ){
            return 20;
        }
        else if( strcmp($day, "Sun") == 0 ){
            return 19;
        }
        return 15;
    }

    public function showByMonth(String $month){
        $records = DB::table('projects')
                    ->where('month', '=', $month)
                    ->get();


        return response(['records' => $records, 'message' => 'Retrieved successfully'], 200);
    }
}