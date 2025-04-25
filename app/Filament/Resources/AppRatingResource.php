<?php
namespace App\Filament\Resources;

use App\Filament\Resources\AppRatingResource\Pages;
use App\Models\AppRating;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str; // Import Str untuk manipulasi string

class AppRatingResource extends Resource
{
    protected static ?string $model = AppRating::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Feedback & Penilaian';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Tidak perlu form untuk admin, karena hanya melihat data
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->sortable(),

                Tables\Columns\TextColumn::make('app_rating')
                    ->label('Rating')
                    ->sortable(),

                // Batasi panjang feedback dan tambahkan tooltip untuk melihat seluruh feedback
                Tables\Columns\TextColumn::make('app_feedback')
                    ->label('Feedback')
                    ->formatStateUsing(function ($state) {
                        // Potong feedback yang terlalu panjang
                        return Str::limit($state, 50); // Batas panjang feedback yang ditampilkan
                    })
                    ->tooltip(function ($state) {
                        // Menampilkan seluruh feedback dalam tooltip saat kursor diarahkan
                        return $state;
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i'),
            ])
            ->filters([
                // Filter jika diperlukan
            ])
            ->actions([
                // Tidak perlu aksi karena hanya view
            ])
            ->bulkActions([
                // Tidak perlu bulk actions karena hanya view
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
            'index' => Pages\ListAppRatings::route('/'),
        ];
    }
}
