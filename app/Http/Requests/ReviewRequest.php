<?php

namespace App\Http\Requests;

use App\Enum\BranchEnum;
use App\Enum\ReviewReasonEnum;
use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'branch_id' => [
                'required',
                'integer',
                'min:1',
                'max:' . count(BranchEnum::toArray()), // максимальное значение равно количеству элементов в Enum
            ],
            'rating' => 'required|integer|min:1|max:5', // Проверка на рейтинг
            'reason_id' => [
                'nullable',
                'integer',
                'min:0',
                'max:' . count(ReviewReasonEnum::toArray())-1, // максимальное значение равно количеству элементов в Enum
            ],
            'name' => 'nullable|string|max:255', // Имя (опционально, если выбрана последняя причина)
            'phone' => 'nullable|string|max:20', // Телефон (опционально, если выбрана последняя причина)
            'review' => 'nullable|string|max:1000', // Отзыв
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'rating.required' => 'Пожалуйста, выберите количество звезд.',
            'rating.integer' => 'Рейтинг должен быть числом.',
            'rating.min' => 'Рейтинг должен быть от 1 до 5.',
            'rating.max' => 'Рейтинг не может быть больше 5.',
            'reason.exists' => 'Выберите корректную причину.',
            'reason.min' => 'Вы указали несуществующую причину',
            'reason.max' => 'Вы указали несуществующую причину',
            'name.string' => 'Имя должно быть строкой.',
            'phone.string' => 'Телефон должен быть строкой.',
            'review.string' => 'Отзыв должен быть строкой.',
        ];
    }
}
