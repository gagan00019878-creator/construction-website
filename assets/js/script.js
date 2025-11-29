setTimeout(() => {
    const alert = document.querySelector('#alert-box .alert');
    if(alert){
        alert.style.opacity = '0';
        setTimeout(()=> alert.remove(), 500); // Remove from DOM after fade
    }
}, 5000);  // 5000ms = 5 seconds
