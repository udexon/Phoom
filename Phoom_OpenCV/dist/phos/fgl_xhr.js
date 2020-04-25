// 2018 06 09 change to space split tokens, unify front end pre processing, back end, front end post processing

// 20170905 need to implement string e:
// string may contain space, or read from pipe

var rp_r, rp_a; // for debug in Console
var S=[]; // global stack
var S0=[]; // local stack

// 20171019 JavaScript or non-Fifth escape

// 20180504
// document.body e: s:
// .childElementCount e: s:

var NFS;
var GLS=[];
var glf=1; // process frond end gl command

var getObjectValue = function getter(object, key) { var value; if (typeof object === 'object' && typeof key === 'string') { value = eval('object' + '.' + key); } return value; } 

function f( a ) {
    return 'F'+':'+a.length;
}

function rpx( a , r ) { // r is json string of all past results

    var l=a.length-1;
    var se;

    // if (a) alert("rpx a: "+typeof(a)+' '+a.length+' '+a[0]);

    var L=a[l]; var L1=a[l-1]; var L2=a[l-2];
    // S[]=a;

    // 0514 // alert("Stack is (rpx 33) "+JSON.stringify(S));    

    // S.push(a); // command and arguments as one array is pushed on to stack 2018 05 18
    
    // need to unpack, so that command can process stack data from previous commands

    for (se of a) S.push(se);
    
    // 0514 // alert("Stack is (rpx 37) "+JSON.stringify(S));    

    // function, arg1, arg2

    // alert('rpx Nov10 a.length ' + a.length + ' L= ' + L + ' ' + (L=='p'));
    
    var Lc='算';
    var c= L.localeCompare('算');
    var c1= L.localeCompare(L);
    var c2= L.localeCompare('错');
    var c3= L.localeCompare('\u7b97'); // correct way of definition, not var c above!!
    
    /*
    alert('rpx 1022 '+ L + ' ' + a.length + ' ' + (L=='算') + ' ' + c);
    alert('c '+c+' L '+ L.charCodeAt(0).toString(16));
    alert('c1 '+c1+' Lc '+ Lc.charCodeAt(0).toString(16));
    alert('c2 '+c2);
    alert('c3 '+c3);
    */
    // if (glf==1) 
    if (L=='f') {
    
        r=r.substr(0,r.length-1)+' ]';
//        alert("is f; length is "+l+" r.length="+r.length+" "+r); // r is a string, has comma at end, need to remove
  
        // 2018 05 17 
        // S.push(eval(S.pop()+'('+ S.pop() +')' ));

       // alert("f: (70) "+S+" "+typeof(se));


        S.pop(); // function name
        // S.pop(); // command index

        se=S.pop();
       // alert("f: (77) "+S+" "+typeof(se));

        S.push(( se +'('+ S.pop() +')' ));
      //  alert("f: (end) "+S);
        
        // 2018 05 17 if (0)
        if (0) if (l==2) {
  
        // var j1=JSON.parse(j[0][0]);
        var j1=j[0][1];
  
        alert(j1+" "+typeof(j1));
        
        var j2=JSON.parse(j1);
        
            return [L,j2[1]+'('+L1+')'];
        
        }
        else return [L, L1+'('+L2+')'];  // f(x) how to read result of previous function as input?
        // string cannot start with null?
        
        // 2017020 return json object with index = function (L)
        // need to get json object parent through function argument
    } 
    else if (L=='ff') {  // function argument is object ('eval'ed), not string // 2018 05 18
    
        r=r.substr(0,r.length-1)+' ]';
//        alert("is f; length is "+l+" r.length="+r.length+" "+r); // r is a string, has comma at end, need to remove

        // var j=JSON.parse(r); alert("is f; length is "+l+" r.length="+r.length+" j.length="+j.length+" "+typeof(j)+" "+JSON.stringify(j[0][0])+" "+typeof(j[0][0])+"; "+JSON.stringify(j[0][1])+" "+typeof(j[0][1])); // r is a string
  
        // 2018 05 17 
        // S.push(eval(S.pop()+'('+ S.pop() +')' ));
        S.pop(); // function name
        // S.pop(); // command index

        se=S.pop();
        alert(" ff: "+S+" "+typeof(se));

        S.push( se ( S.pop() ));
        // S.push(eval( se +'('+ S.pop() +')' ));
        alert(S);
        
        // 2018 05 17 if (0)
        if (0) if (l==2) {
  
        // var j1=JSON.parse(j[0][0]);
        var j1=j[0][1];
  
        alert(j1+" "+typeof(j1));
        
        var j2=JSON.parse(j1);
        
            return [L,j2[1]+'('+L1+')'];
        
        }
        else return [L, L1+'('+L2+')'];  // f(x) how to read result of previous function as input?
        // string cannot start with null?
        
        // 2017020 return json object with index = function (L)
        // need to get json object parent through function argument
    }
    else if (L=='e' || c3==0) { 
    
        // 20180504
        // document.body e: s:
        // document.body e: .childElementCount e:
        // expand object if first character is . ?
    
        rp_a=a; rp_r=r;

        // 0514 // alert('rpx e: l '+l+' L1 '+L1);

        if (L1 != "" && NFS!==undefined) { // cannot use length, as first element is ""
        
            if (NFS[0]) L1=NFS[0];
            
                        alert('b1 1108 '+NFS[0]+GLS);
        
            var n=eval('eval("'+L1+'")');
            return n.toString(); // 20170720 change this to json array like log.php
        }
        else {
        
            // 20180504
           // alert(" e: (160) "+JSON.stringify(S)+" "+S0);
            // S0=S.pop(); // was array of current command and arguments?
            // alert("rpx e: (138) "+JSON.stringify(S)+" "+S0);
            // S0.pop(); // pop command?

            S.pop(); se=S.pop();
            // if (S0[0].substr(0,1)=='.') {
            if (se.substr(0,1)=='.') {
                S.pop(); 
                // S.push(getObjectValue(S[S.length-1], S0.pop().substr(1))); 
                // eval('eval("'+getObjectValue(S[S.length-2], S0.pop())+'")'    
                S.push(getObjectValue(S.pop(), S0.pop().substr(1)));
            }
            else { S.push(eval('eval("'+se+'")')); }
            // else { S.pop(); S.push(eval('eval("'+S0.pop()+'")')); } // before 2018 05 18, used S0
            
          //  alert("rpx (end) e: S "+JSON.stringify(S));
            
            // return n.toString(); // 20170720 change this to json array like log.php
        }
        // same as f, use result of previous function if insufficient arguments in list

        // return L1+'('+L2+')';
    }
    else if (L=='x') { // execute results separated by :

        // var n=eval('eval("'+j[1]+'")');
        // var n=eval('eval("'+L1+'")');

        var j=JSON.parse(r);
        var n=eval(j[1]);

        // var n=eval('1+3');
        return n.toString();
    }
    else if (L=='>') { // 20171110 need to break and send all commands to back end

	glf=0; // need to switch back to glf=1 after post processing is completed. else front end cannot be executed again!!
    
        // send results to back end; need log.php style json cascade results
        // if store results in json, need to modify parser in log.php
    
    }
    else if (L=='.') { // e.g. document.getElementById

        if (0) { // 2018 05 18 old code
//        r=r.substr(0,r.length-1).' \\]';
        r=r.substr(0,r.length-1)+' ]';
        
        var j=JSON.parse(r); // alert("is f; length is "+l+" r.length="+r.length+" j.length="+j.length); // r is a string
    
        alert("is dot; a= "+a+'; r= '+r+' ]; .= '+L2+'.'+L1+' length='+ l +" j.length="+j.length
        +" "+typeof(j[0])+" "
        // +j[0].length+" "
        +typeof(j[1])+" "
        // + j[1].length
        );
        
        rp_r = r;
        
        if (r == "[ ]") var t=[L, L2+'.'+L1]; // first time run, array/object not long enough ....
        else var t=[L, j[1][1][1]+'.'+L1]; // first time run, array/object not long enough ....
        
        alert(JSON.stringify(t)); // memory not preserved?
        
        r=[L, L2+'.'+L1];
    
        return JSON.stringify(t);
        }
        else { 
        
        S.pop(); // pop command
        
       // alert(" (start) dot "+ typeof(S[S.length-1]) +" "+ JSON.stringify( S[S.length-1] ) +" "+ typeof(S[S.length-2]) +" "+ JSON.stringify( S[S.length-2] ) );

// var getObjectValue = function getter(object, key) { var value; if (typeof object === 'object' && typeof key === 'string') { value = eval('object' + '.' + key); } return value; } 

        var sa, sb; sa=S.pop(); sb=S.pop();
        if (typeof sa === 'object' && typeof sb === 'string') S.push(getObjectValue(sa, sb)); 
        // S.push(eval('object' + '.' + sb)); 
        // if (typeof object === 'object' && typeof key === 'string') { value = eval('object' + '.' + key); 
        else S.push(sa+"."+sb);
        
        // before 2018 05 18 cannot eval object, only string 
        // S.push(S.pop()+"."+S.pop()); 
        
     //   alert(" (end) dot  "+ typeof(S[S.length-1]) +" "+ JSON.stringify( S[S.length-1] ) );
        
        }// 2018 05 18
// Command: document getElementById .: 'jsbin-javascript' f: outerHTML .:
    
    
    } 
    else if (L=='pfc') { // parent.function(child)

        if (0) { // 2018 05 18 old code
//        r=r.substr(0,r.length-1).' \\]';
        r=r.substr(0,r.length-1)+' ]';
        
        var j=JSON.parse(r); // alert("is f; length is "+l+" r.length="+r.length+" j.length="+j.length); // r is a string
    
        alert("is dot; a= "+a+'; r= '+r+' ]; .= '+L2+'.'+L1+' length='+ l +" j.length="+j.length
        +" "+typeof(j[0])+" "
        // +j[0].length+" "
        +typeof(j[1])+" "
        // + j[1].length
        );
        
        rp_r = r;
        
        if (r == "[ ]") var t=[L, L2+'.'+L1]; // first time run, array/object not long enough ....
        else var t=[L, j[1][1][1]+'.'+L1]; // first time run, array/object not long enough ....
        
        alert(JSON.stringify(t)); // memory not preserved?
        
        r=[L, L2+'.'+L1];
    
        return JSON.stringify(t);
        }
        else { 
        
        S.pop(); // pop command
        
      //  alert(" (start) pfc "+ typeof(S[S.length-1]) +" "+ JSON.stringify( S[S.length-1] ) +" "+ typeof(S[S.length-2]) +" "+ JSON.stringify( S[S.length-2] ) );


// var getObjectValue = function getter(object, key) { var value; if (typeof object === 'object' && typeof key === 'string') { value = eval('object' + '.' + key); } return value; } 

        var sa, sb, sc; sa=S.pop(); sb=S.pop(); sc=S.pop();
        if (typeof sa === 'object' && typeof sb === 'string') S.push(eval ('sa.'+sb+'(sc)'));
        // S.push(sa.sb(sc));
        // S.push(getObjectValue(sa, sb)); 
        // S.push(eval('object' + '.' + sb)); 
        // if (typeof object === 'object' && typeof key === 'string') { value = eval('object' + '.' + key); 
        else S.push(sa+"."+sb);
        
        // before 2018 05 18 cannot eval object, only string 
        // S.push(S.pop()+"."+S.pop()); 
        
     //   alert(" (end) pfc  "+ typeof(S[S.length-1]) +" "+ JSON.stringify( S[S.length-1] ) );
        
        }// 2018 05 18
    }
    
    else if (L=='j') { // JSON.stringify
    
    //        r=r.substr(0,r.length-1).' \\]';
        r=r.substr(0,r.length-1)+' ]';
        
        var j=JSON.parse(r); // alert("is f; length is "+l+" r.length="+r.length+" j.length="+j.length); // r is a string
    
        alert("is j: a= "+a+'; r= '+r+' ]; .= '+L2+'.'+L1+' length='+ l +" j.length="+j.length
        +" "+typeof(j[0])+" "
        // +j[0].length+" "
        +typeof(j[1])+" "+JSON.stringify(eval(L1))+" "+JSON.stringify(Object.getOwnPropertyNames(eval(L1)))
        // + j[1].length
        );
    
    } else if (L=='p') { // JSON.stringify(Object.getOwnPropertyNames(eval(L1)))
    
    //        r=r.substr(0,r.length-1).' \\]';
        r=r.substr(0,r.length-1)+' ]';
        
        var j=JSON.parse(r); // alert("is f; length is "+l+" r.length="+r.length+" j.length="+j.length); // r is a string
    
        alert("in p: a= "+a+'; r= '+r+' ]; .= '+L2+'.'+L1+' length='+ l +" j.length="+j.length
        +" "+typeof(j[0])+" "
        // +j[0].length+" "
        +typeof(j[1])+" "+JSON.stringify(Object.getOwnPropertyNames(eval(L1)))
        // + j[1].length
        );

if (GLS.length>0) GLS.pop();
    GLS.push(Object.getOwnPropertyNames(eval(L1)));
    
    // alert(GLS[0].length);
    
    
    
    
    } else if (L=='c') { // PHP count JS length
    
    var c=GLS[0].length;
if (GLS.length>0) GLS.pop();

GLS.push(c);


        alert('0927 in c: '+GLS);


    } else if (L=='i') { // i-th element of json or array
    var t = GLS[GLS.length-1];
    
    alert('in i: '+t + ' '+L1);
    
    } else if (L=='+') {
    
    
   //  alert('in +: '+ L1 + ' ' + L2);
   // alert(eval('"'+L1+'+'+L2+'"') + ' '+L1); // return string
    
    alert(eval(eval('"'+L1+'+'+L2+'"')));
    
    } else if (L=='+=') {
    
    
   //  alert('in +: '+ L1 + ' ' + L2);
   // alert(eval('"'+L1+'+'+L2+'"') + ' '+L1); // return string
    
    eval(eval('"'+L2+'='+L1+'+'+L2+'"'));
    alert('in +=: '+eval(L2));
    } else if (L=='s') {

    //    alert("Stack is (before) "+JSON.stringify(S));    
        S.pop(); // pop command
        // S.pop(); // pop command index //  2015 05 18: removed, use SL[]
      //  alert("Stack is (after) "+JSON.stringify(S));
    
    }
    
        // need to pop to next level to access elements separated by :
        // return e() is effectively pushing the term to stack
        // need code to evaluate and pop the stack again after new terms are pushed
        // pass current stack from parent to this function to evaluate pop it?

        // return eval(a[l]+'('+a+')');

    // 20180512        
    // if (a[i].length>0) if (typeof eval("fgl_"+a[i])==="function") eval("fgl_"+a[i]+"()");
    else if (L.length>0) if (typeof eval("fgl_"+L)==="function"){  // eval("fgl_"+L+"()");
        // if (L=='xs') S.push();
        eval("fgl_"+L+"()");
    }
    
    // S.pop(); // pop() command index has to be done in each command, then output push on to stack
        
}

