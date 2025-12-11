<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?? 'SmartKos Agezitomik' ?></title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Central stylesheet for custom view styles -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <style>
      /* Global Reset */
      *, *::before, *::after { box-sizing: border-box; }
      html { scroll-behavior: smooth; }
      body {
        margin: 0; color: #0f172a; background: #f6f8fb; line-height: 1.6;
        font-family: 'Poppins', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
        -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;
      }

      /* Design Tokens */
      :root {
        --primary-color: #2563eb; /* blue-600 */
        --primary-700: #1d4ed8;   /* blue-700 */
        --secondary-color: #0f172a; /* slate-900 */
        --muted-color: #64748b;   /* slate-500 */
        --text-color: #0f172a;    /* base heading/body */
        --light-bg: #eef2ff;      /* indigo-50 */
        --card-bg: #ffffff;
        --card-border: rgba(15,23,42,0.08);
        --card-shadow: 0 10px 30px rgba(2,6,23,0.08);
        --card-hover-shadow: 0 16px 40px rgba(2,6,23,0.12);
        --radius: 14px;
      }

      /* Layout Helpers */
      .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
      section { padding: 96px 0; }
      .section-title {
        font-size: clamp(28px, 4vw, 40px); font-weight: 700; color: var(--text-color);
        text-align: center; margin: 0 auto 18px; letter-spacing: -0.02em;
      }
      .section-subtitle {
        text-align: center; color: var(--muted-color); max-width: 760px; margin: 0 auto 48px;
      }

      /* Navbar */
      .public-nav {
        position: sticky; top: 0; z-index: 1000; width: 100%;
        background: rgba(15,23,42,0.55);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border-bottom: 1px solid rgba(255,255,255,0.06);
        transition: background 240ms ease, box-shadow 240ms ease;
      }
      .public-nav.nav-scrolled { background: rgba(15,23,42,0.9); box-shadow: 0 10px 30px rgba(2,6,23,0.25); }
      .public-nav .nav-inner { display: flex; align-items: center; justify-content: space-between; height: 72px; }

      .logo { display: flex; align-items: center; gap: 10px; color: #fff; font-weight: 700; font-size: 22px; letter-spacing: -0.02em; }
      .logo i { color: var(--primary-color); }

      .nav-menu { list-style: none; display: flex; gap: 8px; padding: 0; margin: 0; align-items: center; }
      .nav-menu a {
        display: inline-flex; align-items: center; gap: 8px;
        color: #e5e7eb; text-decoration: none; font-weight: 500;
        padding: 10px 14px; border-radius: 10px; transition: 180ms ease;
      }
      .nav-menu a:hover { color: #fff; background: rgba(255,255,255,0.06); }
      .nav-menu a.active { color: var(--primary-color); background: rgba(37,99,235,0.12); }
      .nav-menu a.active:hover { background: rgba(37,99,235,0.18); }
      .nav-menu .btn-cta {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-700));
        color: #fff; box-shadow: 0 10px 24px rgba(37,99,235,0.35);
      }
      .nav-menu .btn-cta:hover { transform: translateY(-1px); box-shadow: 0 14px 30px rgba(37,99,235,0.45); }

      .nav-toggle { display: none; background: transparent; border: 0; color: #fff; font-size: 22px; padding: 8px; border-radius: 10px; }
      .nav-toggle:focus-visible { outline: 2px solid #fff; outline-offset: 2px; }

      /* Mobile Menu */
      @media (max-width: 992px) {
        .nav-toggle { display: inline-flex; }
        .nav-menu { position: absolute; left: 0; right: 0; top: 72px; flex-direction: column; gap: 6px; padding: 12px; display: none; }
        .nav-menu.open { display: flex; }
        .nav-menu li { background: rgba(15,23,42,0.85); border-top: 1px solid rgba(255,255,255,0.06); }
        .nav-menu a { padding: 14px 18px; }
      }

      /* Hero Section */
      .hero {
        display: flex; align-items: center; justify-content: center; flex-direction: column; text-align: center;
        padding: 160px 20px; min-height: 640px; color: #fff; position: relative; border-radius: var(--radius);
        margin: 16px 5% 0 5%; box-shadow: var(--card-shadow);
        background: linear-gradient(rgba(2,6,23,0.55), rgba(2,6,23,0.6)), url('https://images.pexels.com/photos/101808/pexels-photo-101808.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1') center/cover no-repeat;
        overflow: hidden;
      }
      .hero::after { content: ""; position: absolute; inset: 0; background: radial-gradient(1200px 400px at 50% -10%, rgba(37,99,235,0.25), transparent 60%); }
      .hero * { position: relative; z-index: 2; }
      .hero h1 { font-size: clamp(34px, 5vw, 56px); letter-spacing: -0.02em; margin: 0 0 14px; font-weight: 800; text-shadow: 0 6px 24px rgba(0,0,0,0.35); }
      .hero p { font-size: clamp(16px, 2vw, 20px); opacity: 0.95; max-width: 820px; margin: 0 auto 28px; }
      .btn-main {
        padding: 14px 28px; background: linear-gradient(135deg, var(--primary-color), var(--primary-700));
        border: none; border-radius: 12px; color: #fff; font-size: 16px; font-weight: 700; cursor: pointer;
        transition: 180ms ease; text-decoration: none; display: inline-flex; align-items: center; gap: 10px;
        box-shadow: 0 12px 30px rgba(37,99,235,0.35);
      }
      .btn-main:hover { transform: translateY(-2px); box-shadow: 0 18px 40px rgba(37,99,235,0.45); }

      /* About */
      .about {
        background: var(--card-bg); border-radius: var(--radius); box-shadow: var(--card-shadow);
        margin: -70px 10% 28px; padding: 56px; display: flex; gap: 56px; align-items: center; flex-wrap: wrap; position: relative; z-index: 1;
        border: 1px solid var(--card-border);
      }
      .about img { width: 460px; max-width: 100%; height: 340px; object-fit: cover; border-radius: var(--radius); box-shadow: var(--card-shadow); transition: transform .35s ease; }
      .about img:hover { transform: scale(1.02); }
      .about-text { flex: 1 1 420px; min-width: 280px; }
      .about-text h2 { font-size: clamp(24px, 3vw, 32px); color: var(--primary-color); font-weight: 700; margin: 0 0 16px; position: relative; }
      .about-text h2::after { content: ''; display: block; width: 64px; height: 4px; background: var(--primary-700); border-radius: 2px; margin-top: 8px; }
      .about-text p { color: var(--text-color); margin: 10px 0; }
      .about-text ul { list-style: none; padding: 0; margin: 18px 0 0; }
      .about-text li { display: flex; align-items: center; gap: 12px; color: var(--text-color); margin: 8px 0; }
      .about-text li i { color: var(--primary-color); }

      /* Reasons */
      .reasons { background: linear-gradient(180deg, var(--light-bg), #f8fafc); }
      .reason-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 22px; margin-top: 16px; }
      .card {
        background: var(--card-bg); border-radius: var(--radius); padding: 28px; text-align: center; border: 1px solid var(--card-border);
        box-shadow: var(--card-shadow); transition: transform 180ms ease, box-shadow 180ms ease;
      }
      .card:hover { transform: translateY(-6px); box-shadow: var(--card-hover-shadow); }
      .card i { font-size: 42px; color: var(--primary-color); margin-bottom: 12px; }
      .card h3 { font-size: 20px; margin: 8px 0 10px; color: var(--text-color); }
      .card p { color: var(--muted-color); font-size: 15px; }

      /* Gallery */
      .gallery .gallery-grid {
        display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 22px; margin-top: 8px;
      }
      .gallery-grid img { width: 100%; height: 240px; object-fit: cover; border-radius: var(--radius); border: 1px solid var(--card-border); box-shadow: var(--card-shadow); transition: transform .35s ease, box-shadow .35s ease; cursor: pointer; }
      .gallery-grid img:hover { transform: translateY(-4px) scale(1.03); box-shadow: var(--card-hover-shadow); }

      /* Testimonials */
      .testimonials { background: linear-gradient(180deg, #f8fafc, var(--light-bg)); }
      .testimonial-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 22px; }
      .testimonial { background: var(--card-bg); border-radius: var(--radius); padding: 26px; border: 1px solid var(--card-border); box-shadow: var(--card-shadow); position: relative; }
      .testimonial:hover { box-shadow: var(--card-hover-shadow); }
      .testimonial i.quote-icon { position: absolute; top: 16px; left: 16px; color: rgba(37,99,235,0.25); font-size: 28px; }
      .testimonial p { color: var(--text-color); margin: 16px 0; font-style: italic; }
      .testimonial h4 { color: var(--primary-color); margin: 0; font-weight: 700; }

      /* Contact */
      .contact .contact-info { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 22px; }
      .info-box { background: var(--card-bg); border-radius: var(--radius); padding: 24px; text-align: center; border: 1px solid var(--card-border); box-shadow: var(--card-shadow); transition: transform 180ms ease, box-shadow 180ms ease; }
      .info-box:hover { transform: translateY(-6px); box-shadow: var(--card-hover-shadow); }
      .info-box i { font-size: 34px; color: var(--primary-color); margin-bottom: 10px; }
      .info-box h4 { margin: 6px 0 8px; color: var(--text-color); font-weight: 700; }
      .info-box p { color: var(--muted-color); margin: 0; }

      /* Footer */
      .public-footer { background: var(--secondary-color); color: #cbd5e1; padding: 36px 0; margin-top: 80px; font-size: 14px; }
      .public-footer .container { display: flex; align-items: center; justify-content: center; text-align: center; }
      .public-footer a { color: #e2e8f0; text-decoration: none; border-bottom: 1px dotted transparent; transition: color 180ms ease, border-color 180ms ease; }
      .public-footer a:hover { color: #fff; border-color: #fff; }

      /* Responsive Sections */
      @media (max-width: 992px) {
        section { padding: 72px 0; }
        .about { margin: -48px 5% 24px; padding: 40px; gap: 30px; }
      }
      @media (max-width: 768px) {
        .hero { padding: 120px 18px; min-height: 520px; margin: 12px 3% 0; }
      }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="public-nav" id="publicNav">
      <div class="container nav-inner">
        <a href="<?= base_url('/') ?>#hero" class="logo" aria-label="SmartKos Agezitomik">
          <i class="fas fa-home"></i>
          <span>SmartKos Agezitomik</span>
        </a>
        <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
          <i class="fas fa-bars"></i>
        </button>
        <ul class="nav-menu" id="navMenu">
          <li><a href="<?= base_url('/') ?>#hero">Beranda</a></li>
          <li><a href="<?= base_url('/') ?>#about">Tentang</a></li>
          <li><a href="<?= base_url('/') ?>#reasons">Keunggulan</a></li>
          <li><a href="<?= base_url('/') ?>#gallery">Galeri</a></li>
          <li><a href="<?= base_url('katalog') ?>" class="btn-cta"><i class="fas fa-home"></i> Lihat Kamar</a></li>
          <?php if (session()->get('isLoggedIn')): ?>
            <li>
              <a href="<?= base_url('profile') ?>" title="Profil Saya" style="display:inline-flex; align-items:center; gap:8px;">
                <span style="width:34px; height:34px; border-radius:999px; background:linear-gradient(135deg,#60a5fa,#3b82f6); color:#fff; display:inline-flex; align-items:center; justify-content:center; font-weight:700;"><?= strtoupper(substr(session()->get('nama') ?? session()->get('username') ?? 'U', 0, 1)) ?></span>
                <span style="color:#e5e7eb; font-weight:600; margin-left:6px;">Profil</span>
              </a>
            </li>
          <?php else: ?>
            <li><a href="<?= base_url('login') ?>"><i class="fas fa-user"></i> Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>

    <!-- Content -->
    <main>
      <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="public-footer">
      <div class="container">
        <p>&copy; 2025 SmartKos Agezitomik · Dirancang dengan <i class="fas fa-heart" style="color: var(--primary-color);"></i> untuk kenyamanan Anda · <a href="#">Kebijakan Privasi</a></p>
      </div>
    </footer>

    <script>
      // Mobile menu toggle
      const navToggle = document.getElementById('navToggle');
      const navMenu = document.getElementById('navMenu');
      navToggle?.addEventListener('click', () => { navMenu?.classList.toggle('open'); });

      // Close mobile menu on link click
      navMenu?.querySelectorAll('a').forEach(a => a.addEventListener('click', () => navMenu.classList.remove('open')));

      // Navbar background on scroll
      const publicNav = document.getElementById('publicNav');
      const onScroll = () => {
        if (!publicNav) return;
        if (window.scrollY > 10) publicNav.classList.add('nav-scrolled');
        else publicNav.classList.remove('nav-scrolled');
      };
      document.addEventListener('scroll', onScroll, { passive: true });
      onScroll();

      // Active nav link on click & scroll (IntersectionObserver)
      const navLinks = Array.from(document.querySelectorAll('.public-nav .nav-menu a'))
        .filter(a => (a.getAttribute('href') || '').includes('#'));

      function clearActive() { navLinks.forEach(a => a.classList.remove('active')); }
      function setActiveByHash(hash) {
        clearActive();
        const link = navLinks.find(a => a.getAttribute('href').endsWith(hash));
        if (link) link.classList.add('active');
      }

      // Handle anchor clicks with smooth scroll and immediate active state
      navLinks.forEach(a => {
        a.addEventListener('click', (e) => {
          const href = a.getAttribute('href');
          if (!href || href === '#') return;
          const idx = href.indexOf('#');
          if (idx === -1) return;
          const hash = href.substring(idx);
          const target = document.querySelector(hash);
          if (target) {
            e.preventDefault();
            setActiveByHash(hash);
            target.scrollIntoView({ behavior: 'smooth' });
          }
        });
      });

      // Observe sections to auto-activate nav links while scrolling
      const observedIds = ['#hero', '#about', '#reasons', '#gallery', '#testimonials', '#contact'];
      const sections = observedIds.map(sel => document.querySelector(sel)).filter(Boolean);

      const io = new IntersectionObserver((entries) => {
        // Pick the entry with the largest intersection ratio
        const visible = entries
          .filter(en => en.isIntersecting)
          .sort((a,b) => b.intersectionRatio - a.intersectionRatio)[0];
        if (visible && visible.target && visible.target.id) {
          setActiveByHash('#' + visible.target.id);
        }
      }, { root: null, rootMargin: '0px 0px -40% 0px', threshold: [0.25, 0.5, 0.75] });

      sections.forEach(sec => io.observe(sec));

      // Default active on load
      if (location.hash) setActiveByHash(location.hash);
      else setActiveByHash('#hero');
    </script>
</body>
</html>
