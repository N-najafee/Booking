<?php


use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;


/**
 * Generate unique name
 * @param string $filename
 * @return string
 */
function CreateFileName($filename)
{
    $now = Carbon::now()->toDateTimeString();
    $microsecond = Carbon::now()->microsecond;
    $pattern = '/["  :]/';
    $x = preg_split($pattern, $now);
    $file_name = implode("_", $x) . "_" . $microsecond . "_" . $filename;
    return $file_name;
}

/**
 * Find & remove specific key in cache.
 * @param string $cacheKey
 * @return boolean
 */
function forGetCache($cacheKey)
{
    $result = false;
    foreach (range(0, 50) as $item) {
        if (Cache::has($cacheKey . $item)) {
            Cache::forget($cacheKey . $item);
            $result = true;
            break ;
        }
    }
    return $result;
}


/**
 * Generate an array of dates between two dates.
 * @param string $checkIn
 * @param string $checkOut
 * @return array
 */
function getDates($checkIn, $checkOut)
{
    $dates = [];
    while ($checkIn < $checkOut) {
        $dates[] = $checkIn;
        $checkIn = Carbon::parse($checkIn)->addDay()->format('Y/m/d');
    }
    return $dates;
}
