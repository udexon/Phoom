    global $argv, $S, $SS, $xk, $xs, $SC, $SL;
    $a = preg_replace('/\s+/', ' ', $a);
    $a = explode(' ', $a);
    $xc = count($SS);
    $xk =& $SS[$xc - 1][0];
    $xs =& $SS[$xc - 1][1];
    $xl = count($SS[$xc - 1][1]);
    $vk = $xk;
    $Z=$xl;
    $t=array_pop($S);     $CC=$t[0]; 
        $vk = $xk;
        $v = trim($xs[$xk]);
            $S[] = $v;
            $l = strlen($v);
                $l = strlen($v);
                $fn = substr($v, 0, $l - 1);
                    call_user_func("fgl_" . $fn);
						$va = end($S);
							$va = array_pop($S);
							$vk = $va[1]; $xk=$vk;
                    $s=array_pop($S);
                    $S[]=implode(' ', array_slice($xs, $xk+1));
                    $sa=array_pop($S);
                    $sb=array_pop($S);
                    $S[]=implode(' ', array_slice($xs, $xk+1));
                    $sa=array_pop($S);
                    $sc=count($S);
                    $se=$S[ $sc - $sa ];
                    for ($si=0; $si<$sa; $si++) {
                    $sb=array_pop($S);
                    $S[]=implode(' ', array_slice($xs, $xk+1));
                    $S[]='$S[]=count('.array_pop($S).'); ';
           $bx = array_pop($S);
          if (array_pop($S)==0) $xk = $bx;
          continue;
          fgl_dup();
          if (array_pop($S)!=0)  { $xk = $bx + 1; continue; }
					if ($v=='_') $S[]=$v;
                            $sa = array_pop($S);
                            $sb = array_pop($S);
                            $S[] = $sb - $sa; 
                            $sa = array_pop($S);
                            $sb = array_pop($S);
                            $S[] = $sb + $sa; 
                            array_pop($S);
                                $S[] = array_pop($S) === array_pop($S);
                                $S[] = $v;
        $xk++;
            break;
    } while ($vk < $xl);
    $S[]=":END:";