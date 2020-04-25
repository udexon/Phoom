<?php

$SHV=array();

function load_alias($fn)
{
    global $alias;
    $a = file($fn);
    $alias = json_decode($a[0], true);
    file_put_contents("o_init", "\n\n" . date("Y-m-d H:i:s") . "> " . json_encode($alias) . "\n", FILE_APPEND);
}
function fgl_load_alias()
{
    global $alias, $S;
    $a = file(array_pop($S));
    $alias = json_decode($a[0], true);
    $S[] = $alias;
    file_put_contents("o_init", "\n\n" . date("Y-m-d H:i:s") . "> " . json_encode($alias) . "\n", FILE_APPEND);
}

function fgl_space()
{
global $S;

$S[]=' ';

}

function fgl_pshv() // push item to shell var (array)
{
global $S, $SHV;

$a=array_pop($S); $b=array_pop($S);
// echo __FUNCTION__." ".__LINE__." a ".$a. " b ". $b ."   ";
// $SHV[array_pop($S)][]=array_pop($S);
$SHV[$a][]=$b;

}

function fgl_shv() // shell var
{
global $S, $SHV;

$a=array_pop($S); $b=array_pop($S);
$SHV[$a]=$b;

}

function fgl_vv() // view shell var
{
global $S, $SHV;

echo var_src($SHV[array_pop($S)]);


}


function fgl_rshv() // read shell var
{
global $S, $SHV;

$S[]=$SHV[array_pop($S)];


}

function fgl_esv() // array_of_words_(list) esv: execute script, substitute shell var
{
global $argv, $S;

$a=array_pop($S);
// $S=array_merge($S, array_pop($S));

// echo __LINE__." ".var_src($a);
// var_dump($a);

    foreach($a as $vk => $v) {

	$v=trim($v); // read from file, must strip newline
    
      // echo "\nline ".__LINE__.
      //  echo " v _";      
      //   echo "_".$v."_ ".strlen($v)." ";

        // if else .... end of function list, is data, just push onto stack    
        if (strlen($v)>0)
        if (strpos($v,":")) { 

            $l=strlen($v); // javascript .length, PHP strlen() for string length, count() for array length
            $fn=substr($v,0,$l-1);

// echo __LINE__." fn ".$fn." v ".$v." l ".$l." ; ";
            
            //  2018 02 25 check alias here , if failed resume original execution
            // add command to inspect alias
            if (function_exists("fgl_".$fn)) {
//                echo "line ".__LINE__." fgl_".$fn." ";
                
                // 2018 02 25 call_alias() ?
                call_user_func("fgl_".$fn);
            }
            else echo __LINE__." fgl_".$fn." error.\n";

        }
        else if ($v[0]=='_') {
        
            echo "line ".__LINE__." ";
            echo "_x";
        }
        else if ($v=='.s') {
        
            echo "\nline ".__LINE__." $v ";
            fgl_s();
        }
        else if ($v=='-') {
            // $Sc=count($S);
            // $S[]=$S[$Sc-2]-end($S);

            $Sc=count($S);
            $ve=array_pop($S);
            $S[]=array_pop($S) - $ve;
        }

else if (strpos($v,'${')!==false) {

echo __LINE__." ".$v." shell var ";
global $SHV;

 preg_match( '/\${[^}]+}/', $v, $m, PREG_OFFSET_CAPTURE);


$svn=$v[$m[0][1]+2]; // single letter var
$svv=$SHV[$svn];

// $S[]=array($SHV, $v, $m, $m[0][1], $v[$m[0][1]+2], $svv);
$v = str_replace($m[0][0], $svv, $v);
$S[]=$v;
}

else if ($v=="'") {

if ($a[$vk+1]=="'") $S[]=" ";
}


        else $S[]=$v;
    }
}


function fgl_sys() // system()
{
global $S;

system(array_pop($S));


}

function fgl_ax() // array_push() no index
{
    global $S;
    
    // index item array_push:
    //   $b    $a
    
    $a=array_pop($S);
    // $b=array_pop($S);
    $l=count($S);
    $S[$l-1][]=$a;

}


function fgl_ess() // ess: execute script from string
{
	global $S;
	$S[]=trim(array_pop($S));
	$S[]=explode(' ', array_pop($S));
	fgl_es();


}

function fgl_im() // implode
{
global $S;

$S[]=implode(' ', array_pop($S));


}



function fgl_mss() // merge string on stack
{
    global $S;

    $l=array_pop($S);
    $L=count($S);
    
    $s=$S[$L-$l];
    for($i=$L-$l+1; $i<$L; $i++) $s=$s." ".$S[$i];
    array_splice($S, $L-$l);
    $S[]=$s;


}

function fgl_unindex()
{
    global $S;
    $a = array_pop($S);
    $b = array_pop($S);
    $S[] = $b[$a];
}
function fgl_mkindex()
{
    global $S;
    $a = array_pop($S);
    $b = array_pop($S);
    $S[] = array($a => $b);
}
function fgl_mkalias()
{
    global $S, $alias;
    $alias = array_pop($S);
    echo "<" . count($S) . "> " . preg_replace("/\\s+/", " ", var_export($alias, true)) . "\n";
}
function fgl_arp()
{
    fgl_array_push();
}
function fgl_array_push() // index is compulsory, vs. ax:
{
    global $S;
    $a = array_pop($S);
    $b = array_pop($S);
    $l = count($S);
    $S[$l - 1][$b] = $a;
}
function fgl_nat()
{
    fgl_native();
}
function fgl_native()
{
    global $S;
    $n = array_pop($S);
    if ($n == 0) {
        $S[] = array_pop($S) . "()";
    } else {
        $s = array_pop($S) . "(" . array_pop($S);
        while ($n-- > 1) {
            $s = $s . ", " . array_pop($S);
        }
        $S[] = $s . ")";
    }
}
function fgl_nx()
{
    global $S;
    $n = array_pop($S);
    if ($n == 0) {
        $S[] = array_pop($S) . "()";
    } else {
        if (1) {
            $s = array_pop($S) . "(" . "end(\$S)";
            while ($n-- > 1) {
                $s = $s . ", " . "array_pop(\$S)";
            }
            echo __LINE__ . " " . $s;
            $S[] = eval("return " . $s . ");");
        } else {
            $s = array_pop($S) . "(" . array_pop($S);
            while ($n-- > 1) {
                $s = $s . ", " . "array_pop(\$S)";
            }
            echo $s;
            $S[] = eval("return " . $s . ");");
        }
    }
}
//  .... arg1 arg2 arg3 ... funcname N ne: native eval(), N arguments
function fgl_ne()
{
    global $S;
    $n = array_pop($S);
    if ($n == 0) {
        $S[] = array_pop($S) . "()";
    } else {
        if (0) {
            $s = array_pop($S) . "(" . "array_pop(\$S)";
            while ($n-- > 1) {
                $s = $s . ", " . "array_pop(\$S)";
            }
            echo __LINE__ . " " . $s;
            $S[] = eval("return " . $s . ");");
        } else {
            $s = array_pop($S) . "(" . array_pop($S);
            while ($n-- > 1) {
                $s = $s . ", " . "array_pop(\$S)";
            }
            echo $s;
            $S[] = eval("return " . $s . ");");
        }
    }
}
function fgl_xif()
{
    global $S, $vk, $xk, $xs, $SS;
    // echo "\n" . __FUNCTION__ . " " . __LINE__ . " "; fgl_pss(); fgl_s();
    $c = array_pop($S);
    $xc = count($SS);
    $xk =& $SS[$xc - 1][0];
    $xs =& $SS[$xc - 1][1];
    $xl = count($SS[$xc - 1][1]);
    $a = $xs;
    $l = $xl;
    for ($i = $xk; $i < $l; $i++) {
        echo __LINE__ . " if: {$i} ";
        if ($xs[$i] == "endif:") {
            break;
        }
    }
    for ($j = $xk; $j < $i; $j++) {
        echo __LINE__ . " if: {$i} {$j} ";
        if ($xs[$j] == "else:") {
            break;
        }
    }
    echo "\n\n" . __LINE__ . " c " . $c . " xk " . $xk . " i " . $i . " j " . $j . "\n";
    if ($i == $j) {
        if ($c) {
            if ($i > $xk + 1) {
                $S[] = array($xk, $i);
                fgl_x();
            }
        }
    } else {
        if ($c) {
            $S[] = array($xk, $j);
            fgl_x();
			$S[] = array("prg_ctr", $j);
        } else {
            $S[] = array($j, $i);
            fgl_x();
			$S[] = array("prg_ctr", $i);
        }
    }
    echo "\n\n xif: " . __LINE__ . " c " . $c . " xk " . $xk . " i " . $i . " j " . $j ; fgl_s();
    $xk = $i;
    // $S[] = array("prg_ctr", $i);
    /*
        if ($a) { $S[]="if 1 $a $vk $i $j"; 
            $S[]=$vk+1; $S[]=$j;
        }
        else { $S[]="if 0 $a $vk $i $j"; 
            $S[]=$j+1; $S[]=$i;
    */
}

