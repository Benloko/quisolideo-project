<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quisolideo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      :root{--brand-green:#1f8f4a;--brand-dark:#0f5d2a}
      *{box-sizing:border-box}
      body{font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial}
      .navbar-brand img{height:36px}
      .navbar{background:linear-gradient(180deg,var(--brand-green),#16773a);color:#fff}
      .nav-link{color:rgba(255,255,255,0.95);margin-left:1rem}

      /* hero background (image only; no colored overlay) */
      .hero h1{font-size:3rem;font-weight:700}
      .hero p.lead{font-size:1.125rem;opacity:.95}

        .hero{
          background: url('/assets/accueil.png') center 42% / cover no-repeat;
          padding:6rem 0;color:#fff;
        }
      /* small horizontal padding for full-width containers so content doesn't touch screen edges */
      .container-fluid{padding-left:.75rem;padding-right:.75rem}
      .training-card{transition:transform .4s ease,opacity .4s ease;opacity:0;transform:translateY(12px)}
      .training-card.visible{opacity:1;transform:none}
      .training-image{height:180px;object-fit:cover;width:100%;border-radius:.25rem}
      .btn-primary{background:var(--brand-dark);border-color:var(--brand-dark)}
      /* Trainings cards - professional 'waoh' style */
      .training-card{border-radius:14px;overflow:hidden;background:#fff;border:1px solid rgba(11,17,24,0.04);box-shadow:0 24px 50px rgba(11,17,24,0.06);transition:transform .45s cubic-bezier(.2,.9,.2,1),box-shadow .45s}
      .training-card:hover{transform:translateY(-12px);box-shadow:0 40px 90px rgba(11,17,24,0.14)}
      .training-media{aspect-ratio:16/11;width:100%;overflow:hidden;background:linear-gradient(180deg,rgba(31,143,74,0.03),rgba(31,143,74,0.06));position:relative}
      .training-media img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .9s cubic-bezier(.2,.9,.2,1)}
      .training-card:hover .training-media img{transform:scale(1.06)}
      .training-overlay{position:absolute;left:0;bottom:0;right:0;padding:.8rem 1rem;background:linear-gradient(180deg,transparent,rgba(0,0,0,0.12));color:#fff;display:flex;justify-content:space-between;align-items:flex-end}
      .training-title{font-size:1.05rem;font-weight:700;color:var(--brand-dark);margin-bottom:.35rem}
      .training-sub{color:#5f6b63;margin-bottom:.6rem}
      .training-meta{display:flex;gap:.6rem;align-items:center;font-size:.92rem}
      .training-badge{background:var(--brand-green);color:#fff;padding:.28rem .6rem;border-radius:999px;font-weight:700;font-size:.82rem;box-shadow:0 6px 18px rgba(31,143,74,0.12)}
      .training-cta{margin-top:.8rem}
      .training-cta .btn{border-radius:8px;padding:.45rem .75rem}

      /* Reveal animation (staggered) */
      .reveal{opacity:0;transform:translateY(18px) scale(.995);transition:opacity .6s ease,transform .6s cubic-bezier(.2,.9,.2,1)}
      .reveal.visible{opacity:1;transform:none}
      .training-meta .muted{color:#6b7570}
      /* Footer styles: single green bottom bar */
      .site-footer{background:transparent;color:inherit}
      .footer-bottom{background:linear-gradient(90deg,var(--brand-green),var(--brand-dark));padding:1.5rem 0;color:#fff}
      .footer-bottom a{color:rgba(255,255,255,0.95);text-decoration:none}
      .footer-bottom a:hover{color:#fff;text-decoration:underline}
      .footer-brand{font-weight:700;display:flex;align-items:center;gap:.6rem}
      .footer-brand img{height:36px;border-radius:6px;box-shadow:0 2px 6px rgba(0,0,0,.12)}
      .footer-small{color:rgba(255,255,255,0.92);font-size:.95rem}

      /* Footer newsletter */
      .footer-newsletter{max-width:360px;margin:0 auto}
      .footer-newsletter .form-control{border:1px solid rgba(255,255,255,0.35);background:rgba(255,255,255,0.12);color:#fff}
      .footer-newsletter .form-control::placeholder{color:rgba(255,255,255,0.78)}
      .footer-newsletter .btn{border:1px solid rgba(255,255,255,0.35)}

      /* Animations */
      @keyframes fadeUp {from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:none}}
      .footer-bottom .footer-inner{display:flex;align-items:center;justify-content:space-between;gap:1rem}
      .footer-bottom .footer-item{opacity:0;transform:translateY(8px)}
      .footer-bottom.visible .footer-item{animation:fadeUp .56s cubic-bezier(.2,.9,.2,1) forwards}
      .footer-bottom.visible .footer-item:nth-child(1){animation-delay:.06s}
      .footer-bottom.visible .footer-item:nth-child(2){animation-delay:.12s}
      .footer-bottom.visible .footer-item:nth-child(3){animation-delay:.18s}

      @media (max-width:767px){
        .footer-bottom .footer-inner{flex-direction:column;align-items:center;text-align:center}
        .footer-bottom .text-end, .footer-bottom .text-start {text-align:center!important}
        .footer-bottom .mt-md-0{margin-top:.75rem}
      }

      /* Featured card (home) */
      .featured-card{border-radius:14px;overflow:hidden;background:#fff;box-shadow:0 20px 40px rgba(11,17,24,0.06)}
      .featured-media{aspect-ratio:1/1;width:100%;background:#f7faf7;display:block}
      .featured-img{width:100%;height:100%;object-fit:cover;display:block}
      .featured-caption{padding:1.25rem 1.5rem;background:#fff}
      .featured-caption h3{color:var(--brand-dark);font-weight:700;margin-bottom:.35rem}
      .featured-caption p{color:#556b56;margin-bottom:.9rem}
      .btn-success{background:var(--brand-green);border-color:var(--brand-dark);color:#fff}
      .btn-success:hover{background:color-mix(in srgb, var(--brand-green) 85%, black 15%)}
      .feature-list{list-style:none;padding-left:0;margin-top:0}
      .feature-list li{position:relative;padding-left:26px;margin-bottom:1.1rem}
      .feature-list li::before{content:'';position:absolute;left:0;top:6px;width:10px;height:10px;border-radius:50%;background:var(--brand-green);box-shadow:0 1px 0 rgba(0,0,0,0.06)}
      .feature-list .muted{color:#6c757d;font-size:.95rem}

      /* Section badge and refined typography */
      .section-badge{display:inline-block;background:rgba(31,143,74,0.1);color:var(--brand-dark);padding:.3rem .65rem;border-radius:999px;font-size:.8rem;font-weight:600;margin-bottom:.75rem}
      .featured-gallery h2{font-size:1.85rem;font-weight:700}
      .featured-gallery p{color:#495b4a;line-height:1.65}
      .feature-link{display:inline-block;color:var(--brand-dark);font-weight:600;font-size:.92rem;text-decoration:none;margin-top:.45rem}
      .feature-link:hover{text-decoration:underline;color:color-mix(in srgb, var(--brand-dark) 85%, black 15%)}
      .feature-list li{margin-bottom:1.25rem}

      /* Featured hover & sizing */
      .featured-card{transition:transform .45s cubic-bezier(.2,.9,.2,1),box-shadow .45s}
      .featured-card:hover{transform:translateY(-8px);box-shadow:0 28px 60px rgba(11,17,24,0.12)}
      .featured-card .featured-img{transition:transform .7s cubic-bezier(.2,.9,.2,1)}
      .featured-card:hover .featured-img{transform:scale(1.04)}
      .featured-card{max-width:520px;margin-left:auto}
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand shadow-sm">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="/">
          <img src="/assets/quisolideo-logo.png" alt="Quisolideo logo">
          <span class="ms-2 text-white fw-bold">Quisolideo</span>
        </a>
        <div class="ms-auto d-flex align-items-center">
          <a class="nav-link" href="/">Accueil</a>
          <a class="nav-link" href="/formations">Formations</a>
          <a class="nav-link" href="/partners">Partenaires</a>
          <a class="nav-link" href="/boutique" style="margin-left:1rem;padding:.45rem .8rem;border-radius:.35rem;border:1px solid rgba(255,255,255,0.15);background:rgba(255,255,255,0.04);color:#fff">Boutique</a>
          <a class="nav-link btn btn-outline-light ms-3" href="/contact">Contact</a>
        </div>
      </div>
    </nav>
    @yield('content')
    <footer class="site-footer mt-5">
      <div class="footer-bottom">
        <div class="container-fluid">
          <div class="footer-inner">
            <div class="footer-item text-start">
              <div class="footer-brand">
                <img src="/assets/quisolideo-logo.png" alt="Quisolideo">
                <div>
                  <div class="h6 mb-0">Quisolideo</div>
                  <div class="footer-small">© {{ date('Y') }} — Tous droits réservés.</div>
                </div>
              </div>
            </div>

            <div class="footer-item text-center">
              <a href="/formations" class="mx-2">Formations</a>
              <a href="/partners" class="mx-2">Partenaires</a>
              <a href="/boutique" class="mx-2">Boutique</a>
              <a href="/contact" class="mx-2">Contact</a>

              <div class="footer-newsletter mt-3">
                <div class="footer-small mb-2">Newsletter : 1–2 emails/mois, sans spam.</div>
                <form method="POST" action="{{ route('newsletter.store') }}">
                  @csrf
                  <div class="input-group input-group-sm">
                    <input type="email" name="newsletter_email" class="form-control" placeholder="Votre email" value="{{ old('newsletter_email') }}" autocomplete="email" required>
                    <button class="btn btn-light" type="submit">S'inscrire</button>
                  </div>
                </form>

                @if(session('newsletter_success'))
                  <div class="small mt-2" style="color:rgba(255,255,255,0.95)">{{ session('newsletter_success') }}</div>
                @endif
                @error('newsletter_email')
                  <div class="small mt-2" style="color:rgba(255,255,255,0.95)">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="footer-item text-end d-flex flex-column align-items-end">
              <div class="footer-small">Adresse: BP 1234, Ville</div>
              <div class="mt-1"><a href="/mentions" class="small">Mentions légales</a> · <a href="/politique" class="small">Politique</a></div>
              <div class="mt-2 d-flex align-items-center">
                <a href="#" class="me-2" aria-label="Facebook">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07C2 17.06 5.66 21.2 10.44 21.95v-7.01H7.9v-2.9h2.54V9.41c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.23.2 2.23.2v2.45h-1.25c-1.23 0-1.61.77-1.61 1.56v1.87h2.74l-.44 2.9h-2.3V21.95C18.34 21.2 22 17.06 22 12.07z" fill="#fff"/></svg>
                </a>
                <a href="#" class="me-2" aria-label="Instagram">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm5 7.3A4.7 4.7 0 1 0 16.7 14 4.7 4.7 0 0 0 12 9.3zM18.6 6.5a1.1 1.1 0 1 0 1.1 1.1 1.1 1.1 0 0 0-1.1-1.1z" fill="#fff"/></svg>
                </a>
                <a href="#" aria-label="Twitter">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 5.92c-.63.28-1.3.48-2 .57a3.42 3.42 0 0 0 1.5-1.88 6.8 6.8 0 0 1-2.16.83A3.4 3.4 0 0 0 12.6 8.3a9.66 9.66 0 0 1-7-3.55 3.4 3.4 0 0 0 1.05 4.55c-.52 0-1.02-.16-1.45-.4 0 1.39.97 2.56 2.28 2.83a3.4 3.4 0 0 1-1.53.06c.43 1.35 1.68 2.33 3.16 2.36A6.85 6.85 0 0 1 4 18.2a9.66 9.66 0 0 0 5.22 1.53c6.26 0 9.69-5.18 9.69-9.68v-.44c.66-.46 1.22-1.04 1.66-1.7-.6.27-1.25.45-1.92.53z" fill="#fff"/></svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script>
      document.addEventListener('DOMContentLoaded', function(){
        const fb = document.querySelector('.footer-bottom');
        if(!fb) return;
        // small delay for nicer entrance
        setTimeout(()=>fb.classList.add('visible'), 120);

        // reveal training cards with stagger
        const reveals = document.querySelectorAll('.reveal');
        if(reveals.length){
          const io = new IntersectionObserver((entries)=>{
            entries.forEach(entry=>{
              if(entry.isIntersecting){
                const el = entry.target;
                const delay = parseInt(el.getAttribute('data-reveal-delay') || 0, 10);
                setTimeout(()=>el.classList.add('visible'), delay);
                io.unobserve(el);
              }
            });
          },{threshold:.12});
          reveals.forEach((r)=>io.observe(r));
        }
      });
    </script>
    <script>
      // observe training cards
      const io = new IntersectionObserver((entries)=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');io.unobserve(e.target)}})},{threshold:.15});
      document.addEventListener('DOMContentLoaded', ()=>document.querySelectorAll('.training-card').forEach(el=>io.observe(el)));
    </script>
  </body>
</html>
