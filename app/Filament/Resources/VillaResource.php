<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Villa;
use App\Enums\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Support\Enums\Alignment;
use Filament\Forms\Components\Section;
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
                Select::make('category')
                    ->options(Category::asSelectArray())
                    ->required(),
                TextInput::make('name')
                    ->label('Villa Name')
                    ->required()
                    ->maxLength(255),
                Section::make('Villa Detail')
                    ->columns(2)
                    ->schema([
                        Textarea::make('address')
                            ->default('-')
                            ->columnSpanFull(),
                        TextInput::make('building_size')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('land_size')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('land_owner')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('land_certification_number')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('imb_pbg_number')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('licence')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('rental_date')
                            ->required(),
                    ]),
                Section::make('Owner')
                    ->columns(2)
                    ->relationship('owner')
                    ->schema([
                        TextInput::make('name')
                            ->required()
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
                            ->disk('public')
                            ->default('-')
                            ->multiple()
                            ->downloadable()
                            ->preserveFilenames()
                            ->directory('passport-files'),
                    ]),
                Section::make('Tax')
                    ->relationship('tax')
                    ->schema([
                        TextInput::make('pb_tax')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('land_build_status')
                            ->default('-')
                            ->maxLength(255),
                        TextInput::make('oss_status')
                            ->default('-')
                            ->maxLength(255),
                        Select::make('registered_pe')
                        ->default('No')
                        ->label('Registered as PE')
                        ->options([
                            'Yes' => 'Yes',
                            'No' => 'No'
                        ]),
                    ]),
                Section::make('Management Agreement')
                    ->relationship('agreement')
                    ->schema([
                        Select::make('signed_copy')
                        ->default('No')
                        ->label('Signed Copy')
                        ->options([
                            'Yes' => 'Yes',
                            'No' => 'No'
                        ]),
                        TextInput::make('booking_commision')
                            ->default('-')
                            // ->mask(RawJs::make('$money($input, `,`)'))
                            ->stripCharacters('.'),
                            // ->numeric(),
                        Select::make('fix_monthly_fee')
                        ->default('No')
                        ->label('Fix Monthly Fee')
                        ->options([
                            'Yes' => 'Yes',
                            'No' => 'No'
                        ]),
                        TextInput::make('agent_fee')
                            ->default('-')
                            // ->mask(RawJs::make('$money($input, `,`)'))
                            ->stripCharacters('.'),
                        TextInput::make('other_commision')
                            ->default('-')
                            // ->mask(RawJs::make('$money($input, `,`)'))
                            ->stripCharacters('.'),
                        FileUpload::make('agreement_document')
                            ->disk('public')
                            ->image()
                            ->directory('agreement-documents')
                            ->default('-')
                            ->preserveFilenames(),

                    ]),
                Section::make('Insurance')
                    ->relationship('insurance')
                    ->columns(2)
                    ->schema([
                        TextInput::make('company_name')
                            ->default('-')
                            ->columnSpanFull()
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
                            ->label('Insured Ammount')
                            // ->mask(RawJs::make('$money($input, `,`)'))
                            ->stripCharacters('.'),
                            // ->numeric(),
                        DatePicker::make('renewal_date')
                            ->label('Renewal Date'),
                    ]),
                Section::make('Consultant')
                    ->relationship('consultant')
                    ->schema([
                        TextInput::make('consultant_used')
                            ->default('-')
                            ->columnSpanFull()
                            ->maxLength(255),
                        // TextInput::make('licence_name')
                        //     ->label('List Documents')
                        //     ->maxLength(255),
                        FileUpload::make('document')
                            ->default('-')
                            ->maxSize(59999)
                            ->label('List of Document on File')
                            ->multiple()
                            ->downloadable()
                            ->preserveFilenames(),
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
                ->label('Villa Name')
                ->searchable(),
                TextColumn::make('name.address')
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
