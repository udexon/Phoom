var $SL=[],$xk;

kjs = new JSEncrypt();

function fgl_2je() // pack top 2 items on stack into JSON
{
    S.push( JSON.stringify( [ S.pop(), S.pop() ] ) );
}

function fgl_swap()
{
    b = S.pop();
    a = S.pop();
    S.push( b );
    S.push( a );
}

function fgl_ap() // Array element ap: pushes element on top Array (append to end)
{
    e = S.pop();
    a = S.pop();
    a.push( e );
    S.push( a );
}

function fgl_prop() // X property value prop: defineProperty
{

    v = S.pop();
    p = S.pop();
    X = S.pop();

    Object.defineProperty(X, p, {
  	value: v,
	enumerable: true,
  	writable: true
    });

    S.push( X );
}



function fgl_c() // length, PHP count()
{
    S.push( Object.keys(S.pop()).length );
}


function fgl_l() // length, PHP count()
{
    S.push( S.pop().length );
}


function fgl_keys() // length, PHP count()
{
    S.push( Object.keys(S.pop()) );
}

function fgl_pick()
{
    n = S.pop();
    S.push( S[ S.length - 1 - n ] );

}


function fgl_jdcr() // jse decrypt
{
    S.push( kjs.decrypt( S.pop() ) ); 
}

function fgl_ix()
{
    k=S.pop();
    P=S[ S.length - 1 ]; // do not pop object
    S.push( P[k] );
}


function fgl_jecr() // jse encrypt
{
    S.push( kjs.encrypt( S.pop() ) ); 
}

function fgl_imkey() // import public key
{
    S.push( kjs.setPublicKey( S.pop() ) ); 
}


function fgl_explode()
{
    S.push( explode( S.pop(), S.pop() ));
}


function fgl_now()
{
    var d=new Date();
    S.push( d.toISOString() );
}

function fgl_colon()
{
    S.push(':');
}

function fgl_timeout()
{
    // setTimeout(myFunction, 3000);
    setTimeout( eval( "fgl_now" ) , S.pop() );
    console.log("2019 1217 1421");
}


function func_num_args()
{


}

function F() // variable list of parameters, single letter function name
{
//    global $S;
var e;

// alert('1020');

    $count=0;

  if(func_num_args( ) == 0) {
    return false;
  }
  else {
    // echo " ".__LINE__.">> ".func_num_args( )." ";
    // for($i = 0; $i < func_num_args( )-1; $i++) {
    for($i = 0; $i < arguments.length-1; $i++) {
    
      // echo " $i ".__LINE__.">> ".func_get_arg( $i )." ";
      
      // var_dump(func_get_arg( $i ));
      // echo gettype(func_get_arg( $i ))." ";
      
      // $S[]=func_get_arg( $i );
      // e=func_get_arg( $i );
      e=arguments[$i];
      S.push(e);     
    
      // $count += func_get_arg($i);
    }
    // return $count;
    
//    echo "\n\n".__LINE__.">> ".gettype(func_get_arg( $i ))." ".$i." ".func_get_arg( $i )." ";
    
    // FGL(func_get_arg( $i ));
    FGL( arguments[$i] );
  }


}

function fgl_je() // php json_encode()
{

S.push(JSON.stringify(S.pop()));

}

function fgl_dup()
{
S.push(end(S));
}

function fgl_l() // X l: label X, set index to $SL['X'] for bz: branch if zero and bnz:
{
    // global $SL;
    // global $argv, $S, $SS, $xk, $xs, $SC;

    // echo __LINE__ . " php: ";     fgl_s();
    //$xc = count($SS);
    // $xk =& $SS[$xc - 1][0];
    // $xs =& $SS[$xc - 1][1];
    // $xl = count($SS[$xc - 1][1]);
    // $vk = $xk;
    
    // $Z=$xl;

// $n=array_pop($S);

    $S=S;
    $SL[array_pop($S)]=$xk;

/* 
$S[]=$xk;
$S[]=$SS;
$S[]=$SL;
*/
//    echo "\n" . __FUNCTION__ . " " . __LINE__ . " l: ";     fgl_s();
//    echo "\n";


}


