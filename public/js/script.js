document.addEventListener('DOMContentLoaded', () => {
  initFAQToggle();
  initFadeInAnimation();
  initCounterAnimation();
  initMobileNavToggle();
  initNavbarScrollState();
  initHeroParallax();
  initCoachSlider();
  initTestimoniModal();
  initAddTestimoni();
});

/* === 1. Toggle FAQ (Accordion Style) === */
function initFAQToggle() {
  const faqItems = document.querySelectorAll('.faq-item');

  faqItems.forEach(item => {
    const question = item.querySelector('.faq-question');
    question?.addEventListener('click', () => {
      const isOpen = item.classList.contains('open');

      faqItems.forEach(i => {
        i.classList.remove('open');
        i.querySelector('.faq-question')?.classList.remove('active');
      });

      if (!isOpen) {
        item.classList.add('open');
        question.classList.add('active');
      }
    });
  });
}

/* === 2. Fade-in Animation Saat Scroll === */
function initFadeInAnimation() {
  const elements = document.querySelectorAll('.fade-in');

  if (!elements.length) return;

  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');

        const staggerChildren = entry.target.querySelectorAll(
          '.card, .stat-box, .program-card, .paket-card, .testimoni-card, .coach-card-premium, .faq-item'
        );

        staggerChildren.forEach((child, index) => {
          child.style.transitionDelay = `${index * 80}ms`;
          child.classList.add('visible');
        });

        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  elements.forEach(el => observer.observe(el));
}

/* === 3. Statistik Count-Up Animation === */
function initCounterAnimation() {
  const counters = document.querySelectorAll('.counter');

  if (!counters.length) return;

  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const target = parseInt(el.dataset.target, 10) || 0;
        const duration = 1400;
        const startTime = performance.now();

        const animate = (now) => {
          const progress = Math.min((now - startTime) / duration, 1);
          const current = Math.floor(progress * target);
          el.textContent = current >= target ? target : current;

          if (progress < 1) {
            requestAnimationFrame(animate);
          }
        };

        requestAnimationFrame(animate);
        obs.unobserve(el);
      }
    });
  }, { threshold: 0.4 });

  counters.forEach(counter => observer.observe(counter));
}

/* === 4. Toggle Menu Navigasi Mobile === */
function initMobileNavToggle() {
  const toggle = document.querySelector('.nav-toggle');
  const nav = document.querySelector('.nav-links');

  if (!toggle || !nav) return;

  toggle.addEventListener('click', () => {
    nav.classList.toggle('show');
    toggle.classList.toggle('open');
  });

  nav.querySelectorAll('a').forEach(link =>
    link.addEventListener('click', () => {
      nav.classList.remove('show');
      toggle.classList.remove('open');
    })
  );

  document.addEventListener('click', e => {
    const isClickInside = nav.contains(e.target) || toggle.contains(e.target);
    if (!isClickInside) {
      nav.classList.remove('show');
      toggle.classList.remove('open');
    }
  });
}

/* === 5. Navbar berubah saat discroll === */
function initNavbarScrollState() {
  const navbar = document.querySelector('.navbar');
  if (!navbar) return;

  const updateNavbar = () => {
    if (window.scrollY > 24) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  };

  updateNavbar();
  window.addEventListener('scroll', updateNavbar, { passive: true });
}

/* === 6. Parallax halus untuk visual hero === */
function initHeroParallax() {
  const heroVisual = document.querySelector('.hero-visual');
  if (!heroVisual) return;

  const updateParallax = () => {
    const offset = Math.min(window.scrollY * 0.08, 28);
    heroVisual.style.transform = `translateY(${offset}px)`;
  };

  updateParallax();
  window.addEventListener('scroll', updateParallax, { passive: true });
}

/* === 7. Slider Pelatih (desktop/tablet only) === */
function initCoachSlider() {
  if (window.innerWidth <= 768) return;

  const viewport = document.querySelector('.coach-slider-viewport');
  const prevBtn = document.querySelector('.coach-slider-btn-prev');
  const nextBtn = document.querySelector('.coach-slider-btn-next');

  if (!viewport || !prevBtn || !nextBtn) return;

  const getScrollAmount = () => {
    const slide = viewport.querySelector('.coach-slide');
    if (!slide) return viewport.clientWidth;

    const track = viewport.querySelector('.coach-slider-track');
    const trackStyle = track ? window.getComputedStyle(track) : null;
    const gap = trackStyle ? parseFloat(trackStyle.columnGap || trackStyle.gap || 0) : 0;

    return slide.offsetWidth + gap;
  };

  const updateButtons = () => {
    const maxScrollLeft = viewport.scrollWidth - viewport.clientWidth - 5;
    prevBtn.disabled = viewport.scrollLeft <= 5;
    nextBtn.disabled = viewport.scrollLeft >= maxScrollLeft;
  };

  prevBtn.addEventListener('click', () => {
    viewport.scrollBy({
      left: -getScrollAmount(),
      behavior: 'smooth',
    });
  });

  nextBtn.addEventListener('click', () => {
    viewport.scrollBy({
      left: getScrollAmount(),
      behavior: 'smooth',
    });
  });

  viewport.addEventListener('scroll', updateButtons, { passive: true });
  window.addEventListener('resize', updateButtons);

  updateButtons();
}

/* === 8. Modal Testimoni === */
function initTestimoniModal() {
  const addTestimoniBtn = document.getElementById('addTestimoniBtn');
  const modal = document.getElementById('testimoniModal');
  const closeModalBtn = document.getElementById('closeModalBtn');
  const form = document.getElementById('testimoniForm');

  if (!modal) return;

  const openModal = () => {
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
  };

  const closeModal = () => {
    modal.style.display = 'none';
    document.body.style.overflow = '';
  };

  if (addTestimoniBtn) {
    addTestimoniBtn.addEventListener('click', openModal);
  }

  if (closeModalBtn) {
    closeModalBtn.addEventListener('click', closeModal);
  }

  window.addEventListener('click', (event) => {
    if (event.target === modal) {
      closeModal();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && modal.style.display === 'block') {
      closeModal();
    }
  });

  /* Auto-open modal jika ada old input / error setelah redirect */
  if (form) {
    const nameValue = form.querySelector('input[name="nama"]')?.value?.trim() || '';
    const isiValue = form.querySelector('textarea[name="isi"]')?.value?.trim() || '';
    const checkedRating = form.querySelector('input[name="rating"]:checked');
    const hasErrorAlert = document.querySelector('.daftar-alert-error');

    if (hasErrorAlert || nameValue || isiValue || checkedRating) {
      openModal();
    }
  }
}

/* === 9. Validasi submit Testimoni ke backend === */
function initAddTestimoni() {
  const testimoniForm = document.getElementById('testimoniForm');

  if (!testimoniForm) return;

  testimoniForm.addEventListener('submit', (event) => {
    const checkedRating = testimoniForm.querySelector('input[name="rating"]:checked');

    if (!checkedRating) {
      event.preventDefault();
      alert('Silakan pilih rating terlebih dahulu.');
    }
  });
}