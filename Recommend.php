<?php

#doc
#    classname:    Recommender
#    scope:        PUBLIC
#
#/doc
error_reporting(E_ALL);
ini_set('display_errors','On');
class Recommender
{
    #    internal variables
    private $apikey   = "";
    private $tenantid = "EASYREC_DEMO";
    private $request_url = "http://intralife.researchstudio.at:8080/api/1.0";

    
    #    Constructor
    function __construct ($userid,$sessionid)
    {
        $this->userid=$userid;
        $this->sessionid=$sessionid;        
    }
    
    private function request($get_params)
    {
        if($get_params) {
            $url = $this->request_url.$get_params."&apikey=".$this->apikey."&tenantid=".$this->tenantid;
            $data = file_get_contents($url);
            return $data;
        }
        else {
            return 0;
        }
    }
    
    public function view($itemid,$itemdesc,$itemurl)
    {
        if(!empty($itemid) and !empty($itemdesc) and !empty($itemurl)) {
            $itemdesc = str_replace(" ","%20",$itemdesc);
            $itemurl = str_replace("&","%26",$itemurl);
            return $this->request("/view?itemid=".$itemid."&itemdescription=".$itemdesc."&itemurl=".$itemurl."&userid=".$this->userid."&sessionid=".$this->sessionid);
        }
        else {
            return 0;
        }
    }
    
    public function buy($itemid,$itemdesc,$itemurl)
    {
        if(!empty($itemid) and !empty($itemdesc) and !empty($itemurl)) {
            $itemdesc = str_replace(" ","%20",$itemdesc);
            $itemurl = str_replace("&","%26",$itemurl);
            return $this->request("/buy?itemid=".$itemid."&itemdescription=".$itemdesc."&itemurl=".$itemurl."&userid=".$this->userid."&sessionid=".$this->sessionid);
        }
        else {
            return 0;
        }    
    }
    
    public function rate($itemid,$itemdesc,$itemurl,$rvalue)
    {
        if(!empty($itemid) and !empty($itemdesc) and !empty($itemurl) and !empty($rvalue)) {
            $itemdesc = str_replace(" ","%20",$itemdesc);
            $itemurl = str_replace("&","%26",$itemurl);
            return $this->request("/rate?itemid=".$itemid."&itemdescription=".$itemdesc."&itemurl=".$itemurl."&userid=".$this->userid."&sessionid=".$this->sessionid."&ratingvalue=".$rvalue);
        }
        else {
            return 0;
        }
    }
}



/*
$oner = new Recommender("user_example","session_example");
echo "view function:<br>";
echo "<pre>".$oner->view("itemid_example","itemdesc_example","itemurl_example")."</pre><br>";
echo "buy function:<br>";
echo "<pre>".$oner->buy("itemid_example","itemdesc_example","itemurl_example")."</pre><br>";
echo "rate function:<br>";
echo "<pre>".$oner->rate("itemid_example","itemdesc_example","itemurl_example",4)."</pre><br>";
*/
?>
