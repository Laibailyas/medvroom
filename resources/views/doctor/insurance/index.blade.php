<x-doctor-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black tracking-tighter text-slate-900">Insurance Networks</h1>
                <p class="text-slate-500 font-bold mt-1 uppercase tracking-widest text-[10px]">Manage the insurance plans your practice accepts.</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" form="insurance-form" class="px-8 py-4 bg-primary text-slate-900 rounded-[1.5rem] font-black text-sm hover:scale-105 transition-all shadow-xl shadow-primary/20 ">
                    Update Participation
                </button>
            </div>
        </div>

        <!-- Summary Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-slate-900 rounded-[2rem] p-8 text-white shadow-xl shadow-slate-900/10 flex items-center gap-6">
                <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center text-primary group-hover:rotate-6 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest leading-none">Accepted Networks</p>
                    <h3 id="accepted-count" class="text-3xl font-black tracking-tighter mt-1">{{ count($acceptedPlanIds) }}</h3>
                </div>
            </div>
        </div>

        <form id="insurance-form" action="{{ route('doctor.insurance.update') }}" method="POST" class="space-y-12 pb-20">
            @csrf
            @method('PATCH')

            @foreach($groupedPlans as $category => $plans)
                <div class="space-y-5">
                    <h2 class="text-xl font-black tracking-tighter text-slate-900">{{ $category }}</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                        @foreach($plans as $plan)
                            <label class="flex items-center gap-3 p-5 bg-white border border-slate-100 rounded-2xl cursor-pointer hover:bg-slate-50 transition-all shadow-sm">
                                <input
                                    type="checkbox"
                                    name="plans[]"
                                    value="{{ $plan->id }}"
                                    {{ in_array($plan->id, $acceptedPlanIds) ? 'checked' : '' }}
                                    class="sr-only peer insurance-checkbox"
                                >
                                <div class="w-5 h-5 rounded-md border-2 border-slate-200 peer-checked:bg-primary peer-checked:border-primary flex items-center justify-center transition-all shrink-0">
                                    <svg class="w-3 h-3 text-slate-900 opacity-0 peer-checked:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <p class="text-xs font-bold text-slate-700 peer-checked:text-slate-900">{{ $plan->name }}</p>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <!-- Other: doctor can type an insurance not in the list above.
                 It appears immediately as its own card (pre-selected) and
                 is saved as a new "Other" insurance the next time the form
                 is submitted. -->
            <div class="space-y-5">
                <h2 class="text-xl font-black tracking-tighter text-slate-900">Other</h2>

                <div id="other-cards" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5"></div>

                <div class="flex items-center gap-3 max-w-md">
                    <input
                        type="text"
                        id="other-insurance-input"
                        placeholder="Insurance name not listed above"
                        class="flex-1 px-5 py-3 bg-slate-50 border border-slate-100 rounded-2xl text-xs font-bold text-slate-700 focus:outline-none focus:ring-2 focus:ring-primary"
                    >
                    <button
                        type="button"
                        id="add-other-insurance"
                        class="px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white rounded-2xl font-black text-xs uppercase tracking-widest transition-all shrink-0"
                    >
                        Add
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        (function () {
            const input = document.getElementById('other-insurance-input');
            const addBtn = document.getElementById('add-other-insurance');
            const container = document.getElementById('other-cards');
            const countEl = document.getElementById('accepted-count');

            function updateCount() {
                countEl.textContent = document.querySelectorAll('.insurance-checkbox:checked, .custom-checkbox:checked').length;
            }

            document.querySelectorAll('.insurance-checkbox').forEach(cb => cb.addEventListener('change', updateCount));

            function addCard() {
                const name = input.value.trim();
                if (!name) return;

                const label = document.createElement('label');
                label.className = 'flex items-center gap-3 p-5 bg-white border border-primary rounded-2xl cursor-pointer shadow-sm';
                label.innerHTML = `
                    <input type="checkbox" name="custom_plans[]" value="${name.replace(/"/g, '&quot;')}" checked class="sr-only peer custom-checkbox">
                    <div class="w-5 h-5 rounded-md border-2 border-primary bg-primary flex items-center justify-center transition-all shrink-0">
                        <svg class="w-3 h-3 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <p class="text-xs font-bold text-slate-900">${name}</p>
                `;
                container.appendChild(label);
                input.value = '';
                updateCount();
            }

            addBtn.addEventListener('click', addCard);
            input.addEventListener('keydown', e => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addCard();
                }
            });
        })();
    </script>
</x-doctor-layout>