function fgl_split()
{
var a;
a=S.pop();
S.push(a.split( S.pop() ) );

}

function fgl_swap()
{

var a, b;
S.pop(); // pop command
b=S.pop();
a=S.pop();
S.push(b);
S.push(a);

// alert("swap "+JSON.stringify(S));


}


function fgl_test()
{
    alert("fgl_test");
        alert("Stack is (before) "+JSON.stringify(S));    
        S.pop(); // S.pop();
        alert("Stack is (after) S.pop() "+JSON.stringify(S));
    

}

function fgl_for()
{
    alert("fgl_for");
        alert("Stack is (before) "+JSON.stringify(S));    
        S.pop(); // S.pop();
        alert("Stack is (after) S.pop() "+JSON.stringify(S));
    

}

function fgl_foreach()
{
    // 20180512 get S[0] whole string, return sub-block (need command index), then execute sub-block
    // or get array of commands, output sub-block array, no need to split again?
    
    //                                            command         command index
    // alert("fgl_foreach S.length "+S.length+" "+S.pop()+" "+S[3][S.pop()+1]); // S[3][S.pop()+1] next instruction
    var c=S.pop();
    var s=S[3][S.pop()+1];
    
    // alert("fgl_foreach S.length "+S.length+" "+c+" "+s); // S[3][S.pop()+1] next instruction
    
    // need to store S.length when started, because script may get executed multiple times?
    //    alert("foreach Stack is (before) "+JSON.stringify(S));    
    
    for (e of S[S.length-1]) { console.log(e);
        
        // S.push(S[S.length-1][0]); // element 0 of DOM
        // S.push(S[S.length-1][1]); // element 1 of DOM
        S.push(e);
        S.push(s);
        // S.pop(); // S.pop();
        // alert("foreach: Stack is (after) S.pop() "+JSON.stringify(S));
    
    fgl_xblk(); }
    
    SL[0]++; // skip one instruction

}

