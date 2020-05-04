# R3ML Jitsi Phoom: 50 Years of Computer Programming

The screenshots (figure 1 and figure 2) below comprise practices in computer programming than span over half a century, from the Forth programming language in 1968, to the latest React Redux Jitsi Meet video conferencing app written in JavaScript.

- Figure 1

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Phos/Jitsi_Phos_cmd.png" width=600>

- Figure 2

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Phos/Jitsi_Phos_S.png" width=600>

_We do not do this to show off programming acrobatics._

We believe the Reverse Polish Notation / Stack Machine, as immortalized by Forth, is the best way to flatten the learning curves which have been steepened by decades of ___unnecessary complications___ in programming languages perhaps more plentiful than virus species as well as run away frameworks as clueless as flies over corpses. 

We begin our explanation with the following code added to lines 3 to 6 in  `conference.js` in the top directory of `jitsi-meet` repository:

```js
import Phos from "./phos/phos.js";

window.S = []
window.S.push(new Phos())
```

Figure 3 below shows the location of the code above in the file `conference.js` viewed in `gedit`.

- Figure 3

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Phos/conference_js.png" width=450>

The Phos stack machine shell ("smashlet") was originally published in the following web page:

- http://phos.epizy.com/smashlet/

- JavaScript library: http://phos.epizy.com/smashlet/pdo/fgl.js

It consists of a simplified stack machine (compared to Forth) which performs the following:
- pushes non-function words (tokens) on to the stack;
- executes function words and pushes the results on to the stack.

It was initially implemented in PHP as an experiment to see how easy it is to implement a simplified stack machine. Eventually, we realized that this simplified stack machine (which we eventually call "smashlet") can in fact be implemented in ___any known programming language___ _with the equivalent of around 50 lines of JavaScript or PHP code_, thus making the Forth like script (hence _"Phos"_) a likely candidate to be a ___universal scripting language___.

Besides Forth implementations in other programming languages (from C/C++ to Lisp, JavaScript, Java, Rust, Haskell etc.) developed by other programmers, which we too classify as smashlet, we ourselves have implemented smashlet in:

- C, C++, PHP, Python, Java, JavaScript &mdash; on desktop Linux and Android (Java and NDK)
- Using Laravel Blade PHP, we succeeded in creating a Reverse Polish form of HTML!! &mdash; _a breakthrough perhaps as significant as the invention of HTML itself??_
- An attempt to implement raw Forth within Firefox JavaScript engine as a ___compatible___ alternative to WebAssembly

Porting Phos to React Redux, we have decided to call it &mdash; ___R3ML: Reverse Polish React Redux Meta Language___ &mdash; where R3 is also a tribute to certain robots in _Star Wars_.

While it will take a few more days to clean up R3ML `phos.js` before we upload it to our own `jitsi-meet` fork, impatient readers are urged to investigate the JavaScript source code given in the link about. While we have not included a license yet, we implicitly use the _JFKA_ license (i.e. _Just F&ast;King Ask_).

After the long winded but perhaps necessary introduction above, let's get back to detailed explanations of R3ML and the screenshots above.

The code in figure 3 basically imports the `Phos` class into `conference.js`, which we believe to be the main entry point of `jitsi-meet`. Immediately, we create a `Phos` object with `new Phos()` and push it on to the global stack `S`.

The objects on `S` can be examined by entering `S` in the browser console, as shown in figure 2.

In figure 1, we evaluate the expression `"34 + 66"`, in reverse polish notation `"34 66 +"`, by calling `S[0].F()` where the bottom most item (first item) on the stack is a `Phos()` object:

- `S[0].F("34 66 +")`

The result `100` is placed on top of the stack (last item of a JavaScript array) as shown in figure 2.


## Why R3ML?

As decribed in the following GitHub issue:

- https://github.com/jitsi/jitsi-meet/issues/5269#issuecomment-622661995

- TLDR: The Tensor Flow (TFJS) Body Pix algorithm is already included in Jitsi-Meet.

As such, we may ask:

- Why hasn't anyone use TFJS Body Pix to extract the human body as avatar, to be used in an Augmented Reality conferencing app?

We suspect there are three primary reasons:

1. The good old learning curve to pick up a new framework / programming language (JavaScript React Redux).

2. Lack of a powerful live debugging system like Forth for new programmers to debug and learn the internal workings of Jitsi.

3. Both reasons above contribute to lack of documentation and manpower to prepare documentation, which lead to a positive feedback in difficulties in getting more developers.

Hence we hope R3ML will overcome these problems, perhaps enable thousands more developers to join our effort &mdash; ___Phoom: an augmented reality conferencing app___. 

The 3 problems mentioned above are not unique to Jitsi. They are perhaps generic to many other free software / open source projects.

- Why do we need that many developers for AR conferencing?

__We believe this is the beginning of a new era of computing:__

- _If the 2010 decade is defined by iPhone and Android mobile devices, then_ ___2020s should be the era of Virtual Reality &mdash; 3D VR AR___, _with opreating systems and devices that transcend the old, but the programming language has to be_ ___powerful___ _like Forth and yet_ ___easy to learn___ _like the Turtle graphics Logo programming language._

Hence ___Phoom R3ML___.

- Footnote: in figures 1 and 2, the camera is actually pointing at the monitor showing the browser console. _Can the program understand what it is seeing?_ We hope this will be a small step towards _Star Trek_ or _Star Wars_ &mdash; where Reverse Polish Notation opens up _homoiconic metaprogramming_, very likely the last mile towards achieving human level artificial intelligence. _But then that belongs to another article at another time._
