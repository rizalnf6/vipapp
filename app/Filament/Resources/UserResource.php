<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Warehouse;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Placeholder;
use Phpsa\FilamentPasswordReveal\Password;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $modelLabel = "Users";

    public static function form(Form $form): Form
    {
        return $form
            ->columns(1)
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->unique('users', 'email', ignoreRecord: true)
                    ->required()
                    ->email(),
                Select::make('roles')
                    ->preload()
                    ->multiple()
                    ->maxItems(1)
                    ->relationship('roles', 'name')
                    ->required()
                    ->label('Role'),
                TextInput::make('password')
                    ->revealable(filament()->arePasswordsRevealable())
                    ->password()
                    ->required()
                    ->hiddenOn('edit')
                    ->minLength(6)
                    ->maxLength(30),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->badge()
                    ->label('Role'),
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->label('Role')
                    ->relationship('roles', 'name'),

            ])
            ->actions([
                ActionGroup::make([
                    Action::make('change_password')
                        ->label('Change Password')
                        ->requiresConfirmation()
                        ->icon('heroicon-o-key')
                        ->color('success')
                        ->hidden(fn () => !isSuperAdmin())
                        ->form([
                            TextInput::make('password')
                                ->revealable(filament()->arePasswordsRevealable())
                                ->password()
                                ->required()
                                ->minLength(6)
                                ->maxLength(30),
                            TextInput::make('password_confirmation')
                                ->revealable(filament()->arePasswordsRevealable())
                                ->label('Confirmation Password')
                                ->password()
                                ->same('password')
                                ->required()
                                ->minLength(6)
                                ->maxLength(30),
                        ])->action(fn (Model $record, array $data) => static::changePassword($record, $data)),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->hidden(fn () => !isSuperAdmin()),
                ])
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function changePassword(Model $record, array $data): void
    {
        $password = bcrypt($data['password']);

        $record->password = $password;
        $record->save();

        Notification::make()
            ->success()
            ->title('Success Reset Password')
            ->send();
    }
}
