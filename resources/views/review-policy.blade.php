<x-app-layout :title="$setting['title']" :description="$setting['title']">
    <div class="bg-slate-50 py-16 sm:py-24 font-sans">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 bg-white p-8 sm:p-12 rounded-2xl shadow-sm border border-slate-100">

            <!-- Header -->
            <div class="text-center mb-12 border-b border-slate-100 pb-8">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight sm:text-4xl uppercase">
                    USER REVIEWS AND CONTENT
                </h1>
                <p class="mt-2 text-sm text-slate-500">
                    Effective Date: {{ now()->format('F d, Y') }}
                </p>
            </div>

            <!-- Content -->
            <div class="space-y-8 text-slate-600 leading-relaxed text-base">

                <section>
                    <p class="mb-4">
                        You may submit reviews, comments, ratings, and other content on the Platform ("User Content"), subject to these Terms and our Acceptable Use Policy (incorporated herein by reference).
                    </p>

                    <p class="mb-4">
                        By submitting User Content, you represent and warrant that:
                    </p>

                    <ul class="list-disc pl-6 space-y-3 marker:text-indigo-600">
                        <li>
                            Your content is truthful, accurate, based on your own real and personal experiences, and does not contain false, misleading, or deceptive statements.
                        </li>

                        <li>
                            You have the necessary rights to submit the content and grant the licenses described below.
                        </li>

                        <li>
                            Your content does not violate any applicable law, regulation, or third-party rights (including intellectual property, privacy, or publicity rights).
                        </li>

                        <li>
                            It complies with our Acceptable Use Policy, including but not limited to: no false or misleading reviews, no spam or promotional content, no harassment, abusive or discriminatory content, and no disclosure of personal health information (PHI) of others.
                        </li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">
                        Prohibited Activities (Reviews & Providers)
                    </h2>

                    <ul class="list-disc pl-6 space-y-3">
                        <li>Submitting, soliciting, or posting fake, fraudulent, or inauthentic reviews.</li>
                        <li>Offering or accepting incentives (monetary or otherwise) for reviews or engaging in review manipulation.</li>
                        <li>Pressuring, coercing, or retaliating against users for their reviews.</li>
                        <li>Posting or sharing protected health information (PHI) without proper authorization.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">
                        Moderation & Removal
                    </h2>

                    <p>
                        MedVroom reserves the right (but has no obligation) to review, moderate, edit for clarity, flag, or remove any User Content that violates these Terms, the Acceptable Use Policy, or applicable law, at our sole discretion and without notice. We may also suspend or terminate accounts for repeated violations or suspicious activity. Moderation does not imply endorsement or verification of content accuracy.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">
                        Content License
                    </h2>

                    <p>
                        You grant MedVroom a worldwide, non-exclusive, royalty-free, sublicensable, transferable, and perpetual license to use, host, reproduce, display, distribute, modify (for clarity or formatting), and promote your User Content in connection with operating, improving, marketing, and promoting the Platform and our services.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 mb-3">
                        Disclaimer
                    </h2>

                    <p>
                        User reviews and ratings reflect the individual opinions and experiences of users and do not represent the views of MedVroom. They are not medical advice, endorsements, or guarantees of outcomes, quality of care, or results. We do not verify the accuracy or completeness of reviews. Always consult qualified healthcare professionals for medical decisions. Your reliance on any User Content is at your own risk.
                    </p>
                </section>

            </div>
        </div>
    </div>
</x-app-layout>