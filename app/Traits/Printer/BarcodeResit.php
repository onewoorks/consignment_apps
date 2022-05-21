<?php 

namespace App\Traits\Printer;

trait BarcodeResit {

    public function text($text,$font_width = 0, $align = 0, $format = 0){
        if (gettype($text) == 'array'){
            $text = $this->singleRow($text);
        };
        return (object) array(
            "type"      => 0,            //text
            "content"   => $text,        //any string	
            "bold"      => $font_width,  //0 if no, 1 if yes
            "align"     => $align,       //0 if left, 1 if center, 2 if right
            "format"    => $format       //0 if normal, 1 if double Height, 2 if double Height + Width, 3 if double Width, 4 if small
        );
    }

    public function image($path, $align = 2){
        return (object) array(
            "type"  => 1,       //image
            "path"  => $path,   //complete filepath on your web server; make sure that it is not big size
            "align" => $align   //0 if left, 1 if center, 2 if right; set left align for big size images
        );
    }

    public function barcode($value, $width = 100, $height = 50, $align = 0){
        return (object) array(
            "type"      => 2,       //barcode
            "value"     => $value,  //valid barcode value
            "width"     => $width,  //valid barcode width
            "height"    => $height, //valid barcode height
            "align"     => $align   //0 if left, 1 if center, 2 if right
        );
    }

    public function line(){
        $line = '';
        for($i=0;   $i<32;  $i++){
            $line .= '_';
        }
        return $this->text($line);
    }

    public function qrCode($value, $size = 40, $align = 1){
        return (object) array(			
            "type"  => 3,       //QR code
            "value" => $value,  //valid QR code value
            "size"  => $size,   //valid QR code size in mm
            "align" => $align,  //0 if left, 1 if center, 2 if right
        );
    }

    private function singleRow($text_array, $format = '.'){
        $total_dot  = 32;
        $text       = array();
        foreach($text_array as $t){
            $total_dot -= strlen($t);
        }
        $text = $text_array[0];
        if(count($text_array)>1){
            
        for($d=0;$d < $total_dot; $d++){
            $text .= $format;
        }
        
            if($total_dot < 0) {
                $text .= "...";
            }
            $text .= $text_array[1];
        }
        return $text;
    }

}