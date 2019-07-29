<?php
/**
 * Created by PhpStorm.
 * User: AppleSparkle
 * Date: 7/7/2018 AD
 * Time: 5:44 PM
 */
namespace App\Applejack;

use Illuminate\Http\Request;
class UserAgentIp{
    private $userAgent;

    public function __construct(Request $request)
    {
        $this->userAgent = $request->server();
    }

    /**
     * |--------------------------------------------------------------------------
     * | Claim:By the power of Twilight Sparkle and Applejack,
     * | I hereby decree this function is feasible.
     * |--------------------------------------------------------------------------
     * | @return mixed
     * |
     * | Author: AppleSparkle
     * | Date: 7/25/18
     * | Time: 6:04 PM
     */
    public function information(){
        $information['ip']=$this->acquire_ip();
        $information['os']=$this->acquire_os();
        $information['browser_name']=$this->acquire_browser_name();
        $information['phone']=$this->phone_info();

        $ipsearch = new IpSearch(public_path('ip/qqzeng-ip-utf8.dat'));
        $ip_info = $ipsearch->get($information['ip']);
        $ip_info = explode('|',$ip_info);
        $information['country'] = @$ip_info[1] ? : '暂无';
        $information['region'] = @$ip_info[2] ? : '暂无';
        $information['city'] = @$ip_info[3] ? : '暂无';
        $information['isp'] = @$ip_info[5] ? : '暂无';
        return $information;
    }

    /**
     * |--------------------------------------------------------------------------
     * | Claim:By the power of Twilight Sparkle and Applejack,
     * | I hereby decree this function is feasible.
     * |--------------------------------------------------------------------------
     * | @return string
     * |
     * | Author: AppleSparkle
     * | Date: 7/25/18
     * | Time: 6:04 PM
     */
    private function acquire_ip(){
        if(!empty($this->userAgent["HTTP_CLIENT_IP"])) {
            $ip = $this->userAgent["HTTP_CLIENT_IP"];
        } else if(!empty($this->userAgent["HTTP_X_FORWARDED_FOR"])) {
            $ip = $this->userAgent["HTTP_X_FORWARDED_FOR"];
        } else if(!empty($this->userAgent["REMOTE_ADDR"])) {
            $ip = $this->userAgent["REMOTE_ADDR"];
        } else {
            $ip = '';
        }
        preg_match("/[\d\.]{7,15}/", $ip, $ips);
        $ip = isset($ips[0]) ? $ips[0] : 'unknown';
        unset($ips);

        return $ip;
    }

    /**
     * |--------------------------------------------------------------------------
     * | Claim:By the power of Twilight Sparkle and Applejack,
     * | I hereby decree this function is feasible.
     * |--------------------------------------------------------------------------
     * | @return string
     * |
     * | Author: AppleSparkle
     * | Date: 7/25/18
     * | Time: 6:04 PM
     */
    private function acquire_browser_name(){
        $user_OSagent = $this->userAgent['HTTP_USER_AGENT'];
        if (strpos($user_OSagent, "Maxthon") && strpos($user_OSagent, "MSIE")) {
            $visitor_browser = "Maxthon(Microsoft IE)";
        } elseif (strpos($user_OSagent, "Maxthon 2.0")) {
            $visitor_browser = "Maxthon 2.0";
        } elseif (strpos($user_OSagent, "Maxthon")) {
            $visitor_browser = "Maxthon";
        } elseif (strpos($user_OSagent, "Edge")) {
            $visitor_browser = "Edge";
        } elseif (strpos($user_OSagent, "Trident")) {
            $visitor_browser = "IE";
        } elseif (strpos($user_OSagent, "MSIE")) {
            $visitor_browser = "IE";
        } elseif (strpos($user_OSagent, "MSIE")) {
            $visitor_browser = "MSIE 较高版本";
        } elseif (strpos($user_OSagent, "NetCaptor")) {
            $visitor_browser = "NetCaptor";
        } elseif (strpos($user_OSagent, "Netscape")) {
            $visitor_browser = "Netscape";
        } elseif (strpos($user_OSagent, "Chrome")) {
            $visitor_browser = "Chrome";
        } elseif (strpos($user_OSagent, "Lynx")) {
            $visitor_browser = "Lynx";
        } elseif (strpos($user_OSagent, "Opera")) {
            $visitor_browser = "Opera";
        } elseif (strpos($user_OSagent, "MicroMessenger")) {
            $visitor_browser = "微信浏览器";
        } elseif (strpos($user_OSagent, "Konqueror")) {
            $visitor_browser = "Konqueror";
        } elseif (strpos($user_OSagent, "Mozilla/5.0")) {
            $visitor_browser = "Mozilla";
        } elseif (strpos($user_OSagent, "Firefox")) {
            $visitor_browser = "Firefox";
        } elseif (strpos($user_OSagent, "U")) {
            $visitor_browser = "Firefox";
        } elseif (strpos($user_OSagent, "Safari") && !strpos($user_OSagent, "Chrome")) {
            $visitor_browser = "Safari";
        } else {
            $visitor_browser = "unknown";
        }
        return $visitor_browser;
    }

