function showToast(message, type = "success") {
    const toast = document.createElement("div");
    toast.className = `fixed top-4 right-4 z-[60] px-6 py-3 rounded-lg shadow-2xl transform transition-all duration-300 translate-x-0 ${
        type === "success"
            ? "bg-green-600"
            : type === "error"
            ? "bg-red-600"
            : "bg-blue-600"
    } text-white font-medium flex items-center gap-2`;

    const icon =
        type === "success"
            ? '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>'
            : type === "error"
            ? '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>'
            : '<svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';

    toast.innerHTML = icon + `<span>${message}</span>`;
    document.body.appendChild(toast);

    setTimeout(
        () => toast.classList.add("translate-x-full", "opacity-0"),
        3000
    );
    setTimeout(() => toast.remove(), 3500);
}