function fgl_do1() // do: ... while: use $SC control stack, $SS script stack
{
    global $S, $xk, $xs, $SS, $SA, $SC; // in future $S? should be &$var pointing to array that can be switched
    
    echo "\n" . __FUNCTION__ . " " . __LINE__ . " ";
    fgl_pss();
    fgl_s();
    $c = array_pop($S);
    $xc = count($SS);
    $xk =& $SS[$xc - 1][0];
    $xs =& $SS[$xc - 1][1];
    $xl = count($SS[$xc - 1][1]);
    $vk = $xk;
    $a = $xs;
    $l = $xl;
    
    $SC[]=array("do",$xc-1,$xk); // id, SS index, start, current, end; current, end not defined yet. 
    // update current program counter before calling x:
    
    for ($i = $xk; $i < $l; $i++) {
        echo __LINE__ . " while: {$i} ";
        if ($xs[$i] == "while:") {
            break;
        }
    }
    /* for ($j=$xk; $j<$i; $j++) {
           echo __LINE__." if: $i $j ";
           if ($xs[$j]=="else:") break;
       
       } */
    $j = $i;
    if ($i == $j) { // adapted from xif: else: end: No else: for cforeach: 
        // If there are nested cforeach: let inner block return error, then readjust adjust end index.
        // foreach ($c as $ck => $ce) {
        // if (1) 
        do { // do: .... while: 
        
            // echo "\n\n xforeach " . __LINE__ . " ck " . $ck . " ce " . $ce . " count S " . count($S) . "\n"; fgl_s();
            $L0 = count($S);
            // $S[] = $ce;
            // fgl_s();
            
            $S[] = array($vk, $i);
            $LC=count($SC); $E=$LC-1; $SC[$E][]=$vk; $SC[$E][]=$i;
            fgl_x();
            
            echo "\n\n do: " . __LINE__ . " ck " . $ck . " ce " . $ce . " count S " . count($S) . "\n";
            echo " do: " . __LINE__ . " pwd " . getcwd() . " ";
            // fgl_s();
            
            // output terminating_condition
            $c=array_pop($S);
            
            while (count($S) > $L0) {
                $SA[] = array_pop($S);
            }
        } while ($c); // (end($S));
    
    
        } else {  // unused, adapted from xif: else: end: No else: for cforeach: 
        if ($c) {
            $S[] = array($xk, $j);
            fgl_x();
        } else {
            $S[] = array($j, $i);
            fgl_x();
        }
    }
    fgl_s();
    $xk = $i;
	$S[] = array("prg_ctr", $i);
    /*
        if ($a) { $S[]="if 1 $a $vk $i $j"; 
            $S[]=$vk+1; $S[]=$j;
        }
        else { $S[]="if 0 $a $vk $i $j"; 
            $S[]=$j+1; $S[]=$i;
    */
}

function fgl_do() // use $SC control stack, $SS script stack
{
    global $S, $xk, $xs, $SS, $SA, $SC; // in future $S? should be &$var pointing to array that can be switched
    
    echo "\n\n\n" . __FUNCTION__ . " " . __LINE__ . " SS ";
    fgl_pss();
    fgl_s();

    $xc = count($SS);
    $xk =& $SS[$xc - 1][0];
    $xs =& $SS[$xc - 1][1];
    $xl = count($SS[$xc - 1][1]);
    $vk = $xk;
    $a = $xs;
    $l = $xl;

    $LC=count($SC); $E=$LC-1;
    $CC=$LC; // control stack counter
     // $SC[$E][2]=$vk; $SC[$E][]=$i;
    if ($LC==0) $SC[]=array("do",$xc-1,$xk); // id, SS index, start, current, end; current, end not defined yet. 
    else if (isset($SC[$E][2])) if ($xk>$SC[$E][2]) $SC[]=array("do",$xc-1,$xk); 
    // append if xk > start index of top of SC
    // if start < xk < end, isset(end_index) ==> repeat instace of loop
    
    echo "\n do: ".__LINE__." CC ".$CC." xk ".$xk." SC < ".count($SC)." > ".var_src($SC);
    // update current program counter before calling x:

    
    for ($i = $xk; $i < $l; $i++) {
        echo __LINE__ . " while: {$i} ";
        if ($xs[$i] == "while:") {
            break;
        }
    }

    $j = $i;
    
      $L0 = count($S);
           
            $LC=count($SC); $E=$LC-1; $SC[$E][2]=$vk; if (!isset($SC[$E][3])) $SC[$E][]=$i;
            echo "\n\n do: ".__LINE__." vk ".$vk." ck "." ce "." CC ".$CC." SC < ".count($SC)." > ".var_src($SC);
    
    
    if ($i == $j) { // adapted from xif: else: end: No else: for cforeach: 
        // If there are nested cforeach: let inner block return error, then readjust adjust end index.
        // foreach ($c as $ck => $ce) {
        
        do {
            // echo "\n\n xforeach " . __LINE__ . " ck " . $ck . " ce " . $ce . " count S " . count($S) . "\n"; fgl_s();

            // these code needs to be run once during initialization, or every iteration?
            // xk vk represent instance of execution of this function

            echo "\n\n do: line " . __LINE__ ." ".__FILE__." vk ".$vk. " i " . $i . " count S " . count($S) . " CC ".$CC." SC ".var_src($SC)."\n";

            $S[] = array($vk, $i);
            fgl_x();
            
//            echo "\n\n do " . __LINE__ ." vk ".$vk. " ck " . " ce " . " count S " . count($S) . " CC ".$CC." SC ".var_src($SC)."\n";
//            echo " do " . __LINE__ . " pwd " . getcwd() . " ";
            // fgl_s();
            
            $c=array_pop($S);
        
        if (isset($SC[$CC+1][3])) if ($SC[$CC+1][3]==$SC[$CC][3]) {
            echo " line ".__LINE__." ".$SC[$CC][3]." ".$SC[$CC+1][3]." xk ".$xk." l ".$l." ";
            for ($i = $xk+1; $i < $l; $i++) {
                echo __LINE__ . " while: i ".$i." xk ".$xk." ";
                if ($xs[$i] == "while:") {
                    $SC[$CC][3]=$i;
                    break;
                }
            } 
            
            echo " line ".__LINE__." CC ".$CC." ".$SC[$CC][3]." ".$SC[$CC+1][3]." xk ".$xk." l ".$l." ".var_src($SC);
            
            if ($i-$xk>1) {
                $S[] = array($xk, $i);
                fgl_x();
                $c=array_pop($S);
            }

                       
        }
        

            
            while (count($S) > $L0) {
                $SA[] = array_pop($S);
            }
        } while ($c);
        
        
        if (0) if (isset($SC[$CC+1][3])) { // disabled, was from cforeach:
            echo " line ".__LINE__." ".$SC[$CC][3]." ".$SC[$CC+1][3]." xk ".$xk." l ".$l." ";
            for ($i = $xk+1; $i < $l; $i++) {
                echo __LINE__ . " while: {$i} ";
                if ($xs[$i] == "while:") {
                    break;
                }
            } 
            
            if ($i-$xk>1) {
                $S[] = array($vk, $i);
                fgl_x();
            }                       
        }
        
    } else {  // unused, adapted from xif: else: end: No else: for cforeach: 
        if ($c) {
            $S[] = array($xk, $j);
            fgl_x();
        } else {
            $S[] = array($j, $i);
            fgl_x();
        }
    }
    fgl_s();
    $xk = $i;
	$S[] = array("prg_ctr", $i);
    /*
        if ($a) { $S[]="if 1 $a $vk $i $j"; 
            $S[]=$vk+1; $S[]=$j;
        }
        else { $S[]="if 0 $a $vk $i $j"; 
            $S[]=$j+1; $S[]=$i;
    */
}

function fgl_fgc()
{
    global $S;
    
    $S[]=file_get_contents(array_pop($S));

}


function fgl_gt() // a b gt: (a > b)?
{
    global $S;

    $S[]=(array_pop($S)<array_pop($S));
        
}

function fgl_dec() // dec: x--;
{
    global $S;
    $S[]=array_pop($S)-1;
}

