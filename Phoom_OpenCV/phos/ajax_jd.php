<?php

include("simple_html_dom.php");
include("pdo/libfgl.php");
include("pdo/libuui.php");
include("pdo/libssl.php");


$CDW=array();
$S=array();

// colon defined words
FGL(": chtag childNodes mthd: cx: dup:   A l:   dup: 2over:   swap: -  space: ec:  dup: esp:  4 ixn: tag mbr: esp:   1 -    A bnz: ;"); // input is object, vs. atag input is array of objects

F(": chn childNodes mthd: ;");

FGL(": atag cx: dup:   A l:   dup: 2over:   swap: -  dup: esp:  4 ixn: tag mbr: esp:  space: ec:  1 -    A bnz: ;"); // print tags of array of objects

FGL(": aot cx: dup:   A l:   dup: 2over:   swap: -  nl: dup: esp:  4 ixn: outertext mbr: esp:  space: ec:  1 -    A bnz: ;");

F(": add + ;");

if (isset($argv[1])) {
    $S[] = $argv;
} else {
    // $S[]="uui.php";
    $S[] = file_get_contents('php://input');
    // F("jd: space: explode: s:");
    F("jd: space: explode:");
}

// F("s: 1 i: s: je: s: jd: s:"); // CLI
// F("s: je: s: jd: s:");
// F("s: je: s: jd: s: jd: s:"); // ajax
// F("s: 1 i: s:");

// 2020-04-19 no json data before Phos commands
FGLA($S[0]);
