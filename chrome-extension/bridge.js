// bridge.js - Cầu nối giữa trang web và extension

// Lắng nghe message từ trang web
window.addEventListener('message', (event) => {
  // Chỉ nhận message từ cùng origin
  if (event.source !== window) return;
  
  const message = event.data;
  
  // Chuyển tiếp message từ trang web đến extension background
  if (message && message.type === 'check_index') {
    chrome.runtime.sendMessage(message);
  }
});

// Lắng nghe message từ extension background
chrome.runtime.onMessage.addListener((message, sender, sendResponse) => {
  // Chuyển tiếp message từ extension về trang web
  if (message && message.type === 'index_result') {
    window.postMessage(message, '*');
  }
});