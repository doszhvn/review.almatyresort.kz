<?php

namespace App\Http\Controllers\Admin;

use App\Enum\BranchEnum;
use App\Enum\ReviewReasonEnum;
use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewForm;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function review_list($branch_slug)
    {
        $branch_id = BranchEnum::getId($branch_slug);
        $reviews = Review::where('branch_id', $branch_id)->paginate(10);
        $reasons = ReviewReasonEnum::toArray();
        return view('admin.review_list',compact('reviews','reasons'));
    }

    public function director_reports($branch_slug)
    {
        $branch_id = BranchEnum::getId($branch_slug);
        $reports = ReviewForm::with('from_review')
            ->whereHas('from_review', function ($query) use ($branch_id) {
                $query->where('branch_id', $branch_id);
            })->paginate(10);
        return view('admin.director_reports', compact('reports'));
    }
    public function statistics($branch_slug)
    {
        $branch_id = BranchEnum::getId($branch_slug);
        $reports = ReviewForm::with('from_review')
            ->whereHas('from_review', function ($query) use ($branch_id) {
                $query->where('branch_id', $branch_id);
            })->paginate(10);
        return view('admin.director_reports', compact('reports'));
    }
}
