<section>
    <header>
        <h2>{{ __('Código de Consultor') }}</h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ingrese el código de 7 dígitos que le enviamos por correo electrónico.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.consultant.request') }}" class="mt-6 space-y-6 max-w-sm mx-auto">
        @csrf

        <div class="flex mb-2 space-x-2 rtl:space-x-reverse">
            <div>
                <label for="code-1" class="sr-only">Primer dígito</label>
                <input type="text" maxlength="1" data-focus-input-init data-focus-input-next="code-2" id="code-1"
                    class="block w-9 h-9 py-3 text-sm font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required />
            </div>
            <div>
                <label for="code-2" class="sr-only">Segundo dígito</label>
                <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-1"
                    data-focus-input-next="code-3" id="code-2"
                    class="block w-9 h-9 py-3 text-sm font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required />
            </div>
            <div>
                <label for="code-3" class="sr-only">Tercer dígito</label>
                <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-2"
                    data-focus-input-next="code-4" id="code-3"
                    class="block w-9 h-9 py-3 text-sm font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required />
            </div>
            <div>
                <label for="code-4" class="sr-only">Cuarto dígito</label>
                <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-3"
                    data-focus-input-next="code-5" id="code-4"
                    class="block w-9 h-9 py-3 text-sm font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required />
            </div>
            <div>
                <label for="code-5" class="sr-only">Quinto dígito</label>
                <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-4"
                    data-focus-input-next="code-6" id="code-5"
                    class="block w-9 h-9 py-3 text-sm font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required />
            </div>
            <div>
                <label for="code-6" class="sr-only">Sexto dígito</label>
                <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-5"
                    data-focus-input-next="code-7" id="code-6"
                    class="block w-9 h-9 py-3 text-sm font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required />
            </div>
            <div>
                <label for="code-7" class="sr-only">Séptimo dígito</label>
                <input type="text" maxlength="1" data-focus-input-init data-focus-input-prev="code-6" id="code-7"
                    class="block w-9 h-9 py-3 text-sm font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required />
            </div>
        </div>

        <input type="hidden" name="mk_code" id="mk_code" value="">

        <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">Ingrese el código de 7
            dígitos que le enviamos por correo electrónico.</p>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Verificar Código') }}</x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const codeInputs = document.querySelectorAll('input[id^="code-"]');
            const mkCodeInput = document.getElementById('mk_code');

            codeInputs.forEach(input => {
                input.addEventListener('input', function() {
                    let fullCode = '';
                    codeInputs.forEach(codeInput => {
                        fullCode += codeInput.value;
                    });
                    mkCodeInput.value = fullCode;
                });
            });
        });
    </script>
</section>