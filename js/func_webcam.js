var vidElement = document.getElementById("video");
navigator.mediaDevices.getUserMedia({video: true}).then(function(stream){
    vidElement.srcObject = stream;
    vidElement.play();
});
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');
var imgMove = document.getElementByClass("imgMove");
imgMove.onmousedown = function(event) {
  let shiftX = event.clientX - imgMove.getBoundingClientRect().left;
  let shiftY = event.clientY - imgMove.getBoundingClientRect().top;
  imgMove.style.position = 'absolute';
  imgMove.style.zIndex = 1000;
  document.body.append(imgMove);
  moveAt(event.pageX, event.pageY);

  function moveAt(pageX, pageY) {
    imgMove.style.left = pageX - shiftX + 'px';
    imgMove.style.top = pageY - shiftY + 'px';
  }

  function onMouseMove(event) {
    moveAt(event.pageX, event.pageY);
  }
  document.addEventListener('mousemove', onMouseMove);
  imgMove.onmouseup = function() {
    document.removeEventListener('mousemove', onMouseMove);
    imgMove.onmouseup = null;
  };
};

imgMove.ondragstart = function() {
  return false;
};

document.getElementById("snap").addEventListener("click", function() {
	  context.drawImage(video, 0, 0, 640, 480);
    context.drawImage(imgMove, imgMove.getBoundingClientRect().left,imgMove.getBoundingClientRect().top - 80, 50, 50);
    console.log("lol");
    var canvasImg = canvas.toDataURL("image/png");
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../webcam_contr.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    const encodedData = new URLSearchParams({"img": canvasImg}).toString();
    console.log(encodedData);
    xhr.send(encodedData);
    xhr.onload = function() {
        if (xhr.status === 200) {
        } else {
          console.log('Erreur de la requête: ' + xhr.statusimgMove);
        }
      };
    console.log(canvasImg);
});