document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.querySelector(".sidebar");
    const toggleBtn = document.querySelector(".toggle-btn i");

    toggleBtn.addEventListener("click", () => {
        sidebar.classList.toggle("expanded");

        if (sidebar.classList.contains("expanded")) {
            toggleBtn.classList.replace("fa-angle-double-right", "fa-angle-double-left");
        } else {
            toggleBtn.classList.replace("fa-angle-double-left", "fa-angle-double-right");
        }
    });
});