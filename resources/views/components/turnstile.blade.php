{{-- Cloudflare Turnstile CAPTCHA Widget --}}
<div class="space-y-2">
    <label class="text-[11px] font-extrabold text-[#173A67]/40 uppercase tracking-widest ml-1">Verifikasi Keamanan</label>
    <div class="cf-turnstile" data-sitekey="{{ config('turnstile.site_key') }}" data-theme="{{ $theme ?? 'light' }}"></div>
</div>

@once
    @push('scripts')
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endpush
@endonce
