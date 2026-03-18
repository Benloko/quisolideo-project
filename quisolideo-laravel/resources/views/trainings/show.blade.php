@extends('layouts.app')

@section('content')
@php
  $heroImage = $training->image ?: optional($training->images->first())->path;

  $videos = $training->videos ?? collect();
  $hasVideos = $videos && $videos->count();
  $heroVideoSources = $hasVideos ? $videos->take(5)->pluck('path')->values()->all() : [];

  $galleryImages = [];
  if ($training->image) {
      $galleryImages[] = $training->image;
  }
  if ($training->images) {
      foreach ($training->images as $img) {
          $galleryImages[] = $img->path;
      }
  }
  $galleryImages = array_values(array_unique(array_filter($galleryImages)));
  $heroImageSources = array_slice($galleryImages, 0, 5);

    $registrationErrors = $errors->getBag('trainingRegistration');
    $registrationHasErrors = $registrationErrors && $registrationErrors->any();
    $registrationAutoOpen = request()->boolean('register') || $registrationHasErrors;
    $registrationStartStep = 1;
    if ($registrationHasErrors) {
        if ($registrationErrors->has('email') || $registrationErrors->has('phone')) {
        $registrationStartStep = 2;
      }
        if ($registrationErrors->has('photo')) {
          $registrationStartStep = 3;
        }
        if ($registrationErrors->has('message') || $registrationErrors->has('cv')) {
          $registrationStartStep = 4;
      }
    }
@endphp

<section
  class="page-hero page-hero--training training-hero {{ count($heroVideoSources) ? 'training-hero--clickable' : '' }}"
  @if($heroImage) style="--training-hero-image: url('{{ $heroImage }}');" @endif
  data-hero-videos='@json($heroVideoSources)'
  data-hero-images='@json($heroImageSources)'
>
  @if(count($heroVideoSources))
    <div class="training-hero-bg" aria-hidden="true">
      <video class="training-hero-bg-video is-active" muted playsinline autoplay loop preload="auto" @if($heroImage) poster="{{ $heroImage }}" @endif></video>
      <video class="training-hero-bg-video" muted playsinline autoplay loop preload="auto" @if($heroImage) poster="{{ $heroImage }}" @endif></video>
    </div>
  @endif
  <div class="container px-3 px-md-4">
    <a href="{{ route('trainings.index') }}" class="training-hero-back text-decoration-none">← Retour aux formations</a>

    <div class="row g-4 align-items-end mt-2">
      <div class="col-12">
        <div class="mt-2 d-flex flex-wrap gap-2 reveal" data-reveal-delay="0">
          <span class="section-badge">Formation <span class="emoji-twinkle" aria-hidden="true">✨</span></span>
          @if(!empty($training->seats) && (int) $training->seats > 0)
            <span class="section-badge">{{ (int) $training->seats }} places</span>
          @endif
          <span class="section-badge">Sur inscription</span>
        </div>

        <h1 class="mt-3 mb-2 reveal" data-reveal-delay="80">{{ $training->title }}</h1>
        <p class="mb-0 reveal" data-reveal-delay="140" style="max-width:80ch">
          {{ $training->short_description ?: \Illuminate\Support\Str::limit(strip_tags((string) $training->content), 180) }}
        </p>
      </div>
    </div>
  </div>
</section>

