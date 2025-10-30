// background.js - Service Worker xử lý logic chính

let offscreenCreated = false;

// Đảm bảo offscreen document được tạo
async function ensureOffscreenDocument() {
  if (offscreenCreated) {
    return;
  }

  try {
    const existingContexts = await chrome.runtime.getContexts({
      contextTypes: ['OFFSCREEN_DOCUMENT']
    });

    if (existingContexts.length > 0) {
      offscreenCreated = true;
      return;
    }

    await chrome.offscreen.createDocument({
      url: 'offscreen.html',
      reasons: ['DOM_SCRAPING'],
      justification: 'Check Google indexing status without opening visible tabs'
    });

    offscreenCreated = true;
    console.log('[Background] Offscreen document created');

  } catch (error) {
    console.error('[Background] Error creating offscreen document:', error);
  }
}

// Lắng nghe messages
chrome.runtime.onMessage.addListener((msg, sender, sendResponse) => {
  console.log('[Background] Received message:', msg.type, 'from:', sender.tab ? 'content script' : 'extension');

  // Message từ content script (trang CI3) yêu cầu check index
  if (msg.type === "check_index" && msg.url) {
    handleCheckIndex(msg.url, sender.tab.id);
  }

  // Message từ offscreen trả kết quả về
  if (msg.type === "index_result" && msg.url && msg.status) {
    sendResultToCI3(msg);
  }
});

// Xử lý yêu cầu check index
async function handleCheckIndex(url, tabId) {
  console.log('[Background] Starting check for:', url);
  
  await ensureOffscreenDocument();

  chrome.runtime.sendMessage({
    type: "fetch_google",
    url: url,
    target: "offscreen",
    sourceTabId: tabId
  });
}

// Gửi kết quả về trang CI3
function sendResultToCI3(result) {
  console.log('[Background] Sending result to CI3:', result);

  chrome.tabs.query({}, (tabs) => {
    for (const tab of tabs) {
      if (tab.url && tab.url.includes("manualindexcheck")) {
        // Gửi đến content script (bridge.js)
        chrome.tabs.sendMessage(tab.id, result);
      }
    }
  });
}

// Tạo offscreen document khi extension khởi động
chrome.runtime.onStartup.addListener(() => {
  ensureOffscreenDocument();
});

chrome.runtime.onInstalled.addListener(() => {
  ensureOffscreenDocument();
});