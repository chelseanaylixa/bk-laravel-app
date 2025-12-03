<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curhat dengan Guru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        .modal {
            transition: opacity 0.25s ease-in-out;
        }

        .min-h-screen {
            min-height: 100vh;
        }

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

        .header-top {
            background: linear-gradient(to right, #003366, #004aad);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            border-radius: 12px 12px 0 0;
            margin-bottom: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-4 md:p-8">
        <div class="header-top">
            <button
                id="backButton"
                class="back-btn"
                onclick="history.back()"
                aria-label="Kembali ke halaman sebelumnya">
                <i class="fas fa-arrow-left"></i> Kembali
            </button>
        </div>

        <div class="bg-white p-8 rounded-b-2xl shadow-lg w-full max-w-6xl mx-auto text-center relative">

            <div class="flex flex-col md:flex-row items-center justify-between mb-12 pt-10">
                <div class="text-left md:w-1/2 md:pr-8">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Yuk, Mulai Curhat dengan Guru!</h1>
                    <p class="text-lg text-gray-600">
                        Kamu tidak harus menghadapi semuanya sendiri. Kami hadir untuk memberikan layanan konseling online dengan guru Bimbingan Konseling yang siap mendengarkan.
                    </p>
                    <button id="btn-konsultasi" class="mt-6 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-semibold py-3 px-8 rounded-full shadow-lg transition-all">
                        Konsultasi Sekarang
                    </button>
                </div>
                <div class="mt-8 md:mt-0 md:w-1/2 flex justify-center">
                    <div class="p-8 bg-gray-200 rounded-lg shadow-md text-gray-700 max-w-sm">
                        <p class="text-center font-semibold text-lg">
                            Tujuan Konseling ditunjukkan untuk membantu remaja agar dapat mengurangi dan menghilangkan kebiasaan bermain game, serta menata kembali kebiasaan dalam belajarnya.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mb-12">
                <span class="inline-block px-4 py-1 rounded-full text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-500 mb-4">Layanan Kami</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-8">Bimbingan Konseling SMK Antartika 1 Sidoarjo siap untuk...</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-gray-50 p-6 rounded-xl shadow-md flex flex-col items-center">
                        <div class="bg-cyan-500 text-white rounded-full p-4 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.76 1.42 2.97 3.62 2.97 5.95V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                            </svg>
                        </div>
                        <p class="text-gray-600 text-center">Memberikan konsultasi tatap muka via video chat dengan nyaman</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl shadow-md flex flex-col items-center">
                        <div class="bg-cyan-500 text-white rounded-full p-4 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v11c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM10 4h4v2h-4V4zm10 15H4V8h16v11zM9 10h6c.55 0 1 .45 1 1s-.45 1-1 1H9c-.55 0-1-.45-1-1s.45-1 1-1z" />
                            </svg>
                        </div>
                        <p class="text-gray-600 text-center">Menjaga dan menjamin privasi kamu</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl shadow-md flex flex-col items-center">
                        <div class="bg-cyan-500 text-white rounded-full p-4 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm5-.25v-1.93c1.38-1.57 2.4-3.55 2.93-5.75L17 12h-4v-2h5.92c-.22-1.63-.98-3.1-2.12-4.25L16 7l-2-2 1.95-1.95c-1.56-1.19-3.41-1.9-5.38-1.9L9 3.07V6c0 1.1.9 2 2 2h2c1.1 0 2 .9 2 2v2h4c0 4.41-3.59 8-8 8z" />
                            </svg>
                        </div>
                        <p class="text-gray-600 text-center">Menerapkan standar profesionalisme tertinggi demi kenyamanan kamu</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-xl shadow-md flex flex-col items-center">
                        <div class="bg-cyan-500 text-white rounded-full p-4 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        </div>
                        <p class="text-gray-600 text-center">Mengutamakan kebutuhan kamu dan selalu memberikan pelayanan terbaik.</p>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Apa yang Sedang Kamu Rasakan?</h2>
                <p class="text-lg text-gray-600 mb-8">
                    Yuk, pilih perasaan yang sedang kamu hadapi dan temukan bantuan yang kamu butuhkan sekarang!
                </p>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 mb-8">
                    <div class="emotion-icon bg-gray-50 p-4 rounded-xl shadow-sm text-center cursor-pointer hover:bg-gray-200 transition-colors" data-emotion="Keluarga & hubungan">
                        <span class="text-4xl">👨‍👩‍👧‍👦</span>
                        <p class="text-sm font-semibold mt-2">Keluarga & Hubungan</p>
                    </div>
                    <div class="emotion-icon bg-gray-50 p-4 rounded-xl shadow-sm text-center cursor-pointer hover:bg-gray-200 transition-colors" data-emotion="Depresi">
                        <span class="text-4xl">😔</span>
                        <p class="text-sm font-semibold mt-2">Depresi</p>
                    </div>
                    <div class="emotion-icon bg-gray-50 p-4 rounded-xl shadow-sm text-center cursor-pointer hover:bg-gray-200 transition-colors" data-emotion="Kecemasan">
                        <span class="text-4xl">😟</span>
                        <p class="text-sm font-semibold mt-2">Kecemasan</p>
                    </div>
                    <div class="emotion-icon bg-gray-50 p-4 rounded-xl shadow-sm text-center cursor-pointer hover:bg-gray-200 transition-colors" data-emotion="Stres">
                        <span class="text-4xl">🤯</span>
                        <p class="text-sm font-semibold mt-2">Stres</p>
                    </div>
                    <div class="emotion-icon bg-gray-50 p-4 rounded-xl shadow-sm text-center cursor-pointer hover:bg-gray-200 transition-colors" data-emotion="Trauma">
                        <span class="text-4xl">😨</span>
                        <p class="text-sm font-semibold mt-2">Trauma</p>
                    </div>
                    <div class="emotion-icon bg-gray-50 p-4 rounded-xl shadow-sm text-center cursor-pointer hover:bg-gray-200 transition-colors" data-emotion="Burnout">
                        <span class="text-4xl">😩</span>
                        <p class="text-sm font-semibold mt-2">Burnout</p>
                    </div>
                    <div class="emotion-icon bg-gray-50 p-4 rounded-xl shadow-sm text-center cursor-pointer hover:bg-gray-200 transition-colors" data-emotion="Gangguan Mood">
                        <span class="text-4xl">🤪</span>
                        <p class="text-sm font-semibold mt-2">Gangguan Mood</p>
                    </div>
                    <div class="emotion-icon bg-gray-50 p-4 rounded-xl shadow-sm text-center cursor-pointer hover:bg-gray-200 transition-colors" data-emotion="Kecanduan">
                        <span class="text-4xl">😵‍💫</span>
                        <p class="text-sm font-semibold mt-2">Kecanduan</p>
                    </div>
                </div>

                <div id="explanation-box" class="bg-gray-200 p-6 rounded-lg shadow-md text-left hidden">
                </div>
            </div>

        </div>
    </div>

    <div id="modal-pilihan" class="modal fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg shadow-xl max-w-sm mx-auto text-center">
            <h2 class="text-xl font-semibold mb-4">Pilih Guru yang Ingin Anda Hubungi</h2>
            <div class="space-y-4">
                <a id="link-prapti" href="https://wa.me/628523201670?text=Halo%20Bu%20Prapti,%20saya%20ingin%20konsultasi%20mengenai%20sebuah%20masalah." target="_blank" class="block w-full bg-blue-500 text-white font-semibold py-3 rounded-md hover:bg-blue-600 transition-colors">
                    Hubungi Bu Prapti
                </a>
                <a id="link-eka" href="https://wa.me/6287846284511?text=Halo%20Bu%20Eka,%20saya%20ingin%20konsultasi%20mengenai%20sebuah%20masalah." target="_blank" class="block w-full bg-blue-500 text-white font-semibold py-3 rounded-md hover:bg-blue-600 transition-colors">
                    Hubungi Bu Eka
                </a>
            </div>
            <button id="close-modal" class="mt-4 text-sm text-gray-500 hover:text-gray-700">Tutup</button>
        </div>
    </div>

    <script>
        // ... (Kode JavaScript tetap sama) ...
        const btnKonsultasi = document.getElementById('btn-konsultasi');
        const modal = document.getElementById('modal-pilihan');
        const closeModal = document.getElementById('close-modal');

        btnKonsultasi.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        modal.addEventListener('click', (e) => {
            if (e.target.id === 'modal-pilihan') {
                modal.classList.add('hidden');
            }
        });

        // Event listener untuk penjelasan tiap emosi
        const emotionIcons = document.querySelectorAll('.emotion-icon');
        const explanationBox = document.getElementById('explanation-box');
        const emotionDescriptions = {
            "Keluarga & hubungan": "Terapi keluarga dan hubungan adalah bentuk terapi bicara yang bertujuan membantu individu, pasangan, atau keluarga mengatasi berbagai masalah hubungan. Terapis berlatih membantu para peserta untuk memahami pola komunikasi dan interaksi mereka, mengidentifikasi sumber konflik, dan mengembangkan keterampilan komunikasi dan manajemen konflik yang lebih efektif.",
            "Depresi": "Depresi adalah gangguan suasana hati yang ditandai dengan perasaan sedih yang terus-menerus, kehilangan minat, dan energi rendah. Konseling dapat membantu mengidentifikasi akar penyebab depresi dan mengembangkan strategi untuk mengelola gejala.",
            "Kecemasan": "Kecemasan adalah respons alami terhadap stres, tetapi jika berlebihan bisa mengganggu kehidupan sehari-hari. Konseling dapat membantu mengidentifikasi pemicu kecemasan dan mengajarkan teknik relaksasi serta manajemen stres.",
            "Stres": "Stres adalah respons tubuh terhadap tekanan atau ancaman. Konseling dapat membantu Anda memahami bagaimana stres memengaruhi Anda dan mengajarkan cara-cara sehat untuk mengelolanya.",
            "Trauma": "Trauma adalah respons emosional terhadap peristiwa yang mengerikan, seperti kecelakaan, bencana alam, atau kekerasan. Konseling trauma dapat membantu memproses pengalaman sulit dan memulihkan kesehatan emosional.",
            "Burnout": "Burnout adalah kondisi kelelahan fisik, emosional, dan mental yang disebabkan oleh stres berkepanjangan. Konseling dapat membantu Anda mengelola ekspektasi, menetapkan batasan, dan menemukan kembali motivasi.",
            "Gangguan Mood": "Gangguan mood mencakup depresi dan gangguan bipolar, yang ditandai dengan perubahan suasana hati ekstrem. Konseling dapat membantu menstabilkan suasana hati dan mengelola gejala.",
            "Kecanduan": "Kecanduan adalah ketergantungan pada zat atau perilaku. Konseling dapat menjadi bagian penting dari pemulihan, membantu Anda memahami penyebab kecanduan dan membangun strategi untuk hidup sehat."
        };

        emotionIcons.forEach(icon => {
            icon.addEventListener('click', () => {
                const emotion = icon.getAttribute('data-emotion');
                const description = emotionDescriptions[emotion];

                // Update konten dan tampilkan explanation box
                if (description) {
                    explanationBox.innerHTML = `
                        <h3 class="text-xl font-semibold mb-2">${emotion}</h3>
                        <p class="text-gray-700">${description}</p>
                    `;
                    explanationBox.classList.remove('hidden');

                    // Hapus kelas 'bg-blue-100' dari semua dan tambahkan ke yang diklik
                    emotionIcons.forEach(e => e.classList.remove('bg-blue-100'));
                    icon.classList.add('bg-blue-100');
                } else {
                    explanationBox.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>