function fgl_foreach1() // prototype, once only
{
    // 20180512 get S[0] whole string, return sub-block (need command index), then execute sub-block
    // or get array of commands, output sub-block array, no need to split again?
    
    //                                            command         command index
    // alert("fgl_foreach S.length "+S.length+" "+S.pop()+" "+S[3][S.pop()+1]); // S[3][S.pop()+1] next instruction
    var c=S.pop();
    var s=S[3][S.pop()+1];
    
    alert("fgl_foreach S.length "+S.length+" "+c+" "+s); // S[3][S.pop()+1] next instruction
    
    // need to store S.length when started, because script may get executed multiple times?
        alert("foreach Stack is (before) "+JSON.stringify(S));    
        
        // S.push(S[S.length-1][0]); // element 0 of DOM
        S.push(S[S.length-1][1]); // element 1 of DOM
        S.push(s);
        // S.pop(); // S.pop();
        alert("foreach: Stack is (after) S.pop() "+JSON.stringify(S));
    
    fgl_xblk();
    
    SL[0]++; // skip one instruction

}



function fgl_over()
{
    alert("fgl_over");
        alert("Stack is (before) "+JSON.stringify(S));    
        S.pop(); // S.pop();
        alert("Stack is (after) S.pop() "+JSON.stringify(S));
    

}

