<?php

namespace App\Utils;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

class JsonBuilder
{

    const CODE_SUCCESS = 1000;
    const CODE_ERROR = 999;
    const MODE_OUTPUT_DEV = JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT;
    const MODE_OUTPUT_PROD = JSON_UNESCAPED_UNICODE;

    /**
     * 返回成功JSON消息
     * @param  array|String $dataOrMessage
     * @param  String $message
     * @return string
     */
    public static function Success($dataOrMessage=[], $message = 'OK'){
        $mode = env('APP_DEBUG',true) ? self::MODE_OUTPUT_DEV : self::MODE_OUTPUT_PROD;
        if( is_array($dataOrMessage) ){
            try{
                $dataOrMessage = self::TransformNullToEmptyString($dataOrMessage);
                return json_encode([
                    'code' => self::CODE_SUCCESS,
                    'message' => $message,
                    'data' => $dataOrMessage
                ], $mode);
            }catch (\Exception $exception){
                return self::Error($exception->getMessage());
            }
        }elseif (is_object($dataOrMessage)){
            try{
                $dataOrMessage = self::TransformNullToEmptyStringForObject($dataOrMessage);
                return json_encode([
                    'code' => self::CODE_SUCCESS,
                    'message' => $message,
                    'data' => $dataOrMessage
                ], $mode);
            }catch (\Exception $exception){
                return self::Error($exception->getMessage());
            }
        }
        else{
            return json_encode([
                'code' => self::CODE_SUCCESS,
                'message' => $dataOrMessage,
                'data'=>[]
            ], $mode);
        }
    }

    /**
     * 返回错误JSON消息
     * @param  array|String $dataOrMessage
     * @param  int $code
     * @return string
     */
    public static function Error($dataOrMessage = 'Err', $code = null){
        $mode = env('APP_DEBUG',true) ? self::MODE_OUTPUT_DEV : self::MODE_OUTPUT_PROD;
        if(is_array($dataOrMessage)){
            return json_encode([
                'code' => $code ?? self::CODE_ERROR,
                'message' => $dataOrMessage
            ], $mode);
        }else{
            return json_encode([
                'code' => $code ?? self::CODE_ERROR,
                'message' => $dataOrMessage
            ], $mode);
        }
    }

    /**
     * @param array $array
     * @return array
     */
    public static function TransformNullToEmptyString($array ){
        array_walk_recursive($array, function (& $val,$key ) {
            if (is_null($val)) {
                $val = '';
            }
            elseif (is_object($val)){
                $val = self::TransformNullToEmptyStringForObject($val);
            }
        });
        return $array;
    }

    /**
     * @param $obj
     * @return array
     * @throws \Exception
     */
    public static function TransformNullToEmptyStringForObject($obj ){
        if( $obj instanceof Arrayable || is_callable($obj, 'toArray')){
            // 具备转换成数组的条件
            $arr = $obj->toArray();
            return self::TransformNullToEmptyString($arr);
        }
        elseif ($obj instanceof Carbon){
            return $obj->format('Y-m-d');
        }
        elseif (is_object($obj)) {
            return $obj;
        }
        else{
            // 表明传入的对象, 既没有实现 ArrayAccess, 也没提供 toArray 方法
            throw new \Exception('数据无法正确转换成 json');
        }
    }
}
