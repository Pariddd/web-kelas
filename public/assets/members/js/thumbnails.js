(function () {
    "use strict";

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initMobileGallery);
    } else {
        initMobileGallery();
    }

    function initMobileGallery() {
        console.log("Initializing mobile gallery...");

        const mainImage = document.getElementById("mainImageMobile");
        const mainImageTitle = document.getElementById("mainImageTitleMobile");
        const mainImageDate = document.getElementById("mainImageDateMobile");
        const currentIndexEl = document.getElementById("currentIndexMobile");
        const thumbnails = document.querySelectorAll(".thumbnail-img-mobile");
        const prevBtn = document.getElementById("prevBtnMobile");
        const nextBtn = document.getElementById("nextBtnMobile");
        const activeOverlays = document.querySelectorAll(
            ".thumbnail-active-mobile"
        );

        console.log("Found elements:", {
            mainImage: !!mainImage,
            thumbnails: thumbnails.length,
            prevBtn: !!prevBtn,
            nextBtn: !!nextBtn,
        });

        if (!mainImage || thumbnails.length === 0) {
            console.log("Gallery elements not found, skipping initialization");
            return;
        }

        let currentIndex = 0;

        function updateMainImage(index) {
            console.log("Updating to index:", index);
            const thumbnail = thumbnails[index];
            if (!thumbnail) {
                console.log("Thumbnail not found for index:", index);
                return;
            }

            currentIndex = index;

            mainImage.style.opacity = "0.3";
            setTimeout(() => {
                mainImage.src = thumbnail.dataset.src || thumbnail.src;
                if (mainImageTitle)
                    mainImageTitle.textContent =
                        thumbnail.dataset.title || "Gallery Image";
                if (mainImageDate)
                    mainImageDate.textContent = thumbnail.dataset.date || "";
                mainImage.style.opacity = "1";
            }, 100);

            if (currentIndexEl) currentIndexEl.textContent = index + 1;

            thumbnails.forEach((thumb, i) => {
                if (i === index) {
                    thumb.classList.add("ring-2", "ring-pink-500");
                } else {
                    thumb.classList.remove("ring-2", "ring-pink-500");
                }
            });

            activeOverlays.forEach((overlay, i) => {
                if (i === index) {
                    overlay.classList.remove("hidden");
                } else {
                    overlay.classList.add("hidden");
                }
            });
        }

        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener(
                "click",
                function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log("Thumbnail clicked:", index);
                    updateMainImage(index);
                },
                { passive: false }
            );

            thumbnail.addEventListener(
                "touchend",
                function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log("Thumbnail touched:", index);
                    updateMainImage(index);
                },
                { passive: false }
            );
        });

        if (prevBtn) {
            prevBtn.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                const newIndex =
                    currentIndex > 0 ? currentIndex - 1 : thumbnails.length - 1;
                console.log("Previous clicked, new index:", newIndex);
                updateMainImage(newIndex);

                if (navigator.vibrate) {
                    navigator.vibrate(10);
                }
            });

            prevBtn.addEventListener(
                "touchend",
                function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                },
                { passive: false }
            );
        }

        if (nextBtn) {
            nextBtn.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                const newIndex =
                    currentIndex < thumbnails.length - 1 ? currentIndex + 1 : 0;
                console.log("Next clicked, new index:", newIndex);
                updateMainImage(newIndex);

                if (navigator.vibrate) {
                    navigator.vibrate(10);
                }
            });

            nextBtn.addEventListener(
                "touchend",
                function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                },
                { passive: false }
            );
        }

        let touchStartX = 0;
        let touchEndX = 0;
        let touchStartTime = 0;

        if (mainImage) {
            mainImage.addEventListener(
                "touchstart",
                function (e) {
                    touchStartX = e.changedTouches[0].screenX;
                    touchStartTime = Date.now();
                },
                { passive: true }
            );

            mainImage.addEventListener(
                "touchend",
                function (e) {
                    touchEndX = e.changedTouches[0].screenX;
                    const touchDuration = Date.now() - touchStartTime;

                    if (touchDuration < 300) {
                        handleSwipe();
                    }
                },
                { passive: true }
            );

            mainImage.addEventListener("dragstart", function (e) {
                e.preventDefault();
            });
        }

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchEndX - touchStartX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff < 0) {
                    if (nextBtn) nextBtn.click();
                } else {
                    if (prevBtn) prevBtn.click();
                }
            }
        }

        console.log("Mobile gallery initialized successfully!");
    }
})();
