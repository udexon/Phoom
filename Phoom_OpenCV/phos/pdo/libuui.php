<?php

$BV=array();

function fgl_nlc() // nlc: newline character, to explode long string with newline into array
{
    global $S;
    
    $S[]="\n";

}

function fgl_commanl()
{
    global $S;

// $a=file_get_contents(array_pop($S));

$S[]=preg_replace('/,/', ",\n", array_pop($S));


}

function fgl_bv() // varvalue varname bv: Bash style variable ${X} varname=varvalue
{
    global $BV, $S;    
    
    $a=array_pop($S);     $b=array_pop($S);
    // echo __FUNCTION__." ".__LINE__." a ".$a." b ".$b."  ";
    // $BV[array_pop($S)]=array_pop($S);
    $BV[$a]=$b;

}

function fgl_fgh() // fgh: file_get_html()
{
    global $S;
    $S[]=file_get_html(array_pop($S));
}

function fgl_it() // object text it: set innertext
{
    global $S;
        
    $a=array_pop($S);
    $b=array_pop($S);
    $b->innertext=($a);

}

function fgl_find() // object pattern find:
{
    global $S;
    
    $a=array_pop($S);
    $b=array_pop($S);
    $S[]=$b->find($a);

}

function F() // variable list of parameters, single letter function name
{
    global $S;

    $count=0;

  if(func_num_args( ) == 0) {
    return false;
  }
  else {
    // echo " ".__LINE__.">> ".func_num_args( )." ";
    for($i = 0; $i < func_num_args( )-1; $i++) {
    
      // echo " $i ".__LINE__.">> ".func_get_arg( $i )." ";
      
      // var_dump(func_get_arg( $i ));
      // echo gettype(func_get_arg( $i ))." ";
      
      $S[]=func_get_arg( $i );
           
    
      // $count += func_get_arg($i);
    }
    // return $count;
    
//    echo "\n\n".__LINE__.">> ".gettype(func_get_arg( $i ))." ".$i." ".func_get_arg( $i )." ";
    
    FGL(func_get_arg( $i ));
  }


}



function FGLV() // variable list of parameters
{
    global $S;

    $count=0;

  if(func_num_args( ) == 0) {
    return false;
  }
  else {
    // echo " ".__LINE__.">> ".func_num_args( )." ";
    for($i = 0; $i < func_num_args( )-1; $i++) {
    
      // echo " $i ".__LINE__.">> ".func_get_arg( $i )." ";
      
      // var_dump(func_get_arg( $i ));
      // echo gettype(func_get_arg( $i ))." ";
      
      $S[]=func_get_arg( $i );
           
    
      // $count += func_get_arg($i);
    }
    // return $count;
    
//    echo "\n\n".__LINE__.">> ".gettype(func_get_arg( $i ))." ".$i." ".func_get_arg( $i )." ";
    
    FGL(func_get_arg( $i ));
  }


}

function fgl_nn1() // $object n2 n1 n0 N nn: get node by index, depth N, one level
{
    global $S;
    

    $N=array_pop($S);
    $l=count($S);
    echo __LINE__.">> ".$l." ".$N." ".gettype($S[$l-$N]);
    fgl_st();
    $n=array_pop($S);
    $O=array_pop($S);
    $A=$O->childNodes();
    echo " ".$O->tag." ".gettype($A[$n])." ".$A[$n]->tag." ";


}

function fgl_nn2() // $object n2 n1 n0 N nn: get node by index, depth 2
{
    global $S;
    

    $N=array_pop($S);
    $l=count($S);
    echo __LINE__.">> ".$l." ".$N." ".gettype($S[$l-$N]);
    fgl_st();
    $n=array_pop($S);
    $O=array_pop($S);
    $A=$O->childNodes();
    echo " ".$O->tag." ".gettype($A[$n])." ".$A[$n]->tag." ";
    
    $C=$A[$n];
    $A=$C->childNodes();
    echo count($A);
    echo " ".gettype($A[$n])." ".$A[$n]->tag." ";
    
    $C=$A[$n];
    $A=$C->childNodes();
    echo count($A)." ";


}

function fgl_nn() // $object n2 n1 n0 N nn: get node by index, depth N
{
    global $S;
    
    $N=array_pop($S);
    $l=count($S);
    
    // echo __LINE__.">> "; fgl_stv();
    
    // echo __LINE__.">> ".$l." ".$N." ".gettype($S[$l-$N-1]);

    // $n=array_pop($S);
    // $O=array_pop($S);
    $O=$S[$l-$N-1]; // no pop?
    
    // echo "\n\n".__LINE__.">> ".gettype($O)." ".$O->outertext;
    
    $A=$O->childNodes();
    $noc=count($A);
    // echo " ".__LINE__.">> noc ".count($A)." "; // NOC (number of Children) of first level, stop if 0
    $N--;
    $n=array_pop($S);
    // echo "\n\n".__LINE__.">> ".gettype($O)." ".$O->outertext;
    // echo __LINE__.">> ".$N." ".$n." ".$A[$n]->outertext;
    
    while ($noc>0 && $N>0) {
    
        // echo "\n\n".__LINE__.">> "." ".$O->tag." ".gettype($A[$n])." ".$A[$n]->tag." ";
        
        $C = $A[$n];
        $A = $C->childNodes();
        $noc=count($A);
        
        // echo " noc ".count($A)." "; // NOC (number of Children) 
        
        $N--;
        if ($N==0) break;
        
        $n=array_pop($S);
    }
    
    if ($N>1) {
    
        $n=array_pop($S);
        // echo "\n\n".__LINE__.">> "." n ".gettype($n);
        // echo gettype($A[$n])." ".$A[$n]->tag." ";
    }    
        $C=$A[$n];
        $A=$C->childNodes();
        // echo count($A)." ";
        
        // echo "\n\n".$C->outertext;
        
        // $C->innertext="ref ref ref";    

        $S[]=$C;
        $S[]=count($A);
}

