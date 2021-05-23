<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SoDienThoai implements Rule
{ 
    protected $prefixTenNumers = '086|096|097|098|088|090|093|089|091|094|092';
    protected $prefixElevenNumbers = '032|033|034|035|036|037|038|039|070|079|077|076|078|0911|0941|0123|0124|0125|0127|0129|0188|0186|0993|0994|0996|0199|0995|0997';
    protected $errorType;

    protected const ERROR_TYPE_FORMAT = 1;
    protected const ERROR_TYPE_NUMERIC = 2;
    protected const ERROR_TYPE_LENGTH = 3;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = $this->removeCountryCode($value);

        if (!preg_match('/^[0-9]+$/', $value)) {
            $this->errorType = self::ERROR_TYPE_NUMERIC;
            return false;
        }

        $phoneLength = strlen($value);
        if ($phoneLength < 10 || $phoneLength > 11) {
            $this->errorType = self::ERROR_TYPE_LENGTH;
            return false;
        }

        if ($phoneLength === 10 && !preg_match('/^'.$this->prefixTenNumers.'/', $value)) {
            $this->errorType = self::ERROR_TYPE_FORMAT;
            return false;
        }

        if ($phoneLength === 11 && !preg_match('/^'.$this->prefixElevenNumbers.'/', $value)) {
            $this->errorType = self::ERROR_TYPE_FORMAT;
            return false;
        }

        return true;
    }

    public function validate($attribute, $value)
    {
        return $this->passes($attribute, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        switch ($this->errorType) {
            case self::ERROR_TYPE_NUMERIC:
                $msg = 'Điện thoại phải là chữ số';
                break;
            case self::ERROR_TYPE_LENGTH:
                $msg = 'Điện thoại phải có độ dài từ 10 hoặc 11 số';
                break;
            default:
                $msg = 'Số điện thoại không đúng định dạng';
                break;
        }
        return $msg;
    }

    protected function removeCountryCode($phone)
    {
        $phone = preg_replace('/^\+84/', '', $phone);
        if (!preg_match('/^0/', $phone)) {
            $phone = '0'.$phone;
        }
        return $phone;
    }
}
