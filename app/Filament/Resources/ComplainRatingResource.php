<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplainRatingResource\Pages;
use App\Filament\Resources\ComplainRatingResource\RelationManagers;
use App\Models\ComplainRating;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComplainRatingResource extends Resource
{
    protected static ?string $model = ComplainRating::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Section::make('Complain Rating Input')
                ->schema([
                    Forms\Components\Select::make('complains_id')
                        ->label('Complain')
                        ->relationship('complain', 'title') // Ganti 'title' sesuai dengan kolom complain yg ditampilkan
                        ->required()
                        ->searchable(),

                    Forms\Components\Select::make('user_id')
                        ->label('User')
                        ->relationship('user', 'name') // Ganti 'name' sesuai nama field user
                        ->required()
                        ->searchable(),

                    Forms\Components\Select::make('complain_rating')
                        ->label('Rating')
                        ->options([
                            1 => '⭐ Sangat Buruk',
                            2 => '⭐⭐ Buruk',
                            3 => '⭐⭐⭐ Cukup',
                            4 => '⭐⭐⭐⭐ Baik',
                            5 => '⭐⭐⭐⭐⭐ Sangat Baik',
                        ])
                        ->required(),

                    Forms\Components\Textarea::make('complain_feedback')
                        ->label('Feedback (Opsional)')
                        ->rows(4)
                        ->placeholder('Masukkan komentar atau saran...'),
                ])
                ->columns(2)
                ->columnSpanFull(),
        ]);
}


public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc') // Mengurutkan berdasarkan tanggal
            ->columns([
                Tables\Columns\TextColumn::make('complain.title')
                    ->label('Complain')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(30),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('complain_rating')
                    ->label('Rating')
                    ->formatStateUsing(fn (int $state) => str_repeat('⭐', $state)),

                Tables\Columns\TextColumn::make('complain_feedback')
                    ->label('Feedback')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListComplainRatings::route('/'),
            'create' => Pages\CreateComplainRating::route('/create'),
            'edit' => Pages\EditComplainRating::route('/{record}/edit'),
        ];
    }
}
