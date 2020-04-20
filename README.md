# Phoom
Phoom VR AR

Some people may relate Phoom to other projects with name suffixed by -oom. The name Phoom is derived from [Phos Metashellet](https://github.com/udexon/Metashellet), one of the core components of Phoom, and the impression of power of the suffix -oom. Read on the see how we transcend the predecessors.

We believe we are blazing a trail that is inevitable in the evolution of computing technology &mdash; not only combining image processing and virtual (augmented) reality (and of course, artificial intelligence) &mdash; but also synergizing free and open source software development, social networks, shared economies and start-up business.

- Imagine an app that extracts the face or body of someone dancing, merging the dancing bodies of a dozen or several dozens other dancers at different locations, projected into an augmented reality, letting all participants to participate in an AR dance pool &mdash; much like a Zoom session, but in 3D AR.

- Imagine, instead of seeing half a dozen of your colleagues in six split screens, now they are seated in a virtual boardroom at a round table, in vivid 3D views.

That is the vision of Phoom.

- A. https://github.com/huningxin
- https://codepen.io/huningxin/pen/wqBvRo

- B. https://www.learnopencv.com/simple-background-estimation-in-videos-using-opencv-c-python/

- C. https://github.com/udexon/XIDT/blob/master/XIDWeb_ID_less_Web.md

- D. https://github.com/udexon/Metashellet

Projects A and B above are two impressive open source OpenCV examples. They represent the kind of projects that give us the confidence to challenge Zoom and which we can use as our building blocks.

However, with projects A and B alone, we cannot overcome the conventional obstacles facing isolated individual programmers in  free software development, resulting in the widening gaps in achievements between teams funded by billion, nay, trillion dollars corporations and teams made up of isolated individual programmers. We can write pages after pages to theoretically analyze this problem, but it will be more productive if we just demonstrate by examples how we can do it with projects C & D.

As a first step, we will show that using Metashellet, we can simplify the OpenCV coding in projects A and B into something no more complicated than bash script, but more powerful. This should enable more interested programmers to participate while learning simultaneously. More specifically, we will show how to port the C++ functions in project B into JavaScript in project A, using Phos script. In the end, we will have a JavaScript demo web page that can capture your face but filter out the background.

The next obstacle that we will address concerns user login. This has always been a chicken and egg problem for any new start-up project &mdash; How to secure sufficient number of users, which in turn generate sufficient revenues to sustain the project? XidWeb (ID-less Web) is a departure from conventional Unix style user ID system where every user is required to register before starting to use the system, thus becoming the biggest hassle that puts off user adoption. Instead, XidWeb employs a fundamental mechanism similar to Bitcoin and other cryptocurrencies, where user authentication is performed based on public key cryptography. 
