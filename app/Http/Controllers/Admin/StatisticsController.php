<?php

namespace App\Http\Controllers\Admin;

use App\Enum\BranchEnum;
use App\Enum\ReviewReasonEnum;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function statistics($branchId, $monthYear)
    {
        // Разбираем входную строку "01.2015" → месяц и год
        [$month, $year] = explode('.', $monthYear);

        return Review::select([
            'reason_id',
            'rating',
            DB::raw('COUNT(*) as count')
        ])
            ->where('branch_id', $branchId)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy('reason_id', 'rating')
            ->get()
            ->groupBy('reason_id');
    }
}
