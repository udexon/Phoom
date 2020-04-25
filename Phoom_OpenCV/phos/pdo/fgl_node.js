// module.exports = FGL, fgl_l;
module.exports = {
    FGL: FGL,
    fgl_l: fgl_l
};

var $SL=[],$xk;


function fgl_dup()
{
S.push(end(S));
}

function fgl_l() // X l: label X, set index to $SL['X'] for bz: branch if zero and bnz:
{

    $S=S;
    $SL[array_pop($S)]=$xk;

}


function end(a)
{
return a[a.length-1];
}


function function_exists(f)
{
// if (typeof global !== "undefined") window=global;
if (typeof module !== "undefined") window=module;
console.log('function_exists ' + f +' '+ typeof window[f] +' global '+ typeof global 
+ '    module ' + typeof module + '    eval ' + eval("typeof " + f) );
// typeof eval(f) );
// return (typeof window[f] === "function");
return (eval("typeof " + f) === "function");
}

function is_array(f)
{
// console.log(f +' '+ typeof window[f]);
return (typeof f === "object");
}

function isset(f)
{
// console.log(f +' '+ typeof window[f]);
return (typeof f === "undefined");
}


function substr(s, n, l)
{

return s.substr(n, l);

}

function fgl_ne()　//  .... arg1 arg2 arg3 ... funcname N ne: native eval(), N arguments
{
    // global $S;
    $S=S; // call by reference
    
    $n = array_pop($S);
    if ($n == 0) {
        e = eval("return " + array_pop($S) + "();" );
        S.push(e);
    } else {
        if (0) {
            $s = array_pop($S) + "(" + "array_pop(\$S)";
            while ($n-- > 1) {
                $s = $s + ", " + "array_pop(\$S)";
            }
            // echo __LINE__ . " " . $s;
            e = eval("return " + $s + ");");
            S.push(e);
        } else {
            $s = array_pop($S) + "(" + array_pop($S);
            while ($n-- > 1) {
                $s = $s + ", " + "array_pop(\$S)";
            }
            console.log($s);
            // e = eval("return " + $s + ");");
            e = eval( $s + ")");
            S.push(e);
        }
    }
}

function ord(n)
{
return n.charCodeAt(0);
}

function strlen(s)
{
return s.length;
}

function in_array(e, a)
{
console.log( typeof e + " " + e + "    " + typeof a + " " + a)
return (a.indexOf(e) != -1);

}

function array_keys(a)
{

return Object.keys(a);

}

function array_pop(s)
{
// alert(' in array_pop: '+s);
return s.pop();
}

function explode(c, a)
{
    var s;
    
    s=a.split(c);
    // return a.split(c);
    return s;

}


function preg_replace(p, r, a)
{

return a.replace(p, r);

}

function trim(a)
{

return a.trim();

}

function fgl_cl()
{
console.log(S.pop());
}

function fgl_s()
{
console.log(S);
}

function count(a)
{

return a.length;

}

var $CDW=[], S=[], $v, s0="";

