# _Phoom_
- _Like Zoom, But Augmented &mdash; 3D AR VR_
- A Free and Open Source collaborative AR VR project using Cloudless and ID-less Computing

Some people may relate Phoom to other projects with name suffixed by -oom. The name Phoom is derived from [Phos Metashellet](https://github.com/udexon/Metashellet), one of the core components of Phoom, and the impression of power of the suffix -oom. Read on the see how we transcend the predecessors.

We believe we are blazing a trail that is inevitable in the evolution of computing technology &mdash; not only combining image processing and virtual (augmented) reality (and of course, artificial intelligence) &mdash; but also synergizing free and open source software development, social networks, shared economies and start-up business.

- Imagine an app that extracts the face or body of someone dancing, merging the dancing bodies of a dozen or several dozens other dancers at different locations, projected into an augmented reality, letting all participants to participate in an AR dance pool &mdash; much like a Zoom session, but in 3D AR.

- Imagine, instead of seeing half a dozen of your colleagues in six split screens, now they are seated in a virtual boardroom at a round table, in vivid 3D views.

That is the vision of Phoom.


#### Phoom Building Blocks:

- A. Browser OpenCV Camera Demo
  - A1. [WebSight](https://david.blob.core.windows.net/idt2019/wasm/index-video.html)
  - A2. [Hu Ningxin](https://github.com/huningxin)'s [Codepen Browser OpenCV Camera Demo](https://codepen.io/huningxin/pen/wqBvRo); [Other Codepen Pens (Projects)](https://codepen.io/huningxin/pens/public?grid_type=list)

- B. Satya Mallick's OpenCV Tutorial 
  - https://www.learnopencv.com/simple-background-estimation-in-videos-using-opencv-c-python/
  - https://github.com/spmallick/learnopencv
  
- C. XidWeb (ID-less Web)
  - https://github.com/udexon/XIDT/blob/master/XIDWeb_ID_less_Web.md

- D. Phos MetaShellet 
  - https://github.com/udexon/Metashellet
  - https://github.com/udexon/waforth

Projects A and B above are two impressive open source OpenCV examples. They represent the kind of projects that give us the confidence to challenge Zoom and which we can use as our building blocks.

However, with projects A and B alone, we cannot overcome the conventional obstacles facing isolated individual programmers in  free software development, resulting in the widening gaps in achievements between teams funded by billion, nay, trillion dollars corporations and teams made up of isolated individual programmers. We can write pages after pages to theoretically analyze this problem, but it will be more productive if we just demonstrate by examples how we can do it with projects C & D.

As a first step, we will show that using Metashellet, we can simplify the OpenCV coding in projects A and B into something [_no more complicated than bash script, but more powerful_](https://github.com/udexon/Phoom/blob/master/Now_Everyone_Can_OpenCV.md). This should enable more interested programmers to participate while learning simultaneously. More specifically, we will show how to port the C++ functions in project B into JavaScript in project A, using Phos script. In the end, we will have a JavaScript demo web page that can capture your face but filter out the background.

- [_Now Everyone can "OpenCV"_](https://github.com/udexon/Phoom/blob/master/Now_Everyone_Can_OpenCV.md)

The next obstacle that we will address concerns user login. This has always been a chicken and egg problem for any new start-up project &mdash; How to secure sufficient number of users, which in turn generate sufficient revenues to sustain the project? XidWeb (ID-less Web) is a departure from conventional Unix style user ID system where every user is required to register before starting to use the system, thus becoming the biggest hassle that puts off user adoption. Instead, XidWeb employs a fundamental mechanism similar to Bitcoin and other cryptocurrencies, where user authentication is performed based on public key cryptography. 

A more immediate and relevant benefit to participating developers is the ability to set up our own _Cloudless Computing_ facilities:

- code can be shared amongst programmers and projects _LIVE_ down to _ONE WORD AT A TIME_ where "word" is the term for "function name" used in Phos and Forth (programming languages), in contrast to repositories like GitHub, where the code is essentially _dead_, i.e. they are not immediately executable, need to be downloaded, set up, installed etc. before being run.

- the code and projects can be stored on physical mobile devices or desktop computers owned by individual programmers, thus departing from the _Cloud Computing_ paradigm, hence the name _Cloudless Computing_.



### Work in Progress

1. We have forked Hu Ningxin's OpenCV WebAssembly demo from CodePen and uploaded to:
- https://github.com/udexon/Phoom/tree/master/opencv-js-video-processing-webassembly

2. We have modified `index.html` to add a buffer canvas (`id="cvs"`) below the camera / video processing output canvas (`id="canvasOutput"`). 

<img src="https://github.com/udexon/Phoom/blob/master/room.png" width=600>

We have also created a new function `procvid( alg )` based on the original `processVideo()` so that we can enter the command `procvid( alg )` in the browser console where `alg` is the choice of algorithms (listed in `script.js`), which takes a snapshot from the video stream, and process it with OpenCV functions (stored in `cv` object).

The screenshot above shows the output of `procvid('canny')` in the bottom canvas (`id="cvs"`).

3. We can now build up our background subtraction algorithm using this code base.

4. You can just download the code from the directory above and unpack it in a path accessible by http server to run it. No additonal set up is required.


### Future Work

1. Phoom Initialization: Use hands to trace out head and body outline &mdash; _Namaste_ over head!!
  - Tilt head together with shoulders sideways (left, right) to trace out head and body outline
  - Remove background
  
2. Make prototypes in Browser OpenCV (JS or WASM) first. Then port Phos OpenCV C++ (together with SymEngine?) to Android JNI. 





