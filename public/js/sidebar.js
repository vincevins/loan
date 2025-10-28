const path = window.location.pathname;
const currentPage = path.substring(path.lastIndexOf('/') + 1);

document.querySelectorAll('.sidebar-nav a').forEach(link => {
  const href = link.getAttribute('href');
  if (href.includes(currentPage)) {
    link.classList.add('active');
  } else {
    link.classList.remove('active');
  }
});


document.addEventListener("keydown", (e) => {
  if (
    e.key === "F12" ||
    (e.ctrlKey && e.shiftKey && e.key === "I") ||
    (e.ctrlKey && e.shiftKey && e.key === "J") ||
    (e.ctrlKey && e.key === "U") ||
    (e.ctrlKey && e.shiftKey && e.key === "C")
  ) {
    e.preventDefault();
  }
});

document.addEventListener("contextmenu", (e) => e.preventDefault());

