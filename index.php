<?php
set_time_limit(0);
error_reporting(0);
echo "<title>WordPress Theme Scanner</title>
<link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
<style type=\"text/css\">
  body,b,input,a {
      background-color: #f0f0f2;
      margin: 0;
      padding: 0;
       font-family: 'Orbitron', sans-serif;
   
  }
#found{color:Red;}
textarea,input {
     resize:none;
     color: #4099FF ;
     border: 4px solid #3B5998;}
 
</style>
<form method='POST'>
<center><br /></br>
     <font face='Tahoma' size='5'><b>WordPress Theme Scanner</b></font><br />
<br /></br><textarea type='text' name='url' placeholder='Enter URL List Line By Line' rows='20' cols='45'>http://www.pagesinventory.com/\nhttp://worryfreelabs.com/\nhttp://www.thisisyourkingdom.co.uk/\nhttp://www.creativebloq.com/\nhttp://www.travelportland.com/\nhttp://ishothim.com/\nhttp://www.harveynichols.com/\nhttp://www.greatlengthshair.co.uk/\nhttp://www.techcrunch.com/\nhttp://clicksor.com/\nhttp://informer.com/\nhttp://xda-developers.com/\nhttp://tutsplus.com/\nhttp://smashingmagazine.com/\nhttp://cbslocal.com/\nhttp://dyndns.org/\nhttp://sitepoint.com/\nhttp://larrykinglive.blogs.cnn.com/\nhttp://www.nytco.com/\nhttp://blog.directlife.philips.com/\nhttp://www.freeformatter.com/\nhttp://delim.co/</textarea><br />
 <br /></br><input type='submit' name='start' value='Scan Wordpress Theme'><br /></br>
     
</center></form>";
 
function wordpress_theme_scanner($urls)
        {
        $data = file_get_contents($urls);
        if (eregi('WordPress', $data) || eregi('wp-', $data) || eregi('wp-includes', $data) || eregi('wp-admin', $data) || eregi('wp-content', $data))
                {
                preg_match_all("|<link[^>]+/>|", $data, $matches, PREG_PATTERN_ORDER);
                foreach($matches[0] as $theme)
                        {
                        if (eregi('theme', $theme))
                                {
                                preg_match_all("/href='(.*?)'/", $theme, $matches);
                                $r = $matches[1][0] . "";
                                $r = explode('/', $r);
                                $r = array_filter($r);
                                $r = array_merge($r, array());
                                echo "$urls - > " . $r[4] . "\r\n";
                                flush();
                                @ob_flush();
                                break;
                                }
                        } //end of foreach
                } //end of check if its Wordress Website
          else
                {
                echo "$urls Is Not Wordpress Website\r\n";
                }
        } //end of function
 
if (isset($_POST['start']))
        {
        echo "<center><textarea rows='18' cols='90' id='found'>";
        $url = explode("\r\n", $_POST['url']);
        foreach($url as $urls)
                {
                wordpress_theme_scanner($urls);
                flush();
                @ob_flush();
                }
 
        echo "</textarea></center>";
        }
 
?>
