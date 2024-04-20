function createBubble() {
  const bubble = document.createElement('div');
  bubble.classList.add('bubble');
  
  const windowWidth = window.innerWidth;
  const windowHeight = window.innerHeight;
  
  const left = Math.random() * windowWidth;
  const animationDelay = Math.random() * 5;
  
  if (left + 40 <= windowWidth && windowHeight - 80 >= 0) {
      document.getElementById('bubbleContainer').appendChild(bubble);
      bubble.style.left = left + 'px';
      bubble.style.animationDelay = animationDelay + 's';
  }
}

setInterval(createBubble, 500);

