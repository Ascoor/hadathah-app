<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PhoneNumber implements Rule
{
    protected $ignoreId; // ID to ignore during validation
    protected $additionalInfo;
    protected $tableNames = [ // Arabic names for tables
        'designers' => 'المصممين',
        'sale_reps' => 'مندوبى المبيعات',
        'social_reps' => 'مندوبى التسويق الشبكى',
        'multi_employees' => 'الموظفين الإداريين'
    ];
    protected $duplicateTables = []; // To store tables where duplicates are found

    public function __construct($ignoreId = null, $additionalInfo = [])
    {
        $this->ignoreId = $ignoreId;
        $this->additionalInfo = $additionalInfo;
    }

    public function passes($attribute, $value)
    {
        if (!$this->isValidPhoneNumber($value)) {
            return false;
        }

        foreach ($this->tableNames as $table => $arabicName) {
            $query = DB::table($table)->where('phone', $value);
            if ($this->ignoreId) {
                $query->where('id', '!=', $this->ignoreId);
            }
            if (!empty($this->additionalInfo)) {
                foreach ($this->additionalInfo as $key => $info) {
                    $query->where($key, '=', $info);
                }
            }
            if ($query->exists()) {
                $this->duplicateTables[] = $arabicName; // Use the Arabic name
            }
        }

        return empty($this->duplicateTables);
    }

    public function message()
    {
        if (!empty($this->duplicateTables)) {
            $tables = implode(', ', $this->duplicateTables);
            return "رقم الهاتف مسجل بالفعل في الجدول التالي: {$tables}.";
        }
        return "رقم الهاتف غير صالح.";
    }

    protected function isValidPhoneNumber($phone)
    {
        $countryCodePattern = '/^\+?[1-9]\d{1,14}$/';
        $localPhonePattern = '/^0\d{10}$/';
        return preg_match($countryCodePattern, $phone) || preg_match($localPhonePattern, $phone);
    }
}

