<?php
        function  ubah_huruf($string){
            $convert = ['a'=>'b', 'b' =>'c', 'c'=>'d', 'd'=>'e', 'e'=>'f', 'f'=>'g', 'g'=>'h', 'h'=>'i', 'i'=>'j', 'j'=>'k', 'k'=>'l', 'l'=>'m', 'm'=>'n', 'n'=>'o', 'o'=>'p', 'p'=>'q', 'q'=>'r', 'r'=>'s', 's'=>'t', 't'=>'u', 'u'=>'v', 'v'=>'w', 'w'=>'x', 'x'=>'y', 'y'=>'z', 'z'=>'a'];
            $arr_data = str_split($string);
            $new_data   = '';
    
            foreach ($arr_data as  $value) {
                $new_data .= $convert[$value]."";
            }
            return $new_data;
    
        }
// TEST CASES
echo ubah_huruf('wow'). "<br>"; // xpx
echo ubah_huruf('developer'). "<br>"; // efwfmpqfs
echo ubah_huruf('laravel'). "<br>"; // mbsbwfm
echo ubah_huruf('keren'). "<br>"; // lfsfo
echo ubah_huruf('semangat'). "<br>"; // tfnbohbu
?>
