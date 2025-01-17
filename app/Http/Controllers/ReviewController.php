<?php

namespace App\Http\Controllers;

use App\Enum\ReviewReasonEnum;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\ReviewForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{

    public function index()
    {
        $reviewReasons = ReviewReasonEnum::toArray();
        return view('review.index', compact('reviewReasons'));
    }
    public function success()
    {
        return view('review.parts.success');
    }


    public function create(ReviewRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $review = Review::create([
                'rating' => $data['rating'],
                'reason_id' => $data['rating'] < 4 ? $data['reason_id'] : null,
            ]);
            if ($review->reason_id === array_key_last(ReviewReasonEnum::toArray())) {
                ReviewForm::create([
                    'review_id' => $review->id,
                    'name'      => $data['name'],
                    'phone'     => $data['phone'],
                    'review'    => $data['review'],
                ]);
            }
            DB::commit();

            return $data['rating'] < 4
                ? redirect()->route('review.success')
                : response()->json([
                    'success' => true,
                    'success_view' => view('review.parts.redirect2gisbutton')->render(),
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
