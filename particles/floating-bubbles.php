<!-- 🫧 Floating Bubbles Particle Effect -->
<div id="bubbles-container"></div>

<style>
#bubbles-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
    overflow: hidden;
}

.bubble {
    position: absolute;
    bottom: -100px;
    border-radius: 50%;
    background: radial-gradient(circle at 30% 30%, 
        rgba(255, 255, 255, 0.8), 
        rgba(173, 216, 230, 0.4) 40%, 
        rgba(135, 206, 250, 0.2) 70%,
        rgba(100, 149, 237, 0.1));
    box-shadow: 
        inset 0 10px 20px rgba(255, 255, 255, 0.5),
        inset 0 -10px 20px rgba(100, 149, 237, 0.3),
        0 5px 15px rgba(100, 149, 237, 0.4);
    animation: float-up linear infinite;
    pointer-events: none;
    filter: blur(0.5px);
}

.bubble::before {
    content: '';
    position: absolute;
    top: 10%;
    left: 15%;
    width: 40%;
    height: 40%;
    background: radial-gradient(circle, 
        rgba(255, 255, 255, 0.9) 0%, 
        rgba(255, 255, 255, 0.3) 50%, 
        transparent 70%);
    border-radius: 50%;
    filter: blur(2px);
}

.bubble::after {
    content: '';
    position: absolute;
    bottom: 15%;
    right: 20%;
    width: 25%;
    height: 25%;
    background: radial-gradient(circle, 
        rgba(255, 255, 255, 0.6) 0%, 
        transparent 60%);
    border-radius: 50%;
    filter: blur(3px);
}

@keyframes float-up {
    0% {
        transform: translateY(0) translateX(0) scale(1);
        opacity: 0;
    }
    10% {
        opacity: 0.8;
    }
    90% {
        opacity: 0.8;
    }
    100% {
        transform: translateY(calc(-100vh - 200px)) translateX(var(--drift)) scale(0.8);
        opacity: 0;
    }
}

@keyframes sway {
    0%, 100% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(var(--sway-distance));
    }
}
</style>

<script>
(function() {
    const container = document.getElementById('bubbles-container');
    const bubbleCount = 25; // จำนวนฟอง
    
    // ระบบลม - เปลี่ยนทิศทางแบบสุ่ม
    let windDirection = 0;
    let windStrength = 0;
    
    function updateWind() {
        // ลมเปลี่ยนทิศทางแบบค่อยๆ
        windDirection += (Math.random() - 0.5) * 0.3;
        windStrength = Math.sin(Date.now() / 3000) * 30 + (Math.random() - 0.5) * 20;
        
        setTimeout(updateWind, 2000 + Math.random() * 3000);
    }
    updateWind();
    
    function createBubble() {
        const bubble = document.createElement('div');
        bubble.className = 'bubble';
        
        // ขนาดสุ่ม
        const size = Math.random() * 60 + 30; // 30-90px
        bubble.style.width = size + 'px';
        bubble.style.height = size + 'px';
        
        // ตำแหน่งเริ่มต้นสุ่ม
        bubble.style.left = Math.random() * 100 + '%';
        
        // ความเร็วลอยขึ้น
        const duration = Math.random() * 8 + 12; // 12-20 วินาที
        bubble.style.animationDuration = duration + 's';
        
        // การเคลื่อนที่ซ้าย-ขวา (drift)
        const drift = (Math.random() - 0.5) * 200;
        bubble.style.setProperty('--drift', drift + 'px');
        
        // การแกว่งไปมา (sway)
        const swayDistance = (Math.random() - 0.5) * 100;
        bubble.style.setProperty('--sway-distance', swayDistance + 'px');
        
        // ความโปร่งใส
        bubble.style.opacity = Math.random() * 0.4 + 0.4; // 0.4-0.8
        
        // Delay สุ่ม
        bubble.style.animationDelay = Math.random() * 5 + 's';
        
        container.appendChild(bubble);
        
        // ลบฟองเมื่อหมดอายุ
        setTimeout(() => {
            if (bubble.parentNode) {
                bubble.remove();
            }
        }, (duration + 5) * 1000);
    }
    
    // สร้างฟองเริ่มต้น
    for (let i = 0; i < bubbleCount; i++) {
        setTimeout(() => createBubble(), i * 300);
    }
    
    // สร้างฟองใหม่เรื่อยๆ
    setInterval(() => {
        if (container.children.length < bubbleCount + 10) {
            createBubble();
        }
    }, 1500);
    
    // อัพเดทผลกระทบของลม
    setInterval(() => {
        const bubbles = container.querySelectorAll('.bubble');
        bubbles.forEach(bubble => {
            const currentLeft = parseFloat(bubble.style.left);
            const windEffect = windStrength * 0.01;
            bubble.style.left = (currentLeft + windEffect) + '%';
        });
    }, 100);
})();
</script>
