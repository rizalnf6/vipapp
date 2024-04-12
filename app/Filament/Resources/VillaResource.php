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
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextInput::make('building_size')
                            ->placeholder('-')
                            ->maxLength(255),
                        TextInput::make('land_size')
                            ->placeholder('-')
                            ->maxLength(255),
                        TextInput::make('land_owner_name')
                            ->placeholder('-')
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
                            ->placeholder('-')
                            ->maxLength(255),
                        Textarea::make('address')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        Textarea::make('passport_detail')
                            ->placeholder('-'),
                        FileUpload::make('passport_file')
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
                            ->placeholder('-')
                            ->maxLength(255),
                        TextInput::make('land_build_status')
                            ->placeholder('-')
                            ->maxLength(255),
                        TextInput::make('oss_status')
                            ->placeholder('-')
                            ->maxLength(255),
                        Select::make('registered_pe')
                            ->default(false)
                            ->label('Registered as PE')
                            ->options([
                                true => 'Yes',
                                false => 'No'
                            ]),
                    ]),
                Section::make('Management Agreement')
                    ->relationship('agreement')
                    ->schema([
                        Select::make('signed_copy')
                            ->default(false)
                            ->label('Signed Copy')
                            ->options([
                                true => 'Yes',
                                false => 'No'
                            ]),
                        TextInput::make('booking_commision')
                            ->placeholder('-')
                            ->mask(RawJs::make('$money($input, `,`)'))
                            ->stripCharacters('.')
                            ->numeric(),
                        Select::make('fix_monthly_fee')
                            ->default(false)
                            ->label('Fix Monthly Fee')
                            ->options([
                                true => 'Yes',
                                false => 'No'
                            ]),
                        TextInput::make('agent_fee')
                            ->placeholder('-')
                            ->mask(RawJs::make('$money($input, `,`)'))
                            ->stripCharacters('.'),
                        TextInput::make('other_commision')
                            ->placeholder('-')
                            ->mask(RawJs::make('$money($input, `,`)'))
                            ->stripCharacters('.'),
                        FileUpload::make('agreement_document')
                            ->disk('public')
                            ->image()
                            ->directory('agreement-documents')
                            ->preserveFilenames(),

                    ]),
                Section::make('Insurance')
                    ->relationship('insurance')
                    ->columns(2)
                    ->schema([
                        TextInput::make('company_name')
                            ->placeholder('-')
                            ->columnSpanFull()
                            ->maxLength(255),
                        TextInput::make('policy_number')
                            ->placeholder('-')
                            ->maxLength(255),
                        TextInput::make('insurance_name')
                            ->label('Named Insurance')
                            ->placeholder('-')
                            ->maxLength(255),
                        TextInput::make('insurance_amount')
                            ->placeholder('-')
                            ->label('Insured Ammount')
                            ->mask(RawJs::make('$money($input, `,`)'))
                            ->stripCharacters('.')
                            ->numeric(),
                        DatePicker::make('renewal_date')
                            ->label('Renewal Date'),
                    ]),
                Section::make('Consultant')
                    ->relationship('consultant')
                    ->schema([
                        TextInput::make('consultant_used')
                            ->placeholder('-')
                            ->columnSpanFull()
                            ->maxLength(255),
                        FileUpload::make('documents')
                            ->maxSize(200 * 1024)
                            ->label('List of Document on File')
                            ->multiple()
                            ->moveFiles()
                            ->disk('public')
                            ->directory('consultant-documents')
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
