<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplainResource\Pages;
use App\Filament\Resources\ComplainResource\RelationManagers;
use App\Models\Category;
use App\Models\Complain;
use Filament\Support\Colors\Color;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComplainResource extends Resource
{
    protected static ?string $model = Complain::class;

    protected static ?string $navigationIcon = 'heroicon-o-face-frown';

public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2) // Membagi form dalam 2 kolom
                    ->schema([

                        // Kolom kiri
                        Forms\Components\Select::make('category_id')
                            ->label('Kategori Aduan')
                            ->options(Category::all()->pluck('category', 'id'))
                            ->required()
                            ->columnSpan(1), // Mengatur lebar kolom

                        Forms\Components\TextInput::make('no_aduan')
                            ->label('No Aduan')
                            ->default(function () {
                                return 'ADUAN-' . strtoupper(uniqid());
                            })
                            ->disabled()
                            ->columnSpan(1),  // Mengatur lebar kolom

                        Forms\Components\TextInput::make('title')
                            ->label('Judul Aduan')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2), // Membuat input judul lebih lebar

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Aduan')
                            ->required()
                            ->columnSpan(2), // Membuat deskripsi lebih lebar

                        Forms\Components\TextInput::make('location')
                            ->label('Lokasi Aduan')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1), // Mengatur kolom lokasi

                        Forms\Components\Select::make('status')
                            ->label('Status Aduan')
                            ->options([
                                'pending' => 'Pending',
                                'diverifikasi' => 'Diverifikasi',
                                'diteruskan_ke_instansi' => 'Diteruskan Ke Instansi',
                                'dalam_penanganan' => 'Dalam Penanganan',
                                'selesai' => 'Selesai',
                            ])
                            ->default('pending')
                            ->required()
                            ->columnSpan(1), // Mengatur kolom status

                        Forms\Components\Select::make('visibility')
                            ->label('Visibilitas Aduan')
                            ->options([
                                'public' => 'Public',
                                'private' => 'Private',
                            ])
                            ->default('private')
                            ->required()
                            ->columnSpan(1), // Mengatur kolom visibilitas

                        Forms\Components\DatePicker::make('tanggal_aduan')
                            ->label('Tanggal Aduan')
                            ->default(now())
                            ->required()
                            ->columnSpan(1), // Mengatur kolom tanggal aduan

                        Forms\Components\FileUpload::make('image')
                            ->label('Gambar')
                            ->image()
                            ->disk('public')
                            ->maxSize(1024)
                            ->nullable()
                            ->columnSpan(2), // Menambahkan gambar dengan kolom lebar 2
                    ]),
            ]);
    }



public static function table(Table $table): Table
{
    return $table
        ->columns([
            // Kolom untuk No Aduan
            Tables\Columns\TextColumn::make('no_aduan')
                ->label('No Aduan')
                ->searchable(),

            // Kolom untuk Judul Aduan
            Tables\Columns\TextColumn::make('title')
                ->label('Judul Aduan')
                ->searchable(),

            // Kolom untuk Kategori
            Tables\Columns\TextColumn::make('category.name')
                ->label('Kategori')
                ->searchable()
                ->getStateUsing(fn($record) => $record->category ? $record->category->name : ''), // Menampilkan nama kategori

            // Kolom untuk Status Aduan dengan Badge
            Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'pending',                     // #6B7280 (Gray 500)
                    'diverifikasi' => 'diverifikasi',           // #F59E0B (Amber 500)
                    'diteruskan_ke_instansi' => 'diteruskan',   // #3B82F6 (Blue 500)
                    'dalam_penanganan' => 'dalam_penanganan',   // #FB923C (Orange 400 custom)
                    'selesai' => 'selesai',                     // #10B981 (Emerald 500)
                    default => 'pending',                       // fallback pakai pending (netral)
                })
                ->getStateUsing(fn($record) => $record->status), // Menampilkan status

            // Kolom untuk Visibilitas dengan Badge
            Tables\Columns\TextColumn::make('visibility')
                ->label('Visibilitas')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'public' => 'green',
                    'private' => 'red',
                })
                ->getStateUsing(fn($record) => $record->visibility), // Menampilkan visibilitas

            // Kolom untuk Tanggal Aduan
            Tables\Columns\TextColumn::make('tanggal_aduan')
                ->label('Tanggal Aduan')
                ->date(),

            // Kolom untuk Nama Pelapor
            Tables\Columns\TextColumn::make('user.name')
                ->label('Pelapor')
                ->sortable()
                ->getStateUsing(fn($record) => $record->user ? $record->user->name : ''), // Menampilkan nama pelapor
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'pending' => 'Pending',
                    'diverifikasi' => 'Diverifikasi',
                    'diteruskan_ke_instansi' => 'Diteruskan Ke Instansi',
                    'dalam_penanganan' => 'Dalam Penanganan',
                    'selesai' => 'Selesai',
                ]),

            Tables\Filters\SelectFilter::make('visibility')
                ->options([
                    'public' => 'Public',
                    'private' => 'Private',
                ]),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
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
            'index' => Pages\ListComplains::route('/'),
            'create' => Pages\CreateComplain::route('/create'),
            'edit' => Pages\EditComplain::route('/{record}/edit'),
        ];
    }
}
