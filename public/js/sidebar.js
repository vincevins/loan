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


