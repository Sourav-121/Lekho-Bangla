// script.js

// DOM elements
const textDisplay = document.getElementById("text-display");
const inputArea = document.getElementById("input-area");
const stopBtn = document.getElementById("stop-btn");
const resetBtn = document.getElementById("reset-btn");
const changeBtn = document.getElementById("change-btn");
const timerSelect = document.getElementById("timer-select");
const customSelect = document.getElementById("custom-select");

const timerEl = document.querySelector("#timer span");
const wpmEl = document.querySelector("#wpm span");
const accuracyEl = document.querySelector("#accuracy span");
const wrongEl = document.querySelector("#wrong span");

let timer = 60;
let timerInterval;
let startTime;
let totalTyped = 0;
let correctChars = 0;
let testRunning = false;
let testStarted = false;
let changingText = false;

// Prevent copying from text display
textDisplay.addEventListener("contextmenu", (e) => e.preventDefault());
textDisplay.addEventListener("copy", (e) => e.preventDefault());

// Load random passage from PHP
async function loadPassage() {
  const res = await fetch("passage.php");
  const data = await res.text();
  return data.trim();
}

// Load custom text list into dropdown
// async function loadCustomList() {
//   const res = await fetch('get_custom_list.php');
//   const list = await res.json();
//   customSelect.innerHTML = '<option value="">-- নির্বাচন করুন --</option>';
//   list.forEach(item => {
//     const opt = document.createElement('option');
//     opt.value = item.title;
//     opt.textContent = item.title;
//     customSelect.appendChild(opt);
//   });
// }

// Render given text into spans
function renderText(passage) {
  textDisplay.innerHTML = "";
  passage.split("").forEach((char) => {
    const span = document.createElement("span");
    span.innerText = char;
    textDisplay.appendChild(span);
  });
}

// Render a random passage
async function renderNewText() {
  const passage = await loadPassage();
  renderText(passage);
}

// Start the test (auto-triggered on first input)
function startTest() {
  if (testRunning || changingText) return;
  clearInterval(timerInterval);

  timer = parseInt(timerSelect.value, 10);
  totalTyped = 0;
  correctChars = 0;
  testRunning = true;
  testStarted = true;

  timerEl.innerText = timer;
  wpmEl.innerText = 0;
  accuracyEl.innerText = 0;
  wrongEl.innerText = 0;

  inputArea.disabled = false;
  inputArea.focus();
  startTime = Date.now();

  timerInterval = setInterval(() => {
    timer--;
    timerEl.innerText = timer;
    if (timer <= 0) stopTest();
  }, 1000);
}

// Stop the test
// function stopTest() {
//   clearInterval(timerInterval);
//   inputArea.disabled = true;
//   testRunning = false;

//   submitResult();
// }

function stopTest() {
  clearInterval(timerInterval);
  inputArea.disabled = true;
  testRunning = false;

  // Calculate final WPM
  const elapsedTimeInSeconds = (Date.now() - startTime) / 1000;
  const elapsedTimeInMinutes = elapsedTimeInSeconds / 60;

  // Word-based stats for final calculation
  const passageWords = textDisplay.innerText.trim().split(/\s+/);
  const inputWords = inputArea.value.trim().split(/\s+/);

  let correctWordsCount = 0;
  let wrongWordsCount = 0;
  let totalWordsTyped = inputWords.filter((word) => word !== "").length;
  for (let i = 0; i < inputWords.length; i++) {
    if (inputWords[i] === passageWords[i]) {
      correctWordsCount++;
    } else if (inputWords[i]) {
      wrongWordsCount++;
    }
  }

  // Calculate final WPM
  let wpm = 0;
  if (elapsedTimeInMinutes > 0) {
    wpm = Math.round(correctWordsCount / elapsedTimeInMinutes);
  }

  // Calculate final accuracy
  const accuracy =
    totalTyped > 0
      ? Math.round((correctWordsCount / totalWordsTyped) * 100)
      : 0;

  wpmEl.innerText = wpm;
  accuracyEl.innerText = accuracy;
  wrongEl.innerText = wrongWordsCount;

  // submit result
  submitResult();
}

