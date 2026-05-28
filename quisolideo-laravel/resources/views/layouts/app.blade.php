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
      html, body{max-width:100%;overflow-x:hidden}
      body{font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        min-height:100vh;display:flex;flex-direction:column
      }
      .page-content{flex:1 0 auto;overflow-x:clip}
      .navbar-brand img{height:36px}

      /* Header / Navbar */
      .site-nav{
        position:sticky;top:0;z-index:1040;
        padding:.68rem 0;
        color:#fff;
        border-bottom:1px solid rgba(255,255,255,0.12);
        background:
          linear-gradient(180deg,
            color-mix(in srgb, var(--brand-green) 90%, black 10%),
            color-mix(in srgb, var(--brand-dark) 88%, black 12%)
          );
        transition:padding .28s ease, box-shadow .28s ease, border-color .28s ease, background .28s ease;
      }
      .site-nav.scrolled{
        padding:.68rem 0;
        border-bottom-color:rgba(255,255,255,0.12);
        box-shadow:none;
      }
      @supports ((backdrop-filter: blur(10px)) or (-webkit-backdrop-filter: blur(10px))){
        .site-nav{
          background:linear-gradient(180deg,
            color-mix(in srgb, var(--brand-green) 84%, transparent 16%),
            color-mix(in srgb, var(--brand-dark) 80%, transparent 20%)
          );
          backdrop-filter:blur(14px);
          -webkit-backdrop-filter:blur(14px);
        }
      }

      .site-nav .navbar-brand{display:flex;align-items:center;gap:.7rem;color:#fff;text-decoration:none}
      .site-nav .navbar-brand:hover{color:#fff}
      .site-nav .brand-mark{display:inline-flex;align-items:center;justify-content:center;
        width:72px;height:46px;border-radius:14px;
        padding:.2rem .35rem;
        background:rgba(255,255,255,0.96);
        border:1px solid rgba(255,255,255,0.65);
        box-shadow:0 18px 46px rgba(11,17,24,0.18);
        transition:background .2s ease, border-color .2s ease;
      }
      .site-nav .navbar-brand:hover .brand-mark{background:#fff;border-color:rgba(255,255,255,0.9)}
      .site-nav .brand-logo{
        width:52px;
        height:34px;
        object-fit:contain;
        display:block;
      }
      .site-nav .brand-text{display:flex;flex-direction:column;line-height:1.1}
      .site-nav .brand-title{font-size:1.04rem;font-weight:900;letter-spacing:.01em}
      .site-nav .brand-subtitle{font-size:.72rem;font-weight:650;color:rgba(255,255,255,0.82)}

      .site-nav .navbar-toggler{
        width:44px;height:44px;padding:0;
        border:1px solid rgba(255,255,255,0.26);
        border-radius:12px;
        background:rgba(255,255,255,0.08);
        box-shadow:0 16px 40px rgba(11,17,24,0.16);
      }
      .site-nav .navbar-toggler:focus{box-shadow:0 0 0 .2rem rgba(255,255,255,0.24)}
      .site-nav .navbar-toggler-icon{
        width:18px;height:2px;background:#fff;position:relative;display:inline-block;
        border-radius:999px;vertical-align:middle;
      }
      .site-nav .navbar-toggler-icon::before,
      .site-nav .navbar-toggler-icon::after{
        content:'';position:absolute;left:0;width:18px;height:2px;background:#fff;border-radius:999px;
      }
      .site-nav .navbar-toggler-icon::before{top:-6px}
      .site-nav .navbar-toggler-icon::after{top:6px}

      .site-nav .site-nav-links{display:flex;align-items:center;gap:.3rem}
      .site-nav .site-nav-link{
        color:rgba(255,255,255,0.92);
        padding:.5rem .82rem;
        border-radius:999px;
        border:1px solid transparent;
        font-weight:800;
        text-decoration:none;
        line-height:1.2;
        transition:background .2s ease, color .2s ease, border-color .2s ease;
      }
      .site-nav .site-nav-link:hover{color:#fff;background:rgba(255,255,255,0.1)}
      .site-nav .site-nav-link.is-active{color:#fff;background:rgba(255,255,255,0.14);border-color:rgba(255,255,255,0.2)}
      .site-nav.site-nav--admin,
      .site-nav.site-nav--admin.scrolled{
        position:fixed;
        left:0;
        right:0;
        padding:.58rem 0;
        top:0;
        z-index:1100;
      }

      .site-nav .site-nav-actions{display:flex;align-items:center;gap:.5rem}
      .site-nav .nav-boutique{
        background:linear-gradient(90deg,var(--brand-green),var(--brand-dark));
        border:1px solid rgba(255,255,255,0.22);
        box-shadow:0 18px 50px rgba(11,17,24,0.16);
      }
      .site-nav .nav-boutique:hover{background:linear-gradient(90deg,
        color-mix(in srgb, var(--brand-green) 90%, white 10%),
        color-mix(in srgb, var(--brand-dark) 90%, white 10%)
      )}
      .site-nav .nav-contact{background:rgba(255,255,255,0.06);border-color:rgba(255,255,255,0.32)}
      .site-nav .nav-contact:hover{background:rgba(255,255,255,0.14);border-color:rgba(255,255,255,0.42)}
      .site-nav .nav-login-icon{
        width:40px;
        height:40px;
        padding:0;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        border-radius:12px;
        background:rgba(255,255,255,0.08);
        border-color:rgba(255,255,255,0.34);
      }
      .site-nav .nav-login-icon svg{display:block}
      .site-nav .nav-login-icon:hover{background:rgba(255,255,255,0.16);border-color:rgba(255,255,255,0.44)}

      @media (max-width:991px){
        .site-nav{padding:.55rem 0}
        .site-nav .brand-subtitle{display:none}
        .site-nav .brand-mark{width:66px;height:42px;padding:.18rem .3rem}
        .site-nav .brand-logo{width:48px;height:30px}
        .site-nav .navbar-collapse{
          margin-top:.7rem;
          padding:.85rem;
          border-radius:16px;
          border:1px solid rgba(255,255,255,0.16);
          background:rgba(8,15,22,0.32);
          box-shadow:0 24px 66px rgba(11,17,24,0.22);
        }
        .site-nav .site-nav-links{flex-direction:column;align-items:stretch;gap:.35rem}
        .site-nav .site-nav-link{display:block;width:100%;padding:.68rem .82rem}
        .site-nav .site-nav-actions{margin-top:.5rem;padding-top:.65rem;border-top:1px solid rgba(255,255,255,0.12);display:grid;grid-template-columns:1fr;gap:.45rem}
        .site-nav .site-nav-link.nav-login-icon{width:44px;padding:.62rem 0;justify-self:start}
      }

      @media (min-width:992px){
        .site-nav .navbar-collapse{display:flex!important;align-items:center;gap:.8rem}
      }

      @media (prefers-reduced-motion: reduce){
        .site-nav, .site-nav *{transition:none!important}
      }

      .corner-actions{
        position:fixed;
        top:86px;
        right:16px;
        z-index:1035;
        display:flex;
        align-items:center;
        gap:.52rem;
      }
      .corner-link{
        position:relative;
        display:inline-flex;
        align-items:center;
        gap:.42rem;
        padding:.46rem .72rem;
        border-radius:999px;
        text-decoration:none;
        background:#fff;
        border:1px solid rgba(31,143,74,0.18);
        color:var(--brand-dark);
        font-weight:850;
        font-size:.84rem;
        box-shadow:0 18px 44px rgba(11,17,24,0.12);
        transition:transform .22s ease, box-shadow .22s ease, border-color .22s ease;
      }
      .corner-link:hover{
        transform:translateY(-2px);
        border-color:rgba(31,143,74,0.32);
        box-shadow:0 20px 46px rgba(11,17,24,0.16);
      }
      .corner-link-icon{
        width:20px;
        height:20px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        border-radius:50%;
        background:rgba(31,143,74,0.12);
        color:var(--brand-dark);
      }
      .corner-link.is-active{border-color:rgba(31,143,74,0.42)}
      .corner-link--cart{border-color:rgba(15,93,42,0.24)}
      .corner-link--cart .corner-link-icon{background:rgba(15,93,42,0.14)}
      @media (max-width:991.98px){
        .corner-actions{top:76px;right:12px;gap:.4rem}
        .corner-link{padding:.4rem .5rem}
        .corner-link-label{display:none}
      }

      @media (prefers-reduced-motion: reduce){
        .corner-link{transition:none}
      }

      /* Admin */
      .admin-shell{max-width:1120px}
      .admin-page-head{
        display:flex;
        align-items:flex-start;
        justify-content:space-between;
        gap:.9rem;
        flex-wrap:wrap;
      }
      .admin-eyebrow{
        font-size:.74rem;
        font-weight:900;
        text-transform:uppercase;
        letter-spacing:.13em;
        color:rgba(15,93,42,0.75);
      }
      .admin-title{
        margin:0;
        font-size:clamp(1.26rem,2.2vw,1.8rem);
        line-height:1.15;
        color:var(--brand-dark);
        font-weight:900;
        letter-spacing:-.01em;
      }
      .admin-sub{color:#506456;line-height:1.55}
      .admin-card,
      .admin-kpi-card,
      .admin-action-card,
      .admin-list-item,
      .admin-empty{
        border-radius:16px;
        background:#fff;
        border:1px solid rgba(31,143,74,0.14);
        box-shadow:0 16px 42px rgba(11,17,24,0.06);
      }
      .admin-kpi-card{padding:.9rem .95rem}
      .admin-kpi-card p{margin:0;color:#5b6e61;font-size:.8rem;font-weight:700}
      .admin-kpi-card strong{display:block;color:var(--brand-dark);font-size:1.34rem;font-weight:900;line-height:1.1;margin-top:.2rem}
      .admin-action-card{padding:1rem 1rem}
      .admin-action-card h2,
      .admin-list-item h2,
      .admin-card-title{
        margin:0;
        font-size:1rem;
        color:var(--brand-dark);
        font-weight:900;
      }
      .admin-action-card p,
      .admin-list-item p{
        margin:.28rem 0 0;
        color:#55685b;
        line-height:1.55;
      }
      .admin-list{display:grid;gap:.7rem}
      .admin-list-item{
        padding:.85rem .9rem;
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:.8rem;
      }
      .admin-empty{padding:1rem;color:#55685b}
      .admin-actions-inline{display:flex;align-items:center;gap:.42rem;flex-wrap:wrap}
      .admin-filter{display:flex;align-items:center;gap:.55rem;flex-wrap:wrap}
      .admin-filter .form-control{max-width:360px}
      .admin-filter .form-select{max-width:220px}
      .admin-filter--wide .form-control{max-width:320px}
      .admin-pill-btn{border-radius:999px;font-weight:800;padding:.33rem .66rem}
      .admin-thumb{
        width:54px;
        height:54px;
        object-fit:cover;
        border-radius:12px;
        border:1px solid rgba(31,143,74,0.12);
      }
      .admin-thumb--empty{display:inline-block;background:rgba(31,143,74,0.08)}
      .admin-data-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:.75rem}
      .admin-data-grid span{display:block;font-size:.75rem;text-transform:uppercase;letter-spacing:.08em;color:#698072;font-weight:800}
      .admin-data-grid strong{display:block;color:#213126;line-height:1.5;font-size:.95rem}
      .admin-subtitle{margin:0;color:var(--brand-dark);font-size:.92rem;font-weight:850}
      .admin-note-block{margin-top:.5rem;white-space:pre-wrap;line-height:1.68;color:#243429}
      .admin-preview-image{
        width:220px;
        max-width:100%;
        max-height:150px;
        object-fit:cover;
        border-radius:12px;
        border:1px solid rgba(31,143,74,0.16);
      }
      .admin-preview-image--contain{object-fit:contain;background:#fff}
      .admin-gallery-thumbs{display:flex;flex-wrap:wrap;gap:.4rem}
      .admin-gallery-thumbs img{
        width:90px;
        height:70px;
        border-radius:10px;
        object-fit:cover;
        border:1px solid rgba(31,143,74,0.14);
      }
      .admin-media-item{
        display:grid;
        grid-template-columns:220px 1fr;
        gap:.8rem;
        padding:.65rem;
        border:1px solid rgba(31,143,74,0.14);
        border-radius:12px;
        background:linear-gradient(180deg, rgba(31,143,74,0.03), #fff);
      }
      .admin-media-item video{
        width:100%;
        height:130px;
        border-radius:10px;
        background:#000;
        object-fit:cover;
      }
      .admin-workspace{
        display:grid;
        grid-template-columns:260px minmax(0,1fr);
        gap:1rem;
        align-items:start;
      }
      .admin-sidebar{
        position:sticky;
        top:88px;
        border-radius:18px;
        border:1px solid rgba(31,143,74,0.16);
        background:linear-gradient(180deg, #ffffff, #f8fcf9);
        box-shadow:0 18px 44px rgba(11,17,24,0.08);
        padding:.92rem;
      }
      .admin-sidebar-head{padding:.2rem .2rem .7rem}
      .admin-sidebar-user{font-size:.84rem;color:#5a6e61}
      .admin-sidebar-user strong{display:block;color:var(--brand-dark);font-weight:900;line-height:1.25}
      .admin-sidebar-menu{display:grid;gap:.32rem;margin-top:.4rem}
      .admin-sidebar-link{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:.6rem;
        text-decoration:none;
        color:#304337;
        font-weight:800;
        font-size:.9rem;
        border-radius:12px;
        border:1px solid transparent;
        padding:.52rem .62rem;
        transition:all .2s ease;
      }
      .admin-sidebar-link:hover{
        color:var(--brand-dark);
        border-color:rgba(31,143,74,0.2);
        background:rgba(31,143,74,0.06);
      }
      .admin-sidebar-link.is-active{
        color:var(--brand-dark);
        border-color:rgba(31,143,74,0.3);
        background:rgba(31,143,74,0.12);
      }
      .admin-sidebar-link span:last-child{font-size:.78rem;color:#6a7e71}
      .admin-main-panel{
        border-radius:18px;
        border:1px solid rgba(31,143,74,0.14);
        background:#fff;
        box-shadow:0 18px 44px rgba(11,17,24,0.06);
        padding:1rem;
      }
      .admin-kpi-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:.7rem}
      .admin-quick-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:.7rem}
      .admin-quick-link{
        display:block;
        text-decoration:none;
        border-radius:14px;
        border:1px solid rgba(31,143,74,0.15);
        background:linear-gradient(180deg, #ffffff, #f8fcf9);
        padding:.85rem;
        color:#2e4035;
      }
      .admin-quick-link:hover{border-color:rgba(31,143,74,0.3);color:var(--brand-dark)}
      .admin-quick-link strong{display:block;font-weight:900;color:var(--brand-dark)}
      .admin-quick-link span{display:block;font-size:.86rem;color:#5a6e61;margin-top:.18rem}
      .admin-section-title{margin:0;color:var(--brand-dark);font-size:1.03rem;font-weight:900}
      .admin-entre-panel{
        background:
          radial-gradient(1200px 260px at 95% -10%, rgba(31,143,74,0.08), transparent 60%),
          radial-gradient(900px 220px at -15% 0%, rgba(15,93,42,0.06), transparent 58%),
          #fff;
      }
      .admin-entre-hero{
        display:flex;
        align-items:flex-start;
        justify-content:space-between;
        gap:1rem;
        flex-wrap:wrap;
        padding:.95rem;
        border-radius:16px;
        border:1px solid rgba(31,143,74,0.15);
        background:linear-gradient(135deg, rgba(31,143,74,0.1), rgba(255,255,255,0.96));
      }
      .admin-entre-hero-badges{display:flex;gap:.5rem;flex-wrap:wrap}
      .admin-entre-hero-badges span{
        display:inline-flex;
        align-items:center;
        padding:.35rem .62rem;
        border-radius:999px;
        font-size:.78rem;
        font-weight:800;
        color:#224234;
        border:1px solid rgba(31,143,74,0.24);
        background:rgba(255,255,255,0.84);
      }
      .admin-entre-stats-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:.72rem}
      .admin-entre-stat-card{
        display:flex;
        align-items:flex-start;
        gap:.65rem;
        border-radius:14px;
        border:1px solid rgba(31,143,74,0.15);
        background:linear-gradient(180deg, #ffffff, #f9fcfa);
        padding:.78rem;
        box-shadow:0 14px 36px rgba(11,17,24,0.05);
      }
      .admin-entre-stat-icon{
        width:34px;
        height:34px;
        border-radius:10px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        font-size:.64rem;
        font-weight:900;
        color:#134a2f;
        background:rgba(31,143,74,0.16);
        border:1px solid rgba(31,143,74,0.24);
        flex:0 0 auto;
      }
      .admin-entre-stat-body p{margin:0;color:#5b7062;font-size:.76rem;font-weight:800}
      .admin-entre-stat-body strong{display:block;margin-top:.1rem;line-height:1.1;color:var(--brand-dark);font-size:1.52rem;font-weight:900}
      .admin-entre-stat-body small{display:block;margin-top:.08rem;color:#708679;font-size:.76rem}
      .admin-entre-note{font-size:.8rem;font-weight:700;color:#5f7467}
      .admin-entre-actions-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:.72rem}
      .admin-entre-action-card{
        display:block;
        text-decoration:none;
        border-radius:14px;
        border:1px solid rgba(31,143,74,0.15);
        background:linear-gradient(180deg, #ffffff, #f8fcf9);
        box-shadow:0 14px 32px rgba(11,17,24,0.05);
        padding:.9rem;
        color:#2d4135;
        transition:transform .2s ease, border-color .2s ease, box-shadow .2s ease;
      }
      .admin-entre-action-card:hover{
        transform:translateY(-2px);
        border-color:rgba(31,143,74,0.3);
        box-shadow:0 18px 34px rgba(11,17,24,0.08);
        color:#1b3226;
      }
      .admin-entre-action-top{display:flex;align-items:center;justify-content:space-between;gap:.5rem}
      .admin-entre-action-top strong{font-size:1.05rem;color:var(--brand-dark);font-weight:900;line-height:1.2}
      .admin-entre-action-top span{font-size:.76rem;font-weight:900;color:#55786a}
      .admin-entre-action-card p{margin:.38rem 0 .55rem;color:#546a5d;line-height:1.58}
      .admin-entre-action-link{display:inline-flex;font-size:.82rem;font-weight:900;color:var(--brand-dark)}
      .admin-train-toolbar{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:.7rem;
        flex-wrap:wrap;
      }
      .admin-search-box{
        display:flex;
        align-items:center;
        gap:.46rem;
        flex-wrap:wrap;
      }
      .admin-search-field{
        width:min(460px, 100%);
        display:flex;
        align-items:center;
        gap:.5rem;
        border-radius:12px;
        border:1px solid rgba(31,143,74,0.2);
        background:#fff;
        box-shadow:0 10px 26px rgba(11,17,24,0.05);
        padding:.32rem .5rem;
      }
      .admin-search-field svg{color:#5d7868;flex:0 0 auto}
      .admin-search-field input{
        border:0!important;
        box-shadow:none!important;
        padding:.28rem .1rem;
        background:transparent;
      }
      .admin-search-field:focus-within{
        border-color:rgba(31,143,74,0.38);
        box-shadow:0 0 0 .16rem rgba(31,143,74,0.12);
      }
      .admin-add-btn{
        width:40px;
        height:40px;
        border-radius:12px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding:0;
      }
      .admin-list-item--training{
        padding:.62rem;
        transition:border-color .2s ease, box-shadow .2s ease;
        display:flex;
        flex-direction:column;
        align-items:stretch;
        justify-content:space-between;
        gap:.58rem;
        min-height:256px;
        border-radius:18px;
        overflow:hidden;
        background:linear-gradient(180deg, #ffffff, #f8fcfa);
      }
      .admin-list-item--training:hover{
        border-color:rgba(31,143,74,0.3);
        box-shadow:0 18px 36px rgba(11,17,24,0.08);
      }
      .admin-list--trainings{
        display:grid;
        grid-template-columns:repeat(3, minmax(0, 1fr));
        gap:.72rem;
      }
      .admin-training-cover{
        position:relative;
        height:108px;
        border-radius:14px;
        background:
          radial-gradient(120px 60px at 80% 10%, rgba(255,255,255,0.26), transparent 70%),
          linear-gradient(125deg, rgba(31,143,74,0.95), rgba(15,93,42,0.9));
        background-size:cover;
        background-position:center;
        border:1px solid rgba(31,143,74,0.14);
        overflow:hidden;
      }
      .admin-training-cover::after{
        content:'';
        position:absolute;
        inset:0;
        background:linear-gradient(180deg, rgba(8,20,15,0.08), rgba(8,20,15,0.26));
      }
      .admin-training-main h2{
        font-size:1.02rem;
        line-height:1.25;
        margin:0 .18rem;
        display:-webkit-box;
        -webkit-line-clamp:2;
        -webkit-box-orient:vertical;
        overflow:hidden;
      }
      .admin-training-main p{
        margin:.34rem .18rem 0;
        color:#5a6d60;
        line-height:1.44;
        display:-webkit-box;
        -webkit-line-clamp:3;
        -webkit-box-orient:vertical;
        overflow:hidden;
        font-size:.9rem;
      }
      .admin-actions-inline--training{
        justify-content:flex-end;
        padding:.42rem .12rem .02rem;
        border-top:1px solid rgba(31,143,74,0.12);
      }
      .admin-icon-btn{
        width:36px;
        height:36px;
        padding:0;
        border-radius:10px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        border:1px solid rgba(31,143,74,0.24);
        background:#fff;
        color:#2e4035;
      }
      .admin-icon-btn:hover{background:rgba(31,143,74,0.08);border-color:rgba(31,143,74,0.34);color:var(--brand-dark)}
      .admin-icon-btn--edit{background:rgba(31,143,74,0.08);border-color:rgba(31,143,74,0.34)}
      .admin-icon-btn--delete{color:#bf1d32;border-color:rgba(191,29,50,0.35)}
      .admin-icon-btn--delete:hover{background:rgba(191,29,50,0.08);border-color:rgba(191,29,50,0.5);color:#9d1226}
      .admin-global-sidebar{
        position:fixed;
        top:86px;
        left:14px;
        width:248px;
        z-index:1030;
        border-radius:16px;
        border:1px solid rgba(31,143,74,0.16);
        background:linear-gradient(180deg, #ffffff, #f7fbf8);
        box-shadow:0 20px 46px rgba(11,17,24,0.1);
        padding:.8rem;
      }
      .admin-global-head{padding:.18rem .2rem .62rem}
      .admin-global-name{display:block;color:var(--brand-dark);font-weight:900;line-height:1.2}
      .admin-global-role{display:block;color:#607468;font-size:.8rem}
      .admin-global-nav{display:grid;gap:.3rem}
      .admin-global-link{
        text-decoration:none;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:.55rem;
        color:#2f4236;
        font-size:.89rem;
        font-weight:800;
        border-radius:11px;
        border:1px solid transparent;
        padding:.5rem .6rem;
        transition:all .2s ease;
      }
      .admin-global-link:hover{
        color:var(--brand-dark);
        border-color:rgba(31,143,74,0.2);
        background:rgba(31,143,74,0.06);
      }
      .admin-global-link.is-active{
        color:var(--brand-dark);
        border-color:rgba(31,143,74,0.3);
        background:rgba(31,143,74,0.12);
      }
      .admin-global-link small{color:#6b8073;font-size:.74rem}
      .admin-global-actions{display:grid;gap:.38rem;margin-top:.65rem}
      .page-content--admin{padding-top:86px}
      .page-content--admin-entre{padding-left:278px}
      @media (max-width:767px){
        .admin-list-item{align-items:flex-start;flex-direction:column}
        .admin-actions-inline{width:100%}
        .admin-data-grid{grid-template-columns:1fr}
        .admin-filter .form-control,
        .admin-filter .form-select{max-width:none;width:100%}
        .admin-media-item{grid-template-columns:1fr}
      }
      @media (max-width:991px){
        .admin-global-sidebar{
          position:static;
          width:auto;
          margin:.75rem .75rem 0;
        }
        .admin-global-nav{display:flex;gap:.42rem;overflow-x:auto;padding-bottom:.1rem}
        .admin-global-link{flex:0 0 auto}
        .page-content--admin{padding-top:78px}
        .page-content--admin-entre{padding-left:0}
        .admin-entre-stats-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
        .admin-entre-actions-grid{grid-template-columns:1fr}
        .admin-search-field{width:100%}
        .admin-workspace{grid-template-columns:1fr}
        .admin-sidebar{
          position:static;
          padding:.72rem;
        }
        .admin-sidebar-menu{
          display:flex;
          flex-wrap:nowrap;
          overflow-x:auto;
          gap:.44rem;
          padding-bottom:.1rem;
        }
        .admin-sidebar-link{flex:0 0 auto}
        .admin-kpi-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
        .admin-quick-grid{grid-template-columns:1fr}
        .admin-list--trainings{grid-template-columns:repeat(2, minmax(0, 1fr))}
      }
      @media (max-width:575px){
        .admin-entre-stats-grid{grid-template-columns:1fr}
        .admin-list--trainings{grid-template-columns:1fr}
      }

      /* Home hero */
      .hero{
        position:relative;
        isolation:isolate;
        overflow:hidden;
        background:url('/assets/accueil.png') center 38% / cover no-repeat;
        padding:clamp(3.4rem, 7vw, 5.2rem) 0;
      }
      .hero::before{
        content:'';
        position:absolute;
        inset:0;
        z-index:0;
        background:linear-gradient(96deg, rgba(8, 33, 20, 0.82) 0%, rgba(8, 33, 20, 0.62) 45%, rgba(8, 33, 20, 0.3) 100%);
      }
      .hero::after{
        content:'';
        position:absolute;
        inset:0;
        z-index:0;
        background:radial-gradient(60% 80% at 15% 18%, rgba(31, 143, 74, 0.26) 0%, rgba(31, 143, 74, 0) 100%);
      }
      .hero-content{
        position:relative;
        z-index:2;
      }
      .hero-title{
        max-width:16ch;
        font-size:clamp(1.52rem, 2.8vw, 2.28rem);
        font-weight:900;
        line-height:1.12;
        letter-spacing:-0.02em;
        color:#fff;
        text-shadow:0 14px 38px rgba(0,0,0,0.26);
      }
      .hero-lead{
        max-width:52ch;
        color:rgba(255,255,255,0.95);
        line-height:1.58;
        font-size:.93rem;
      }
      .hero-actions .hero-btn{
        border-radius:9px;
        padding:.4rem .68rem;
        font-size:.82rem;
        font-weight:700;
        letter-spacing:.01em;
        border:1px solid transparent;
        line-height:1.25;
      }
      .hero-actions .hero-btn-primary{
        color:#103522;
        background:rgba(255,255,255,0.96);
        border-color:rgba(255,255,255,0.98);
        box-shadow:0 10px 24px rgba(11,17,24,0.14);
      }
      .hero-actions .hero-btn-primary:hover{
        color:#0b2a1b;
        background:#fff;
      }
      .hero-actions .hero-btn-secondary{
        color:#fff;
        background:rgba(9, 26, 17, 0.38);
        border-color:rgba(255,255,255,0.56);
      }
      .hero-actions .hero-btn-secondary:hover{
        color:#fff;
        background:rgba(9, 26, 17, 0.52);
        border-color:rgba(255,255,255,0.72);
      }

      /* Small twinkle emoji */
      .emoji-twinkle{display:inline-block;transform-origin:center;animation:emojiTwinkle 2.1s ease-in-out infinite}
      @keyframes emojiTwinkle{0%,100%{transform:translateY(0) rotate(0deg) scale(1);opacity:.92}50%{transform:translateY(-1px) rotate(6deg) scale(1.12);opacity:1}}

      @media (max-width:991px){
        .hero{padding:3.2rem 0}
        .hero-title{max-width:18ch}
        .hero-actions .hero-btn{padding:.38rem .62rem;font-size:.8rem}
      }

      .home-section-title{
        color:var(--brand-dark);
        font-size:clamp(1.35rem, 2.4vw, 2rem);
        font-weight:900;
        line-height:1.15;
        letter-spacing:-0.01em;
      }
      .home-section-copy{
        color:#495e4f;
        line-height:1.7;
        max-width:58ch;
      }
      .home-value-grid{display:grid;gap:.85rem}
      .home-value-card{
        border-radius:15px;
        padding:.9rem .95rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 14px 34px rgba(11,17,24,0.06);
      }
      .home-value-card h3{
        margin:0 0 .25rem;
        color:var(--brand-dark);
        font-size:1.02rem;
        font-weight:850;
      }
      .home-value-card p{margin:0;color:#506456;line-height:1.6}

      .home-path-card{
        border-radius:16px;
        padding:1.05rem 1.05rem;
        background:linear-gradient(180deg,#fff,#f8fcf9);
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 16px 40px rgba(11,17,24,0.06);
      }
      .home-path-kicker{
        display:inline-flex;
        align-items:center;
        padding:.22rem .56rem;
        border-radius:999px;
        background:rgba(31,143,74,0.1);
        border:1px solid rgba(31,143,74,0.2);
        color:var(--brand-dark);
        font-size:.72rem;
        font-weight:850;
        letter-spacing:.03em;
      }
      .home-path-card h3{
        margin:.7rem 0 .45rem;
        color:var(--brand-dark);
        font-size:1.2rem;
        font-weight:900;
        line-height:1.2;
      }
      .home-path-card p{margin:0;color:#4e6254;line-height:1.66}
      .home-path-link{
        display:inline-flex;
        margin-top:.85rem;
        color:var(--brand-dark);
        font-weight:850;
        text-decoration:none;
      }
      .home-path-link:hover{text-decoration:underline}

      .home-impact{
        display:grid;
        grid-template-columns:repeat(3,minmax(0,1fr));
        gap:.8rem;
      }
      .home-impact-item{
        border-radius:14px;
        padding:.82rem .86rem;
        background:rgba(31,143,74,0.06);
        border:1px solid rgba(31,143,74,0.16);
      }
      .home-impact-item strong{
        display:block;
        color:var(--brand-dark);
        font-size:1.15rem;
        font-weight:900;
        line-height:1.1;
      }
      .home-impact-item span{
        display:block;
        margin-top:.2rem;
        color:#55695b;
        font-size:.9rem;
      }
      @media (max-width:991px){
        .home-impact{grid-template-columns:1fr}
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

      .page-hero--shop h1{color:var(--brand-dark);font-weight:900;letter-spacing:-0.02em}
      .shop-hero-head{display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap}
      .shop-hero-sub{max-width:74ch;line-height:1.66}
      .shop-cart-btn{padding:.45rem .8rem;font-weight:800}
      .shop-back-link{display:inline-flex;align-items:center;gap:.25rem;
        color:var(--brand-dark);text-decoration:none;font-weight:800;font-size:.86rem}
      .shop-back-link:hover{text-decoration:underline}
      .shop-intro-note{
        max-width:860px;
        margin:0;
        color:#4a5f51;
        line-height:1.68;
        font-size:1.01rem;
        text-wrap:pretty;
      }
      .shop-intro-kicker{
        display:block;
        margin-bottom:.14rem;
        color:#2f6a47;
        font-size:.76rem;
        font-weight:900;
        letter-spacing:.08em;
        text-transform:uppercase;
      }
      .shop-topbar{display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap}

      .catalog-search{width:min(280px,100%);margin-left:auto}
      .catalog-search--wide{width:min(360px,100%)}
      .catalog-search-field{
        position:relative;
        border-radius:999px;
        padding:2px;
        background:linear-gradient(120deg, rgba(31,143,74,0.26), rgba(31,143,74,0.12));
        box-shadow:0 12px 30px rgba(11,17,24,0.08);
      }
      .catalog-search-icon{
        position:absolute;
        left:.9rem;
        top:50%;
        transform:translateY(-50%);
        color:#46614f;
        font-size:.9rem;
        font-weight:900;
        pointer-events:none;
      }
      .catalog-search-input{
        width:100%;
        height:38px;
        padding:.4rem .72rem .4rem 2rem;
        border-radius:999px;
        border:0;
        background:#fff;
        color:var(--brand-dark);
        font-size:.86rem;
        font-weight:700;
        box-shadow:none;
        transition:box-shadow .22s ease;
      }
      .catalog-search-input::placeholder{color:#708476;font-weight:600}
      .catalog-search-input:focus{
        outline:none;
        box-shadow:inset 0 0 0 1px rgba(31,143,74,0.28);
      }
      .catalog-search-field:focus-within{
        box-shadow:0 0 0 .2rem rgba(31,143,74,0.16), 0 14px 34px rgba(11,17,24,0.1);
      }

      .shop-categories-head h2{color:var(--brand-dark);font-weight:900;letter-spacing:-0.01em}
      .shop-categories-head p{color:#587061;line-height:1.6}
      .shop-categories-grid{
        display:grid;
        grid-template-columns:repeat(auto-fit, minmax(248px, 320px));
        gap:1rem;
        justify-content:start;
      }
      @media (max-width:767.98px){
        .shop-topbar{align-items:flex-start}
        .catalog-search{width:min(270px,88vw);margin-left:0}
        .shop-categories-grid{grid-template-columns:1fr;justify-content:center}
      }

      .shop-category-card{height:100%;
        position:relative;
        isolation:isolate;
        display:flex;
        flex-direction:column;
        border-radius:22px;
        overflow:hidden;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 18px 44px rgba(11,17,24,0.07);
        transition:transform .24s ease, box-shadow .24s ease, border-color .24s ease;
        text-decoration:none;
        color:inherit;
      }
      .shop-category-card > *{position:relative;z-index:1}
      .shop-category-card::after{
        content:'';
        position:absolute;
        inset:-35%;
        z-index:0;
        pointer-events:none;
        opacity:0;
        background:conic-gradient(from 40deg, rgba(31,143,74,0), rgba(31,143,74,0.26), rgba(31,143,74,0));
        transition:opacity .26s ease;
      }
      .shop-category-card:hover{
        transform:translateY(-4px);
        border-color:rgba(31,143,74,0.28);
        box-shadow:0 24px 56px rgba(11,17,24,0.1);
      }
      .shop-category-card:hover::after{opacity:.14;animation:shopCardSpin 3.6s linear infinite}
      .shop-category-media{position:relative;display:block;
        aspect-ratio:1/1;
        overflow:hidden;
        background:linear-gradient(180deg,rgba(31,143,74,0.03),rgba(31,143,74,0.08));
      }
      .shop-category-media img{width:100%;height:100%;object-fit:cover;display:block;
        transition:transform .6s cubic-bezier(.2,.9,.2,1);
      }
      .shop-category-card:hover .shop-category-media img{transform:scale(1.04)}
      .shop-category-placeholder{width:100%;height:100%;background:linear-gradient(180deg,rgba(31,143,74,0.04),rgba(31,143,74,0.1))}
      .shop-category-title{
        position:absolute;
        left:.65rem;
        top:.65rem;
        margin:0;
        padding:.34rem .64rem;
        border-radius:999px;
        background:rgba(255,255,255,0.92);
        border:1px solid rgba(31,143,74,0.2);
        color:var(--brand-dark);
        font-size:.88rem;
        font-weight:900;
        line-height:1.2;
        max-width:calc(100% - 1.3rem);
        overflow:hidden;
        white-space:nowrap;
        text-overflow:ellipsis;
      }
      .shop-category-foot{
        margin-top:auto;
        padding:.72rem .9rem .84rem;
        border-top:1px solid rgba(31,143,74,0.14);
        display:flex;
        align-items:center;
      }
      .shop-category-link{color:var(--brand-dark);font-weight:900;font-size:.92rem}

      .shop-product-card{position:relative;
        isolation:isolate;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        border-radius:22px;
        overflow:hidden;
        box-shadow:0 16px 40px rgba(11,17,24,0.06);
        transition:transform .24s ease, box-shadow .24s ease, border-color .24s ease;
        opacity:0;transform:translateY(12px)
      }
      .shop-product-card > *{position:relative;z-index:1}
      .shop-product-card::after{
        content:'';
        position:absolute;
        inset:-35%;
        z-index:0;
        pointer-events:none;
        opacity:0;
        background:conic-gradient(from 40deg, rgba(31,143,74,0), rgba(31,143,74,0.24), rgba(31,143,74,0));
        transition:opacity .26s ease;
      }
      .shop-product-card.visible{opacity:1;transform:none}
      .shop-product-card:hover{transform:translateY(-4px);border-color:rgba(31,143,74,0.28);box-shadow:0 22px 50px rgba(11,17,24,0.1)}
      .shop-product-card:hover::after{opacity:.14;animation:shopCardSpin 3.6s linear infinite}

      .shop-product-media{position:relative;overflow:hidden;
        aspect-ratio:1/1;
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
        border:1px solid rgba(31,143,74,0.18);
        font-weight:900;
        color:var(--brand-dark);
        font-size:.78rem;
        backdrop-filter:blur(10px);
        -webkit-backdrop-filter:blur(10px);
      }
      .shop-product-body{padding:.72rem .76rem .78rem;min-height:96px}
      .shop-product-name{margin:0;color:var(--brand-dark);font-size:.95rem;font-weight:850;line-height:1.3;
        display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
      .shop-product-foot{margin-top:.62rem;display:flex;align-items:center;justify-content:space-between;gap:.45rem}
      .shop-product-link{color:var(--brand-dark);text-decoration:none;font-size:.82rem;font-weight:850}
      .shop-product-link:hover{text-decoration:underline}
      .shop-add-btn{
        display:inline-flex;
        align-items:center;
        gap:.28rem;
        padding:.28rem .52rem;
        border-radius:999px;
        font-weight:800;
        border:1px solid rgba(31,143,74,0.24);
        background:linear-gradient(90deg, #1f8f4a, #177340);
        color:#fff;
        box-shadow:0 8px 20px rgba(11,17,24,0.14);
        transition:transform .2s ease, box-shadow .2s ease, filter .2s ease;
      }
      .shop-add-btn:hover{transform:translateY(-1px);box-shadow:0 12px 24px rgba(11,17,24,0.18);filter:brightness(1.04)}
      .shop-add-btn:disabled{opacity:.95}
      .shop-add-btn-icon{
        width:15px;
        height:15px;
        border-radius:50%;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        background:rgba(255,255,255,0.24);
        font-size:.76rem;
        line-height:1;
        font-weight:900;
      }
      .shop-add-btn-label{line-height:1;font-size:.78rem;letter-spacing:.01em}
      .shop-add-btn.is-loading .shop-add-btn-label{opacity:.85}
      .shop-add-btn.is-added{
        border-color:rgba(15,93,42,0.3);
        background:linear-gradient(90deg, #1f8f4a, #126938);
      }
      .shop-add-btn.is-added .shop-add-btn-icon{background:rgba(255,255,255,0.24)}
      .shop-add-btn--detail{padding:.48rem .85rem;font-size:.92rem}
      .shop-add-btn--card{padding:.24rem .48rem}
      .shop-add-btn--card .shop-add-btn-label{font-size:.75rem}

      @keyframes shopCardSpin{to{transform:rotate(1turn)}}

      .shop-detail-wrap{max-width:1120px}
      .shop-detail-card{
        border-radius:18px;
        overflow:hidden;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 18px 44px rgba(11,17,24,0.08);
      }
      .shop-detail-main-media{aspect-ratio:16/11;background:#f4f8f4;overflow:hidden;max-height:520px}
      .shop-detail-main-media img{width:100%;height:100%;object-fit:cover;display:block}
      .shop-detail-thumbs{display:flex;gap:.5rem;overflow-x:auto;padding:.8rem .8rem .95rem;
        -webkit-overflow-scrolling:touch}
      .shop-detail-thumbs button{border:0;background:transparent;padding:0;flex:0 0 auto;border-radius:10px;outline:0}
      .shop-detail-thumbs img{width:76px;height:56px;object-fit:cover;border-radius:10px;
        border:2px solid transparent;display:block}
      .shop-detail-thumbs button[aria-current="true"] img{border-color:var(--brand-green)}

      .shop-detail-side{
        border-radius:18px;
        padding:1rem 1rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 18px 46px rgba(11,17,24,0.07);
      }
      .shop-detail-side h2{margin:.55rem 0 .35rem;color:var(--brand-dark);font-weight:900;line-height:1.2;font-size:1.35rem}
      .shop-detail-price{color:var(--brand-dark);font-size:1.15rem;font-weight:900}
      .shop-detail-short{margin-top:.7rem;color:#4f6455;line-height:1.66}
      .shop-detail-desc{margin-top:.8rem;padding-top:.75rem;border-top:1px solid rgba(31,143,74,0.14);
        color:#4f6455;white-space:pre-wrap;line-height:1.66}
      .shop-detail-form{margin-top:.9rem}
      .shop-detail-actions{display:grid;grid-template-columns:90px 1fr auto;gap:.5rem;align-items:center}
      .shop-detail-actions .btn{white-space:nowrap}

      .shop-empty-card{
        border-radius:16px;
        padding:1.1rem 1rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 14px 34px rgba(11,17,24,0.06);
      }

      /* Cart page */
      .cart-page-head{display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap}
      .cart-page-actions{display:flex;gap:.45rem;flex-wrap:wrap}
      .cart-page-actions .btn{
        border-radius:999px;
        padding:.34rem .72rem;
        font-size:.82rem;
        font-weight:800;
      }

      .cart-lines-wrap{
        border-radius:18px;
        padding:.95rem .95rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 16px 40px rgba(11,17,24,0.07);
      }
      .cart-line-item{
        display:grid;
        grid-template-columns:88px 1fr;
        gap:.8rem;
        align-items:center;
        padding:.72rem 0;
      }
      .cart-line-item + .cart-line-item{border-top:1px solid rgba(31,143,74,0.13)}
      .cart-line-media{display:block;border-radius:12px;overflow:hidden;background:#f4f8f4}
      .cart-line-media img{width:100%;height:88px;object-fit:cover;display:block}
      .cart-line-placeholder{width:100%;height:88px;background:linear-gradient(180deg,rgba(31,143,74,0.03),rgba(31,143,74,0.09))}
      .cart-line-name{margin:0;color:var(--brand-dark);font-size:1.1rem;font-weight:900;line-height:1.25}
      .cart-line-price{margin-top:.2rem;color:#5b7062;font-weight:800;font-size:.9rem}
      .cart-line-controls{margin-top:.65rem;display:flex;align-items:center;gap:.55rem;flex-wrap:wrap}
      .cart-qty-input{width:88px}
      .cart-line-total{margin-left:auto;color:var(--brand-dark);font-weight:900}
      .cart-remove-btn{width:34px;height:34px;padding:0;display:inline-flex;align-items:center;justify-content:center;border-radius:10px}
      .cart-update-row{margin-top:.85rem;padding-top:.75rem;border-top:1px solid rgba(31,143,74,0.13);display:flex;justify-content:flex-end}
      .cart-update-btn{padding:.4rem .76rem;font-weight:850;font-size:.85rem;border-radius:999px}

      .cart-summary-card{
        border-radius:18px;
        padding:1rem 1rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 18px 44px rgba(11,17,24,0.08);
        position:sticky;
        top:114px;
      }
      .cart-summary-card h2{margin:0 0 .8rem;color:var(--brand-dark);font-size:1.26rem;font-weight:900}
      .cart-summary-line{display:flex;align-items:center;justify-content:space-between;gap:.75rem;padding:.26rem 0;color:#516658}
      .cart-summary-line strong{color:var(--brand-dark);font-weight:900}
      .cart-summary-total{margin-top:.62rem;padding-top:.7rem;border-top:1px solid rgba(31,143,74,0.14);
        display:flex;align-items:center;justify-content:space-between;gap:.75rem}
      .cart-summary-total span,.cart-summary-total strong{color:var(--brand-dark);font-weight:900;font-size:1.14rem}
      .cart-checkout-btn{margin-top:.95rem;font-weight:900;border-radius:999px;padding:.52rem .8rem;font-size:.9rem}
      .cart-summary-note{margin-top:.6rem;color:#5b7062;line-height:1.55;font-size:.86rem}

      .cart-empty-card{
        max-width:520px;
        border-radius:18px;
        padding:1.2rem 1.1rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 16px 40px rgba(11,17,24,0.07);
      }
      .cart-empty-icon{width:50px;height:50px;border-radius:14px;display:flex;align-items:center;justify-content:center;
        background:rgba(31,143,74,0.1);border:1px solid rgba(31,143,74,0.2);font-size:1.4rem}
      .cart-empty-card h2{margin:.72rem 0 .35rem;color:var(--brand-dark);font-size:1.18rem;font-weight:900}
      .cart-empty-card p{color:#5a7062;line-height:1.62}

      /* Checkout page */
      .checkout-page-head{display:flex;align-items:flex-end;justify-content:space-between;gap:1rem;flex-wrap:wrap}
      .checkout-shell{max-width:1160px}

      .checkout-form-card{
        border-radius:18px;
        padding:1rem 1rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 18px 44px rgba(11,17,24,0.08);
      }
      .checkout-form-card h2{margin:0 0 .95rem;color:var(--brand-dark);font-size:1.25rem;font-weight:900}
      .checkout-form-grid .form-control,
      .checkout-form-grid .form-select{
        border-radius:12px;
        border:1px solid rgba(31,143,74,0.18);
      }
      .checkout-form-grid .form-control:focus,
      .checkout-form-grid .form-select:focus{
        border-color:rgba(31,143,74,0.42);
        box-shadow:0 0 0 .18rem rgba(31,143,74,0.14);
      }

      .checkout-method-grid{display:grid;grid-template-columns:1fr 1fr;gap:.6rem}
      .checkout-method-option{display:block;cursor:pointer}
      .checkout-method-input{position:absolute;opacity:0;pointer-events:none}
      .checkout-method-ui{
        position:relative;
        display:block;
        border-radius:12px;
        padding:.62rem .72rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.18);
        transition:border-color .2s ease, box-shadow .2s ease, background .2s ease;
      }
      .checkout-method-ui strong{display:block;color:var(--brand-dark);font-size:.92rem;font-weight:900}
      .checkout-method-ui small{display:block;margin-top:.08rem;color:#607467;font-weight:700}
      .checkout-method-input:checked + .checkout-method-ui{
        border-color:#2e9b57;
        background:linear-gradient(180deg,#f7fff9,#ebf9f0);
        box-shadow:0 0 0 .2rem rgba(31,143,74,0.2), 0 12px 26px rgba(11,17,24,0.08);
      }
      .checkout-method-input:checked + .checkout-method-ui::before{
        content:'';
        position:absolute;
        left:0;
        top:0;
        bottom:0;
        width:4px;
        border-radius:12px 0 0 12px;
        background:#1f8f4a;
      }
      .checkout-method-input:checked + .checkout-method-ui strong{color:#145f32}
      .checkout-method-input:focus-visible + .checkout-method-ui{
        box-shadow:0 0 0 .22rem rgba(31,143,74,0.2), 0 12px 26px rgba(11,17,24,0.07);
      }

      .checkout-delivery-box{
        border-radius:14px;
        padding:.82rem .85rem;
        background:linear-gradient(180deg,#ffffff,#f8fcf9);
        border:1px solid rgba(31,143,74,0.15);
      }
      .checkout-delivery-title{margin-bottom:.55rem;color:var(--brand-dark);font-weight:900}

      .checkout-submit-row{margin-top:.2rem;display:flex;justify-content:flex-end}
      .checkout-submit-btn{padding:.5rem .95rem;border-radius:999px;font-weight:900}

      .checkout-summary-card{
        border-radius:18px;
        padding:1rem 1rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 18px 44px rgba(11,17,24,0.08);
        position:sticky;
        top:114px;
      }
      .checkout-summary-card h2{margin:0 0 .82rem;color:var(--brand-dark);font-size:1.2rem;font-weight:900}
      .checkout-lines-list{border-radius:12px;overflow:hidden;border:1px solid rgba(31,143,74,0.14)}
      .checkout-line{display:flex;align-items:flex-start;justify-content:space-between;gap:.8rem;padding:.58rem .66rem;background:#fff}
      .checkout-line + .checkout-line{border-top:1px solid rgba(31,143,74,0.12)}
      .checkout-line-name{color:var(--brand-dark);font-weight:850;line-height:1.25}
      .checkout-line-qty{margin-top:.12rem;color:#607467;font-size:.82rem;font-weight:700}
      .checkout-line-price{color:var(--brand-dark);font-size:.86rem;font-weight:850;white-space:nowrap}

      .checkout-totals{margin-top:.8rem}
      .checkout-total-line{display:flex;align-items:center;justify-content:space-between;gap:.8rem;padding:.24rem 0;color:#4f6456}
      .checkout-total-line strong{color:var(--brand-dark);font-weight:900}
      .checkout-grand-total{margin-top:.4rem;padding-top:.66rem;border-top:1px solid rgba(31,143,74,0.14);
        display:flex;align-items:center;justify-content:space-between;gap:.8rem}
      .checkout-grand-total span,.checkout-grand-total strong{color:var(--brand-dark);font-weight:900;font-size:1.1rem}
      .checkout-note{margin-top:.62rem;color:#607467;line-height:1.56;font-size:.86rem}

      /* Account profile page */
      .account-shell{max-width:1120px}
      .account-page-head h1{color:var(--brand-dark);font-weight:900;letter-spacing:-0.02em}

      .account-main-card{
        border-radius:18px;
        padding:1rem 1rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 18px 44px rgba(11,17,24,0.08);
      }
      .account-identity{display:flex;align-items:center;gap:.75rem;padding-bottom:.85rem;border-bottom:1px solid rgba(31,143,74,0.14)}
      .account-avatar{
        width:52px;
        height:52px;
        border-radius:16px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:linear-gradient(180deg,#f4fbf7,#ebf8f1);
        border:1px solid rgba(31,143,74,0.22);
        color:var(--brand-dark);
        font-size:1.2rem;
        font-weight:900;
      }
      .account-name{color:var(--brand-dark);font-size:1.18rem;font-weight:900;line-height:1.2}
      .account-email{margin-top:.1rem;color:#607567;font-weight:700}

      .account-grid{margin-top:.9rem;display:grid;grid-template-columns:1fr 1fr;gap:.65rem}
      .account-info-tile{border-radius:12px;padding:.7rem .74rem;background:#fff;border:1px solid rgba(31,143,74,0.16)}
      .account-info-label{color:#607567;font-size:.79rem;font-weight:800}
      .account-info-value{margin-top:.14rem;color:var(--brand-dark);font-weight:850;line-height:1.35}

      .account-actions-row{margin-top:.95rem;display:flex;gap:.5rem;flex-wrap:wrap}
      .account-actions-row .btn{border-radius:999px;font-weight:850;padding:.38rem .74rem}

      .account-logout-row{margin-top:.9rem;padding-top:.75rem;border-top:1px solid rgba(31,143,74,0.14)}
      .account-logout-row .btn{border-radius:999px;font-weight:800;padding:.34rem .7rem}

      .account-tip-card{
        border-radius:18px;
        padding:1rem 1rem;
        background:linear-gradient(180deg,#ffffff,#f7fcf9);
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 16px 40px rgba(11,17,24,0.07);
      }
      .account-tip-card h2{margin:0 0 .5rem;color:var(--brand-dark);font-size:1.12rem;font-weight:900}
      .account-tip-card p{margin:0;color:#566b5d;line-height:1.62}
      .account-tip-card .btn{margin-top:.82rem;border-radius:999px;font-weight:900;padding:.46rem .75rem}

      /* About page */
      .page-hero--about h1{color:var(--brand-dark);font-weight:900;letter-spacing:-0.02em}
      .about-shell{max-width:1120px}
      .about-hero-title{line-height:1.14}
      .about-hero p{max-width:84ch;line-height:1.68}

      .about-main-card{
        border-radius:18px;
        padding:1rem 1rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 18px 42px rgba(11,17,24,0.08);
      }
      .about-main-card h2{margin:0 0 .55rem;color:var(--brand-dark);font-size:1.26rem;font-weight:900}
      .about-main-card p{margin:0;color:#53685a;line-height:1.7}

      .about-values-grid{margin-top:.9rem;display:grid;grid-template-columns:1fr 1fr;gap:.62rem}
      .about-value-item{border-radius:12px;padding:.68rem .72rem;background:#fff;border:1px solid rgba(31,143,74,0.16)}
      .about-value-item strong{display:block;color:var(--brand-dark);font-size:.92rem;font-weight:900}
      .about-value-item span{display:block;margin-top:.16rem;color:#607567;line-height:1.55}

      .about-side-card{
        border-radius:18px;
        padding:1rem 1rem;
        background:linear-gradient(180deg,#ffffff,#f7fcf9);
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 16px 40px rgba(11,17,24,0.07);
      }
      .about-side-card h3{margin:0 0 .52rem;color:var(--brand-dark);font-size:1.14rem;font-weight:900}
      .about-list{padding-left:1.1rem;color:#586d5f;line-height:1.62}
      .about-list li + li{margin-top:.22rem}
      .about-side-actions{margin-top:.82rem;display:flex;gap:.45rem;flex-wrap:wrap}
      .about-side-actions .btn{border-radius:999px;font-weight:850;padding:.38rem .7rem}

      /* Contact page */
      .page-hero--contact h1{color:var(--brand-dark);font-weight:900;letter-spacing:-0.02em}
      .contact-shell{max-width:1120px}
      .contact-page-head p{max-width:84ch;line-height:1.66}

      .contact-side-card{
        border-radius:18px;
        padding:1rem 1rem;
        background:linear-gradient(180deg,#ffffff,#f7fcf9);
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 16px 40px rgba(11,17,24,0.07);
      }
      .contact-side-card h2{margin:0 0 .5rem;color:var(--brand-dark);font-size:1.18rem;font-weight:900}
      .contact-side-card p{margin:0;color:#5a7062;line-height:1.66}

      .contact-points{margin-top:.85rem;display:grid;gap:.5rem}
      .contact-point{border-radius:12px;padding:.62rem .66rem;background:#fff;border:1px solid rgba(31,143,74,0.14)}
      .contact-point strong{display:block;color:var(--brand-dark);font-size:.9rem;font-weight:900}
      .contact-point span{display:block;margin-top:.12rem;color:#5e7365;line-height:1.55}

      .contact-quick-links{margin-top:.85rem;display:flex;gap:.45rem;flex-wrap:wrap}
      .contact-quick-links .btn{border-radius:999px;font-weight:800;padding:.34rem .66rem}

      .contact-form-card{
        border-radius:18px;
        padding:1rem 1rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 18px 42px rgba(11,17,24,0.08);
      }
      .contact-form-card h3{margin:0 0 .82rem;color:var(--brand-dark);font-size:1.16rem;font-weight:900}
      .contact-form-grid .form-control{border-radius:12px;border:1px solid rgba(31,143,74,0.18)}
      .contact-form-grid .form-control:focus{border-color:rgba(31,143,74,0.4);box-shadow:0 0 0 .18rem rgba(31,143,74,0.14)}

      .contact-submit-row{margin-top:.2rem;display:flex;align-items:center;justify-content:space-between;gap:.65rem;flex-wrap:wrap}
      .contact-consent{color:#5e7365;font-size:.84rem}
      .contact-submit-btn{border-radius:999px;font-weight:900;padding:.46rem .8rem}

      @media (max-width:991.98px){
        .shop-hero-head{align-items:flex-start}
        .cart-summary-card{position:static;top:auto}
        .checkout-summary-card{position:static;top:auto}
      }
      @media (max-width:767.98px){
        .shop-product-name{font-size:.9rem}
        .shop-detail-actions{grid-template-columns:1fr}
        .cart-line-item{grid-template-columns:72px 1fr;gap:.65rem}
        .cart-line-media img,.cart-line-placeholder{height:72px}
        .cart-line-name{font-size:.98rem}
        .cart-line-controls{gap:.4rem}
        .cart-qty-input{width:78px}
        .cart-line-total{margin-left:0;width:100%}
        .cart-update-row{justify-content:stretch}
        .cart-page-actions .btn{padding:.28rem .58rem;font-size:.76rem}
        .cart-remove-btn{width:30px;height:30px;border-radius:9px}
        .cart-checkout-btn{padding:.46rem .72rem;font-size:.84rem}
        .cart-update-btn{width:100%;padding:.42rem .7rem;font-size:.82rem}
        .checkout-submit-row{justify-content:stretch}
        .checkout-submit-btn{width:100%}
        .checkout-page-head .btn{padding:.3rem .62rem;font-size:.78rem;border-radius:999px}
        .account-grid{grid-template-columns:1fr}
        .account-actions-row .btn{flex:1 1 auto}
        .about-values-grid{grid-template-columns:1fr}
        .about-side-actions .btn{flex:1 1 auto}
        .page-hero--about{padding-top:.75rem !important;padding-bottom:.7rem !important}
        .about-hero-title{font-size:1.34rem;white-space:nowrap;letter-spacing:-0.01em}
        .contact-submit-row{justify-content:stretch}
        .contact-submit-btn{width:100%}
        .contact-quick-links .btn{flex:1 1 auto}
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
      .training-hero-back--icon{
        width:34px;
        height:34px;
        justify-content:center;
        padding:0;
        border-radius:10px;
      }
      .training-hero-back--icon svg{display:block}
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

      .trainings-catalog-hero .trainings-catalog-head{
        display:flex;
        align-items:flex-end;
        justify-content:space-between;
        gap:1rem;
        flex-wrap:wrap;
      }
      .trainings-catalog-hero .catalog-search{margin-left:0}
      .trainings-catalog-hero .trainings-catalog-sub{max-width:76ch;line-height:1.65}
      .trainings-catalog-title{line-height:1.14}
      .trainings-catalog-stat{
        min-width:100px;
        border-radius:12px;
        padding:.5rem .65rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 14px 34px rgba(11,17,24,0.06);
      }
      .trainings-catalog-stat strong{
        display:block;
        font-size:1.15rem;
        font-weight:900;
        color:var(--brand-dark);
        line-height:1.05;
      }
      .trainings-catalog-stat span{display:block;margin-top:.18rem;font-size:.78rem;color:#5f7365}

      @media (max-width:767.98px){
        .trainings-catalog-hero{padding-top:.8rem !important;padding-bottom:.7rem !important}
        .trainings-catalog-title{
          font-size:1.35rem;
          letter-spacing:-0.01em;
          white-space:nowrap;
        }
        .trainings-catalog-hero .trainings-catalog-sub{line-height:1.5}
      }

      .training-catalog-card{
        display:block;
        height:100%;
        border-radius:18px;
        overflow:hidden;
        background:#fff;
        border:1px solid rgba(31,143,74,0.2);
        box-shadow:0 18px 48px rgba(11,17,24,0.08);
        text-decoration:none;
        transition:transform .32s ease, box-shadow .32s ease, border-color .22s ease;
      }
      .training-catalog-card:hover{
        transform:translateY(-7px);
        border-color:rgba(31,143,74,0.34);
        box-shadow:0 28px 64px rgba(11,17,24,0.12);
      }
      .training-catalog-card:focus-visible{
        outline:none;
        box-shadow:0 0 0 .2rem rgba(31,143,74,0.22), 0 24px 58px rgba(11,17,24,0.1);
      }
      .training-catalog-media{
        position:relative;
        aspect-ratio:16/10;
        overflow:hidden;
        background:linear-gradient(180deg,rgba(31,143,74,0.06),rgba(31,143,74,0.14));
      }
      .training-catalog-media img{
        width:100%;
        height:100%;
        object-fit:cover;
        display:block;
        transition:transform .65s ease;
      }
      .training-catalog-card:hover .training-catalog-media img{transform:scale(1.05)}
      .training-catalog-placeholder{width:100%;height:100%}
      .training-catalog-kicker{
        position:absolute;
        left:.72rem;
        top:.72rem;
        display:inline-flex;
        align-items:center;
        padding:.28rem .58rem;
        border-radius:999px;
        background:rgba(11,17,24,0.65);
        border:1px solid rgba(255,255,255,0.24);
        color:#fff;
        font-size:.7rem;
        font-weight:850;
        letter-spacing:.03em;
      }
      .training-catalog-body{padding:1rem 1rem .95rem}
      .training-catalog-title{
        margin:0;
        color:var(--brand-dark);
        font-size:1.12rem;
        font-weight:900;
        line-height:1.2;
        letter-spacing:-0.01em;
      }
      .training-catalog-desc{margin-top:.58rem;color:#54685a;line-height:1.62}
      .training-catalog-meta{margin-top:.78rem;display:flex;gap:.42rem;flex-wrap:wrap}
      .training-catalog-chip{
        display:inline-flex;
        align-items:center;
        padding:.22rem .54rem;
        border-radius:999px;
        background:rgba(31,143,74,0.08);
        border:1px solid rgba(31,143,74,0.16);
        color:#2e4638;
        font-size:.78rem;
        font-weight:800;
      }
      .training-catalog-foot{
        margin-top:.9rem;
        padding-top:.75rem;
        border-top:1px solid rgba(31,143,74,0.14);
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:.65rem;
      }
      .training-catalog-price{color:#3f5446;font-size:.85rem;font-weight:800}
      .training-catalog-cta{color:var(--brand-dark);font-size:.85rem;font-weight:900}

      /* Partners page */
      .partners-page-hero{
        background:linear-gradient(180deg, rgba(31,143,74,0.08), rgba(31,143,74,0));
      }
      .partners-page-head{
        display:flex;
        align-items:flex-end;
        justify-content:space-between;
        gap:1rem;
        flex-wrap:wrap;
      }
      .partners-page-head h1{color:var(--brand-dark);font-weight:900;letter-spacing:-0.02em}
      .partners-page-title{line-height:1.14}
      .partners-page-sub{max-width:76ch;line-height:1.66}
      .partners-page-stat{
        min-width:96px;
        border-radius:12px;
        padding:.5rem .62rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 14px 30px rgba(11,17,24,0.06);
      }
      .partners-page-stat strong{display:block;color:var(--brand-dark);font-size:1.12rem;font-weight:900;line-height:1.05}
      .partners-page-stat span{display:block;margin-top:.16rem;color:#5f7365;font-size:.78rem}

      .partners-page-intro h2{color:var(--brand-dark);font-weight:900;letter-spacing:-0.01em;line-height:1.15;margin:0 0 .35rem}
      .partners-page-intro p{color:#4f6455;max-width:74ch;line-height:1.66}

      .partners-feature-card{
        height:100%;
        border-radius:18px;
        overflow:hidden;
        background:#fff;
        border:1px solid rgba(31,143,74,0.18);
        box-shadow:0 18px 46px rgba(11,17,24,0.08);
        transition:transform .24s ease, box-shadow .24s ease, border-color .24s ease;
      }
      .partners-feature-card:hover{
        transform:translateY(-4px);
        border-color:rgba(31,143,74,0.28);
        box-shadow:0 24px 50px rgba(11,17,24,0.1);
      }
      .partners-feature-media{
        min-height:200px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:linear-gradient(180deg, rgba(31,143,74,0.08), rgba(31,143,74,0.04));
        border-bottom:1px solid rgba(31,143,74,0.14);
      }
      .partners-feature-media img{
        max-width:80%;
        max-height:160px;
        object-fit:contain;
        display:block;
      }
      .partners-feature-fallback{
        width:88px;
        height:88px;
        border-radius:24px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:rgba(31,143,74,0.12);
        border:1px solid rgba(31,143,74,0.18);
        color:var(--brand-dark);
        font-size:1.85rem;
        font-weight:900;
      }
      .partners-feature-body{padding:1rem 1.05rem}
      .partners-feature-chip{
        display:inline-flex;
        align-items:center;
        padding:.2rem .55rem;
        border-radius:999px;
        background:rgba(31,143,74,0.1);
        border:1px solid rgba(31,143,74,0.2);
        color:var(--brand-dark);
        font-size:.72rem;
        font-weight:850;
        letter-spacing:.03em;
      }
      .partners-feature-name{
        margin:.62rem 0 .4rem;
        color:var(--brand-dark);
        font-size:1.2rem;
        font-weight:900;
        letter-spacing:-0.01em;
        line-height:1.2;
      }
      .partners-feature-desc{color:#4f6455;line-height:1.66}
      .partners-feature-link{
        display:inline-flex;
        margin-top:.75rem;
        color:var(--brand-dark);
        font-weight:850;
        text-decoration:none;
      }
      .partners-feature-link:hover{text-decoration:underline}

      .partners-compact-wrap{
        border-radius:18px;
        padding:1rem 1rem;
        background:linear-gradient(180deg, #ffffff, #f8fcf9);
        border:1px solid rgba(31,143,74,0.14);
      }
      .partners-compact-title{color:var(--brand-dark);font-weight:850;letter-spacing:-0.01em}
      .partners-compact-grid{
        display:grid;
        grid-template-columns:repeat(2,minmax(0,1fr));
        gap:.75rem;
      }
      @media (min-width:768px){
        .partners-compact-grid{grid-template-columns:repeat(3,minmax(0,1fr))}
      }
      @media (min-width:1200px){
        .partners-compact-grid{grid-template-columns:repeat(4,minmax(0,1fr))}
      }

      .partners-compact-card{
        border-radius:14px;
        padding:.78rem .78rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 12px 30px rgba(11,17,24,0.06);
        text-decoration:none;
        color:inherit;
        display:flex;
        flex-direction:column;
        gap:.45rem;
        transition:transform .24s ease, box-shadow .24s ease, border-color .24s ease;
      }
      a.partners-compact-card:hover{
        transform:translateY(-4px);
        border-color:rgba(31,143,74,0.28);
        box-shadow:0 18px 38px rgba(11,17,24,0.09);
      }
      .partners-compact-logo{
        border-radius:11px;
        min-height:80px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:rgba(31,143,74,0.07);
        border:1px solid rgba(31,143,74,0.14);
      }
      .partners-compact-logo img{max-width:74%;max-height:62px;object-fit:contain;display:block}
      .partners-compact-fallback{
        width:52px;
        height:52px;
        border-radius:14px;
        display:flex;
        align-items:center;
        justify-content:center;
        background:rgba(31,143,74,0.12);
        color:var(--brand-dark);
        font-weight:900;
      }
      .partners-compact-name{color:var(--brand-dark);font-weight:850;line-height:1.25}
      .partners-compact-link{color:#617567;font-size:.82rem;font-weight:700}

      .partners-empty-card{
        border-radius:16px;
        padding:1.2rem 1.1rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 14px 32px rgba(11,17,24,0.06);
      }
      @media (max-width:767.98px){
        .partners-page-hero{padding-top:.9rem !important;padding-bottom:.45rem !important}
        .partners-page-hero .container{padding-top:0 !important}
        .partners-page-head{align-items:flex-start}
        .partners-page-head .section-badge{margin-bottom:.35rem !important}
        .partners-page-head h1{margin-bottom:.35rem !important}
        .partners-page-stat{min-width:0}
        .partners-page-title{font-size:1.35rem;white-space:nowrap;letter-spacing:-0.01em}
        .partners-feature-media{min-height:160px}
        .partners-feature-media img{max-height:120px}
      }

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
      .training-question-modal .modal-dialog{--bs-modal-width:460px}
      .training-question-modal .modal-content{
        background:linear-gradient(180deg,
          color-mix(in srgb, #ffffff 92%, var(--brand-green) 8%),
          #ffffff
        );
        border:1px solid rgba(31,143,74,0.18);
      }
      .training-question-label{
        display:block;
        margin-bottom:.38rem;
        color:var(--brand-dark);
        font-size:.84rem;
        font-weight:850;
      }
      .training-question-modal .form-control{
        border-radius:10px;
        border:1px solid rgba(31,143,74,0.2);
      }
      .training-question-modal .form-control:focus{
        border-color:rgba(31,143,74,0.45);
        box-shadow:0 0 0 .18rem rgba(31,143,74,0.14);
      }
      .training-question-actions{display:flex;gap:.45rem;justify-content:flex-end;flex-wrap:wrap}
      .training-question-actions .btn{border-radius:999px;padding:.32rem .66rem;font-weight:850;font-size:.82rem}
      .training-question-send-btn{padding:.32rem .72rem!important}

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
      /* Footer */
      .site-footer{flex:0 0 auto;background:#f4f8f5;border-top:1px solid rgba(31,143,74,0.16)}
      .footer-shell{padding:2rem 0 1rem}
      .footer-brand-card{
        border-radius:16px;
        padding:1rem 1.05rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 14px 34px rgba(11,17,24,0.06);
      }
      .footer-brand{display:flex;align-items:center;gap:.75rem;font-weight:900;color:var(--brand-dark)}
      .footer-brand img{width:34px;height:34px;object-fit:contain}
      .footer-tagline{margin-top:.55rem;color:#4f6455;line-height:1.62;font-size:.93rem}
      .footer-meta{margin-top:.55rem;color:#607465;font-size:.88rem}

      .footer-col-title{
        margin-bottom:.65rem;
        color:var(--brand-dark);
        font-size:.74rem;
        font-weight:900;
        letter-spacing:.11em;
        text-transform:uppercase;
      }
      .footer-links{display:grid;gap:.42rem}
      .footer-link{
        color:#2f4739;
        text-decoration:none;
        font-weight:700;
        font-size:.93rem;
      }
      .footer-link:hover{text-decoration:underline;color:var(--brand-dark)}

      .footer-newsletter-box{
        border-radius:14px;
        padding:.9rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
      }
      .footer-note{color:#566b5c;font-size:.88rem;line-height:1.58;margin-bottom:.58rem}
      .footer-newsletter-form{display:grid;gap:.5rem}
      .footer-newsletter-row{display:grid;grid-template-columns:1fr auto;gap:.45rem;align-items:center}
      .footer-newsletter .form-control{
        border:1px solid rgba(31,143,74,0.2);
        background:#fcfffd;
        min-height:40px;
        padding:.48rem .72rem;
      }
      .footer-newsletter .form-control:focus{border-color:rgba(31,143,74,0.42);box-shadow:0 0 0 .18rem rgba(31,143,74,0.14)}
      .footer-newsletter .btn{font-weight:800;border-radius:8px;min-height:40px;padding:.45rem .78rem}
      .footer-consent{color:#6b7f71;font-size:.77rem;line-height:1.4}

      .footer-divider{height:1px;background:rgba(31,143,74,0.16);margin:1.1rem 0 .85rem}
      .footer-bottom-row{display:flex;align-items:center;justify-content:space-between;gap:.75rem;flex-wrap:wrap}
      .footer-small{color:#536858;font-size:.88rem}
      .footer-legal{display:flex;gap:.6rem;align-items:center;flex-wrap:wrap}
      .footer-legal a{color:#3e5445;text-decoration:none;font-weight:700}
      .footer-legal a:hover{text-decoration:underline;color:var(--brand-dark)}

      .footer-social{display:flex;gap:.45rem;align-items:center}
      .footer-social a{
        display:inline-flex;align-items:center;justify-content:center;
        width:32px;height:32px;border-radius:10px;
        color:#2b4234;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        text-decoration:none;
      }
      .footer-social a:hover{color:var(--brand-dark);border-color:rgba(31,143,74,0.3)}
      .footer-social svg{display:block}

      @media (max-width:767px){
        .footer-newsletter-row{grid-template-columns:1fr}
        .footer-bottom-row{justify-content:center;text-align:center}
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

      .gallery-showcase{
        border-radius:22px;
        padding:clamp(1.15rem, 2vw, 1.8rem);
        background:linear-gradient(180deg, #ffffff, #f7fcf8);
        border:1px solid rgba(31,143,74,0.14);
        box-shadow:0 20px 56px rgba(11,17,24,0.07);
      }
      .gallery-showcase-title{
        color:var(--brand-dark);
        font-size:clamp(1.35rem, 2.4vw, 1.95rem);
        font-weight:900;
        line-height:1.15;
        letter-spacing:-0.01em;
      }
      .gallery-showcase-copy{
        color:#4d6153;
        line-height:1.63;
        max-width:50ch;
      }
      .gallery-showcase-link{
        display:inline-flex;
        align-items:center;
        gap:.35rem;
        color:var(--brand-dark);
        font-weight:850;
        text-decoration:none;
      }
      .gallery-showcase-link:hover{text-decoration:underline}

      .gallery-slider{
        display:block;
        border-radius:18px;
        overflow:hidden;
        border:1px solid rgba(31,143,74,0.18);
        background:#fff;
        text-decoration:none;
        box-shadow:0 24px 64px rgba(11,17,24,0.12);
        transition:transform .3s ease, box-shadow .3s ease;
      }
      .gallery-slider:hover{
        transform:translateY(-4px);
        box-shadow:0 30px 72px rgba(11,17,24,0.16);
      }
      .gallery-slider-stage{
        position:relative;
        aspect-ratio:16/10;
        background:linear-gradient(180deg,rgba(31,143,74,0.08),rgba(31,143,74,0.02));
      }
      .gallery-slide{
        position:absolute;
        inset:0;
        width:100%;
        height:100%;
        object-fit:cover;
        opacity:0;
        transition:opacity .9s cubic-bezier(.22,.61,.36,1);
      }
      .gallery-slide.is-active{opacity:1}
      .gallery-slider-footer{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:1rem;
        padding:.72rem .85rem;
        color:#1f3427;
        font-size:.9rem;
        font-weight:800;
      }
      .gallery-slider-cta{
        color:var(--brand-dark);
        font-size:.82rem;
        font-weight:900;
      }
      .gallery-slider--empty{
        min-height:240px;
        display:grid;
        place-items:center;
      }
      .gallery-empty{
        padding:1rem 1.2rem;
        color:#405649;
        font-weight:700;
        text-align:center;
      }

      /* Gallery page */
      .gallery-page-hero{
        background:linear-gradient(180deg, rgba(31,143,74,0.07), rgba(31,143,74,0));
      }
      .gallery-page-head{
        display:flex;
        align-items:flex-end;
        justify-content:space-between;
        gap:1.25rem;
        flex-wrap:wrap;
      }
      .gallery-page-head h1{
        color:var(--brand-dark);
        font-weight:900;
        letter-spacing:-0.02em;
        margin:0;
      }
      .gallery-page-head p{
        color:#4f6455;
        max-width:65ch;
        line-height:1.65;
      }
      .gallery-page-stats{
        display:flex;
        gap:.55rem;
        flex-wrap:wrap;
      }
      .gallery-page-stat{
        min-width:86px;
        border-radius:12px;
        padding:.45rem .6rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
        box-shadow:0 10px 24px rgba(11,17,24,0.06);
      }
      .gallery-page-stat strong{
        display:block;
        font-size:1.02rem;
        font-weight:900;
        color:var(--brand-dark);
        line-height:1.1;
      }
      .gallery-page-stat span{
        display:block;
        margin-top:.15rem;
        font-size:.79rem;
        color:#627668;
      }
      .gallery-page-nav{
        display:flex;
        gap:.45rem;
        flex-wrap:wrap;
      }
      .gallery-page-nav-link{
        display:inline-flex;
        align-items:center;
        padding:.3rem .68rem;
        border-radius:999px;
        text-decoration:none;
        color:#2b4335;
        font-weight:800;
        font-size:.84rem;
        background:#fff;
        border:1px solid rgba(31,143,74,0.16);
      }
      .gallery-page-nav-link:hover{text-decoration:none;color:var(--brand-dark);background:rgba(31,143,74,0.08)}

      .gallery-group{margin-bottom:2.15rem}
      .gallery-group:last-child{margin-bottom:0}
      .gallery-group-head{margin-bottom:.9rem}
      .gallery-group-badge{
        display:inline-flex;
        align-items:center;
        padding:.22rem .6rem;
        border-radius:999px;
        background:rgba(31,143,74,0.1);
        border:1px solid rgba(31,143,74,0.18);
        color:var(--brand-dark);
        font-size:.74rem;
        font-weight:850;
        letter-spacing:.03em;
      }
      .gallery-group-head h2{
        margin:.55rem 0 .2rem;
        color:var(--brand-dark);
        font-weight:900;
        font-size:clamp(1.2rem, 2vw, 1.55rem);
        letter-spacing:-0.01em;
      }
      .gallery-group-head p{margin:0;color:#576b5d;line-height:1.62;max-width:72ch}

      .gallery-grid{
        display:grid;
        grid-template-columns:repeat(2,minmax(0,1fr));
        gap:.75rem;
      }
      @media (min-width:768px){
        .gallery-grid{grid-template-columns:repeat(3,minmax(0,1fr))}
      }
      @media (min-width:1200px){
        .gallery-grid{grid-template-columns:repeat(4,minmax(0,1fr))}
      }

      .gallery-card{
        position:relative;
        display:block;
        width:100%;
        border:0;
        padding:0;
        border-radius:14px;
        overflow:hidden;
        background:#fff;
        box-shadow:0 14px 34px rgba(11,17,24,0.09);
        cursor:pointer;
      }
      .gallery-card::after{
        content:'';
        position:absolute;
        inset:0;
        background:linear-gradient(180deg, rgba(0,0,0,0) 55%, rgba(0,0,0,0.16));
        opacity:0;
        transition:opacity .25s ease;
      }
      .gallery-card img{
        width:100%;
        height:100%;
        min-height:170px;
        max-height:235px;
        object-fit:cover;
        display:block;
        transition:transform .5s ease;
      }
      .gallery-card:hover img{transform:scale(1.04)}
      .gallery-card:hover::after{opacity:1}
      .gallery-card--wide{grid-column:span 2}
      .gallery-card--wide img{max-height:265px}

      .gallery-lightbox-content{
        border-radius:16px;
        overflow:hidden;
        border:1px solid rgba(31,143,74,0.18);
      }
      .gallery-lightbox-image{
        width:100%;
        max-height:78vh;
        object-fit:contain;
        display:block;
        background:#0f1613;
      }
      @media (max-width:767px){
        .gallery-card--wide{grid-column:span 1}
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
        .emoji-twinkle{animation:none}
        .footer-newsletter .btn, .footer-social a, .footer-social a svg{transition:none}
        .footer-link, .footer-legal a{transition:none}
        .training-catalog-card, .training-catalog-media img, .training-catalog-chip, .partners-feature-card, .partners-compact-card, .trainings-tab{transition:none}
        .trainings-tab::after{transition:none;opacity:0}
        .training-hero-back{transition:none}
        .training-hero-bg-video{transition:none}
        .training-thumb img, .training-thumb video{transition:none}
        .shop-category-card, .shop-category-media img, .shop-product-card, .shop-product-media img, .shop-add-btn{transition:none}
        .shop-category-card::after, .shop-product-card::after{animation:none!important;opacity:0!important}
      }
    </style>
  </head>
  <body>
    @php
      $isAdminSpace = request()->is('admin/*');
      $isAdminEntreSpace = request()->is('admin/entreprenariat*');
      $isAdminBoutiqueSpace = request()->is('admin/boutique*');
      $showCartCorner = request()->routeIs('shop.*') || request()->routeIs('cart.*') || request()->routeIs('checkout.*');
    @endphp
    <nav class="navbar navbar-expand-lg site-nav {{ $isAdminSpace ? 'site-nav--admin' : '' }}" aria-label="Navigation principale">
      <div class="container px-3 px-md-4">
        @if($isAdminSpace)
          <span class="navbar-brand" role="img" aria-label="Quisolideo admin">
            <span class="brand-mark" aria-hidden="true">
              <img src="/assets/quisolideo-logo.png" alt="" class="brand-logo">
            </span>
            <span class="brand-text">
              <span class="brand-title">Quisolideo</span>
              <span class="brand-subtitle">Formations & Boutique</span>
            </span>
          </span>
        @else
          <a class="navbar-brand" href="{{ route('home') }}">
            <span class="brand-mark" aria-hidden="true">
              <img src="/assets/quisolideo-logo.png" alt="" class="brand-logo">
            </span>
            <span class="brand-text">
              <span class="brand-title">Quisolideo</span>
              <span class="brand-subtitle">Formations & Boutique</span>
            </span>
          </a>
        @endif

        <button class="navbar-toggler {{ $isAdminSpace ? 'd-none' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#siteNavbar" aria-controls="siteNavbar" aria-expanded="false" aria-label="Ouvrir le menu">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="siteNavbar">
          @if(!$isAdminSpace)
            <div class="site-nav-links ms-lg-4 me-lg-auto">
              <a class="site-nav-link {{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}">Accueil</a>
              <a class="site-nav-link {{ request()->routeIs('about') ? 'is-active' : '' }}" href="{{ route('about') }}">A propos</a>
              <a class="site-nav-link {{ request()->routeIs('trainings.*') ? 'is-active' : '' }}" href="{{ route('trainings.index') }}">Formations</a>
              <a class="site-nav-link {{ request()->routeIs('partners.*') ? 'is-active' : '' }}" href="{{ route('partners.index') }}">Partenaires</a>
            </div>

            <div class="site-nav-actions ms-lg-3">
              <a class="site-nav-link nav-boutique {{ (request()->routeIs('shop.*') || request()->routeIs('cart.*') || request()->routeIs('checkout.*')) ? 'is-active' : '' }}" href="{{ route('shop.index') }}">Boutique</a>
              <a class="site-nav-link nav-contact {{ request()->routeIs('contact') ? 'is-active' : '' }}" href="{{ route('contact') }}">Contact</a>
              @guest
                <a
                  class="site-nav-link nav-login-icon {{ (request()->routeIs('login') || request()->routeIs('register')) ? 'is-active' : '' }}"
                  href="{{ route('login') }}"
                  aria-label="Connexion"
                  title="Connexion"
                >
                  <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M20 21a8 8 0 0 0-16 0"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>
                  <span class="visually-hidden">Connexion</span>
                </a>
              @endguest
            </div>
          @else
            <div class="site-nav-links ms-lg-4 me-lg-auto">
              @if($isAdminEntreSpace)
                <span class="site-nav-link is-active" aria-current="page">Espace Admin Entreprenariat</span>
              @elseif($isAdminBoutiqueSpace)
                <span class="site-nav-link is-active" aria-current="page">Espace Admin Boutique</span>
              @else
                <span class="site-nav-link is-active" aria-current="page">Espace Administration</span>
              @endif
            </div>
          @endif
        </div>
      </div>
    </nav>
    @if((auth()->check() || $showCartCorner) && !$isAdminSpace)
      <div class="corner-actions" aria-label="Actions rapides">
        @if($showCartCorner)
          <a class="corner-link corner-link--cart {{ request()->routeIs('cart.*') ? 'is-active' : '' }}" href="{{ route('cart.show') }}" aria-label="Panier">
            <span class="corner-link-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="20" r="1"></circle>
                <circle cx="18" cy="20" r="1"></circle>
                <path d="M2 3h2l2.2 10.2a2 2 0 0 0 2 1.6h9.5a2 2 0 0 0 2-1.6L22 6H7"></path>
              </svg>
            </span>
            <span class="corner-link-label">Panier</span>
          </a>
        @endif
        @auth
          <a class="corner-link {{ request()->routeIs('account.*') ? 'is-active' : '' }}" href="{{ route('account.profile') }}" aria-label="Profil">
            <span class="corner-link-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21a8 8 0 0 0-16 0"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
            </span>
            <span class="corner-link-label">Profil</span>
          </a>
        @endauth
      </div>
    @endif
    @if($isAdminEntreSpace)
      <aside class="admin-global-sidebar" aria-label="Menu admin entreprenariat">
        <div class="admin-global-head">
          <span class="admin-global-name mt-1">{{ session('admin_name') ?: 'Admin Entreprenariat' }}</span>
          <span class="admin-global-role">Espace Entreprenariat</span>
        </div>

        <nav class="admin-global-nav">
          <a href="{{ route('admin.entreprenariat.dashboard') }}" class="admin-global-link {{ request()->routeIs('admin.entreprenariat.dashboard') ? 'is-active' : '' }}">
            <span>Tableau de bord</span>
            <small>01</small>
          </a>
          <a href="{{ route('admin.trainings.index') }}" class="admin-global-link {{ request()->routeIs('admin.trainings.*') ? 'is-active' : '' }}">
            <span>Formations</span>
            <small>02</small>
          </a>
          <a href="{{ route('admin.partners.index') }}" class="admin-global-link {{ request()->routeIs('admin.partners.*') ? 'is-active' : '' }}">
            <span>Partenaires</span>
            <small>03</small>
          </a>
          <a href="{{ route('admin.messages.index') }}" class="admin-global-link {{ request()->routeIs('admin.messages.*') ? 'is-active' : '' }}">
            <span>Messages</span>
            <small>04</small>
          </a>
          <a href="{{ route('admin.registrations.index') }}" class="admin-global-link {{ request()->routeIs('admin.registrations.*') ? 'is-active' : '' }}">
            <span>Inscriptions</span>
            <small>05</small>
          </a>
        </nav>

        <div class="admin-global-actions">
          <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn w-100">Voir le site</a>
          <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button class="btn btn-success btn-sm admin-pill-btn w-100">Quitter l'admin</button>
          </form>
        </div>
      </aside>
    @endif

    <main class="page-content {{ $isAdminSpace ? 'page-content--admin' : '' }} {{ $isAdminEntreSpace ? 'page-content--admin-entre' : '' }}">
      @yield('content')
    </main>

    <footer class="site-footer">
      <div class="footer-shell">
        <div class="container px-3 px-md-4">
          <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-4">
              <div class="footer-brand-card">
                <div class="footer-brand">
                  <img src="/assets/quisolideo-logo.png" alt="Quisolideo">
                  <span>Quisolideo</span>
                </div>
                <div class="footer-tagline">Formations, mentorat et ressources pour passer de l'idee a l'action.</div>
                <div class="footer-meta">Adresse: BP 1234, Ville</div>
              </div>
            </div>

            <div class="col-6 col-lg-2">
              <div class="footer-col-title">Decouvrir</div>
              <div class="footer-links">
                <a class="footer-link" href="{{ route('home') }}">Accueil</a>
                <a class="footer-link" href="{{ route('about') }}">A propos</a>
                <a class="footer-link" href="{{ route('trainings.index') }}">Formations</a>
                <a class="footer-link" href="{{ route('partners.index') }}">Partenaires</a>
                <a class="footer-link" href="{{ route('contact') }}">Contact</a>
              </div>
            </div>

            <div class="col-6 col-lg-2">
              <div class="footer-col-title">Boutique</div>
              <div class="footer-links">
                <a class="footer-link" href="{{ route('shop.index') }}">Categories</a>
                <a class="footer-link" href="{{ route('cart.show') }}">Panier</a>
                @auth
                  <a class="footer-link" href="{{ route('account.profile') }}">Profil</a>
                @else
                  <a class="footer-link" href="{{ route('login') }}">Connexion</a>
                @endauth
              </div>
            </div>

            <div class="col-12 col-lg-4">
              <div class="footer-col-title">Newsletter</div>
              <div class="footer-newsletter-box footer-newsletter">
                <div class="footer-note">Recevez nos actualites, conseils pratiques et opportunites, 1 a 2 fois par mois.</div>
                <form method="POST" action="{{ route('newsletter.store') }}" class="footer-newsletter-form">
                  @csrf
                  <div class="footer-newsletter-row">
                    <input type="email" name="newsletter_email" class="form-control" placeholder="Votre adresse email" value="{{ old('newsletter_email') }}" autocomplete="email" required>
                    <button class="btn btn-success" type="submit">Je m'abonne</button>
                  </div>
                  <div class="footer-consent">Vous pouvez vous desabonner a tout moment.</div>
                </form>
                @if(session('newsletter_success'))
                  <div class="small mt-2 text-success-emphasis">{{ session('newsletter_success') }}</div>
                @endif
                @error('newsletter_email')
                  <div class="small mt-2 text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="footer-divider"></div>

          <div class="footer-bottom-row">
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
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07C2 17.06 5.66 21.2 10.44 21.95v-7.01H7.9v-2.9h2.54V9.41c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.23.2 2.23.2v2.45h-1.25c-1.23 0-1.61.77-1.61 1.56v1.87h2.74l-.44 2.9h-2.3V21.95C18.34 21.2 22 17.06 22 12.07z"/></svg>
              </a>
              <a href="#" aria-label="Instagram">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm5 7.3A4.7 4.7 0 1 0 16.7 14 4.7 4.7 0 0 0 12 9.3zM18.6 6.5a1.1 1.1 0 1 0 1.1 1.1 1.1 1.1 0 0 0-1.1-1.1z"/></svg>
              </a>
              <a href="#" aria-label="Twitter">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M22 5.92c-.63.28-1.3.48-2 .57a3.42 3.42 0 0 0 1.5-1.88 6.8 6.8 0 0 1-2.16.83A3.4 3.4 0 0 0 12.6 8.3a9.66 9.66 0 0 1-7-3.55 3.4 3.4 0 0 0 1.05 4.55c-.52 0-1.02-.16-1.45-.4 0 1.39.97 2.56 2.28 2.83a3.4 3.4 0 0 1-1.53.06c.43 1.35 1.68 2.33 3.16 2.36A6.85 6.85 0 0 1 4 18.2a9.66 9.66 0 0 0 5.22 1.53c6.26 0 9.69-5.18 9.69-9.68v-.44c.66-.46 1.22-1.04 1.66-1.7-.6.27-1.25.45-1.92.53z"/></svg>
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
          // Keep header stable: no shrink/expand behavior on scroll.
          nav.classList.remove('scrolled');

          const collapseEl = nav.querySelector('#siteNavbar');
          if (collapseEl && window.bootstrap && window.innerWidth < 992) {
            const collapse = bootstrap.Collapse.getOrCreateInstance(collapseEl, { toggle: false });
            const toggler = nav.querySelector('.navbar-toggler');
            nav.querySelectorAll('a.site-nav-link').forEach((link) => {
              link.addEventListener('click', () => collapse.hide());
            });

            // mobile: close menu when clicking outside the opened panel
            document.addEventListener('click', (event) => {
              if (window.innerWidth >= 992) return;
              if (!collapseEl.classList.contains('show')) return;

              const target = event.target;
              const clickedInsideMenu = collapseEl.contains(target);
              const clickedToggler = toggler && toggler.contains(target);
              if (!clickedInsideMenu && !clickedToggler) {
                collapse.hide();
              }
            });
          }
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

        const setBtnState = (btn, state) => {
          if (!btn) return;
          const icon = btn.querySelector('.shop-add-btn-icon');
          const label = btn.querySelector('.shop-add-btn-label');

          if (!btn.dataset.defaultLabel) {
            btn.dataset.defaultLabel = label ? label.textContent : btn.textContent.trim();
          }

          btn.classList.remove('is-loading', 'is-added');

          if (state === 'loading') {
            btn.classList.add('is-loading');
            if (icon) icon.textContent = '…';
            if (label) label.textContent = 'Ajout...';
            else btn.textContent = 'Ajout...';
            return;
          }

          if (state === 'added') {
            btn.classList.add('is-added');
            if (icon) icon.textContent = '✓';
            if (label) label.textContent = 'Ajoute';
            else btn.textContent = 'Ajoute';
            return;
          }

          if (icon && icon.textContent.trim() === '✓') icon.textContent = '+';
          if (label) label.textContent = btn.dataset.defaultLabel;
          else btn.textContent = btn.dataset.defaultLabel;
        };

        forms.forEach((form) => {
          form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const btn = form.querySelector('button[type="submit"]');
            if (btn) {
              btn.disabled = true;
              setBtnState(btn, 'loading');
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
                btn.disabled = false;
                setBtnState(btn, 'added');
              }
            } catch (err) {
              if (btn) {
                btn.disabled = false;
                setBtnState(btn, 'idle');
              }
              alert('Impossible d\'ajouter au panier.');
            }
          });
        });
      });
    </script>
  </body>
</html>
