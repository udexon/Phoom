cv.imshow("cvs", src);

res=gray(src)
cv.imshow("cvs", res);


function procvid(alg) {
  let result;
  switch (alg) {
    case 'passThrough': result = passThrough(src); break;
    case 'gray': result = gray(src); break;
    case 'hsv': result = hsv(src); break;
    case 'canny': result = canny(src); break;
    case 'inRange': result = inRange(src); break;
    case 'threshold': result = threshold(src); break;
    case 'adaptiveThreshold': result = adaptiveThreshold(src); break;
    case 'gaussianBlur': result = gaussianBlur(src); break;
    case 'bilateralFilter': result = bilateralFilter(src); break;
    case 'medianBlur': result = medianBlur(src); break;
    case 'sobel': result = sobel(src); break;
    case 'scharr': result = scharr(src); break;
    case 'laplacian': result = laplacian(src); break;
    case 'contours': result = contours(src); break;
    case 'calcHist': result = calcHist(src); break;
    case 'equalizeHist': result = equalizeHist(src); break;
    case 'backprojection': result = backprojection(src); break;
    case 'erosion': result = erosion(src); break;
    case 'dilation': result = dilation(src); break;
    case 'morphology': result = morphology(src); break;
    default: result = passThrough(src);
  }
  cv.imshow("cvs", result);
}

