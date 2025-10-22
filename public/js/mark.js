document.addEventListener("DOMContentLoaded", async () => {
  const dropdownBtn = document.querySelector(".notification-btn");
  const dropdownMenu = document.querySelector(".notification-dropdown-menu");
  const notificationList = document.querySelector(".notification-list");
  const badge = document.querySelector(".notification-badge");
  const markAllBtn = document.querySelector(".mark-all-read");
  dropdownBtn.addEventListener("click", () => {
    dropdownMenu.classList.toggle("hidden");
  });

  async function loadNotifications() {
    try {
      const response = await fetch("http://localhost/casestudy-loan/loan/controller/getNotif.php");
      if (!response.ok) throw new Error(`HTTP error: ${response.status}`);
      const data = await response.json();
      console.log("notif try", data);
      const notifications = data.notifications || [];
      const unreadCount = notifications.filter(n => n.is_read == 0).length;
      badge.textContent = unreadCount;
      notificationList.innerHTML = "";

      if (notifications.length === 0) {
        notificationList.innerHTML = `<p class="no-notifs">No notifications available.</p>`;
        return;
      }

      notifications.forEach(item => {
        const notifItem = document.createElement("div");
        notifItem.classList.add("notification-item");
        if (item.is_read == 0) notifItem.classList.add("unread");

        notifItem.innerHTML = `
          <div class="notification-content">
            <p class="notification-title">${item.title}</p>
            <p class="notification-text">${item.message}</p>
            <span class="notification-time">${formatTime(item.created_at)}</span>
          </div>
        `;

        notificationList.appendChild(notifItem);
      });
    } catch (error) {
      console.error("Error fetching notifications:", error);
    }
  }

  function formatTime(timestamp) {
    const date = new Date(timestamp);
    return date.toLocaleString();
  }

  markAllBtn.addEventListener("click", async () => {
    try {
      const response = await fetch("http://localhost/casestudy-loan/loan/controller/markAllRead.php", {
        method: "POST",
      });

      const result = await response.json();

      if (result.success) {
        document.querySelectorAll(".notification-item.unread").forEach(el => el.classList.remove("unread"));
        badge.textContent = "0";
      } else {
        console.error("Failed to mark notifications as read:", result.message);
      }
    } catch (error) {
      console.error("Error marking notifications as read:", error);
    }
  });
  await loadNotifications();
});
