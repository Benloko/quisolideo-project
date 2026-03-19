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
      body{font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        min-height:100vh;display:flex;flex-direction:column
      }
      .page-content{flex:1 0 auto}
      .navbar-brand img{height:36px}

      /* Header / Navbar */
      .site-nav{
        position:sticky;top:0;z-index:1030;
        background:linear-gradient(180deg,
          color-mix(in srgb, var(--brand-green) 92%, black 8%),
          color-mix(in srgb, var(--brand-dark) 88%, black 12%)
        );
        color:#fff;
        border-bottom:1px solid rgba(255,255,255,0.12);
        transition:box-shadow .35s ease, border-color .35s ease;
      }
      .site-nav.scrolled{box-shadow:0 22px 70px rgba(11,17,24,0.18);border-bottom-color:rgba(255,255,255,0.16)}
      @supports ((backdrop-filter: blur(10px)) or (-webkit-backdrop-filter: blur(10px))){
        .site-nav{background:linear-gradient(180deg,
          color-mix(in srgb, var(--brand-green) 84%, transparent 16%),
          color-mix(in srgb, var(--brand-dark) 80%, transparent 20%)
        );
          backdrop-filter:blur(14px);
          -webkit-backdrop-filter:blur(14px);
        }
      }

      .site-nav .navbar-brand{position:relative}
      .site-nav .navbar-brand{color:#fff;text-decoration:none}
      .site-nav .navbar-brand:hover{color:#fff}
      .site-nav .brand-mark{display:inline-flex;align-items:center;justify-content:center;
        width:44px;height:44px;border-radius:14px;
        background:rgba(255,255,255,0.10);
        border:1px solid rgba(255,255,255,0.18);
        box-shadow:0 18px 45px rgba(11,17,24,0.14);
        transition:background .25s ease, border-color .25s ease;
      }
      .site-nav .navbar-brand:hover .brand-mark{background:rgba(255,255,255,0.14);border-color:rgba(255,255,255,0.26)}
      .site-nav .brand-text{letter-spacing:.01em}

      .site-nav .site-nav-links{gap:.35rem}
      .site-nav .site-nav-link{
        color:rgba(255,255,255,0.92);
        margin-left:0;
        padding:.5rem .8rem;
        border-radius:999px;
        font-weight:750;
        text-decoration:none;
        position:relative;
        transition:background .22s ease, color .22s ease, border-color .22s ease;
      }
      .site-nav .site-nav-link::after{
        content:'';position:absolute;left:14px;right:14px;bottom:8px;height:2px;
        background:rgba(255,255,255,0.88);
        border-radius:999px;
        transform:scaleX(0);
        transform-origin:left;
        transition:transform .32s cubic-bezier(.2,.9,.2,1);
        opacity:.9;
      }
      .site-nav .site-nav-link:hover{color:#fff;background:rgba(255,255,255,0.10)}
      .site-nav .site-nav-link:hover::after{transform:scaleX(1)}

      .site-nav .site-nav-link.is-active{
        background:rgba(255,255,255,0.14);
        border:1px solid rgba(255,255,255,0.18);
      }
      .site-nav .site-nav-link.is-active::after{transform:scaleX(1)}

      .site-nav .nav-boutique{
        background:linear-gradient(90deg,var(--brand-green),var(--brand-dark));
        border:1px solid rgba(255,255,255,0.18);
        box-shadow:0 18px 50px rgba(11,17,24,0.16);
      }
      .site-nav .nav-boutique::after{display:none}
      .site-nav .nav-boutique:hover{background:linear-gradient(90deg,
        color-mix(in srgb, var(--brand-green) 92%, white 8%),
        color-mix(in srgb, var(--brand-dark) 92%, white 8%)
      )}

      .site-nav .nav-contact{
        background:rgba(255,255,255,0.06);
        border:1px solid rgba(255,255,255,0.30);
      }
      .site-nav .nav-contact::after{display:none}
      .site-nav .nav-contact:hover{background:rgba(255,255,255,0.12);border-color:rgba(255,255,255,0.40)}

      @media (max-width:991px){
        .site-nav .site-nav-links{gap:.2rem}
        .site-nav .site-nav-link{padding:.48rem .68rem;font-weight:700}
      }

      @media (prefers-reduced-motion: reduce){
        .site-nav, .site-nav *{transition:none!important}
        .site-nav .site-nav-link::after{transition:none!important}
      }

      /* hero background (image only; no colored overlay) */
      .hero h1{font-size:clamp(1.8rem, 2.25vw, 2.35rem);font-weight:900}
      .hero p.lead{font-size:1rem;opacity:.95;line-height:1.65}

      /* Home hero — premium overlay + glass card */
      .hero{
        position:relative;isolation:isolate;overflow:hidden;
        background: url('/assets/accueil.png') 44% 42% / cover no-repeat;
        padding:5.8rem 0;color:#fff;
      }
      .hero::before{
        content:'';position:absolute;inset:0;z-index:0;
        background:linear-gradient(90deg,rgba(15,93,42,0.82),rgba(15,93,42,0.22) 55%,rgba(15,93,42,0.06));
      }
      .hero::after{
        content:'';position:absolute;inset:-12%;z-index:0;
        background:
          radial-gradient(closest-side at 20% 18%, rgba(31,143,74,0.32), transparent 62%),
          radial-gradient(closest-side at 82% 12%, rgba(31,143,74,0.22), transparent 58%),
          radial-gradient(closest-side at 70% 80%, rgba(31,143,74,0.18), transparent 62%);
        opacity:.95;
        animation:heroFloat 14s ease-in-out infinite alternate;
      }
      @keyframes heroFloat{from{transform:translate3d(0,0,0) scale(1)}to{transform:translate3d(18px,-10px,0) scale(1.03)}}
      .hero-content{position:relative;z-index:2}
      .hero-card{max-width:620px;padding:1.85rem 1.65rem;border-radius:20px;
        background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.16);
        box-shadow:0 34px 86px rgba(11,17,24,0.16);
      }
      .hero-pill{display:inline-flex;align-items:center;gap:.55rem;
        padding:.35rem .75rem;border-radius:999px;
        background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.18);
        font-weight:750;font-size:.82rem;letter-spacing:.01em
      }
      .hero-dot{width:9px;height:9px;border-radius:50%;background:var(--brand-green);
        box-shadow:0 0 0 3px rgba(31,143,74,0.18)
      }
      .hero-title{font-weight:900;letter-spacing:-0.02em;line-height:1.08;
        text-shadow:0 22px 60px rgba(0,0,0,0.38)
      }
      .hero .lead{text-shadow:0 18px 46px rgba(0,0,0,0.28)}
      .hero-cta .btn{border-radius:10px;padding:.65rem .95rem;font-weight:800}
      .hero-cta .btn-light{box-shadow:0 16px 40px rgba(11,17,24,0.12)}
      .hero-cta .btn-outline-light{border-color:rgba(255,255,255,0.42)}

      /* Animated emojis on hero (right side) */
      .hero-floats{position:absolute;inset:0;z-index:1;pointer-events:none}
      .hero-float{
        position:absolute;display:flex;align-items:center;justify-content:center;
        width:58px;height:58px;border-radius:18px;
        font-size:1.55rem;
        background:rgba(255,255,255,0.10);
        border:1px solid rgba(255,255,255,0.18);
        box-shadow:0 28px 80px rgba(11,17,24,0.22);
        backdrop-filter:blur(10px);
        -webkit-backdrop-filter:blur(10px);
        animation:emojiFloat 7.2s ease-in-out infinite;
        opacity:.95;
      }
      .hero-float--1{right:10%;top:24%;animation-duration:7.4s;animation-delay:.1s}
      .hero-float--2{right:18%;top:46%;animation-duration:6.8s;animation-delay:.35s}
      .hero-float--3{right:11%;top:62%;animation-duration:7.9s;animation-delay:.55s}
      .hero-float--4{right:22%;top:30%;animation-duration:6.6s;animation-delay:.25s}
      @keyframes emojiFloat{0%{transform:translateY(0) rotate(-2deg)}50%{transform:translateY(-14px) rotate(2deg)}100%{transform:translateY(0) rotate(-2deg)}}

      /* Small twinkle emoji */
      .emoji-twinkle{display:inline-block;transform-origin:center;animation:emojiTwinkle 2.1s ease-in-out infinite}
      @keyframes emojiTwinkle{0%,100%{transform:translateY(0) rotate(0deg) scale(1);opacity:.92}50%{transform:translateY(-1px) rotate(6deg) scale(1.12);opacity:1}}

      @media (max-width:991px){
        .hero{padding:4.6rem 0}
        .hero h1{font-size:2.05rem}
        .hero-card{padding:1.75rem 1.35rem}
        .hero-floats{display:none}
      }
      /* small horizontal padding for full-width containers so content doesn't touch screen edges */
      .container-fluid{padding-left:.75rem;padding-right:.75rem}
      .training-card{transition:transform .4s ease,opacity .4s ease;opacity:0;transform:translateY(12px)}
      .training-card.visible{opacity:1;transform:none}
      .training-image{height:180px;object-fit:cover;width:100%;border-radius:.25rem}
      .btn-primary{background:var(--brand-dark);border-color:var(--brand-dark)}

      /* Shop — categories / products */
      .shop-category-page{position:relative;isolation:isolate}
      .shop-category-page::before{content:'';position:absolute;inset:0;z-index:0;
        background-image:var(--shop-category-bg, none);
        background-size:cover;background-position:center;
        opacity:.08;
        filter:blur(2px);
        transform:scale(1.03);
      }
      .shop-category-page::after{content:'';position:absolute;inset:0;z-index:0;
        background:linear-gradient(180deg, rgba(255,255,255,0.94), rgba(255,255,255,0.96));
      }
      .shop-category-page > *{position:relative;z-index:1}

      .shop-product-card{background:#fff;
        border:1px solid rgba(11,17,24,0.08);
        border-radius:16px;
        overflow:hidden;
        box-shadow:0 18px 45px rgba(11,17,24,0.06);
        transition:transform .45s cubic-bezier(.2,.9,.2,1), box-shadow .45s;
        opacity:0;transform:translateY(12px)
      }
      .shop-product-card.visible{opacity:1;transform:none}
      .shop-product-card:hover{transform:translateY(-6px);box-shadow:0 28px 60px rgba(11,17,24,0.10)}

      .shop-product-media{position:relative;overflow:hidden;
        aspect-ratio:4/3;
        background:linear-gradient(180deg,rgba(31,143,74,0.03),rgba(31,143,74,0.08));
      }
      .shop-product-media img{width:100%;height:100%;object-fit:cover;
        transition:transform .7s cubic-bezier(.2,.9,.2,1)
      }
      .shop-product-card:hover .shop-product-media img{transform:scale(1.04)}
      .shop-product-media--placeholder{width:100%;height:100%;background:linear-gradient(180deg,rgba(31,143,74,0.03),rgba(31,143,74,0.08))}

      .shop-product-price{position:absolute;left:10px;top:10px;
        padding:.35rem .55rem;
        border-radius:999px;
        background:rgba(255,255,255,0.90);
        border:1px solid rgba(11,17,24,0.08);
        font-weight:900;
        color:var(--brand-dark);
        font-size:.85rem;
        backdrop-filter:blur(10px);
        -webkit-backdrop-filter:blur(10px);
      }
      .shop-add-btn{position:absolute;right:10px;bottom:10px;
        width:42px;height:42px;border-radius:999px;
        display:flex;align-items:center;justify-content:center;
        font-weight:900;
        box-shadow:0 18px 45px rgba(11,17,24,0.14)
      }

      /* Trainings pages — distinct from shop cards */
      .page-hero--trainings h1,
      .page-hero--training h1,
      .page-hero--partners h1{color:var(--brand-dark);font-weight:900;letter-spacing:-0.02em}
      .page-hero--trainings p,
      .page-hero--training p,
      .page-hero--partners p{line-height:1.7}

      /* Trainings tabs (Formations / Programmes) */
      .trainings-tabs{display:inline-flex;gap:.35rem;flex-wrap:wrap;
        padding:.35rem;
        border-radius:999px;
        background:rgba(31,143,74,0.06);
        border:1px solid rgba(31,143,74,0.16);
      }
      .trainings-tab{position:relative;isolation:isolate;
        display:inline-flex;align-items:center;justify-content:center;
        padding:.52rem .92rem;
        border-radius:999px;
        font-weight:900;
        letter-spacing:-0.01em;
        text-decoration:none;
        color:var(--brand-dark);
        border:1px solid transparent;
        transition:transform .38s cubic-bezier(.2,.9,.2,1), box-shadow .38s, background .22s ease, border-color .22s ease, color .22s ease;
      }
      .trainings-tab::before{content:'';position:absolute;inset:0;z-index:-1;border-radius:inherit;
        background:linear-gradient(90deg, rgba(31,143,74,0.10), rgba(15,93,42,0.08));
        opacity:0;
        transition:opacity .22s ease;
      }
      .trainings-tab::after{content:'';position:absolute;inset:-2px;pointer-events:none;border-radius:inherit;
        background:linear-gradient(120deg,
          transparent 0%,
          rgba(31,143,74,0.14) 28%,
          rgba(255,255,255,0.60) 50%,
          rgba(31,143,74,0.14) 72%,
          transparent 100%
        );
        transform:translateX(-120%);
        opacity:0;
        transition:transform .8s cubic-bezier(.2,.9,.2,1), opacity .22s ease;
        mix-blend-mode:overlay;
      }
      .trainings-tab:hover{transform:translateY(-2px);
        border-color:rgba(31,143,74,0.22);
        box-shadow:0 22px 60px rgba(11,17,24,0.10), 0 0 0 6px rgba(31,143,74,0.08);
      }
      .trainings-tab:hover::before{opacity:1}
      .trainings-tab:hover::after{transform:translateX(120%);opacity:1}
      .trainings-tab:focus-visible{outline:none;
        box-shadow:0 0 0 .22rem rgba(31,143,74,0.26), 0 22px 60px rgba(11,17,24,0.10);
      }

      .trainings-tab.is-active{color:#fff;
        background:linear-gradient(90deg,var(--brand-green),var(--brand-dark));
        border-color:rgba(255,255,255,0.18);
        box-shadow:0 20px 55px rgba(11,17,24,0.14);
      }
      .trainings-tab.is-active::before{opacity:0}
      .trainings-tab.is-active:hover{transform:translateY(-2px);
        box-shadow:0 28px 70px rgba(11,17,24,0.18), 0 0 0 6px rgba(31,143,74,0.10);
      }
      .trainings-tab.is-active:hover::after{opacity:.9}

      /* Training hero — background media (video/image) + readable overlay */
      .training-hero{
        position:relative;isolation:isolate;overflow:hidden;
        padding:0;color:#fff;
        background-image:var(--training-hero-image, none);
        background-size:cover;
        background-position:center 18%;
      }
      .training-hero::before{
        content:'';position:absolute;inset:0;z-index:1;pointer-events:none;
        background:
          radial-gradient(closest-side at 18% 22%, rgba(31,143,74,0.18), transparent 66%),
          radial-gradient(closest-side at 82% 18%, rgba(31,143,74,0.12), transparent 62%),
          linear-gradient(180deg, rgba(11,17,24,0.72), rgba(11,17,24,0.52));
      }
      .training-hero-bg{position:absolute;inset:0;z-index:0;pointer-events:none;overflow:hidden}
      .training-hero-bg-video{position:absolute;inset:0;width:100%;height:100%;
        object-fit:cover;object-position:center 18%;
        opacity:0;
        transform:scale(1.02);
        transition:opacity .85s cubic-bezier(.2,.9,.2,1)
      }
      .training-hero-bg-video.is-active{opacity:1}
      .training-hero--clickable{cursor:pointer}
      .training-hero > .container{position:relative;z-index:2;padding-top:5.2rem;padding-bottom:5.2rem}
      .training-hero h1{color:#fff;font-weight:900;letter-spacing:-0.02em;
        text-shadow:0 22px 60px rgba(0,0,0,0.38)
      }
      .training-hero p{color:rgba(255,255,255,0.90);
        text-shadow:0 18px 46px rgba(0,0,0,0.28)
      }
      .training-hero .section-badge{background:rgba(255,255,255,0.12);
        border:1px solid rgba(255,255,255,0.18);
        color:#fff;margin-bottom:0;font-weight:800
      }
      .training-hero-back{display:inline-flex;align-items:center;gap:.5rem;
        position:absolute;top:1rem;z-index:2;
        color:rgba(255,255,255,0.92);
        font-weight:850;
        padding:.38rem .65rem;border-radius:999px;
        background:rgba(255,255,255,0.08);
        border:1px solid rgba(255,255,255,0.14);
        transition:background .22s ease, border-color .22s ease, color .22s ease, box-shadow .22s ease
      }
      .training-hero-back:hover{color:#fff;background:rgba(255,255,255,0.12);
        border-color:rgba(255,255,255,0.18);
        box-shadow:0 16px 44px rgba(11,17,24,0.20)
      }
      .training-hero-back:focus-visible{outline:none;background:rgba(255,255,255,0.12);
        border-color:rgba(255,255,255,0.18);
        box-shadow:0 0 0 .22rem rgba(31,143,74,0.28), 0 16px 44px rgba(11,17,24,0.18)
      }
      .training-hero-cta .btn{border-radius:12px;font-weight:900;
        padding:.56rem .92rem;
        font-size:1.02rem;
        line-height:1.15
      }
      @media (min-width:992px){
        .training-hero-cta{position:absolute;right:0;bottom:1.05rem}
      }
      @media (max-width:991px){
        .training-hero > .container{padding-top:4.6rem;padding-bottom:4.6rem}
        .training-hero-back{top:.85rem}
        .training-hero-cta .btn{width:100%}
      }

      .course-card{display:grid;grid-template-columns:240px 1fr;gap:0;
        border-radius:18px;overflow:hidden;
        background:#fff;
        border:1px solid rgba(31,143,74,0.26);
        box-shadow:0 20px 50px rgba(11,17,24,0.08), 0 0 0 1px rgba(31,143,74,0.14) inset;
        transition:transform .45s cubic-bezier(.2,.9,.2,1), box-shadow .45s, border-color .22s ease;
        text-decoration:none;color:inherit;
        position:relative;isolation:isolate;
        cursor:pointer;
      }
      .course-card::after{
        content:'';position:absolute;inset:-2px;pointer-events:none;border-radius:inherit;
        background:linear-gradient(120deg,
          transparent 0%,
          rgba(31,143,74,0.12) 28%,
          rgba(255,255,255,0.55) 50%,
          rgba(31,143,74,0.12) 72%,
          transparent 100%
        );
        transform:translateX(-140%);
        opacity:0;
        transition:transform .85s cubic-bezier(.2,.9,.2,1), opacity .22s ease;
        z-index:2;
        mix-blend-mode:overlay;
      }
      .course-media, .course-body{position:relative;z-index:1}
      .course-card:hover{transform:translateY(-12px);
        box-shadow:0 42px 110px rgba(11,17,24,0.14), 0 0 0 1px rgba(31,143,74,0.22) inset, 0 0 0 7px rgba(31,143,74,0.10);
        border-color:rgba(31,143,74,0.42)
      }
      .course-card:hover::after{transform:translateX(140%);opacity:1}
      .course-card:focus-visible{outline:none;
        box-shadow:0 0 0 .22rem rgba(31,143,74,0.26), 0 42px 110px rgba(11,17,24,0.14), 0 0 0 1px rgba(31,143,74,0.22) inset
      }
      .course-media{aspect-ratio:4/3;overflow:hidden;background:linear-gradient(180deg,rgba(31,143,74,0.04),rgba(31,143,74,0.08))}
      .course-media img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .9s cubic-bezier(.2,.9,.2,1)}
      .course-card:hover .course-media img{transform:scale(1.06)}
      .course-media-placeholder{width:100%;height:100%}
      .course-body{padding:1.25rem 1.25rem 1.15rem}
      .course-kicker{font-size:.74rem;font-weight:900;letter-spacing:.12em;text-transform:uppercase;color:rgba(15,93,42,0.72)}
      .course-top{display:flex;align-items:center;justify-content:space-between;gap:.75rem;flex-wrap:wrap}
      .course-chips{display:flex;gap:.45rem;flex-wrap:wrap}
      .course-chip{display:inline-flex;align-items:center;gap:.35rem;
        padding:.25rem .55rem;border-radius:999px;
        background:rgba(31,143,74,0.08);
        border:1px solid rgba(31,143,74,0.14);
        color:var(--brand-dark);
        font-weight:800;
        font-size:.8rem
      }
      .course-card:hover .course-chip{background:rgba(31,143,74,0.10);border-color:rgba(31,143,74,0.18)}
      .course-title{color:var(--brand-dark);font-weight:900;letter-spacing:-0.01em;line-height:1.15;
        margin:.55rem 0 .45rem
      }
      .course-desc{color:#516456;line-height:1.65}

      @media (max-width:991px){
        .course-card{grid-template-columns:1fr}
        .course-media{aspect-ratio:16/9}
      }

      /* Partners page — logo wall */
      .partners-wall{position:relative;isolation:isolate}
      .partners-wall::before{content:'';position:absolute;inset:0;pointer-events:none;z-index:0;
        background:
          radial-gradient(closest-side at 18% 22%, rgba(31,143,74,0.14), transparent 66%),
          radial-gradient(closest-side at 82% 18%, rgba(31,143,74,0.10), transparent 62%),
          linear-gradient(180deg, rgba(31,143,74,0.06), rgba(255,255,255,0.00) 58%);
      }
      .partners-wall > .container{position:relative;z-index:1}
      .partners-title{color:var(--brand-dark);font-weight:900;letter-spacing:-0.01em;line-height:1.15}

      /* Partners page — feature layout (few partners) */
      .partner-features{display:flex;flex-direction:column;gap:1.5rem}
      .partner-feature{padding:1.15rem 0}
      .partner-feature + .partner-feature{border-top:1px solid rgba(31,143,74,0.14)}
      .partner-feature-media{border-radius:26px;
        padding:1.6rem 1.4rem;
        background:
          radial-gradient(closest-side at 18% 22%, rgba(31,143,74,0.18), transparent 66%),
          radial-gradient(closest-side at 82% 18%, rgba(31,143,74,0.12), transparent 62%),
          linear-gradient(180deg, rgba(255,255,255,0.92), rgba(31,143,74,0.05));
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 28px 80px rgba(11,17,24,0.08);
        min-height:260px;
        display:flex;align-items:center;justify-content:center;
      }
      .partner-feature-logo{width:100%;
        height:clamp(220px, 30vw, 360px);
        object-fit:contain;
        display:block;
        filter:contrast(1.02);
        opacity:.98;
      }
      .partner-feature-fallback{width:120px;height:120px;border-radius:34px;
        display:flex;align-items:center;justify-content:center;
        background:rgba(31,143,74,0.10);
        border:1px solid rgba(31,143,74,0.18);
        color:var(--brand-dark);
        font-weight:950;
        font-size:2.3rem;
        box-shadow:0 18px 44px rgba(11,17,24,0.10)
      }
      .partner-feature-name{color:var(--brand-dark);font-weight:950;letter-spacing:-0.02em;line-height:1.12}
      .partner-feature-desc{color:#495b4a;line-height:1.75;font-size:1.02rem;max-width:80ch}
      .partner-feature-desc a{color:var(--brand-dark)}

      @media (max-width:991px){
        .partner-feature-media{min-height:220px;padding:1.35rem 1.15rem;border-radius:22px}
        .partner-feature-logo{height:clamp(200px, 56vw, 320px)}
      }

      .partner-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:1rem}
      @media (min-width:576px){.partner-grid{grid-template-columns:repeat(3,minmax(0,1fr))}}
      @media (min-width:992px){.partner-grid{grid-template-columns:repeat(5,minmax(0,1fr))}}

      .partner-tile{display:flex;flex-direction:column;align-items:center;justify-content:center;
        border-radius:18px;overflow:hidden;
        background:#fff;
        border:1px solid rgba(31,143,74,0.26);
        box-shadow:0 20px 50px rgba(11,17,24,0.08), 0 0 0 1px rgba(31,143,74,0.14) inset;
        padding:1.05rem 1rem 1rem;
        text-decoration:none;color:inherit;
        position:relative;isolation:isolate;
        transition:transform .45s cubic-bezier(.2,.9,.2,1), box-shadow .45s, border-color .22s ease;
      }
      a.partner-tile{cursor:pointer}
      .partner-tile::after{content:'';position:absolute;inset:-2px;pointer-events:none;border-radius:inherit;
        background:linear-gradient(120deg,
          transparent 0%,
          rgba(31,143,74,0.10) 28%,
          rgba(255,255,255,0.60) 50%,
          rgba(31,143,74,0.10) 72%,
          transparent 100%
        );
        transform:translateX(-140%);
        opacity:0;
        transition:transform .85s cubic-bezier(.2,.9,.2,1), opacity .22s ease;
        z-index:2;
        mix-blend-mode:overlay;
      }
      .partner-tile:hover{transform:translateY(-10px);
        box-shadow:0 42px 110px rgba(11,17,24,0.12), 0 0 0 1px rgba(31,143,74,0.22) inset, 0 0 0 7px rgba(31,143,74,0.10);
        border-color:rgba(31,143,74,0.42)
      }
      .partner-tile:hover::after{transform:translateX(140%);opacity:1}
      .partner-tile:focus-visible{outline:none;
        box-shadow:0 0 0 .22rem rgba(31,143,74,0.26), 0 42px 110px rgba(11,17,24,0.12), 0 0 0 1px rgba(31,143,74,0.22) inset
      }

      .partner-logo-wrap{width:100%;aspect-ratio:3/2;
        border-radius:16px;
        display:flex;align-items:center;justify-content:center;
        background:linear-gradient(180deg,rgba(31,143,74,0.04),rgba(31,143,74,0.08));
        border:1px solid rgba(31,143,74,0.16);
        position:relative;z-index:1;
        overflow:hidden;
      }
      .partner-logo{max-width:78%;max-height:78%;object-fit:contain;display:block;
        opacity:.92;
        filter:grayscale(.18) contrast(1.02);
        transition:transform .7s cubic-bezier(.2,.9,.2,1), filter .25s ease, opacity .25s ease;
      }
      .partner-tile:hover .partner-logo{transform:scale(1.03);filter:none;opacity:1}

      .partner-fallback{width:72px;height:72px;border-radius:20px;
        display:flex;align-items:center;justify-content:center;
        background:rgba(31,143,74,0.10);
        border:1px solid rgba(31,143,74,0.18);
        color:var(--brand-dark);
        font-weight:950;
        font-size:1.55rem;
        box-shadow:0 18px 40px rgba(11,17,24,0.08)
      }
      .partner-name{margin-top:.7rem;
        color:var(--brand-dark);
        font-weight:900;
        letter-spacing:-0.01em;
        text-align:center;
        line-height:1.2;
        font-size:1.02rem;
      }
      .partner-site{margin-top:.35rem;
        font-size:.86rem;
        font-weight:800;
        color:color-mix(in srgb, var(--brand-dark) 88%, black 12%);
        opacity:.85;
      }
      a.partner-tile:hover .partner-site{opacity:1;text-decoration:underline}

      .partners-empty{border-radius:18px;overflow:hidden}

      /* Training show */
      .training-content-card{border-radius:18px;overflow:hidden;background:#fff;
        border:1px solid rgba(11,17,24,0.06);
        box-shadow:0 20px 50px rgba(11,17,24,0.08)
      }
      .training-hero-media{aspect-ratio:16/9;overflow:hidden;background:#f4f8f4}
      .training-hero-media img{width:100%;height:100%;object-fit:cover;display:block}
      .training-content{color:#24302a}
      .training-section-title{font-weight:900;color:var(--brand-dark);letter-spacing:-0.01em;
        margin:0 0 1rem
      }

      .training-media-card{border-radius:18px;overflow:hidden;background:#fff;
        border:1px solid rgba(11,17,24,0.06);
        box-shadow:0 20px 50px rgba(11,17,24,0.08)
      }
      .training-media-main{width:100%;display:block;height:480px}
      .training-media-card img.training-media-main{object-fit:cover;background:transparent}
      .training-media-card video.training-media-main{object-fit:contain;background:#000}
      .training-media-placeholder{height:480px;
        background:
          radial-gradient(closest-side at 18% 22%, rgba(31,143,74,0.16), transparent 66%),
          radial-gradient(closest-side at 82% 18%, rgba(31,143,74,0.10), transparent 62%),
          linear-gradient(180deg,rgba(31,143,74,0.03),rgba(31,143,74,0.06));
      }
      .training-media-meta{color:#223026}
      .training-media-kicker{font-weight:900;color:var(--brand-dark);letter-spacing:-0.01em}
      .training-media-link{color:var(--brand-dark);text-decoration:none;font-weight:850}
      .training-media-link:hover{text-decoration:underline}

      .training-thumbs{flex-wrap:nowrap;overflow-x:auto;scroll-snap-type:x mandatory;
        padding-bottom:6px;-webkit-overflow-scrolling:touch
      }
      .training-thumbs::-webkit-scrollbar{height:8px}
      .training-thumbs::-webkit-scrollbar-thumb{background:rgba(15,93,42,0.18);border-radius:999px}
      .training-thumb{cursor:pointer}
      .training-thumb{scroll-snap-align:start}
      .training-thumb img, .training-thumb video{width:112px;height:78px;object-fit:cover;border-radius:12px;
        border:2px solid transparent;
        box-shadow:0 18px 40px rgba(11,17,24,0.10);
        transition:border-color .22s ease, transform .22s ease
      }
      .training-thumb video{pointer-events:none;background:#000}
      .training-thumb:hover img, .training-thumb:hover video{transform:translateY(-2px)}
      .training-thumb[aria-current="true"] img,
      .training-thumb[aria-current="true"] video{border-color:var(--brand-green)}

      @media (max-width:991px){
        .training-media-main, .training-media-placeholder{height:320px}
        .training-thumb img, .training-thumb video{width:96px;height:68px}
      }
      .training-side-card{border-radius:18px;background:#fff;
        border:1px solid rgba(11,17,24,0.06);
        box-shadow:0 20px 50px rgba(11,17,24,0.08);
        padding:1.3rem 1.3rem
      }
      .training-side-title{font-weight:900;color:var(--brand-dark);letter-spacing:-0.01em;margin-bottom:1rem}
      .training-side-list{display:grid;gap:.7rem}
      .training-side-item{display:grid;grid-template-columns:132px 1fr;gap:1rem;align-items:start;
        padding:.7rem .75rem;border-radius:14px;
        background:rgba(31,143,74,0.04);
        border:1px solid rgba(31,143,74,0.10)
      }
      .training-side-label{color:rgba(15,93,42,0.72);font-weight:900;
        letter-spacing:.12em;text-transform:uppercase;font-size:.74rem
      }
      .training-side-value{color:#223026;font-weight:750;line-height:1.55}
      .training-perks{display:grid;gap:.55rem}
      .training-perk{position:relative;padding-left:18px;color:#223026}
      .training-perk::before{content:'';position:absolute;left:0;top:.55em;width:7px;height:7px;border-radius:999px;
        background:var(--brand-green);box-shadow:0 0 0 3px rgba(31,143,74,0.16)
      }

      .training-video-list{display:grid;gap:1rem}
      .training-video-item{display:grid;grid-template-columns:1.2fr 1fr;gap:1rem;align-items:start;
        padding:1rem;border-radius:16px;
        background:linear-gradient(180deg, rgba(31,143,74,0.03), #fff);
        border:1px solid rgba(11,17,24,0.06);
        box-shadow:0 18px 44px rgba(11,17,24,0.06)
      }
      .training-video-item video{width:100%;height:260px;display:block;border-radius:14px;
        background:#000;object-fit:contain
      }
      .training-video-body{padding:.2rem 0}
      .training-video-kicker{font-size:.74rem;font-weight:900;letter-spacing:.12em;
        text-transform:uppercase;color:rgba(15,93,42,0.72)
      }
      .training-video-desc{color:#2a3a30;line-height:1.7;margin-top:.5rem}
      @media (max-width:991px){
        .training-video-item{grid-template-columns:1fr}
        .training-video-item video{height:220px}
      }

      .training-cta-card{border-radius:18px;
        padding:1.15rem 1.15rem;
        background:linear-gradient(180deg, rgba(31,143,74,0.06), rgba(255,255,255,0.96));
        border:1px solid rgba(31,143,74,0.14);
        box-shadow:0 24px 60px rgba(11,17,24,0.08)
      }
      .training-cta-title{font-weight:900;color:var(--brand-dark);letter-spacing:-0.01em}
      .training-cta-sub{color:#516456;line-height:1.65;margin-top:.25rem}

      /* Training registration modal (compact multi-step) */
      .modal-backdrop{
        --bs-backdrop-bg: #0b1118;
        --bs-backdrop-opacity: .78;
      }
      @supports ((backdrop-filter: blur(8px)) or (-webkit-backdrop-filter: blur(8px))){
        .modal-backdrop.show{backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px)}
      }

      .training-register-modal .modal-content{
        background:linear-gradient(180deg,
          color-mix(in srgb, #ffffff 92%, var(--brand-green) 8%),
          #ffffff
        );
        border:1px solid rgba(31,143,74,0.18);
      }
      .training-register-modal .progress{background:rgba(31,143,74,0.12)}
      .training-register-modal .progress-bar{background:linear-gradient(90deg,var(--brand-green),var(--brand-dark))}
      .training-register-modal .btn,
      .training-register-success .btn{border-radius:12px;font-weight:900}

      .training-register-avatar{
        width:72px;height:72px;border-radius:999px;overflow:hidden;
        display:grid;place-items:center;position:relative;flex:0 0 auto;
        background:
          radial-gradient(closest-side at 30% 25%, rgba(31,143,74,0.18), transparent 62%),
          linear-gradient(180deg, rgba(31,143,74,0.06), rgba(255,255,255,0.95));
        border:1px solid rgba(31,143,74,0.18);
        box-shadow:0 18px 40px rgba(11,17,24,0.10);
      }
      .training-register-avatar img{width:100%;height:100%;object-fit:cover;display:none}
      .training-register-avatar.has-photo img{display:block}
      .training-register-avatar.has-photo .training-register-avatar-placeholder{display:none}
      .training-register-avatar--lg{width:88px;height:88px}
      .training-register-avatar-placeholder{
        font-weight:900;font-size:.74rem;letter-spacing:.06em;
        color:rgba(15,93,42,0.72);text-transform:uppercase
      }

      .training-register-success .modal-content{
        background:linear-gradient(180deg,
          color-mix(in srgb, #ffffff 92%, var(--brand-green) 8%),
          #ffffff
        );
        border:1px solid rgba(31,143,74,0.18);
      }

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
      /* Footer — premium, stable (no movement) */
      .site-footer{flex:0 0 auto}
      .footer-main{
        position:relative;isolation:isolate;color:#fff;
        background:linear-gradient(180deg,
          color-mix(in srgb, var(--brand-dark) 92%, black 8%),
          color-mix(in srgb, var(--brand-dark) 82%, black 18%)
        );
        border-top:1px solid rgba(255,255,255,0.10);
        padding:1.7rem 0 1.15rem;
        overflow:hidden;
      }
      .footer-main::before{
        content:'';position:absolute;inset:-12%;z-index:-1;pointer-events:none;
        background:
          radial-gradient(closest-side at 18% 30%, rgba(31,143,74,0.30), transparent 62%),
          radial-gradient(closest-side at 86% 26%, rgba(31,143,74,0.18), transparent 60%);
        opacity:.82;
        animation:footerGlow 8.5s ease-in-out infinite;
      }
      @keyframes footerGlow{0%,100%{opacity:.72}50%{opacity:.92}}
      .footer-brand{font-weight:900;display:flex;align-items:center;gap:.8rem}
      .footer-brand img{height:34px;width:34px;border-radius:10px;
        background:rgba(255,255,255,0.10);
        border:1px solid rgba(255,255,255,0.16)
      }
      .footer-tagline{color:rgba(255,255,255,0.86);line-height:1.6;max-width:44ch;font-size:.95rem}
      .footer-title{font-size:.74rem;font-weight:900;letter-spacing:.12em;text-transform:uppercase;
        color:rgba(255,255,255,0.78);margin-bottom:.65rem
      }
      .footer-link{position:relative;display:block;
        color:rgba(255,255,255,0.90);text-decoration:none;
        padding:.28rem .55rem .28rem 1.2rem;
        border-radius:12px;
        border:1px solid transparent;
        font-size:.95rem;
        transition:background .22s ease, border-color .22s ease, color .22s ease, box-shadow .22s ease
      }
      .footer-link::before{
        content:'';position:absolute;left:.55rem;top:50%;transform:translateY(-50%) scale(.7);
        width:6px;height:6px;border-radius:999px;background:var(--brand-green);
        opacity:0;transition:opacity .22s ease, transform .22s ease
      }
      .footer-link:hover{color:#fff;text-decoration:none;
        background:rgba(255,255,255,0.08);
        border-color:rgba(255,255,255,0.16);
        box-shadow:0 16px 44px rgba(11,17,24,0.20)
      }
      .footer-link:hover::before{opacity:1;transform:translateY(-50%) scale(1)}
      .footer-link:focus-visible{outline:none;
        background:rgba(255,255,255,0.08);
        border-color:rgba(255,255,255,0.18);
        box-shadow:0 0 0 .22rem rgba(31,143,74,0.28), 0 16px 44px rgba(11,17,24,0.18)
      }
      .footer-meta{color:rgba(255,255,255,0.80);font-size:.9rem;line-height:1.65}

      .footer-panel{border-radius:14px;padding:.95rem .95rem;
        background:rgba(255,255,255,0.06);
        border:1px solid rgba(255,255,255,0.14);
        transition:background .22s ease, border-color .22s ease
      }
      .footer-panel:hover{background:rgba(255,255,255,0.08);border-color:rgba(255,255,255,0.18)}
      .footer-newsletter .form-control{border:1px solid rgba(255,255,255,0.28);background:rgba(255,255,255,0.10);color:#fff}
      .footer-newsletter .form-control::placeholder{color:rgba(255,255,255,0.72)}
      .footer-newsletter .form-control:focus{border-color:rgba(255,255,255,0.40);box-shadow:0 0 0 .2rem rgba(31,143,74,0.22)}
      /* Footer buttons — premium hover (no layout shift) */
      .footer-newsletter .btn{
        position:relative;isolation:isolate;overflow:hidden;
        border:1px solid rgba(255,255,255,0.24);
        font-weight:850;
        letter-spacing:.01em;
        transition:box-shadow .22s ease, filter .22s ease;
      }
      .footer-newsletter .btn::before{
        content:'';position:absolute;inset:-2px;z-index:-1;pointer-events:none;
        background:linear-gradient(120deg,
          transparent 0%,
          rgba(31,143,74,0.25) 28%,
          rgba(255,255,255,0.65) 50%,
          rgba(31,143,74,0.25) 72%,
          transparent 100%
        );
        transform:translateX(-140%);
        opacity:0;
        transition:transform .8s cubic-bezier(.2,.9,.2,1), opacity .2s ease;
      }
      .footer-newsletter .btn:hover{box-shadow:0 18px 48px rgba(11,17,24,0.20);filter:brightness(1.02)}
      .footer-newsletter .btn:hover::before{transform:translateX(140%);opacity:1}
      .footer-newsletter .btn:focus-visible{box-shadow:0 0 0 .22rem rgba(31,143,74,0.30), 0 18px 48px rgba(11,17,24,0.18)}

      .footer-social a{position:relative;isolation:isolate;overflow:hidden}
      .footer-social a::before{
        content:'';position:absolute;inset:-10px;z-index:-1;pointer-events:none;
        background:radial-gradient(closest-side at 50% 50%, rgba(31,143,74,0.30), transparent 62%);
        opacity:0;transform:scale(.92);
        transition:opacity .22s ease, transform .22s ease;
      }
      .footer-social a svg{transition:transform .22s ease}
      .footer-social a:hover{box-shadow:0 18px 46px rgba(11,17,24,0.22)}
      .footer-social a:hover::before{opacity:1;transform:scale(1)}
      .footer-social a:hover svg{transform:scale(1.06)}
      .footer-note{color:rgba(255,255,255,0.80);font-size:.86rem}

      .footer-bottom{background:linear-gradient(90deg,var(--brand-green),var(--brand-dark));color:#fff;
        border-top:1px solid rgba(255,255,255,0.10);padding:.8rem 0
      }
      .footer-bottom{background-size:180% 180%;animation:footerGradient 18s ease-in-out infinite}
      @keyframes footerGradient{0%,100%{background-position:0% 50%}50%{background-position:100% 50%}}
      .footer-bottom-inner{display:flex;align-items:center;justify-content:space-between;gap:.75rem;flex-wrap:wrap}
      .footer-small{color:rgba(255,255,255,0.92);font-size:.95rem}
      .footer-legal{display:flex;gap:.6rem;align-items:center;flex-wrap:wrap}
      .footer-legal a{color:rgba(255,255,255,0.95);text-decoration:none;
        padding:.2rem .55rem;border-radius:999px;
        border:1px solid transparent;
        transition:background .22s ease, border-color .22s ease, box-shadow .22s ease
      }
      .footer-legal a:hover{color:#fff;text-decoration:none;
        background:rgba(255,255,255,0.10);
        border-color:rgba(255,255,255,0.16);
        box-shadow:0 16px 44px rgba(11,17,24,0.18)
      }
      .footer-legal a:focus-visible{outline:none;
        background:rgba(255,255,255,0.10);
        border-color:rgba(255,255,255,0.18);
        box-shadow:0 0 0 .22rem rgba(31,143,74,0.26), 0 16px 44px rgba(11,17,24,0.18)
      }
      .footer-social{display:flex;gap:.5rem;align-items:center}
      .footer-social a{display:inline-flex;align-items:center;justify-content:center;
        width:34px;height:34px;border-radius:12px;
        background:rgba(255,255,255,0.10);
        border:1px solid rgba(255,255,255,0.16);
        transition:background .22s ease, border-color .22s ease
      }
      .footer-social a:hover{background:rgba(255,255,255,0.14);border-color:rgba(255,255,255,0.24)}

      @media (max-width:767px){
        .footer-bottom-inner{justify-content:center;text-align:center}
        .footer-social{justify-content:center}
      }

      /* Featured card (home) */
      .featured-gallery{position:relative}
      .featured-gallery::before{content:'';position:absolute;inset:0;pointer-events:none;
        background:linear-gradient(180deg,rgba(31,143,74,0.06),rgba(31,143,74,0.00) 62%)
      }
      .featured-gallery .container,
      .featured-gallery .container-fluid{position:relative;z-index:1}
      .featured-copy{max-width:560px}
      .featured-card{border-radius:18px;overflow:hidden;background:#fff;box-shadow:0 20px 40px rgba(11,17,24,0.06);
        border:1px solid rgba(11,17,24,0.06)
      }
      .featured-media{aspect-ratio:16/10;width:100%;background:#f7faf7;display:block}
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
      .featured-gallery h2{font-size:1.95rem;font-weight:900;letter-spacing:-0.02em;line-height:1.12}
      .featured-gallery p{color:#495b4a;line-height:1.65}
      .feature-link{display:inline-block;color:var(--brand-dark);font-weight:600;font-size:.92rem;text-decoration:none;margin-top:.45rem}
      .feature-link:hover{text-decoration:underline;color:color-mix(in srgb, var(--brand-dark) 85%, black 15%)}

      /* Featured gallery — feature grid (scoped) */
      .featured-gallery .feature-list{display:grid;grid-template-columns:1fr;gap:.75rem}
      .featured-gallery .feature-list li{margin:0;border-radius:14px;
        padding:.85rem 1rem .85rem 2.15rem;
        background:rgba(31,143,74,0.05);
        border:1px solid rgba(31,143,74,0.14)
      }
      .featured-gallery .feature-list li::before{left:.95rem;top:1.05rem}
      @media (min-width:768px){
        .featured-gallery .feature-list{grid-template-columns:repeat(2,minmax(0,1fr))}
        .featured-gallery .feature-list li:nth-child(3){grid-column:1 / -1}
      }

      /* Featured empty state */
      .featured-card--empty{min-height:340px;display:flex;align-items:center;justify-content:center;
        background:
          radial-gradient(closest-side at 18% 22%, rgba(31,143,74,0.18), transparent 66%),
          radial-gradient(closest-side at 82% 18%, rgba(31,143,74,0.12), transparent 62%),
          linear-gradient(180deg, rgba(31,143,74,0.06), rgba(255,255,255,0.96));
      }
      .featured-empty{max-width:380px;padding:2.1rem 1.7rem}
      .featured-empty-icon{width:60px;height:60px;border-radius:18px;display:inline-flex;align-items:center;justify-content:center;
        background:rgba(31,143,74,0.10);
        border:1px solid rgba(31,143,74,0.16);
        font-size:1.65rem
      }
      .featured-card--empty h3{color:var(--brand-dark);font-weight:900;letter-spacing:-0.01em}

      /* Featured hover & sizing */
      .featured-card{transition:transform .45s cubic-bezier(.2,.9,.2,1),box-shadow .45s}
      .featured-card:hover{transform:translateY(-8px);box-shadow:0 28px 60px rgba(11,17,24,0.12)}
      .featured-card .featured-img{transition:transform .7s cubic-bezier(.2,.9,.2,1)}
      .featured-card:hover .featured-img{transform:scale(1.04)}
      .featured-card{width:100%;max-width:600px}

      @media (prefers-reduced-motion: reduce){
        .hero::after{animation:none}
        .hero-float{animation:none}
        .emoji-twinkle{animation:none}
        .footer-main::before{animation:none}
        .footer-bottom{animation:none}
        .footer-newsletter .btn, .footer-social a, .footer-social a svg{transition:none}
        .footer-newsletter .btn::before, .footer-social a::before{transition:none}
        .footer-link, .footer-link::before, .footer-legal a{transition:none}
        .course-card, .course-media img, .course-chip, .partner-tile, .partner-logo, .trainings-tab{transition:none}
        .course-card::after, .partner-tile::after, .trainings-tab::after{transition:none;opacity:0}
        .training-hero-back{transition:none}
        .training-hero-bg-video{transition:none}
        .training-thumb img, .training-thumb video{transition:none}
        .shop-product-card, .shop-product-media img, .shop-add-btn{transition:none}
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand site-nav">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="/">
          <span class="brand-mark" aria-hidden="true">
            <img src="/assets/quisolideo-logo.png" alt="" style="height:28px;width:28px;object-fit:contain">
          </span>
          <span class="ms-2 text-white fw-bold brand-text">Quisolideo</span>
        </a>
        <div class="ms-auto d-flex align-items-center site-nav-links">
          <a class="site-nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}">Accueil</a>
          <a class="site-nav-link {{ request()->routeIs('trainings.*') ? 'is-active' : '' }}" href="{{ route('trainings.index') }}">Formations</a>
          <a class="site-nav-link {{ request()->routeIs('partners.*') ? 'is-active' : '' }}" href="{{ route('partners.index') }}">Partenaires</a>
          <a class="site-nav-link nav-boutique {{ (request()->routeIs('shop.*') || request()->routeIs('cart.*') || request()->routeIs('checkout.*')) ? 'is-active' : '' }}" href="{{ route('shop.index') }}">Boutique</a>
          @auth
            <a class="site-nav-link {{ request()->routeIs('account.*') ? 'is-active' : '' }}" href="{{ route('account.profile') }}">Profil</a>
          @else
            <a class="site-nav-link {{ (request()->routeIs('login') || request()->routeIs('register')) ? 'is-active' : '' }}" href="{{ route('login') }}">Connexion</a>
          @endauth
          <a class="site-nav-link nav-contact {{ request()->routeIs('contact') ? 'is-active' : '' }}" href="{{ route('contact') }}">Contact</a>
        </div>
      </div>
    </nav>
    <main class="page-content">
      @yield('content')
    </main>

    <footer class="site-footer">
      <div class="footer-main">
        <div class="container px-3 px-md-4">
          <div class="row g-3 align-items-start">
            <div class="col-12 col-lg-4">
              <div class="footer-panel h-100">
                <div class="footer-brand">
                  <img src="/assets/quisolideo-logo.png" alt="Quisolideo">
                  <div>
                    <div class="h6 mb-1">Quisolideo</div>
                    <div class="footer-tagline">Formations, mentorat et ressources — pour passer de l’idée à l’action. 🚀</div>
                  </div>
                </div>
                <div class="mt-3 footer-meta">Adresse : BP 1234, Ville</div>
              </div>
            </div>

            <div class="col-6 col-lg-2">
              <div class="footer-title">Découvrir</div>
              <a class="footer-link" href="{{ route('home') }}">Accueil</a>
              <a class="footer-link" href="{{ route('trainings.index') }}">Formations</a>
              <a class="footer-link" href="{{ route('partners.index') }}">Partenaires</a>
              <a class="footer-link" href="{{ route('gallery') }}">Galerie</a>
            </div>

            <div class="col-6 col-lg-2">
              <div class="footer-title">Boutique</div>
              <a class="footer-link" href="{{ route('shop.index') }}">Voir les catégories</a>
              <a class="footer-link" href="{{ route('cart.show') }}">Panier</a>
              @auth
                <a class="footer-link" href="{{ route('account.profile') }}">Profil</a>
              @else
                <a class="footer-link" href="{{ route('login') }}">Connexion</a>
              @endauth
              <a class="footer-link" href="{{ route('contact') }}">Aide & contact</a>
            </div>

            <div class="col-12 col-lg-4">
              <div class="footer-title">Newsletter <span class="emoji-twinkle" aria-hidden="true">✨</span></div>
              <div class="footer-note mb-2">Des idées, des outils et des opportunités utiles — 1 à 2 emails/mois. 📩</div>

              <div class="footer-newsletter footer-panel">
                <form method="POST" action="{{ route('newsletter.store') }}">
                  @csrf
                  <div class="input-group input-group-sm">
                    <input type="email" name="newsletter_email" class="form-control" placeholder="Votre email" value="{{ old('newsletter_email') }}" autocomplete="email" required>
                    <button class="btn btn-light" type="submit">S’inscrire</button>
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
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <div class="container px-3 px-md-4">
          <div class="footer-bottom-inner">
            <div class="footer-small">© {{ date('Y') }} Quisolideo — Tous droits réservés.</div>

            <div class="footer-legal footer-small">
              <a href="{{ route('contact') }}">Contact</a>
              <span aria-hidden="true">·</span>
              <a href="/mentions">Mentions légales</a>
              <span aria-hidden="true">·</span>
              <a href="/politique">Politique</a>
            </div>

            <div class="footer-social" aria-label="Réseaux sociaux">
              <a href="#" aria-label="Facebook">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07C2 17.06 5.66 21.2 10.44 21.95v-7.01H7.9v-2.9h2.54V9.41c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.23.2 2.23.2v2.45h-1.25c-1.23 0-1.61.77-1.61 1.56v1.87h2.74l-.44 2.9h-2.3V21.95C18.34 21.2 22 17.06 22 12.07z" fill="#fff"/></svg>
              </a>
              <a href="#" aria-label="Instagram">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm5 7.3A4.7 4.7 0 1 0 16.7 14 4.7 4.7 0 0 0 12 9.3zM18.6 6.5a1.1 1.1 0 1 0 1.1 1.1 1.1 1.1 0 0 0-1.1-1.1z" fill="#fff"/></svg>
              </a>
              <a href="#" aria-label="Twitter">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 5.92c-.63.28-1.3.48-2 .57a3.42 3.42 0 0 0 1.5-1.88 6.8 6.8 0 0 1-2.16.83A3.4 3.4 0 0 0 12.6 8.3a9.66 9.66 0 0 1-7-3.55 3.4 3.4 0 0 0 1.05 4.55c-.52 0-1.02-.16-1.45-.4 0 1.39.97 2.56 2.28 2.83a3.4 3.4 0 0 1-1.53.06c.43 1.35 1.68 2.33 3.16 2.36A6.85 6.85 0 0 1 4 18.2a9.66 9.66 0 0 0 5.22 1.53c6.26 0 9.69-5.18 9.69-9.68v-.44c.66-.46 1.22-1.04 1.66-1.7-.6.27-1.25.45-1.92.53z" fill="#fff"/></svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function(){
        const nav = document.querySelector('.site-nav');
        if(nav){
          const setNavState = ()=>nav.classList.toggle('scrolled', window.scrollY > 8);
          setNavState();
          window.addEventListener('scroll', setNavState, {passive:true});
        }

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

    <script>
      // shop: add to cart without redirect
      document.addEventListener('DOMContentLoaded', function () {
        const forms = Array.from(document.querySelectorAll('form[data-add-to-cart]'));
        if (!forms.length) return;

        forms.forEach((form) => {
          form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const btn = form.querySelector('button[type="submit"]');
            const original = btn ? btn.innerHTML : '';
            if (btn) {
              btn.disabled = true;
              btn.innerHTML = '…';
            }

            try {
              const res = await fetch(form.action, {
                method: 'POST',
                headers: {
                  'X-Requested-With': 'XMLHttpRequest',
                  'Accept': 'application/json',
                },
                body: new FormData(form),
              });

              if (!res.ok) {
                throw new Error('add_to_cart_failed');
              }

              if (btn) {
                btn.innerHTML = '✓';
                setTimeout(() => {
                  btn.disabled = false;
                  btn.innerHTML = original;
                }, 900);
              }
            } catch (err) {
              if (btn) {
                btn.disabled = false;
                btn.innerHTML = original;
              }
              alert('Impossible d\'ajouter au panier.');
            }
          });
        });
      });
    </script>
  </body>
</html>