<section class="py-5 training-show">
  <div class="container px-3 px-md-4">
    <div class="row g-4">
      <div class="col-12 col-lg-7">
        @if($hasVideos)
          <div class="training-media-card reveal" data-reveal-delay="0">
            <video
              id="trainingMainVideo"
              class="training-media-main"
              controls
              playsinline
              preload="metadata"
              @if($heroImage) poster="{{ $heroImage }}" @endif
            >
              <source src="{{ $videos->first()->path }}">
            </video>
          </div>

          <div class="training-media-meta mt-3 d-flex align-items-center justify-content-between gap-3 flex-wrap reveal" data-reveal-delay="80">
            <div class="training-media-kicker">Vidéos de la formation</div>
            <a class="training-media-link" href="#training-videos">Voir toutes les vidéos + descriptions →</a>
          </div>

          @if($videos->count() > 1)
            <div class="training-thumbs mt-2 d-flex gap-2 reveal" data-reveal-delay="120" role="list">
              @foreach($videos as $idx => $video)
                <button
                  type="button"
                  data-training-video-thumb
                  data-src="{{ $video->path }}"
                  class="training-thumb p-0 border-0 bg-transparent"
                  aria-label="Voir la vidéo {{ $idx + 1 }}"
                  @if($idx === 0) aria-current="true" @endif
                  role="listitem"
                >
                  <video src="{{ $video->path }}" muted playsinline preload="metadata"></video>
                </button>
              @endforeach
            </div>
          @endif
        @else
          <div class="training-media-card reveal" data-reveal-delay="0">
            @if(count($galleryImages))
              <img id="trainingMainImage" class="training-media-main" src="{{ $galleryImages[0] }}" alt="{{ $training->title }}" loading="eager" decoding="async">
            @else
              <div class="training-media-placeholder" aria-hidden="true"></div>
            @endif
          </div>

          @if(count($galleryImages) > 1)
            <div class="training-thumbs mt-3 d-flex gap-2 reveal" data-reveal-delay="80" role="list">
              @foreach($galleryImages as $idx => $src)
                <button
                  type="button"
                  data-training-thumb
                  data-src="{{ $src }}"
                  class="training-thumb p-0 border-0 bg-transparent"
                  aria-label="Voir la photo {{ $idx + 1 }}"
                  @if($idx === 0) aria-current="true" @endif
                  role="listitem"
                >
                  <img src="{{ $src }}" alt="{{ $training->title }}" loading="lazy" decoding="async">
                </button>
              @endforeach
            </div>
          @endif
        @endif
      </div>

      <div class="col-12 col-lg-5">
        <aside class="training-side">
          <div class="training-side-card">
            <div class="training-side-title">Infos clés ✅</div>
            <div class="training-side-list">
              <div class="training-side-item">
                <div class="training-side-label">Format</div>
                <div class="training-side-value">Atelier pratique, avec accompagnement</div>
              </div>
              <div class="training-side-item">
                <div class="training-side-label">Tarif</div>
                <div class="training-side-value">
                  @if(!empty($training->price) && (float) $training->price > 0)
                    {{ number_format((float) $training->price, 0, ',', ' ') }} FCFA
                  @else
                    Sur devis (selon le format et le groupe)
                  @endif
                </div>
              </div>
              <div class="training-side-item">
                <div class="training-side-label">Inscription</div>
                <div class="training-side-value">Demande simple — réponse rapide et proposition claire</div>
              </div>
            </div>
          </div>

          <div class="training-side-card mt-3">
            <div class="training-side-title">Vous repartez avec ✨</div>
            <div class="training-perks">
              <div class="training-perk">Une méthode claire, étape par étape</div>
              <div class="training-perk">Des exemples concrets + exercices guidés</div>
              <div class="training-perk">Un plan d’action pour avancer dès la fin</div>
            </div>
          </div>
        </aside>
      </div>
    </div>

    <div class="row g-4 mt-2">
      <div class="col-12">
        <div class="training-content-card reveal" data-reveal-delay="120">
          <div class="training-content p-4 p-md-5">
            @if($hasVideos)
              <div id="training-videos" class="training-section">
                <div class="training-section-title">Toutes les vidéos + descriptions</div>
                <div class="training-video-list">
                  @foreach($videos as $idx => $video)
                    <div class="training-video-item">
                      <video controls playsinline preload="metadata" @if($heroImage) poster="{{ $heroImage }}" @endif>
                        <source src="{{ $video->path }}">
                      </video>
                      <div class="training-video-body">
                        <div class="training-video-kicker">Vidéo {{ $idx + 1 }}</div>
                        <div class="training-video-desc">
                          {{ $video->description ?: 'Description à venir.' }}
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
              <hr class="my-4">
            @endif

            <div class="training-section-title">Programme / Détails</div>
            @if(!empty($training->content))
              {!! $training->content !!}
            @else
              <div class="text-muted" style="line-height:1.75">
                Le contenu de cette formation sera publié très prochainement.
              </div>
            @endif

            <div class="training-cta mt-4">
              <div class="training-cta-card">
                <div class="training-cta-title">Prêt à passer à l’action ?</div>
                <div class="training-cta-sub">Dites-nous ce que vous cherchez : on vous propose le format adapté.</div>
                <div class="d-flex gap-2 flex-wrap mt-3">
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#trainingRegistrationModal">S’inscrire 🚀</button>
                  <a href="{{ route('contact') }}" class="btn btn-outline-secondary">Poser une question</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div
  class="modal fade training-register-modal"
  id="trainingRegistrationModal"
  tabindex="-1"
  aria-hidden="true"
  aria-labelledby="trainingRegistrationModalTitle"
  data-auto-open="{{ $registrationAutoOpen ? '1' : '0' }}"
  data-start-step="{{ (int) $registrationStartStep }}"
