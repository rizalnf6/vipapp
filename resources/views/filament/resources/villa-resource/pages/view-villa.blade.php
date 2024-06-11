<x-filament-panels::page>
    
    <div x-data="view_villa ()" x-on:villas-load.window="villas= $event.detail.villas">
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
                        <p class="text-gray-500">Villa Manager Name</p>
                        <p class="font-medium">{{ $record->villa_manager_name ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Villa Manager Email</p>
                        <p class="font-medium">{{ $record->villa_manager_email ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Villa Manager Contact</p>
                        <p class="font-medium">{{ $record->villa_manager_contact ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Land Owner</p>
                        <p class="font-medium">{{ $record->land_owner ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Land Owner Phone Number</p>
                        <p class="font-medium">{{ $record->land_owner_phone_number ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Land Owner Email</p>
                        <p class="font-medium">{{ $record->land_owner_email ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Land Owner Address</p>
                        <p class="font-medium">{{ $record->land_owner_address ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                       
                    <p class="text-gray-500">Land Owner KTP</p>
                        <div class="flex flex-wrap items-center gap-3">
                        @forelse ($record->land_owner_ktp as $item)
                                <a class="bg-primary-50 border-primary-500 rounded-full border px-3 py-1 text-xs"
                                    href="{{ asset('storage/' . $item) }}" target="_blank" rel="noopener noreferrer">
                                    {{ str_replace('ktp-files/', '', $item) }}
                                </a>
                            @empty
                                <p class="font-medium">-</p>
                        @endforelse
                        </div>
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
                        <p class="text-gray-500">Licences</p>
                        <p class="font-medium">{{ $record->licence ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Land Certificate No.</p>
                        <p class="font-medium">
                            {{ $record->land_certification_number ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">IMB/PBG</p>
                        <p class="font-medium">{{ $record->imb_pbg_number ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">XTC Power</p>
                        <p class="font-medium">{{ $record->xtc_power ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">PLN ID</p>
                        <p class="font-medium">{{ $record->pln_id ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">For Sale</p>
                        <p class="font-medium">{{ $record->for_sale ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">For Sale Link</p>
                        <p class="font-medium">{{ $record->for_sale_link ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Consultants Used</p>
                        <p class="font-medium">{{ $record->consultant_villa ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500"></p>
                        <p class="font-medium"></p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Lease Start Date</p>
                        <p class="font-medium">
                            {{ $record->lease_date->format('d F Y') ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Lease End Date</p>
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
                        <p class="text-gray-500">Passport on File</p>
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
                        <p class="text-gray-500">PB1 Tax</p>
                        <p class="font-medium">{{ $record->tax->pb_tax ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Land and Building Tax</p>
                        <p class="font-medium">{{ $record->tax->land_build_status ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">OSS Registered</p>
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
                        <p class="text-gray-500">Signed Copy</p>
                        <p class="font-medium">{{ $record->agreement?->signed_copy ? 'Yes' : 'No' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Marketing Agent Sites</p>
                        <p class="font-medium">
                        @php
                        $array = ['BRHV' => 'BRHV Sites (BVE, AHR, BRHV) (16.5%)',
                                        'BRHV_Global' => 'BRHV Global Network of Third Party Agents (20%)',
                                        'VillaWebsite' => 'Villa Website (16.5%)',
                                        'Airbnb' => 'Airbnb (16.5%)',
                                        'Bookingcom' => 'Booking.com (18%)',
                                        'Agoda' => 'Agoda (18%)',
                                        'Flipkey' => 'Flipkey (To confirm %)',
                                        'Expedia' => 'Expedia (To confirm %)',59];
                        @endphp
                        <ul>
                                @foreach ($record->agreement->marketing_agent_sites as $item)
                                <li>{{ $array[$item] ?? 'Not found' }}</li>
                                @endforeach
                        </ul>
                        </p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Booking Commission</p>
                        <p class="font-medium">{{ $record->agreement?->booking_commision ?: '-' }}</p>
                    </div>
                    <!-- <div class="col-span-1 text-start">
                        <p class="text-gray-500">Marketing Commision</p>
                        <p class="font-medium">{{ $record->agreement?->marketing_commision ?: '-' }}</p>
                    </div> -->
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Fix monthly fee</p>
                        <p class="font-medium">{{ $record->agreement?->fix_monthly_fee ? 'Yes' : 'No' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Managing Agent Fee</p>
                        <p class="font-medium">{{ $record->agreement?->agent_fee ?: '-' }}</p>
                    </div>
                    <!-- <div class="col-span-1 text-start">
                        <p class="text-gray-500">Other commision</p>
                        <p class="font-medium">{{ $record->agreement?->other_commision ?: '-' }}</p>
                    </div> -->
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Document</p>
                        <div class="flex flex-wrap items-center gap-3">
                            
                        @if($record->agreements)
                        @forelse ($record->agreements->agreement_document as $item)
                            <a class="dark:bg-gray-800 bg-primary-50 border-primary-500 rounded-full border px-3 py-1 text-xs"
                            href="{{ asset('storage/' . $item) }}" target="_blank"
                            rel="noopener noreferrer">
                            {{ str_replace('agreement-documents/', '', $item) }}
                            </a>
                        @empty
                            <p class="font-medium">-</p>
                        @endforelse
                        @else
                        <p>No aggrement document assigned</p>
                        @endif

                        </div>
                    </div>
                </div>

                {{-- Insurance --}}
                <div class="grid w-full grid-cols-1 gap-3 md:grid-cols-2" x-show="current == 4">
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Company Name</p>
                        <p class="font-medium">{{ $record->insurance?->company_name ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Policy Number</p>
                        <p class="font-medium">{{ $record->insurance?->policy_number ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Name Insured</p>
                        <p class="font-medium">{{ $record->insurance?->insurance_name ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Sum Insured</p>
                        <p class="font-medium">{{ $record->insurance?->insurance_amount ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Policy Cost</p>
                        <p class="font-medium">{{ $record->insurance?->insured_policy_cost ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Renewal date</p>
                        <p class="font-medium">{{ $record->insurance?->renewal_date?->format('d F Y') ?: '-' }}</p>
                    </div>
                </div>
                
                {{-- Documents --}}
                <div class="grid w-full grid-cols-1 gap-3" x-show="current==5">
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Documents</p>
                        <div class="flex flex-wrap items-center gap-3">
                        @if($record->consultants)
                        @forelse ($record->consultants->documents as $item)
                            <a class="dark:bg-gray-800 bg-primary-50 border-primary-500 rounded-full border px-3 py-1 text-xs"
                            href="{{ asset('storage/' . $item) }}" target="_blank"
                            rel="noopener noreferrer">
                            {{ str_replace('consultant-documents/', '', $item) }}
                            </a>
                        @empty
                            <p class="font-medium">-</p>
                        @endforelse
                        @else
                        <p>No documents assigned</p>
                        @endif
                        </div>
                    </div>
                </div>
                {{-- Notes --}}
                <div class="grid w-full grid-cols-1 gap-3" x-show="current==6">
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Notes</p>
                        <p class="font-medium">{{ $record->others?->notes ?: '-' }}</p>
                    </div>
                    <div class="col-span-1 text-start">
                        <p class="text-gray-500">Outstanding</p>
                        <p class="font-medium">{{ $record->others?->outstanding ?: '-' }}</p>
                    </div>
                </div>
            </div>
        </center>
    </div>
</x-filament-panels::page>
<script>
    let event = new CustomEvent("items-load", {
    detail: {
        items: []
    }
    });
    window.dispatchEvent(event),
    document.addEventListener('alpine:init', () => {
        Alpine.data('view_villa', () => ( {
            current: 0,
            listItem: [
                "Villa Detail",
                "Owner",
                "Tax",
                "Management Agreement",
                "Insurance",
                "Documents",
                "Notes",
            ],
        }))
        
    })
    // location.reload()
</script>
