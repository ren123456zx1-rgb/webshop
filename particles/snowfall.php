<!-- ❄️ Realistic Snowfall Particle Effect -->
<div id="snow-container"></div>

<style>
#snow-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
    overflow: hidden;
}

.snowflake {
    position: absolute;
    top: -10px;
    color: #fff;
    font-size: 1em;
    pointer-events: none;
    animation: fall linear infinite;
    text-shadow: 
        0 0 5px rgba(255, 255, 255, 0.8),
        0 0 10px rgba(200, 230, 255, 0.6),
        0 0 15px rgba(150, 200, 255, 0.4);
    filter: drop-shadow(0 0 3px rgba(255, 255, 255, 0.9));
}

/* รูปร่างเกล็ดหิมะที่หลากหลาย */
.snowflake.type-1::before { content: '❄'; }
.snowflake.type-2::before { content: '❅'; }
.snowflake.type-3::before { content: '❆'; }
.snowflake.type-4::before { content: '✻'; }
.snowflake.type-5::before { content: '✼'; }
.snowflake.type-6::before { content: '❉'; }
.snowflake.type-7::before { content: '✺'; }

/* เกล็ดหิมะหมุน */
.snowflake.spinning {
    animation: fall linear infinite, spin linear infinite;
}

/* เกล็ดหิมะแกว่ง */
.snowflake.swaying {
    animation: fall linear infinite, sway ease-in-out infinite;
}

/* เกล็ดหิมะแบบ blur (ไกล) */
.snowflake.blurred {
    filter: blur(2px);
    opacity: 0.6;
}

@keyframes fall {
    0% {
        transform: translateY(0) translateX(0);
        opacity: 0;
    }
    10% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        transform: translateY(100vh) translateX(var(--drift));
        opacity: 0;
    }
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

@keyframes sway {
    0%, 100% {
        transform: translateX(0);
    }
    25% {
        transform: translateX(var(--sway-left));
    }
    75% {
        transform: translateX(var(--sway-right));
    }
}

/* เอฟเฟกต์หิมะสะสมที่ด้านล่าง (optional) */
.snow-ground {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 50px;
    background: linear-gradient(to top, 
        rgba(255, 255, 255, 0.3) 0%, 
        rgba(255, 255, 255, 0.1) 50%, 
        transparent 100%);
    pointer-events: none;
    z-index: 2;
    backdrop-filter: blur(5px);
}
</style>

<script>
(function() {
    const container = document.getElementById('snow-container');
    const snowflakeCount = 50; // จำนวนเกล็ดหิมะ
    
    // ระบบลม - เปลี่ยนทิศทางและความแรงแบบสมจริง
    let windSpeed = 0;
    let windDirection = 0;
    let gustStrength = 0;
    
    function updateWind() {
        // ลมพัดแบบค่อยๆ เปลี่ยน
        const targetWind = (Math.random() - 0.5) * 100;
        windSpeed += (targetWind - windSpeed) * 0.1;
        
        // ลมกระโชกแบบสุ่ม
        if (Math.random() < 0.1) {
            gustStrength = (Math.random() - 0.5) * 150;
            setTimeout(() => {
                gustStrength *= 0.5;
            }, 1000);
        } else {
            gustStrength *= 0.95;
        }
        
        requestAnimationFrame(updateWind);
    }
    updateWind();
    
    function createSnowflake() {
        const snowflake = document.createElement('div');
        snowflake.className = 'snowflake';
        
        // เลือกรูปร่างสุ่ม
        const type = Math.floor(Math.random() * 7) + 1;
        snowflake.classList.add('type-' + type);
        
        // ขนาดสุ่ม (เกล็ดหิมะใหญ่-เล็ก)
        const size = Math.random() * 1.5 + 0.5; // 0.5-2em
        snowflake.style.fontSize = size + 'em';
        
        // ตำแหน่งเริ่มต้นสุ่ม
        snowflake.style.left = Math.random() * 100 + '%';
        
        // ความเร็วตก (เกล็ดใหญ่ตกเร็วกว่า)
        const fallSpeed = (size * 5) + Math.random() * 10 + 10; // 10-25 วินาที
        snowflake.style.animationDuration = fallSpeed + 's';
        
        // การเคลื่อนที่ซ้าย-ขวา ตามลม
        const drift = (Math.random() - 0.5) * 300 + windSpeed;
        snowflake.style.setProperty('--drift', drift + 'px');
        
        // เอฟเฟกต์พิเศษ
        const effect = Math.random();
        if (effect < 0.3) {
            // หมุน
            snowflake.classList.add('spinning');
            const spinSpeed = Math.random() * 5 + 3;
            snowflake.style.animationDuration = fallSpeed + 's, ' + spinSpeed + 's';
        } else if (effect < 0.6) {
            // แกว่ง
            snowflake.classList.add('swaying');
            const swayLeft = -(Math.random() * 50 + 20);
            const swayRight = Math.random() * 50 + 20;
            snowflake.style.setProperty('--sway-left', swayLeft + 'px');
            snowflake.style.setProperty('--sway-right', swayRight + 'px');
            const swaySpeed = Math.random() * 3 + 2;
            snowflake.style.animationDuration = fallSpeed + 's, ' + swaySpeed + 's';
        }
        
        // เกล็ดหิมะที่อยู่ไกล (blur)
        if (Math.random() < 0.3) {
            snowflake.classList.add('blurred');
        }
        
        // ความโปร่งใส
        snowflake.style.opacity = Math.random() * 0.6 + 0.4; // 0.4-1.0
        
        // Delay สุ่ม
        snowflake.style.animationDelay = Math.random() * 5 + 's';
        
        container.appendChild(snowflake);
        
        // ลบเกล็ดหิมะเมื่อหมดอายุ
        setTimeout(() => {
            if (snowflake.parentNode) {
                snowflake.remove();
            }
        }, (fallSpeed + 5) * 1000);
    }
    
    // สร้างเกล็ดหิมะเริ่มต้น
    for (let i = 0; i < snowflakeCount; i++) {
        setTimeout(() => createSnowflake(), i * 200);
    }
    
    // สร้างเกล็ดหิมะใหม่เรื่อยๆ
    setInterval(() => {
        if (container.children.length < snowflakeCount + 20) {
            createSnowflake();
        }
    }, 800);
    
    // อัพเดทผลกระทบของลมแบบ real-time
    setInterval(() => {
        const snowflakes = container.querySelectorAll('.snowflake');
        const totalWind = windSpeed + gustStrength;
        
        snowflakes.forEach(snowflake => {
            const currentLeft = parseFloat(snowflake.style.left);
            const windEffect = totalWind * 0.005;
            const newLeft = currentLeft + windEffect;
            
            // จำกัดไม่ให้หิมะออกนอกหน้าจอ
            if (newLeft >= -5 && newLeft <= 105) {
                snowflake.style.left = newLeft + '%';
            }
        });
    }, 50);
    
    // เพิ่มเสียงลมเบาๆ (optional - ต้องมีไฟล์เสียง)
    // const windSound = new Audio('wind-sound.mp3');
    // windSound.loop = true;
    // windSound.volume = 0.1;
    // windSound.play();
})();
</script>

<!-- เพิ่มชั้นหิมะสะสมด้านล่าง (optional) -->
<!-- <div class="snow-ground"></div> -->
