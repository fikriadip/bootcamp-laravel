<?php
function tentukan_nilai($number)
{
    if ($number >= 85 && $number <= 100) {
        $grade = "Sangat Baik";
        return $number . "&nbsp;" . $grade;
    } elseif ($number >= 70 && $number <= 85) {
        $grade = "Baik";
        return $number . "&nbsp;" . $grade;
    } elseif ($number >= 60 && $number <= 70) {
        $grade = "Cukup";
        return $number . "&nbsp;" . $grade;
    } else {
        $grade = "Kurang";
        return $number . "&nbsp;" . $grade;
    }
}

//TEST CASES
echo tentukan_nilai(98); //Sangat Baik
print "<br>";
echo tentukan_nilai(76); //Baik
print "<br>";
echo tentukan_nilai(67); //Cukup
print "<br>";
echo tentukan_nilai(43); //Kurang
