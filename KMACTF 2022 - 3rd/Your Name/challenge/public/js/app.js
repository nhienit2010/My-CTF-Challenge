document.libs = ['https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.4.0/purify.min.js']

function loadResource(src) {
  const script = document.createElement('script');
  script.async = true;
  script.src = src;
  
  if (script.src.includes('jsonp') || decodeURIComponent(script.src).includes('jsonp')) {
    throw new Error('No hack')
  }
  
  document.body.appendChild(script);
}

function validateScript(index) {
  setTimeout(() => {
    const element = document.libs[index]
    const src = element.getAttribute('src')

    if (!src.startsWith('https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.4.0/')) {
      throw new Error('Invalid source')
    }
    
    element.parentNode.removeChild(element)
    loadResource(src)
  }, 1000)
}

// validateScript(0)