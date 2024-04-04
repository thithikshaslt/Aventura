// onload document window using js
window.onload = function(){
    //   pick body element ID
    var image = document.getElementById("content");
      
    //   Background Images
      var images = [
          'url(../Images/Background/img1.jpg)',
          'url(../Images/Background/img2.jpg)',
          'url(../Images/Background/img3.jpg)',
          'url(../Images/Background/img4.jpg)',
          'url(../Images/Background/img5.jpg)',
          'url(../Images/Background/img6.jpg)',
          'url(../Images/Background/img7.jpg)',
          
      ]
      
    //   change image every after 5 seconds
      var i = 0;
      i = Math.floor(images.length * Math.random());
      console.log(i);
      image.style.backgroundImage = 'linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), ' + images[i];
      image.style.backgroundSize = "cover";
      image.style.backgroundRepeat = "no-repeat";
      image.style.backgroundPosition = "center";

}