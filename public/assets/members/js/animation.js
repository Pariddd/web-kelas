document.addEventListener("DOMContentLoaded", function () {
    const prefersReduced = window.matchMedia(
        "(prefers-reduced-motion: reduce)"
    ).matches;
    const revealEls = Array.from(document.querySelectorAll("[data-reveal]"));

    if (!revealEls.length) return;

    if (prefersReduced) {
        revealEls.forEach((el) => {
            el.classList.remove("opacity-0", "translate-y-6");
            el.classList.add("opacity-100", "translate-y-0");
            el.style.transitionDelay = "";
        });
        return;
    }

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const el = entry.target;

                const delayAttr = el.dataset.revealDelay;
                const delay = delayAttr ? parseFloat(delayAttr) : 0;

                el.style.transitionDelay = `${delay}s`;
                el.classList.remove("opacity-0", "translate-y-6");
                el.classList.add("opacity-100", "translate-y-0");

                obs.unobserve(el);
            });
        },
        {
            threshold: 0.12,
        }
    );

    revealEls.forEach((el) => observer.observe(el));
});

const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.remove("opacity-0", "translate-y-10");
                entry.target.classList.add("opacity-100", "translate-y-0");
            }
        });
    },
    { threshold: 0.2 }
);

document
    .querySelectorAll(".scroll-fade-up")
    .forEach((el) => observer.observe(el));
