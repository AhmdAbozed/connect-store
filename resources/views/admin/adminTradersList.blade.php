<x-layout>
    <x-adminHeader />
    @php

    @endphp
    <div class="flex">
        <div class="flex flex-col max-w-3xl w-11/12  mx-auto shadow-3xl">
            @foreach ($items as $item)
                <div class="flex border-y-2 p-2" id="{{ 'p' . $item->id }}">
                    <div class="flex flex-col mx-1">
                        <div>
                            Name: <span class="text-blue-500">
                            @if (config('app.demo_mode'))
                            {{ '[HIDDEN]' }}
                            @else
                            {{ $item->name }}    
                            @endif
                            </span>
                        </div>
                        <div>
                            Number: <span class="text-blue-500">
                            @if (config('app.demo_mode'))
                            {{ '[HIDDEN]' }}
                            @else
                            {{ $item->phone_number }}
                            
                            @endif
                        
                            </span>
                        </div>
                        <div>
                            email: <span class="text-blue-500">
                            @if (config('app.demo_mode'))
                            {{ '[HIDDEN]' }}
                            @else
                            {{ $item->email }}
                            
                            @endif
                                    
                        </span>
                        </div>
                    </div>
                    <div class="ml-auto my-auto" id="{{ $item->id }}">
                        @if ($item->type == 'pending')
                            <button class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 max-h-12   focus:ring-blue-400 approveBtn" >Approve</button>
                            <button class="bg-red-500 text-white py-2 removeBtn px-4 rounded-lg ml-1 hover:bg-red-600 focus:outline-none focus:ring-2 max-h-12   focus:ring-red-400 rejectBtn">Reject</button>
                        @elseif($item->type=='trader')
                            <button class="bg-red-500 text-white py-2 removeBtn px-4 rounded-lg ml-1 hover:bg-red-600 focus:outline-none focus:ring-2 max-h-12   focus:ring-red-400 revokeBtn">revoke</button>
                        
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @pushOnce('scripts')
        <script src="{{ Vite::asset('resources/ts/c_panel/cTradersList.ts') }}"></script>
    @endPushOnce
</x-layout>
