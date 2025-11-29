function copyImageLink(imageUrl) {
    navigator.clipboard
        .writeText(imageUrl)
        .then(() => {
            showToast("Image link copied to clipboard!", "success");
        })
        .catch((err) => {
            console.error("Copy error:", err);
            showToast("Failed to copy link", "error");
        });
}
