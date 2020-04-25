// <?php

function FGL($a) // 5gl to php bootstrap code, use function argument as input string
{
    global $argv, $S, $SS, $xk, $xs, $SC, $SL;

    // $D=1;
    // echo __LINE__ . " php: ";     fgl_s();
    
    // $a = array_pop($S);
    $a = preg_replace('/\s+/', ' ', $a);
    $a = explode(' ', $a);
    $SS[] = array(0, $a); // 2018 08 02 new items pushed to $SS, caused problem?
    $xc = count($SS);
    $xk =& $SS[$xc - 1][0];
    $xs =& $SS[$xc - 1][1];
    $xl = count($SS[$xc - 1][1]);
//    echo "\n" . __FUNCTION__ . " " . __LINE__ . " xs: "; //    fgl_s();
//    echo "\n";
    $vk = $xk;
    
    $Z=$xl;
        
        if (isset($D)) echo "\n" . __FUNCTION__ . " start " . __LINE__ . " vk ". $vk . " Z ". $Z . " SS " . var_src($SS)."\n";

    // get $CC
    $S[]=$vk; // fgl_CC(); 
    // fgl_s(); 
    $t=array_pop($S);     $CC=$t[0]; 
    // echo " CC " . $CC . "\n";
    
    // 2018 07 10
    do {
    // while ($vk < $xl) {
        $vk = $xk;
        $v = trim($xs[$xk]);
        
        if (isset($D)) {        echo "\n xs: " . __LINE__ . " ";
            echo " v ". $v ." length ".count($v)." ord ". ord($v) ." vk " . $vk . " " . var_src($xs); }
        
        if ($v == ">:" || $v == "<:") {
            $S[] = $v;
        } else {
            $l = strlen($v);
            if ($v[$l-1]==":") { 
            // if (strpos($v, ":")) {
                $l = strlen($v);
                $fn = substr($v, 0, $l - 1);
                if (function_exists("fgl_" . $fn)) {
                
                    if (isset($D)) echo " xs: line " . __LINE__ . " fgl_" . $fn . " ";
                
                    call_user_func("fgl_" . $fn);
					
					if (is_array(end($S))) { // xif: executes TRUE or FALSE part, push prg_ctr to stack
						$va = end($S);
						// echo "\n\n xs: " . __LINE__ . " v " . $v . " xk " . $xk . " vk " . $vk . "\n"; fgl_s();
						
						// if (in_array("prg_ctr", end($S))) { 
						if (isset($va[0])) if ($va[0]=="prg_ctr") {
							// this is returned immediately  by xif: AFTER any of TRUE or FALSE block is executed
                            // echo "\n xs: ".__LINE__." SC < ".count($SC)." > ".var_src($SC);
							// echo "\n\n xs: " . __LINE__ . " v " . $v . " xk " . $xk . " vk " . $vk . "\n"; fgl_s();
							$va = array_pop($S);
							// $vk = $va[1] + 1;
							$vk = $va[1]; $xk=$vk;
                        // $vk = $va[1] + 1; // 2018 0707 does this cause vk(13) to be skipped?
                        
   						if (isset($D)) echo "\n xs: " . __LINE__ . " v " . $v . " xk " . $xk . " vk " . $vk . " Z " . $Z . " SC[CC][3] " . $SC[$CC][3] ."\n";     
   						
   						// $Z = $SC[$CC][3];
						}
					}
										
                }
                
                else if ($fn=="r") {
                
                    echo __LINE__." r: ";
                    // fgl_s();
                    
                    // push remainder of command string to stack?
                    $s=array_pop($S);
                    // $S[]=$xk; // $S[]=$xs; 
                    $S[]=implode(' ', array_slice($xs, $xk+1));
                    
                    // $S[]='$S[]=$'.array_pop($S).'; ';
                    $S[]='$S[]=$'.$s.'; '; $S[]=':r:'; // flag, swap after eval()
                    fgl_s(); return;
                
                
                }
                
                else if ($fn=="v") {
                
                    echo "\n".__LINE__." v: ";
                    // fgl_s();
                    
                    // push remainder of command string to stack?
                    $sa=array_pop($S);
                    $sb=array_pop($S);

                    // $S[]=$xk; // $S[]=$xs; 
                    $S[]=implode(' ', array_slice($xs, $xk+1));
                    
                    // $S[]='$S[]=$'.array_pop($S).'; ';
                    // $S[]='$S[]=$'.$s.'; ';
                    $S[]='$'.$sa.'='.$sb.'; '; $S[]=':v:'; // flag, no swap after eval()
                    fgl_s(); return;
                
                
                }
                
                else if ($fn=="a") {
                
                    echo "\n".__LINE__." v: ";
                    // fgl_s();
                    
                    // push remainder of command string to stack?
                    $sa=array_pop($S);
                    $sc=count($S);
                    $se=$S[ $sc - $sa ];
                    
                    for ($si=0; $si<$sa; $si++) {
                    
                    }
                    
                    $sb=array_pop($S);

                    // $S[]=$xk; // $S[]=$xs; 
                    $S[]=implode(' ', array_slice($xs, $xk+1));
                    
                    // $S[]='$S[]=$'.array_pop($S).'; ';
                    // $S[]='$S[]=$'.$s.'; ';
                    $S[]='$'.$sa.'='.$sb.'; '; $S[]=':v:'; // flag, no swap after eval()
                    fgl_s(); return;
                
                
                }
                
                else if ($fn=="count") {
                
                    echo __LINE__." r: ";
                    fgl_s();
                    
                    $S[]='$S[]=count('.array_pop($S).'); ';
                
                
                
                }
                
           else if ($fn=="bz")
           {
           // bz, bzn, bt branch if true, bf branch if false
           
           echo " bz: "; 
           
           // $S[] = $SL[ array_pop($S) ];
           
           fgl_s();
           
           $bx = array_pop($S);
           
          // if (array_pop($S)==0) $xk=$SL[ array_pop($S) ];
          if (array_pop($S)==0) $xk = $bx;
          continue;
           
           }    
           
           else if ($fn=="bnz")
           {
           // bz, bzn, bt branch if true, bf branch if false
           
           // echo "\nbnz: "; 
           
           // $S[] = $SL[ array_pop($S) ];
           
           // fgl_s();
           
           // echo var_src($SS);
           
           $bx = $SL[ array_pop($S) ]; // array_pop($S);
           
           // fgl_s();
           
          // if (array_pop($S)==0) $xk=$SL[ array_pop($S) ];
          fgl_dup();
          if (array_pop($S)!=0)  { $xk = $bx + 1; continue; }
          // else continue;
          
          // echo __LINE__." ".$xk." ".$v."\n"; // exit;
          // continue;
           
           }    
                
                
                else {
                    echo " line ".__LINE__ . " fgl_" . $fn . " error.\n";
                }
            } else {
                if (ord($v)==0) echo " null char ";
                else
                if ($v[0] == '_') {
//                    echo "line " . __LINE__ . " ";                    echo "_x";
					
					if ($v=='_') $S[]=$v;
					
                } else {
                    if ($v == '.s') {
                        echo "\nline " . __LINE__ . " {$v} ";
                        fgl_s();
                    } else {
                        if ($v == '-') {
                            // $S[] = array_pop($S) - array_pop($S);
                            $sa = array_pop($S);
                            $sb = array_pop($S);
                            $S[] = $sb - $sa; 
                        } 
                        else if ($v == '+') {
                            // $S[] = array_pop($S) - array_pop($S);
                            $sa = array_pop($S);
                            $sb = array_pop($S);
                            $S[] = $sb + $sa; 
                        }
                        else if ($v == '.') { 
                            array_pop($S);
                        }
                        else {
                            if ($v == '===') {
                                $S[] = array_pop($S) === array_pop($S);
                            } else {
                                $S[] = $v;
                            }
                        }
                    }
                }
            }
        }
        $xk++;
        if ($xk >= $xl) {
            break;
        } 
    } while ($vk < $xl);
    
    // echo "\n" . __FUNCTION__ . " " . __LINE__ . " SS ".var_src($SS);
    
    $S[]=":END:";
}
