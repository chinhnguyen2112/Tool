(function() {
  console.log('[Offscreen] Document initialized');

  chrome.runtime.onMessage.addListener((msg, sender, sendResponse) => {
    if (msg.type === "fetch_google" && msg.target === "offscreen") {
      console.log('[Offscreen] Received request for:', msg.url);
      checkIndexOffscreen(msg.url);
    }
  });

  async function checkIndexOffscreen(fullUrl) {
    const searchUrl = 'https://www.google.com/search?q=' + encodeURIComponent('site:' + fullUrl);
    console.log('[Offscreen] Fetching:', searchUrl);

    try {
      const response = await fetch(searchUrl, {
        headers: {
          'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
        }
      });

      if (!response.ok) {
        if (response.status === 429) {
          console.warn('[Offscreen] 429 detected, sending message show_captcha_tab');
          chrome.runtime.sendMessage({
            type: "show_captcha_tab",
            url: searchUrl,
            originalUrl: fullUrl
          });
          return;
        }
        throw new Error(`HTTP ${response.status}`);
      }

      const html = await response.text();
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');

      const text = doc.body?.innerText.toLowerCase() || "";
      let status = "Không xác định";

      if (text.includes("chúng tôi phát hiện lưu lượng bất thường") || text.includes("unusual traffic")) {
        status = "Bị chặn bởi Google";
      } else if (text.includes("không tìm thấy site:") || text.includes("did not match any documents")) {
        status = "Chưa index";
      } else {
        status = "Đã index";
      }

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