    /**
     * |--------------------------------------------------------------------------
     * | Claim:By the power of Twilight Sparkle and Applejack,
     * | I hereby decree this function is feasible.
     * |--------------------------------------------------------------------------
     * | @return bool|string
     * |
     * | Author: AppleSparkle
     * | Date: 7/25/18
     * | Time: 6:04 PM
     */
    private function acquire_os ()
    {
        $agent = $this->userAgent['HTTP_USER_AGENT'];
        $os = false;
        if (preg_match('/win/', $agent) && strpos($agent, '95')){
            $os = 'Windows 95';
        }
        else if (preg_match('/win 9x/', $agent) && strpos($agent, '4.90')){
            $os = 'Windows ME';
        }
        else if (preg_match('/win/', $agent) && preg_match('/98/', $agent)){
            $os = 'Windows 98';
        }
        else if (preg_match('/win/', $agent) && preg_match('/nt 5.1/', $agent)){
            $os = 'Windows XP';
        }
        else if (preg_match('/win/', $agent) && preg_match('/nt 5/', $agent)){
            $os = 'Windows 2000';
        }
        else if (preg_match('/win/', $agent) && preg_match('/nt/', $agent)){
            $os = 'Windows NT';
        }
        else if (preg_match('/win/', $agent) && preg_match('/32/', $agent)){
            $os = 'Windows 32';
        }
        else if (preg_match('/linux/', $agent)){
            $os = 'Linux';
        }
        else if (preg_match('/unix/', $agent)){
            $os = 'Unix';
        }
        else if (preg_match('/sun/', $agent) && preg_match('/os/', $agent)){
            $os = 'SunOS';
        }
        else if (preg_match('/ibm/', $agent) && preg_match('/os/', $agent)){
            $os = 'IBM OS/2';
        }
        else if (preg_match("/Mac/", $agent) && preg_match('/os/', $agent)){
            $os = 'Macintosh';
        }
        else if (preg_match('/PowerPC/', $agent)){
            $os = 'PowerPC';
        }
        else if (preg_match('/AIX/', $agent)){
            $os = 'AIX';
        }
        else if (preg_match('/HPUX/', $agent)){
            $os = 'HPUX';
        }
        else if (preg_match('/NetBSD/', $agent)){
            $os = 'NetBSD';
        }
        else if (preg_match('/BSD/', $agent)){
            $os = 'BSD';
        }
        else if (preg_match('/OSF1/', $agent)){
            $os = 'OSF1';
        }
        else if (preg_match('/IRIX/', $agent)){
            $os = 'IRIX';
        }
        else if (preg_match('/FreeBSD/', $agent)){
            $os = 'FreeBSD';
        }
        else if (preg_match('/teleport/', $agent)){
            $os = 'teleport';
        }
        else if (preg_match('/flashget/', $agent)){
            $os = 'flashget';
        }
        else if (preg_match('/webzip/', $agent)){
            $os = 'webzip';
        }
        else if (preg_match('/offline/', $agent)){
            $os = 'offline';
        }else if (strpos($agent, 'Android') !== false) {
            preg_match("/(?<=Android )[\d\.]{1,}/", $agent, $version);
            $os = 'Android';
        } else if (strpos($agent, 'iPhone') !== false) {
            preg_match("/(?<=CPU iPhone OS )[\d\_]{1,}/", $agent, $version);
            $os = 'iPhone';
        } else if (strpos($agent, 'iPad') !== false) {
            preg_match("/(?<=CPU OS )[\d\_]{1,}/", $agent, $version);
            $os = 'iPad';
        }else{
            $os = 'Unknown';
        }
        return $os;
    }

