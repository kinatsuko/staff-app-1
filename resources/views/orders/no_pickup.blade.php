<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Senarai Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="py-1">
                        <div class="grid md:grid-cols-2 my-2">
                            <div class="mt-3">
                                <a href="/orders/create"
                                    class='items-center mx-5 bg-green-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                                    {{ __('Tambah Pesanan') }}
                                </a>
                            </div>

                            <div class="text-right">
                                <form action="/orders">
                                    <input type="text" name="search" placeholder="Carian..."
                                        class="items-center mx-5 rounded-lg shadow-xl font-medium px-4 py-2"
                                        value="{{ request('search') }}">
                                </form>
                            </div>
                        </div>
                        <div class="w-full xl:w-full mb-12 xl:mb-0 px-4 mx-auto">
                            <div
                                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                                <div class="block w-full overflow-x-auto">
                                    <table class="items-center bg-transparent w-full border-collapse ">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-6 bg-blueGray-50 text-blueGray-500 align-middle text-center border border-solid border-blueGray-100 py-3 text-base uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold">
                                                    {{ __('No') }}
                                                </th>
                                                <th
                                                    class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-base uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-center">
                                                    {{ __('Order No') }}
                                                </th>
                                                <th
                                                    class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-base uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                    {{ __('Pelanggan') }}
                                                </th>
                                                <th
                                                    class="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-base uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                    {{ __('No Phone') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                //forgive me a bit sketchy
                                                $location['guar'] = $location['gurun'] = 0;
                                            @endphp
                                            @foreach ($orders as $order)
                                                @php
                                                    //again, apologize
                                                    switch ($order->location) {
                                                        case 'gurun':
                                                            $location['gurun']++;
                                                            break;
                                                        case 'guar':
                                                            $location['guar']++;
                                                            break;
                                                    }
                                                @endphp
                                                <tr onclick="window.location='/orders/view/{{ $order->id }}'"
                                                    class="hover:bg-gray-100 cursor-pointer">
                                                    <td class="text-center">
                                                        {{ ($orders->currentpage() - 1) * $orders->perpage() + $loop->index + 1 }}
                                                    </td>
                                                    <th
                                                        class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                                                        {{ \App\Http\Controllers\Controller::order_num($order->id) }}
                                                    </th>
                                                    <td
                                                        class="flex border-t-0 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap p-4">
                                                        @if ($order->location == 'gurun')
                                                            <div class="w-5 h-5 bg-purple-600 mr-2 rounded-full"></div>
                                                        @elseif ($order->location == 'guar')
                                                            <div class="w-5 h-5 bg-pink-600 mr-2 rounded-full"></div>
                                                        @endif
                                                        {{ $order->customer->name }}
                                                    </td>
                                                    <td>
                                                        {{ $order->customer->phone }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{ $orders->withQueryString()->links() }}
                        </div>
                    </section>
                    <div class="m-5 grid md:grid-cols-2">
                        <div>
                            <div onclick="window.location='/orders/no-pickup?location=gurun'"
                                class="inline-flex items-center bg-white leading-none text-purple-600 rounded-full p-2 shadow text-sm cursor-pointer">
                                <span
                                    class="inline-flex bg-purple-600 text-white rounded-full h-6 px-3 justify-center items-center text-">{{ $location['gurun'] }}</span>
                                <span class="inline-flex px-2">Gurun</span>
                            </div>
                            <div onclick="window.location='/orders/no-pickup?location=guar'"
                                class="inline-flex items-center bg-white leading-none text-pink-600 rounded-full p-2 shadow text-sm cursor-pointer">
                                <span
                                    class="inline-flex bg-pink-600 text-white rounded-full h-6 px-3 justify-center items-center text-">{{ $location['guar'] }}</span>
                                <span class="inline-flex px-2">Guar</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <a href="/orders"
                            class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>
                            {{ __('Kembali ke senarai pesanan') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
