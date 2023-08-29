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
            "details.*.topic_detail_id" => "integer|nullable",
            "details.*.from_memo" => "string|nullable",
            "details.*.from_memo" => "string|nullable",
        ];
    }
}
