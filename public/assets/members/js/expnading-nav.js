document.addEventListener("DOMContentLoaded", () => {
    const hash = window.location.hash;

    if (hash === "#anggota") {
        const navItem = document.querySelector(
            '.expanding-nav-item[href$="#anggota"]'
        );
        if (navItem) {
            document
                .querySelectorAll(".expanding-nav-item")
                .forEach((item) => item.classList.remove("active"));

            navItem.classList.add("active");
        }
    }
});

window.addEventListener("scroll", () => {
    const sections = ["header", "anggota", "gallery"];
    const navItems = document.querySelectorAll(".expanding-nav-item");

    sections.forEach((sectionId, index) => {
        const section = document.querySelector(
            sectionId === "header" ? "header" : "#" + sectionId
        );
        if (section) {
            const rect = section.getBoundingClientRect();
            if (rect.top <= 100 && rect.bottom >= 100) {
                navItems.forEach((nav) => {
                    nav.classList.remove("active");
                });
                navItems[index].classList.add("active");
            }
        }
    });
});