function end(a)
{
return a[a.length-1];
}


function function_exists(f)
{
// if (typeof global !== "undefined") window=global;
// console.log(f +' '+ typeof window[f]);
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

function fgl_ne() //  .... arg1 arg2 arg3 ... funcname N ne: native eval(), N arguments
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
// console.log( typeof e + " " + e + "    " + typeof a + " " + a)
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

function fgl_nxhr()
{
// return new XMLHttpRequest();
S.push(new XMLHttpRequest());

}

function fgl_xo()
{
var a=S.pop();
var xmlhttp=end(S);
// xmlhttp.open("POST", "uui.php", true);

xmlhttp.open("POST", a, true);
}

function fgl_xsrqh()
{
var xmlhttp=end(S);

xmlhttp.setRequestHeader( "Content-type", "application/json");
}        
        // xmlhttp.setRequestHeader( "Content-type", "application/x-www-form-urlencoded");
        
function fgl_xsend()
{
var a=S.pop();
var xmlhttp=end(S);
        xmlhttp.send( a );
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

function fgl_t() // show tree T
{
    console.log("20191016", T);
}

var T = []

function fgl_tn() // make tree node: value key tn:
{
    var a=S.pop()
    var b=S.pop()
    T[a] = b

    // console.log("20191016 tn:", T, a, b);
}

function fgl_td() // delete: node td:
{
    var a=S.pop()
    
    delete T[a]

    // console.log("20191016 td:", T, a);
}

function fgl_tnn() // input is node, copy node to node, preserve source node name: source target  tnn:
{
    var a = S.pop();
    var $F = S.pop();

    var A = []
    A[$F] = T[$F]

    T[a] = A
}

function fgl_tnnr() // input is node, copy node to node, preserve source node name, reverse order: target source tnnr:
{
    var $F = S.pop();

    var A = []
    A[$F] = T[$F]

    T[S.pop()] = A
}

function count(a)
{
return a.length;
}

// need to send not just TOS, but the whole word list to back end
function preProc(str) {

    // str = document.getElementById("rpbox").value;

    // 20170828    
        // alert(str.indexOf('s:') + ' = s: position' );
        
    // 20180610 input str, output str1: json stringify stack, send to back end
    S.push(str); 
    
    fgl_xs(); // pop string, explode string into array, push array to S
    
    sa=S.pop();
    // str1 = JSON.stringify(S.pop());
    str1 = JSON.stringify(sa);
    // str1 = splitloop(str);
    alert('preProc '+str1+' sa '+sa+' str '+str); 
    // 20170720 remove e: first, else bug will stop program
    
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // document.getElementById( "rpout").innerHTML = this.responseText;
                
                // 20170710 20180512
                // document.getElementById("rpout").textContent = this.responseText;       
                // document.getElementById("rpout").textContent = this.responseText;
                
                // postProc(this.responseText);
                alert("postProc_g() "+this.responseText);
                postProc_g(this.responseText);
   
    }
        };
        // xmlhttp.open("GET", "gethint.php?q=" + str, true);
        // xmlhttp.send();

        // xmlhttp.open("POST", "uui.php", true);
        xmlhttp.open("POST", "fgl_ajax.php", true);
        xmlhttp.setRequestHeader( "Content-type", "application/json");
        
        // xmlhttp.setRequestHeader( "Content-type", "application/x-www-form-urlencoded");
        id="rpbox";
        xmlhttp.send( str1);
        
    }
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
    
    // console.log($a);
    
    // $SS[] = array(0, $a); // 2018 08 02 new items pushed to $SS, caused problem?
    
    // JS1019
    var $SS=[], $xl=0;
    
    
    $xk=0;
    $xs=$a;
    
       // console.log($xs);
    
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
       
        
        // console.log(' v '+$v + ' vk ' + $vk + ' xl ' + $xl + ' S ' + S);
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
            
            // 20181021
            
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
                
                // console.log(function_exists("fgl_" + $fn) +' '+ ("fgl_" + $fn));
                
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
