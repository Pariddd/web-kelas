async function shareImageQuick(imageUrl, title) {
    if (navigator.share) {
        try {
            await navigator.share({
                title: title,
                text: `Check out this image: ${title}`,
                url: imageUrl,
            });
            showToast("Shared successfully!", "success");
        } catch (error) {
            if (error.name !== "AbortError") {
                console.error("Share error:", error);
                // Fallback ke copy link
                copyImageLink(imageUrl);
            }
        }
    } else {
        copyImageLink(imageUrl);
    }
}

async function shareImage() {
    if (navigator.share) {
        try {
            await navigator.share({
                title: currentImageTitle,
                text: `Check out this image: ${currentImageTitle}`,
                url: currentImageSrc,
            });
            showToast("Shared successfully!", "success");
        } catch (error) {
            if (error.name !== "AbortError") {
                console.error("Share error:", error);
                copyImageLink(currentImageSrc);
            }
        }
    } else {
        navigator.clipboard
            .writeText(currentImageSrc)
            .then(() => {
                showToast("Image link copied to clipboard!", "success");
            })
            .catch((err) => {
                console.error("Copy error:", err);
                showToast("Failed to copy link", "error");
            });
    }
}
