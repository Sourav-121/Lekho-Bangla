// leaderboard.js

const tbody = document.querySelector("#leaderboard tbody");
const scores = JSON.parse(localStorage.getItem("leaderboard") || "[]");

// Sort by WPM descending
scores.sort((a, b) => b.wpm - a.wpm);

scores.forEach(score => {
  const row = document.createElement("tr");
  row.innerHTML = `
    <td>${score.name}</td>
    <td>${score.email}</td>
    <td>${score.wpm}</td>
    <td>${score.date}</td>
    <td>${score.time}</td>
  `;
  tbody.appendChild(row);
});
