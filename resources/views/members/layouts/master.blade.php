@include('members.layouts.__header')
<body class="bg-linear-to-br from-[#0F172A] to-[#1E293B] min-h-screen text-white">
   @include('members.layouts.__navbar')

   @yield('content')

   @include('members.layouts.__footer')

   <script>
      // Mobile navigation active state with expanding hover effect
      document.querySelectorAll(".expanding-nav-item").forEach((item) => {
        item.addEventListener("click", function (e) {
          const href = this.getAttribute("href");
          const targetAttr = this.getAttribute("target");

          // Update active class (tetap lakukan ini)
          document.querySelectorAll(".expanding-nav-item").forEach((nav) => {
            nav.classList.remove("active");
          });
          this.classList.add("active");

          // Deteksi kalau link eksternal atau seharusnya buka di tab baru
          const isExternal =
            href &&
            (href.startsWith("http://") ||
              href.startsWith("https://") ||
              href.startsWith("mailto:"));
          const openInNewTab = targetAttr === "_blank";

          if (isExternal || openInNewTab) {
            // jangan preventDefault: biarkan browser membuka link (atau membuka di tab baru jika _blank)
            return;
          }

          // Sekarang tangani link internal / anchor
          if (!href || href === "#") {
            // contoh: href="#" => scroll ke top (atau bisa diarahkan ke '/')
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

      // Set active state based on scroll position
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

      // Initial active state
      document.querySelector(".expanding-nav-item").classList.add("active");

      // Gallery scroll functionality
      const galleryContainer = document.getElementById("gallery-container");
      const scrollLeftBtn = document.getElementById("scroll-left");
      const scrollRightBtn = document.getElementById("scroll-right");

      scrollRightBtn.addEventListener("click", () => {
        galleryContainer.scrollBy({ left: 300, behavior: "smooth" });
      });

      scrollLeftBtn.addEventListener("click", () => {
        galleryContainer.scrollBy({ left: -300, behavior: "smooth" });
      });

      // Loop gallery when reaching end
      galleryContainer.addEventListener("scroll", () => {
        const { scrollLeft, scrollWidth, clientWidth } = galleryContainer;

        if (scrollLeft + clientWidth >= scrollWidth - 10) {
          setTimeout(() => {
            galleryContainer.scrollTo({ left: 0, behavior: "smooth" });
          }, 1000);
        }
      });

      // Show scroll buttons on hover
      const gallerySection = document.querySelector(".group");
      gallerySection.addEventListener("mouseenter", () => {
        scrollLeftBtn.classList.remove("hidden");
        scrollRightBtn.classList.remove("hidden");
      });

      gallerySection.addEventListener("mouseleave", () => {
        scrollLeftBtn.classList.add("hidden");
        scrollRightBtn.classList.add("hidden");
      });
    </script>
</body>
</html>