function fgl_f1() // foreach: use $SC control stack, $SS script stack
{
    global $S, $xk, $xs, $SS, $SA, $SC; // in future $S? should be &$var pointing to array that can be switched
    
    $xc = count($SS);
    $xk =& $SS[$xc - 1][0]; // counter
    $xs =& $SS[$xc - 1][1]; // script
    $xl = count($SS[$xc - 1][1]);
    $vk = $xk;
    $a = $xs;
    $l = $xl;

    $LC=count($SC); $E=$LC-1;
    
    // get $CC
     
    // $SC[$E][2]=$vk; $SC[$E][]=$i;

    // 2018 0707 need to rethink, how to initialize $SC and Control Layer Index $CL
    // comment before code, adjust $SC when outer loop or inner loop starts?
    // this control function start end must be bounded by parent (if any)
    // this section of code is only executed once for top control function
    // it is repeated for children control functions
    // when a new element is appended to $SC, it has a new $CL  
    // when it is repeated, derive $CL from $xk and $SC ?? Seems safest way.
       
    if ($LC==0) $SC[]=array("f1",$xc-1,$xk); // id, SS index, start, current, end; current, end not defined yet. 
    else if (isset($SC[$E][2])) if ($xk>$SC[$E][2]) $SC[]=array("f1",$xc-1,$xk); // $xc-1 = Script Index, layers of script, only 0 so far.
    
    if ($LC>0) { $S[]=$vk; fgl_CC(); 
        // fgl_s(); 
        $t=array_pop($S);     
        $CC=$t[0]; 
        // echo " CC " . $CC . "\n"; 
        }
    else $CC=$LC; // control stack counter, control layer index?
    
    
    // $E=last index of stack, when new control structure is defined, $E is set to end of new control structure
    // ($xk>$SC[$E][2]) is only true when initially, start end of control structure is undefined, hence $E points to parent.
    
    // 2018 07 06: outer loop will not return here to adjust $xk, so how?
    // inner loop only need to adjust $SC once? let inner loop adjust $SC of outer loop?
    
    // append if xk > start index of top of SC
    // if start < xk < end, isset(end_index) ==> repeat instance of loop
    
    if (isset($D)) echo "\n f1: ".__LINE__." xk ".$xk." SC < ".count($SC)." > ".var_src($SC);
    // update current program counter before calling x:

    if (isset($D)) { echo "\n\n\n" . __FUNCTION__ . " loop start " . __LINE__ . " SS ";     fgl_pss();     fgl_s(); }
    
    $c = array_pop($S); // non-control code
    
    if (isset($D)) echo "\n f1: ".__LINE__." xk ".$xk." SC < ".count($SC)." > ".var_src($SC)." c ".var_src($c)." ";
    
    
    
    for ($i = $xk; $i < $l; $i++) {
        if (isset($D)) echo __LINE__ . " end: {$i} ";
        if ($xs[$i] == "end:") {
            break;
        }
    }
    /* for ($j=$xk; $j<$i; $j++) {
           echo __LINE__." if: $i $j ";
           if ($xs[$j]=="else:") break;
       
       } */
    $j = $i;
    
      $L0 = count($S);
           
            $LC=count($SC); $E=$LC-1; $SC[$E][2]=$vk; if (!isset($SC[$E][3])) $SC[$E][]=$i;
            // echo "\n\n cforeach: ".__LINE__." vk ".$vk." ck "." ce "." SC < ".count($SC)." > ".var_src($SC);
            // echo "\n\n cforeach: ".__LINE__." vk ".$vk." ck ".$ck." ce ".$ce." SC < ".count($SC)." > ".var_src($SC);
            if (isset($D)) echo "\n\n f1: ".__LINE__." xk ".$xk." vk ".$vk." i ".$i." SC < ".count($SC)." > ".var_src($SC);
            
            // 2018 07 06: if $SC[0][3]==$SC[0][3] repeat search end: loop.
    if (isset($SC[1][3])) if ($SC[0][3]==$SC[1][3]) {
        
    for ($i = $i+1; $i < $l; $i++) {
        if (isset($D)) echo __LINE__ . " end: {$i} ";
        if ($xs[$i] == "end:") {
            break;
        }
    }
    
    $SC[0][3]=$i;
    
    
    }
    
                if (isset($D)) echo "\n\n f1: ".__LINE__." CC ".$CC." xk ".$xk." vk ".$vk." i ".$i." SC < ".count($SC)." > ".var_src($SC);
    
    // 2018 0707 $i was used to detect end of outer loop, so must not be used for other purposes!!
    
    // After setting $SC, no need to execute code to search end: ??
    $j = $i;
    
    
    if ($i == $j) { // adapted from xif: else: end: No else: for cforeach: 
        // If there are nested cforeach: let inner block return error, then readjust adjust end index.
        
                    if (isset($D)) echo "\n\n f1: " . __LINE__ . " c ".var_src($c);
        
        foreach ($c as $ck => $ce) {

            if (isset($D)) { echo "\n\n f1: " . __LINE__ . " CC ".$CC." SC ".var_src($SC)." vk " . $vk ." i " . $i ." ck " . $ck . " ce " . var_src($ce) . " count S " . count($S) . "\n"; fgl_s(); }

            // these code needs to be run once during initialization, or every iteration?
            // xk vk represent instance of execution of this function

            $S[] = $ce; // 2018 07 06 last TOS is tr?
            // $S[] = array($vk, $i); // 2018 07 06 interfere with swap: ??
            // outer loop first time end:A as arguments to x:, when readjust $SC, need to readjust arguments to x: too -- f1: f1: end:A end:B
            
            $S[] = array($vk, $SC[$CC][3]);
            
            fgl_x();
            
            // 2018 07 06: need to adjust $SC here, after inner loop ends.
            // check control layer (number of layers of control structure)
            // if $CL==0 then check $SC[$CL][3] > $i (initial value of end counter for fgl_x() )
            // continue from $xk (?) until $SC[$CL][3] ??
            
            if (isset($D)) { echo "\n\n\n f1: " . __LINE__ ." vk ".$vk. " i ".$i. " ck " . $ck . " ce " . var_src($ce) . " count S " . count($S) . " CC ".$CC." SC ".var_src($SC)."\n";
            // echo " cforeach " . __LINE__ . " pwd " . getcwd() . " ";
                fgl_s();
            }
            
            while (count($S) > $L0) {
                $SA[] = array_pop($S);
            }
        } 
        
        if (isset($D)) echo "\n f1: " . __LINE__ ." end foreach()\n";
        
        // 2018 0707 this gets executed line 713 fgl_x() causes <tr> taken by td: ??
        if (0) if (isset($SC[$CC+1][3])) {
            echo " line ".__LINE__." ".$SC[$CC][3]." ".$SC[$CC+1][3]." xk ".$xk." l ".$l." ";
            for ($i = $xk+1; $i < $l; $i++) {
                echo __LINE__ . " end: {$i} ";
                if ($xs[$i] == "end:") {
                    break;
                }
            } 
            
            if ($i-$xk>1) {
                $S[] = array($vk, $i);
                fgl_x();
            }

                       
        }
    } else {  // unused, adapted from xif: else: end: No else: for cforeach: 
        if ($c) {
            $S[] = array($xk, $j);
            fgl_x();
        } else {
            $S[] = array($j, $i);
            fgl_x();
        }
    }
    
    if (isset($D)) { echo "\n\n" . __FUNCTION__ . " " . __LINE__ . " CC ".$CC. " end " .$SC[$CC][3]. " i " . $i. " SA ". var_src($SA). " ";
        fgl_s();
    }
    
    $xk = $i;
	// $S[] = array("prg_ctr", $i);
	$S[] = array("prg_ctr", $SC[$CC][3]);
    
    
}


