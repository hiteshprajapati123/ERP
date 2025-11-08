<?php

namespace App\Filament\Resources\Zakats\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ZakatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('hero_title')
                    ->required(),
                Textarea::make('hero_quote')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('what_is_title')
                    ->required(),
                Textarea::make('what_is_content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('what_is_image')
                    ->image()
                    ->disk('private')
                    ->directory('donation/zakat/what_is_img')
                    ->imageResizeMode('cover')
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080'),
                FileUpload::make('qr_code_image')
                    ->image()
                    ->disk('private')
                    ->directory('donation/zakat/qr_codes')
                    ->imageResizeMode('contain')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('500')
                    ->imageResizeTargetHeight('500'),
                Textarea::make('key_points')
                    ->required()
                    ->helperText('Enter exactly 5 key points, each separated by a comma (,) or on a new line')
                    ->columnSpanFull()
                    ->hint('Example: Point 1, Point 2, Point 3, Point 4, Point 5')
                    ->rules([
                        function () {
                            return function (string $attribute, $value, $fail) {
                                $points = array_filter(array_map('trim', explode(',', str_replace("\n", ',', $value))));
                                if (count($points) !== 5) {
                                    $fail('Please enter exactly 5 key points.');
                                }
                            };
                        },
                    ]),
                TextInput::make('donation_title')
                    ->required(),
                Textarea::make('donation_description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('donation_note')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('nisab_gold')
                    ->required()
                    ->numeric()
                    ->default(87.48),
                TextInput::make('nisab_silver')
                    ->required()
                    ->numeric()
                    ->default(612.36),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