function FGL($a) // 5gl to php bootstrap code, use function argument as input string; add colon definition;
{

// must initialize $S $SS outside

//    global $argv, $S, $SS, $xk, $xs, $SC, $SL, $CDW; // $CDW: colon defined words
    
    // $CDW=array(); // need to be defined globally

    // $D=1;
    // echo __LINE__ . " php: ";     fgl_s();
    
    // $a = array_pop($S);
    // $a = preg_replace('/\s+/', ' ', $a);
    
    s0 = preg_replace('/\s+/', ' ', $a);
    var $a = explode(' ', trim(s0)); // remove front and trailing spaces
    
    console.log($a);
    
    // $SS[] = array(0, $a); // 2018 08 02 new items pushed to $SS, caused problem?
    
    // JS1019
    var $SS=[], $xl=0;
    
    
    $xk=0;
    $xs=$a;
    
        console.log($xs);
    
    // $xc = count($SS);
    // $xk =& $SS[$xc - 1][0];
    // $xs =& $SS[$xc - 1][1];
    
    // JS1019
    $xl=count($a);    
    // $xl = count($SS[$xc - 1][1]);

//    echo "\n" . __FUNCTION__ . " " . __LINE__ . " xs: "; //    fgl_s();
//    echo "\n";
    $vk = $xk;
    
    $Z=$xl;
        
       //  if (isset($D)) { echo "\n" . __FUNCTION__ . " start " . __LINE__ . " vk ". $vk . " Z ". $Z . " SS " . var_src($SS)."\n";

    // get $CC
    S.push($vk); // $S[]=$vk; // fgl_CC(); 
    // fgl_s(); 
    $t=array_pop(S);     $CC=$t[0]; 
    // echo " CC " . $CC . "\n";
    //    }
    
    // 2018 07 10
    do {

        $vk = $xk;
       
        
        console.log(' v '+$v + ' vk ' + $vk + ' xl ' + $xl + ' S ' + S);
         $v = trim($xs[$xk]);
            
        if (in_array($v, array_keys($CDW))) { // $CDW colon defined words, unify Forth (no colon) and Unicode
                
                 //   echo __LINE__." in CDW ".var_src($CDW[$v]);
                    
                    // $S[]=
                    $WA = $CDW[$v]; array_pop($WA); // remove semicolon;
                    // FGLA($CDW[$fn.":"]);
                    FGLA($WA);
                
        }    
        
        else if ($v == ">:" || $v == "<:") {
            S.push($v); // $S[] = $v;
        } else {
            $l = strlen($v);
            // echo __LINE__." ".$v." ";
            // 2018-10-08 colon definition, include Unicode?
            // echo "# ".$l." #". $v."#";
            if ($v[0]==":" && $l==1) {
               // echo "is colon; ";  
                
                $xk++; $vk =  $xk; $v = trim($xs[$xk]);
              //  echo __LINE__." WORD to define: ".$v." ". $vk ." ". $xk ."    "; // word to define
                // $CDW[$v]=array();
                $CDW[$v]=[];
               // echo var_src($CDW);
                $w0 = $v;
                $xk++;
                
                do {
                    $vk =  $xk;
                    $v = trim($xs[$xk]);

                  //  echo __LINE__." ".$v." ". $vk ." ". $xk ."    ";
                    
                    $CDW[$w0].push($v);// $CDW[$w0][]=$v;

                    $l = strlen($v);
                    if ($v[0]==";" && $l==1) {
                       // echo "\n".__LINE__." is semi-colon; ";
                      //  echo var_src($CDW);
                        // $xk++;
                        break;
                    }
                    $xk++;
                } while (1);
            }
            
            else if ($v[$l-1]==":") { 
            // if (strpos($v, ":")) {
                $l = strlen($v);
                $fn = substr($v, 0, $l - 1);
                
                console.log(function_exists("fgl_" + $fn) +' '+ ("fgl_" + $fn));
                
                if (function_exists("fgl_" + $fn)) {
                
                    // if (isset($D)) echo " xs: line " . __LINE__ . " fgl_" . $fn . " ";
                
                    // call_user_func("fgl_" . $fn);
                    eval("fgl_" + $fn + "()");
					
					if (is_array(end(S))) { // xif: executes TRUE or FALSE part, push prg_ctr to stack
						$va = end(S);
						// echo "\n\n xs: " . __LINE__ . " v " . $v . " xk " . $xk . " vk " . $vk . "\n"; fgl_s();
						
						// if (in_array("prg_ctr", end($S))) { 
						if (isset($va[0])) if ($va[0]=="prg_ctr") {
							// this is returned immediately  by xif: AFTER any of TRUE or FALSE block is executed
                            // echo "\n xs: ".__LINE__." SC < ".count($SC)." > ".var_src($SC);
							// echo "\n\n xs: " . __LINE__ . " v " . $v . " xk " . $xk . " vk " . $vk . "\n"; fgl_s();
							$va = array_pop(S);
							// $vk = $va[1] + 1;
							$vk = $va[1]; $xk=$vk;
                        // $vk = $va[1] + 1; // 2018 0707 does this cause vk(13) to be skipped?
                        
   						// if (isset($D)) echo "\n xs: " . __LINE__ . " v " . $v . " xk " . $xk . " vk " . $vk . " Z " . $Z . " SC[CC][3] " . $SC[$CC][3] ."\n";     
   						
   						// $Z = $SC[$CC][3];
						}
					}
										
                }
                
                else if (in_array($fn+":", array_keys($CDW))) { // $CDW colon defined words
                
                    // echo __LINE__." in CDW ".var_src($CDW[$fn.":"]);
                    
                    // $S[]=
                    $WA = $CDW[$fn+":"]; array_pop($WA); // remove semicolon;
                    // FGLA($CDW[$fn.":"]);
                    FGLA($WA);
                
                }

                
                else if ($fn=="r") {
                
                    // echo __LINE__." r: ";
                    // fgl_s();
                    
                    // push remainder of command string to stack?
                    $s=array_pop(S);
                    // $S[]=$xk; // $S[]=$xs; 
                    S.push(implode(' ', array_slice($xs, $xk+1))); // $S[]=implode(' ', array_slice($xs, $xk+1));
                    
                    // $S[]='$S[]=$'.array_pop($S).'; ';
                    S.push('$S[]=$'+$s+'; '); // $S[]='$S[]=$'.$s.'; '; 
                    S.push(':r:'); // $S[]=':r:';   // flag, swap after eval()
                    fgl_s(); // return 0;
                
                
                }
                
                else if ($fn=="v") {
                
                    // echo "\n".__LINE__." v: ";
                    // fgl_s();
                    
                    // push remainder of command string to stack?
                    $sa=array_pop(S);
                    $sb=array_pop(S);

                    // $S[]=$xk; // $S[]=$xs; 
                    
                    S.push(implode(' ', array_slice($xs, $xk+1)));
                    // $S[]=implode(' ', array_slice($xs, $xk+1));
                    
                    // $S[]='$S[]=$'.array_pop($S).'; ';
                    // $S[]='$S[]=$'.$s.'; ';
                    
                    S.push('$' + $sa + '=' + $sb + '; '); // $S[]='$'.$sa.'='.$sb.'; '; 
                    
                    S.push(':v:'); // $S[]=':v:';  // flag, no swap after eval()
                    fgl_s(); // return;
                
                
                }
                
                else if ($fn=="a") {
                
                    // echo "\n".__LINE__." v: ";
                    // fgl_s();
                    
                    // push remainder of command string to stack?
                    $sa=array_pop(S);
                    $sc=count(S);
                    $se=S[ $sc - $sa ];
                    
                    for ($si=0; $si<$sa; $si++) {
                    
                    }
                    
                    $sb=array_pop(S);

                    // $S[]=$xk; // $S[]=$xs; 
                    S.push(implode(' ', array_slice($xs, $xk+1)));
                    //$S[]=implode(' ', array_slice($xs, $xk+1));
                    
                    // $S[]='$S[]=$'.array_pop($S).'; ';
                    // $S[]='$S[]=$'.$s.'; ';
                    
                    S.push('$'+$sa+'='+$sb+'; '); S.push(':v:'); 
                    // $S[]='$'.$sa.'='.$sb.'; '; $S[]=':v:'; // flag, no swap after eval()
                    fgl_s(); // return;
                
                
                }
                
                else if ($fn=="count") {
                
                    // echo __LINE__." r: ";
                    fgl_s();
                    
                    S.push('$S[]=count('+array_pop(S)+'); ');
                    // $S[]='$S[]=count('.array_pop($S).'); ';
                
                
                
                }
                
           else if ($fn=="bz")
           {
           // bz, bzn, bt branch if true, bf branch if false
           
           // echo " bz: "; 
           
           // $S[] = $SL[ array_pop($S) ];
           
           fgl_s();
           
           $bx = array_pop(S);
           
          // if (array_pop($S)==0) $xk=$SL[ array_pop($S) ];
          if (array_pop(S)==0) $xk = $bx;
          continue;
           
           }    
           
           else if ($fn=="bnz")
           {
           // bz, bzn, bt branch if true, bf branch if false
           
           // echo "\nbnz: "; 
           
           // $S[] = $SL[ array_pop($S) ];
           
           // fgl_s();
           
           // echo var_src($SS);
           
           // fgl_stv();
           
           $bx = $SL[ array_pop($S) ]; // array_pop($S);
           
           // fgl_s();
           
          // if (array_pop($S)==0) $xk=$SL[ array_pop($S) ];
          fgl_dup();
          if (array_pop(S)!=0)  { $xk = $bx + 1; continue; }
          // else continue;
          
          // echo __LINE__." ".$xk." ".$v."\n"; // exit;
          // continue;
           
           }    
                
                
                else {
                    // echo " line ".__LINE__ . " fgl_" . $fn . " error.\n";
                }
                
            } else {
                if (ord($v)==0); // echo " null char ";
                else
                if ($v[0] == '_') {
//                    echo "line " . __LINE__ . " ";                    echo "_x";
					
					if ($v=='_') S.push($v); // $S[]=$v;
					
                } else {
                    if ($v == '.s') {
                        // echo "\nline " . __LINE__ . " {$v} ";
                        fgl_s();
                    } else {
                        if ($v == '-') {
                            // $S[] = array_pop($S) - array_pop($S);
                            $sa = array_pop(S);
                            $sb = array_pop(S);
                            // echo gettype($sb) ." ". $sb ." ". gettype($sa) ." ". $sa ." ";
                            
                            S.push($sb -  $sa); 
                            // $S[] = (int) $sb - (int) $sa; 
                        } 
                        else if ($v == '+') {
                            // $S[] = array_pop($S) - array_pop($S);
                            
                            console.log(' < in + >');
                            $sa = array_pop(S);
                            $sb = array_pop(S);
                            
                            console.log(' < in + > ' + $sa + ' ' + $sb + ' ' + ($sa + $sb) );
                            S.push( parseInt($sb) + parseInt($sa) ); 
                            // $S[] = $sb + $sa; 
                        }
                        else if ($v == '.') {

//                        fgl_stv(); 

                            array_pop(S);
                        }
                        else {
                            if ($v == '===') {
                            
                                S.push(array_pop(S) === array_pop(S));
                                // $S[] = array_pop($S) === array_pop($S);
                            } else {
                                S.push($v);
                                // $S[] = $v;
                            }
                        }
                    }
                }
            }
        }
        $xk++;
        if ($xk >= $xl) break;

    } 
    while ($vk < $xl);
    
    // echo "\n" . __FUNCTION__ . " " . __LINE__ . " SS ".var_src($SS);
    
    // $S[]=":END:";
    
    // return (0);
    
    function fgl_l() // X l: label X, set index to $SL['X'] for bz: branch if zero and bnz:
    {

        $S=S;
        $SL[array_pop($S)]=$xk;

    }

    
    
}


