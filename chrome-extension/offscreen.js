// offscreen.js - Xử lý việc fetch và parse Google search
(function() {
  console.log('[Offscreen] Document initialized');

  // Lắng nghe message từ background
  chrome.runtime.onMessage.addListener((msg, sender, sendResponse) => {
    if (msg.type === "fetch_google" && msg.target === "offscreen") {
      console.log('[Offscreen] Received request for:', msg.url);
      checkIndexOffscreen(msg.url);
    }
  });

  async function checkIndexOffscreen(fullUrl) {
    const searchUrl = 'https://www.google.com/search?q=' + encodeURIComponent('site:' + fullUrl);
    console.log('[Offscreen] Fetching:', searchUrl);

    let attempts = 0;
    const maxAttempts = 30;

    try {
      const response = await fetch(searchUrl, {
        headers: {
          'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
        }
      });

      if (!response.ok) {
        throw new Error(`HTTP ${response.status}`);
      }

      const html = await response.text();
      
      // Parse HTML bằng DOMParser
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      
      // Đợi nội dung load (giống logic content.js)
      const checkBody = () => {
        return new Promise((resolve) => {
          const interval = setInterval(() => {
            attempts++;
            const body = doc.body;
            
            if (!body || body.innerText.length < 100) {
              if (attempts >= maxAttempts) {
                clearInterval(interval);
                resolve("Timeout");
              }
              return;
            }
            
            clearInterval(interval);
            
            // Kiểm tra status (logic giống content.js)
            const text = body.innerText.toLowerCase();
            let status = "Không xác định";
            
            if (text.includes("chúng tôi phát hiện lưu lượng bất thường") || text.includes("unusual traffic")) {
              status = "Bị chặn bởi Google";
            } else if (text.includes("không tìm thấy site:") || text.includes("did not match any documents")) {
              status = "Chưa index";
            } else {
              status = "Đã index";
            }
            
            resolve(status);
          }, 500);
        });
      };

      const status = await checkBody();
      console.log('[Offscreen] Status:', status);

      // Gửi kết quả về background
      chrome.runtime.sendMessage({
        type: "index_result",
        url: "https://" + fullUrl,
        status: status
      });

    } catch (error) {
      console.error('[Offscreen] Error:', error);
      
      chrome.runtime.sendMessage({
        type: "index_result",
        url: "https://" + fullUrl,
        status: "Lỗi: " + error.message
      });
    }
  }
})();