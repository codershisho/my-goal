<?php

namespace App\Http\Controllers;

/**
 * APIクラスの親クラス
 */
abstract class AbstractApi
{
    /**
     * 正常系のレスポンス形
     *
     * @param array $data
     * @param String $message
     * @return void
     */
    public function setResponse($data = [], String $message = "")
    {
        return response()->json([
            "data" => $data,
            "message" => $message
        ]);
    }

    /**
     * メッセージだけ返すレスポンス形
     *
     * @param string $message
     * @return void
     */
    public function setResponseMessage(String $message = "")
    {
        return response()->json([
            "message" => $message
        ]);
    }
}