function fgl_f1a() // foreach: use $SC control stack, $SS script stack
{
    global $S, $xk, $xs, $SS, $SA, $SC; // in future $S? should be &$var pointing to array that can be switched
    
    $xc = count($SS);
    
    if (1) {
    $S[]='SS r: c: xc v:';    
    do {
        echo "\n".__LINE__." "; fgl_s();
        echo "\n".__LINE__." fgl_php() "; fgl_php();    
        echo "\n".__LINE__." "; fgl_s();
        
        array_pop($SS);

        $f=array_pop($S);
        $t=array_pop($S);
        
        if ($t=='') $t=":END:";
        
        echo "\n".__LINE__." $t :".end($S).": "; fgl_s();
        
        if (end($S)=='') break;
        
        if ($t==":END:") break; else eval($t); 
        if ($f==':r:') fgl_swap();   // cannot swap if v: TOS not affected!!
            
    } while ($t!=":END:" || end($S)!='');
    
    array_pop($S); // pop residual empty string from command     $S[]='SS r: c: xc v:';   
    // check stack is identical with f1:
    
    }
    
    echo __LINE__." ".var_src($SS);
    
    // fgl_s(); // exit;
    

    
    echo __LINE__." ".var_src($SS);
    echo " ".count($SS)."\n";
    
// exit;
    
    $xk =& $SS[$xc - 1][0]; // counter
    $xs =& $SS[$xc - 1][1]; // script
    $xl = count($SS[$xc - 1][1]);
    $vk = $xk;
    $a = $xs;
    $l = $xl;

    $LC=count($SC); $E=$LC-1;
    
    // get $CC
     
    // $SC[$E][2]=$vk; $SC[$E][]=$i;

    // 2018 0707 need to rethink, how to initialize $SC and Control Layer Index $CL
    // comment before code, adjust $SC when outer loop or inner loop starts?
    // this control function start end must be bounded by parent (if any)
    // this section of code is only executed once for top control function
    // it is repeated for children control functions
    // when a new element is appended to $SC, it has a new $CL  
    // when it is repeated, derive $CL from $xk and $SC ?? Seems safest way.
       
    if ($LC==0) $SC[]=array("f1",$xc-1,$xk); // id, SS index, start, current, end; current, end not defined yet. 
    else if (isset($SC[$E][2])) if ($xk>$SC[$E][2]) $SC[]=array("f1",$xc-1,$xk); // $xc-1 = Script Index, layers of script, only 0 so far.
    
    if ($LC>0) { $S[]=$vk; fgl_CC(); 
        // fgl_s(); 
        $t=array_pop($S);     
        $CC=$t[0]; 
        // echo " CC " . $CC . "\n"; 
        }
    else $CC=$LC; // control stack counter, control layer index?
    
    
    // $E=last index of stack, when new control structure is defined, $E is set to end of new control structure
    // ($xk>$SC[$E][2]) is only true when initially, start end of control structure is undefined, hence $E points to parent.
    
    // 2018 07 06: outer loop will not return here to adjust $xk, so how?
    // inner loop only need to adjust $SC once? let inner loop adjust $SC of outer loop?
    
    // append if xk > start index of top of SC
    // if start < xk < end, isset(end_index) ==> repeat instance of loop
    
    if (isset($D)) echo "\n f1: ".__LINE__." xk ".$xk." SC < ".count($SC)." > ".var_src($SC);
    // update current program counter before calling x:

    if (isset($D)) { echo "\n\n\n" . __FUNCTION__ . " loop start " . __LINE__ . " SS ";     fgl_pss();     fgl_s(); }
    
    $c = array_pop($S); // non-control code
    
    if (isset($D)) echo "\n f1: ".__LINE__." xk ".$xk." SC < ".count($SC)." > ".var_src($SC)." c ".var_src($c)." ";
    
    
    
    for ($i = $xk; $i < $l; $i++) {
        if (isset($D)) echo __LINE__ . " end: {$i} ";
        if ($xs[$i] == "end:") {
            break;
        }
    }
    /* for ($j=$xk; $j<$i; $j++) {
           echo __LINE__." if: $i $j ";
           if ($xs[$j]=="else:") break;
       
       } */
    $j = $i;
    
      $L0 = count($S);
           
            $LC=count($SC); $E=$LC-1; $SC[$E][2]=$vk; if (!isset($SC[$E][3])) $SC[$E][]=$i;
            // echo "\n\n cforeach: ".__LINE__." vk ".$vk." ck "." ce "." SC < ".count($SC)." > ".var_src($SC);
            // echo "\n\n cforeach: ".__LINE__." vk ".$vk." ck ".$ck." ce ".$ce." SC < ".count($SC)." > ".var_src($SC);
            if (isset($D)) echo "\n\n f1: ".__LINE__." xk ".$xk." vk ".$vk." i ".$i." SC < ".count($SC)." > ".var_src($SC);
            
            // 2018 07 06: if $SC[0][3]==$SC[0][3] repeat search end: loop.
    if (isset($SC[1][3])) if ($SC[0][3]==$SC[1][3]) {
        
    for ($i = $i+1; $i < $l; $i++) {
        if (isset($D)) echo __LINE__ . " end: {$i} ";
        if ($xs[$i] == "end:") {
            break;
        }
    }
    
    $SC[0][3]=$i;
    
    
    }
    
                if (isset($D)) echo "\n\n f1: ".__LINE__." CC ".$CC." xk ".$xk." vk ".$vk." i ".$i." SC < ".count($SC)." > ".var_src($SC);
    
    // 2018 0707 $i was used to detect end of outer loop, so must not be used for other purposes!!
    
    // After setting $SC, no need to execute code to search end: ??
    $j = $i;
    
    
    if ($i == $j) { // adapted from xif: else: end: No else: for cforeach: 
        // If there are nested cforeach: let inner block return error, then readjust adjust end index.
        
                    if (isset($D)) echo "\n\n f1: " . __LINE__ . " c ".var_src($c);
        
        foreach ($c as $ck => $ce) {

            if (isset($D)) { echo "\n\n f1: " . __LINE__ . " CC ".$CC." SC ".var_src($SC)." vk " . $vk ." i " . $i ." ck " . $ck . " ce " . var_src($ce) . " count S " . count($S) . "\n"; fgl_s(); }

            // these code needs to be run once during initialization, or every iteration?
            // xk vk represent instance of execution of this function

            $S[] = $ce; // 2018 07 06 last TOS is tr?
            // $S[] = array($vk, $i); // 2018 07 06 interfere with swap: ??
            // outer loop first time end:A as arguments to x:, when readjust $SC, need to readjust arguments to x: too -- f1: f1: end:A end:B
            
            $S[] = array($vk, $SC[$CC][3]);
            
            fgl_x();
            
            // 2018 07 06: need to adjust $SC here, after inner loop ends.
            // check control layer (number of layers of control structure)
            // if $CL==0 then check $SC[$CL][3] > $i (initial value of end counter for fgl_x() )
            // continue from $xk (?) until $SC[$CL][3] ??
            
            if (isset($D)) { echo "\n\n\n f1: " . __LINE__ ." vk ".$vk. " i ".$i. " ck " . $ck . " ce " . var_src($ce) . " count S " . count($S) . " CC ".$CC." SC ".var_src($SC)."\n";
            // echo " cforeach " . __LINE__ . " pwd " . getcwd() . " ";
                fgl_s();
            }
            
            while (count($S) > $L0) {
                $SA[] = array_pop($S);
            }
        } 
        
        if (isset($D)) echo "\n f1: " . __LINE__ ." end foreach()\n";
        
        // 2018 0707 this gets executed line 713 fgl_x() causes <tr> taken by td: ??
        if (0) if (isset($SC[$CC+1][3])) {
            echo " line ".__LINE__." ".$SC[$CC][3]." ".$SC[$CC+1][3]." xk ".$xk." l ".$l." ";
            for ($i = $xk+1; $i < $l; $i++) {
                echo __LINE__ . " end: {$i} ";
                if ($xs[$i] == "end:") {
                    break;
                }
            } 
            
            if ($i-$xk>1) {
                $S[] = array($vk, $i);
                fgl_x();
            }

                       
        }
    } else {  // unused, adapted from xif: else: end: No else: for cforeach: 
        if ($c) {
            $S[] = array($xk, $j);
            fgl_x();
        } else {
            $S[] = array($j, $i);
            fgl_x();
        }
    }
    
    if (isset($D)) { echo "\n\n" . __FUNCTION__ . " " . __LINE__ . " CC ".$CC. " end " .$SC[$CC][3]. " i " . $i. " SA ". var_src($SA). " ";
        fgl_s();
    }
    
    $xk = $i;
	// $S[] = array("prg_ctr", $i);
	$S[] = array("prg_ctr", $SC[$CC][3]);
    
    
}

