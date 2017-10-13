<?php

namespace App\Http\Controllers\Admin\Reports;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class UsersDownloadController extends Controller
{

    /**
     * UsersDownloadController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function __invoke()
    {
        $users = User::latestFirst()->get();
        $total_users = $users->count();

        $title = str_slug("Users report");
        $pdf = PDF::loadView('admin.reports.users', [
            'total_users' => $total_users,
            'users' => $users,
            'date' => Carbon::now()->toDayDateTimeString(),
        ]);
        return $pdf->download("{$title}.pdf");
    }
}
