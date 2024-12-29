<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Clients / Tenants') }}
            <x-btn-link class="ml-4 float-right" href="{{ route('tenants.create') }}">Add New Client/Tenant</x-btn-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="relative over-flow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 dark:text-gray-400 uppercase bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3" > Tenant Name</th>
                                <th scope="col" class="px-6 py-3" > Email</th>
                                <th scope="col" class="px-6 py-3" > Domain</th>
                                <th scope="col" class="px-6 py-3" > Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tenants as $tenant)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"> {{$tenant->name}} </th>
                                <td class="px-6 py-4"> {{$tenant->email}} </td>
                                <td class="px-6 py-4"> 
                                    @foreach ($tenant->domains as $domain)
                                        {{$domain->domain}} {{ $loop->last ? '' : ','}}    
                                    @endforeach
                                </td>
                                <td class="px-6 py-4"> {{$tenant->email}} </td>
                            </tr>
                            @endforeach                            
                        </tbody>
                        </table>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