function fgl_f1b() // foreach: use $SC control stack, $SS script stack
{
    global $S, $xk, $xs, $SS, $SA, $SC; // in future $S? should be &$var pointing to array that can be switched
    
    $xc = count($SS);
    
    fgl_s();
    
    if (0) {
    $S[]='SS r: c: xc v:';    
    do {
        echo "\n".__LINE__." "; fgl_s();
        echo "\n".__LINE__." fgl_php() "; fgl_php();    
        echo "\n".__LINE__." "; fgl_s();

        $f=array_pop($S);
        $t=array_pop($S);
        
        if ($t=='') $t=":END:";
        
        echo "\n".__LINE__." $t :".end($S).": "; fgl_s();
        
        if (end($S)=='') break;
        
        if ($t==":END:") break; else eval($t); 
        if ($f==':r:') fgl_swap();   // cannot swap if v: TOS not affected!!
            
    } while ($t!=":END:" || end($S)!='');
    
    array_pop($S); // pop residual empty string from command     $S[]='SS r: c: xc v:';   
    // check stack is identical with f1:
    
    }
    

    
    $xk =& $SS[$xc - 1][0]; // counter
    $xs =& $SS[$xc - 1][1]; // script
    $xl = count($SS[$xc - 1][1]);
    $vk = $xk;
    $a = $xs;
    $l = $xl;

    $LC=count($SC); $E=$LC-1;
    
    // get $CC
     
    // $SC[$E][2]=$vk; $SC[$E][]=$i;

    // 2018 0707 need to rethink, how to initialize $SC and Control Layer Index $CL
    // comment before code, adjust $SC when outer loop or inner loop starts?
    // this control function start end must be bounded by parent (if any)
    // this section of code is only executed once for top control function
    // it is repeated for children control functions
    // when a new element is appended to $SC, it has a new $CL  
    // when it is repeated, derive $CL from $xk and $SC ?? Seems safest way.
       
    if ($LC==0) $SC[]=array("f1",$xc-1,$xk); // id, SS index, start, current, end; current, end not defined yet. 
    else if (isset($SC[$E][2])) if ($xk>$SC[$E][2]) $SC[]=array("f1",$xc-1,$xk); // $xc-1 = Script Index, layers of script, only 0 so far.
    
    if ($LC>0) { $S[]=$vk; fgl_CC(); 
        // fgl_s(); 
        $t=array_pop($S);     
        $CC=$t[0]; 
        // echo " CC " . $CC . "\n"; 
        }
    else $CC=$LC; // control stack counter, control layer index?
    
    
    // $E=last index of stack, when new control structure is defined, $E is set to end of new control structure
    // ($xk>$SC[$E][2]) is only true when initially, start end of control structure is undefined, hence $E points to parent.
    
    // 2018 07 06: outer loop will not return here to adjust $xk, so how?
    // inner loop only need to adjust $SC once? let inner loop adjust $SC of outer loop?
    
    // append if xk > start index of top of SC
    // if start < xk < end, isset(end_index) ==> repeat instance of loop
    
    if (isset($D)) echo "\n f1: ".__LINE__." xk ".$xk." SC < ".count($SC)." > ".var_src($SC);
    // update current program counter before calling x:

    if (isset($D)) { echo "\n\n\n" . __FUNCTION__ . " loop start " . __LINE__ . " SS ";     fgl_pss();     fgl_s(); }
    
    $c = array_pop($S); // non-control code
    
    if (isset($D)) echo "\n f1: ".__LINE__." xk ".$xk." SC < ".count($SC)." > ".var_src($SC)." c ".var_src($c)." ";
    
    
    
    for ($i = $xk; $i < $l; $i++) {
        if (isset($D)) echo __LINE__ . " end: {$i} ";
        if ($xs[$i] == "end:") {
            break;
        }
    }
    /* for ($j=$xk; $j<$i; $j++) {
           echo __LINE__." if: $i $j ";
           if ($xs[$j]=="else:") break;
       
       } */
    $j = $i;
    
      $L0 = count($S);
           
            $LC=count($SC); $E=$LC-1; $SC[$E][2]=$vk; if (!isset($SC[$E][3])) $SC[$E][]=$i;
            // echo "\n\n cforeach: ".__LINE__." vk ".$vk." ck "." ce "." SC < ".count($SC)." > ".var_src($SC);
            // echo "\n\n cforeach: ".__LINE__." vk ".$vk." ck ".$ck." ce ".$ce." SC < ".count($SC)." > ".var_src($SC);
            if (isset($D)) echo "\n\n f1: ".__LINE__." xk ".$xk." vk ".$vk." i ".$i." SC < ".count($SC)." > ".var_src($SC);
            
            // 2018 07 06: if $SC[0][3]==$SC[0][3] repeat search end: loop.
    if (isset($SC[1][3])) if ($SC[0][3]==$SC[1][3]) {
        
    for ($i = $i+1; $i < $l; $i++) {
        if (isset($D)) echo __LINE__ . " end: {$i} ";
        if ($xs[$i] == "end:") {
            break;
        }
    }
    
    $SC[0][3]=$i;
    
    
    }
    
                if (isset($D)) echo "\n\n f1: ".__LINE__." CC ".$CC." xk ".$xk." vk ".$vk." i ".$i." SC < ".count($SC)." > ".var_src($SC);
    
    // 2018 0707 $i was used to detect end of outer loop, so must not be used for other purposes!!
    
    // After setting $SC, no need to execute code to search end: ??
    $j = $i;
    
    
    if ($i == $j) { // adapted from xif: else: end: No else: for cforeach: 
        // If there are nested cforeach: let inner block return error, then readjust adjust end index.
        
                    if (isset($D)) echo "\n\n f1: " . __LINE__ . " c ".var_src($c);
        
        foreach ($c as $ck => $ce) {

            if (isset($D)) { echo "\n\n f1: " . __LINE__ . " CC ".$CC." SC ".var_src($SC)." vk " . $vk ." i " . $i ." ck " . $ck . " ce " . var_src($ce) . " count S " . count($S) . "\n"; fgl_s(); }

            // these code needs to be run once during initialization, or every iteration?
            // xk vk represent instance of execution of this function

            $S[] = $ce; // 2018 07 06 last TOS is tr?
            // $S[] = array($vk, $i); // 2018 07 06 interfere with swap: ??
            // outer loop first time end:A as arguments to x:, when readjust $SC, need to readjust arguments to x: too -- f1: f1: end:A end:B
            
            $S[] = array($vk, $SC[$CC][3]);
            
            fgl_x();
            
            // 2018 07 06: need to adjust $SC here, after inner loop ends.
            // check control layer (number of layers of control structure)
            // if $CL==0 then check $SC[$CL][3] > $i (initial value of end counter for fgl_x() )
            // continue from $xk (?) until $SC[$CL][3] ??
            
            if (isset($D)) { echo "\n\n\n f1: " . __LINE__ ." vk ".$vk. " i ".$i. " ck " . $ck . " ce " . var_src($ce) . " count S " . count($S) . " CC ".$CC." SC ".var_src($SC)."\n";
            // echo " cforeach " . __LINE__ . " pwd " . getcwd() . " ";
                fgl_s();
            }
            
            while (count($S) > $L0) {
                $SA[] = array_pop($S);
            }
        } 
        
        if (isset($D)) echo "\n f1: " . __LINE__ ." end foreach()\n";
        
        // 2018 0707 this gets executed line 713 fgl_x() causes <tr> taken by td: ??
        if (0) if (isset($SC[$CC+1][3])) {
            echo " line ".__LINE__." ".$SC[$CC][3]." ".$SC[$CC+1][3]." xk ".$xk." l ".$l." ";
            for ($i = $xk+1; $i < $l; $i++) {
                echo __LINE__ . " end: {$i} ";
                if ($xs[$i] == "end:") {
                    break;
                }
            } 
            
            if ($i-$xk>1) {
                $S[] = array($vk, $i);
                fgl_x();
            }

                       
        }
    } else {  // unused, adapted from xif: else: end: No else: for cforeach: 
        if ($c) {
            $S[] = array($xk, $j);
            fgl_x();
        } else {
            $S[] = array($j, $i);
            fgl_x();
        }
    }
    
    if (isset($D)) { echo "\n\n" . __FUNCTION__ . " " . __LINE__ . " CC ".$CC. " end " .$SC[$CC][3]. " i " . $i. " SA ". var_src($SA). " ";
        fgl_s();
    }
    
    $xk = $i;
	// $S[] = array("prg_ctr", $i);
	$S[] = array("prg_ctr", $SC[$CC][3]);
    
    
}



