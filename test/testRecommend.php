<?php
assert_options(ASSERT_WARNING, 0);
function fail($file, $line, $z)
{
    echo "<div style='background-color:red; padding:3px;'>Test Failed. File='$file' Line='$line'</div>";
}
function ok($msg) {
    echo "<div style='background-color:lime; padding:3px;'>$msg</div>";
}
assert_options(ASSERT_CALLBACK, 'fail');
    require_once('../Recommend.php');
    $as = new Recommender("a","v");
    assert(strpos($as->view("itemid_example","itemdesc_example","itemurl_example"),"<error")==false) and ok("view test passed");
?>
