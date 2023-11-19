<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\Reports\GenerateReportRequest;
use App\Services\ReportsService;

class Reports extends Controller
{

	public function __construct() {

		$this->middleware('UserRole:payments_show', [
			'only' => ['index', 'generate'],
		]);
	}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        return view('reports.index', compact('data'));
    }


    /**
     * Display a listing of the resource.
     */

    public function generate(ReportsService $service, GenerateReportRequest $request)
    {
        $from = $request->from;
        $to = $request->to;
        $data = $service->generate($request);
        return view('reports.index', compact('data', 'from', 'to'));
    }

}
