<?
/*#######################################################################
#............INFORMACAO.SOBRE.O.DESENVOLVIMENTO.E.A.CRIACAO.............#
#########################################################################
#.............................. Analista:....Juliano Muniz..............#
#.................................E-mail:....juliano.muniz@uol.com.br...#
#................................Celular:....(11) 8611-8004.............#
#.......................................................................#
#.............................. Analista:....Marcelo Queiroz............#
#.................................E-mail:....mqvida@yahoo.com.br........#
#................................Celular:....(11) 7288-3151.............#
#.......................................................................#
#.."BEM-AVENTURADO aquele que teme ao Senhor e anda nos seus caminhos...#
#..Pois comeras do trabalho das tuas maos; feliz seras, e te ira bem."..#
#...........................................* Salmo 128:1-2.............#
#######################################################################*/

 header ("Content-type: image/jpeg");
 $img_old = imagecreatefromjpeg($img_name);
 $width = imagesx($img_old);
 $height = imagesy($img_old);
 $w_h_px = 300;

 if ($width>$height){
    if ($width>$w_h_px){
      $porc = ($w_h_px*100)/$width;
      $new_width = round(($width*$porc)/100);
      $new_height = round(($height*$porc)/100);
    } else {
      $new_width = $width;
      $new_height = $height;
    }
 } else if ($width==$height){
    if ($width>$w_h_px){
      $porc = ($w_h_px*100)/$width;
      $new_width = round(($width*$porc)/100);
      $new_height = round(($height*$porc)/100);
    } else {
      $new_width = $width;
      $new_height = $height;
    }
 } else {
    if ($height>$w_h_px){
      $porc = ($w_h_px*100)/$height;
      $new_width = round(($width*$porc)/100);
      $new_height = round(($height*$porc)/100);
    } else {
      $new_width = $width;
      $new_height = $height;
    }
 }

  
 $img_new = imagecreatetruecolor($new_width,$new_height);
 ImageCopyResized($img_new, $img_old,0,0,0,0,$new_width, $new_height, $width, $height);
 $text_color = ImageColorAllocate ($img_new, 255, 255, 255);
 $text_color2 = ImageColorAllocate ($img_new, 0, 0, 0);
 //imagestring($img_new, 5, 5, 5,  "Tamanho: $new_width x $new_height pixels", $text_color);
 $txt_col = $new_width-80;
 $txt_row = $new_height-15;
 $txt_col2 = $new_width-79;
 $txt_row2 = $new_height-14;
 imagestring($img_new, 3, $txt_col2, $txt_row2, "TESTE", $text_color2);
 imagestring($img_new, 3, $txt_col, $txt_row, "TESTE", $text_color);
 imagejpeg($img_new);
 imagedestroy($img_new);

?> 