    /**
     * |--------------------------------------------------------------------------
     * | Claim:By the power of Twilight Sparkle and Applejack,
     * | I hereby decree this function is feasible.
     * |--------------------------------------------------------------------------
     * | @return string
     * |
     * | Author: AppleSparkle
     * | Date: 11/3/18
     * | Time: 3:17 PM
     */
    public function phone_info(){
        $user_agent = $this->userAgent['HTTP_USER_AGENT'];
        if (stripos($user_agent, "iPhone")!==false) {
            $brand = 'iPhone';
        } else if (stripos($user_agent, "SAMSUNG")!==false || stripos($user_agent, "Galaxy")!==false || strpos($user_agent, "GT-")!==false || strpos($user_agent, "SCH-")!==false || strpos($user_agent, "SM-")!==false) {
            $brand = '三星';
        } else if (stripos($user_agent, "Huawei")!==false || stripos($user_agent, "Honor")!==false || stripos($user_agent, "H60-")!==false || stripos($user_agent, "H30-")!==false) {
            $brand = '华为';
        } else if (stripos($user_agent, "Lenovo")!==false) {
            $brand = '联想';
        } else if (strpos($user_agent, "MI-ONE")!==false || strpos($user_agent, "MI 1S")!==false || strpos($user_agent, "MI 2")!==false || strpos($user_agent, "MI 3")!==false || strpos($user_agent, "MI 4")!==false || strpos($user_agent, "MI-4")!==false) {
            $brand = '小米';
        } else if (strpos($user_agent, "HM NOTE")!==false || strpos($user_agent, "HM201")!==false) {
            $brand = '红米';
        } else if (stripos($user_agent, "Coolpad")!==false || strpos($user_agent, "8190Q")!==false || strpos($user_agent, "5910")!==false) {
            $brand = '酷派';
        } else if (stripos($user_agent, "ZTE")!==false || stripos($user_agent, "X9180")!==false || stripos($user_agent, "N9180")!==false || stripos($user_agent, "U9180")!==false) {
            $brand = '中兴';
        } else if (stripos($user_agent, "OPPO")!==false || strpos($user_agent, "X9007")!==false || strpos($user_agent, "X907")!==false || strpos($user_agent, "X909")!==false || strpos($user_agent, "R831S")!==false || strpos($user_agent, "R827T")!==false || strpos($user_agent, "R821T")!==false || strpos($user_agent, "R811")!==false || strpos($user_agent, "R2017")!==false) {
            $brand = 'OPPO';
        } else if (strpos($user_agent, "HTC")!==false || stripos($user_agent, "Desire")!==false) {
            $brand = 'HTC';
        } else if (stripos($user_agent, "vivo")!==false) {
            $brand = 'vivo';
        } else if (stripos($user_agent, "K-Touch")!==false) {
            $brand = '天语';
        } else if (stripos($user_agent, "Nubia")!==false || stripos($user_agent, "NX50")!==false || stripos($user_agent, "NX40")!==false) {
            $brand = '努比亚';
        } else if (strpos($user_agent, "M045")!==false || strpos($user_agent, "M032")!==false || strpos($user_agent, "M355")!==false) {
            $brand = '魅族';
        } else if (stripos($user_agent, "DOOV")!==false) {
            $brand = '朵唯';
        } else if (stripos($user_agent, "GFIVE")!==false) {
            $brand = '基伍';
        } else if (stripos($user_agent, "Gionee")!==false || strpos($user_agent, "GN")!==false) {
            $brand = '金立';
        } else if (stripos($user_agent, "HS-U")!==false || stripos($user_agent, "HS-E")!==false) {
            $brand = '海信';
        } else if (stripos($user_agent, "Nokia")!==false) {
            $brand = '诺基亚';
        } else {
            $brand = 'pc';
        }
        return $brand;
    }
}