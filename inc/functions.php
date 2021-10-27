
<?php


function get_colors($image, $pixel_skip = 1)
{
   $colors_arr = [];

   $size = getimagesize($image);
   $width = $size[0];
   $height = $size[1];

   $image = imagecreatefromstring(file_get_contents($image));
 
   for ($x = 0; $x < $size[0]; $x += $pixel_skip) {

      for ($y = 0; $y < $size[1]; $y += $pixel_skip) {

     
         $pixel_color = imagecolorat($image, $x, $y);
         $index_of_color = imagecolorsforindex($image, $pixel_color);

         $color_value_hexa = convert_rgb($index_of_color);

         if (array_key_exists($color_value_hexa, $colors_arr)) {
            $colors_arr[$color_value_hexa]++;
         } else {
            $colors_arr[$color_value_hexa] = 1;
         }
      }
   }
   arsort($colors_arr);
   return $colors_arr;
}




function convert_rgb($index_of_color)
{

   $red = round(round(($index_of_color['red'] / 0x33)) * 0x33);
   $green = round(round(($index_of_color['green'] / 0x33)) * 0x33);
   $blue = round(round(($index_of_color['blue'] / 0x33)) * 0x33);
   return $color_value_hexa = sprintf('%02X%02X%02X', $red, $green, $blue);
}
