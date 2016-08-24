<?php
/**
 * @link https://github.com/nirvana-msu/yii2-helpers
 * @copyright Copyright (c) 2016 Alexander Stepanov
 * @license MIT
 */

namespace nirvana\helpers;

use Yii;

/**
 * MathHelper provides some helpful math utilities
 *
 * @author Alexander Stepanov <student_vmk@mail.ru>
 */
class MathHelper
{
    /**
     * Creates a histogram with specified bins out of a given array
     * @param array $values , e.g. [11, 12, 20, 25, 20.1, 33.5]
     * @param array $edges , e.g. [0, 10, 20, 30, 40]
     * @throws \Exception
     * @return array histogram, e.g. ['0-10' => [], '10-20' => [11,12], '20-30' => [20,25,20.1], '30-40' => [33.5]]
     */
    public static function histogram($values, $edges)
    {
        $bins = [];
        foreach ($edges as $key => $val) {
            if (!isset($edges[$key + 1])) break;
            $bins[] = $val . '-' . ($edges[$key + 1]);
        }

        $histogram = array_fill_keys($bins, []);
        foreach ($values as $value) {
            $i = MathHelper::binary_search($edges, $value);
            if ($i == -1) {
                $message = "Value $value is outside of specified edges array: " . print_r($edges, true) . "\n";
                throw new \Exception($message);
            }
            $key = $bins[$i];
            $histogram[$key][] = $value;
        }
        return $histogram;
    }

    /**
     * Iterative binary search. Finds the index $i, such that $list[i] <= $x < $list[i+1]
     * @param array $list The sorted array
     * @param int $x The target integer to search
     * @return int The index if found, otherwise -1
     */
    public static function binary_search($list, $x)
    {
        $left = 0;                  # first index of the array to be searched
        $right = count($list) - 1;  # last index of the array to be searched

        if (($x < $list[$left]) || ($x >= $list[$right])) {
            return -1;
        }

        while ($right - $left > 1) {
            $mid = (int)floor(($left + $right) / 2);

            if ($list[$mid] == $x) {
                return $mid;
            } elseif ($list[$mid] > $x) {
                $right = $mid;
            } elseif ($list[$mid] < $x) {
                $left = $mid;
            }
        }
        return $left;
    }
}
