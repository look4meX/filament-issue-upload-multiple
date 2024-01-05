<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HelpResource\Pages;
use App\Models\Help;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HelpResource extends Resource
{
    protected static ?string $model = Help::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Grid::make(1)->schema([
                    FileUpload::make("uploadCdnProduct")
                        ->label("Upload new")
                        ->multiple()
                        ->disk("gallery")
                        ->directory("ori")
                        ->previewable(false)
                        ->acceptedFileTypes([
                            "image/jpeg",
                            "image/png",
                            "image/webp"
                        ])
                        ->storeFiles(false)
                        ->afterStateUpdated(self::afterPhotoUploadTemporary(...)),
                ])
            ]);
    }

    private static function afterPhotoUploadTemporary(FileUpload $component, Get $get, Set $set): void {
        $array = [];

        dump($component->getState());

        return;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListHelps::route('/'),
            'create' => Pages\CreateHelp::route('/create'),
            'edit' => Pages\EditHelp::route('/{record}/edit'),
        ];
    }
}
