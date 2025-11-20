@include('members.layouts.__header')
<body class="bg-linear-to-br from-[#0F172A] to-[#1E293B] min-h-screen text-white">
   @include('members.layouts.__navbar')

   @yield('content')

   @include('members.layouts.__footer')

   <script>
      document.querySelectorAll(".expanding-nav-item").forEach((item) => {
        item.addEventListener("click", function (e) {
          const href = this.getAttribute("href");
          const targetAttr = this.getAttribute("target");

          document.querySelectorAll(".expanding-nav-item").forEach((nav) => {
            nav.classList.remove("active");
          });
          this.classList.add("active");

          const isExternal =
            href &&
            (href.startsWith("http://") ||
              href.startsWith("https://") ||
              href.startsWith("mailto:"));
          const openInNewTab = targetAttr === "_blank";

          if (isExternal || openInNewTab) {
            return;
          }

          if (!href || href === "#") {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: "smooth" });
            return;
          }

          if (href.startsWith("#")) {
            const target = document.querySelector(href);
            if (target) {
              e.preventDefault();
              window.scrollTo({
                top: target.offsetTop - 80,
                behavior: "smooth",
              });
            }
          }
        });
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

      document.querySelector(".expanding-nav-item").classList.add("active");

      const galleryContainer = document.getElementById("gallery-container");
      const scrollLeftBtn = document.getElementById("scroll-left");
      const scrollRightBtn = document.getElementById("scroll-right");

      scrollRightBtn.addEventListener("click", () => {
        galleryContainer.scrollBy({ left: 300, behavior: "smooth" });
      });

      scrollLeftBtn.addEventListener("click", () => {
        galleryContainer.scrollBy({ left: -300, behavior: "smooth" });
      });

      galleryContainer.addEventListener("scroll", () => {
        const { scrollLeft, scrollWidth, clientWidth } = galleryContainer;

        if (scrollLeft + clientWidth >= scrollWidth - 10) {
          setTimeout(() => {
            galleryContainer.scrollTo({ left: 0, behavior: "smooth" });
          }, 1000);
        }
      });

      const gallerySection = document.querySelector(".group");
      gallerySection.addEventListener("mouseenter", () => {
        scrollLeftBtn.classList.remove("hidden");
        scrollRightBtn.classList.remove("hidden");
      });

      gallerySection.addEventListener("mouseleave", () => {
        scrollLeftBtn.classList.add("hidden");
        scrollRightBtn.classList.add("hidden");
      });

      document.addEventListener('DOMContentLoaded', function () {
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        const revealEls = Array.from(document.querySelectorAll('[data-reveal]'));

        if (!revealEls.length) return;

        if (prefersReduced) {
          // jika user reduce motion -> tampilkan semua tanpa animasi
          revealEls.forEach(el => {
            el.classList.remove('opacity-0', 'translate-y-6');
            el.classList.add('opacity-100', 'translate-y-0');
            el.style.transitionDelay = '';
          });
          return;
        }

        const observer = new IntersectionObserver((entries, obs) => {
          entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            const el = entry.target;

            // baca delay dari attribute (expecting number in seconds, e.g. 0.08)
            const delayAttr = el.dataset.revealDelay;
            const delay = delayAttr ? parseFloat(delayAttr) : 0;

            // apply delay and trigger animation
            el.style.transitionDelay = `${delay}s`;
            el.classList.remove('opacity-0', 'translate-y-6');
            el.classList.add('opacity-100', 'translate-y-0');

            // animate once: stop observing this element
            obs.unobserve(el);
          });
        }, {
          threshold: 0.12
        });

        revealEls.forEach(el => observer.observe(el));
      });
    </script>
</body>
</html>