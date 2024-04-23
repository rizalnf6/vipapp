<x-filament-panels::page>
    <div x-data="view_villa">
        <center class="space-y-6">
            <ul class="flex w-full items-center justify-center">
                <template x-for="(item, index)  in listItem">
                    <li>
                        <button class="cursor-pointer border-b-4 px-4 py-2 font-medium transition-all duration-200"
                            :class="current == index ? 'border-primary-500 text-primary-500' :
                                'border-gray-200 hover:border-primary-200'"
                            x-text="item" x-on:click="current = index">
                        </button>
                    </li>
                </template>
            </ul>

            <div class="w-full max-w-screen-lg rounded-xl border bg-white p-5 dark:bg-gray-800">
                {{-- Detail --}}
                <div class="grid w-full grid-cols-1 gap-3 md:grid-cols-2" x-show="current == 0">
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Category</p>
                        <p class="font-medium">{{ $record->category ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Villa Name</p>
                        <p class="font-medium">{{ $record->name ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Villa Address</p>
                        <p class="font-medium">{{ $record->address ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Building Size</p>
                        <p class="font-medium">{{ $record->building_size ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Land Size</p>
                        <p class="font-medium">{{ $record->land_size ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Land Owner</p>
                        <p class="font-medium">{{ $record->land_owner ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Land Certification Number</p>
                        <p class="font-medium">
                            {{ $record->land_certification_number ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">IMB PBG</p>
                        <p class="font-medium">{{ $record->imb_pbg_number ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Licence</p>
                        <p class="font-medium">{{ $record->licence ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Rental Date</p>
                        <p class="font-medium">
                            {{ $record->rental_date?->format('d F Y') ?: '-' }}</p>
                    </div>
                </div>

                {{-- Owner --}}
                <div class="grid w-full grid-cols-1 gap-3 md:grid-cols-2" x-show="current == 1">
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Name</p>
                        <p class="font-medium">{{ $record->owner->name ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Contact</p>
                        <p class="font-medium">{{ $record->owner->contact ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Address</p>
                        <p class="font-medium">{{ $record->owner->address ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Passport Detail</p>
                        <p class="font-medium">{{ $record->owner->passport_detail ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Passport File</p>
                        <div class="flex flex-wrap items-center gap-3">
                            @forelse ($record->owner->passport_file as $item)
                                <a class="bg-primary-50 border-primary-500 rounded-full border px-3 py-1 text-xs"
                                    href="{{ asset('storage/' . $item) }}" target="_blank" rel="noopener noreferrer">
                                    {{ str_replace('passport-files/', '', $item) }}
                                </a>
                            @empty
                                <p class="font-medium">-</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Tax --}}
                <div class="grid w-full grid-cols-1 gap-3 md:grid-cols-2" x-show="current == 2">
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">PB Tax</p>
                        <p class="font-medium">{{ $record->tax->pb_tax ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Land Build Status</p>
                        <p class="font-medium">{{ $record->tax->land_build_status ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">OSS Status</p>
                        <p class="font-medium">{{ $record->tax->oss_status ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Registered PE</p>
                        <p class="font-medium">{{ $record->tax->registered_pe ? 'Yes' : 'No' }}</p>
                    </div>
                </div>

                {{-- Agreement --}}
                <div class="grid w-full grid-cols-1 gap-3 md:grid-cols-2" x-show="current == 3">
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Signed copy</p>
                        <p class="font-medium">{{ $record->agreement->signed_copy ? 'Yes' : 'No' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Booking commision</p>
                        <p class="font-medium">{{ $record->agreement->booking_commision ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Fix monthly fee</p>
                        <p class="font-medium">{{ $record->agreement->fix_monthly_fee ? 'Yes' : 'No' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Agent fee</p>
                        <p class="font-medium">{{ $record->agreement->agent_fee ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Other commision</p>
                        <p class="font-medium">{{ $record->agreement->other_commision ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Document</p>
                        <div class="flex flex-wrap items-center gap-3">
                            @forelse ($record->agreement->agreement_document as $item)
                                <a class="bg-primary-50 border-primary-500 rounded-full border px-3 py-1 text-xs"
                                    href="{{ asset('storage/' . $item) }}" target="_blank" rel="noopener noreferrer">
                                    {{ str_replace('agreement_document/', '', $item) }}
                                </a>
                            @empty
                                <p class="font-medium">-</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Insurance --}}
                <div class="grid w-full grid-cols-1 gap-3 md:grid-cols-2" x-show="current == 4">
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Company name</p>
                        <p class="font-medium">{{ $record->insurance->company_name ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Policy number</p>
                        <p class="font-medium">{{ $record->insurance->policy_number ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Insurance name</p>
                        <p class="font-medium">{{ $record->insurance->insurance_name ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Insurance amount</p>
                        <p class="font-medium">{{ $record->insurance->insurance_amount ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Renewal date</p>
                        <p class="font-medium">{{ $record->insurance->renewal_date?->format('d F Y') ?: '-' }}</p>
                    </div>
                </div>

                {{-- Consultant --}}
                <div class="grid w-full grid-cols-1 gap-3" x-show="current==5">
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Consultant used</p>
                        <p class="font-medium">{{ $record->consultant->consultant_used ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Documents</p>
                        <div class="flex flex-wrap items-center gap-3">
                            @forelse ($record->consultant->documents as $item)
                                <a class="bg-primary-50 border-primary-500 rounded-full border px-3 py-1 text-xs"
                                    href="{{ asset('storage/' . $item) }}" target="_blank"
                                    rel="noopener noreferrer">
                                    {{ str_replace('consultant-documents/', '', $item) }}
                                </a>
                            @empty
                                <p class="font-medium">-</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </center>
    </div>
</x-filament-panels::page>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('view_villa', () => ({
            current: 0,
            listItem: [
                "Villa Detail",
                "Owner",
                "Tax",
                "Management Agreement",
                "Insurance",
                "Consultant",
            ],
        }))
    })
</script>
