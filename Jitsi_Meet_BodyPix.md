## Extracting Human Faces and Bodies from Jitsi-Meet as Avatars in Augmented Reality Conferencing App

As decribed in the following GitHub issue:

- https://github.com/jitsi/jitsi-meet/issues/5269#issuecomment-622661995

- TLDR: The Tensor Flow (TFJS) Body Pix algorithm is already included in Jitsi-Meet.

1. The file and function that need to be modified are:

- https://github.com/jitsi/jitsi-meet/blob/master/react/features/stream-effects/blur/JitsiStreamBlurEffect.js

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Meet_Mod/code_png/Blur_Orig.png" width=600>

Output before modifications:

- Figure 1: No Background Blurring

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Meet_Mod/test_views/No_Blur.png" width=600>


- Figure 2: Menu to turn on Background Blurring

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Meet_Mod/test_views/JM_Menu.png" width=600>


- Figure 3: Turn On Background Blurring

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Meet_Mod/test_views/Blur_Bokeh.png" width=600>


2. TFJS BodyPix Mask function (lines 634 to 647):

- https://github.com/tensorflow/tfjs-models/tree/master/body-pix

- https://github.com/tensorflow/tfjs-models/blob/master/body-pix/demos/index.js

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Meet_Mod/code_png/tfjs_mask.png" width=600>



3. Transplanting TFJS BodyPix Mask to `JitsiStreamBlurEffect.js`:

- https://github.com/udexon/Phoom/blob/master/Jitsi_Meet_Mod/blur/JitsiStreamBlurEffect.js

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Meet_Mod/code_png/Blur_Orig.png" width=600>

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Meet_Mod/test_views/No_Blur.png" width=600>

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Meet_Mod/test_views/Blur_Bokeh.png" width=600>


<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Meet_Mod/code_png/Blur_if_Bokeh.png" width=600>

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Meet_Mod/code_png/Blur_else_Mask.png" width=600>

<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Meet_Mod/test_views/Mask.png" width=600>
