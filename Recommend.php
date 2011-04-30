<?php

#doc
#    classname:    Actions
#    scope:        PUBLIC
#
#/doc
error_reporting(E_ALL);
ini_set('display_errors','On');
class Actions
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







#doc
#    classname:    Recommendations
#    scope:        PUBLIC
#
#/doc

class Recommendations
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
    
    /*
        return   id,type,description,url,[imageurl]
    */
    public function alsoViewed($itemid)
    {     
        if(!empty($itemid)) {
            $rec = new SimpleXMLElement($this->request("/otherusersalsoviewed?itemid=42&userid=24EH1723322222A3"));
            return $rec->recommendeditems->item;
        }
        else {
            return 0;
        }
    } 
    
    /*
        return   id,type,description,url,[imageurl]
    */
    public function alsoBought($itemid)
    {
        if(!empty($itemid)) {
            $rec = new SimpleXMLElement($this->request("/otherusersalsobought?itemid=".$itemid."&userid=".$this->userid));
            return $rec->recommendeditems->item;
        }
        else {
            return 0;
        }
    }
    
    /*
        return   id,type,description,url,[imageurl]
    */
    public function ratedGood($itemid)
    {
        if(!empty($itemid)) {
            $rec = new SimpleXMLElement($this->request("/itemsratedgoodbyotherusers?itemid=".$itemid."&userid=".$this->userid));
            return $rec->recommendeditems->item;
        }
        else {
            return 0;
        }
    }
    
    /*
        return   id,type,description,url,[imageurl]
    */
    public function recForUser($user_id="")
    {
        if($user_id !== "") {
            $rec = new SimpleXMLElement($this->request("/recommendationsforuser?userid=".$user_id));
        }
        else {
            $rec = new SimpleXMLElement($this->request("/recommendationsforuser?userid=".$this->userid));
        }
        return $rec->recommendeditems->item;
    }
    
    public function relatedItems($itemid)
    {
        $rec = new SimpleXMLElement($this->request("/relateditems?itemid=".$itemid."&userid=".$this->userid));
        return $rec->recommendeditems->item;
    }
}
?>
