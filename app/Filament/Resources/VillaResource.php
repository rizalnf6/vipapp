<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Villa;
use App\Enums\Category;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Tables\Grouping\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Support\Enums\Alignment;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use App\Filament\Resources\VillaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VillaResource extends Resource
{
    protected static ?string $model = Villa::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Villa Name')
                    ->required()
                    ->maxLength(255),
                Select::make('category')
                    ->options(Category::asSelectArray())
                    ->required(),
                Section::make('Villa Detail')
                    ->columns(2)
                    ->schema([
                        Textarea::make('address')
                            ->default('-')
                            ->columnSpan(4),
                        Textinput::make('villa_manager_name')
                            ->default('-')
                            ->columnSpan(4),
                        Textinput::make('villa_manager_email')
                            ->default('-')
                            ->columnSpan(2),
                        Textinput::make('villa_manager_contact')
                            ->default('-')
                            ->columnSpan(2),
                        Textinput::make('land_owner')
                            ->default('-')
                            ->columnSpanFull(),
                        TextInput::make('land_owner_phone_number')
                            ->label('Land Owner Phone Number')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('land_owner_email')
                            ->label('Land Owner Email')
                            ->default('-')
                            ->maxLength(255),
                        FileUpload::make('land_owner_ktp')
                            ->label('Land Owner KTP')
                            ->disk('public')
                            ->multiple()
                            ->downloadable()
                            ->preserveFilenames()
                            ->directory('ktp-files'),
                        TextInput::make('land_owner_address')
                            ->label('Land Owner Address')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('building_size')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('land_size')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('licence')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('land_certification_number')
                            ->label('Land Certificate Number')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('imb_pbg_number')
                            ->label('IMB PBG')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('xtc_power')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('pln_id')
                            ->default('-')
                            ->maxLength(255),
                        Select::make('for_sale')
                            ->label('For Sale')
                            ->default(false)
                            ->options([
                                true => 'Yes',
                                false => 'No'
                            ]),
                        TextInput::make('for_sale_link')
                            ->default('-')
                            ->maxLength(255)
                            ->columnSpan(2),
                        DatePicker::make('lease_date')
                            ->label('Lease Start Date')
                            ->default(now())
                            ->required(),
                        DatePicker::make('rental_date')
                            ->label('Lease End Date')
                            ->default(now())
                            ->required(),
                        TextInput::make('consultant_villa')
                            ->default('-')
                            ->columnSpan(2)
                            ->maxLength(255),
                    ]),
                Section::make('Owner')
                    ->columns(2)
                    ->relationship('owner')
                    ->schema([
                        TextInput::make('name')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('contact')
                            ->default('-')
                            ->maxLength(255),
                        Textarea::make('address')
                            ->default('-')
                            ->columnSpanFull(),
                        Textarea::make('passport_detail')
                            ->default('-'),
                        FileUpload::make('passport_file')
                            ->label('Passport on File')
                            ->disk('public')
                            ->multiple()
                            ->downloadable()
                            ->preserveFilenames()
                            ->directory('passport-files'),
                    ]),
                Section::make('Tax')
                    ->relationship('tax')
                    ->schema([
                        TextInput::make('pb_tax')
                            ->label('PB1 Tax')
                            ->default('-')
                            ->columnSpan(12)
                            ->maxLength(255),
                        TextArea::make('land_build_status')
                            ->label('Land and Building Tax')
                            ->default('-')
                            ->columnSpan(12)
                            ->maxLength(255),
                        TextInput::make('oss_status')
                            ->default('-')
                            ->columnSpan(8)
                            ->maxLength(255),
                        Select::make('registered_pe')
                            ->default(false)
                            ->columnSpan(4)
                            ->label('Registered as PE')
                            ->options([
                                true => 'Yes',
                                false => 'No'
                            ]),
                    ]),

                // Management Agreements
                Section::make('Management Agreement')
                    ->relationship('agreement')
                    ->columnSpanFull()
                    ->schema([
                        Select::make('signed_copy')
                        ->columnSpan(2)
                            ->default(false)
                            ->label('Signed Copy')
                            ->options([
                                true => 'Yes',
                                false => 'No'
                            ]),
                        Select::make('fix_monthly_fee')
                        ->columnSpan(2)
                            ->default(false)
                            ->label('Fix Monthly Fee')
                            ->options([
                                true => 'Yes',
                                false => 'No'
                            ]),                      
                        // TextInput::make('marketing_commision')
                        //     ->maxLength(255)
                        //     ->columnSpan(4)
                        //     ->default('-'),
                        TextInput::make('booking_commision')
                            ->label('Booking Commision')
                            ->maxLength(255)
                            ->columnSpan(2)
                            ->default('-'),
                            //->mask(RawJs::make('$money($input, `,`)'))
                            //->stripCharacters('.')
                            //->numeric(),
                        TextInput::make('agent_fee')
                            ->label('Managing Agent Fee')
                            ->default('-')
                            ->columnSpan(2)
                            ->mask(RawJs::make('$money($input, `,`)'))
                            ->stripCharacters('.'),
                        // TextInput::make('other_commision')
                        //     ->maxLength(255)
                        //     ->columnSpan(6)
                        //     ->default('-'),
                            //->mask(RawJs::make('$money($input, `,`)'))
                            //->stripCharacters('.'),
                        CheckboxList::make('marketing_agent_sites')
                        ->required()
                        ->columnSpan(8)
                        ->options([
                            'BRHV' => 'BRHV Sites (BVE, AHR, BRHV) (16.5%)',
                            'BRHV_Global' => 'BRHV Global Network of Third Party Agents (20%)',
                            'VillaWebsite' => 'Villa Website (16.5%)',
                            'Airbnb' => 'Airbnb (16.5%)',
                            'Bookingcom' => 'Booking.com (18%)',
                            'Agoda' => 'Agoda (18%)',
                            'Flipkey' => 'Flipkey (To confirm %)',
                            'Expedia' => 'Expedia (To confirm %)',
                        ])
                        ->gridDirection('row')
                        ->columns(4),  
                        FileUpload::make('agreement_document')
                            ->maxSize(200 * 1024)
                            ->label('Agreement Document')
                            ->multiple()
                            ->moveFiles()
                            ->columnSpan(8)
                            ->disk('public')
                            ->directory('agreement-documents')
                            ->downloadable()
                            ->preserveFilenames(),

                    ]),
                Section::make('Insurance')
                    ->relationship('insurance')
                    ->columns(4)
                    ->schema([
                        TextInput::make('company_name')
                            ->default('-')
                            ->columnSpan(5)
                            ->maxLength(255),
                        TextInput::make('policy_number')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('insurance_name')
                            ->label('Named Insurance')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('insurance_amount')
                            ->default('-')
                            ->label('Insured Ammount'),
                        TextInput::make('insured_policy_cost')
                            ->default('-')
                            ->label('Insured Policy Cost'),
                            //->mask(RawJs::make('$money($input, `,`)'))
                            //->stripCharacters('.')
                            //->numeric(),
                        DatePicker::make('renewal_date')
                            ->default(now())
                            ->label('Renewal Date'),
                    ]),
                Section::make('Documents')
                    ->relationship('consultant')
                    ->columns(2)
                    ->schema([
                        // TextInput::make('consultant_used')
                        //     ->default('-')
                        //     ->columnSpan(8)
                        //     ->maxLength(255),
                        FileUpload::make('documents')
                            ->maxSize(200 * 1024)
                            ->label('List of Document on File')
                            ->multiple()
                            ->moveFiles()
                            ->columnSpan(8)
                            ->disk('public')
                            ->directory('consultant-documents')
                            ->downloadable()
                            ->preserveFilenames(),
                    ]),
                Section::make('Other')
                    ->relationship('others')
                    ->columns(4)
                    ->schema([
                        TextArea::make('notes')
                            ->default('-')
                            ->columnSpan(2)
                            ->maxLength(255),
                        TextArea::make('outstanding')
                            ->default('-')
                            ->columnSpan(2)
                            ->maxLength(255),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('No. ')
                    ->alignment(Alignment::Center)
                    ->toggleable(true),
                TextColumn::make('name')
                ->alignment(Alignment::Center)
                    ->label('Villa Name')
                    ->sortable()
                    ->searchable(),
                // TextColumn::make('address')
                // ->alignment(Alignment::Center)
                //     ->label('Villa Address')
                //     ->searchable(),
                TextColumn::make('address')
                    ->label('Villa Address')
                    ->searchable(),
                TextColumn::make('owner.name')
                    ->alignment(Alignment::Center)
                    ->toggleable(true),
            ])
            ->filters([
                // Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->color('info')
                        ->modalHeading('Archive data')
                        ->successNotification(fn () => Notification::make()
                            ->title('Data Archived')
                            ->send())
                        ->icon('heroicon-o-archive-box')
                        ->modalIcon('heroicon-o-archive-box')
                        ->label('Archive'),
                    Tables\Actions\ForceDeleteAction::make()
                        ->modalHeading('Delete data')
                        ->label('Delete'),
                    Tables\Actions\RestoreAction::make()
                        ->modalHeading('Return the data villa'),
                ])
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVillas::route('/'),
            'create' => Pages\CreateVilla::route('/create'),
            'view' => Pages\ViewVilla::route('/{record}'),
            'edit' => Pages\EditVilla::route('/{record}/edit'),
        ];
    }
}
