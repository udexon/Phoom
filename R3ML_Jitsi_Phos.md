# R3ML Jitsi Phos: 50 Years of Computer Programming

The screenshots (Figure 1 and figure 2) below comprises practices in computer programming than span over half a century, from the Forth programming language in 1968, to the latest React Redux Jitsi Meet video conferencing app written in JavaScript.

- Figure 1

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Phos/Jitsi_Phos_cmd.png" width=600>

- Figure 2

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Phos/Jitsi_Phos_S.png" width=600>

We do not do this to show off programming acrobatics. We believe the Reverse Polish Notation / Stack Machine as immortalized by Forth is the best way to flatten the learning curves which have been steepened by decades of ___unnecessary complications___ in programming languages perhaps more plentiful than virus species as well as run away frameworks as clueless as flies over corpses. 

We begin our explanation with the following code added to lines 3 to 6 in  `conference.js` in the top directory of `jitsi-meet` repository:

```js
import Phos from "./phos/phos.js";

window.S = []
window.S.push(new Phos())
```

Figure 3 below shows the location of the code above in the file `conference.js` viewed in `gedit`.

- Figure 3

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Phos/conference_js.png" width=600>

The Phos stack machine shell ("smashlet") was originally published in the following web page:

- http://phos.epizy.com/smashlet/

- JavaScript library: http://phos.epizy.com/smashlet/pdo/fgl.js

It consist of a simplified stack machine (compared to Forth) which performs the following:
- pushes non-function words (tokens) on to the stack;
- execute function words and pushes the results on to the stack.

It was initially implemented in PHP just as an experiment to see how easy it is to implement a simplified stack machine. Eventually, we realized that this simplified stack machine (which we eventually call "smashlet") can in fact be implemented in ___any known programming language___.

Besides Forth implementation in other programming languages (from C/C++ to Lisp, JavaScript, Java, Rust, Haskell etc.) which we too classify as smashlet, we ourselves have implemented smashlet in:

- C, C++, PHP, Python, Java, JavaScript
- Using Laravel Blade PHP, we succeeded in creating a Reverse Polish form of HTML!!

Porting Phos to React Redux, we have decided to call it R3ML &mdash; Reverse Polish React Redux Meta Language, where R3 is also a tribute certain robots in Star Wars.


