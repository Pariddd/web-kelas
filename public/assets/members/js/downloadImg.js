async function downloadImageQuick(imageUrl, title) {
    try {
        showToast("Downloading image...", "info");

        const response = await fetch(imageUrl);
        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);

        const link = document.createElement("a");
        link.href = url;
        link.download = sanitizeFilename(title) + ".jpg";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        window.URL.revokeObjectURL(url);

        showToast("Image downloaded successfully!", "success");
    } catch (error) {
        console.error("Download error:", error);
        showToast("Failed to download image", "error");
    }
}

async function downloadImage() {
    try {
        showToast("Downloading image...", "info");

        const response = await fetch(currentImageSrc);
        const blob = await response.blob();
        const url = window.URL.createObjectURL(blob);

        const link = document.createElement("a");
        link.href = url;
        link.download = sanitizeFilename(currentImageTitle) + ".jpg";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        window.URL.revokeObjectURL(url);

        showToast("Image downloaded successfully!", "success");
    } catch (error) {
        console.error("Download error:", error);
        showToast("Failed to download image", "error");
    }
}
