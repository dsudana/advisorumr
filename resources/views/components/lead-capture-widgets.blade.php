<!-- Exit Intent Popup for Lead Capture -->
<div id="exitIntentPopup" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg max-w-md w-full mx-4 p-6 relative animate-fade-in">
        <button onclick="closeExitPopup()" class="absolute top-2 right-2 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <div class="text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-2">🎁 Dapatkan Panduan Umroh Gratis!</h3>
            <p class="text-gray-600 mb-4">Download ebook eksklusif "Panduan Lengkap Umroh 2024" dengan tips, checklist, dan doa-doa penting.</p>
            
            <form id="leadMagnetForm" class="space-y-4">
                <div>
                    <input type="text" name="first_name" placeholder="Nama Lengkap" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <input type="email" name="email" placeholder="Email Anda" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                    📥 Download Sekarang - GRATIS!
                </button>
            </form>
            
            <p class="text-xs text-gray-500 mt-4">🔒 Kami menghargai privasi Anda. Unsubscribe kapan saja.</p>
        </div>
    </div>
</div>

<!-- Newsletter Subscription Form (Footer/Sidebar) -->
<div class="bg-gray-50 p-6 rounded-lg">
    <h4 class="font-bold text-lg mb-2">📬 Berlangganan Newsletter</h4>
    <p class="text-sm text-gray-600 mb-4">Dapatkan info promo dan tips umroh terbaru!</p>
    
    <form id="newsletterForm" class="space-y-3">
        <input type="email" name="email" placeholder="Email Anda" required 
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
        <input type="text" name="first_name" placeholder="Nama Depan" 
               class="w-full px-4 py-2 border border-gray-300 rounded-lg">
        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700 transition-colors">
            ✅ Subscribe
        </button>
    </form>
</div>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/6281234567890?text=Assalamualaikum,%20saya%20tertarik%20dengan%20paket%20umroh%20Anda" 
   target="_blank" 
   onclick="trackWhatsappClick()"
   class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition-all z-40 flex items-center gap-2 group">
    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
    </svg>
    <span class="hidden group-hover:inline font-semibold">Chat WhatsApp</span>
</a>

<!-- Click-to-Call Button -->
<a href="tel:+6281234567890" 
   onclick="trackPhoneClick()"
   class="fixed bottom-6 left-6 bg-blue-500 text-white p-4 rounded-full shadow-lg hover:bg-blue-600 transition-all z-40 flex items-center gap-2 group">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
    </svg>
    <span class="hidden group-hover:inline font-semibold">Hubungi Kami</span>
</a>

<script>
// Exit Intent Detection
let exitIntentShown = false;
let exitIntentTimer = null;

document.addEventListener('mouseleave', function(e) {
    if (e.clientY <= 0 && !exitIntentShown && sessionStorage.getItem('exitPopupShown') !== 'true') {
        showExitPopup();
    }
});

// Also show after delay for mobile
setTimeout(function() {
    if (!exitIntentShown && sessionStorage.getItem('exitPopupShown') !== 'true') {
        showExitPopup();
    }
}, 15000); // Show after 15 seconds

function showExitPopup() {
    exitIntentShown = true;
    sessionStorage.setItem('exitPopupShown', 'true');
    document.getElementById('exitIntentPopup').classList.remove('hidden');
}

function closeExitPopup() {
    document.getElementById('exitIntentPopup').classList.add('hidden');
}

// Lead Magnet Form Submission
document.getElementById('leadMagnetForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    data.resource = 'umroh-guide-2024';
    
    try {
        const response = await fetch('/api/download/resource', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Terima kasih! Download akan dimulai...');
            closeExitPopup();
            // Trigger download here
        }
    } catch (error) {
        console.error('Error:', error);
    }
});

// Newsletter Form Submission
document.getElementById('newsletterForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    try {
        const response = await fetch('/api/newsletter/subscribe', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Berhasil berlangganan! Terima kasih.');
            this.reset();
        }
    } catch (error) {
        console.error('Error:', error);
    }
});

// Track WhatsApp Click
function trackWhatsappClick() {
    fetch('/api/track/whatsapp', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ phone: '6281234567890' })
    });
}

// Track Phone Click
function trackPhoneClick() {
    fetch('/api/track/phone', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ phone: '+6281234567890' })
    });
}

// Auto-capture UTM parameters from URL
(function captureUTM() {
    const urlParams = new URLSearchParams(window.location.search);
    const utmParams = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'];
    
    utmParams.forEach(param => {
        if (urlParams.has(param)) {
            localStorage.setItem(param, urlParams.get(param));
        }
    });
})();

// Helper to get UTM params for forms
function getUTMParams() {
    return {
        utm_source: localStorage.getItem('utm_source'),
        utm_medium: localStorage.getItem('utm_medium'),
        utm_campaign: localStorage.getItem('utm_campaign'),
        utm_term: localStorage.getItem('utm_term'),
        utm_content: localStorage.getItem('utm_content')
    };
}
</script>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}
</style>