>
  <div class="modal-dialog modal-dialog-centered" style="--bs-modal-width: 480px;">
    <div class="modal-content shadow-lg rounded-4">
      <div class="modal-body p-4">
        <div class="d-flex justify-content-between align-items-start gap-3">
          <div>
            <div class="small text-muted fw-semibold">Inscription</div>
            <div class="h5 mb-1" id="trainingRegistrationModalTitle" style="font-weight:900;color:var(--brand-dark)">Demande d’inscription</div>
            <div class="small text-muted">Étape <span data-training-step-current>1</span>/<span data-training-step-total>4</span> — <span class="fw-semibold">{{ $training->title }}</span></div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>

        <div class="progress mt-3" style="height:6px">
          <div class="progress-bar" role="progressbar" style="width: 0" data-training-step-progress></div>
        </div>

        <form method="POST" action="{{ route('trainings.register.submit', $training->slug) }}" enctype="multipart/form-data" class="mt-4" data-training-registration-form>
          @csrf

          <div data-training-step="1">
            <div class="mb-3" style="font-weight:900;color:var(--brand-dark)">Vos informations</div>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold">Prénom</label>
                <input name="first_name" class="form-control @error('first_name', 'trainingRegistration') is-invalid @enderror" value="{{ old('first_name') }}" required autocomplete="given-name">
                @error('first_name', 'trainingRegistration')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="col-12">
                <label class="form-label fw-bold">Nom</label>
                <input name="last_name" class="form-control @error('last_name', 'trainingRegistration') is-invalid @enderror" value="{{ old('last_name') }}" required autocomplete="family-name">
                @error('last_name', 'trainingRegistration')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="col-12">
                <label class="form-label fw-bold">Niveau d’étude</label>
                <select name="education_level" class="form-select @error('education_level', 'trainingRegistration') is-invalid @enderror" required>
                  <option value="Même pas de niveau" {{ (old('education_level') === null || old('education_level') === 'Même pas de niveau') ? 'selected' : '' }}>Même pas de niveau</option>
                  <option value="CEP" {{ old('education_level') === 'CEP' ? 'selected' : '' }}>CEP</option>
                  <option value="BEPC" {{ old('education_level') === 'BEPC' ? 'selected' : '' }}>BEPC</option>
                  <option value="CAP / BEP" {{ old('education_level') === 'CAP / BEP' ? 'selected' : '' }}>CAP / BEP</option>
                  <option value="BAC" {{ old('education_level') === 'BAC' ? 'selected' : '' }}>BAC</option>
                  <option value="BTS / DUT" {{ old('education_level') === 'BTS / DUT' ? 'selected' : '' }}>BTS / DUT</option>
                  <option value="Licence" {{ old('education_level') === 'Licence' ? 'selected' : '' }}>Licence</option>
                  <option value="Master" {{ old('education_level') === 'Master' ? 'selected' : '' }}>Master</option>
                  <option value="Doctorat" {{ old('education_level') === 'Doctorat' ? 'selected' : '' }}>Doctorat</option>
                  <option value="Autre" {{ old('education_level') === 'Autre' ? 'selected' : '' }}>Autre</option>
                </select>
                @error('education_level', 'trainingRegistration')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>
          </div>

          <div class="d-none" data-training-step="2">
            <div class="mb-3" style="font-weight:900;color:var(--brand-dark)">Pour vous recontacter</div>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control @error('email', 'trainingRegistration') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                @error('email', 'trainingRegistration')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="col-12">
                <label class="form-label fw-bold">Téléphone</label>
                <input name="phone" class="form-control @error('phone', 'trainingRegistration') is-invalid @enderror" value="{{ old('phone') }}" required autocomplete="tel">
                @error('phone', 'trainingRegistration')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
            </div>
          </div>

          <div class="d-none" data-training-step="3">
            <div class="mb-3" style="font-weight:900;color:var(--brand-dark)">Votre photo</div>
            <div class="row g-3">
              <div class="col-12">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                  <div class="training-register-avatar training-register-avatar--lg" data-training-photo-avatar aria-hidden="true">
                    <img data-training-photo-preview alt="">
                    <div class="training-register-avatar-placeholder">Photo</div>
                  </div>
                  <div class="flex-grow-1">
                    <input type="file" name="photo" accept="image/*" class="form-control @error('photo', 'trainingRegistration') is-invalid @enderror" required data-training-photo-input>
                    @error('photo', 'trainingRegistration')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="form-text">Importez une photo claire (JPG / PNG / WebP).</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="d-none" data-training-step="4">
            <div class="mb-3" style="font-weight:900;color:var(--brand-dark)">Votre message</div>
            <div class="row g-3">
              <div class="col-12">
                <label class="form-label fw-bold">Message</label>
                <textarea name="message" class="form-control @error('message', 'trainingRegistration') is-invalid @enderror" rows="5" required placeholder="Votre besoin, vos disponibilités, vos questions…">{{ old('message') }}</textarea>
                @error('message', 'trainingRegistration')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>

              <div class="col-12">
                <div class="training-register-upload">
                  <input
                    id="trainingCvInput"
                    type="file"
                    name="cv"
                    class="d-none @error('cv', 'trainingRegistration') is-invalid @enderror"
                    accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                    data-training-cv-input
                  >
                  <label for="trainingCvInput" class="btn btn-outline-secondary w-100 text-start">
                    Cliquez ici pour nous envoyer votre CV <span class="text-muted fw-normal">(optionnel)</span>
                  </label>
                  @error('cv', 'trainingRegistration')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                  @enderror
                  <div class="small text-muted mt-2" data-training-cv-name></div>
                </div>
              </div>

              <div class="col-12">
                <div class="text-muted small">En envoyant ce formulaire, vous acceptez d’être recontacté au sujet de cette formation.</div>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-between align-items-center mt-4">
            <button type="button" class="btn btn-outline-secondary" data-training-step-back>Retour</button>
            <button type="button" class="btn btn-success" data-training-step-next>Continuer</button>
            <button type="submit" class="btn btn-success d-none" data-training-step-submit>Envoyer ma demande 🚀</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@if(session('registration_success'))
  <div class="modal fade training-register-success" id="trainingRegistrationSuccessModal" tabindex="-1" aria-hidden="true" aria-labelledby="trainingRegistrationSuccessModalTitle">
    <div class="modal-dialog modal-dialog-centered" style="--bs-modal-width: 440px;">
      <div class="modal-content shadow-lg rounded-4">
        <div class="modal-body p-4">
          <div class="d-flex justify-content-between align-items-start gap-3">
            <div>
              <div class="small text-muted fw-semibold">Inscription</div>
              <div class="h5 mb-0" id="trainingRegistrationSuccessModalTitle" style="font-weight:900;color:var(--brand-dark)">Message envoyé ✅</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
          </div>

          <div class="mt-3" style="color:#223026;line-height:1.65">
            {{ session('registration_success') }}
          </div>

          <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif

