{{-- resources/views/chat.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curhat AI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chat-container {
            width: 400px;
            height: 600px;
            background: white;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .chat-header {
            padding: 10px;
            background: #075e54;
            color: white;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
        }

        .chat-box {
            flex: 1;
            padding: 15px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .message {
            display: flex;
            max-width: 80%;
        }

        .message.user {
            align-self: flex-end;
            justify-content: flex-end;
        }

        .message.ai {
            align-self: flex-start;
            justify-content: flex-start;
        }

        .bubble {
            padding: 10px 14px;
            border-radius: 10px;
            word-wrap: break-word;
            font-size: 14px;
        }

        .user .bubble {
            background: #dcf8c6;
            border-radius: 10px 10px 0 10px;
        }

        .ai .bubble {
            background: #ececec;
            border-radius: 10px 10px 10px 0;
        }

        .chat-input {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .chat-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
            outline: none;
        }

        .chat-input button {
            margin-left: 10px;
            padding: 10px 15px;
            background: #075e54;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="chat-container">
    <div class="chat-header">💬 Curhat AI</div>
    <div class="chat-box" id="chatBox"></div>
    <div class="chat-input">
        <input type="text" id="userInput" placeholder="Tulis curhatanmu di sini...">
        <button onclick="sendMessage()">Kirim</button>
    </div>
</div>

<script>
    async function sendMessage() {
        let input = document.getElementById("userInput");
        let chatBox = document.getElementById("chatBox");
        let userMessage = input.value.trim();
        if (!userMessage) return;

        // Tambahkan chat user
        let userMsgDiv = document.createElement("div");
        userMsgDiv.classList.add("message", "user");
        userMsgDiv.innerHTML = `<div class="bubble">${userMessage}</div>`;
        chatBox.appendChild(userMsgDiv);
        chatBox.scrollTop = chatBox.scrollHeight;
        input.value = "";

        try {
            let response = await fetch("{{ url('/chat/send') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ message: userMessage })
            });

            let data = await response.json();

            // Tambahkan balasan AI
            let aiMsgDiv = document.createElement("div");
            aiMsgDiv.classList.add("message", "ai");
            aiMsgDiv.innerHTML = `<div class="bubble">${data.reply}</div>`;
            chatBox.appendChild(aiMsgDiv);
            chatBox.scrollTop = chatBox.scrollHeight;

        } catch (error) {
            let errDiv = document.createElement("div");
            errDiv.classList.add("message", "ai");
            errDiv.innerHTML = `<div class="bubble">⚠️ Terjadi kesalahan koneksi.</div>`;
            chatBox.appendChild(errDiv);
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    }
</script>
</body>
</html>
