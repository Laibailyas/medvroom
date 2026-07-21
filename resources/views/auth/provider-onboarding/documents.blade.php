<x-provider-onboarding-layout title="Upload required documents" description="Step 7 of 10 • Verification Assets" currentStep="7">
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 overflow-hidden">
        <form method="POST" action="{{ route('provider.register.documents.store') }}" enctype="multipart/form-data" class="p-8 lg:p-12 space-y-10">
            @csrf

            <div class="space-y-8">
                <div class="p-6 bg-slate-50 border border-slate-100 rounded-3xl">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </div>
                        <div>
                            <h4 class="text-lg font-black text-slate-900 leading-none">Upload Documents</h4>
                            <p class="text-xs font-bold text-slate-500 mt-1 uppercase tracking-widest">🔒 Securely Encrypted — your documents are protected</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Medical License -->
                        <div x-data="{ fileName: '' }">
                            <label class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-3">Medical License (PDF or Image)</label>
                            <label class="relative flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-white hover:border-indigo-600 transition-all group">
                                <input type="file" name="document_license" required class="sr-only" @change="fileName = $event.target.files[0].name">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="mb-2 text-sm text-slate-500 font-bold group-hover:text-indigo-600" x-text="fileName || 'Click to upload or drag and drop'"></p>
                                    <p class="text-xs text-slate-400 font-medium uppercase tracking-widest">PDF, PNG, JPG (MAX. 10MB)</p>
                                </div>
                            </label>
                            <x-input-error :messages="$errors->get('document_license')" class="mt-2" />
                        </div>

                        <!-- Government ID -->
                        <div x-data="{ fileName: '' }">
                            <label class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-3">Government ID <span class="text-rose-600">*</span> <span class="font-medium text-slate-400 lowercase tracking-normal">(upload required)</span></label>
                            <label class="relative flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-white hover:border-indigo-600 transition-all group">
                                <input type="file" name="document_id" required class="sr-only" @change="fileName = $event.target.files[0].name">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="mb-2 text-sm text-slate-500 font-bold group-hover:text-indigo-600" x-text="fileName || 'Click to upload or drag and drop'"></p>
                                    <p class="text-xs text-slate-400 font-medium uppercase tracking-widest">PDF, PNG, JPG (MAX. 10MB)</p>
                                </div>
                            </label>
                            <x-input-error :messages="$errors->get('document_id')" class="mt-2" />
                        </div>

                        <!-- Malpractice Insurance -->
                        <div x-data="{ fileName: '' }">
                            <label class="block text-sm font-black uppercase tracking-widest text-slate-500 mb-3">Malpractice Insurance <span class="text-rose-600">*</span> <span class="font-medium text-slate-400 lowercase tracking-normal">(upload required)</span></label>
                            <label class="relative flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-200 rounded-2xl cursor-pointer hover:bg-white hover:border-indigo-600 transition-all group">
                                <input type="file" name="document_malpractice" required class="sr-only" @change="fileName = $event.target.files[0].name">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-slate-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                    <p class="mb-2 text-sm text-slate-500 font-bold group-hover:text-indigo-600" x-text="fileName || 'Click to upload or drag and drop'"></p>
                                    <p class="text-xs text-slate-400 font-medium uppercase tracking-widest">PDF, PNG, JPG (MAX. 10MB)</p>
                                </div>
                            </label>
                            <x-input-error :messages="$errors->get('document_malpractice')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            <x-button type="submit" size="full" class="py-5 text-lg font-black uppercase tracking-widest group rounded-2xl shadow-xl shadow-primary/30">
                Continue to Agreements
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </x-button>
        </form>
    </div>
</x-provider-onboarding-layout>