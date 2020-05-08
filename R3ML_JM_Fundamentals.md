<img src="https://github.com/udexon/Phoom/blob/master/Jitsi_Phos/JM_APP_store_getState.png" width=600>


Update 3 (8 May 2020)

https://github.com/udexon/Phoom/blob/master/R3ML_JM_Fundamentals.md

After several days (much longer than I initially estimated) combing through Jitsi-Meet code, without any help from anyone whatsoever, I found this command:

```js
APP.store.getState()['features/base/tracks']
```

So Jitsi-Meet allows lots of internal variables to be access globally (via the console or otherwise) through the variable `APP`.

Next step:

https://github.com/jitsi/jitsi-meet/blob/master/react/features/stream-effects/blur/JitsiStreamBlurEffect.js

- Check the BodyPix algorithm accesses the above via wrapper functions.
