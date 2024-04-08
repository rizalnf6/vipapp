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
                    ->required()
                    ->maxLength(255),
                Section::make('Villa Detail')
                    ->columns(2)
                    ->schema([
                        Textarea::make('address')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('building_size')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('land_size')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('land_owner')
                            ->required()
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
                            ->required()
                            ->maxLength(255),
                        Textarea::make('address')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('passport_detail')
                            ->required(),
                        FileUpload::make('passport_file')
                            ->disk('public')
                            ->image()
                            ->directory('passport-files')
                            ->required(),
                    ]),
                Section::make('Tax')
                    ->relationship('tax')
                    ->schema([
                        TextInput::make('pb_tax')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('land_build_status')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('oss_status')
                            ->required()
                            ->maxLength(255),
                        Toggle::make('registered_pe')->default(false),
                    ]),
                Section::make('Management Agreement')
                    ->relationship('agreement')
                    ->schema([
                        Toggle::make('signed_copy')->default(false),
                        TextInput::make('booking_commision')
                            ->required()
                            ->prefix('Rp.')
                            ->mask(RawJs::make('$money($input, `,`)'))
                            ->stripCharacters('.')
                            ->numeric(),
                        Toggle::make('fix_monthly_fee')->default(false),
                        TextInput::make('agent_fee')
                            ->required()
                            ->prefix('Rp.')
                            ->mask(RawJs::make('$money($input, `,`)'))
                            ->stripCharacters('.')
                            ->numeric(),
                        TextInput::make('other_commision')
                            ->required()
                            ->prefix('Rp.')
                            ->mask(RawJs::make('$money($input, `,`)'))
                            ->stripCharacters('.')
                            ->numeric(),
                        FileUpload::make('agreement_document')
                            ->disk('public')
                            ->image()
                            ->directory('agreement-documents')
                            ->required(),

                    ]),
                Section::make('Insurance')
                    ->relationship('insurance')
                    ->columns(2)
                    ->schema([
                        TextInput::make('company_name')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(255),
                        TextInput::make('policy_number')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('insurance_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('insurance_amount')
                            ->prefix('Rp.')
                            ->required()
                            ->mask(RawJs::make('$money($input, `,`)'))
                            ->stripCharacters('.')
                            ->numeric(),
                        DatePicker::make('renewal_date')
                            ->required(),
                    ]),
                Section::make('Consultant')
                    ->relationship('consultant')
                    ->schema([
                        TextInput::make('consultant_used')
                            ->required()
                            ->columnSpanFull()
                            ->maxLength(255),
                        Repeater::make('documents')
                            ->columnSpanFull()
                            ->relationship('documents')
                            ->schema([
                                TextInput::make('licence_name')
                                    ->required()
                                    ->maxLength(255),
                                FileUpload::make('document')
                                    ->disk('public')
                                    ->image()
                                    ->directory('licences-documents')
                                    ->required(),
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('building_size')
                    ->searchable(),
                TextColumn::make('land_size')
                    ->searchable(),
                TextColumn::make('land_owner')
                    ->searchable(),
                TextColumn::make('land_certification_number')
                    ->searchable(),
                TextColumn::make('imb_pbg_number')
                    ->searchable(),
                TextColumn::make('licence')
                    ->searchable(),
                TextColumn::make('rental_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                        ->modalHeading('Hapus data')
                        ->label('Hapus'),
                    Tables\Actions\RestoreAction::make()
                        ->modalHeading('Kembalikan data villa'),
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
