const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        item.addEventListener('click', () => {
            item.classList.toggle('open');
            const answer = item.querySelector('.answer');
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
        });
    });

    function handleKeyPress(event) {
        if (event.key === 'Enter') {
            sendMessage();
        }
    }

    function sendMessage() {
        const userInput = document.getElementById('userInput');
        const messageText = userInput.value.trim();

        if (messageText === '') {
            return;
        }

        const chatMessages = document.getElementById('chatMessages');

        const userMessage = document.createElement('div');
        userMessage.classList.add('chat-message', 'user');
        const userMessageText = document.createElement('p');
        userMessageText.textContent = messageText;
        userMessage.appendChild(userMessageText);
        chatMessages.appendChild(userMessage);

        userInput.value = '';

        setTimeout(() => {
            const supportMessage = document.createElement('div');
            supportMessage.classList.add('chat-message', 'support');
            const supportMessageText = document.createElement('p');
            supportMessageText.textContent = 'Thank you for your message. How can I assist you today?';
            supportMessage.appendChild(supportMessageText);
            chatMessages.appendChild(supportMessage);

            chatMessages.scrollTop = chatMessages.scrollHeight;
        }, 1000);

        chatMessages.scrollTop = chatMessages.scrollHeight;
    }