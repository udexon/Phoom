# &middot; &middot; &middot; _Now Everyone can "OpenCV"_ &middot; &middot; &middot;

In this article, we shall demonstrate how to simplify [Hu Ningxin OpenCV WebAssembly video processing demo](https://codepen.io/huningxin/pen/NvjdeN) into Forth like Reverse Polish Notation scripts as follow:

```js
A: F("src: show:")

B: F("src: gray: show:")

C: F("src: gray: blur: show:")
```

The _words_ (a Forth termininology) `src: gray: blur: show:` are mapped the following JavaScript functions respectively in https://github.com/udexon/Phoom/blob/master/Phoom_OpenCV/dist/phos/phoom.js:

```js
fgl_src()
fgl_gray()
fgl_blur()
fgl_show()
```

`F()` is a stack machine shell (_"smashlet"_ or _"metashellet"_, [code definition here](https://github.com/udexon/Phoom/blob/master/Phoom_OpenCV/dist/phos/fgl.js)) that performs the following:
- pushes non-function words on to the stack;
- maps function words (suffixed by colon `':'`) to JavaScript functions `fgl_*()`, executes the target function, and pushes the result(s) on to the stack.

We have forked Hu Ningxin's demo and upload to:

https://github.com/udexon/Phoom/tree/master/Phoom_OpenCV

You can just unpack it in any directory accessible to a http server and run it, without any additional installation.

https://github.com/udexon/Phoom/blob/master/Phoom_OpenCV/dist/index.html

In the screenshot below, the browser running the Phoom demo is on the left hand side, and a VLC playing a video is on the right hand side. A webcam is pointing to the computer screen and the camera feed is shown at the upper left canvas on the webpage (`id="canvasOutput"`). The bottom left canvas on the webpage is used for Phoom script output.

As such you can see the outputs of script A, B and C at the bottom left corners in figures 1A, 1B and 1C respectively

- Figure 1A

<img src="https://github.com/udexon/Phoom/blob/master/opencv_js_wasm/Phoom_src.png" width=600>

- Figure 1B

<img src="https://github.com/udexon/Phoom/blob/master/opencv_js_wasm/Phoom_gray.png" width=600>

- Figure 1C

<img src="https://github.com/udexon/Phoom/blob/master/opencv_js_wasm/Phoom_blur.png" width=600>

Figures 2A, 2B and 2C show the cropped and enlarged bottom left canvas from figures 1A, 1B and 1C respectively.

- Figure 2A

<img src="https://github.com/udexon/Phoom/blob/master/opencv_js_wasm/large_src.png" width=600>

- Figure 2B

<img src="https://github.com/udexon/Phoom/blob/master/opencv_js_wasm/large_gray.png" width=600>

- Figure 2C

<img src="https://github.com/udexon/Phoom/blob/master/opencv_js_wasm/large_blur.png" width=600>

Figures 3A, 3B and 3C show how the scripts A, B and C are entered in the browser console, in order to execute the required OpenCV JavaScript (WebAssembly) functions.

- Figure 3A

<img src="https://github.com/udexon/Phoom/blob/master/opencv_js_wasm/cmd_src.png" width=600>

- Figure 3B

<img src="https://github.com/udexon/Phoom/blob/master/opencv_js_wasm/cmd_gray.png" width=600>

- Figure 3C

<img src="https://github.com/udexon/Phoom/blob/master/opencv_js_wasm/cmd_blur.png" width=600>
