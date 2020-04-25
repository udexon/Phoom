c_sto = 3
t_sto = 1000

function Book (type, author) {
    this.type = type;
    this.author = author;
    this.getDetails = function () {
        return this.type + " written by " + this.author;
    }
}

function TimedFunc (t_sto, c_sto) {
    this.c = c_sto;
    this.t = t_sto;
//    this.f = f_sto;

    this.getDetails = function () {
        return this.type + " written by " + this.author;
    }

this.fcall  = function (f, c, t)
{
   // this.c--
   c--

   console.log( c )

   f.call()

   if ( c > 0 ) setTimeout(this.fcall, t, f, c, t)
}

}


/*
var book = new Book("Fiction", "Peter King");
alert(book.getDetails()); 
*/

function call_sto(f)
{
   c_sto--

   console.log(c_sto)

   f.call()

   if (c_sto>0) setTimeout(call_sto, t_sto, f)
}

function call_stol(f, c, t)
{
   c--

   console.log(c)

   f.call()

   if (c>0) setTimeout(call_stol, t, f, c, t)
}


function print_3()
{

   console.log('in print_3')

}

// res = cv.Mat.zeros(width, height, cv.CV_8U)

function frameDiff()
{
frame = src

if (typeof res === "undefined") res = cv.Mat.zeros( height, width, cv.CV_8U)

// res = o_gray
// res = firstFrame
cv.imshow("cvs", res);

cv.cvtColor(frame, o_gray, cv.COLOR_BGR2GRAY)
cv.GaussianBlur(o_gray, o_gray, {width: controls.gaussianBlurSize, height: controls.gaussianBlurSize}, 0, 0, cv.BORDER_DEFAULT);

if (typeof firstFrame === "undefined") firstFrame = o_gray

cv.absdiff(firstFrame, o_gray, frameDelta)

firstFrame = o_gray.clone()

// cv.threshold(dstC1, dstC4, 120, 200, cv.THRESH_BINARY);
cv.threshold(frameDelta, dstC4, 120, 200, cv.THRESH_BINARY);

// res = frameDelta
// res = frame
// res = dstC4
cv.bitwise_or(res, dstC4, res)
cv.imshow("cvs", res);
// setTimeout(call_2, 3000);
}

/*
res = cv.Mat.zeros( height, width, cv.CV_8U)
cv.imshow("cvs", res);
c_sto=40; call_sto(frameDiff)
*/


// 0423

function frameDiff_bg()
{
// if (typeof res === "undefined") res = cv.Mat.zeros( height, width, cv.CV_8U)

o_gray = new cv.Mat(height, width, cv.CV_8UC1);
frameDelta = new cv.Mat(height, width, cv.CV_8UC1);

frame=bg

cv.cvtColor(frame, o_gray, cv.COLOR_BGR2GRAY)
cv.GaussianBlur(o_gray, o_gray, {width: controls.gaussianBlurSize, height: controls.gaussianBlurSize}, 0, 0, cv.BORDER_DEFAULT);

if (typeof firstFrame === "undefined") firstFrame = o_gray.clone()


frame = src

if (typeof res === "undefined") res = cv.Mat.zeros( height, width, cv.CV_8U)

// res = o_gray
// res = firstFrame
cv.imshow("cvs", res);

cv.cvtColor(frame, o_gray, cv.COLOR_BGR2GRAY)
cv.GaussianBlur(o_gray, o_gray, {width: controls.gaussianBlurSize, height: controls.gaussianBlurSize}, 0, 0, cv.BORDER_DEFAULT);


cv.absdiff(firstFrame, o_gray, frameDelta)

firstFrame = o_gray.clone()

// cv.threshold(dstC1, dstC4, 120, 200, cv.THRESH_BINARY);
cv.threshold(frameDelta, dstC4, 120, 200, cv.THRESH_BINARY);

// res = frameDelta
// res = frame
// res = dstC4
cv.bitwise_or(res, dstC4, res)
cv.imshow("cvs", res);
// setTimeout(call_2, 3000);
}

// res must be global as it is used between functions. may need to create class object.
// res = cv.Mat.zeros( height, width, cv.CV_8U)
// c_sto=40; call_sto(frameDiff_bg)

function fgl_gray()
{
  o_gray=S.pop()
  cv.cvtColor(o_gray, o_gray, cv.COLOR_BGR2GRAY)
  S.push(o_gray)
}


function fgl_blur()
{
  o_gray=S.pop()
  cv.GaussianBlur(o_gray, o_gray, {width: controls.gaussianBlurSize, height: controls.gaussianBlurSize}, 0, 0, cv.BORDER_DEFAULT);
  S.push(o_gray)
}

function fgl_mat()
{
frameDelta = new cv.Mat(height, width, cv.CV_8UC1);
  S.push(frameDelta)
}

function fgl_src()
{
   S.push( src.clone() )
}

function fgl_show()
{
cv.imshow("cvs", S.pop() );
}

function SM_frameDiff_bg()
{
// if (typeof res === "undefined") res = cv.Mat.zeros( height, width, cv.CV_8U)

o_gray = new cv.Mat(height, width, cv.CV_8UC1);
frameDelta = new cv.Mat(height, width, cv.CV_8UC1);

frame=bg
S.push(bg)

cv.cvtColor(frame, o_gray, cv.COLOR_BGR2GRAY)
cv.cvtColor(S.pop(), o_gray, cv.COLOR_BGR2GRAY)
S.push(o_gray)

cv.GaussianBlur(S.pop(), o_gray, {width: controls.gaussianBlurSize, height: controls.gaussianBlurSize}, 0, 0, cv.BORDER_DEFAULT);
S.push(o_gray)

if (typeof firstFrame === "undefined") firstFrame = o_gray.clone()


frame = src

if (typeof res === "undefined") res = cv.Mat.zeros( height, width, cv.CV_8U)

// res = o_gray
// res = firstFrame
cv.imshow("cvs", res);

cv.cvtColor(frame, o_gray, cv.COLOR_BGR2GRAY)
cv.GaussianBlur(o_gray, o_gray, {width: controls.gaussianBlurSize, height: controls.gaussianBlurSize}, 0, 0, cv.BORDER_DEFAULT);


cv.absdiff(firstFrame, o_gray, frameDelta)

firstFrame = o_gray.clone()

// cv.threshold(dstC1, dstC4, 120, 200, cv.THRESH_BINARY);
cv.threshold(frameDelta, dstC4, 120, 200, cv.THRESH_BINARY);

// res = frameDelta
// res = frame
// res = dstC4
cv.bitwise_or(res, dstC4, res)
cv.imshow("cvs", res);
// setTimeout(call_2, 3000);
}