function fgl_pop()
{
    alert("fgl_over");
        alert("Stack is (before) "+JSON.stringify(S));    
        S.pop(); // S.pop();
        S.pop();
        alert("Stack is (after) S.pop() "+JSON.stringify(S));
    

}





function delim_l( s , c , p ) {
    var r = 'r '; // old code, no var, reused other var r

    // alert("in delim_l p= "+p+" s= /"+s+"/ len="+s.length+" c="+c);

    s=s.trim();
    var a = s.split(c);
    
    // alert("in delim_l p= "+p+" s= /"+s+"/ c=/"+c+"/ a=/"+a+"/ a.length="+a.length);
    // 20180513 executed once more after rpbox?

    for (i in a) {                   
        r = r + ',' +i+' '+ a[i]+' ';                                     
    }

    // 20170720 not looping to evaluate expression in pipe?

    // return r+' |_'+i+' ['+a.length+' '+rpx(a);
    // return r+' ['+a.length+' '+rpx(a, p );
    //return JSON.stringify([a,r+' ['+a.length+' ',rpx(a, p )]);

    // 20170720 how to add <: and >: for front end and back end processing?

    var t; // if (glf==1) alert('glf true');
    
    // glf=0 on >: back end processing
    if (glf==1 && s.length>0) t=rpx(a, p );
    
    // alert(" in delim_l after t t= "+JSON.stringify(t)+" p= "+JSON.stringify(p));

    var u=[a,t];

//    alert(" in delim_l after t t= "+JSON.stringify(t)+" [a,t]= "+JSON.stringify(u));

    return JSON.stringify(u); 

    // return JSON.stringify([a,rpx(a, p )]); // p is json string of all past results
    // return function (L) as additional member together with existing rpx results
}

