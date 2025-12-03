<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curhat AI - SMK Antartika 1 Sidoarjo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .back-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
            font-size: 14px;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .header-chat {
            background: linear-gradient(to right, #003366, #004aad);
        }

        .send-btn {
            background: linear-gradient(to right, #003366, #004aad);
        }

        .send-btn:hover {
            opacity: 0.9;
        }

        .ai-message {
            background-color: #e6f0ff;
            color: #003366;
        }

        .user-message {
            background-color: #d0dff5;
            color: #003366;
        }

        .chat-input {
            border-color: #e0e7ee;
        }

        .chat-input:focus {
            outline: none;
            border-color: #004aad;
            box-shadow: 0 0 0 3px rgba(0, 74, 173, 0.1);
        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex flex-col items-center justify-center">

    <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg overflow-hidden">

        <div class="header-chat p-4 text-white flex items-center shadow-md gap-4">
            <button onclick="history.back()" class="back-btn" title="Kembali ke Dashboard">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>

            <h1 class="text-xl font-bold">🤖 Teman Curhat Kamu</h1>
        </div>

        <div id="chat-box" class="h-96 p-4 overflow-y-auto bg-gray-50 flex flex-col gap-3">
            <div class="self-start ai-message p-3 rounded-lg max-w-xs shadow-sm">
                Halo! Ada yang ingin diceritakan hari ini? Aku siap mendengarkan. 😊
            </div>
        </div>

        <div class="p-4 border-t bg-white flex gap-2">
            <input type="text" id="user-input" class="chat-input flex-1 border p-2 rounded-lg transition" placeholder="Ketik curhatanmu di sini...">
            <button onclick="sendMessage()" id="send-btn" class="send-btn text-white px-4 py-2 rounded-lg transition font-semibold">
                Kirim
            </button>
        </div>
    </div>

    <script>
        async function sendMessage() {
            const inputField = document.getElementById('user-input');
            const message = inputField.value;
            const chatBox = document.getElementById('chat-box');
            const sendBtn = document.getElementById('send-btn');

            if (!message.trim()) return;

            // 1. Tampilkan pesan user
            chatBox.innerHTML += `
                <div class="self-end user-message p-3 rounded-lg max-w-xs text-right shadow-sm">
                    ${message}
                </div>
            `;
            inputField.value = '';
            chatBox.scrollTop = chatBox.scrollHeight; // Auto scroll ke bawah

            // Disable tombol saat loading
            sendBtn.disabled = true;
            sendBtn.innerText = '...';

            try {
                // 2. Kirim ke Backend Laravel
                // Pastikan route name di web.php Anda sesuai. Contoh umum: route('curhat.chat')
                const response = await fetch("{{ route('curhat_ai') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        message: message
                    })
                });

                const data = await response.json();

                // 3. Tampilkan balasan AI
                chatBox.innerHTML += `
                    <div class="self-start ai-message p-3 rounded-lg max-w-xs shadow-sm">
                        ${data.reply}
                    </div>
                `;

            } catch (error) {
                console.error(error);
                chatBox.innerHTML += `<div class="text-red-500 text-xs text-center mt-2">Gagal terhubung ke AI. Cek koneksi atau API Key.</div>`;
            }

            // Aktifkan tombol kembali
            sendBtn.disabled = false;
            sendBtn.innerText = 'Kirim';
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        // Kirim dengan tombol Enter
        document.getElementById('user-input').addEventListener("keypress", function(event) {
            if (event.key === "Enter") sendMessage();
        });
    </script>
</body>

</html>