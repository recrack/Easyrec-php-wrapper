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
    private $apikey   = "API_KEY";
    private $tenantid = "EASYREC_DEMO";
    private $request_url = "http://intralife.researchstudio.at:8080/api/1.0";

    
    #    Constructor
    function __construct ($userid)
    {
        $this->userid=$userid;
        $this->sessionid=$sessionid;        
    }
    
    private function request($get_params)
    {
        if($get_params) {
            $url = $this->request_url.$get_params;
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
            $this->request("/view?apikey=".$this->apikey."&tenantid=".$this->tenantid."&itemid=".$itemid."&itemdescription=".$itemdesc."&itemurl=".$itemurl."&userid=".$this->userid."&sessionid=".$this->sessionid);
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
            return$this->request("/buy?apikey=".$this->apikey."&tenantid=".$this->tenantid."&itemid=".$itemid."&itemdescription=".$itemdesc."&itemurl=".$itemurl."&userid=".$this->userid."&sessionid=".$this->sessionid);
        }
        else {
            return 0;
        }    
    }

}

?>