// my_var_export($S);

function fgl_nl() // echo "\n" newline
{
        global $BV;
        if (isset($BV['ECHO'])) if ($BV['ECHO']=="ON") echo "\n";
}

function fgl_st() // so: list stack gettype
{
    global $S;
    
    echo "< ".count($S)." > ";
    
    foreach($S as $e) echo gettype($e)." ";

}

function fgl_stv() // stv: list stack gettype var_src
{
    global $S;
    
    echo "< ".count($S)." > ";
    
    foreach($S as $e) { 
    if (gettype($e)=="object" || gettype($e)=="array" ) 
      echo " ". gettype($e)." ";
      //continue;
      // $a=$e;
    // else unset($a);
    
    // error due to array of objects!! cannot var_export
    
    // echo   (gettype($e)!="object");
    //  if (isset($a)) {
    else echo " ". gettype($e)." ". json_encode($e).", "; 
}
}


function my_var_export($var, $is_str=false)
         {$rtn=preg_replace(array('/Array\s+\(/', '/\[(\d+)\] => (.*)\n/', '/\[([^\d].*)\] => (.*)\n/'), array('array (', '\1 => \'\2\''."\n", '\'\1\' => \'\2\''."\n"), substr(print_r($var, true), 0, -1));
          $rtn=strtr($rtn, array("=> 'array ('"=>'=> array ('));
          $rtn=strtr($rtn, array(")\n\n"=>")\n"));
          $rtn=strtr($rtn, array("'\n"=>"',\n", ")\n"=>"),\n"));
          $rtn=preg_replace(array('/\n +/e'), array('strtr(\'\0\', array(\'    \'=>\'  \'))'), $rtn);
          $rtn=strtr($rtn, array(" Object',"=>" Object'<-"));
          if ($is_str)
             {return $rtn;
             }
          else
              {echo $rtn;
              }
         }



function fgl_gtp() // var gt: gettype( var )
{
    global $S;
    
    $a=array_pop($S);

    $S[]= gettype($a);

}

function fgl_gtpx() // var gtpx: gettype( var ), x=no pop
{
    global $S;
    
    $a=end($S);

    $S[]= gettype($a);

}


function fgl_esp() // string esp: echo $str." " ; echo string followed by space
{
    global $S, $BV;
    
    $a=array_pop($S);

    if (isset($BV['ECHO'])) if ($BV['ECHO']=="ON") echo $a." "; // turn ECHO ON / OFF between functions

}

function fgl_ses() // string ess: echo " ".$str." " ; echo string, prepended followed by space
{
    global $S;
    
    $a=array_pop($S);

    echo " ".$a." ";

}



function fgl_gc() // object gc: get_class object
{
    global $S;
    
    // $b=array_pop($S);     
    $a=array_pop($S);

   $S[]= get_class($a);

    // $S[] = eval('return '.$html.'->'.childNodes.'();');
    // $S[] = eval('return '.$a.'->'.$b.'();');
   // $S[] = eval('return $a->'.$b.'();');
}

function fgl_mthd() // object method mthd: arrow object -> method
{
    global $S;
    
    $b=array_pop($S);     $a=array_pop($S);

   // echo get_class($a);

    // $S[] = eval('return '.$html.'->'.childNodes.'();');
    // $S[] = eval('return '.$a.'->'.$b.'();');
    $S[] = eval('return $a->'.$b.'();');
}

function fgl_mbr() // object member mbr: arrow object -> member
{
    global $S;
    
    $b=array_pop($S);     $a=array_pop($S);

   // echo get_class($a);

    // $S[] = eval('return '.$html.'->'.childNodes.'();');
    // $S[] = eval('return '.$a.'->'.$b.'();');
    $S[] = eval('return $a->'.$b.';');
}

function fgl_mbrx() // object member mbrx: arrow object -> member, x=no pop
{
    global $S;
    
    $b=array_pop($S);     $a=end($S);

    echo " ".__LINE__." ".$b." ";
   // echo get_class($a);

    // $S[] = eval('return '.$html.'->'.childNodes.'();');
    // $S[] = eval('return '.$a.'->'.$b.'();');
    // $S[] = eval('return $a->'.$b.';');
    echo $a->tag." ";
    $S[] = eval('return $a->'.'tag'.';');
}


function file_get_html_node($url, $use_include_path = false, $context=null, $offset = -1, $maxLen=-1, $lowercase = true, $forceTagsClosed=true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN=true, $defaultBRText=DEFAULT_BR_TEXT, $defaultSpanText=DEFAULT_SPAN_TEXT)
{
	// We DO force the tags to be terminated.
	$dom = new simple_html_dom_node(null, $lowercase, $forceTagsClosed, $target_charset, $stripRN, $defaultBRText, $defaultSpanText);
	// For sourceforge users: uncomment the next line and comment the retreive_url_contents line 2 lines down if it is not already done.
	$contents = file_get_contents($url, $use_include_path, $context, $offset);
	// Paperg - use our own mechanism for getting the contents as we want to control the timeout.
	//$contents = retrieve_url_contents($url);
	if (empty($contents) || strlen($contents) > MAX_FILE_SIZE)
	{
		return false;
	}
	// The second parameter can force the selectors to all be lowercase.
	$dom->load($contents, $lowercase, $stripRN);
	return $dom;
}