function fgl_f1f() // f1f: foreach, bootstrap in 5GL, so that can be ported to JavaScript or other languages?
{
    global $S, $xk, $xs, $SS, $SA, $SC; // in future $S? should be &$var pointing to array that can be switched
    global $V; // variable map, for 5gl functions to access global or local variables
    
    $V=array();
    
    // $xc = count($SS);
    $xc = count($SS)+1; // 2018 07 30 write PHP to 5GL parser?
    // can eval RHS, but has to be portable to JavaScript?
    // count($SS) > $SS count > SS r: count: // r: read variable, need eval string; count: normal execution
    // xc v: eval string assign TOS to xc
    // $S[]='script 5gl:'; fgl_php(); eval(array_pop($S)); // fgl_js() for JavaScript etc.
    
    /*
    $S[]='SS r:'; fgl_php();    
    echo "\n".__LINE__." fgl_php() "; fgl_s();
    eval(array_pop($S));    
    echo "\n".__LINE__." fgl_php() "; fgl_s();

    // $S[]='count:'; 
    $S[]='c:'; 
    fgl_php();    
    echo "\n".__LINE__." fgl_php() "; fgl_s();
    */
    
    // eval(array_pop($S));    
    // echo "\n".__LINE__." fgl_php() "; fgl_s();

    // 20180731 only need eval for local variables read / write. After pushed to stack, use existing 5gl convention?

    /*
    $S[]='SS r: c: 9 xc v:';
    echo "\n".__LINE__." fgl_php() "; fgl_php();    
    echo "\n".__LINE__." fgl_php() "; fgl_s();
    // eval(
    $t=array_pop($S);
    // eval($t);    
    echo "\n".__LINE__." $t "; fgl_s();
    echo "\n".__LINE__." fgl_php() "; fgl_php();
    */

    $S[]='SS r: c: xc v:';    
    do {
        echo "\n".__LINE__." "; fgl_s();
        echo "\n".__LINE__." fgl_php() "; fgl_php();    
        echo "\n".__LINE__." "; fgl_s();
        // eval(
        $f=array_pop($S);
        $t=array_pop($S);
        
        if ($t=='') $t=":END:";
        
        echo "\n".__LINE__." $t :".end($S).": "; fgl_s();
        
        if (end($S)=='') break;
        
        // if ($t==":END:") break; else eval($t); fgl_swap();   // cannot swap if v: TOS not affected!!
        if ($t==":END:") break; else eval($t); 
        if ($f==':r:') fgl_swap();   // cannot swap if v: TOS not affected!!
            
        // echo "\n".__LINE__." fgl_php() "; fgl_php();
        // echo "\n".__LINE__." fgl_php() "; fgl_s();
    } while ($t!=":END:" || end($S)!='');

    
    // $V[]=array("xc", &$xc);
    $V["xc"]= &$xc;
    
    echo "\n\n".__LINE__." V ".var_src($V)." ; ";
    
    echo __LINE__." xc ".$xc." ";
    
    $S[]=count($SS); $S[]='xc'; 
    // $S[]=&$xc;
    fgl_va(); // xc is local variable. How?
    
    echo __LINE__." xc ".$xc." ; ".var_src(get_defined_vars());
    
    
    
    
    $xk =& $SS[$xc - 1][0]; // counter
    $xs =& $SS[$xc - 1][1]; // script
    $xl = count($SS[$xc - 1][1]);
    $vk = $xk;
    $a = $xs;
    $l = $xl;

    $LC=count($SC); $E=$LC-1;
    
    echo "\n\n".__LINE__." xc ".$xc." ; ".var_src(get_defined_vars());
    
    // 2018 07 25 just need to access get_defined_vars(), then can get var and override using &$var?
    // $m = &$xc; 
    // $m = eval("return "."\& \$"."xc".";"); 
    // eval('$m = &$xc;');
    $vn="xc";
    eval('$m = &$'.$vn.';');
     
    $m = 726;
    echo __LINE__." xc ".$xc." ; ";
    
    exit;
    
    // get $CC
     
    // $SC[$E][2]=$vk; $SC[$E][]=$i;

    // 2018 0707 need to rethink, how to initialize $SC and Control Layer Index $CL
    // comment before code, adjust $SC when outer loop or inner loop starts?
    // this control function start end must be bounded by parent (if any)
    // this section of code is only executed once for top control function
    // it is repeated for children control functions
    // when a new element is appended to $SC, it has a new $CL  
    // when it is repeated, derive $CL from $xk and $SC ?? Seems safest way.
       
    if ($LC==0) $SC[]=array("f1",$xc-1,$xk); // id, SS index, start, current, end; current, end not defined yet. 
    else if (isset($SC[$E][2])) if ($xk>$SC[$E][2]) $SC[]=array("f1",$xc-1,$xk); // $xc-1 = Script Index, layers of script, only 0 so far.
    
    if ($LC>0) { $S[]=$vk; fgl_CC(); 
        // fgl_s(); 
        $t=array_pop($S);     
        $CC=$t[0]; 
        // echo " CC " . $CC . "\n"; 
        }
    else $CC=$LC; // control stack counter, control layer index?
    
    
    // $E=last index of stack, when new control structure is defined, $E is set to end of new control structure
    // ($xk>$SC[$E][2]) is only true when initially, start end of control structure is undefined, hence $E points to parent.
    
    // 2018 07 06: outer loop will not return here to adjust $xk, so how?
    // inner loop only need to adjust $SC once? let inner loop adjust $SC of outer loop?
    
    // append if xk > start index of top of SC
    // if start < xk < end, isset(end_index) ==> repeat instance of loop
    
    if (isset($D)) echo "\n f1: ".__LINE__." xk ".$xk." SC < ".count($SC)." > ".var_src($SC);
    // update current program counter before calling x:

    if (isset($D)) { echo "\n\n\n" . __FUNCTION__ . " loop start " . __LINE__ . " SS ";     fgl_pss();     fgl_s(); }
    
    $c = array_pop($S); // non-control code
    
    if (isset($D)) echo "\n f1: ".__LINE__." xk ".$xk." SC < ".count($SC)." > ".var_src($SC)." c ".var_src($c)." ";
    
    
    
    for ($i = $xk; $i < $l; $i++) {
        if (isset($D)) echo __LINE__ . " end: {$i} ";
        if ($xs[$i] == "end:") {
            break;
        }
    }
    /* for ($j=$xk; $j<$i; $j++) {
           echo __LINE__." if: $i $j ";
           if ($xs[$j]=="else:") break;
       
       } */
    $j = $i;
    
      $L0 = count($S);
           
            $LC=count($SC); $E=$LC-1; $SC[$E][2]=$vk; if (!isset($SC[$E][3])) $SC[$E][]=$i;
            // echo "\n\n cforeach: ".__LINE__." vk ".$vk." ck "." ce "." SC < ".count($SC)." > ".var_src($SC);
            // echo "\n\n cforeach: ".__LINE__." vk ".$vk." ck ".$ck." ce ".$ce." SC < ".count($SC)." > ".var_src($SC);
            if (isset($D)) echo "\n\n f1: ".__LINE__." xk ".$xk." vk ".$vk." i ".$i." SC < ".count($SC)." > ".var_src($SC);
            
            // 2018 07 06: if $SC[0][3]==$SC[0][3] repeat search end: loop.
    if (isset($SC[1][3])) if ($SC[0][3]==$SC[1][3]) {
        
    for ($i = $i+1; $i < $l; $i++) {
        if (isset($D)) echo __LINE__ . " end: {$i} ";
        if ($xs[$i] == "end:") {
            break;
        }
    }
    
    $SC[0][3]=$i;
    
    
    }
    
                if (isset($D)) echo "\n\n f1: ".__LINE__." CC ".$CC." xk ".$xk." vk ".$vk." i ".$i." SC < ".count($SC)." > ".var_src($SC);
    
    // 2018 0707 $i was used to detect end of outer loop, so must not be used for other purposes!!
    
    // After setting $SC, no need to execute code to search end: ??
    $j = $i;
    
    
    if ($i == $j) { // adapted from xif: else: end: No else: for cforeach: 
        // If there are nested cforeach: let inner block return error, then readjust adjust end index.
        
                    if (isset($D)) echo "\n\n f1: " . __LINE__ . " c ".var_src($c);
        
        foreach ($c as $ck => $ce) {

            if (isset($D)) { echo "\n\n f1: " . __LINE__ . " CC ".$CC." SC ".var_src($SC)." vk " . $vk ." i " . $i ." ck " . $ck . " ce " . var_src($ce) . " count S " . count($S) . "\n"; fgl_s(); }

            // these code needs to be run once during initialization, or every iteration?
            // xk vk represent instance of execution of this function

            $S[] = $ce; // 2018 07 06 last TOS is tr?
            // $S[] = array($vk, $i); // 2018 07 06 interfere with swap: ??
            // outer loop first time end:A as arguments to x:, when readjust $SC, need to readjust arguments to x: too -- f1: f1: end:A end:B
            
            $S[] = array($vk, $SC[$CC][3]);
            
            fgl_x();
            
            // 2018 07 06: need to adjust $SC here, after inner loop ends.
            // check control layer (number of layers of control structure)
            // if $CL==0 then check $SC[$CL][3] > $i (initial value of end counter for fgl_x() )
            // continue from $xk (?) until $SC[$CL][3] ??
            
            if (isset($D)) { echo "\n\n\n f1: " . __LINE__ ." vk ".$vk. " i ".$i. " ck " . $ck . " ce " . var_src($ce) . " count S " . count($S) . " CC ".$CC." SC ".var_src($SC)."\n";
            // echo " cforeach " . __LINE__ . " pwd " . getcwd() . " ";
                fgl_s();
            }
            
            while (count($S) > $L0) {
                $SA[] = array_pop($S);
            }
        } 
        
        if (isset($D)) echo "\n f1: " . __LINE__ ." end foreach()\n";
        
        // 2018 0707 this gets executed line 713 fgl_x() causes <tr> taken by td: ??
        if (0) if (isset($SC[$CC+1][3])) {
            echo " line ".__LINE__." ".$SC[$CC][3]." ".$SC[$CC+1][3]." xk ".$xk." l ".$l." ";
            for ($i = $xk+1; $i < $l; $i++) {
                echo __LINE__ . " end: {$i} ";
                if ($xs[$i] == "end:") {
                    break;
                }
            } 
            
            if ($i-$xk>1) {
                $S[] = array($vk, $i);
                fgl_x();
            }

                       
        }
    } else {  // unused, adapted from xif: else: end: No else: for cforeach: 
        if ($c) {
            $S[] = array($xk, $j);
            fgl_x();
        } else {
            $S[] = array($j, $i);
            fgl_x();
        }
    }
    
    if (isset($D)) { echo "\n\n" . __FUNCTION__ . " " . __LINE__ . " CC ".$CC. " end " .$SC[$CC][3]. " i " . $i. " SA ". var_src($SA). " ";
        fgl_s();
    }
    
    $xk = $i;
	// $S[] = array("prg_ctr", $i);
	$S[] = array("prg_ctr", $SC[$CC][3]);
    
    
}



