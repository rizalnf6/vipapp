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
        <h3 style="margin-bottom: 0px">{{ $record->name }}</h3>
        <small>{{ $record->category }}</small>
    </center>

    <h4 style="margin-bottom: 4px">Villa Detail</h4>
    <table style="width: 100%">
        <tr>
            <td style="width: 200px">Address</td>
            <td>:</td>
            <td align="right">{{ $record->address }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Building Size</td>
            <td>:</td>
            <td align="right">{{ $record->building_size }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Land Size</td>
            <td>:</td>
            <td align="right">{{ $record->land_size }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Land Owner</td>
            <td>:</td>
            <td align="right">{{ $record->land_owner }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Land Certification Number</td>
            <td>:</td>
            <td align="right">{{ $record->land_certification_number }}</td>
        </tr>
        <tr>
            <td style="width: 200px">IMB PBG</td>
            <td>:</td>
            <td align="right">{{ $record->imb_pbg_number }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Licence</td>
            <td>:</td>
            <td align="right">{{ $record->licence }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Rental Date</td>
            <td>:</td>
            <td align="right">{{ $record->rental_date->format('d F Y') }}</td>
        </tr>
    </table>

    <h4 style="margin-bottom: 4px">Owner</h4>
    <table style="width: 100%">
        <tr>
            <td style="width: 200px">Name</td>
            <td>:</td>
            <td align="right">{{ $record->owner->name }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Contact</td>
            <td>:</td>
            <td align="right">{{ $record->owner->contact }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Address</td>
            <td>:</td>
            <td align="right">{{ $record->owner->address }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Passport Detail</td>
            <td>:</td>
            <td align="right">{{ $record->owner->passport_detail }}</td>
        </tr>
    </table>

    <h4 style="margin-bottom: 4px">Tax</h4>
    <table style="width: 100%">
        <tr>
            <td style="width: 200px">PB Tax</td>
            <td>:</td>
            <td align="right">{{ $record->tax->pb_tax }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Land Build Status</td>
            <td>:</td>
            <td align="right">{{ $record->tax->land_build_status }}</td>
        </tr>
        <tr>
            <td style="width: 200px">OSS Status</td>
            <td>:</td>
            <td align="right">{{ $record->tax->oss_status }}</td>
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
            <td style="width: 200px">Booking commision</td>
            <td>:</td>
            <td align="right">@rupiah($record->agreement->booking_commision)</td>
        </tr>
        <tr>
            <td style="width: 200px">Fix monthly fee</td>
            <td>:</td>
            <td align="right">{{ $record->agreement->fix_monthly_fee ? 'Yes' : 'No' }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Agent fee</td>
            <td>:</td>
            <td align="right">@rupiah($record->agreement->agent_fee)</td>
        </tr>
        <tr>
            <td style="width: 200px">Other commision</td>
            <td>:</td>
            <td align="right">@rupiah($record->agreement->other_commision)</td>
        </tr>
    </table>

    <h4 style="margin-bottom: 4px">Insurance</h4>
    <table style="width: 100%">
        <tr>
            <td style="width: 200px">Company name</td>
            <td>:</td>
            <td align="right">{{ $record->insurance->company_name }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Policy number</td>
            <td>:</td>
            <td align="right">{{ $record->insurance->policy_number }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Insurance name</td>
            <td>:</td>
            <td align="right">{{ $record->insurance->insurance_name }}</td>
        </tr>
        <tr>
            <td style="width: 200px">Insurance amount</td>
            <td>:</td>
            <td align="right">@rupiah($record->insurance->insurance_amount)</td>
        </tr>
        <tr>
            <td style="width: 200px">Renewal date</td>
            <td>:</td>
            <td align="right">{{ $record->insurance->renewal_date->format('d F Y') }}</td>
        </tr>
    </table>

    <h4 style="margin-bottom: 4px">Consultant</h4>
    <table style="width: 100%">
        <tr>
            <td style="width: 200px">Consultant used</td>
            <td>:</td>
            <td align="right">{{ $record->consultant->consultant_used }}</td>
        </tr>
        <tr>
            <td style="width: 200px" valign="top">
                Documents
            </td>
            <td valign="top">:</td>
            <td align="right" valign="top">
                <div>
                    <ul style="margin: 0px; direction: rtl;">
                        @foreach ($record->consultant->documents as $item)
                            <li>{{ $item->licence_name }}</li>
                        @endforeach
                    </ul>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>