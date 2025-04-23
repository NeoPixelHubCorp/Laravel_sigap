<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Section::make('Informasi Pengguna')
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Nama Lengkap')
                                ->required()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('username')
                                ->label('Username')
                                ->nullable()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('email')
                                ->label('Email')
                                ->required()
                                ->email()
                                ->maxLength(255),

                            Forms\Components\TextInput::make('phone_number')
                                ->label('Nomor Telepon')
                                ->nullable()
                                ->maxLength(15)
                                ->tel(),
                        ]),
                ]),

            Forms\Components\Section::make('Keamanan')
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('password')
                                ->label('Password')
                                ->password()
                                ->minLength(6)
                                ->maxLength(255)
                                ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null)
                                ->required(fn (Forms\Components\TextInput $component) => $component->getRecord() === null),

                            Forms\Components\TextInput::make('password_confirmation')
                                ->label('Konfirmasi Password')
                                ->password()
                                ->nullable()
                                ->minLength(6)
                                ->maxLength(255)
                                ->required(fn (Forms\Components\TextInput $component) => $component->getRecord() === null),
                        ]),
                ]),

            Forms\Components\Section::make('Lainnya')
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\Select::make('role')
                                ->label('Role')
                                ->options([
                                    'admin' => 'admin',
                                    'agent' => 'agent',
                                    'user' => 'user',
                                ])
                                ->default('user')
                                ->required(),

                            Forms\Components\DateTimePicker::make('created_at')
                                ->label('Tanggal Registrasi')
                                ->disabled(),
                        ]),

                    Forms\Components\FileUpload::make('profile_photo')
                    ->label('Foto Profil')
                    ->directory('profile-photos')
                    ->image()
                    ->imageEditor()
                    ->previewable()
                    ->nullable()
                    ->maxSize(2048), // dalam KB, berarti 2 MB

                ]),
        ]);
}


    public static function table(Table $table): Table
{
    return $table
        ->columns([
            // Kolom nama pengguna
            Tables\Columns\TextColumn::make('name')
                ->label('Nama Lengkap')
                ->searchable()
                ->sortable(),

            // Kolom username pengguna
            Tables\Columns\TextColumn::make('username')
                ->label('Username')
                ->searchable()
                ->sortable(),

            // Kolom email pengguna
            Tables\Columns\TextColumn::make('email')
                ->label('Email')
                ->searchable()
                ->sortable(),

            // Kolom role pengguna
            Tables\Columns\TextColumn::make('role')
                ->label('Role')
                ->searchable()
                ->sortable(),

            // Kolom waktu registrasi
            Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal Registrasi')
                ->sortable()
                ->dateTime(),
            // Kolom gambar profil
            Tables\Columns\ImageColumn::make('profile_photo')
                ->label('Foto Profil')
                ->url(fn ($record) => Storage::disk('public')->url('profile-photos/' . $record->profile_photo)) // Perbaiki path
                ->height(50), // Sesuaikan ukuran gambar

        ])
        ->filters([
            // Tambahkan filter sesuai kebutuhan, misalnya filter berdasarkan role
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
