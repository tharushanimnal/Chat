<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 text-gray-900">
                    <div id="notification-area" class="mb-3"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function pollNotifications() {
            fetch("{{ url('/notifications/poll') }}")
                .then(res => res.text())
                .then(html => {
                    document.getElementById("notification-area").innerHTML = html;
                });
        }

        setInterval(pollNotifications, 5000);

        document.addEventListener('DOMContentLoaded', function () {
            pollNotifications();
        });
    </script>
</x-app-layout>
