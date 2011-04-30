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
    public function alsoViewed($itemid,$n=10)
    {     
        if(!empty($itemid)) {
            $rec = new SimpleXMLElement($this->request("/otherusersalsoviewed?itemid=".$itemid."&userid=".$this->userid."&numberOfResults=".$n));
            return $rec->recommendeditems->item;
        }
        else {
            return 0;
        }
    } 
    
    /*
        return   id,type,description,url,[imageurl]
    */
    public function alsoBought($itemid,$n=10)
    {
        if(!empty($itemid)) {
            $rec = new SimpleXMLElement($this->request("/otherusersalsobought?itemid=".$itemid."&userid=".$this->userid."&numberOfResults=".$n));
            return $rec->recommendeditems->item;
        }
        else {
            return 0;
        }
    }
    
    /*
        return   id,type,description,url,[imageurl]
    */
    public function ratedGood($itemid,$n=10)
    {
        if(!empty($itemid)) {
            $rec = new SimpleXMLElement($this->request("/itemsratedgoodbyotherusers?itemid=".$itemid."&userid=".$this->userid."&numberOfResults=".$n));
            return $rec->recommendeditems->item;
        }
        else {
            return 0;
        }
    }
    
    /*
        return   id,type,description,url,[imageurl]
    */
    public function recForUser($user_id="",$n=10)
    {
        if($user_id !== "") {
            $rec = new SimpleXMLElement($this->request("/recommendationsforuser?userid=".$user_id."&numberOfResults=".$n));
        }
        else {
            $rec = new SimpleXMLElement($this->request("/recommendationsforuser?userid=".$this->userid."&numberOfResults=".$n));
        }
        return $rec->recommendeditems->item;
    }
    
    /*
        return   id,type,description,url,[imageurl]
    */
    public function relatedItems($itemid,$n=10)
    {
        $rec = new SimpleXMLElement($this->request("/relateditems?itemid=".$itemid."&userid=".$this->userid."&numberOfResults=".$n));
        return $rec->recommendeditems->item;
    }
}

#doc
#    classname:    Rankings
#    scope:        PUBLIC
#
#/doc

class Rankings
{
    #    internal variables
    private $apikey   = "3d66b20f7cbf176bf182946a15a5378e";
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
        return   id,type,description,url,[imageurl],[value]
        $timeRange => DAY,WEEK,MONTH,ALL
    */
    public function mostViewed($timeRange="ALL",$n=10)
    {
        $rec = new SimpleXMLElement($this->request("/mostvieweditems?timeRange=".$timeRange."&numberOfResults=".$n));
        return $rec->recommendeditems->item;
    }
    
    /*
        return   id,type,description,url,[imageurl],[value]
        $timeRange => DAY,WEEK,MONTH,ALL
    */
    public function mostBought($timeRange="ALL",$n=10)
    {
        $rec = new SimpleXMLElement($this->request("/mostboughtitems?numberOfResults=".$n."&timeRange=".$timeRange));
        return $rec->recommendeditems->item;
    }
    
    /*
        return   id,type,description,url,[imageurl],[value]
        $timeRange => DAY,WEEK,MONTH,ALL
    */
    public function mostRated($timeRange="ALL",$n=10)
    {
        $rec = new SimpleXMLElement($this->request("/mostrateditems?numberOfResults=".$n."&timeRange=".$timeRange));
        return $rec->recommendeditems->item;
    }
    
    /*
        return   id,type,description,url,[imageurl],[value]
        $timeRange => DAY,WEEK,MONTH,ALL
    */
    public function bestRated($timeRange="ALL",$n=10)
    {
        $rec = new SimpleXMLElement($this->request("/bestrateditems?numberOfResults=".$n."&timeRange=".$timeRange));
        return $rec->recommendeditems->item;
    }
    
    /*
        return   id,type,description,url,[imageurl],[value]
        $timeRange => DAY,WEEK,MONTH,ALL
    */
    public function worstRated($timeRange="ALL",$n=10)
    {
        $rec = new SimpleXMLElement($this->request("/worstrateditems?numberOfResults=".$n."&timeRange=".$timeRange));
        return $rec->recommendeditems->item;
    }

}
?>
