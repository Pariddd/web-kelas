let currentImageSrc = "";
let currentImageTitle = "";

function openModal(imageSrc, title) {
    const modal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");
    const modalTitle = document.getElementById("modalTitle");
    const modalBackdrop = document.getElementById("modalBackdrop");
    const modalContent = document.getElementById("modalContent");

    currentImageSrc = imageSrc;
    currentImageTitle = title;

    modalImage.src = imageSrc;
    modalImage.alt = title;
    modalTitle.textContent = title;

    modal.classList.remove("hidden");
    modal.classList.add("flex");
    document.body.style.overflow = "hidden";

    setTimeout(() => {
        modalBackdrop.classList.remove("opacity-0");
        modalBackdrop.classList.add("opacity-100");
        modalContent.classList.remove("scale-95", "opacity-0");
        modalContent.classList.add("scale-100", "opacity-100");
    }, 10);
}

function closeModal() {
    const modal = document.getElementById("imageModal");
    const modalBackdrop = document.getElementById("modalBackdrop");
    const modalContent = document.getElementById("modalContent");

    modalBackdrop.classList.remove("opacity-100");
    modalBackdrop.classList.add("opacity-0");
    modalContent.classList.remove("scale-100", "opacity-100");
    modalContent.classList.add("scale-95", "opacity-0");

    setTimeout(() => {
        modal.classList.add("hidden");
        modal.classList.remove("flex");
        document.body.style.overflow = "";
    }, 300);
}

document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        closeModal();
    }
});