function fgl_e()
{

    var s=S.pop();
    alert("fgl_e: "+s);
    
    eval(s);

    return 0;
}

function fgl_xblk() // execute block
{
    var r = '[ ';

    var j=['']; // init array cannot be null
    
    var k;

    var a=[];
    a.push(S.pop());

    var i; // Must declare with var!! else unknown initialization!!
    for (i=0; i < a.length; i++) {
    
        // S.push(i); // command index, don't push on stack, affects operation, use SL[0] loop stack for command index

        // alert("xblk i= "+i+" a= "+a+" a.length="+a.length);                                     
        k=delim_l(a[i],' ',r); // r has all past results, so just need to parse.
        j[i]=k;
        r = r + j[i] +',';  // 20170720 loop is here, how to modify?
//        alert("in splitloop after r= "+r+" k= "+k+" i= "+i);                                     

        // r = JSON.stringify( [s, delim_l(a[i],' ',r) ] );
    }
    
}


function rpProc( s , c , p ) { // was delim_l, version 2018 May
    var r = 'r '; // old code, no var, reused other var r

    // alert("in delim_l p= "+p+" s= /"+s+"/ len="+s.length+" c="+c);

    var a = s.split(c);
    
    // alert("in delim_l p= "+p+" s= "+s+" c="+c+" a "+a+" length "+a.length);


    for (i in a) {                   
        r = r + ',' +i+' '+ a[i]+' ';                                     
    }

    alert("rpProc /"+a[i]+"/ "+a[i].length);
    
    // alert("rpProc /"+a[i]+"/ "+typeof eval("fgl_"+a[i]));
    
    if (a[i].length>0) if (typeof eval("fgl_"+a[i])==="function") eval("fgl_"+a[i]+"()");

    // 20170720 not looping to evaluate expression in pipe?

    // return r+' |_'+i+' ['+a.length+' '+rpx(a);
    // return r+' ['+a.length+' '+rpx(a, p );
    //return JSON.stringify([a,r+' ['+a.length+' ',rpx(a, p )]);

    // 20170720 how to add <: and >: for front end and back end processing?

    var t; // if (glf==1) alert('glf true');
    
    if (glf==1 && s.length>0) t=rpx(a, p );
    
    // alert(" in delim_l after t t= "+JSON.stringify(t)+" p= "+JSON.stringify(p));

    var u=[a,t];

//    alert(" in delim_l after t t= "+JSON.stringify(t)+" [a,t]= "+JSON.stringify(u));

    return JSON.stringify(u); 

    // return JSON.stringify([a,rpx(a, p )]); // p is json string of all past results
    // return function (L) as additional member together with existing rpx results
}



function delim( s , c ) {

    var r = 'r ';

    var a = s.split(c);

    for (i in a) {                   
        r = r + ','+i+' ' + a[i];                                     
    }
    return r;
}

