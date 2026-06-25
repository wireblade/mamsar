<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 flex flex-col items-center justify-center p-10 relative overflow-hidden">

    <a href="{{ url()->previous() }}" 
    class="absolute top-6 left-6 flex items-center gap-2 text-white/70 hover:text-white transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <span class="text-sm font-medium">Back</span>
    </a>

    {{-- Decorative circles --}}
    <div class="absolute -top-20 -left-20 w-72 h-72 rounded-full border border-white/5 pointer-events-none"></div>
    <div class="absolute -top-10 -left-10 w-48 h-48 rounded-full border border-white/10 pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-96 h-96 rounded-full border border-white/5 pointer-events-none"></div>
    <div class="absolute -bottom-10 -right-10 w-56 h-56 rounded-full border border-white/10 pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full border border-white/5 pointer-events-none"></div>

     {{-- Title --}}
        <div style="text-align:center; margin-bottom:30px;">
            <h2 style="color:#ffffff; font-size:22px; font-weight:700; letter-spacing:2px; margin:0; text-transform:uppercase;">Employee ID Card</h2>
            <div style="width:60px; height:3px; background:#f0c040; margin:10px auto 0; border-radius:2px;"></div>
        </div>
       
    <div class="print-area flex items-center justify-center gap-6">
        <!-- FRONT -->
        <div class="relative" id="id-front" style="width: 272px; height: 430px; overflow: hidden;">
        
            <img src="{{ asset('storage/id_template/front.jpg') }}" style="width: 100%; height: 100%; display: block;">
            <img src="{{ asset('storage/' . $picture) }}" class="absolute object-cover" style="top:121px; left:57px; width:158px; height:153.3px;">

            <div class="absolute text-center" style="top:272px; left:0; right:0;">
                <div style="font-size:10px; font-weight:700; padding:4px 8px; line-height:1.2; color:#000000;">
                    {{$employeeId}}
                </div>

                <div style="overflow:hidden; width:95%;" class="mx-auto">
                    <span
                        style="font-weight:bold; line-height:2; color:#000000; white-space:nowrap; display:inline-block; font-size:13px;"
                        x-data
                        x-init="
                            const el = $el;
                            const parent = el.parentElement;
                            if (el.offsetWidth > parent.offsetWidth) {
                                const scale = parent.offsetWidth / el.offsetWidth;
                                el.style.transform = 'scaleX(' + scale + ')';
                                el.style.transformOrigin = 'left center';
                            }
                        "
                    >
                         {{strtoupper($fname)}} {{strtoupper(substr($mname, 0, 1))}}. {{strtoupper($lname)}} 
                         @if($suffix) {{strtoupper($suffix)}}. @endif

                    </span>
                </div>

                <div style="font-size:10px; font-weight:700; padding:4px 8px; line-height:1.2; margin-top:-8px; color:#000000;">
                    {{$position}}
                </div>
            </div>
        </div>

        <!-- BACK -->
        <div class="relative" id="id-back" style="width: 272px; height: 430px; overflow: hidden;">

            <img src="{{ asset('storage/id_template/back.jpg') }}" style="width: 100%; height: 100%; display: block;">
        
            <div class="absolute text-center" style="top:20px; left:0; right:0;">

                {{-- <div style="font-size:12px; color:#000000;">
                    <header class="float-left px-6">Date of Birth</header>
                    <colon class="float-left px-7">:</colon>
                    <dob class="-ml-15">{{ \Carbon\Carbon::parse($dob)->format('F j, Y') }}</dob>
                </div>
                <div style="font-size:12px; color:#000000;">
                    <header class="float-left px-6">SSS</header>
                    <colon class="float-left px-19">:</colon>
                    <dob class="-ml-27">{{ \Carbon\Carbon::parse($dob)->format('F j, Y') }}</dob>
                </div> --}}

                <div class="px-6 grid grid-cols-[120px_10px_1fr] text-[11px] text-black w-full font-semibold">
                    <div class="text-left">Date of Birth</div>
                    <div class="text-center">:</div>
                    <div class="text-left ml-1.5"> {{ \Carbon\Carbon::parse($dob)->format('F j, Y') }} </div>

                    <div class="text-left">SSS</div>
                    <div class="text-center">:</div>
                    <div class="text-left ml-1.5">{{ $sss }}</div>

                    <div class="text-left">TIN</div>
                    <div class="text-center">:</div>
                    <div class="text-left ml-1.5">{{ $tin }}</div>

                    <div class="text-left">PhilHealth</div>
                    <div class="text-center">:</div>
                    <div class="text-left ml-1.5">{{ $philhealth }}</div>

                    <div class="text-left">Civil Status</div>
                    <div class="text-center">:</div>
                    <div class="text-left ml-1.5">{{ $status }}</div>
                </div>      
                    
                {{-- <div class="font-size:10px; float:center; line-height:1.5; margin-top:25px; color:#000000;"> --}}

                <div class="text-[12px] mt-3 text-black font-medium leading-normal w-full">

                    <div class="w-3/4 mx-auto text-center font-semibold"> {{$address}} </div>

                    <div>Home Address</div>

                </div>

                <div class="text-[12px] mt-2 text-black font-medium leading-normal w-full">
                    IN CASE OF EMERGENCY, PLASE NOTIFY <br>
                    <div class="mx-auto text-center font-bold">{{ $iceName }}</div>

                    <div class="mx-auto text-center">Contact No.: {{ $iceNo }}</div>
                </div>

                <div class="text-[11px] mt-2 text-black font-normal text-justify p-3 leading-normal w-full">
                    This card is the property of <font class="font-extrabold">MAMSAR 
                    CONSTRUCTION AND INDUSTRIAL
                    CORPORATION</font> and must be surrendered 
                    upon termination of employement.
                </div>

            </div>

            {{-- <div x-data="{ x: 85, y: 330, dragging: false }"
                    @mousedown="dragging = true"
                    @mouseup.window="dragging = false"
                    @mousemove.window="
                        if (dragging) {
                            let rect = $el.parentElement.getBoundingClientRect();
                            x = $event.clientX - rect.left - 50;
                            y = $event.clientY - rect.top - 20;
                        }
                    "
                    class="absolute"
                    :style="`top:${y}px; left:${x}px; cursor:move;`"
                >
                <img src="{{ asset('storage/' . $signature) }}" class="w-17 object-cover pointer-events-none">
            </div> --}}
            
            <div 
                x-data="{ 
                    x: 100, y: 320, 
                    w: 68, h: 110,
                    dragging: false,
                    resizing: false,
                    startX: 0, startY: 0,
                    startW: 0, startH: 0
                }"
                @mousedown.self="dragging = true; startX = $event.clientX; startY = $event.clientY;"
                @mouseup.window="dragging = false; resizing = false"
                @mousemove.window="
                    if (resizing) {
                        let dx = $event.clientX - startX;
                        let dy = $event.clientY - startY;
                        w = Math.max(30, startW + dx);
                        h = Math.max(30, startH + dy);
                    } else if (dragging) {
                        let rect = $el.parentElement.getBoundingClientRect();
                        x = $event.clientX - rect.left - (w / 2);
                        y = $event.clientY - rect.top - (h / 2);
                    }
                "
                            class="absolute"
                            :style="`top:${y}px; left:${x}px; width:${w}px; height:${h}px; cursor:move; position:absolute;  overflow:hidden;`"
                        >
                <img
                    src="{{ asset('storage/' . $signature) }}" 
                    class="pointer-events-none"
                    style="object-fit:contain;"
                >

                <!-- Resize handle (bottom-right corner) -->
                <div class="resize-handle"
                    style="
                    position: absolute;
                    bottom: 0px; right: 0px;
                    width: 14px; height: 14px;
                    background: white;
                    border: 2px solid #555;
                    border-radius: 3px;
                    cursor: se-resize;
                                "
                            @mousedown.stop="
                    resizing = true;
                    startX = $event.clientX;
                    startY = $event.clientY;
                    startW = w;
                    startH = h;
                "
                            >
                </div>
            </div>

        </div>
    </div>


    {{-- Download Buttons --}}
        <div style="display:flex; gap:12px; justify-content:center; margin-top:30px; flex-wrap:wrap;">
            <button onclick="downloadCard('id-front', 'ID_Front_{{ $employeeId }}')"
                style="padding:10px 24px; background:#2563eb; color:#fff; border:none; border-radius:8px; font-weight:600; cursor:pointer; font-size:14px; display:flex; align-items:center; gap:8px;">
                ⬇ Download Front
            </button>
            <button onclick="downloadCard('id-back', 'ID_Back_{{ $employeeId }}')"
                style="padding:10px 24px; background:#16a34a; color:#fff; border:none; border-radius:8px; font-weight:600; cursor:pointer; font-size:14px; display:flex; align-items:center; gap:8px;">
                ⬇ Download Back
            </button>
            <button onclick="downloadBoth()"
                style="padding:10px 24px; background:#f0c040; color:#1a3a5c; border:none; border-radius:8px; font-weight:700; cursor:pointer; font-size:14px; display:flex; align-items:center; gap:8px;">
                ⬇ Download Both
            </button>
        </div>

    <script>
    async function downloadCard(elementId, filename) {
        const element = document.getElementById(elementId);

        // Forcefully inline all computed styles, replacing oklch
        const allEls = [element, ...element.querySelectorAll('*')];
        allEls.forEach(el => {
            const computed = window.getComputedStyle(el);
            const props = [
                'color', 'backgroundColor', 'borderTopColor',
                'borderBottomColor', 'borderLeftColor', 'borderRightColor',
                'outlineColor', 'textDecorationColor', 'caretColor',
                'columnRuleColor', 'webkitTextFillColor'
            ];
            props.forEach(prop => {
                try {
                    const val = computed[prop];
                    if (val && (val.includes('oklch') || val.includes('oklab') || val.includes('color('))) {
                        el.style[prop] = '#000000';
                        if (prop === 'backgroundColor') {
                            el.style[prop] = 'transparent';
                        }
                    }
                } catch(e) {}
            });
        });

        // Small delay to let styles apply
        await new Promise(r => setTimeout(r, 100));

        try {
            const canvas = await html2canvas(element, {
                scale: 3,
                useCORS: true,
                allowTaint: true,
                backgroundColor: '#ffffff',
                logging: false,
                ignoreElements: (el) => {
                    // Ignore elements outside our card
                    return false;
                },
                onclone: function(clonedDoc) {
                     // Hide resize handles
                    clonedDoc.querySelectorAll('.resize-handle').forEach(el => el.style.display = 'none');

                     // Fix the signature container — remove the extra space caused by the handle sticking outside
                    clonedDoc.querySelectorAll('[style*="cursor:move"]').forEach(el => {
                        el.style.overflow = 'hidden';
                        el.style.position = 'absolute';
            });
                    // Fix oklch in the cloned document
                    const allCloned = clonedDoc.querySelectorAll('*');
                    allCloned.forEach(el => {
                        const style = el.getAttribute('style') || '';
                        if (style.includes('oklch') || style.includes('oklab')) {
                            el.style.color = '#000000';
                            el.style.backgroundColor = 'transparent';
                        }

                        // Also patch computed styles in clone
                        try {
                            const props = ['color','backgroundColor','borderTopColor',
                                        'borderBottomColor','borderLeftColor','borderRightColor'];
                            props.forEach(prop => {
                                if (el.style[prop] && (
                                    el.style[prop].includes('oklch') ||
                                    el.style[prop].includes('oklab')
                                )) {
                                    el.style[prop] = prop === 'backgroundColor' 
                                        ? 'transparent' : '#000000';
                                }
                            });
                        } catch(e) {}
                    });

                    // Inject fix CSS into cloned doc
                    const fixStyle = clonedDoc.createElement('style');
                    fixStyle.textContent = `* { 
                        --tw-shadow: none !important;
                    }`;
                    clonedDoc.head.appendChild(fixStyle);
                }
            });

            canvas.toBlob(function(blob) {
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.download = filename + '.jpg';
                link.style.display = 'none';
                document.body.appendChild(link);
                link.click();
                setTimeout(function() {
                    document.body.removeChild(link);
                    URL.revokeObjectURL(url);
                }, 100);
            }, 'image/jpeg');

        } catch(err) {
            console.error('html2canvas error:', err);
            alert('Error: ' + err.message);
        }
    }

    async function downloadBoth() {
        await downloadCard('id-front', 'ID_Front');
        await new Promise(r => setTimeout(r, 1200));
        await downloadCard('id-back', 'ID_Back');
    }
    </script>
</div>