@if($hasVideos && $videos->count() > 1)
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const main = document.getElementById('trainingMainVideo');
      if (!main) return;

      const thumbs = Array.from(document.querySelectorAll('[data-training-video-thumb]'));
      thumbs.forEach((btn) => {
        btn.addEventListener('click', () => {
          const src = btn.getAttribute('data-src');
          if (!src) return;

          const source = main.querySelector('source');
          if (source) {
            source.setAttribute('src', src);
            main.load();
          }

          thumbs.forEach((b) => b.removeAttribute('aria-current'));
          btn.setAttribute('aria-current', 'true');
        });
      });
    });
  </script>
@elseif(count($galleryImages) > 1)
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const main = document.getElementById('trainingMainImage');
      if (!main) return;

      const thumbs = Array.from(document.querySelectorAll('[data-training-thumb]'));
      thumbs.forEach((btn) => {
        btn.addEventListener('click', () => {
          const src = btn.getAttribute('data-src');
          if (!src) return;

          main.setAttribute('src', src);

          thumbs.forEach((b) => b.removeAttribute('aria-current'));
          btn.setAttribute('aria-current', 'true');
        });
      });
    });
  </script>
@endif

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const hero = document.querySelector('.training-hero');
    if (!hero) return;

    const reducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    let heroVideos = [];
    let heroImages = [];
    try {
      heroVideos = JSON.parse(hero.getAttribute('data-hero-videos') || '[]') || [];
    } catch (e) {
      heroVideos = [];
    }
    try {
      heroImages = JSON.parse(hero.getAttribute('data-hero-images') || '[]') || [];
    } catch (e) {
      heroImages = [];
    }

    // Click on hero => jump to videos section
    if (Array.isArray(heroVideos) && heroVideos.length) {
      hero.addEventListener('click', function (e) {
        if (e.target && e.target.closest && e.target.closest('a, button, input, textarea, select, label')) {
          return;
        }
        const target = document.getElementById('training-videos');
        if (!target) return;
        target.scrollIntoView({ behavior: reducedMotion ? 'auto' : 'smooth', block: 'start' });
      });
    }

    // 1) Background videos (preferred): rotate every 10s
    if (Array.isArray(heroVideos) && heroVideos.length) {
      const vids = Array.from(hero.querySelectorAll('.training-hero-bg-video'));
      if (!vids.length) return;

      let active = vids[0];
      let standby = vids[1] || vids[0];
      let idx = 0;
      let lock = false;

      const safePlay = (el) => {
        const p = el.play();
        if (p && typeof p.catch === 'function') {
          p.catch(() => {});
        }
      };

      const setSrc = (el, src) => {
        el.src = src;
        el.load();
        safePlay(el);
      };

      setSrc(active, heroVideos[0]);
      active.classList.add('is-active');
      standby.classList.remove('is-active');

      if (reducedMotion) {
        return;
      }

      if (heroVideos.length < 2) {
        return;
      }

      const rotate = () => {
        if (lock) return;
        lock = true;

        idx = (idx + 1) % heroVideos.length;
        const nextSrc = heroVideos[idx];

        let swapped = false;
        const doSwap = () => {
          if (swapped) return;
          swapped = true;

          standby.classList.add('is-active');
          active.classList.remove('is-active');
          active.pause();

          const tmp = active;
          active = standby;
          standby = tmp;

          lock = false;
        };

        standby.addEventListener('canplay', doSwap, { once: true });
        setSrc(standby, nextSrc);
        setTimeout(doSwap, 1400);
      };

      setInterval(rotate, 10000);
      return;
    }

    // 2) Background images (fallback): rotate every 3s
    if (!reducedMotion && Array.isArray(heroImages) && heroImages.length > 1) {
      let idx = 0;
      setInterval(() => {
        idx = (idx + 1) % heroImages.length;
        const src = heroImages[idx];
        if (!src) return;
        hero.style.setProperty('--training-hero-image', `url('${src}')`);
      }, 3000);
    }
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modalEl = document.getElementById('trainingRegistrationModal');
    if (!modalEl) return;

    const form = modalEl.querySelector('[data-training-registration-form]');
    const stepEls = Array.from(modalEl.querySelectorAll('[data-training-step]'));
    if (!form || !stepEls.length) return;

    const totalSteps = stepEls.length;
    const startStepRaw = parseInt(modalEl.getAttribute('data-start-step') || '1', 10);
    const startStep = Math.min(Math.max(Number.isFinite(startStepRaw) ? startStepRaw : 1, 1), totalSteps);

    const currentLabel = modalEl.querySelector('[data-training-step-current]');
    const totalLabel = modalEl.querySelector('[data-training-step-total]');
    const progress = modalEl.querySelector('[data-training-step-progress]');
    const backBtn = modalEl.querySelector('[data-training-step-back]');
    const nextBtn = modalEl.querySelector('[data-training-step-next]');
    const submitBtn = modalEl.querySelector('[data-training-step-submit]');

    let currentStep = startStep;

    if (totalLabel) {
      totalLabel.textContent = String(totalSteps);
    }

    const setDisabledForStep = (stepEl, disabled) => {
      const fields = stepEl.querySelectorAll('input, textarea, select');
      fields.forEach((el) => {
        el.disabled = disabled;
      });
    };

    const setStep = (step) => {
      const next = Math.min(Math.max(step, 1), totalSteps);
      currentStep = next;

      stepEls.forEach((el) => {
        const s = parseInt(el.getAttribute('data-training-step') || '0', 10);
        const active = s === currentStep;
        el.classList.toggle('d-none', !active);
        setDisabledForStep(el, !active);
      });

      if (currentLabel) currentLabel.textContent = String(currentStep);
      if (progress) progress.style.width = `${Math.round((currentStep / totalSteps) * 100)}%`;

      if (backBtn) backBtn.disabled = currentStep === 1;
      if (nextBtn) nextBtn.classList.toggle('d-none', currentStep === totalSteps);
      if (submitBtn) submitBtn.classList.toggle('d-none', currentStep !== totalSteps);
    };

    const validateCurrentStep = () => {
      const active = stepEls.find((el) => parseInt(el.getAttribute('data-training-step') || '0', 10) === currentStep);
      if (!active) return true;

      const fields = Array.from(active.querySelectorAll('input, textarea, select'))
        .filter((el) => !el.disabled);

      for (const field of fields) {
        if (typeof field.reportValidity === 'function' && !field.reportValidity()) {
          field.focus?.();
          return false;
        }
      }
      return true;
    };

    if (backBtn) {
      backBtn.addEventListener('click', () => setStep(currentStep - 1));
    }
    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        if (!validateCurrentStep()) return;
        setStep(currentStep + 1);
      });
    }

    form.addEventListener('submit', () => {
      form.querySelectorAll('input, textarea, select').forEach((el) => {
        el.disabled = false;
      });
    });

    form.addEventListener('keydown', (e) => {
      if (e.key !== 'Enter') return;
      if (currentStep >= totalSteps) return;
      if (!nextBtn) return;
      const tag = (e.target && e.target.tagName) ? e.target.tagName.toLowerCase() : '';
      if (tag === 'textarea') return;
      e.preventDefault();
      nextBtn.click();
    });

    // Photo preview in circle
    const avatar = modalEl.querySelector('[data-training-photo-avatar]');
    const previewImg = modalEl.querySelector('[data-training-photo-preview]');
    const photoInput = modalEl.querySelector('[data-training-photo-input]');
    let objectUrl = null;
    const clearPreview = () => {
      if (objectUrl) {
        URL.revokeObjectURL(objectUrl);
        objectUrl = null;
      }
      if (previewImg) previewImg.removeAttribute('src');
      if (avatar) avatar.classList.remove('has-photo');
    };
    if (photoInput && avatar && previewImg && typeof URL !== 'undefined') {
      photoInput.addEventListener('change', () => {
        const file = photoInput.files && photoInput.files[0];
        if (!file) {
          clearPreview();
          return;
        }
        clearPreview();
        objectUrl = URL.createObjectURL(file);
        previewImg.src = objectUrl;
        avatar.classList.add('has-photo');
      });
    }

    // CV filename
    const cvInput = modalEl.querySelector('[data-training-cv-input]');
    const cvName = modalEl.querySelector('[data-training-cv-name]');
    if (cvInput && cvName) {
      const render = () => {
        const file = cvInput.files && cvInput.files[0];
        cvName.textContent = file ? `Fichier sélectionné : ${file.name}` : '';
      };
      cvInput.addEventListener('change', render);
      render();
    }

    if (window.bootstrap && window.bootstrap.Modal) {
      modalEl.addEventListener('show.bs.modal', () => {
        setStep(startStep);
      });
      modalEl.addEventListener('shown.bs.modal', () => {
        const active = stepEls.find((el) => parseInt(el.getAttribute('data-training-step') || '0', 10) === currentStep);
        const firstField = active ? active.querySelector('input, textarea, select') : null;
        firstField?.focus?.();
      });
    }

    // Initialize state even before opening
    setStep(startStep);

    // Auto-open (direct /inscription redirect or validation errors)
    const autoOpen = modalEl.getAttribute('data-auto-open') === '1';
    if (autoOpen && window.bootstrap && window.bootstrap.Modal) {
      window.bootstrap.Modal.getOrCreateInstance(modalEl).show();
    }
  });
</script>

@if(session('registration_success'))
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const successEl = document.getElementById('trainingRegistrationSuccessModal');
      if (!successEl) return;
      if (window.bootstrap && window.bootstrap.Modal) {
        window.bootstrap.Modal.getOrCreateInstance(successEl).show();
      }
    });
  </script>
@endif
@endsection
