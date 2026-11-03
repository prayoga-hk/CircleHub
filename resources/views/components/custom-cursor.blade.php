{{-- resources/views/components/custom-cursor.blade.php --}}
<div>
    <style>
        /* ===== CUSTOM CURSOR ===== */
        @media (pointer: fine) {
            body, a, button, input, textarea, select, [role="button"] {
                cursor: none !important;
            }
        }

        .custom-cursor {
            position: fixed;
            top: 0;
            left: 0;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #8B5CF6, #22D3EE); /* Warna Violet ke Cyan */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 900;
            font-size: 16px;
            pointer-events: none; /* Agar klik tembus ke tombol */
            z-index: 999999;
            transform: translate(-50%, -50%);
            transition: transform 0.1s ease-out, width 0.2s ease, height 0.2s ease, opacity 0.2s ease;
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.6), 0 0 30px rgba(34, 211, 238, 0.3);
            mix-blend-mode: difference;
            opacity: 0;
        }

        .custom-cursor-trail {
            position: fixed;
            top: 0;
            left: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #22D3EE;
            pointer-events: none;
            z-index: 999998;
            transform: translate(-50%, -50%);
            transition: transform 0.15s ease-out, opacity 0.3s ease;
            opacity: 0;
            box-shadow: 0 0 10px #22D3EE;
        }

        .custom-cursor.hovering {
            width: 48px;
            height: 48px;
            font-size: 22px;
            background: linear-gradient(135deg, #22D3EE, #8B5CF6);
            box-shadow: 0 0 25px rgba(34, 211, 238, 0.8), 0 0 50px rgba(139, 92, 246, 0.5);
        }

        @media (pointer: coarse) {
            .custom-cursor, .custom-cursor-trail {
                display: none !important;
            }
        }
    </style>

    <!-- Elemen HTML Kursor -->
    <div class="custom-cursor" id="custom-cursor">C</div>
    <div class="custom-cursor-trail" id="custom-cursor-trail"></div>

    <!-- Script Kursor -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cursor = document.getElementById('custom-cursor');
            const trail = document.getElementById('custom-cursor-trail');
            const isFinePointer = window.matchMedia('(pointer: fine)').matches;

            if (cursor && trail && isFinePointer) {
                let mouseX = 0, mouseY = 0;
                let cursorX = 0, cursorY = 0;
                let trailX = 0, trailY = 0;

                document.addEventListener('mousemove', (e) => {
                    mouseX = e.clientX;
                    mouseY = e.clientY;
                    
                    if (cursor.style.opacity === '' || cursor.style.opacity === '0') {
                        cursor.style.opacity = '1';
                        trail.style.opacity = '0.6';
                    }
                });

                function animateCursor() {
                    cursorX += (mouseX - cursorX) * 0.2;
                    cursorY += (mouseY - cursorY) * 0.2;
                    cursor.style.left = cursorX + 'px';
                    cursor.style.top = cursorY + 'px';

                    trailX += (mouseX - trailX) * 0.1;
                    trailY += (mouseY - trailY) * 0.1;
                    trail.style.left = trailX + 'px';
                    trail.style.top = trailY + 'px';

                    requestAnimationFrame(animateCursor);
                }
                animateCursor();

                // Mendeteksi elemen interaktif (termasuk yang dimuat via AJAX)
                const attachHoverEvents = () => {
                    const interactiveElements = document.querySelectorAll('a, button, input, textarea, select, [role="button"]');
                    interactiveElements.forEach(el => {
                        if (!el.hasAttribute('data-cursor-bound')) {
                            el.addEventListener('mouseenter', () => cursor.classList.add('hovering'));
                            el.addEventListener('mouseleave', () => cursor.classList.remove('hovering'));
                            el.setAttribute('data-cursor-bound', 'true');
                        }
                    });
                };
                
                attachHoverEvents();

                // Pantau perubahan DOM agar kursor tetap responsif
                const observer = new MutationObserver(attachHoverEvents);
                observer.observe(document.body, { childList: true, subtree: true });

                document.addEventListener('mouseleave', () => {
                    cursor.style.opacity = '0';
                    trail.style.opacity = '0';
                });
                document.addEventListener('mouseenter', () => {
                    cursor.style.opacity = '1';
                    trail.style.opacity = '0.6';
                });
            }
        });
    </script>
</div>