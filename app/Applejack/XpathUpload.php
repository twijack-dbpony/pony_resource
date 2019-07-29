<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 10/30/18
 * Time: 6:18 PM
 */
namespace App\Applejack;

class XpathUpload{
    public $domContent;

    public function __construct($content)
    {
        $this->domain = config('miscellanea.upload_image_domain');
        $this->domContent = $content;
    }

    /**
     * |--------------------------------------------------------------------------
     * | Claim:By the power of Twilight Sparkle and Applejack,
     * | I hereby decree this function is feasible.
     * |--------------------------------------------------------------------------
     * | xpath example in php,save base64 img src locally
     * | @return mixed
     * |
     * | Author: AppleSparkle
     * | Date: 11/3/18
     * | Time: 3:13 PM
     */
    public function upload_image(){
        $doc = new \DOMDocument();
        $doc->loadHTML($this->domContent);
        $xml = simplexml_import_dom($doc);

        $images = $xml->xpath('//img');
        $images = json_decode(json_encode((array)$images), 1);

        foreach ($images as $k => $img) {
            if(strpos($img['@attributes']['src'],$this->domain)!==false){
                continue;
            }
            $pony_image = explode(',', $img['@attributes']['src']);

            $img_type = explode(';',$pony_image[0]);
            $img_type = explode('/',$img_type[0]);

            $pony_image = str_replace(' ', '+', $pony_image[1]);
            $pony_image = base64_decode($pony_image);
            $filename = 'rarity/huadong_ponyclub_'.UPLOAD_TIME.'_'.$k.'.'.$img_type[1];

            $this->domContent = str_replace($img['@attributes']['src'],$this->domain.'/'.$filename,$this->domContent);
            file_put_contents($filename, $pony_image);
        }
        return $this->domContent;
    }
}