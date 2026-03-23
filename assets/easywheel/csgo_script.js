function setupCSGOReel(wheelId, items) {
    const reelContainer = document.querySelector('.csgo-container');
    const reel = document.querySelector('.csgo-reel');
    const spinButton = document.getElementById('random');
    const itemWidth = 155; // 150px item + 5px margin-right

    // 1. สร้างรายการไอเทมในรางเลื่อน
    function createReelItems(items) {
        // ทำซ้ำรายการไอเทมหลายๆ ครั้งเพื่อให้รางเลื่อนดูยาว
        const repeatCount = 50; 
        let allItems = [];
        for (let i = 0; i < repeatCount; i++) {
            allItems = allItems.concat(items.map(item => ({...item, uniqueId: `${item.id}-${i}`})));
        }
        
        reel.innerHTML = allItems.map(item => `
            <div class="csgo-item" data-id="${item.id}" data-unique-id="${item.uniqueId}">
                <img src="${item.img}" alt="${item.name}">
                <span class="csgo-item-name">${item.name}</span>
            </div>
        `).join('');

        // กำหนดความกว้างของรางเลื่อนทั้งหมด
        reel.style.width = `${allItems.length * itemWidth}px`;
        return allItems;
    }

    const allReelItems = createReelItems(items);

    // 2. ฟังก์ชันสุ่มและหมุน
    spinButton.addEventListener('click', function() {
        spinButton.disabled = true;
        spinButton.textContent = 'กำลังสุ่ม...';

        // ส่ง AJAX ไปยัง spin.php
        fetch('/services/spin.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `wheel=${wheelId}` // สมมติว่า spin.php ใช้ 'wheel' เป็นพารามิเตอร์
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            const winningItemId = data.winner; // ID ของรางวัลที่ชนะจาก spin.php
            
            // 3. คำนวณตำแหน่งเป้าหมาย
            // เราต้องการให้ไอเทมที่ชนะหยุดอยู่ตรงกลางของ marker
            
            // 3.1. กำหนดตำแหน่งของไอเทมที่ชนะในรางเลื่อนทั้งหมด
            // เราต้องการให้หยุดในรอบที่ 45 (จาก 50 รอบ) เพื่อให้แอนิเมชันยาวพอ
            const repeatCount = 50;
            const targetRepeat = repeatCount - 5; // ให้หยุดในรอบที่ 45
            const originalWinningItemIndex = items.findIndex(item => item.id == winningItemId);
            
            if (originalWinningItemIndex === -1) {
                throw new Error("ไม่พบรางวัลที่ชนะในรายการไอเทม");
            }

            const targetItemIndex = (items.length * targetRepeat) + originalWinningItemIndex;
            
            // 3.2. คำนวณตำแหน่งเริ่มต้นของไอเทมที่ชนะ
            let targetPosition = targetItemIndex * itemWidth;
            
            // 3.3. สุ่มตำแหน่งภายในไอเทมที่ชนะ (เพื่อให้ดูสมจริง)
            // สุ่มระหว่าง 10 ถึง itemWidth-10
            const randomOffset = Math.floor(Math.random() * (itemWidth - 20)) + 10; 
            
            // 3.4. คำนวณตำแหน่งเลื่อนสุดท้าย
            // ตำแหน่งที่ต้องการให้จุดกึ่งกลางของไอเทมที่ชนะมาอยู่ตรงกลางของ container
            const centerOfContainer = reelContainer.offsetWidth / 2;
            const finalScrollPosition = targetPosition + (itemWidth / 2) - centerOfContainer + randomOffset;

            // 4. เริ่มแอนิเมชัน
            reel.style.transition = 'transform 8s cubic-bezier(0.1, 0.7, 0.5, 1)'; // เลื่อนจากเร็วไปช้า
            reel.style.transform = `translateX(-${finalScrollPosition}px)`;

            // 5. จัดการเมื่อแอนิเมชันเสร็จสิ้น
            reel.addEventListener('transitionend', function handler() {
                reel.removeEventListener('transitionend', handler);
                
                // แสดงผลลัพธ์
                Swal.fire({
                    icon: 'success',
                    title: 'ยินดีด้วยคุณได้รับ',
                    text: data.message,
                }).then(() => {
                    window.location.reload();
                });

                spinButton.disabled = false;
                spinButton.textContent = 'เริ่มสุ่ม';
            });

        })
        .catch(error => {
            console.error('Spin error:', error);
            const errorMessage = error.message || "เกิดข้อผิดพลาดในการสุ่ม";
            Swal.fire({
                icon: 'error',
                title: 'ขออภัย',
                text: errorMessage,
            }).then(() => {
                window.location.reload();
            });
            spinButton.disabled = false;
            spinButton.textContent = 'เริ่มสุ่ม';
        });
    });
}
