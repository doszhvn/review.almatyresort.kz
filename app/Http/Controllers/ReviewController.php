<?php

namespace App\Http\Controllers;

use App\Enum\BranchEnum;
use App\Enum\ReviewReasonEnum;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\ReviewForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{

    public function index($branch_slug)
    {
        $branch_id = BranchEnum::getId($branch_slug);
        if($branch_id){
            $branch_name = BranchEnum::slugToName()[$branch_slug];
            $reviewReasons = ReviewReasonEnum::toArray();
            return view('review.index', compact('reviewReasons', 'branch_name', 'branch_id'));
        } else {
            abort(404);
        }
    }


    public function create(ReviewRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $review = Review::create([
                'branch_id' => $data['branch_id'],
                'rating' => $data['rating'],
                'reason_id' => $data['rating'] < 4 ? $data['reason_id'] : null,
            ]);
            if ($review->reason_id == array_key_last(ReviewReasonEnum::toArray())) {
                ReviewForm::create([
                    'review_id' => $review->id,
                    'name'      => $data['name'],
                    'phone'     => $data['phone'],
                    'review'    => $data['review'],
                ]);
            }
            DB::commit();

            return response()->json([
                    'success' => true,
                    'is_redirect' => $data['rating'] > 3,
                    'success_view' => view(
                        $data['rating'] > 3
                        ? 'review.parts.redirect2gisbutton'
                        : 'review.parts.success'
                    )->render(),
                ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Произошла ошибка при сохранении данных',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
