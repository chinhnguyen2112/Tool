let offscreenCreated = false;

async function ensureOffscreenDocument() {
  if (offscreenCreated) return;
  const contexts = await chrome.runtime.getContexts({
    contextTypes: ['OFFSCREEN_DOCUMENT']
  });
  if (contexts.length > 0) {
    offscreenCreated = true;
    return;
  }
  await chrome.offscreen.createDocument({
    url: 'offscreen.html',
    reasons: ['DOM_SCRAPING'],
    justification: 'Check Google indexing status without visible tabs'
  });
  offscreenCreated = true;
}

chrome.runtime.onMessage.addListener(async (msg, sender, sendResponse) => {
  if (msg.type === "check_index" && msg.url) {
    await handleCheckIndex(msg.url, sender.tab?.id);
  }

  if (msg.type === "index_result") {
    sendResultToCI3(msg);
    chrome.tabs.query({}, (tabs) => {
      for (const tab of tabs) {
        if (tab.url && tab.url.includes("manualindexcheck")) {
          chrome.scripting.executeScript({
            target: { tabId: tab.id },
            func: () => {
              if (typeof window.openNextUrl === "function") window.openNextUrl();
            }
          });
        }
      }
    });
  }

  if (msg.type === "show_captcha_tab") {
    chrome.tabs.create({ url: msg.url, active: true }, (tab) => {
      chrome.scripting.executeScript({
        target: { tabId: tab.id },
        func: (originalUrl) => {
          function detectStatus() {
            const text = document.body.innerText.toLowerCase();
            if (text.includes("did not match any documents") || text.includes("không tìm thấy site:")) return "Chưa index";
            if (text.includes("unusual traffic") || text.includes("bị chặn")) return "Bị chặn bởi Google";
            return "Đã index";
          }

          function checkReady() {
            const body = document.body.innerText.toLowerCase();
            const hasCaptcha = body.includes("unusual traffic") || body.includes("bị chặn");
            const hasSearchResult = document.querySelector("#search");
            if (!hasCaptcha && hasSearchResult) {
              const status = detectStatus();
              chrome.runtime.sendMessage({ type: "index_result", url: "https://" + originalUrl, status });
              setTimeout(() => window.close(), 1500);
              return true;
            }
            return false;
          }

          const observer = new MutationObserver(() => {
            if (checkReady()) observer.disconnect();
          });
          observer.observe(document.body, { childList: true, subtree: true });
          checkReady();
        },
        args: [msg.originalUrl]
      });
    });
  }
});

async function handleCheckIndex(url, tabId) {
  await ensureOffscreenDocument();
  chrome.runtime.sendMessage({ type: "fetch_google", url, target: "offscreen" });
}

function sendResultToCI3(result) {
  chrome.tabs.query({}, (tabs) => {
    for (const tab of tabs) {
      if (tab.url && tab.url.includes("manualindexcheck")) {
        chrome.tabs.sendMessage(tab.id, result);
      }
    }
  });
}

chrome.runtime.onStartup.addListener(ensureOffscreenDocument);
chrome.runtime.onInstalled.addListener(ensureOffscreenDocument);

// reinject sau CAPTCHA hoặc redirect
chrome.webNavigation.onCompleted.addListener((details) => {
  if (details.url.includes("https://www.google.com/search")) {
    const q = (new URL(details.url).searchParams.get('q') || '').replace(/^site:/, '');
    if (!q) return;

    chrome.scripting.executeScript({
      target: { tabId: details.tabId },
      func: (originalUrl) => {
        function detectStatus() {
          const text = document.body.innerText.toLowerCase();
          if (text.includes("did not match any documents") || text.includes("không tìm thấy site:")) return "Chưa index";
          if (text.includes("unusual traffic") || text.includes("bị chặn")) return "Bị chặn bởi Google";
          return "Đã index";
        }

        function checkReady() {
          const body = document.body.innerText.toLowerCase();
          const hasCaptcha = body.includes("unusual traffic") || body.includes("bị chặn");
          const hasSearchResult = document.querySelector("#search");
          if (!hasCaptcha && hasSearchResult) {
            const status = detectStatus();
            chrome.runtime.sendMessage({ type: "index_result", url: "https://" + originalUrl, status });
            setTimeout(() => window.close(), 1500);
            return true;
          }
          return false;
        }

        const observer = new MutationObserver(() => {
          if (checkReady()) observer.disconnect();
        });
        observer.observe(document.body, { childList: true, subtree: true });
        checkReady();
      },
      args: [q]
    });
  }
});