function splitloop_po( s ) // split string by :, po: post processing
{
    var r = '[ '; // need bracket for json string
    // r=s+'; ';
    // return s;

    // alert('splitloop 0 '+s);
    
    // s=s.replace('：',':'); // javascript string are immutable!! hence needs reassigment!!
    s=s.replace(/\uff1a/g,':');

    alert('splitloop_po '+s);

    var a = s.split(":");
//    a = s.split("\u003a"); // ASCII colon
//    a = s.split("\ufe55"); // multibyte colon
    // a = s.split("\uff1a"); // multibyte colon from JavaScript console uniChar = x.charCodeAt(0).toString(16);
    
    // alert('splitloop 1 '+JSON.stringify(a));

    var j=['']; // init array cannot be null
    
    var k;

    // alert('splitloop 2 '+'a.length='+a.length);
    // for (i in a) {
    var i; // Must declare with var!! else unknown initialization!!
    for (i=0; i < a.length; i++) {

        //document.getElementById("updateAvailable_" + a[i]).style.visibility
                                             // = "visible";
        alert("in splitloop_po r= "+r+" a[i]= /"+a[i]+"/ i= "+i);                                     
        // r = r + ' :_' +i+' '+ delim_l(a[i],' ',r);    
        // j[i]=delim_l(a[i],' ',r); // r has all past results, so just need to parse.
        
        // k=delim_l(a[i],' ',r); // r has all past results, so just need to parse.
        k=rpProc(a[i],' ',r); // 2018 May
        j[i]=k;
        r = r + j[i] +',';  // 20170720 loop is here, how to modify?
//        alert("in splitloop after r= "+r+" k= "+k+" i= "+i);                                     

        // r = JSON.stringify( [s, delim_l(a[i],' ',r) ] );
    }
    
    // alert('splitloop 3 '+JSON.stringify(j));
    
    return JSON.stringify( [s,j] );
}

var SL=[]; // loop stack, for loops or recursion?

function splitloop( s ) // split string by :
{
    var r = '[ '; // need bracket for json string
    // r=s+'; ';
    // return s;

     // alert('splitloop while '+s);
    alert(s+' '+s.length);
    s=s.replace(/\s+/g, ' '); // replace multiple spaces with single space
        alert(s+' '+s.length);
    // s=s.replace('：',':'); // javascript string are immutable!! hence needs reassigment!!
    s=s.replace(/\uff1a/g,':');

    // alert('splitloop replace '+s);
    
    S.push('start');
    S.push(S.length);

    // s=s.trim();
    S.push(s);
    var a = s.split(":"); // all commands are pushed on to stack?
    
    S.push(a); // array of all commands are pushed on to stack
    // when is individual command and arguments pushed on to stack?
    
    
//    a = s.split("\u003a"); // ASCII colon
//    a = s.split("\ufe55"); // multibyte colon
    // a = s.split("\uff1a"); // multibyte colon from JavaScript console uniChar = x.charCodeAt(0).toString(16);
    
    // alert('splitloop 1 '+JSON.stringify(a));

    var j=['']; // init array cannot be null
    
    var k;

    // alert('splitloop 2 '+'a.length='+a.length);
    // for (i in a) {
    var i; // Must declare with var!! else unknown initialization!!
    // for (i=0; i < a.length; i++) {
    
    i=0; SL[0]=i; // outermost loop counter
    while (i < a.length && (a[i].length>0)) { // split on : produce zero length string at the end
        // S.push(i); // current command index

        //document.getElementById("updateAvailable_" + a[i]).style.visibility
                                             // = "visible";
        // alert("in splitloop before delim_l r= "+r+" a[i]= "+a[i]+" i= "+i);                                     
        // r = r + ' :_' +i+' '+ delim_l(a[i],' ',r);    
        // j[i]=delim_l(a[i],' ',r); // r has all past results, so just need to parse.
        k=delim_l(a[i],' ',r); // r has all past results, so just need to parse.
        j[i]=k;
        r = r + j[i] +',';  // 20170720 loop is here, how to modify?
       // alert("in splitloop after a= "+a+" a[i]=/"+a[i]+"/ a[i].length="+a[i].length+" i= "+i+" a.length="+a.length);                                     
        
        i = ++SL[0];
        // i = SL[0]++; // i=SL[0]; then SL[0]++!!
        // r = JSON.stringify( [s, delim_l(a[i],' ',r) ] );
    }

    // S.pop(); // pop command index, as SL[0]++ did not pop it?
    
    // alert('splitloop 3 '+JSON.stringify(j));
    
    return JSON.stringify( [s,j] );
}

