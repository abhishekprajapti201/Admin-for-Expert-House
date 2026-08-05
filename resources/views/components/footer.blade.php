<footer class="relative overflow-hidden" style="background: var(--color-dark);">
    <div class="max-w-7xl mx-auto px-6 py-14 text-white">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            <div class="md:col-span-2">
                <h2 class="text-2xl font-extrabold mb-3">Research Centre for Diabetes, Hypertension and Obesity</h2>
                <p class="text-white/75 max-w-xl">
                    DrMukherjeeS Clinic Pvt. Ltd. provides structured diabetes, BP, obesity, metabolic, ultrasound, investigation and lifestyle-management care in Bihar.
                </p>
                <div class="space-y-2 text-white/75 text-sm mt-5">
                    <div>Holding #404, "Sukhadaya", New Yarpur Road #1, Patna - 800001</div>
                    <div>Bengali Tola, Samastipur - 848101, Bihar</div>
                    <div>Phone: 8002268003</div>
                    <div>Email: drmukherjees@gmail.com</div>
                </div>
            </div>

            <div>
                <h3 class="font-bold mb-4" style="color: var(--color-secondary);">Services</h3>
                <ul class="space-y-2 text-white/75 text-sm">
                    <li>Diabetes Care</li>
                    <li>Hypertension Management</li>
                    <li>Obesity & Lifestyle Clinic</li>
                    <li>Clinical Ultrasonology</li>
                    <li>Investigations & Monitoring</li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold mb-4" style="color: var(--color-secondary);">Clinic Hours</h3>
                <ul class="space-y-2 text-white/75 text-sm">
                    <li>New and old patients: 09:00 AM to 02:00 PM</li>
                    <li>Drug evaluation: 04:00 PM to 06:00 PM</li>
                    <li>Sunday closed</li>
                </ul>
                <a href="{{ url('/contact') }}" class="inline-block mt-5 px-5 py-3 rounded-lg font-bold text-sm text-white"
                    style="background: var(--color-primary);">Book Appointment</a>
            </div>
        </div>

        <div class="border-t border-white/15 mt-10 pt-6 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-white/60">
            <div>&copy; 2026 RCDHO. All rights reserved.</div>
            <a href="https://filliptechnologies.com/" target="_blank" rel="noopener noreferrer"
                class="inline-flex items-center gap-3 text-white/70 hover:text-white transition">
                <span>Designed and Developed by</span>
                <img src="{{ asset('images/Fillip-logo-white.webp') }}" alt="Fillip Technologies" class="h-7 w-auto">
            </a>
        </div>
    </div>
</footer>