function fgl_cforeach() // use $SC control stack, $SS script stack
{
    global $S, $xk, $xs, $SS, $SA, $SC; // in future $S? should be &$var pointing to array that can be switched
    
//    echo "\n\n\n" . __FUNCTION__ . " " . __LINE__ . " SS ";     fgl_pss();     fgl_s();

    $xc = count($SS);
    $xk =& $SS[$xc - 1][0]; // counter
    $xs =& $SS[$xc - 1][1]; // script
    $xl = count($SS[$xc - 1][1]);
    $vk = $xk;
    $a = $xs;
    $l = $xl;

    $LC=count($SC); $E=$LC-1;
    $CC=$LC; // control stack counter
     // $SC[$E][2]=$vk; $SC[$E][]=$i;

    // comment before code, adjust $SC when outer loop or inner loop starts?     
    if ($LC==0) $SC[]=array("cforeach",$xc-1,$xk); // id, SS index, start, current, end; current, end not defined yet. 
    else if (isset($SC[$E][2])) if ($xk>$SC[$E][2]) $SC[]=array("cforeach",$xc-1,$xk); 
    
    // 2018 07 06: outer loop will not return here to adjust $xk, so how?
    // inner loop only need to adjust $SC once? let inner loop adjust $SC of outer loop?
    
    // append if xk > start index of top of SC
    // if start < xk < end, isset(end_index) ==> repeat instance of loop
    
    // echo "\n cforeach: ".__LINE__." xk ".$xk." SC < ".count($SC)." > ".var_src($SC);
    // update current program counter before calling x:

    echo "\n\n\n" . __FUNCTION__ . " loop start " . __LINE__ . " SS ";     fgl_pss();     fgl_s();

    $c = array_pop($S); // non-control code
    echo "\n cforeach: ".__LINE__." xk ".$xk." SC < ".count($SC)." > ".var_src($SC)." c ".var_src($c)." ";
    
    
    
    for ($i = $xk; $i < $l; $i++) {
        echo __LINE__ . " end: {$i} ";
        if ($xs[$i] == "end:") {
            break;
        }
    }
    /* for ($j=$xk; $j<$i; $j++) {
           echo __LINE__." if: $i $j ";
           if ($xs[$j]=="else:") break;
       
       } */
    $j = $i;
    
      $L0 = count($S);
           
            $LC=count($SC); $E=$LC-1; $SC[$E][2]=$vk; if (!isset($SC[$E][3])) $SC[$E][]=$i;
            // echo "\n\n cforeach: ".__LINE__." vk ".$vk." ck "." ce "." SC < ".count($SC)." > ".var_src($SC);
            // echo "\n\n cforeach: ".__LINE__." vk ".$vk." ck ".$ck." ce ".$ce." SC < ".count($SC)." > ".var_src($SC);
            echo "\n\n cforeach: ".__LINE__." xk ".$xk." vk ".$vk." i ".$i." SC < ".count($SC)." > ".var_src($SC);
    
    
    if ($i == $j) { // adapted from xif: else: end: No else: for cforeach: 
        // If there are nested cforeach: let inner block return error, then readjust adjust end index.
        foreach ($c as $ck => $ce) {
            // echo "\n\n xforeach " . __LINE__ . " ck " . $ck . " ce " . $ce . " count S " . count($S) . "\n"; fgl_s();

            // these code needs to be run once during initialization, or every iteration?
            // xk vk represent instance of execution of this function

            $S[] = $ce; // 2018 07 06 last TOS is tr?
            $S[] = array($vk, $i); // 2018 07 06 interfere with swap: ??
            fgl_x();
            
            // 2018 07 06: need to adjust $SC here, after inner loop ends.
            
            echo "\n\n\n cforeach: " . __LINE__ ." vk ".$vk. " ck " . $ck . " ce " . var_src($ce) . " count S " . count($S) . " CC ".$CC." SC ".var_src($SC)."\n";
            // echo " cforeach " . __LINE__ . " pwd " . getcwd() . " ";
            // fgl_s();
            while (count($S) > $L0) {
                $SA[] = array_pop($S);
            }
        } 
        
        echo "\n cforeach: " . __LINE__ ." end foreach()\n";
        
        if (isset($SC[$CC+1][3])) {
            echo " line ".__LINE__." ".$SC[$CC][3]." ".$SC[$CC+1][3]." xk ".$xk." l ".$l." ";
            for ($i = $xk+1; $i < $l; $i++) {
                echo __LINE__ . " end: {$i} ";
                if ($xs[$i] == "end:") {
                    break;
                }
            } 
            
            if ($i-$xk>1) {
                $S[] = array($vk, $i);
                fgl_x();
            }

                       
        }
    } else {  // unused, adapted from xif: else: end: No else: for cforeach: 
        if ($c) {
            $S[] = array($xk, $j);
            fgl_x();
        } else {
            $S[] = array($j, $i);
            fgl_x();
        }
    }
    echo "\n" . __FUNCTION__ . " " . __LINE__ . " ";
    fgl_s();
    $xk = $i;
	$S[] = array("prg_ctr", $i);
    /*
        if ($a) { $S[]="if 1 $a $vk $i $j"; 
            $S[]=$vk+1; $S[]=$j;
        }
        else { $S[]="if 0 $a $vk $i $j"; 
            $S[]=$j+1; $S[]=$i;
    */
}


function fgl_xforeach()
{
    global $S, $xk, $xs, $SS, $SA;
    echo "\n" . __FUNCTION__ . " " . __LINE__ . " ";
    fgl_pss();
    fgl_s();
    $c = array_pop($S);
    $xc = count($SS);
    $xk =& $SS[$xc - 1][0];
    $xs =& $SS[$xc - 1][1];
    $xl = count($SS[$xc - 1][1]);
    $vk = $xk;
    $a = $xs;
    $l = $xl;
    for ($i = $xk; $i < $l; $i++) {
        echo __LINE__ . " end: {$i} ";
        if ($xs[$i] == "end:") {
            break;
        }
    }
    /* for ($j=$xk; $j<$i; $j++) {
           echo __LINE__." if: $i $j ";
           if ($xs[$j]=="else:") break;
       
       } */
    $j = $i;
    if ($i == $j) {
        foreach ($c as $ck => $ce) {
            // echo "\n\n xforeach " . __LINE__ . " ck " . $ck . " ce " . $ce . " count S " . count($S) . "\n"; fgl_s();
            $L0 = count($S);
            $S[] = $ce;
            // fgl_s();
            $S[] = array($vk, $i);
            fgl_x();
            echo "\n\n xforeach " . __LINE__ . " ck " . $ck . " ce " . $ce . " count S " . count($S) . "\n";
            echo " xforeach " . __LINE__ . " pwd " . getcwd() . " ";
            // fgl_s();
            while (count($S) > $L0) {
                $SA[] = array_pop($S);
            }
        }
    } else {
        if ($c) {
            $S[] = array($xk, $j);
            fgl_x();
        } else {
            $S[] = array($j, $i);
            fgl_x();
        }
    }
    fgl_s();
    $xk = $i;
	$S[] = array("prg_ctr", $i);
    /*
        if ($a) { $S[]="if 1 $a $vk $i $j"; 
            $S[]=$vk+1; $S[]=$j;
        }
        else { $S[]="if 0 $a $vk $i $j"; 
            $S[]=$j+1; $S[]=$i;
    */
}

