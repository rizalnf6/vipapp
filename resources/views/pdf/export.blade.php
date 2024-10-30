<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        body {
            color: rgb(58, 58, 58);
        }
    </style>
</head>

<body>
    <center>
        <h3 style="margin-bottom: 0px">{{ $record->name ?: '-' }}</h3>
        <small>{{ $record->category ?: '-' }}</small>
    </center>

    <h4 style="margin-bottom: 4px">Villa Detail</h4>
    <table style="width: 100%">
        <tr>
            <td style="width: 200px">Address</td>
            <td>:</td>
            <td align="right">{{ $record->address ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Villa Manager</td>
            <td>:</td>
            <td align="right">{{ $record->villa_manager_name ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Villa Manager Email</td>
            <td>:</td>
            <td align="right">{{ $record->villa_manager_email ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Villa Manager Contact</td>
            <td>:</td>
            <td align="right">{{ $record->villa_manager_contact ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Land Owner</td>
            <td>:</td>
            <td align="right">{{ $record->land_owner ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Land Owner Phone Number</td>
            <td>:</td>
            <td align="right">{{ $record->land_owner_phone_number ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Land Owner Email</td>
            <td>:</td>
            <td align="right">{{ $record->land_owner_email ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Land Owner Address</td>
            <td>:</td>
            <td align="right">{{ $record->land_owner_address ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Building Size</td>
            <td>:</td>
            <td align="right">{{ $record->building_size ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Land Size</td>
            <td>:</td>
            <td align="right">{{ $record->land_size ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Licenses</td>
            <td>:</td>
            <td align="right">{{ $record->licence ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Land Certification Number</td>
            <td>:</td>
            <td align="right">{{ $record->land_certification_number ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">IMB PBG</td>
            <td>:</td>
            <td align="right">{{ $record->imb_pbg_number ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">XTC Power</td>
            <td>:</td>
            <td align="right">{{ $record->xtc_power ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">PLN ID</td>
            <td>:</td>
            <td align="right">{{ $record->pln_id ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">For Sale</td>
            <td>:</td>
            <td align="right">{{ $record->for_sale ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">For Sale Link</td>
            <td>:</td>
            <td align="right">{{ $record->for_sale_link ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Lease Start Date</td>
            <td>:</td>
            <td align="right">{{ $record->rental_date?->format('d F Y') ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Lease End Date</td>
            <td>:</td>
            <td align="right">{{ $record->rental_date?->format('d F Y') ?: '-' }}</td>
        </tr>
    </table>

    <h4 style="margin-bottom: 4px">Owner</h4>
    <table style="width: 100%">
        <tr>
            <td style="width: 200px">Name</td>
            <td>:</td>
            <td align="right">{{ $record->owner->name ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Contact</td>
            <td>:</td>
            <td align="right">{{ $record->owner->contact ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Address</td>
            <td>:</td>
            <td align="right">{{ $record->owner->address ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Passport Detail</td>
            <td>:</td>
            <td align="right">{{ $record->owner->passport_detail ?: '-' }}</td>
        </tr>
    </table>

    <h4 style="margin-bottom: 4px">Tax</h4>
    <table style="width: 100%">
        <tr>
            <td style="width: 200px">PB Tax</td>
            <td>:</td>
            <td align="right">{{ $record->tax->pb_tax ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Land Build Status</td>
            <td>:</td>
            <td align="right">{{ $record->tax->land_build_status ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">OSS Status</td>
            <td>:</td>
            <td align="right">{{ $record->tax->oss_status ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Registered PE</td>
            <td>:</td>
            <td align="right">{{ $record->tax->registered_pe ? 'Yes' : 'No' }}</td>
        </tr>
    </table>

    <h4 style="margin-bottom: 4px">Management Agreement</h4>
    <table style="width: 100%">
        <tr>
            <td style="width: 200px">Signed copy</td>
            <td>:</td>
            <td align="right">{{ $record->agreement->signed_copy ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Marketing Agent Sites</td>
            <td>:</td>
            <td align="right">
                @php
                    // Sample array to map marketing agent sites to display names
                    $array = [
                        'BRHV' => 'BRHV Sites (BVE, AHR, BRHV)',
                        'BRHV_Global' => 'BRHV Global Network of Third Party Agents',
                        'VillaWebsite' => 'Villa Website',
                        'Airbnb' => 'Airbnb',
                        'Bookingcom' => 'Booking.com',
                        'Agoda' => 'Agoda',
                        'Flipkey' => 'Flipkey',
                        'Expedia' => 'Expedia'
                    ];

                    // Get the marketing agent sites from the record
                    $marketingAgentSites = $record->agreement->marketing_agent_sites;

                    // Check if marketingAgentSites is a JSON string and decode it if necessary
                    if (is_string($marketingAgentSites)) {
                        $marketingAgentSites = json_decode($marketingAgentSites, true);
                    }

                    // Normalize the keys in $array for case-insensitive matching
                    $normalizedArray = array_change_key_case($array, CASE_LOWER);
                @endphp

                <ul>
                    @foreach ($marketingAgentSites as $item)
                        @php
                            // Normalize the item by trimming spaces and converting to lowercase
                            $normalizedItem = trim(strtolower($item));
                        @endphp
                        <li>{{ $normalizedArray[$normalizedItem] ?? 'Not found :' }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
        <tr>
            <td style="width: 200px">Booking commision</td>
            <td>:</td>
            <td align="right">{{ $record->agreement->booking_commision ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Marketing commision</td>
            <td>:</td>
            <td align="right">{{ $record->agreement->marketing_commision ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Fix monthly fee</td>
            <td>:</td>
            <td align="right">{{ $record->agreement->fix_monthly_fee ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Agent fee</td>
            <td>:</td>
            <td align="right">{{ $record->agreement->agent_fee ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Other commision</td>
            <td>:</td>
            <td align="right">{{ $record->agreement->other_commision ?: '-' }}</td>
        </tr>
    </table>

    <h4 style="margin-bottom: 4px">Insurance</h4>
    <table style="width: 100%">
        <tr>
            <td style="width: 200px">Company name</td>
            <td>:</td>
            <td align="right">{{ $record->insurance->company_name ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Policy number</td>
            <td>:</td>
            <td align="right">{{ $record->insurance->policy_number ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Insurance name</td>
            <td>:</td>
            <td align="right">{{ $record->insurance->insurance_name ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Insurance amount</td>
            <td>:</td>
            <td align="right">{{ $record->insurance->insurance_amount ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Insured Policy Cost</td>
            <td>:</td>
            <td align="right">{{ $record->insurance->insured_policy_cost ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Renewal date</td>
            <td>:</td>
            <td align="right">{{ $record->insurance->renewal_date?->format('d F Y') ?: '-' }}</td>
        </tr>
    </table>

    <h4 style="margin-bottom: 4px">Consultant</h4>
    <table style="width: 100%">
        <tr>
            <td style="width: 200px">Consultant used</td>
            <td>:</td>
            <td align="right">{{ $record->consultant->consultant_used ?: '-' }}</td>
        </tr>
    </table>

    <h4 style="margin-bottom: 4px">Notes and Outstanding</h4>
    <table style="width: 100%">
        <tr>
            <td style="width: 200px">Notes</td>
            <td>:</td>
            <td align="right">{{ $record->others?->notes ?: '-' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Outstanding</td>
            <td>:</td>
            <td align="right">{{ $record->others?->outstanding ?: '-' }}</td>
        </tr>
    </table>
</body>

</html>
