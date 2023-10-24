@section('dropdowns')
    <div id="cookies-corner-modal" aria-hidden="false" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="p-5 text-sm font-light text-gray-500 dark:text-gray-400">
                    <p class="mb-2">
                        {{ __('We use cookies, including third party cookies, for operational purposes,statistical analyses, to personalize your experience, provide you with targeted content tailored to your interests and to analyze the performance of our advertising campaigns') }}.
                    </p>
                    <p>
                        {{ __('To find out more about the types of cookies, as well as who sends them on our website, please visit our dedicated guide to') }} <a href="#"
                            class="font-normal text-gray-900 hover:underline dark:text-white">{{ __('managing cookies') }}</a>.
                    </p>
                </div>
                <div class="justify-between items-center p-6 pt-0 space-y-4 sm:flex sm:space-y-0">
                    <button id="close-modal" type="button"
                        class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-auto hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{{ __('Personalize') }}
                        my choices</button>
                    <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0">
                        <button id="block-cookies" type="button"
                            class="py-2 px-4 w-full text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 sm:w-auto hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{ __('Reject') }}
                            all</button>
                        <button id="accept-cookies" type="button"
                            class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-auto hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">{{ __('Accept') }}
                            all</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modalEl = document.getElementById('cookies-corner-modal');
            const cookiesModal = new Modal(modalEl, {
                placement: 'bottom-right'
            });

            cookiesModal.show();

            const closeModalEl = document.getElementById('close-modal');
            closeModalEl.addEventListener('click', function() {
                cookiesModal.hide();
            });

            const acceptCookiesEl = document.getElementById('accept-cookies');
            acceptCookiesEl.addEventListener('click', function() {
                // handle cookie accept
                alert('cookies accepted');
                cookiesModal.hide();
            });

            const blockCookiesEl = document.getElementById('block-cookies');
            blockCookiesEl.addEventListener('click', function() {
                // handle cookie block
                alert('cookies block');
                cookiesModal.hide();
            });
        });
    </script>
@endsection