function fgl_rem()
{
    global $S, $xk, $xs, $SS, $SA;
    echo "\n" . __FUNCTION__ . " " . __LINE__ . " ";
    fgl_pss();
    fgl_s();
    $c = array_pop($S);
    $xc = count($SS);
    $xk =& $SS[$xc - 1][0];
    $xs =& $SS[$xc - 1][1];
    $xl = count($SS[$xc - 1][1]);
    $vk = $xk;
    $a = $xs;
    $l = $xl;
    for ($i = $xk; $i < $l; $i++) {
        echo __LINE__ . " end: {$i} ";
        if ($xs[$i] == "end:") {
            break;
        }
    }
    /* for ($j=$xk; $j<$i; $j++) {
           echo __LINE__." if: $i $j ";
           if ($xs[$j]=="else:") break;
       
       } */
    $j = $i;
    if (0) if ($i == $j) {
        foreach ($c as $ck => $ce) {
            // echo "\n\n xforeach " . __LINE__ . " ck " . $ck . " ce " . $ce . " count S " . count($S) . "\n"; fgl_s();
            $L0 = count($S);
            $S[] = $ce;
            // fgl_s();
            
            // rem: remarks, comments, no execution
            // $S[] = array($vk, $i); fgl_x();
            echo "\n\n xforeach " . __LINE__ . " ck " . $ck . " ce " . $ce . " count S " . count($S) . "\n";
            echo " xforeach " . __LINE__ . " pwd " . getcwd() . " ";
            // fgl_s();
            while (count($S) > $L0) {
                $SA[] = array_pop($S);
            }
        }
    } else {
        if ($c) {
            // $S[] = array($xk, $j); fgl_x();
        } else {
            // $S[] = array($j, $i); fgl_x();
        }
    }
    fgl_s();
    $xk = $i;
	$S[] = array("prg_ctr", $i);
    /*
        if ($a) { $S[]="if 1 $a $vk $i $j"; 
            $S[]=$vk+1; $S[]=$j;
        }
        else { $S[]="if 0 $a $vk $i $j"; 
            $S[]=$j+1; $S[]=$i;
    */
}

function fgl_case()
{
    global $S, $vk, $xk, $xs, $SS;
    echo "\n" . __FUNCTION__ . " " . __LINE__ . " ";
    fgl_pss();
    $c = array_pop($S);
    $xc = count($SS);
    $xk =& $SS[$xc - 1][0];
    $xs =& $SS[$xc - 1][1];
    $xl = count($SS[$xc - 1][1]);
    $a = $xs;
    $l = $xl;
    for ($i = $xk; $i < $l; $i++) {
        echo __LINE__ . " endof: {$i} ";
        if ($xs[$i] == "endof:") {
            break;
        }
    }
    for ($j = $xk; $j < $i; $j++) {
        echo __LINE__ . " of: {$i} {$j} ";
        if ($xs[$j] == "of:") {
            break;
        }
    }
    $S[] = array($c, $xk, $i, $j, $xs[$xk], $xs[$i], $xs[$j]);
    if ($i == $j) {
        if ($c) {
            if ($i > $xk + 1) {
                $S[] = array($xk, $i);
                fgl_x();
            }
        }
    } else {
        $S[] = array("case", $i, $xs[$i], $xs[$i - 1], $xk, $j, $c);
        $S[] = array($xk, $j);
        fgl_x();
        if ($c == array_pop($S)) {
            echo __LINE__ . "\n";
            $S[] = array($j, $i);
            fgl_x();
        } else {
        }
    }
    fgl_s();
    $xk = $i;
    /*
        if ($a) { $S[]="if 1 $a $vk $i $j"; 
            $S[]=$vk+1; $S[]=$j;
        }
        else { $S[]="if 0 $a $vk $i $j"; 
            $S[]=$j+1; $S[]=$i;
    */
}
function fgl_if()
{
    global $S, $vk;
    $a = array_pop($S);
    $l = count($S[0]);
    echo __LINE__ . " if: {$i} {$l} {$vk}";
    for ($i = $vk; $i < $l; $i++) {
        echo __LINE__ . " if: {$i} ";
        if ($S[0][$i] == "endif:") {
            break;
        }
    }
    for ($j = $vk; $j < $i; $j++) {
        echo __LINE__ . " if: {$i} {$j} ";
        if ($S[0][$j] == "else:") {
            break;
        }
    }
    if ($a) {
        $S[] = "if 1 {$a} {$vk} {$i} {$j}";
        $S[] = $vk + 1;
        $S[] = $j;
    } else {
        $S[] = "if 0 {$a} {$vk} {$i} {$j}";
        $S[] = $j + 1;
        $S[] = $i;
    }
    fgl_xblk();
}
function fgl_xblk()
{
    global $S;
    $a = array_pop($S);
    $b = array_pop($S);
    echo __LINE__ . "\n " . $a . " " . $b . "\n";
    $S[] = array_slice($S[0], $b + 1, $a - $b - 1);
    fgl_s();
    fgl_es();
}
/* function var_src($b)
{
        return preg_replace("/\s+/"," ",var_export($b,true))."\n";
}
*/

// 2018 10 19: need a simple : f funcname eval, takes single argument?
// 

function fgl_e() // expression e: return expression, can be constant or function() ?
{
    global $S;
    $S[] = eval("return " . array_pop($S) . ";");
}
function t_alias($n)
{
    global $alias;
    global $r, $lc, $k, $n1, $la, $logFile;
    $fn = __FUNCTION__;
    $fl = strlen($fn);
    $fk = substr($fn, 4);
    $ki = $lc[$k - 1];
    $lc[$k] = $fk;
    $p = $alias;
    $pk = array_keys($p);
    $c = $p[$pk[0]];
    $ck = array_keys($c);
    $jo = array($n, mb_detect_encoding($n), in_array($n, $ck), $ck);
    if (in_array($n, $ck)) {
        $tf = $c[$n];
    } else {
        $tf = 0;
    }
    file_put_contents("o_ta", "\n\n" . date("Y-m-d H:i:s") . "> " . json_encode($jo) . "\n", FILE_APPEND);
    return $tf;
}
function t_alias_chain($n)
{
    global $alias;
    global $r, $lc, $k, $n1, $la, $logFile;
    $fn = __FUNCTION__;
    $fl = strlen($fn);
    $fk = substr($fn, 4);
    $ki = $lc[$k - 1];
    $lc[$k] = $fk;
    $p = $alias;
    $pk = array_keys($p);
    $c = $p[$pk[0]];
    $ck = array_keys($c);
    $jo = array($n, mb_detect_encoding($n), in_array($n, $ck), $ck);
    if (in_array($n, $ck)) {
        $tf = $c[$n];
    } else {
        $tf = 0;
    }
    $i = 0;
    while (substr($tf, 0, 4) != "fws_" && substr($tf, 0, 2) != "s_" && $i < 10) {
        if (in_array($tf, $ck)) {
            $tf = $c[$tf];
        } else {
            $tf = 0;
        }
        $i++;
        file_put_contents("o_ta", "\n\n" . date("Y-m-d H:i:s") . "> " . json_encode(array("in loop ", $tf, $i)) . "\n", FILE_APPEND);
    }
    file_put_contents("o_ta", "\n\n" . date("Y-m-d H:i:s") . "> " . json_encode(array($tf, $jo)) . "\n", FILE_APPEND);
    return $tf;
}
function fgl_achn()
{
    fgl_alias_chain();
}
function fgl_alias_chain()
{
    global $alias, $S;
    $n = array_pop($S);
    global $r, $lc, $k, $n1, $la, $logFile;
    $fn = __FUNCTION__;
    $fl = strlen($fn);
    $fk = substr($fn, 4);
    $ki = $lc[$k - 1];
    $lc[$k] = $fk;
    $p = $alias;
    $pk = array_keys($p);
    $c = $p[$pk[0]];
    $ck = array_keys($c);
    $jo = array($n, mb_detect_encoding($n), in_array($n, $ck), $ck);
    if (in_array($n, $ck)) {
        $tf = $c[$n];
    } else {
        $tf = 0;
    }
    $S[] = $tf;
    return 0;
    $i = 0;
    while (substr($tf, 0, 4) != "fws_" && substr($tf, 0, 2) != "s_" && $i < 10) {
        if (in_array($tf, $ck)) {
            $tf = $c[$tf];
        } else {
            $tf = 0;
        }
        $i++;
        file_put_contents("o_ta", "\n\n" . date("Y-m-d H:i:s") . "> " . json_encode(array("in loop ", $tf, $i)) . "\n", FILE_APPEND);
    }
    file_put_contents("o_ta", "\n\n" . date("Y-m-d H:i:s") . "> " . json_encode(array($tf, $jo)) . "\n", FILE_APPEND);
    return $tf;
}