function splitloop_for( s ) // split string by :
{
    var r = '[ '; // need bracket for json string
    // r=s+'; ';
    // return s;

    // alert('splitloop 0 '+s);
    
    // s=s.replace('：',':'); // javascript string are immutable!! hence needs reassigment!!
    s=s.replace(/\uff1a/g,':');

    // alert('splitloop replace '+s);
    
    S.push('start');
    S.push(S.length);

    // s=s.trim();
    S.push(s);
    var a = s.split(":");
    
    S.push(a);
//    a = s.split("\u003a"); // ASCII colon
//    a = s.split("\ufe55"); // multibyte colon
    // a = s.split("\uff1a"); // multibyte colon from JavaScript console uniChar = x.charCodeAt(0).toString(16);
    
    // alert('splitloop 1 '+JSON.stringify(a));

    var j=['']; // init array cannot be null
    
    var k;

    // alert('splitloop 2 '+'a.length='+a.length);
    // for (i in a) {
    var i; // Must declare with var!! else unknown initialization!!
    for (i=0; i < a.length; i++) {
    
        S.push(i);

        //document.getElementById("updateAvailable_" + a[i]).style.visibility
                                             // = "visible";
        // alert("in splitloop r= "+r+" a[i]= "+a[i]+" i= "+i);                                     
        // r = r + ' :_' +i+' '+ delim_l(a[i],' ',r);    
        // j[i]=delim_l(a[i],' ',r); // r has all past results, so just need to parse.
        k=delim_l(a[i],' ',r); // r has all past results, so just need to parse.
        j[i]=k;
        r = r + j[i] +',';  // 20170720 loop is here, how to modify?
//        alert("in splitloop after r= "+r+" k= "+k+" i= "+i);                                     

        // r = JSON.stringify( [s, delim_l(a[i],' ',r) ] );
    }
    
    // alert('splitloop 3 '+JSON.stringify(j));
    
    return JSON.stringify( [s,j] );
}




let rpn = (ts, s = []) => {

ts.split(' ').forEach(t => s.push(t == +t ? t : eval(s.splice(-2,1)[0] + t + s.pop()))); return s[0]; }

let rpns = (ts, s = []) => { 

var q=' x ';

ts.split(' ').forEach(

t =>  s.push(t == +t ? t : 
 
  eval(
  s.splice(-2,1)[0] + t + s.pop()
  )
  )
  )
  // {q=q+t+' ';}
  ;
 
  return s[0]+q; 
}

function fgl_nxhr()
{
return new XMLHttpRequest();

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

function fgl_postproc() {
            if (this.readyState == 4 && this.status == 200) {  
                document.getElementById("rpout").textContent = this.responseText;
                
                alert("889: postProc_g()");
                postProc_g(this.responseText);
    }
        }

function fgl_xorsc()
{

var a=S.pop();
var xmlhttp=end(S);
xmlhttp.onreadystatechange = a;


}


function showHint(str) {

    str = document.getElementById("rpbox").value;
    
    // alert(str.indexOf('s:') + ' = s: position' );
    
    str1 = splitloop(str);
    alert(str1);
    
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
    
    // new 5gl command to create new variable?
        var xmlhttp = new XMLHttpRequest();
        
        
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // document.getElementById( "rpout").innerHTML = this.responseText;
                
                // 20170710           
                // document.getElementById("rpout").textContent = this.responseText;       
                document.getElementById("rpout").textContent = this.responseText;
                
                // postProc(this.responseText);
                alert("889: postProc_g()");
                postProc_g(this.responseText);
    }
        };
        // xmlhttp.open("GET", "gethint.php?q=" + str, true);
        // xmlhttp.send();

        // nxhr: 'uui.php' xo:
        xmlhttp.open("POST", "uui.php", true);
        xmlhttp.setRequestHeader( "Content-type", "application/json");
        
        // xmlhttp.setRequestHeader( "Content-type", "application/x-www-form-urlencoded");
        id="rpbox";
        xmlhttp.send( str1);
        
    }
}

function preProc(str) {

    // str = document.getElementById("rpbox").value;

    // 20170828    
        // alert(str.indexOf('s:') + ' = s: position' );
        
    // 20180610 input str, output str1: json stringify stack, send to back end
    S.push(str); fgl_xs();
    str1 = JSON.stringify(S.pop());
    // str1 = splitloop(str);
    alert('preProc '+str1); 
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
        xmlhttp.open("POST", "d.php", true);
        xmlhttp.setRequestHeader( "Content-type", "application/json");
        
        // xmlhttp.setRequestHeader( "Content-type", "application/x-www-form-urlencoded");
        id="rpbox";
        xmlhttp.send( str1);
        
    }
}

var rp_t, rp_s;

function postProc(s)
{

glf=1;
var s0=s;
var t=s.split('_:');
var ta=t[1].split('<:');

rp_s=s;

alert("postProc "+s);

// alert(JSON.stringify(ta[1]+t[3].substr(34,1092)));

// var tf=t[3].substr(34,1092);
var tf=t[3]; // eval innterHTML

// alert(JSON.stringify(ta[1]+t[3]));

// r.replace(/\\/g,'')
// var te=tf.replace(/\\/g,'');

rp_t=tf;

var te = JSON.parse(tf);

var tl=te.length;

//te = te.replace(/\"/g,'');

// te = te.substr(2,tl-3);

// alert(JSON.stringify('in postProc '+tl+' '+ta[1]+te));

alert(JSON.stringify('in postProc eval: '+te));

eval(te);

return 0;

}

