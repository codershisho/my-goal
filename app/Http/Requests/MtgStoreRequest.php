<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * 面談作成のリクエストクラス
 */
class MtgStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "mtg_date" => "string|nullable",
            "to_user_id" => "integer|nullable",
            "topics.*.checked" => "integer|nullable",
            "topics.*.from_memo" => "string|nullable",
            "topics.*.to_memo" => "string|nullable",
            "topics.*.selected" => "integer|nullable",
            "topics.*.topic_id" => "integer|nullable",
            "topics.*.topic_name" => "string|nullable",
            "topics.*.details.*.topic_detail_id" => "integer|nullable",
            "topics.*.details.*.topic_detail_name" => "string|nullable",
        ];
    }
}