function FGLA($a) // 5gl to php bootstrap code, use function argument as input string; add colon definition;
{

// must initialize $S $SS outside

//    global $argv, $S, $SS, $xk, $xs, $SC, $SL, $CDW; // $CDW: colon defined words
    
    // $CDW=array(); // need to be defined globally

    // $D=1;
    // echo __LINE__ . " php: ";     fgl_s();
    
    // $a = array_pop($S);
    // $a = preg_replace('/\s+/', ' ', $a);
    
    // s0 = preg_replace('/\s+/', ' ', $a);
    // var $a = explode(' ', trim(s0)); // remove front and trailing spaces
    
    console.log($a);
    
    // $SS[] = array(0, $a); // 2018 08 02 new items pushed to $SS, caused problem?
    
    // JS1019
    var $SS=[], $xk=0, $xl=0;
    
    $xs=$a;
    
        console.log($xs);
    
    // $xc = count($SS);
    // $xk =& $SS[$xc - 1][0];
    // $xs =& $SS[$xc - 1][1];
    
    // JS1019
    $xl=count($a);    
    // $xl = count($SS[$xc - 1][1]);

//    echo "\n" . __FUNCTION__ . " " . __LINE__ . " xs: "; //    fgl_s();
//    echo "\n";
    $vk = $xk;
    
    $Z=$xl;
        
       //  if (isset($D)) { echo "\n" . __FUNCTION__ . " start " . __LINE__ . " vk ". $vk . " Z ". $Z . " SS " . var_src($SS)."\n";

    // get $CC
    S.push($vk); // $S[]=$vk; // fgl_CC(); 
    // fgl_s(); 
    $t=array_pop(S);     $CC=$t[0]; 
    // echo " CC " . $CC . "\n";
    //    }
    
    // 2018 07 10
    do {

        $vk = $xk;
        $v = trim($xs[$xk]);
        
        console.log($v + ' vk ' + $vk + ' xl ' + $xl + ' S ' + S);
        
            
        if (in_array($v, array_keys($CDW))) { // $CDW colon defined words, unify Forth (no colon) and Unicode
                
                 //   echo __LINE__." in CDW ".var_src($CDW[$v]);
                    
                    // $S[]=
                    $WA = $CDW[$v]; array_pop($WA); // remove semicolon;
                    // FGLA($CDW[$fn.":"]);
                    FGLA($WA);
                
        }    
        
        else if ($v == ">:" || $v == "<:") {
            S.push($v); // $S[] = $v;
        } else {
            $l = strlen($v);
            // echo __LINE__." ".$v." ";
            // 2018-10-08 colon definition, include Unicode?
            // echo "# ".$l." #". $v."#";
            if ($v[0]==":" && $l==1) {
               // echo "is colon; ";  
                
                $xk++; $vk =  $xk; $v = trim($xs[$xk]);
              //  echo __LINE__." WORD to define: ".$v." ". $vk ." ". $xk ."    "; // word to define
                // $CDW[$v]=array();
                $CDW[$v]=[];
               // echo var_src($CDW);
                $w0 = $v;
                $xk++;
                
                do {
                    $vk =  $xk;
                    $v = trim($xs[$xk]);

                  //  echo __LINE__." ".$v." ". $vk ." ". $xk ."    ";
                    
                    $CDW[$w0].push($v);// $CDW[$w0][]=$v;

                    $l = strlen($v);
                    if ($v[0]==";" && $l==1) {
                       // echo "\n".__LINE__." is semi-colon; ";
                      //  echo var_src($CDW);
                        // $xk++;
                        break;
                    }
                    $xk++;
                } while (1);
            }
            
            else if ($v[$l-1]==":") { 
            // if (strpos($v, ":")) {
                $l = strlen($v);
                $fn = substr($v, 0, $l - 1);
                
                console.log(function_exists("fgl_" + $fn) +' '+ ("fgl_" + $fn));
                
                if (function_exists("fgl_" + $fn)) {
                
                    // if (isset($D)) echo " xs: line " . __LINE__ . " fgl_" . $fn . " ";
                
                    // call_user_func("fgl_" . $fn);
                    eval("fgl_" + $fn + "()");
					
					if (is_array(end(S))) { // xif: executes TRUE or FALSE part, push prg_ctr to stack
						$va = end(S);
						// echo "\n\n xs: " . __LINE__ . " v " . $v . " xk " . $xk . " vk " . $vk . "\n"; fgl_s();
						
						// if (in_array("prg_ctr", end($S))) { 
						if (isset($va[0])) if ($va[0]=="prg_ctr") {
							// this is returned immediately  by xif: AFTER any of TRUE or FALSE block is executed
                            // echo "\n xs: ".__LINE__." SC < ".count($SC)." > ".var_src($SC);
							// echo "\n\n xs: " . __LINE__ . " v " . $v . " xk " . $xk . " vk " . $vk . "\n"; fgl_s();
							$va = array_pop(S);
							// $vk = $va[1] + 1;
							$vk = $va[1]; $xk=$vk;
                        // $vk = $va[1] + 1; // 2018 0707 does this cause vk(13) to be skipped?
                        
   						// if (isset($D)) echo "\n xs: " . __LINE__ . " v " . $v . " xk " . $xk . " vk " . $vk . " Z " . $Z . " SC[CC][3] " . $SC[$CC][3] ."\n";     
   						
   						// $Z = $SC[$CC][3];
						}
					}
										
                }
                
                else if (in_array($fn+":", array_keys($CDW))) { // $CDW colon defined words
                
                    // echo __LINE__." in CDW ".var_src($CDW[$fn.":"]);
                    
                    // $S[]=
                    $WA = $CDW[$fn+":"]; array_pop($WA); // remove semicolon;
                    // FGLA($CDW[$fn.":"]);
                    FGLA($WA);
                
                }

                
                else if ($fn=="r") {
                
                    // echo __LINE__." r: ";
                    // fgl_s();
                    
                    // push remainder of command string to stack?
                    $s=array_pop(S);
                    // $S[]=$xk; // $S[]=$xs; 
                    S.push(implode(' ', array_slice($xs, $xk+1))); // $S[]=implode(' ', array_slice($xs, $xk+1));
                    
                    // $S[]='$S[]=$'.array_pop($S).'; ';
                    S.push('$S[]=$'+$s+'; '); // $S[]='$S[]=$'.$s.'; '; 
                    S.push(':r:'); // $S[]=':r:';   // flag, swap after eval()
                    fgl_s(); // return 0;
                
                
                }
                
                else if ($fn=="v") {
                
                    // echo "\n".__LINE__." v: ";
                    // fgl_s();
                    
                    // push remainder of command string to stack?
                    $sa=array_pop(S);
                    $sb=array_pop(S);

                    // $S[]=$xk; // $S[]=$xs; 
                    
                    S.push(implode(' ', array_slice($xs, $xk+1)));
                    // $S[]=implode(' ', array_slice($xs, $xk+1));
                    
                    // $S[]='$S[]=$'.array_pop($S).'; ';
                    // $S[]='$S[]=$'.$s.'; ';
                    
                    S.push('$' + $sa + '=' + $sb + '; '); // $S[]='$'.$sa.'='.$sb.'; '; 
                    
                    S.push(':v:'); // $S[]=':v:';  // flag, no swap after eval()
                    fgl_s(); // return;
                
                
                }
                
                else if ($fn=="a") {
                
                    // echo "\n".__LINE__." v: ";
                    // fgl_s();
                    
                    // push remainder of command string to stack?
                    $sa=array_pop(S);
                    $sc=count(S);
                    $se=S[ $sc - $sa ];
                    
                    for ($si=0; $si<$sa; $si++) {
                    
                    }
                    
                    $sb=array_pop(S);

                    // $S[]=$xk; // $S[]=$xs; 
                    S.push(implode(' ', array_slice($xs, $xk+1)));
                    //$S[]=implode(' ', array_slice($xs, $xk+1));
                    
                    // $S[]='$S[]=$'.array_pop($S).'; ';
                    // $S[]='$S[]=$'.$s.'; ';
                    
                    S.push('$'+$sa+'='+$sb+'; '); S.push(':v:'); 
                    // $S[]='$'.$sa.'='.$sb.'; '; $S[]=':v:'; // flag, no swap after eval()
                    fgl_s(); // return;
                
                
                }
                
                else if ($fn=="count") {
                
                    // echo __LINE__." r: ";
                    fgl_s();
                    
                    S.push('$S[]=count('+array_pop(S)+'); ');
                    // $S[]='$S[]=count('.array_pop($S).'); ';
                
                
                
                }
                
           else if ($fn=="bz")
           {
           // bz, bzn, bt branch if true, bf branch if false
           
           // echo " bz: "; 
           
           // $S[] = $SL[ array_pop($S) ];
           
           fgl_s();
           
           $bx = array_pop(S);
           
          // if (array_pop($S)==0) $xk=$SL[ array_pop($S) ];
          if (array_pop(S)==0) $xk = $bx;
          continue;
           
           }    
           
           else if ($fn=="bnz")
           {
           // bz, bzn, bt branch if true, bf branch if false
           
           // echo "\nbnz: "; 
           
           // $S[] = $SL[ array_pop($S) ];
           
           // fgl_s();
           
           // echo var_src($SS);
           
           // fgl_stv();
           
           $bx = $SL[ array_pop($S) ]; // array_pop($S);
           
           // fgl_s();
           
          // if (array_pop($S)==0) $xk=$SL[ array_pop($S) ];
          fgl_dup();
          if (array_pop(S)!=0)  { $xk = $bx + 1; continue; }
          // else continue;
          
          // echo __LINE__." ".$xk." ".$v."\n"; // exit;
          // continue;
           
           }    
                
                
                else {
                    // echo " line ".__LINE__ . " fgl_" . $fn . " error.\n";
                }
                
            } else {
                if (ord($v)==0); // echo " null char ";
                else
                if ($v[0] == '_') {
//                    echo "line " . __LINE__ . " ";                    echo "_x";
					
					if ($v=='_') S.push($v); // $S[]=$v;
					
                } else {
                    if ($v == '.s') {
                        // echo "\nline " . __LINE__ . " {$v} ";
                        fgl_s();
                    } else {
                        if ($v == '-') {
                            // $S[] = array_pop($S) - array_pop($S);
                            $sa = array_pop(S);
                            $sb = array_pop(S);
                            // echo gettype($sb) ." ". $sb ." ". gettype($sa) ." ". $sa ." ";
                            
                            S.push($sb -  $sa); 
                            // $S[] = (int) $sb - (int) $sa; 
                        } 
                        else if ($v == '+') {
                            // $S[] = array_pop($S) - array_pop($S);
                            
                            console.log(' < in + >');
                            $sa = array_pop(S);
                            $sb = array_pop(S);
                            
                            console.log(' < in + > ' + $sa + ' ' + $sb + ' ' + ($sa + $sb) );
                            S.push( parseInt($sb) + parseInt($sa) ); 
                            // $S[] = $sb + $sa; 
                        }
                        else if ($v == '.') {

//                        fgl_stv(); 

                            array_pop(S);
                        }
                        else {
                            if ($v == '===') {
                            
                                S.push(array_pop(S) === array_pop(S));
                                // $S[] = array_pop($S) === array_pop($S);
                            } else {
                                S.push($v);
                                // $S[] = $v;
                            }
                        }
                    }
                }
            }
        }
        $xk++;
        if ($xk >= $xl) break;

    } 
    while ($vk < $xl);
    
    // echo "\n" . __FUNCTION__ . " " . __LINE__ . " SS ".var_src($SS);
    
    // $S[]=":END:";
    
    // return (0);
}
