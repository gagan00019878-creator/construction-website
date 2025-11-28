document.getElementById('contactForm').addEventListener('submit', async function(e){
    e.preventDefault();

    const feedbackDiv = document.getElementById('formFeedback');
    feedbackDiv.style.display = 'none';
    feedbackDiv.style.background = '';

    const formData = {
        name: this.name.value,
        email: this.email.value,
        phone: this.phone.value,
        message: this.message.value
    };

    try {
        // ✅ Correct backend route
        const res = await fetch('http://localhost:5000/send', {  
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(formData)
        });

        const data = await res.json();

        feedbackDiv.innerText = data.message;
        feedbackDiv.style.display = 'block';
        feedbackDiv.style.background = data.success ? '#d4edda' : '#f8d7da';
        feedbackDiv.style.color = data.success ? '#155724' : '#721c24';

        if(data.success) this.reset();

    } catch(err) {
        feedbackDiv.innerText = "Oops! Something went wrong.";
        feedbackDiv.style.display = 'block';
        feedbackDiv.style.background = '#f8d7da';
        feedbackDiv.style.color = '#721c24';
        console.error(err);
    }
});
