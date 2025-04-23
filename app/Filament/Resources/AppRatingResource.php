<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppRatingResource\Pages;
use App\Models\AppRating;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AppRatingResource extends Resource
{
    protected static ?string $model = AppRating::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Rating Aplikasi')
                ->description('Silakan isi rating dan feedback dari pengguna aplikasi.')
                ->schema([
                    // Otomatis ambil user yang login
                    Forms\Components\Hidden::make('user_id')
                        ->default(fn () => Filament::auth()->user()->id),

                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\Select::make('app_rating')
                            ->label('Rating')
                            ->options([
                                1 => '⭐️ Sangat Buruk',
                                2 => '⭐️⭐️ Buruk',
                                3 => '⭐️⭐️⭐️ Cukup',
                                4 => '⭐️⭐️⭐️⭐️ Bagus',
                                5 => '⭐️⭐️⭐️⭐️⭐️ Sangat Bagus',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('version')
                            ->label('Versi Aplikasi')
                            ->maxLength(20),
                    ]),

                    Forms\Components\Textarea::make('app_feedback')
                        ->label('Feedback')
                        ->rows(5)
                        ->maxLength(1000)
                        ->columnSpanFull(),
                ])
                ->columns(1)
                ->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('app_rating')
                    ->label('Rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐️', $state))
                    ->sortable(),

                Tables\Columns\TextColumn::make('app_feedback')
                    ->label('Feedback')
                    ->limit(30)
                    ->toggleable(),

                Tables\Columns\TextColumn::make('version')
                    ->label('Versi'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('app_rating')
                    ->options([
                        1 => '⭐️ 1',
                        2 => '⭐️ 2',
                        3 => '⭐️ 3',
                        4 => '⭐️ 4',
                        5 => '⭐️ 5',
                    ])
                    ->label('Filter Rating'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppRatings::route('/'),
            'create' => Pages\CreateAppRating::route('/create'),
            'edit' => Pages\EditAppRating::route('/{record}/edit'),
        ];
    }
}