// Reset the test
function resetTest() {
  clearInterval(timerInterval);
  timer = parseInt(timerSelect.value, 10);
  timerEl.innerText = timer;
  wpmEl.innerText = 0;
  accuracyEl.innerText = 0;
  wrongEl.innerText = 0;
  inputArea.value = "";
  textDisplay.innerHTML = "";
  testRunning = false;
  testStarted = false;
  inputArea.disabled = false;

  // Reset custom dropdown
  if (customSelect) {
    customSelect.selectedIndex = 0;
  }

  renderNewText();
}

// Change passage manually
changeBtn.addEventListener("click", async () => {
  changingText = true;
  await renderNewText();
  inputArea.value = "";
  changingText = false;
  testStarted = false;
  testRunning = false;
});

// Handle custom text selection
// customSelect.addEventListener('change', async () => {
//   const title = customSelect.value;
//   if (!title) {
//     await renderNewText();
//     return;
//   }
//   const res = await fetch(`get_custom_text.php?title=${encodeURIComponent(title)}`);
//   const text = await res.text();
//   renderText(text);
//   inputArea.value = '';
//   testStarted = false;
//   testRunning = false;
// });

// Handle typing
inputArea.addEventListener("input", async () => {
  if (!testStarted && !changingText) {
    startTest();
  }

  const spans = textDisplay.querySelectorAll("span");
  const input = inputArea.value;
  totalTyped = input.length;
  correctChars = 0;

  spans.forEach((span, idx) => {
    const char = input[idx];
    if (char == null) {
      span.classList.remove("correct", "incorrect");
    } else if (char === span.innerText) {
      span.classList.add("correct");
      span.classList.remove("incorrect");
      correctChars++;
    } else {
      span.classList.add("incorrect");
      span.classList.remove("correct");
    }
  });

  // Auto-scroll to current character
  const currentIndex = input.length;
  const currentSpan = spans[currentIndex];
  if (currentSpan) {
    currentSpan.scrollIntoView({
      behavior: "smooth",
      block: "center",
      inline: "nearest",
    });
  }

  // Word-based stats
  const passageWords = textDisplay.innerText.trim().split(/\s+/);
  const inputWords = input.trim().split(/\s+/);

  let correctWordsCount = 0;
  let wrongWordsCount = 0;
  let totalWordsTyped = inputWords.filter((word) => word !== "").length;
  for (let i = 0; i < inputWords.length; i++) {
    if (inputWords[i] === passageWords[i]) {
      correctWordsCount++;
    } else if (inputWords[i]) {
      wrongWordsCount++;
    }
  }

  // WPM logic: show actual correct words until test ends
  //   let wpm;
  //   if (timer > 0) {
  //     wpm = correctWordsCount;
  //   } else {
  //     const elapsedMinutes = (Date.now() - startTime) / 1000 / 60;
  //     wpm = elapsedMinutes > 0
  //       ? Math.round(correctWordsCount / elapsedMinutes)
  //       : 0;
  //   }

  //   const accuracy = totalTyped > 0
  //     ? Math.round((correctChars / totalTyped) * 100)
  //     : 0;

  //   wpmEl.innerText      = wpm;
  //   accuracyEl.innerText = accuracy;
  //   wrongEl.innerText    = wrongWordsCount;
  // });

  // Wire up stop and reset
  // stopBtn.addEventListener('click', stopTest);
  // resetBtn.addEventListener('click', resetTest);

  // Initial load
  // renderNewText();
  // loadCustomList();
  // inputArea.disabled = false;

  // Calculate elapsed time in minutes
  const elapsedTimeInSeconds = (Date.now() - startTime) / 1000;
  const elapsedTimeInMinutes = elapsedTimeInSeconds / 60;

  // Calculate WPM based on correct words and elapsed time
  let wpm = 0;
  if (elapsedTimeInMinutes > 0) {
    wpm = Math.round(correctWordsCount / elapsedTimeInMinutes);
  }

  const accuracy =
    totalTyped > 0
      ? Math.round((correctWordsCount / totalWordsTyped) * 100)
      : 0;

  wpmEl.innerText = wpm;
  accuracyEl.innerText = accuracy;
  wrongEl.innerText = wrongWordsCount;
});

// Wire up stop and reset
stopBtn.addEventListener("click", stopTest);
resetBtn.addEventListener("click", resetTest);

// Initial load
renderNewText();
loadCustomList();
inputArea.disabled = false;

// Function to submit results (you'll need to implement this)
function submitResult() {
  // Implement your result submission logic here
  console.log("Test completed. WPM:", wpmEl.innerText);
}