function postProc_g(s)
{

// 20180610 need to send stack (complete stack, data and commands) from FE to BE, and from BE to FE. 
// json encode stack, commands on stack.

// 20180611 fron end has local stack, which should have all commands and program counter? Compare with stack sent by back-end?

glf=1; // glf=0 on >: call rpx ??
var s0=s;

S.push(s);
alert("postProc_g 986 < "+s+" > 986");

return 0;

var t=s.split('_:');
var ta=t[1].split('<:');

rp_s=s;

if (t[3].length<1 || t[3].substr(1,4)=="null") return 0;

alert("postProc "+s+" t[3].length "+t[3].length+" "+t[3].substr(1,4));

// alert(JSON.stringify(ta[1]+t[3].substr(34,1092)));

// var tf=t[3].substr(34,1092);
var tf=t[3]; // eval innterHTML

// alert(JSON.stringify(ta[1]+t[3]));

// r.replace(/\\/g,'')
// var te=tf.replace(/\\/g,'');

rp_t=tf;

var te = JSON.parse(tf);


// 20180512 push te to global stack S
S.push(te);

splitloop_po(ta[1]);

var tl=te.length;

//te = te.replace(/\"/g,'');

// te = te.substr(2,tl-3);

// alert(JSON.stringify('in postProc '+tl+' '+ta[1]+te));

alert(JSON.stringify('in postProc_g eval: '+te));

// eval(te);

return 0;

}



function readid(id){
    "use strict";   
    console.log("id=", id)
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "view.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 || this.status === 200){ 
            console.log(this.responseText); // echo from php
        }       
    };

    var str=document.getElementsByTagName("html")[0].outerHTML;

    alert(str);
    xmlhttp.send("id=" + id + " " + str);
}

function myFunction() {
    var x = document.getElementById("myTextarea").value;
    document.getElementById("demo").innerHTML = x;
}


// 2018 07 01 rpmlFunction() calls fgl_xs()
function rpmlFunction() {
    var x = document.getElementById("rpbox").value;
    
    // 2018 06 30 push x to global stack S
    S.push(x);
    // fgl_xs();
    alert("in rpmlFunction: "+S);
    
    
        if (1) {
    
    // 20180512 commented out
    //     document.getElementById("rpout").innerHTML = x;
    
    var a = x.split("///begin ");
    // var za = x.split('///始 ');
    
    // alert('test unicode \u59CB ' + "test unicode \u59CB ");
    
    var za = x.split('///\u59CB ');

    // alert('///始 1 '+JSON.stringify(za));    
    
    // alert('///begin 1 '+JSON.stringify(a));

/*
    if (a[1]) { a = a[1].split("///end ");
    
    alert('///end 1 '+JSON.stringify(a));

    NFS=a; x=a[1];
    }
    else x=a[0];
*/    
    if (za[1]) { 
    
    // za = za[1].split("///终 ");
    za = za[1].split("///\u7ec8 ");
    
    // alert('zhong ///终 1 \u7ec8 '+JSON.stringify(za));

    NFS=za; x=za[1];
    }
    else x=za[0];
    
    
    // alert('x is '+x+ ' NFS[0] '+NFS[0]);
    
    preProc(x);
    // showHint(x);
    // alert(splitloop(x));
    }
}

// rpmlFunction() before fgl_xs() 2018 06 30
function rpmlFunction_0630() {
    var x = document.getElementById("rpbox").value;
    
    // 2018 06 30 push x to global stack S
    S.push(x);
    
    // 20180512 commented out
    //     document.getElementById("rpout").innerHTML = x;
    
    var a = x.split("///begin ");
    // var za = x.split('///始 ');
    
    // alert('test unicode \u59CB ' + "test unicode \u59CB ");
    
    var za = x.split('///\u59CB ');

    // alert('///始 1 '+JSON.stringify(za));    
    
    // alert('///begin 1 '+JSON.stringify(a));

/*
    if (a[1]) { a = a[1].split("///end ");
    
    alert('///end 1 '+JSON.stringify(a));

    NFS=a; x=a[1];
    }
    else x=a[0];
*/    
    if (za[1]) { 
    
    // za = za[1].split("///终 ");
    za = za[1].split("///\u7ec8 ");
    
    // alert('zhong ///终 1 \u7ec8 '+JSON.stringify(za));

    NFS=za; x=za[1];
    }
    else x=za[0];
    
    
    // alert('x is '+x+ ' NFS[0] '+NFS[0]);
    
    preProc(x);
    // showHint(x);
    // alert(splitloop(x));
}


function rpnFunction() {
    var x = document.getElementById("rpbox").value;
    document.getElementById("rpout").innerHTML = x;
    
    alert(rpn(x));
    
    document.getElementById("rpout").innerHTML = x + ' = ' + rpn(x);
    // showHint(x);
    // alert(splitloop(x));
}


