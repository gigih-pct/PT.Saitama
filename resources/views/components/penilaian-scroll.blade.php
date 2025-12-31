@php
$containerId = $containerId ?? 'presensiScroll';
$hTrackId = $hTrackId ?? $containerId . '-h-scroll';
$hThumbId = $hThumbId ?? $containerId . '-h-thumb';
$vTrackId = $vTrackId ?? $containerId . '-v-scroll';
$vThumbId = $vThumbId ?? $containerId . '-v-thumb';
@endphp

<!-- Shared CSS for table scrolling and sticky cols (scoped for simplicity) -->
<style>
/* Minimal shared styles to replicate Presensi scroll behavior */
.{{ $containerId }}-wrapper, .presensi-wrapper { position: relative; }
.presensi-scroll { width: 100%; height: 70vh; overflow: auto; overflow-y: scroll; scrollbar-gutter: stable both-edges; -webkit-overflow-scrolling: touch; border: 1px solid #e5e7eb; }
.presensi-scroll::-webkit-scrollbar { display: none; } .presensi-scroll { -ms-overflow-style: none; scrollbar-width: none; }
.presensi-scroll table { min-width: 3200px; }
/* sticky columns */
.presensi-scroll table th, .presensi-scroll table td { white-space: nowrap; }
.sticky-col { position: sticky; background: white; }
.presensi-scroll thead .sticky-col { top: 0; z-index: 60; }
.presensi-scroll tbody .sticky-col { z-index: 40; }
.sticky-col-1 { left: 0; min-width: 56px; width: 56px; }
.sticky-col-2 { left: 56px; min-width: 260px; width: 260px; }
.sticky-col { box-shadow: 2px 0 0 rgba(0,0,0,0.06); }

/* Custom scrollbars (horizontal only by default) */
.custom-scroll { position: absolute; z-index: 30; background: transparent; }
.custom-scroll.custom-scroll-horizontal { left: 12px; right: 12px; bottom: 12px; height: 14px; display:flex; align-items:center; padding:0 8px; }
.custom-scroll .custom-scroll-thumb { background: rgba(0,0,0,0.22); border-radius:6px; height:8px; transition: background .15s ease, transform .06s ease; cursor:grab; min-width:24px; }
</style>

<!-- Custom scrollbars inserted as siblings of the container so they don't move -->
<div class="custom-scroll custom-scroll-horizontal" id="{{ $hTrackId }}" aria-hidden="false" role="group" aria-label="Horizontal table scrollbar">
    <div class="custom-scroll-thumb" id="{{ $hThumbId }}" role="slider" tabindex="0" aria-orientation="horizontal" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"></div>
</div>

<!-- JS: reuse logic from Presensi but scoped to IDs -->
<script>
(function(){
    const container = document.getElementById('{{ $containerId }}');
    const hThumb = document.getElementById('{{ $hThumbId }}');
    const hTrack = document.getElementById('{{ $hTrackId }}');
    if (!container || !hThumb || !hTrack) return;

    function updateTrackSizes() {
        const rect = container.getBoundingClientRect();
        if (hTrack) hTrack.style.width = rect.width + 'px';
    }

    function updateThumbs() {
        const cw = container.clientWidth, sw = container.scrollWidth;
        const hRatio = Math.min(1, cw / sw || 1);
        const hThumbWidth = Math.max(24, hRatio * (hTrack.clientWidth - 16));
        hThumb.style.width = hThumbWidth + 'px';
        const hMax = (hTrack.clientWidth - 16) - hThumbWidth;
        const hPos = (container.scrollLeft / Math.max(1, sw - cw)) * hMax;
        hThumb.style.transform = `translateX(${8 + hPos}px)`;
        const hPercent = Math.round((container.scrollLeft / Math.max(1, sw - cw)) * 100);
        hThumb.setAttribute('aria-valuenow', isFinite(hPercent) ? hPercent : 0);
    }

    container.addEventListener('scroll', updateThumbs);
    window.addEventListener('resize', function () { updateTrackSizes(); updateThumbs(); });
    updateTrackSizes(); updateThumbs();

    // Dragging
    let dragging = null;
    function startDrag(e) { dragging = { startX: e.clientX || e.touches?.[0]?.clientX, startScrollLeft: container.scrollLeft }; document.body.classList.add('user-select-none'); }
    function stopDrag() { dragging = null; document.body.classList.remove('user-select-none'); }
    function onDrag(e) { if (!dragging) return; const curX = e.clientX || e.touches?.[0]?.clientX; const dx = curX - dragging.startX; const sw = container.scrollWidth - container.clientWidth; const trackW = hTrack.clientWidth - 16 - hThumb.clientWidth; const scrollDelta = (dx / Math.max(1, trackW)) * Math.max(1, sw); container.scrollLeft = Math.max(0, Math.min(dragging.startScrollLeft + scrollDelta, sw)); }

    hThumb.addEventListener('pointerdown', (e) => { e.preventDefault(); if (e.pointerId) e.target.setPointerCapture?.(e.pointerId); startDrag(e); });
    document.addEventListener('pointermove', onDrag);
    document.addEventListener('pointerup', stopDrag);

    hTrack.addEventListener('click', function (e) { if (e.target === hThumb) return; const rect = hTrack.getBoundingClientRect(); const clickX = e.clientX - rect.left - 8; const sw = container.scrollWidth - container.clientWidth; const trackW = hTrack.clientWidth - 16 - hThumb.clientWidth; const pct = Math.max(0, Math.min(1, clickX / Math.max(1, trackW))); container.scrollLeft = pct * sw; });

    hThumb.addEventListener('keydown', function (e) { const step = Math.max(16, container.clientWidth * 0.1); if (e.key === 'ArrowLeft') { container.scrollLeft = Math.max(0, container.scrollLeft - step); e.preventDefault(); } if (e.key === 'ArrowRight') { container.scrollLeft = Math.min(container.scrollWidth - container.clientWidth, container.scrollLeft + step); e.preventDefault(); } if (e.key === 'Home') { container.scrollLeft = 0; e.preventDefault(); } if (e.key === 'End') { container.scrollLeft = container.scrollWidth; e.preventDefault(); } updateThumbs(); });
})();
</script>